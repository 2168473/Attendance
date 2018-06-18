<?php
session_start();
date_default_timezone_set('Asia/Manila');
include 'admin/php/functions.php';
$mysqli = new mysqli(host, user, password, database);
if ($stmt = $mysqli->prepare("select count(userId) from sessions where sessionOut='0000-00-00 00:00:00';")) {
    $stmt->execute();
    $stmt->bind_result($current_users);
    $stmt->fetch();
    $stmt->close();
}
if ($stmt = $mysqli->prepare("select count(userId) from sessions where sessionIn>=CURDATE();")) {
    $stmt->execute();
    $stmt->bind_result($todays_login);
    $stmt->fetch();
    $stmt->close();
}
if ($stmt = $mysqli->prepare("select count(userId) from users;")) {
    $stmt->execute();
    $stmt->bind_result($total_users);
    $stmt->fetch();
    $stmt->close();
}

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
    <div class="ui right floated dropdown item">
        Admin <i class="dropdown icon"></i>
        <div class="menu">
            <a class="item" href="index.php">Logout</a>
        </div>
    </div>
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
            <i class="users icon"></i>
            User Account<br> Management
        </a>
        <a class="item" href="admin/user-payments.php">
            <i class="users icon" ></i>
            User Payments
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
                                <?php echo $current_users ?>
                            </h1>
                        </div>
                    </div>
                    <!-- Second cell -->
                    <div class="column">
                        <div class="ui segment">
                            Number of Logins Today
                            <h1>
                                <?php echo $todays_login ?>
                            </h1>
                        </div>

                    </div>
                    <!-- Third cell -->
                    <div class="column">
                        <div class="ui segment">
                            Total Accounts Registered
                            <h1>
                                <?php echo $total_users ?>
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="ui form">
                <div class="two fields">
                    <div class="two fields">
                        <div class="field">
                            <label>Start date</label>
                            <div class="ui calendar" id="min_date">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" id="min" placeholder="Start">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>End date</label>
                            <div class="ui calendar" id="max_date">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" id="max" placeholder="End">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="users-log" class="ui striped celled table">
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
<script src="assets/library/calendar.min.js"></script>
<script src="assets/library/semantic/semantic.min.js"></script>
<script src="assets/js/admin.js"></script>
<script>
    $.fn.dataTable.ext.search.push(
        function (settings, data) {
            let min = new Date($('#min').val()+ ' 00:00:00');
            let max = new Date($('#max').val()+ ' 23:59:59');
            let date = new Date(data[5]); // use data for the age column
            console.log('min: ' + min);
            console.log('max: ' + min);
            return (isNaN(min) && isNaN(max)) ||
                (isNaN(min) && date <= max) ||
                (min <= date && isNaN(max)) ||
                (min <= date && date <= max);

        }
    );

    let table = $('#users-log').DataTable();

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        table.draw();
    });
    $('#min_date').calendar({
        type: 'date',
        endCalendar: $('#max_date'),
        formatter: {
            date: function (date) {
                if (!date) return '';
                let day = date.getDate() + '';
                if (day.length < 2) {
                    day = '0' + day;
                }
                let month = (date.getMonth() + 1) + '';
                if (month.length < 2) {
                    month = '0' + month;
                }
                let year = date.getFullYear();
                return year + '-' + month + '-' + day;
            }
        },
        onHide: function () {
            $('#users-log').DataTable().draw();
        }

    });
    $('#max_date').calendar({
        type: 'date',
        startCalendar: $('#min_date'),
        formatter: {
            date: function (date) {
                if (!date) return '';
                let day = date.getDate() + '';
                if (day.length < 2) {
                    day = '0' + day;
                }
                let month = (date.getMonth() + 1) + '';
                if (month.length < 2) {
                    month = '0' + month;
                }
                let year = date.getFullYear();
                return year + '-' + month + '-' + day;
            }
        },
        onHide: function () {
            $('#users-log').DataTable().draw();
        }
    });
</script>
</body>

</html>
