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
        $this->index();
    }

    public function display()
    {
        require $this->layout;
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
        $this->content = ob_get_contents();
        ob_end_clean();
    }

    public function show(int $id)
    {
        $data = $this->find($id);
        ob_start();
        $message = "FromShow";
        require_once __DIR__ . "/../views/post/show.template.php";
        $this->content = ob_get_contents();
        ob_end_clean();
    }
}
