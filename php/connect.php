<?php
error_reporting(0);
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}