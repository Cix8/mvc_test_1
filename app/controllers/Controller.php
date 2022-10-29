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

    protected function protect() {
        if(!isset($_SESSION["user"]) || $_SESSION["user"] === null) {
            $_SESSION = [];
            redirect("/auth/login");
            exit;
        }
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
            $_SESSION = [];
            redirect("/auth/login");
            exit;
        }
    }
}