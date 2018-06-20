<?php
session_start();

//Set error reporting
error_reporting(0);
date_default_timezone_set('Asia/Manila');
define('host', '192.168.1.14');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    header("HTTP/1.0 500 Internal Server Error");
    die();

}

if (!isset($_SESSION['id'])){
    header('Location: /admin/login.php');
}
