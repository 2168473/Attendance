<?php
date_default_timezone_set('Asia/Manila');
define('host', 'logbook.calleuno.ph');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    header("HTTP/1.0 500 Internal Server Error");
    die();

}

function getUserLogs($mysqli)
{
    $data = [];
    $query = "SELECT concat(first_name, ' ', last_name) AS name, userEmail, userMobile, userCompany, sessionIn, sessionOut,
        sessionNotes FROM users NATURAL JOIN sessions;";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();

        $name = '';
        $userEmail = '';
        $userMobile = '';
        $userCompany = '';
        $sessionIn = '';
        $sessionOut = '';
        $sessionNotes = '';
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
 * @return array which contains the userid, first name, last name, email, mobile, company and the user level
 */
function getUsers($mysqli)
{
    $data = [];
    $query = "SELECT userId, first_name, last_name, userEmail, userMobile, userCompany from users;";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();

        $id = '';
        $first_name = '';
        $last_name = '';
        $userEmail = '';
        $userMobile = '';
        $userCompany = '';
        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany);
        while ($stmt->fetch()) {
            $data[] = array($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $data;
}

function getUserPays($mysqli)
{
    $data = [];
    $query = "SELECT first_name, last_name,DATE_FORMAT(sessionIn, '%M %d, %Y'), userPayment from users NATURAL JOIN sessions WHERE sessionNotes ='Drop-in Coworking'";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $first_name = '';
        $last_name = '';
        $userPayment = '';
        $sessionIn = '';
        $stmt->bind_result($first_name, $last_name, $sessionIn, $userPayment);
        while ($stmt->fetch()) {
            $data[] = array($first_name, $last_name, $sessionIn, $userPayment);
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
function getUser($id, $mysqli)
{
    $query = "SELECT userId, first_name, last_name, userEmail, userMobile, userCompany from users WHERE userId = ?;";
    $data = '';

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $first_name = '';
        $last_name = '';
        $userEmail = '';
        $userMobile = '';
        $userCompany = '';
        $stmt->bind_result($id, $first_name, $last_name, $userEmail, $userMobile, $userCompany);
        $stmt->fetch();
        $data = array("id" => $id, "first_name" => $first_name, "last_name" => $last_name, "userEmail" => $userEmail,
            "userMobile" => $userMobile, "userCompany" => $userCompany);
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
function getAnnouncements($mysqli)
{
    $data = [];
    $query = "SELECT * FROM events ";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $eventId = '';
        $title = '';
        $content = '';
        $start_date = '';
        $end_date = '';
        $cover_image = '';
        $cover_image_name = '';
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
function getAnnouncement($id, $mysqli)
{
    $title = "";
    $content = "";
    $start_date = "";
    $end_date = "";
    $cover_image = "";
    $data = "";
    $query = "SELECT * FROM events WHERE eventId = $id";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $eventId = '';
        $cover_image_name = '';
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

function getPassword()
{
    $password = file_get_contents('../password');
    return $password;
}

if (isset($_GET['getAnnouncement'])) {
    header('Content-Type: application/json');
    echo getAnnouncement($_GET['getAnnouncement'], $mysqli);
}

if (isset($_GET['getUser'])) {
    header('Content-Type: application/json');
    echo getUser($_GET['getUser'], $mysqli);
}
if (isset($_GET['ip_address'])) {
    $ip = $_GET['ip_address'];
    $port = $_GET['port'];
    $number = $_GET['number'];
    $token = $_GET['token'];
    $string = "ip address: $ip\nport: $port\nnumber: $number\ntoken: $token";
    $file = fopen("../../sms_config", "w");
    echo fwrite($file, $string);
    fclose($file);
}

if (isset($_GET['new-pass'])){
    $password = $_GET['new-pass'];
    $password = password_hash($password, 1);
    $file = fopen('../password', 'w');
    echo fwrite($file, $password);
    fclose($file);
}
if (isset($_GET['old-pass'])){
    echo password_verify($_GET['old-pass'],getPassword());
//    if ($_GET['old-pass'] === getPassword()){
//        echo true;
//    }
}

if (isset($_GET['logout'])) {
    session_start();
    echo 'session destroyed';
    session_destroy();
}
if (isset($_GET['admin-user'])) {
    if ($_GET['admin-user'] === 'admin') {
        echo true;
    }
}
if (isset($_GET['admin-password'])) {
    echo password_verify($_GET['admin-password'],getPassword());
//    if ($_GET['admin-password'] === getPassword()) {
//        echo true;
//    }
}

if (isset($_GET['logins'])) {
    $data = [];
    $query = "select count(sessionId), DATE_FORMAT(sessionIn, '%M %e %Y') from sessions group by  DATE_FORMAT(sessionIn, 
'%Y-%m-%d');";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($logins, $days);
        while ($stmt->fetch()) {
            $data[] = array('logins' => $logins, 'days' => $days);
        }
        $stmt->close();
    }
    $mysqli->close();
    header('Content-Type: application/json');
    echo json_encode($data);
}

if (isset($_GET['purpose'])) {
    $data = [];
    $query = "SELECT count(sessionId), sessionNotes FROM sessions GROUP BY sessionNotes;";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($sessionCount, $sessionNote);
        while ($stmt->fetch()) {
            $data[] = array('sessionCount' => $sessionCount, 'sessionNote' => $sessionNote);
        }
        $stmt->close();
    }
    $mysqli->close();
    header('Content-Type: application/json');
    echo json_encode($data);
}

if (isset($_GET['payments'])) {
    $data = [];
    $query = "SELECT sum(userPayment),DATE_FORMAT(sessionIn, '%M %e %Y')days  FROM sessions GROUP BY days;";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($payments, $days);
        while ($stmt->fetch()) {
            $data[] = array('payments' => $payments, 'days' => $days);
        }
        $stmt->close();
    }
    $mysqli->close();
    header('Content-Type: application/json');
    echo json_encode($data);
}

