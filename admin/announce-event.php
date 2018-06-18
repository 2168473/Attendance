<?php
require_once 'php/config.php';
include 'php/functions.php';
if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
    && $_SERVER['PHP_AUTH_USER'] === 'admin'
    && $_SERVER['PHP_AUTH_PW'] === 'verystrongpassword') {
    // User is properly authenticated...
    } else {
    header('WWW-Authenticate: Basic realm="Calle Uno: Secured Site"');
    header('HTTP/1.0 401 Unauthorized');
    exit('Unauthorized access detected');
    }
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
    <a href="../index.php" class="ui right floated dropdown item">
        Admin <i class="dropdown icon"></i>
        <div class="menu" href="../index.php">
            <div class="item" >Logout</div>
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
        <a class="item" href="user-management.php">
            <i class="users icon" ></i>
            User Account <br>Management
        </a>
        <a class="item" href="user-payments.php">
            <i class="users icon" ></i>
            User Payments
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
                $data = getAnnouncements($mysqli);
                foreach ($data as $datum) {
                    echo '<tr>';
                    for ($x = 1; $x < count($datum); $x += 1) {
                        echo "<td>$datum[$x]</td>";
                    }
                    echo "<td><button class='ui positive basic button' onclick='editEvent($datum[0])'>Edit</button>
                            <button class='ui negative basic button' onclick='deleteEvent($datum[0])'>Delete
                            </button>
                            </td>";
                    echo '</tr>';
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6" class="right aligned">
                        <button class="ui button" id="add-event">Add Announcement/Event</button>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php
include 'pagefragments/add-event.html';
include 'pagefragments/edit-event.html';
?>
<!--Scripts-->

<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/library/jquery.form.min.js"></script>
<script src="../assets/library/sweetalert.min.js"></script>
<script src="../assets/js/admin.js"></script>

</body>

</html>
