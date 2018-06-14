<?php
include_once 'connect.php';
function isLoggedIn($userEmail, $mysqli){
    $email = '';
    $users = [];
    //select all currently logged in users
    $query_logged_in = "SELECT userEmail FROM sessions NATURAL JOIN  users where sessionOut = '0000-00-00 00:00:00' AND userEmail = ?";
    if ($stmt = $mysqli->prepare($query_logged_in)){
        $stmt->bind_param('s', $userEmail);
        $stmt->execute();
        $stmt->bind_result($email);
        while($stmt->fetch()){
            $users[] = $email;
        }
        $stmt->close();
    }
    $mysqli->close();
    if (!in_array($email, $users)){
        echo 'true';
    }
}

if (isset($_GET['userEmail'])){
    isLoggedIn($_GET['userEmail'], $mysqli);
}