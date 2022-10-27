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

        ob_start();
        $data = $results;
        $message = "FromCostruct";
        require_once __DIR__ . "/../views/post.template.php";
        $this->content = ob_get_contents();
        ob_end_clean();
    }

    public function display()
    {
        require $this->layout;
    }

    public function show(array $data)
    {
        ob_start();
        $message = "FromShow";
        require_once __DIR__ . "/../views/post.template.php";
        $this->content = ob_get_contents();
        ob_end_clean();
    }
}
