<?php

namespace App\Core;

use Config\Env;
use Exception;

final class Database {
    private string $host;
    private string $port;
    private string $user;
    private string $password;

    public function __construct() {
        self::set_host(Env::get('DB_HOST', '127.0.0.1'));
        self::set_port(Env::get('DB_PORT', '3306'));
        self::set_user(Env::get('DB_USER', 'root'));
        self::set_password(Env::get('DB_PASS', ''));

        try {
            self::connect();
        } catch (Exception $e) {
            exit('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function connect(): void {
        $connection = mysqli_connect(self::get_host(), self::get_user(), self::get_password(), self::get_port());
        if (!$connection) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }
    }

    public function get_host(): string {
        return $this->host;
    }

    public function get_port(): string {
        return $this->port;
    }

    public function get_user(): string {
        return $this->user;
    }

    public function get_password(): string {
        return $this->password;
    }

    public function set_host(string $host): void {
        $this->host = $host;
    }

    public function set_port(string $port): void {
        $this->port = $port;
    }

    public function set_user(string $user): void {
        $this->user = $user;
    }

    public function set_password(string $password): void {
        $this->password = $password;
    }
}
