<?php
require_once 'php/sms_config.php';
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
    <title>Calle Uno | SMS Configuratioin</title>

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
        <a class="item active" href="configure-sms.php">
            <i class="mobile icon"></i>
            SMS Configuration
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">SMS Configuration</div>
            </div>
            <div class="ui segment">
                <form class="ui form" id="sms">
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
                <form class="ui form very padded" id="sendSMS">
                    <div class="ui horizontal divider">Send SMS</div>
                    <div class="field">
                        <div class="four fields">
                            <div class="field">
                                <label>Recipient Number</label>
                                <div class="ui labeled input">
                                    <input placeholder="Enter mobile number" type="text" id="num" name="number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Message:</label>
                        <textarea rows="3" placeholder="Enter message here..." id="mes" name="message"></textarea>
                    </div>
                    <button class="ui button">Send</button>
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
<script>

    $.fn.form.settings.rules.ip_address = function (value) {
        let expression = /((^\s*((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))\s*$)|(^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$))/;
        return expression.test(value);
    };
    $('#sendSMS').form({
        fields: {
            number: ['empty', 'integer', 'minLength[7]', 'maxLength[11]'],
            message: ['empty']
        }
    }).ajaxForm({
        url: 'http://' + $('#ip').val() + ':' + $('#port').val() + '/',
        method: 'post',
        data: {
            token: $('#token').val(),
        },
        complete: function () {
            swal({
                title: "Success!",
                text: "Message Sent",
                icon: "success",
                timer: 2500,
            });
            $('#num').val('');
            $('#mes').val('');
        }
    });
    $("#sms").form({
        fields: {
            ip_address: ['ip_address', 'empty'],
            port: ['empty', 'integer'],
            number: ['empty', 'integer', 'minLength[7]', 'maxLength[11]'],
        }
    }).ajaxForm({
        url: 'php/functions.php',
        method: 'post',
        success: function () {
            swal({
                title: "Success!",
                text: "Changes have been saved!",
                icon: "success",
                timer: 2500,
                button: false
            });
        }
    });

</script>
</body>

</html>
