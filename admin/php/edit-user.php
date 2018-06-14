<?php
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$userId = $_POST['userId'];
if (isset($_POST['email'])){
    $query = "UPDATE users SET userEmail = ? WHERE userId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['email'], $userId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['mobile'])){
    $query = "UPDATE users SET userMobile = ? WHERE userId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $mobile = '+63'.$_POST['mobile'];
        $stmt->bind_param('ss', $mobile, $userId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['company'])){
    $query = "UPDATE users SET userCompany = ? WHERE userId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['company'], $userId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['user_level'])){
    $query = "UPDATE users SET userLevel = ? WHERE userId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['user_level'], $userId);
        $stmt->execute();
        $stmt->close();
    }
}
$mysqli->close();
header('Location: ../user-management.php');