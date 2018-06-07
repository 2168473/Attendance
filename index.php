<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Calle Uno</title>

    <link rel="stylesheet" href="assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container">
<div class="ui borderless menu" id="header">
    <div class="ui container"><a href="">
            <div class="header item">
                <img class="logo" src="assets/images/logo.png">
                &nbsp;Calle Uno
            </div>
        </a>
        <a class="ui right floated dropdown item" id="dropdown">
            <?php if(isset($_SESSION['id'])){echo $_SESSION['user'];}else {echo 'User';}?> <i class="dropdown icon"></i>
            <div class="menu">
                <?php
                    if (isset($_SESSION['id'])){
                        echo '<div class="item" id="logoutl">Logout</div>';
                    }else{
                        echo '
                            <div class="item" id="login">Login</div>
                            <div class="item" id="signup">Sign Up</div>
                        ';
                    }
                ?>
            </div>
        </a>
    </div>
</div>

<div class="ui container" id="body">
    <h1>Announcements/Events</h1>
    <div id="mixedSlider">
        <div class="MS-content">
            <div class="item">
                <div class="imgTitle">
                    <h2 class="blogTitle">Animals</h2>
                    <img src="https://placeimg.com/500/300/animals" alt=""/>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac tellus ex. Integer eu
                    fringilla nisi. Donec id dapibus mauris, eget dignissim turpis ...</p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <div class="imgTitle">
                    <h2 class="blogTitle">Arch</h2>
                    <img src="https://placeimg.com/500/300/arch" alt=""/>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac tellus ex. Integer eu
                    fringilla nisi. Donec id dapibus mauris, eget dignissim turpis ...</p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <div class="imgTitle">
                    <h2 class="blogTitle">Nature</h2>
                    <img src="https://placeimg.com/500/300/nature" alt=""/>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac tellus ex. Integer eu
                    fringilla nisi. Donec id dapibus mauris, eget dignissim turpis ...</p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <div class="imgTitle">
                    <h2 class="blogTitle">People</h2>
                    <img src="https://placeimg.com/500/300/people" alt=""/>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac tellus ex. Integer eu
                    fringilla nisi. Donec id dapibus mauris, eget dignissim turpis ...</p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <div class="imgTitle">
                    <h2 class="blogTitle">Tech</h2>
                    <img src="https://placeimg.com/500/300/tech" alt=""/>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac tellus ex. Integer eu
                    fringilla nisi. Donec id dapibus mauris, eget dignissim turpis ...</p>
                <a href="#">Read More</a>
            </div>

        </div>
        <div class="MS-controls">
            <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
            <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="overlay">
        <div class="ui labeled icon vertical menu">
            <a class="item" id="inquire"><i class="mail icon"></i>Inquire</a>
        </div>
    </div>
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
<script src="assets/semantic/semantic.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/multislider.js"></script>
<script>
    $('#mixedSlider').multislider({
        duration: 750,
        interval: 5000
    });
</script>
</body>

</html>
