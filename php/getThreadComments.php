<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->getThreadComments($_POST["thread_id"]));