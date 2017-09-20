<?php

/*
créez une version json de veille-html
*/

include('include/header.php');
require('vendor/autoload.php');
require('prezlist-connect.php');

$sql = "SELECT * FROM presentation";

$data = $conn->fetchAll($sql);
$json = json_encode($data, JSON_PRETTY_PRINT);
echo $json;
