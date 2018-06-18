<?php
require_once 'config.php';

if (isset($_GET['userEmail'])) {
    $email = '';
    $users = [];
    //select all currently logged in users
    $query_logged_in = "SELECT userEmail FROM sessions NATURAL JOIN  users where sessionOut = '0000-00-00 00:00:00'";
    if ($stmt = $mysqli->prepare($query_logged_in)) {
        $stmt->execute();
        $stmt->bind_result($email);
        while ($stmt->fetch()) {
            $users[] = $email;
           // echo $email;
        }
        $stmt->close();
    }
    $mysqli->close();
    if (!in_array($email, $users)) {
        echo 'true';
    }
}

if (isset($_GET['eventId'])) {
    $query = "SELECT title, content, cover_image from events where eventId = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $_GET['eventId']);
        $stmt->execute();
        $stmt->bind_result($title, $content, $cover_image);
        $stmt->fetch();
        $cover_image = "data:image;base64," . base64_encode($cover_image);
        $data = array('title' => $title, 'content' => $content, 'cover_image' => $cover_image);
        $data = json_encode($data);
        $stmt->close();
    }
    $mysqli->close();
    header("Content-Type: application/json");
    echo $data;
}
if (isset($_GET['user_email'])){
    $query = "SELECT sessionNotes, sessionId FROM sessions NATURAL JOIN  users WHERE userEmail = ? AND sessionOut = '0000-00-00 00:00:00';";
    $purpose = '';
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s',$_GET['user_email']);
        $stmt->execute();
        $stmt->bind_result($purpose, $sessionId);
        $stmt->fetch();
        $stmt->close();
    }
    if ($purpose == 'Drop-in Coworking'){
        header('Content-Type: application/json');
        echo json_encode(['Drop-in Coworking'=>true, 'sessionId'=>$sessionId]);
    }else{
        header('Content-Type: application/json');
        echo json_encode(['Drop-in Coworking'=>false, 'sessionId'=>$sessionId]);
    }
    $mysqli->close();
}

if (isset($_GET['payment']) && isset($_GET['sessionId'])){

    $query = "UPDATE sessions SET userPayment = ? WHERE  sessionId = ?";
    $purpose = '';
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss',$_GET['payment'],$_GET['sessionId']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
}
function get_words($sentence, $count = 10) {
    return implode(' ', array_slice(explode(' ', $sentence), 0, $count));
}
function getEvents($mysqli) {
    $query = "SELECT eventId, title, content, cover_image FROM events WHERE end_date >= '" . date
        ("Y-m-d") . "' AND start_date <= '" . date("Y-m-d") . "'";
    $events = [];
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $eventId ='';
        $title ='';
        $content ='';
        $cover_image ='';

        $stmt->bind_result($eventId, $title, $content, $cover_image);
        while ($stmt->fetch()) {
            $intro = get_words($content,25).'...';
            $events[] = array($eventId, $title, $intro, $content, $cover_image);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $events;
}