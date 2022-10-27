<?php

namespace App\Controllers;

class PostController {
    protected $layout = "layout/index.template.php";
    public $name = "im in im in";
    public function __construct()
    {
        //echo "Post Controller creato";
    }

    public function display() {
        require $this->layout;
    }
}