<?php

namespace App\Controllers;

use PDO;

class Controller {
    protected string $layout = "layout/index.template.php";
    public string $content = "im in im in";
    protected $conn;
    protected bool $locked = false;

    public function __construct(PDO $_conn)
    {
        if($this->locked) {
            $this->protect();
        }
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

    protected function protectBy(array $values) {
        foreach($values as $value) {
            if(!isset($_SESSION["permission"]) || $_SESSION["permission"] === $value) {
                redirect("/");
                exit;
            }
        }
    }
}