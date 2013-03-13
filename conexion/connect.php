<?php

require('mysql.php.php');

$mysql = new mysql;
$mysql->server = "localhost";
$mysql->user = "root";
$mysql->pass = "rbbmpj1617";
$mysql->connect();
$mysql->select("dbsiap");
?>
