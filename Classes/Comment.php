<?php

class Comment
{
    private $connection;

    public function __construct($connection)
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        } else {
            throw new Exception("Cannot connect to database.");
        }
    }

    public function newComment($text,$question_id)
    {
        $stmt = $this->connection->prepare('call NewComment(?,?,?)');
        $stmt->bindParam(1,$text);
        $stmt->bindParam(2,$question_id);
        $stmt->bindParam(3,$_SESSION['uid']);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTPP_REFERERER]"); // Redirect back to last page

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newSubComment($text,$comment_id)
    {
        $stmt = $this->connection->prepare('call NewSubComment(?,?,?)');
        $stmt->bindParam(1,$text);
        $stmt->bindParam(2,$comment_id);
        $stmt->bindParam(3,$_SESSION['uid']);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTTP_REFERERER]");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newCommentVote($comment_id,$vote)
    {
        $stmt = $this->connection->prepare('call NewCommentVote(?,?,?)');
        $stmt->bindParam(1,$comment_id);
        $stmt->bindParam(2,$vote);
        $stmt->bindParam(3,$_SESSION['uid']);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTTP_REFERERER]");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newSubCommentVote($comment_id,$vote)
    {
        $stmt = $this->connection->prepare('call NewSubCommentVote(?,?,?)');
        $stmt->bindParam(1,$comment_id);
        $stmt->bindParam(2,$vote);
        $stmt->bindParam(3,$_SESSION['uid']);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTTP_REFERERER]");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}