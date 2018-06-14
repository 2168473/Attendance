<?php
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'logbook');
/**
 * Fetch User Login History from the database
 * @return array which contains username, email, mobile, company, login time, logout time and some notes
 */
function getUserLogs()
{
    $mysqli = new mysqli(host, user, password, database);
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

/**
 * Fetch Users from the database
 * @return array wchich contains the userid, first name, last name, email, mobile, company and the user level
 */
function getUsers()
{
    $mysqli = new mysqli(host, user, password, database);
    $data = [];
    $query = "SELECT userId, first_name, last_name, userEmail, userMobile, userCompany, userLevel from users;";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();

        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany, $userLevel);
        while ($stmt->fetch()) {
            $data[] = array($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany, $userLevel);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}

/**
 * Fetch a user with a given id from the database.
 * @param $id - id of the to be fetched.
 * @return array|string contains the user details in a json format.
 */
function getUser($id)
{
    $mysqli = new mysqli(host, user, password, database);
    $query = "SELECT userId, first_name, last_name, userEmail, userMobile, userCompany, userLevel from users WHERE userId = ?;";
    $data = '';

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany, $userLevel);
        $stmt->fetch();
        $data = array("id"=>$id, "first_name"=>$first_name, "last_name"=>$last_name, "userEmail"=>$userEmail,
            "userMobile"=>$userMobile, "userCompany"=>$userCompany, "userLevel"=>$userLevel);
        $stmt->close();
    }
    $mysqli->close();
    $data = json_encode($data);
    return $data;
}

/**
 * Fetch all announcements or events from the database.
 * @return array contains the announcement details in an array.
 */
function getAnnouncements()
{
    $mysqli = new mysqli(host, user, password, database);
    $data = [];
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

/**
 * Fetch an announcement with a given id
 * @param $id - id of the announcement/event to be fetched.
 * @return array|string contains the announcement details in a json format.
 */
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
        $data = array("eventId" => $eventId, "title" => $title, "content" => $content, "start_date" => $start_date,
            "end_date" => $end_date, "cover_image_name" => $cover_image_name);
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

if (isset($_GET['getUser'])) {
    header('Content-Type: application/json');
    echo getUser($_GET['getUser']);
}