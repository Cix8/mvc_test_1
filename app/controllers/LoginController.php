<?php

namespace App\Controllers;

use PDO;

class LoginController extends Controller {

    public function __construct(PDO $_conn)
    {
        parent::__construct($_conn);
    }

    public function showLogin() {
        $message = "FromLogin";
        $this->content = view('auth/login', compact('message'));
    }

    public function showRegister() {

    }

    public function login() {
        redirect('/');
    }
}