<?php

namespace App\Core;

use App\Core\Database;

class SQL {
    private static function renderSql(string $sql, array $params = []): string {
        // setzt bei :variable die value ein, wo der key in params = 'variable' ist.
        // hat es bei dem key-name noch ein # davor, wird dieser teil unverändert eingefügt.
        // beispiel: #variable1 wird unverändert bei :variable1 eingefügt
        // beispiel: variable2 wird (escaped) bei :variable2 eingefügt
        return;
    }

    public static function getAllUsers() {
        $sql = 'SELECT * FROM `users`';
        return self::renderSql($sql);
    }
}