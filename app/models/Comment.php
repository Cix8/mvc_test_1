<?php

namespace App\Models;

use PDO;
use PDOException;

class Comment
{
    protected PDO $conn;
    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function get(int $post_id)
    {
        $result = [];
        $stmt = null;

        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM comments WHERE post_id = :id");
            $stmt->bindParam("id", intval($post_id), PDO::PARAM_INT);
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
            $stmt = $this->conn->prepare("SELECT * FROM comments WHERE id = :id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
        if ($stmt) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if($first) {
            $result = Post::first($result);
        }
        
        return $result;
    }

    public function delete(int $id) {
        $query = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", intval($id), PDO::PARAM_INT);

        $stmt->execute();
    }
}