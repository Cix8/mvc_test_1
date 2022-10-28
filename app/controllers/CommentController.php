<?php

namespace App\Controllers;

use App\Models\Comment;
use PDO;

class CommentController {
    protected $conn;
    protected Comment $comment;
    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
        $this->comment = new Comment($this->conn);
    }

    public function delete(int $id) {
        $comment = $this->comment->find($id, true);
        if($comment) {
            $this->comment->delete($id);
        }
        redirect('/post/'.$comment["post_id"]);
    }
}