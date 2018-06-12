<?php
session_start();
date_default_timezone_set('Asia/Manila');
include 'functions.php';
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

    <link rel="stylesheet" href="../assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/library/calendar.min.css">
    <script src="../assets/library/jquery.min.js"></script>
    <script src="../assets/library/DataTables/datatables.js"></script>
</head>
<body>
<div class="ui menu" id="menu">
    <a href="#" class="ui right floated dropdown item">
        Admin <i class="dropdown icon"></i>
        <div class="menu">
            <div class="item">Logout</div>
            
        </div>
    </a>
</div>
<div class="ui bottom attached pusher">
    <div class="ui visible inverted labeled left vertical sidebar menu" id="sidebar">
        <div class="header item">
            <a href="../admin.php"><img class="ui small image centered mini" id="logo" src="../assets/images/logo.png"></a>
        </div>
        <a class="item" href="../admin.php">
            <i class="block layout icon"></i>
            Client logs
        </a>
        <a class="item" href="announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a class="item active" href="user-management.php">
            <i class="smile icon" ></i>
            Users <br>Management
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">Edit/Delete User Account</div>
            </div>
            <table id="users" class="ui striped selectable celled table">
                <thead>
                <tr>
                    <th></th>
                    <th>Full Name</th>
                    <th>E-mail Address</th>
                    <th>Mobile Number</th>
                    <th>Organization</th>
                    <th>Purpose</th>
                </tr>
                </thead>
                <tbody>
                    <td class="ui fitted checkbox"></td>
                <?php
                $data = getUserLogs();
                foreach ($data as $datum) {
                    echo '<tr>';
                    foreach ($datum as $item) {
                        echo "<td>$item</td>";
                    }
                    echo '</tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    include 'add-event.html';
    include 'edit-event.html';
?>
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/js/admin.js"></script>
<script>
    function edit(id) {
        $('#edit-event-modal')
            .modal('show')
        ;
    }
    function del(id) {
        alert('delete ' + id);
    }
</script>
</body>

</html>
