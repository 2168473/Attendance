<?php
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'logbook');
function getUserLogs(){
    $mysqli = new mysqli(host, user, password, database);
    $name ="";
    $userEmail ="";
    $userMobile ="";
    $userCompany ="";
    $sessionIn ="";
    $sessionOut ="";
    $sessionNotes ="";
    $data = [];
    $query = "SELECT concat(first_name, ' ', last_name) AS name, userEmail, userMobile, userCompany, sessionIn, sessionOut,
        sessionNotes FROM users NATURAL JOIN sessions;";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();

        $stmt->bind_result($name, $userEmail, $userMobile, $userCompany, $sessionIn, $sessionOut, $sessionNotes);
        while ($stmt->fetch()) {
            $data[] = array($name, $userEmail, $userMobile, $userCompany, $sessionIn, $sessionOut, $sessionNotes);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}

function getAnnouncements(){
    $mysqli = new mysqli(host, user, password, database);
    $data = [];
    $eventId = "";
    $title = "";
    $content = "";
    $start_date = "";
    $end_date = "";
    $cover_image ="";
    $query = "SELECT * FROM events ";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->execute();
        $stmt->bind_result($eventId, $title, $content, $start_date, $end_date, $cover_image);
        while ($stmt->fetch()){
            $data[] = array($title, $content, $start_date, $end_date,  "<img class='ui small image' src='data:image;base64,"
                .base64_encode
                ($cover_image)."'>");
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}