<?php
session_start();
date_default_timezone_set('Asia/Manila');
$Message = $first_name.' '.$last_name.' has logged out at '.date('Y-m-d H:i:s');
include 'sendSMS.php';
session_destroy();