<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->postNewComment($_POST["thread_id"], $_POST["comment"], $_POST["created_by"]));