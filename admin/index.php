<?php
require_once 'php/config.php'
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Calle Uno: Dashboard</title>

    <link rel="stylesheet" href="../assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/library/jquery.min.js"></script>
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
        <a class="item active" href="/admin">
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
        <a class="item" href="announce-event.php">
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
        <div class="ui tablet stackable two column grid">
            <div class="column">
                <div class="ui segment">
                    <canvas id="loginCount" height="200"></canvas>
                </div>
            </div>
            <div class="column">
                <div class="ui segment">
                    <canvas id="purpose" height="200"></canvas>
                </div>
            </div>
            <div class="column">
                <div class="ui segment">
                    <canvas id="payments" height="200"></canvas>
                </div>
            </div>
            <div class="column"></div>
        </div>
    </div>
</div>
<?php include 'pagefragments/password.html'?>
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/Chart.bundle.min.js"></script>
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
    $.get("php/functions.php?logins=true", function (value) {
        let labels = [];
        let data = [];
        for (let x = 0; x < value.length; x++) {
            labels.push(value[x].days);
            data.push(value[x].logins);
        }
        let loginCount = document.getElementById("loginCount");
        new Chart(loginCount, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Logins',
                    data: data,
                    borderColor: '#41A9F4',
                }],
                borderWidth: 1
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Login Count'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Daily Login'
                }
            }
        });
    });
    $.get('php/functions.php?purpose=true', function (value) {
        let labels = [];
        let logins = [];
        let colors = ['#f44242', '#41a9f4', '#f4cd41', '#41f461'];
        for (let x = 0; x < value.length; x++) {
            logins.push(value[x].sessionCount);
            labels.push(value[x].sessionNote);
        }
        let purposeCount = document.getElementById("purpose");
        new Chart(purposeCount, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Logins',
                    data: logins,
                    backgroundColor: colors,
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'index'
                },
                title: {
                    display: true,
                    text: 'Total Logins (Type of Members)'
                }
            }
        });
    });

    $.get("php/functions.php?payments=true", function (value) {
        let days = [];
        let payments = [];
        for (let x = 0; x < value.length; x++) {
            days.push(value[x].days);
            payments.push(value[x].payments);

        }
        let paymentsCount = document.getElementById("payments");
        new Chart(paymentsCount, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: 'Amount Collected',
                    data: payments,
                }],
                borderWidth: 1
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Amount'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Payments'
                }
            }
        });
    });
</script>
</body>

</html>
