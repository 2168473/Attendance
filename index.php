<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.1/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.1/dist/semantic.min.css">
</head>

<body>
<div class="ui two column grid">
    <div class="column segment blue">
        <?php include 'pagefragments/login.html' ?>
    </div>
    <div class="column segment green">
       
    </div>
</div>
<?php include 'pagefragments/registration.html' ?>
</body>
<script>
    $('.ui.small.modal.register')
        .modal('attach events', '.mini.ui.button.signup', 'show')
    ;
</script>
</html>
