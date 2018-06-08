<?php
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_SESSION['email'];
$developmentMode = true;
$mail = new PHPMailer($developmentMode); // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    if ($developmentMode) {
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );
    }
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'xitle.xitler@gmail.com'; // SMTP username
    $mail->Password = '@Xitle.gmail.com'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to

    //Recipients
    $mail->setFrom('xitle.xitler@gmail.com', 'Xitle');
    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($email); // Name is optional
    // $mail->addReplyTo('zenad.scarlet@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $body = file_get_contents("style.html");
    $body .= "<div id='main_content'>";
    $body .= "
    <h1>Activate Your Account</h1>
    <p>You have registered on our website, click the button to activate your account</p>
    ";
    $body .= "<a class='pure-button pure-button-primary' href='https://xitle.000webhostapp.com/activate?account=" . sha1($email) ."'>Activate my Xitle account</a>";
    $body .= "<p>If you didn't register for an account in our site, please ignore this email</p>";
    $body .= "</div>";

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Xitle Account Activation';
    $mail->Body = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $mail->ClearAllRecipients();
    
    
    echo "<script>location.href = '/registered';</script>";
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}