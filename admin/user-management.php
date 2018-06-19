<?php
require_once 'php/config.php';
include 'php/functions.php';
//if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
//    && $_SERVER['PHP_AUTH_USER'] === 'admin'
//    && $_SERVER['PHP_AUTH_PW'] === 'verystrongpassword') {
//    // User is properly authenticated...
//    } else {
//    header('WWW-Authenticate: Basic realm="Calle Uno: Secured Site"');
//    header('HTTP/1.0 401 Unauthorized');
//    exit('Unauthorized access detected');
//    }
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
        <a class="item active" href="user-management.php">
            <i class="users icon" ></i>
            User Account <br>Management
        </a>
        <a class="item" href="user-payments.php">
            <i class="money icon" ></i>
            User Payments
        </a>
        <a class="item" href="configure-sms.php">
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
                    <th>Action</th>
                        
                </tr>
                </thead>
                <tbody>
                <?php
                $data = getUsers($mysqli);
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
?>
<!--Scripts-->
<script src="../assets/library/semantic/semantic.min.js"></script>
<script src="../assets/library/jquery.form.min.js"></script>
<script src="../assets/library/sweetalert.min.js"></script>
<script src="../assets/js/admin.js"></script>

</body>

</html>
