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
        return 'true';
    }
}

if (isset($_GET['userEmail'])){
    echo isLoggedIn($_GET['userEmail'], $mysqli);
}

if (isset($_GET['eventId'])){
    $query = "SELECT title, content, cover_image from events where eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $_GET['eventId']);
        $stmt->execute();
        $stmt->bind_result($title, $content, $cover_image);
        $stmt->fetch();
        $cover_image = "data:image;base64,".base64_encode($cover_image);
        $data = array('title'=>$title, 'content'=>$content, 'cover_image'=>$cover_image);
        $data = json_encode($data);
        $stmt->close();
    }
    $mysqli->close();
    echo $data;
}