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
        $query = $this->connection->prepare("INSERT INTO `bs_threads` (`title`, `description`, `created_by`)
        VALUES (:title, :description, :created_by)");
        $insert = $query->execute(array("title" => $title, "description" => $description, "created_by" => $created_by));

        return $insert;
    }

    public function postNewComment($threadId, $comment, $created_by)
    {
        $query = $this->connection->prepare("INSERT INTO `bs_comments` (`comment`, `created_by`, `thread_id`)
        VALUES (:comment, :created_by, :thread_id)");
        $insert = $query->execute(array("comment" => $comment, "created_by" => $created_by, "thread_id" => $threadId));

        return $insert;
    }

    public function getThreadCommentsCount($threadId)
    {
        $query = $this->connection->prepare("SELECT * FROM `bs_comments` WHERE `thread_id` = :threadId");
        $query->execute(array("threadId" => $threadId));

        return $query->rowCount();
    }
} 