<?php

namespace App\Controllers;

class PostController {
    protected string $layout = "layout/index.template.php";
    public string $content = "im in im in";
    public function __construct()
    {
        //echo "Post Controller creato";
    }

    public function display() {
        require $this->layout;
    }

    public function show(array $data) {
        ob_start();
        $message = "FromShow";
        require_once __DIR__ . "/../views/post.template.php";
        $this->content = ob_get_contents();
        ob_end_clean();
    }
}