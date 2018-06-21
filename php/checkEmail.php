<?php
require_once 'config.php';

if (isset($_GET['email'])) {
    $email = trim($_GET['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $query = "SELECT userEmail FROM users where userEmail = ?;";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($userEmail);
        $rows = $stmt->fetch();
        $stmt->close();
        if ($rows == 1){
            echo 'true';
        }
    }
    $mysqli->close();
}