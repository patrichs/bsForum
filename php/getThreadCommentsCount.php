<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->getThreadCommentsCount($_POST["thread_id"]));