<?php
//require_once __DIR__ . "/../layout/index.template.php";

chdir(dirname(__DIR__));

require_once __DIR__ . "/../app/controllers/PostController.php";

$postController = new \App\Controllers\PostController();

$postController->display();