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
        if(!array_key_exists('title', $data) || trim($data["title"]) === "") {
            redirect("/post/create");
        }
        if(!array_key_exists('message', $data) || trim($data["message"]) === "") {
            redirect("/post/create");
        }
        if(!array_key_exists('email', $data) || trim($data["email"]) === "") {
            redirect("/post/create");
        }
        $query = "INSERT INTO post (title, message, email, created_at) VALUES (:title, :message, :email, :created)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("title", trim($data["title"]), PDO::PARAM_STR);
        $stmt->bindParam("message", trim($data["message"]), PDO::PARAM_STR);
        $stmt->bindParam("email", trim($data["email"]), PDO::PARAM_STR);
        $stmt->bindParam("created", date("Y-m-d H:i:s", time() + 7200));

        $stmt->execute();
    }

    public function update(int $id, array $data = []) {
        $post = $this->find($id, true);
        if(!$post) {
            redirect("/post/update/".$id);
        }
        if(!array_key_exists('title', $data) || trim($data["title"]) === "") {
            redirect("/post/update/".$id);
        }
        if(!array_key_exists('message', $data) || trim($data["message"]) === "") {
            redirect("/post/update/".$id);
        }
        if(!array_key_exists('email', $data) || trim($data["email"]) === "") {
            redirect("/post/update/".$id);
        }
        $query = "UPDATE post SET title=:title, message=:message, email=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", intval($id), PDO::PARAM_INT);
        $stmt->bindParam("title", trim($data["title"]), PDO::PARAM_STR);
        $stmt->bindParam("message", trim($data["message"]), PDO::PARAM_STR);
        $stmt->bindParam("email", trim($data["email"]), PDO::PARAM_STR);

        $stmt->execute();
    }

    public function delete(int $id) {
        $query = "DELETE FROM post WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", intval($id), PDO::PARAM_INT);

        $stmt->execute();
    }
}