<?php

return [
    'db_type' => 'mysql', // può essere sqllite,mssql, oci
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => 'mvc_test_db',
    'connString' => 'mysql:host=localhost;dbname=mvc_test_db',
    'options' => [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];