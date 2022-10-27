<?php
//require_once __DIR__ . "/../layout/index.template.php";

use App\Database\DB;
use App\Database\DbFactory;

require_once __DIR__ . "/../database/DB.php";
require_once __DIR__ . "/../database/DbFactory.php";

//error_reporting(E_ALL);
chdir(dirname(__DIR__));

$data = require "config/database.php";

$db_conn;
try {
    $db_conn = DbFactory::create($data);
} catch (PDOException $ex) {
    die($ex->getMessage());
}

$conn = $db_conn->getConn();

require_once __DIR__ . "/../app/controllers/PostController.php";

$postController = new \App\Controllers\PostController($conn);

// $postController->show(2);
$postController->display();
