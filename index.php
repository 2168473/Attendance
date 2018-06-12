<?php
session_start();
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Calle Uno</title>

    <link rel="stylesheet" href="assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container">
    <div class="ui borderless menu" id="header">
        <div class="ui container">
            <a href="">
                <div class="header item">
                    <img class="logo" src="assets/images/logo.png">
                    &nbsp;Calle Uno
                </div>
            </a>
            <div class="ui right floated dropdown item">
                <?php if (isset($_SESSION['id'])) {
                    echo $_SESSION['user'];
                } else {
                    echo 'User';
                } ?>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '<div class="item" id="logoutl">Logout</div>';
                    } else {
                        echo '
                            <div class="item" id="login">Login</div>
                            <div class="item" id="signup">Sign Up</div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ui container" id="body" style="background-color: #f4f4f4">
        <h1>Announcements and Events</h1>
        <div id="mixedSlider">
            <div class="MS-content">
                <?php
                $events = [];
                    require 'php/connect.php';
                    $query = "SELECT title, content, cover_image from events where end_date >= '".date("Y-m-d")."';";
                    if ($stmt = $mysqli->prepare($query)){
                        $stmt->execute();
                        $stmt->bind_result($title, $content, $cover_image);
                        while ($stmt->fetch()){
                            $array = explode('.',$content);
                            $intro = $array[0].'.';
                            $events[] = array($title, $intro, $content, $cover_image);
                        }
                        $stmt->close();
                    }
                    $mysqli->close();
                    foreach ($events as $event){
                        echo "
                            <div class='item'>
                                <div class='imgTitle'>
                                    <h2 class='blogTitle'>$event[0]</h2>
                                    <img src='data:image;base64,".base64_encode($event[3])."'>
                                 </div>
                                    <p>$event[1]</p>
                                    <a href=''>Read More</a>
                            </div>
                        ";
                    }
                ?>
            </div>
            <div class="MS-controls">
                <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="overlay">
            <div class="ui labeled icon vertical menu">
                <a class="item" id="inquire"><i class="mail icon"></i>Inquiry</a>
            </div>
        </div>
    </div>

    <div class="ui right aligned container">
        <a href="https://www.facebook.com/calleunoph"><i class="facebook large icon"></i></a>
        <a href="https://twitter.com/calleunoph"><i class="twitter large icon"></i></a>
        <a href="https://www.instagram.com/calleunoph/"><i class="instagram large icon"></i></a>
    </div>

    <div class="ui inverted segment" id="footer">
        <div class="ui center aligned container">
            <p>&copy; Calle Uno 2018</p>
        </div>

    </div>
</div>

<!--Modals-->
<?php
include 'pagefragments/inquire.html';
include 'pagefragments/registration.html';
include 'pagefragments/login.html';
include 'pagefragments/logout.html';
?>

<!--Scripts-->
<script src="assets/library/jquery.min.js"></script>
<script src="assets/library/semantic/semantic.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/library/multislider.js"></script>
<script>
    $('#mixedSlider').multislider({
        duration: 750,
        interval: 5000
    });
    $('.menu  .ui.dropdown').dropdown({
        on: 'hover'
    });
</script>
</body>

</html>
