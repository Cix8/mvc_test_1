<?php

namespace App\Database;

use App\Database\DB;
use InvalidArgumentException;

class DbFactory {
    public static function create(array $options) {
        if(!array_key_exists('db_type', $options)) {
            throw new InvalidArgumentException("Nessun db_type!");
        }

        if(!$options['db_type'] === 'mysql') {
            throw new InvalidArgumentException("db_type sconosciuto");
        }

        if(!array_key_exists('connString', $options)) {
            $options['connString'] = 'mysql:host=localhost;dbname=mvc_test_db';
        }

        return DB::getInstance($options);
    }
}