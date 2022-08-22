<?php

session_start();

ob_start();
date_default_timezone_set('Europe/Istanbul');
set_time_limit(0);
error_reporting(1);
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/html; Charset=UTF-8');


define('MYSQL_HOST', 'localhost');
define('MYSQL_DB', 'kobisi');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');


try {
    $Connect = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
} catch (PDOException $e) {
    exit('hata');
}


define("site_url", "http://dev.kobisi.com/");
define('PATH', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']));


include "loader.php";
include "function.php";
