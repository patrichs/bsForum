<?php
require("bsDatabase.php");

class bsForum extends bsDatabase {

    public function getActiveThreads()
    {
        $query = $this->connection->prepare("SELECT * FROM `bs_threads` WHERE `active` = 1");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThread($threadId)
    {
        $query = $this->connection->prepare("SELECT * FROM `bs_threads` WHERE `id` = :threadId");
        $query->execute(array("threadId" => $threadId));

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThreadComments($threadId)
    {
        $query = $this->connection->prepare("SELECT * FROM `bs_comments` WHERE `thread_id` = :threadId");
        $query->execute(array("threadId" => $threadId));

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postNewThread($title, $description, $created_by)
    {
        $query = $this->connection->prepare("INSERT INTO `bs_threads` (`title`, `description`, `created_by`, `created_date`)
        VALUES (:title, :description, :created_by, :created_date)");
        $insert = $query->execute(array("title" => $title, "description" => $description, "created_by" => $created_by, "created_date" => date("Y-m-d H:i:s")));

        return $insert;
    }

    public function postNewComment($threadId, $comment, $created_by, $responseTo)
    {
        $query = $this->connection->prepare("INSERT INTO `bs_comments` (`comment`, `created_by`, `thread_id`, `created_date`, `response_to`)
        VALUES (:comment, :created_by, :thread_id, :created_date, :response_to)");
        $insert = $query->execute(array("comment" => $comment, "created_by" => $created_by, "thread_id" => $threadId, "created_date" => date("Y-m-d H:i:s"), "response_to" => $responseTo));

        return $insert;
    }

    public function getThreadCommentsCount($threadId)
    {
        $query = $this->connection->prepare("SELECT * FROM `bs_comments` WHERE `thread_id` = :threadId");
        $query->execute(array("threadId" => $threadId));

        return $query->rowCount();
    }

    public function updateCommentCounter($threadId)
    {
        $query = $this->connection->prepare("UPDATE `bs_threads` SET `comments_count` = (comments_count + 1) WHERE `id` = :thread_id");
        $update = $query->execute(array("thread_id" => $threadId));

        return $update;
    }
} 