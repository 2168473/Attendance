<?php
session_start();
date_default_timezone_set('Asia/Manila');
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
    <title>Calle Uno: User Accounts Management</title>

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
        <a class="item active" href="user-management.php">
            <i class="users icon" ></i>
            User Account <br>Management
        </a>
    </div>
    <div id="content">
        <div class="ui basic">
            <div class="ui container">
                <div class="ui horizontal divider">Edit/Delete User Account</div>
            </div>
            <table id="users" class="ui striped selectable celled table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail Address</th>
                    <th>Mobile Number</th>
                    <th>Organization</th>
                    <th>Level</th>
                    <th>Action</th>
                        
                </tr>
                </thead>
                <tbody>
                <?php
                $data = getUsers();
                foreach ($data as $datum) {
                    echo '<tr>';
                    for ($x = 1; $x < count($datum); $x++) {
                        echo "<td>$datum[$x]</td>";
                    }
                    echo "<td><button class='ui positive basic button' onclick='editUser($datum[0])'>Edit</button>
                            <button class='ui negative basic button' onclick='deleteUser($datum[0])'>Delete
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
    include 'pagefragments/edit-user.html';
    include 'pagefragments/delete-user.html';
?>
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/calendar.min.js"></script>
<script src="../assets/js/admin.js"></script>
<script>

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
    function deleteUser(id) {
        $.get("php/functions.php?getUser=" + id, function (data) {
            document.getElementById('user_name').innerHTML = data['first_name'] + ' ' + data['last_name'];
            document.getElementById('userName').innerHTML = data['first_name'] + ' ' + data['last_name'];
        });
        $('#del-user')
            .modal({
                closable: false,
                onDeny: function () {
                    return true;
                },
                onApprove: function () {
                    $.ajax({
                        url: 'php/del-user.php?userId='+id,
                        beforeSend: function () {
                            $('#success-del-user').modal({
                                onDeny: function () {
                                    window.location = '/admin/user-management.php';
                                }
                            }).modal('show');
                        }
                    });

                }
            })
            .modal('show')
        ;
    }
    </script>
</body>

</html>
