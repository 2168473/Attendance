<?php
include 'php/config.php';
$data = [];
$query = "SELECT concat(first_name, ' ', last_name) AS name, userEmail, userMobile, userCompany, sessionIn, sessionOut,
        sessionNotes FROM users NATURAL JOIN sessions where sessionOut = '0000-00-00 00:00:00';";
if ($stmt = $mysqli->prepare($query)) {
    $stmt->execute();

    $name ='';
    $userEmail ='';
    $userMobile ='';
    $userCompany ='';
    $sessionIn ='';
    $sessionOut ='';
    $sessionNotes ='';
    $stmt->bind_result($name, $userEmail, $userMobile, $userCompany, $sessionIn, $sessionOut, $sessionNotes);
    while ($stmt->fetch()) {
        $data[] = array($name, $userEmail, $userMobile, $userCompany, $sessionIn, $sessionOut, $sessionNotes);
    }
    $stmt->close();
}
$mysqli->close();
?>

<html>
<head></head>
<body>
<h1>Time: <span id="time"></span></h1>
<ul>
    <?php
    foreach ($data as $datum){
        echo "<li>";
        foreach ($datum as $item){
            echo "$item".',';
        }
        echo "</li>";
    }
    ?>
</ul>
<p>Click the button to wait 3 seconds, then alert "Hello".</p>
<p>After clicking away the alert box, an new alert box will appear in 3 seconds. This goes on forever...</p>
<button onclick="myFunction(35)">Try it</button>
<script src="assets/library/jquery.min.js"></script>
<script>
    function myFunction(sessionId) {
        setInterval(function(sessionId){
            $.get('php/functions.php?sessionId=' + 35, function (data) {
                alert(data.sessionOut);
            });
        }, 3000);
    }
</script>
</body>
</html>