
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Calle Uno: Attendance Logger</title>

    <link rel="stylesheet" href="assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/library/font-awesome.min.css">

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
        </div>
    </div>

    <div class="ui wide container" id="body">
        <div class="ui stackable centered two column grid">
            <!-- Form Section -->
            <div class="column">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="loginButton">
                        Login
                    </a>
                    <a class="item" data-tab="logoutButton">
                        Logout
                    </a>
                    <a class="item" data-tab="signupButton">
                        Sign-up
                    </a>
                    <a class="item" data-tab="inquireButton">
                        Inquiry
                    </a>
                </div>

                <?php include_once 'pagefragments/login.html' ?>

                <!-- Logout Form -->
                <?php include_once 'pagefragments/logout.html' ?>

                <!-- Registration Form -->
                <?php include_once 'pagefragments/registration.html' ?>

                <!-- Inquiry Form -->
                <?php include_once 'pagefragments/inquire.html' ?>

            </div>
            <div class="column">
                <h1>Announcements and Events</h1>
                <div id="mixedSlider">
                    <div class="MS-content">
                        <?php
                        require_once 'php/config.php';
                        require_once 'php/functions.php';
                        $events =  getEvents($mysqli);
                        foreach ($events as $event) {
                            echo "
                              <div class='item'>
                              <div class='imgTitle'>
                                  <h2 class='blogTitle'>$event[1]</h2>
                                <img src='data:image;base64," . base64_encode($event[4])."'>
                                </div>
                                <p>$event[2]</p>
                                <a href='' onclick='viewEvent($event[0]); return false' >Read More</a>
                           </div>";
                        }
                        ?>
                    </div>
                    <div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <!-- End of right section (Form Area) -->
        </div> <!-- End of Grid -->

    </div> <!-- End of wide container -->
    <div class="ui fluid inverted segment" id="footer">
        <div class="ui center aligned container">
            <p>&copy; Calle Uno 2018</p>
        </div>
    </div>
</div>
<?php
include_once 'pagefragments/eventView.html';
header('Access-Control-Allow-Headers: x-requested-with');
?>
<!--Scripts-->

<script src="assets/library/jquery.min.js"></script>
<script src="assets/library/jquery.serialize-object.min.js"></script>
<script src="assets/library/sweetalert.min.js"></script>
<script src="assets/library/jquery.form.min.js"></script>
<script src="assets/library/semantic/semantic.min.js"></script>
<script src="assets/library/multislider.js"></script>
<script src="assets/js/script.js"></script>

</body>

</html>
