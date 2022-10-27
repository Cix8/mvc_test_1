<?php

namespace App\Controllers;

class PostController {
    protected $layout = "layout/index.template.php";
    public $content = "im in im in";
    public function __construct()
    {
        //echo "Post Controller creato";
    }

    public function display() {
        require $this->layout;
    }

    public function show(int $post_id) {
        $message = "FromShow";
        ob_start();
        require_once __DIR__ . "/../views/post.template.php";
        $this->content = ob_get_contents();
        ob_end_clean();
    }
}