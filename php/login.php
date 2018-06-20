<?php
require_once 'config.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $reason = trim($_POST['purpose']);
    $reason = strip_tags($reason);
    $reason = htmlspecialchars($reason);
    $query = "SELECT * FROM users where userEmail = ?;";
    $query_log = "INSERT INTO sessions(userId, sessionIn, userPayment, sessionNotes) VALUES(?,CURRENT_TIMESTAMP(),0,?)";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany);
        $rows = $stmt->fetch();
        $stmt->close();
        if ($rows == 1) {
            $Message = $first_name . ' ' . $last_name . ' has logged in at ' . date('Y-m-d H:i:s') . ' as a ' . $_POST['purpose'];
            if ($stmt = $mysqli->prepare($query_log)) {
                $stmt->bind_param('ss', $id, $reason);
                $stmt->execute();
                $stmt->close();
            }
            $mysqli->close();
        }

    } else {
        $mysqli->close();
    }
    $data = ["message"=>$Message, "success"=>true, "reason"=>$reason, "email"=>$email];
    echo json_encode($data);
}