<?php
define('host', '192.168.1.23');
define('user', 'root');
define('password', '');
define('database', 'logbook');
function getUserLogs()
{
    $mysqli = new mysqli(host, user, password, database);
    $name = "";
    $userEmail = "";
    $userMobile = "";
    $userCompany = "";
    $sessionIn = "";
    $sessionOut = "";
    $sessionNotes = "";
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

function getAnnouncements()
{
    $mysqli = new mysqli(host, user, password, database);
    $data = [];
    $eventId = "";
    $title = "";
    $content = "";
    $start_date = "";
    $end_date = "";
    $cover_image = "";
    $query = "SELECT * FROM events ";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($eventId, $title, $content, $start_date, $end_date, $cover_image, $cover_image_name);
        while ($stmt->fetch()) {
            $data[] = array($eventId, $title, $content, $start_date, $end_date, "<img class='ui small image' src='data:image;base64,"
                . base64_encode
                ($cover_image) . "'>");
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}

function getAnnouncement($id)
{
    $mysqli = new mysqli(host, user, password, database);
    $title = "";
    $content = "";
    $start_date = "";
    $end_date = "";
    $cover_image = "";
    $data = "";
    $query = "SELECT * FROM events WHERE eventId = $id";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($eventId, $title, $content, $start_date, $end_date, $cover_image, $cover_image_name);
        $stmt->fetch();
        $data = array("eventId"=>$eventId, "title"=>$title, "content"=>$content, "start_date"=>$start_date,
            "end_date"=>$end_date, "cover_image_name"=>$cover_image_name);
        $stmt->close();
    }
    $mysqli->close();
    $data = json_encode($data);
    return $data;
}
if (isset($_GET['getAnnouncement'])) {
    header('Content-Type: application/json');
    echo getAnnouncement($_GET['getAnnouncement']);
}

function getUserAccounts()
{
    $mysqli = new mysqli(host, user, password, database);
    $name = "";
    $userEmail = "";
    $userMobile = "";
    $userCompany = "";
    $data = [];
    $query = "SELECT concat(first_name, ' ', last_name) AS name, userEmail, userMobile, userCompany FROM users;";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();

        $stmt->bind_result($name, $userEmail, $userMobile, $userCompany);
        while ($stmt->fetch()) {
            $data[] = array($name, $userEmail, $userMobile, $userCompany);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}