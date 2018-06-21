<?php

//Set error reporting
error_reporting(0);
date_default_timezone_set('Asia/Manila');
define('host', 'logbook.calleuno.ph');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    header("HTTP/1.0 500 Internal Server Error");
    die();

}
