<?php

namespace Config;

use Dotenv\Dotenv;

final class Env {
    /** @var string|null */
    private static $basePath = null;
    /** @var bool */
    private static $loaded = false;
    /** @var string */
    private static $envFile = '.env';

    /**
     * @param string $basePath
     * @param bool $throw
     */
    public static function load(string $basePath, bool $throw = false): void {
        self::$basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
        $dotenv = Dotenv::createImmutable(self::$basePath, self::$envFile);

        if ($throw) {
            $dotenv->load();
        } else {
            $dotenv->safeLoad();
        }

        self::$loaded = true;
    }

    public static function reload(): void {
        if (!self::$basePath) return;
        self::$loaded = false;
        self::load(self::$basePath, false);
    }

    public static function get(string $key, $default = null, ?string $cast = null) {
        self::ensureLoaded();

        $val = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($val === false || $val === null) {
            $val = $default;
        }

        if ($cast && $val !== null) {
            switch ($cast) {
                case 'bool':
                    return self::toBool($val);
                case 'int':
                    return (int)$val;
                case 'float':
                    return (float)$val;
                case 'json':
                    $decoded = json_decode((string)$val, true);
                    return json_last_error() === JSON_ERROR_NONE ? $decoded : $default;
            }
        }
        return $val;
    }

    public static function has(string $key): bool {
        self::ensureLoaded();
        return array_key_exists($key, $_ENV) || array_key_exists($key, $_SERVER) || getenv($key) !== false;
    }

    public static function all(): array {
        self::ensureLoaded();
        return $_ENV;
    }

    /**
     * @param string[] $keys
     */
    public static function required(array $keys): void {
        $missing = [];
        foreach ($keys as $k) {
            $v = self::get($k);
            if ($v === null || $v === '') {
                $missing[] = $k;
            }
        }
        if ($missing) {
            throw new \RuntimeException('Missing required env keys: ' . implode(', ', $missing));
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param bool $persist
     */
    public static function set(string $key, $value, bool $persist = false): void {
        self::ensureLoaded();

        $valStr = self::valueToString($value);

        $_ENV[$key] = $valStr;
        $_SERVER[$key] = $valStr;

        putenv($key . '=' . $valStr);

        if ($persist) {
            self::persistToDotenv($key, $valStr);
        }
    }

    /**
     * Pfad zur .env zur Laufzeit aendern (z. B. .env.testing)
     */
    public static function useEnvFile(string $filename = '.env'): void {
        self::$envFile = $filename;
        if (self::$basePath) {
            self::reload();
        }
    }

    private static function ensureLoaded(): void {
        if (!self::$loaded) {
            // Default: eine Ebene ueber public/ liegt .env
            $fallback = dirname(__DIR__); // .../config -> projectroot
            self::load(self::$basePath ?? $fallback, false);
        }
    }

    private static function toBool($val): bool {
        $v = is_string($val) ? strtolower(trim($val)) : $val;
        $true  = ['1','true','on','yes','y'];
        $false = ['0','false','off','no','n',''];
        if (is_string($v)) {
            if (in_array($v, $true, true)) return true;
            if (in_array($v, $false, true)) return false;
        }
        return (bool)$val;
    }

    private static function valueToString($value): string {
        if (is_bool($value)) return $value ? 'true' : 'false';
        if (is_array($value) || is_object($value)) return json_encode($value, JSON_UNESCAPED_UNICODE);
        return (string)$value;
    }

    private static function persistToDotenv(string $key, string $value): void {
        if (!self::$basePath) {
            throw new \RuntimeException('Cannot persist env: basePath is not set.');
        }
        $envPath = self::$basePath . DIRECTORY_SEPARATOR . self::$envFile;

        $lines = file_exists($envPath) ? file($envPath, FILE_IGNORE_NEW_LINES) : [];
        $found = false;
        $encoded = self::encodeEnvValue($value);

        foreach ($lines as $i => $line) {
            // Ignore Kommentare/Leerzeilen
            if ($line === '' || strpos(ltrim($line), '#') === 0) continue;

            // KEY=... am Zeilenanfang (bis zum ersten =)
            $pos = strpos($line, '=');
            if ($pos === false) continue;

            $existingKey = rtrim(substr($line, 0, $pos));
            if ($existingKey === $key) {
                $lines[$i] = $key . '=' . $encoded;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $lines[] = $key . '=' . $encoded;
        }

        $tmp = $envPath . '.tmp';
        file_put_contents($tmp, implode(PHP_EOL, $lines) . PHP_EOL);
        rename($tmp, $envPath);
    }

    private static function encodeEnvValue(string $value): string {
        if (preg_match('/[\s#=":\\\\]/', $value)) {
            // doppelte Quotes benutzen und escapen
            $escaped = addcslashes($value, "\\\"");
            return '"' . $escaped . '"';
        }
        return $value;
    }
}
