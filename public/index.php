<?php
//require_once __DIR__ . "/../layout/index.template.php";

use App\Database\DbFactory;
use Core\Router;

// REQUIRES

require_once __DIR__ . "/../database/DB.php";
require_once __DIR__ . "/../database/DbFactory.php";
require_once __DIR__ . "/../utilities/function.php";
require_once __DIR__ . "/../app/models/Post.php";
require_once __DIR__ . "/../app/models/Comment.php";
require_once __DIR__ . "/../core/Router.php";
require_once __DIR__ . "/../app/controllers/PostController.php";
require_once __DIR__ . "/../app/controllers/CommentController.php";

// ENDREQUIRES

//error_reporting(E_ALL);
chdir(dirname(__DIR__));

$data = require "config/database.php";
$app = require "config/app.config.php";

$db_conn;
try {
    $db_conn = DbFactory::create($data);
} catch (PDOException $ex) {
    die($ex->getMessage());
}

$conn = $db_conn->getConn();
$router = new Router($conn);
$router->assignRoutes($app["routes"]);

//$postController = new \App\Controllers\PostController($conn);
$postController = $router->dispatch();

//$postController->process();
//$postController->show(2);
$postController->display();
