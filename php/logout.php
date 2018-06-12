<?php
include 'connect.php';
session_start();
$name = $_SESSION['user'];
$id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Manila');
$Message = $name.' has logged out at '.date('Y-m-d H:i:s');
if (isset($_GET['logout'])){
    $query_log = "UPDATE `sessions` SET  `sessionOut` =  CURRENT_TIMESTAMP() WHERE  (`sessions`.`userId` =?) AND
      (`sessions`.`sessionOut` = 0) ORDER BY `sessionId` DESC LIMIT 1";
    if ($stmt = $mysqli->prepare($query_log)){
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
}
//include 'sendSMS.php';
session_destroy();