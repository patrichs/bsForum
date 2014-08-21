<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->postNewThread($_POST["title"], $_POST["description"], $_POST["created_by"]));