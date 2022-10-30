<?php

return [
    'db_type' => 'mysql',
    'host' => 'localhost',
    'user' => 'username',
    'password' => 'password',
    'database' => 'db_name',
    'options' => [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];