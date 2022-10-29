<?php

namespace App\Models;

use Exception;
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

    public function save(array $data = []) {
        if(!array_key_exists('name', $data) || trim($data["name"]) === "") {
            redirect("/post/".$data["_post_id"]);
        }
        if(!array_key_exists('comment', $data) || trim($data["comment"]) === "") {
            redirect("/post/".$data["_post_id"]);
        }
        if(!array_key_exists('email', $data) || trim($data["email"]) === "") {
            redirect("/post/".$data["_post_id"]);
        }
        if(!array_key_exists('_post_id', $data) || intval(trim($data["_post_id"])) <= 0) {
            redirect("/post/".$data["_post_id"]);
        }
        $check = "SELECT * FROM post WHERE id = :id";
        $stmt = $this->conn->prepare($check);
        $stmt->bindParam("id", intval($data["_post_id"]), PDO::PARAM_INT);
        $stmt->execute();
        $post = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        if($post) {
            $query = "INSERT INTO comments (name, comment, email, created_at, post_id) VALUES (:name, :comment, :email, :created, :post_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("name", trim($data["name"]), PDO::PARAM_STR);
            $stmt->bindParam("comment", trim($data["comment"]), PDO::PARAM_STR);
            $stmt->bindParam("email", trim($data["email"]), PDO::PARAM_STR);
            $stmt->bindParam("created", date("Y-m-d H:i:s", time() + 7200));
            $stmt->bindParam("post_id", intval($data["_post_id"]), PDO::PARAM_INT);
    
            $stmt->execute();
        } else {
            throw new Exception("Nessun post collegato");
        }
    }

    public function delete(int $id) {
        $query = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", intval($id), PDO::PARAM_INT);

        $stmt->execute();
    }
}