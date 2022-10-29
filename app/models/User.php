<?php

namespace App\Models;

use PDO;
use PDOException;

class User {

    protected PDO $conn;

    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function getByEmail(string $email, bool $first = false) {
        $result = [];
        $stmt = null;

        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam("email", $email, PDO::PARAM_STR);
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
}