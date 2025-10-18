<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set("display_errors","1");
ini_set("log_errors","1");
$connection = new mysqli("172.17.0.1","root","hariharan","tamilpulavar");
$connection->query("SET NAMES 'utf8'");
?>
