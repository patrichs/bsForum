<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->getThread($_POST["thread_id"]));