<?php
session_start();
date_default_timezone_set('Asia/Manila');
include 'admin/php/functions.php';
$mysqli = new mysqli(host, user, password, database);
if ($stmt = $mysqli->prepare("select count(userId) from sessions where sessionOut='0000-00-00 00:00:00';")){
    $stmt->execute();
    $stmt->bind_result($current_users);
    $stmt->fetch();
    $stmt->close();
}
if ($stmt = $mysqli->prepare("select count(userId) from sessions where sessionIn>=NOW();")){
    $stmt->execute();
    $stmt->bind_result($todays_login);
    $stmt->fetch();
    $stmt->close();
}
if ($stmt = $mysqli->prepare("select count(userId) from users;")){
    $stmt->execute();
    $stmt->bind_result($total_users);
    $stmt->fetch();
    $stmt->close();
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
    <title>Calle Uno: Client Logs</title>

    <link rel="stylesheet" href="assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/library/DataTables/datatables.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <script src="assets/library/jquery.min.js"></script>
    <script src="assets/library/DataTables/datatables.js"></script>
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
            <a href="admin.php"><img class="ui small image centered mini" id="logo" src="assets/images/logo.png"></a>
        </div>
        <a class="item active" href="admin.php">
            <i class="block layout icon"></i>
            User Client Logs
        </a>
        <a class="item" href="admin/announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a class="item" href="admin/user-management.php">
            <i class="users icon" ></i>
            User Account<br> Management
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            
            <!-- Header/ Title section -->
            <div class="ui container">
                <div class="ui horizontal divider">User client logs</div>
            </div>
            
            <!-- Three headers -->
            <div class="ui stackable grid">
                <div class="three column row">
                    <!-- First cell -->
                    <div class="column">
                        <div class="ui segment">
                            Number of Current Logged-In Users
                            <h1>
                                <?php echo $current_users?>
                            </h1>
                        </div>
                    </div>
                    <!-- Second cell -->
                    <div class="column">
                        <div class="ui segment">
                            Number of Logins Today
                            <h1>
                                <?php echo $todays_login?>
                            </h1>
                        </div>

                    </div>
                    <!-- Third cell -->
                    <div class="column">
                        <div class="ui segment">
                            Total Accounts Registered
                            <h1>
                                <?php echo $total_users?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <tbody><tr>
                    <td>Minimum age:</td>
                    <td><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Maximum age:</td>
                    <td><input type="text" id="max" name="max"></td>
                </tr>
                </tbody>
            </table>
            <table id="users-log" class="ui striped selectable celled table">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>E-mail Address</th>
                    <th>Mobile Number</th>
                    <th>Organization</th>
                    <th>Time in</th>
                    <th>Time out</th>
                    <th>Purpose</th>
                </tr>
                </thead>
                <tbody>
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
<!--Scripts-->
<script src="assets/library/semantic/semantic.min.js"></script>
<script src="assets/js/admin.js"></script>
<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex) {
            let max = new Date('2018-06-12 16:49:19');
            let min = new Date('2018-06-12 10:00:00');
            var age = new Date(data[5]) || 0; // use data for the age column

            if ( ( isNaN( min ) && isNaN( max ) ) ||
                ( isNaN( min ) && age <= max ) ||
                ( min <= age   && isNaN( max ) ) ||
                ( min <= age   && age <= max ) )
            {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup( function() {
            userlogs.draw();
        } );
    } );
</script>
</body>

</html>
