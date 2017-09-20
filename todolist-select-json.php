<?php

require('vendor/autoload.php');
require('todolist-connect.php');

$done = 0;
$sql = "SELECT * FROM todo WHERE done = " . $conn->quote($done);

$data = $conn->fetchAll($sql);
$json = json_encode($data, JSON_PRETTY_PRINT);
echo $json;
