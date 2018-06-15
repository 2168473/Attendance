<?php
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'logbook');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$eventId = $_POST['eventId'];
if (isset($_POST['title'])){
    $query = "UPDATE events SET title = ? WHERE eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['title'], $eventId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['content'])){
    $query = "UPDATE events SET content = ? WHERE eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['content'], $eventId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['start_date'])){
    $query = "UPDATE events SET start_date = ? WHERE eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['start_date'], $eventId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_POST['end_date'])){
    $query = "UPDATE events SET end_date = ? WHERE eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('ss', $_POST['end_date'], $eventId);
        $stmt->execute();
        $stmt->close();
    }
}
if (isset($_FILES['cover_image'])){
    $imgData = "";
    mysqli_set_charset($mysqli, 'utf8');
    if ($_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
        if (is_uploaded_file($_FILES['cover_image']['tmp_name'])) {
            $imgData = file_get_contents($_FILES['cover_image']['tmp_name']);
        }
    }
    $query = "UPDATE events SET cover_image = ?, cover_image_name =? WHERE eventId = ?";
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('sss', $imgData, $_POST['cover_image_name'], $eventId);
        $stmt->execute();
        $stmt->close();
        echo 'success';
    }
}
$mysqli->close();
header('Location: ../announce-event.php');