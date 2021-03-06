<?php
require_once 'config.php';


if (isset($_POST['email'])){
    $query = "SELECT `sessionId`, `userId`, `first_name`, `last_name` from users natural join sessions where userEmail = ? order by sessionId desc";
    $query_log = "UPDATE `sessions` SET  `sessionOut` =  CURRENT_TIMESTAMP() WHERE  (`sessions`.`userId` = ?) AND
      (`sessions`.`sessionOut` = 0) ORDER BY `sessionId` DESC LIMIT 1";
    if ($stmt= $mysqli->prepare($query)){
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->bind_result($sessionId, $id, $first_name, $last_name);
        $stmt->fetch();
        $stmt->close();
    }
    if ($stmt = $mysqli->prepare($query_log)){
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
        $Message = $first_name.' '.$last_name.' has logged out at '.date('Y-m-d H:i:s');
        echo json_encode(['sessionId'=>$sessionId,'message'=>$Message, 'success'=> true]);
    }else{
        echo json_encode(['sessionId'=>$sessionId,'message'=>$Message, 'success'=> false]);
    }
    $mysqli->close();
}
if (isset($_GET['sessionId'])){
    $query_log = "UPDATE `sessions` SET  `sessionOut` =  CURRENT_TIMESTAMP() WHERE sessionId = ?";
    if ($stmt = $mysqli->prepare($query_log)){
        $stmt->bind_param('s', $_GET['sessionId']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
}