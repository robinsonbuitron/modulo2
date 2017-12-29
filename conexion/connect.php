<?php

require('mysql.php.php');

$mysql = new mysql;
$mysql->server = "localhost";
$mysql->user = "root";
$mysql->pass = "xxxx";
$mysql->connect();
$mysql->select("dbsiap");
?>
