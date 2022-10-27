<?php

namespace App\Models;

use PDO;
use PDOException;

class Post
{
    protected $conn;
    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function get()
    {
        $result = [];
        $stmt = null;

        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM post");
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
        if ($stmt) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $result;
    }

    public function find(int $id, bool $first = false)
    {
        $result = [];
        $stmt = null;

        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM post WHERE id = :id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
        if ($stmt) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if($first) {
            $result = $this::first($result);
        }
        
        return $result;
    }

    public static function first(array $data) {
        if(count($data) > 0) {
            return $data[0];
        }
        return null;
    }

    public function save(array $data = []) {
        $query = "INSERT INTO post (title, message, email, created_at) VALUES (:title, :message, :email, :created)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("title", $data["title"], PDO::PARAM_STR);
        $stmt->bindParam("message", $data["message"], PDO::PARAM_STR);
        $stmt->bindParam("email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam("created", date("Y-m-d H:i:s", time() + 7200));

        $stmt->execute();
    }
}