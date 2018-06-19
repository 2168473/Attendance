<?php
require_once 'php/sms_config.php';
include 'php/functions.php';
//if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
//    && $_SERVER['PHP_AUTH_USER'] === 'admin'
//    && $_SERVER['PHP_AUTH_PW'] === 'verystrongpassword') {
//    // User is properly authenticated...
//} else {
//    header('WWW-Authenticate: Basic realm="Calle Uno: Secured Site"');
//    header('HTTP/1.0 401 Unauthorized');
//    exit('Unauthorized access detected');
//}
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
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/library/jquery.min.js"></script>
</head>
<body>
<div class="ui menu" id="menu">
    <div class="ui right floated dropdown item">
        Admin <i class="dropdown icon"></i>
        <div class="menu">
            <div class="item" onclick="logout()">Logout</div>
        </div>
    </div>
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
        <a class="item active" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
        </a>
        <a class="item" href="dashboard.php">
            <i class="chart pie icon"></i>
            Statistics/Graph
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">SMS Configuration</div>
            </div>
            <div class="ui segment">
                <form class="ui form" action="" method="post" id="sms">
                    <div class="field">
                        <div class="ui horizontal divider">SMS</div>
                        <div class="five fields">
                            <div class="field">
                                <label for="ip_address">IP Address</label>
                                <input type="text" id="ip" name="ip_address" value="<?php echo $config['ip address']
                                ?>">
                            </div>
                            <div class="field">
                                <label for="port">Port Number</label>
                                <input type="text" id="port" name="port" value="<?php echo $config['port'] ?>">
                            </div>
                            <div class="field">
                                <label for="number">Phone Number</label>
                                <input type="tel" name="number" value="<?php echo $config['number'] ?>">
                            </div>
                            <div class="field">
                                <label for="number">Token</label>
                                <input type="password" id="token" name="token" value="<?php echo $config ['token'] ?>">
                            </div>
                            <div class="field">
                                <label for="button" style="visibility: hidden;">button</label>
                                <button id="button" class="ui button">Save</button>
                            </div>
                        </div>
                        <div class="ui error message"></div>
                    </div>
                </form>
            </div>

            <div class="ui segment very padded">
                <form class="ui form very padded" action="" method="get" id="sendSMS">
                    <div class="ui horizontal divider">Send SMS</div>
                    <div class="field">
                        <div class="four fields">
                            <div class="field">
                                <label>Recipient Number</label>
                                <div class="ui labeled input">
                                    <input placeholder="Enter mobile number" type="text" name="recipient">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Message:</label>
                        <textarea rows="3" placeholder="Enter message here..." name="message"></textarea>
                    </div>
                    <div class="field">
                        <button class="ui button">Send</button>
                    </div>
                    <div class="ui error message"></div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/jquery.form.min.js"></script>
<script src="../assets/library/sweetalert.min.js"></script>
<script src="../assets/js/admin.js"></script>
</body>

</html>
