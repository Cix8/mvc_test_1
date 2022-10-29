<?php

namespace App\Controllers;

use PDO;

class Controller {
    protected string $layout = "layout/index.template.php";
    public string $content = "im in im in";
    protected $conn;

    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function display() {
        require $this->layout;
    }
}