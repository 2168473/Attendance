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
    <title>Calle Uno: Announcement and Events</title>

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
            User Client Logs
        </a>
        <a class="item active" href="announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a href="user-management.php" class="item">
            <i class="smile icon" ></i>
            User Account <br>Management
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">Announcements/Events</div>
            </div>
            <table id="events" class="ui striped selectable celled table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Cover Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $data = getAnnouncements();
                foreach ($data as $datum) {
                    echo '<tr>';
                    for ($x = 1; $x <count($datum); $x+=1) {
                        echo "<td>$datum[$x]</td>";
                    }
                    echo "<td><button class='ui positive basic button' onclick='edit($datum[0])'>Edit</button>
                            <button class='ui negative basic button' onclick='del($datum[0])'>Delete</button>
                            </td>";
                    echo '</tr>';
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6" class="right aligned">
                        <button class="ui blue button" id="add-event">Add Announcement/Event</button>
                    </th>
                </tr>
                </tfoot>
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
        $.ajax({
            url : 'functions.php',
            data: {'getAnnouncement': id},
            dataType: 'json'
        });
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
