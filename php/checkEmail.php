<?php
include 'connect.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $query = "SELECT userEmail, userPass FROM users where userEmail = ?;";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($userEmail, $userPass);
        $rows = $stmt->fetch();
        $stmt->close();
        $mysqli->close();
        if ($rows == 1){
            echo 'true';
        }else{
            echo 'false';
        }
    }
}