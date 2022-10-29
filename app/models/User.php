<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{

    protected PDO $conn;

    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function getByEmail(string $email, bool $first = false)
    {
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

        if ($first) {
            $result = Post::first($result);
        }

        return $result;
    }

    function saveUser(array $data)
    {
        $result = [
            'id' => 0,
            'success' => false,
            'message' => 'PROBLEM SAVING USER',

        ];



        $sql = "INSERT INTO users (username, email, password, roletype) VALUES(:username, :email,:password, :roletype)";
        //echo $sql;
        $stm = $this->conn->prepare($sql);

        if ($stm) {
            $res = $stm->execute([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'roletype' => $data['roletype'] ?? 'user'

            ]);
            if ($res) {
                $result['success']  = 1;
                $result['id'] = $this->conn->lastInsertId();
                $result['message'] = 'USER CREATED CORRECTLY';
            } else {
                $result['success']  = $this->conn->errorInfo();;
            }
        } else {
            $result['message'] = $this->conn->errorInfo();
        }
        return  $result;
    }
}
