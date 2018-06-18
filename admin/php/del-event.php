<?php
require_once 'config.php';
if (isset($_GET['eventId'])){
    $query = 'DELETE FROM `events` WHERE eventId = ?';
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('s', $_GET['eventId']);
        $stmt->execute();
        $stmt->close();
        echo "success";
    }
    $mysqli->close();
    header('Location: announce-event.php');
}