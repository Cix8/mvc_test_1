<?php

namespace App\Database;

use PDO;

class DB {
    protected $conn;
    protected static $instance;

    public static function getInstance(array $options)
    {
        if (!DB::$instance) {
            DB::$instance = new DB($options);
        }
        return DB::$instance;
    }

    protected function __construct(array $options)
    {
        $this->conn = new PDO($options['connString'], $options["user"], $options["password"]);
        if (array_key_exists('options', $options)) {
            foreach ($options['options'] as $key => $opt) {
                $this->conn->setAttribute($key, current($opt));
            }
        }
    }

    public function getConn() {
        return $this->conn;
    }
}