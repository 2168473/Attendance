<?php
require_once 'php/config.php';
include 'php/functions.php';
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
    <link rel="stylesheet" href="../assets/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/library/calendar.min.css">
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
            <a href="/admin"><img class="ui small image centered mini" id="logo"
                                       src="../assets/images/logo.png"></a>
        </div>
        <a class="item" href="/admin">
            <i class="block layout icon"></i>
            Dashboard
        </a>
        <a class="item" href="userlogs.php">
            <i class="clipboard icon"></i>
            User Logs
        </a>
        <a class="item" href="user-management.php">
            <i class="users icon"></i>
            User Account <br>Management
        </a>
        <a class="item active" href="announce-event.php">
            <i class="newspaper outline icon"></i>
            Announcements<br>/Events
        </a>
        <a class="item" href="user-payments.php">
            <i class="money icon"></i>
            User Payments
        </a>
        <a class="item" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
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
            </table>
        </div>
    </div>
</div>
<?php
include 'pagefragments/add-event.html';
include 'pagefragments/edit-event.html';
include 'pagefragments/password.html';
?>
<!--Scripts-->

<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/library/jquery.form.min.js"></script>
<script src="../assets/library/sweetalert.min.js"></script>
<script src="../assets/js/admin.js"></script>
<script>
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
