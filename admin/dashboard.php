<?php
require_once 'php/sms_config.php';
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
    <title>Calle Uno: User Accounts Management</title>

    <link rel="stylesheet" href="../assets/library/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/library/calendar.min.css">
    <script src="../assets/library/jquery.min.js"></script>
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
            <i class="users icon"></i>
            User Account <br>Management
        </a>
        <a class="item" href="user-payments.php">
            <i class="money icon"></i>
            User Payments
        </a>
<<<<<<< HEAD
        <a class="item" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
        </a>
        <a class="item active" href="dashboard.php">
            <i class="chart pie icon"></i>
            Statistics/Graph
        </a>
=======
        <a class="item active" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
        </a>
>>>>>>> 0e60839a843eae1b9154d12757731411b7b4820d
    </div>
    <div id="content">
        <div class="ui two column grid">
            <div class="row">
                <div class="column">
                    <div class="ui segment">
                        <canvas id="loginCount" height="200"></canvas>
                    </div>
                </div>
                <div class="column">
                    <div class="column">
                        <div class="ui segment">
                            <canvas id="purpose" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <div class="ui segment">
                        <canvas id="payments" height="200"></canvas>
                    </div>
                </div>
                <div class="column"></div>
            </div>
        </div>
    </div>
</div>

<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/library/jquery.form.min.js"></script>
<script src="../assets/library/sweetalert.min.js"></script>
<script src="../assets/library/Chart.bundle.min.js"></script>
<script src="../assets/js/admin.js"></script>
<script>
    $.get("php/functions.php?logins=true", function (value) {
        let labels = [];
        let data = [];
        for (let x = 0; x < value.length; x++) {
            console.log(value[x]);
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
                            labelString: 'Number of Login'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Number of Login'
                }
            }
        });
    });
    $.get('php/functions.php?purpose=true', function (value) {
        let labels = [];
        let logins = [];
        let colors = ['#f44242', '#41a9f4', '#f4cd41', '#41f461'];
        for (let x = 0; x < value.length; x++) {
            console.log(value[x]);
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
                    text: 'Purpose Statistics'
                }
            }
        });
    });

    $.get("php/functions.php?payments=true", function (value) {
        let days = [];
        let payments = [];
        for (let x = 0; x < value.length; x++) {
            console.log(value[x]);
            days.push(value[x].days);
            payments.push(value[x].payments);

        }
        let paymentsCount = document.getElementById("payments");
        new Chart(paymentsCount, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
<<<<<<< HEAD
                    label: 'Amount Collected',
=======
                    label: 'Number of Logins',
>>>>>>> 0e60839a843eae1b9154d12757731411b7b4820d
                    data: payments,
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
