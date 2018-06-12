<?php
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
require '../php/connect.php';
if (isset($_POST['title'])) {
    try {
        addEvent($mysqli);
        header("Location: announce-event.php");
    } catch (Exception $e) {
        echo $e->getMessage();
        echo 'Sorry, could not upload file';
    }
}


function addEvent($mysqli)
{
    $title = trim($_POST['title']);
    $title = strip_tags($title);
    $title = htmlspecialchars($title);
    $content = trim($_POST['content']);
    $content = strip_tags($content);
    $content = htmlspecialchars($content);
    $start_date = trim($_POST['start_date']);
    $start_date = strip_tags($start_date);
    $start_date = htmlspecialchars($start_date);
    $end_date = trim($_POST['end_date']);
    $end_date = strip_tags($end_date);
    $end_date = htmlspecialchars($end_date);
    $cover_image_name = trim($_POST['cover_image_name']);
    $cover_image_name = strip_tags($cover_image_name);
    $cover_image_name = htmlspecialchars($cover_image_name);
    
    $query = "INSERT INTO `events` (`title`, `content`, `start_date`, `end_date`, `cover_image`, `cover_image_name`) VALUES (?,?,?,?,?,?);";
    $imgData = "";
    mysqli_set_charset($mysqli, 'utf8');
    if ($_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
        if (is_uploaded_file($_FILES['cover_image']['tmp_name'])) {
            $imgData = file_get_contents($_FILES['cover_image']['tmp_name']);
        }
    }
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('sssss', $title, $content, $start_date, $end_date, $imgData, $cover_image_name);
        $stmt->execute();
        $stmt->close();
        echo "Success";
    }
    $mysqli->close();
}
