<?php
include 'connect.php';

if (isset($_POST['register-btn']) || isset($_POST['company'])) {
    $first_name = trim($_POST['first_name']);
    $first_name = strip_tags($first_name);
    $first_name = htmlspecialchars($first_name);
    $first_name = ucwords(strtolower($first_name));
    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);
    $last_name = ucwords(strtolower($last_name));
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $mobile = trim($_POST['mobile']);
    $mobile = strip_tags($mobile);
    $mobile = '+63' . htmlspecialchars($mobile);
    $company = trim($_POST['company']);
    $company = strip_tags($company);
    $company = htmlspecialchars($company);
    $company = ucwords(strtolower($company));
    $password = $_POST['password'];
    $password = password_hash($password, 1);
    $query = 'INSERT INTO `users` (first_name, last_name, userEmail, userMobile, userCompany, userPass,userLevel) VALUES (?,?,?,?,?,?,1)';
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('ssssss', $first_name, $last_name, $email, $mobile, $company, $password);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
    header('Location: ../index.php');
}
