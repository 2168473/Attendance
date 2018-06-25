<?php
require_once 'php/config.php';
include 'php/functions.php';
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

    <link rel="stylesheet" href="../assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/library/jquery.min.js"></script>
    <script src="../assets/library/DataTables/datatables.js"></script>
</head>
<body>
<div class="ui menu" id="menu">
    <div class="ui right floated dropdown item">
        Admin <i class="dropdown icon"></i>
        <div class="menu">
            <div class="item" id="change-pass">Change password</div>
            <div class="item" onclick="logout()">Logout</div>
        </div>
    </div>
</div>
<div class="ui bottom attached pusher">
    <div class="ui visible inverted labeled left vertical sidebar menu" id="sidebar">
        <div class="header item">
            <a href="/admin"><img class="ui small image centered mini" id="logo" src="../assets/images/logo.png"></a>
        </div>
        <a class="item" href="/admin">
            <i class="block layout icon"></i>
            Dashboard
        </a>
        <a class="item active" href="userlogs.php">
            <i class="clipboard icon"></i>
            User Logs
        </a>
        <a class="item" href="user-management.php">
            <i class="users icon"></i>
            User Account<br> Management
        </a>
        <a class="item" href="announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a class="item" href="user-payments.php">
            <i class="money icon" ></i>
            User Payments
        </a>
        <a class="item" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
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
                $data = getUserLogs($mysqli);
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
<?php include 'pagefragments/password.html'?>
<!--Scripts-->
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/library/semantic/semantic.min.js"></script>
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
    $.fn.form.settings.rules.oldpass = function (value) {
        let result = false;
        $.ajax({
            async: false,
            url: 'php/functions.php',
            type: "GET",
            data: {
                'old-pass': value
            },
            dataType: "html",
            success: function (data) {
                result = Boolean(data);
            }
        });
        return result;
    };
    $('#password-modal').modal('attach events', '#change-pass', 'show');
    $('#change-pass-form').form({
        fields: {
            'old-pass': {
                identifier: 'old-pass',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Old Password must not be empty'
                    },
                    {
                        type: 'oldpass',
                        prompt: 'Incorrect Password'
                    }
                ]
            },
            'new-pass': {
                identifier: 'new-pass',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'New Password must not be empty'
                    },
                    {
                        type: 'minLength[8]',
                        prompt: 'Very Short Password'
                    }
                ]
            },
            'confirm-pass': {
                identifier: 'confirm-pass',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Confirm password must not be empty'
                    },
                    {
                        type: 'match[new-pass]',
                        prompt: 'Passwords do not match'
                    }
                ]
            }
        }
    }).ajaxForm({
        url: 'php/functions.php',
        serializeForm: true,
        success: function () {
            swal({
                title: "Success!",
                text: "Password Changed!",
                type: "success",
                timer: 2500,
            });
            $('#password-modal').modal('hide');
            $('#change-pass-form').clearForm();
        }
    });
</script>
</body>

</html>
