<?php

namespace App\Controllers;

use App\Models\User;
use PDO;

class LoginController extends Controller
{

    public function __construct(PDO $_conn)
    {
        parent::__construct($_conn);
    }

    private function generateToken()
    {
        $bytes = random_bytes(32);
        $token = bin2hex($bytes);
        $csrf = hash("sha256", $token);
        $_SESSION["csrf"] = $csrf;
        return $csrf;
    }

    public static function extToken() {
        $bytes = random_bytes(32);
        $token = bin2hex($bytes);
        $csrf = hash("md5", $token);
        return $csrf;
    }

    public function showLogin()
    {
        $token = $this->generateToken();
        $message = "FromLogin";
        $this->content = view('auth/login', compact('message', 'token'));
    }

    public function showRegister()
    {
    }

    public function login()
    {
        $result = $this->verifyLogin($_POST["email"], $_POST["password"], $_POST["_csrf"]);
        if ($result['success']) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            unset($result['user']['password']);
            $_SESSION['user'] = $result['user'];
            redirect('/');


        } else {
            session_regenerate_id();
            $_SESSION = [];
            $_SESSION['message'] = $result['message'];
            redirect('/auth/login');
        }
    }

    private function verifyLogin($email, $password, $token)
    {
        $result = [
            'message' => 'USERD LOGGED IN',
            'success' => true

        ];
        if ($token !== $_SESSION['csrf']) {
            $result = [
                'message' => 'TOKEN MISMATCH',
                'success' => false

            ];
            return $result;
        }
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $result = [
                'message' => 'WRONG EMAIL',
                'success' => false

            ];
            return $result;
        }
        if (strlen($password) < 6) {
            $result = [
                'message' => 'PASSWORD TOO SMALL',
                'success' => false

            ];
            return $result;
        }
        $user = new User($this->conn);
        $userResult = $user->getByEmail($email, true);

        if (!$userResult) {
            $result = [
                'message' => 'USER NOT FOUND',
                'success' => false

            ];
            return $result;
        }

        if (!password_verify($password, $userResult["password"])) {
            $result = [
                'message' => 'WRONG PASSWORD',
                'success' => false

            ];
            return $result;
        }
        $result['user'] = (array)$userResult;

        return $result;
    }
}
