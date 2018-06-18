<?php
require_once 'config.php';
if (isset($_GET['userId'])){
    $query = 'DELETE FROM `users` WHERE userId = ?';
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $_GET['userId']);
        $stmt->execute();
        $stmt->close();
        echo "success";
    }
    $mysqli->close();
    header('Location: user-management.php');
}