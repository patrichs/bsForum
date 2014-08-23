<?php
require("class/bsForum.php");

$obj = new bsForum();

if ($output = $obj->postNewComment($_POST["thread_id"], $_POST["comment"], $_POST["created_by"], $_POST["response_to"]))
{
    $obj->updateCommentCounter($_POST["thread_id"]);
    echo json_encode($output);
}
else
{
    echo json_encode($output);
}