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
    <title>Calle Uno: Attendance Logger</title>

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
        </div>
    </div>

    <div class="ui wide container" id="body">
        <div class="ui centered grid">
            <div class="eight wide column" style="background-color: fuschia">
                <h1>Announcements and Events</h1>
                <div id="mixedSlider">
                    <div class="MS-content">
                        <?php
                        $events = [];
                        require 'php/connect.php';
                        $query = "SELECT title, content, cover_image from events where end_date >= '" . date("Y-m-d") . "';";
                        if ($stmt = $mysqli->prepare($query)) {
                            $stmt->execute();
                            $stmt->bind_result($title, $content, $cover_image);
                            while ($stmt->fetch()) {
                                $array = explode('.', $content);
                                $intro = $array[0] . '.';
                                $events[] = array($title, $intro, $content, $cover_image);
                            }
                            $stmt->close();
                        }
                        $mysqli->close();
                        foreach ($events as $event) {
                            echo "
                              <div class='item'>
                              <div class='imgTitle'>
                                  <h2 class='blogTitle'>$event[0]</h2>
                                <img src='data:image;base64," . base64_encode($event[3]) . "'>
                                </div>
                                <p>$event[1]</p>
                                <a href='pagefragments/eventViewer.html'>Read More</a>
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

            <!-- Form Section -->
            <div class="eight wide column">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="loginButton" href="pagefragments/login.html">
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

                <div class="ui bottom attached tab segment active" data-tab="loginButton">
                    <div class="ui compact container">
                        <?php
                            include 'pagefragments/login.html';
                        ?>
                    </div>
                </div>

                <!-- Logout Form -->
                <div class="ui bottom attached tab segment" data-tab="logoutButton">
                    <div class="ui compact container">
                        <?php
                            include 'pagefragments/logout.html';
                        ?>
                    </div>
                </div>

                <!-- Registration Form -->
                <div class="ui bottom attached tab segment" data-tab="signupButton">
                    <div class="ui compact container">
                        <?php
                            include 'pagefragments/registration.html';
                        ?>
                    </div>
                </div>

                <div class="ui bottom attached tab segment" data-tab="inquireButton">
                    <div class="ui compact container">
                        <?php
                            include 'pagefragments/inquire.html';
                        ?>
                    </div>
                </div>
            </div> <!-- End of right section (Form Area) -->
        </div> <!-- End of Grid -->

    </div> <!-- End of wide container -->
    <div class="ui fixed bottom sticky" id="bottom">
        <div class="ui fluid inverted segment" id="footer">
            <div class="ui center aligned container">
                <p>&copy; Calle Uno 2018</p>
            </div>
        </div>
    </div>
</div>

    
    <!--Scripts-->
    <script src="assets/library/jquery.min.js"></script>
    <script src="assets/library/semantic/semantic.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/library/multislider.js"></script>

    <script>
        $('#mixedSlider').multislider({
            duration: 1000,
            interval: 7500
        });
        $('.menu .item')
            .tab()
        ;
        
        $('.tabular.menu .item').tab();
        
        $('.ui.button')
            .on('click', function () {
                $.tab('change tab', 'loginButton');
                $.tab('change tab', 'logoutButton');
                $.tab('change tab', 'signupButton');
            })
        ;
        $('.long.modal')
          .modal('show')
        ;
                
        $('.ui.sticky')
            .sticky({
                context: '#bottom'
            })
        ;
        
        $('.tiny.modal')
          .modal('show')
        ;
    </script>
    
</body>

</html>
