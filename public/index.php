<?php
//require_once __DIR__ . "/../layout/index.template.php";

use App\Database\DB;

require_once __DIR__ . "/../database/DB.php";

//error_reporting(E_ALL);
chdir(dirname(__DIR__));

$data = require "config/database.php";

$db_conn;
try {
    $db_conn = DB::getInstance($data);
} catch (PDOException $ex) {
    die($ex->getMessage());
}

$conn = $db_conn->getConn();
$stmt;

try {
    $stmt = $conn->prepare("SELECT * FROM post");
    $stmt->execute();
} catch (PDOException $ex) {
    die($ex->getMessage());
}

$results;

if($stmt) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if($results === null) {
    die();
}

require_once __DIR__ . "/../app/controllers/PostController.php";

$postController = new \App\Controllers\PostController();

$postController->show($results);
$postController->display();
