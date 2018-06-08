<?php
date_default_timezone_set('Asia/Manila');
include 'connect.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $query = "SELECT * FROM users where userEmail = ?;";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userPass, $userMobile, $userCompany,
            $userLevel);
        $rows = $stmt->fetch();
        $stmt->close();
        if ($rows == 1){
            if (password_verify($_POST['password'], $userPass)){

                $Message = $first_name.' '.$last_name.' has logged in at '.date('Y-m-d H:i:s').' as a '.$_POST['purpose'];
                //include 'sendSMS.php';
                session_start();
                $_SESSION['id'] = session_create_id();
                $_SESSION['user'] = $first_name.' '.$last_name;
                header('Location: ../index.php');
                $mysqli->close();
            }
        }else{
            echo "No user found";
        }

    }else{
        $mysqli->close();
    }


}