<?php
require("class/bsForum.php");

$obj = new bsForum();

echo json_encode($obj->getActiveThreads());