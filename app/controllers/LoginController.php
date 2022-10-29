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

    public static function extToken()
    {
        $bytes = random_bytes(32);
        $token = bin2hex($bytes);
        $csrf = hash("md5", $token);
        $_SESSION["csrf"] = $csrf;
        return $csrf;
    }

    public static function checkToken(string $path = "") {
        if($_POST["_csrf"] !== $_SESSION["csrf"]) {
            redirect('/'.$path);
            exit;
        }
    }

    public function showLogin()
    {
        $token = $this->generateToken();
        $message = "FromLogin";
        $this->content = view('auth/login', compact('message', 'token'));
    }

    public function showRegister()
    {
        $token = $this->generateToken();
        $message = "FromRegister";
        $this->content = view('auth/register', compact('message', 'token'));
    }

    public function login()
    {
        $result = $this->verifyLogin($_POST["email"], $_POST["password"], $_POST["_csrf"]);
        if ($result['success']) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            unset($result['user']['password']);
            $role = $result['user']['roletype'];
            $_SESSION['permission'] = "none";
            if ($role === 'admin') {
                $_SESSION['permission'] = "all";
            } else if ($role === 'editor') {
                $_SESSION['permission'] = "edit";
            }
            $_SESSION['user'] = $result['user'];
            redirect('/');
        } else {
            session_regenerate_id();
            $_SESSION = [];
            $_SESSION['message'] = $result['message'];
            redirect('/auth/login');
        }
    }

    public function register()
    {
        $token = $_POST['_csrf'] ?? '';
        $email  = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $username = $_POST['username'] ?? '';
        $role = $_POST['roletype'] ?? '';
        $result = $this->verifyRegister($email, $password, $token);

        if ($result['success']) {

            $user = new User($this->conn);

            $data['email']  = $email;
            $data['username']  = $username;
            $data['roletype'] = $role;
            $data['password']  = password_hash($password, PASSWORD_DEFAULT);

            $result = $user->saveUser($data);
            //dd($resultSave);
            if ($result['success']) {
                $data['id'] = $result['id'];
                session_regenerate_id();

                $_SESSION['loggedin'] = true;
                unset($data['password']);
                $role = $data['roletype'];
                $_SESSION['permission'] = "none";
                if ($role === 'admin') {
                    $_SESSION['permission'] = "all";
                } else if ($role === 'editor') {
                    $_SESSION['permission'] = "edit";
                }
                $_SESSION['user'] = $data;
                redirect('/');
            } else {
                redirect("/auth/register");
            }
        } else {
            redirect("/auth/register");
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

    private function verifyRegister($email, $password, $token)
    {


        $result = [
            'message' => 'USER SIGNED UP CORRECTLY',
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
        $resEmail = $user->getByEmail($email);

        if ($resEmail) {
            $result = [
                'message' => 'A USER ALREADY EXISTS WITH THIS EMAIL',
                'success' => false

            ];
            return $result;
        }



        return $result;
    }

    public function logout() {
        if(!empty($_POST["action"]) && $_POST["action"] == "logout") {
            session_regenerate_id();
            $_SESSION = [];
            redirect('/auth/login');
        }
    }
}
