<?php

namespace App\Controllers;

use PDO;
use PDOException;

class PostController
{
    protected string $layout = "layout/index.template.php";
    public string $content = "im in im in";
    protected $conn;
    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function display()
    {
        require $this->layout;
    }

    public function process() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');
        $keys = explode('/', $url);

        // switch ($keys[0]) {
        //     case 'posts':
        //         $this->content = call_user_func([$this, 'index']);
        //         break;
        //     case 'post':
        //         if($_SERVER['REQUEST_METHOD'] === 'GET'){
        //             $this->content = call_user_func([$this, 'show'], intval($keys[1]));
        //             break;
        //         }
        // }

        if($keys[0] === "posts" || $keys[0] === "") {
            $this->content = call_user_func([$this, 'index']);
        } else if($keys[0] === "post" || is_int(intval($keys[1]))) {
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $this->content = call_user_func([$this, 'show'], intval($keys[1]));
            }
        }
    }

    public function getAll() {
        $stmt = null;

        try {
            $stmt = $this->conn->prepare("SELECT * FROM post");
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

        $results = null;

        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($results === null) {
            die();
        }

        return $results;
    }

    public function find(int $id) {
        $stmt = null;

        try {
            $stmt = $this->conn->prepare("SELECT * FROM post WHERE id = :id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

        $results = null;

        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($results === null) {
            die();
        }

        return $results;
    }

    public function index() {
        $data = $this->getAll();
        $message = "FromCostruct";
        ob_start();
        require_once __DIR__ . "/../views/post/index.template.php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function show(int $id)
    {
        $data = $this->find($id);
        ob_start();
        $message = "FromShow";
        require_once __DIR__ . "/../views/post/show.template.php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
