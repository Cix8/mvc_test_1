<?php

namespace App\Controllers;

use App\Models\Post;
use PDO;

class PostController
{
    protected string $layout = "layout/index.template.php";
    public string $content = "im in im in";
    protected $conn;
    protected Post $post;
    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
        $this->post = new Post($this->conn);
    }

    public function display()
    {
        require $this->layout;
    }

    public function process() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');
        $keys = explode('/', $url);

        if($keys[0] === "posts" || $keys[0] === "") {
            $this->content = call_user_func([$this, 'index']);
        } else if($keys[0] === "post" && is_int(intval($keys[1]))) {
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $this->content = call_user_func([$this, 'show'], intval($keys[1]));
            }
        } else if($keys[0] === "create") {
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $this->content = call_user_func([$this, 'createGet']);
            }
        }
    }

    public function index() {
        $posts = $this->post->get();
        $message = "FromIndex";
        return view('index', compact('posts', 'message'));
    }

    public function show(int $id)
    {
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $message = "FromShow";
        return view('show', compact('post', 'message'));
    }

    public function createGet() {
        $message = "FromCreate";
        return view('create', compact('message'));
    }
}
