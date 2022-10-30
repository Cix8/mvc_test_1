<?php

namespace App\Controllers;

use App\Models\Comment;
use PDO;

class CommentController extends Controller {
    protected Comment $comment;
    public function __construct(PDO $_conn)
    {
        $this->locked = true;
        parent::__construct($_conn);
        $this->comment = new Comment($this->conn);
    }

    public function create() {
        $this->comment->save($_POST);
        redirect('/post/'.$_POST["_post_id"]);
    }

    public function delete(int $id) {
        $this->protectBy(["none", "edit"]);
        $comment = $this->comment->find($id, true);
        if($comment) {
            $this->comment->delete($id);
        }
        redirect('/post/'.$comment["post_id"]);
    }
}