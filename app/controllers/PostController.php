<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use PDO;

class PostController extends Controller
{
    protected Post $post;
    public function __construct(PDO $_conn)
    {
        $this->locked = true;
        parent::__construct($_conn);
        $this->post = new Post($this->conn);
    }

    public function index() {
        $posts = $this->post->get();
        $message = "FromIndex";
        $this->content = view('post/index', compact('posts', 'message'));
    }

    public function getMy() {
        $id = (int)intval($_SESSION["user"]["id"]);
        $posts = $this->post->get($id);
        $message = "I Miei Post";
        $this->content = view('post/index', compact('posts', 'message'));
    }

    public function show(int $id)
    {
        $csrf = LoginController::extToken();
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $comments = [];
        if($post) {
            $comments = new Comment($this->conn);
            $comments = $comments->get($id);
        }
        $message = "FromShow";
        $this->content = view('post/show', compact('post', 'message', 'comments', 'csrf'));
    }

    public function createGet() {
        $csrf = LoginController::extToken();
        $message = "FromCreate";
        $this->content = view('post/create', compact('message', 'csrf'));
    }

    public function create() {
        LoginController::checkToken('post/create');
        $_POST["user_id"] = $_SESSION["user"]["id"];
        $this->post->save($_POST);
        redirect();
    }

    public function edit(int $id) {
        $csrf = LoginController::extToken();
        $this->protectBy(["none"]);
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $message = "FromEdit";
        $this->content = view('post/edit', compact('post', 'message', 'csrf'));
    }

    public function update(int $id) {
        LoginController::checkToken('post/update/'.$id);
        $this->protectBy(["none"]);
        $post = $this->post->find($id, true);
        if($post) {
            $this->post->update($id, $_POST);
            redirect("/post/".$id);
        } else {
            throw new Exception("Nessun post corrispondente");
        }
    }

    public function delete(int $id) {
        LoginController::checkToken('post/'.(string)$id);
        $this->protectBy(["none", "edit"]);
        $this->post->delete($id);
        redirect();
    }
}
