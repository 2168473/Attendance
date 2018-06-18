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
    exit('Unauthorized access detected.');
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
    <title>Calle Uno: User Payment Management</title>

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
        <a class="item" href="announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a class="item" href="user-management.php">
            <i class="users icon" ></i>
            User Account <br>Management
        </a>
        <a class="item active" href="user-payments.php">
            <i class="users icon" ></i>
            User Payments
        </a>
    </div>
    <div id="content">
        
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">Payments</div>
            </div>
            
            
            <table id="payments" class="ui striped selectable celled table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Payments Made</th>
                        
                </tr>
                </thead>
                <tbody>
                <?php
                $data = getUserPayments($mysqli);
                foreach ($data as $datum) {
                    echo '<tr>';
                    for ($x = 0; $x < count($datum); $x++) {
                        echo "<td>$datum[$x]</td>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
    
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/js/admin.js"></script>
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
    
    
    function editUser(id) {
        $.get("php/functions.php?getUser=" + id, function (data) {
            $('#first_name').val(data['first_name']);
            $('#last_name').val(data['last_name']);
            $('#email').val(data['userEmail']);
            $('#mobile').val(String(data['userMobile']).substring(3));
            $('#company').val(data['userCompany']);
            $('#user_level').val(data['userLevel']);
            $('#userId').val(id);
            $('#edit-user-modal')
                .modal('show')
            ;
        });

    }
    </script>
</body>

</html>
