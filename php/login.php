<?php
date_default_timezone_set('Asia/Manila');
include 'connect.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $userPayment = 0;
    $reason = trim($_POST['purpose']);
    $reason = strip_tags($reason);
    $reason = htmlspecialchars($reason);
    $query = "SELECT * FROM users where userEmail = ?;";
    $query_log = "INSERT INTO sessions(userId, sessionIn, userPayment, sessionNotes) VALUES(?,CURRENT_TIMESTAMP(),?,?)";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany,
            $userPass,$userLevel);
        $rows = $stmt->fetch();
        $stmt->close();
        if ($rows == 1){
            if (password_verify($_POST['password'], $userPass)){
                $Message = $first_name.' '.$last_name.' has logged in at '.date('Y-m-d H:i:s').' as a '.$_POST['purpose'];
                //include 'sendSMS.php';
                if ($stmt = $mysqli->prepare($query_log)){
                    $stmt->bind_param('sss', $id, $userPayment, $reason);
                    $stmt->execute();
                    $stmt->close();
                    echo "login success";
                }
                session_start();
                $_SESSION['id'] = session_create_id();
                $_SESSION['email'] = $userEmail;
                $_SESSION['user_id'] = $id;
                $_SESSION['user'] = $first_name.' '.$last_name;
                header('Location: ../index.php');
                $mysqli->close();
            }else{
                echo "wrong password";
            }
        }else{
            echo "No user found";
        }

    }else{
        $mysqli->close();
    }
}