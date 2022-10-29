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
        parent::__construct($_conn);
        $this->post = new Post($this->conn);
    }

    public function display()
    {
        require $this->layout;
    }

    public function index() {
        $this->protect();
        $posts = $this->post->get();
        $message = "FromIndex";
        $this->content = view('post/index', compact('posts', 'message'));
    }

    public function show(int $id)
    {
        $this->protect();
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $comments = [];
        if($post) {
            $comments = new Comment($this->conn);
            $comments = $comments->get($id);
        }
        $message = "FromShow";
        $this->content = view('post/show', compact('post', 'message', 'comments'));
    }

    public function createGet() {
        $this->protect();
        $message = "FromCreate";
        $this->content = view('post/create', compact('message'));
    }

    public function create() {
        $this->protect();
        $this->post->save($_POST);
        redirect();
    }

    public function edit(int $id) {
        $this->protect();
        $post = $this->post->find($id);
        $post = $this->post::first($post);
        $message = "FromEdit";
        $this->content = view('post/edit', compact('post', 'message'));
    }

    public function update(int $id) {
        $this->protect();
        $post = $this->post->find($id, true);
        if($post) {
            $this->post->update($id, $_POST);
            redirect("/post/".$id);
        } else {
            throw new Exception("Nessun post corrispondente");
        }
    }

    public function delete(int $id) {
        $this->protect();
        $this->post->delete($id);
        redirect();
    }
}
