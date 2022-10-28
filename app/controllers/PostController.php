<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Exception;
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

    public function index() {
        $posts = $this->post->get();
        $message = "FromIndex";
        $this->content = view('index', compact('posts', 'message'));
    }

    public function show(int $id)
    {
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $comments = [];
        if($post) {
            $comments = new Comment($this->conn, $post["id"]);
            $comments = $comments->get($id);
        }
        $message = "FromShow";
        $this->content = view('show', compact('post', 'message', 'comments'));
    }

    public function createGet() {
        $message = "FromCreate";
        $this->content = view('create', compact('message'));
    }

    public function create() {
        $this->post->save($_POST);
        redirect();
    }

    public function edit(int $id) {
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $message = "FromEdit";
        $this->content = view('edit', compact('post', 'message'));
    }

    public function update(int $id) {
        $post = $this->post->find($id, true);
        if($post) {
            $this->post->update($id, $_POST);
            redirect("/post/".$id);
        } else {
            throw new Exception("Nessun post corrispondente");
        }
    }

    public function delete(int $id) {
        $this->post->delete($id);
        redirect();
    }
}
