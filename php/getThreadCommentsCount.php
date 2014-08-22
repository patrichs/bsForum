<?php
require("class/bsForum.php");

$obj = new bsForum();
$commentsCount = ["commentsCount" => $obj->getThreadCommentsCount($_POST["thread_id"])];
echo json_encode($commentsCount);