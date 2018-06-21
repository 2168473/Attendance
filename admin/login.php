<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
        $_SESSION['id'] = session_create_id();
        echo $_SESSION['id'];
        header('Location: /admin');
    }
    if (isset($_SESSION['id'])){
        header('Location: /admin');
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
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style type="text/css">
        body {
            background-color: #e6f1ff;
        }
        body > .grid {
            height: 100%;
        }

        .image {
            margin-top: -100px;
        }

        .column {
            max-width: 450px;
        }
    </style>
    <script src="../assets/library/jquery.min.js"></script>
    <script src="../assets/library/semantic/semantic.min.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script>
        $.fn.form.settings.rules.admin = function (value) {
            let result = true;
            $.ajax({
                async: false,
                url: 'php/functions',
                type: "get",
                data: {
                    "admin-user": value,
                },
                dataType: "html",
                success: function (data) {
                    result = Boolean(data);
                }
            });
            return result;
        };
        $.fn.form.settings.rules.admin_password = function (value) {
            let result = true;
            $.ajax({
                async: false,
                url: 'php/functions',
                type: "get",
                data: {
                    "admin-password": value,
                },
                dataType: "html",
                success: function (data) {
                    result = Boolean(data);
                }
            });
            return result;
        };
        $(document)
            .ready(function () {
                $('.ui.form')
                    .form({
                        fields: {
                            username: {
                                identifier: 'username',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your Username'
                                    },
                                    {
                                        type: 'admin',
                                        prompt: 'Incorrect Username!'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your password'
                                    },
                                    {
                                        type: 'admin_password',
                                        prompt: 'Incorrect Password!'
                                    }
                                ]
                            }
                        }
                    })
                ;
            })
        ;
    </script>
</head>
<body>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <img src="../assets/images/logo.png" class="ui small centered image">
        <div class="ui segment">
            <form class="ui large form" action="" method="post">
                <h2 class="ui image header">
                    Log-in to your account
                </h2>
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="ui fluid large submit button">Login</div>
                </div>

                <div class="ui error message"></div>

            </form>
        </div>
    </div>
</div>
</body>

</html>
