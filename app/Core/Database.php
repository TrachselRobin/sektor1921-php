<?php
namespace App\Core;

use PDO;
use PDOException;
use Config\Env;

final class Database
{
    private static ?PDO $pdo = null;

    /**
     * Create (or reuse) a PDO connection from .env
     */
    public static function pdo(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $driver  = Env::get('DB_DRIVER', 'mysql');
        $host    = Env::get('DB_HOST', '127.0.0.1');
        $port    = Env::get('DB_PORT', '3306');
        $db      = Env::get('DB_NAME', '');
        $user    = Env::get('DB_USER', 'root');
        $pass    = Env::get('DB_PASS', '');
        $charset = Env::get('DB_CHARSET', 'utf8mb4');
        $persist = Env::get('DB_PERSISTENT', false, 'bool');

        switch ($driver) {
            case 'mysql':
                $dsn = "mysql:host={$host};port={$port};dbname={$db};charset={$charset}";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_PERSISTENT         => $persist,
                ];
                break;

            case 'sqlite':
                // DB_NAME holds path to file, e.g. /path/to/db.sqlite
                $dsn = "sqlite:{$db}";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $user = null; $pass = null;
                break;

            default:
                throw new \RuntimeException("Unsupported DB_DRIVER: {$driver}");
        }

        try {
            self::$pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new \RuntimeException('DB connection failed: ' . $e->getMessage(), 0, $e);
        }

        return self::$pdo;
    }

    /** Prepare + execute with params; returns PDOStatement */
    public static function run(string $sql, array $params = []): \PDOStatement
    {
        $stmt = self::pdo()->prepare($sql);
        foreach ($params as $key => $val) {
            // Support both numeric and named params
            $param = is_int($key) ? $key + 1 : (str_starts_with((string)$key, ':') ? $key : ':' . $key);
            $stmt->bindValue($param, $val, self::inferType($val));
        }
        $stmt->execute();
        return $stmt;
    }

    /** Fetch all rows */
    public static function all(string $sql, array $params = []): array
    {
        return self::run($sql, $params)->fetchAll();
    }

    /** Fetch single row (or null) */
    public static function row(string $sql, array $params = []): ?array
    {
        $r = self::run($sql, $params)->fetch();
        return $r === false ? null : $r;
    }

    /** Fetch single column from first row (or null) */
    public static function scalar(string $sql, array $params = [])
    {
        $v = self::run($sql, $params)->fetchColumn();
        return $v === false ? null : $v;
    }

    /** Execute (INSERT/UPDATE/DELETE); returns affected rows */
    public static function exec(string $sql, array $params = []): int
    {
        return self::run($sql, $params)->rowCount();
    }

    /** Last insert id */
    public static function lastId(): string
    {
        return self::pdo()->lastInsertId();
    }

    /** Transactions */
    public static function begin(): void  { self::pdo()->beginTransaction(); }
    public static function commit(): void { self::pdo()->commit(); }
    public static function rollBack(): void
    {
        if (self::pdo()->inTransaction()) self::pdo()->rollBack();
    }

    /** Optional: close/reset connection */
    public static function reset(): void { self::$pdo = null; }

    private static function inferType($v): int
    {
        return match (true) {
            is_int($v)   => PDO::PARAM_INT,
            is_bool($v)  => PDO::PARAM_BOOL,
            is_null($v)  => PDO::PARAM_NULL,
            default      => PDO::PARAM_STR,
        };
    }
}
