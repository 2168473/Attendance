<!DOCTYPE html>
<html>

<head>
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <!--Styles-->
    <link rel="stylesheet" href="semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
</head>

<body>
<div class="ui stackable two column grid" style="min-height: 102%">
    <div class="column container blue">
        <div class="ui middle aligned center aligned grid">
            <?php include 'pagefragments/login.html' ?>
        </div>
    </div>
    <div class="column container green">
        <div style="margin-top: 1%;">
            <h1 class="ui black header">
                <span class="content">Announcements/Events</span>
            </h1>
            <?php include 'pagefragments/announcements.html'; ?>
        </div>
        <div class="box">
            <h1 class="ui black header">
                <span class="content">Currently Logged in Users</span>
            </h1>
            <?php include 'pagefragments/table.html';?>
        </div>
    </div>

</div>
<!--Modals-->
<?php
include 'pagefragments/registration.html';
include 'pagefragments/inquire.html';
?>
</body>
<script src="js/index.js"></script>
</html>
