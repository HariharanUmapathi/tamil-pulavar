<?php
require_once __DIR__."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv =  Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

ini_set('error_log', getenv('ERROR_LOG'));
# use .env file to configure environment 
if (getenv("ENVIRONMENT") === "production") {
    ini_set("display_errors", "0");
    ini_set("log_errors", "1");
} else {
    ini_set("display_errors", "1");
    ini_set("log_errors", "0");
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
}

if (getenv("MAINTAINANCE") === "true") {
    die("We are under maintanance Please connect right after sometimes");
}

$connection = new mysqli(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASS"), getenv("DB_NAME"));
$connection->query("SET NAMES 'utf8'");
