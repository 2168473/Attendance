<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
if (isset($_POST['send'])) {
    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
    $name = ucwords(strtolower($name));
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $subject = trim($_POST['subject']);
    $subject = strip_tags($subject);
    $subject = htmlspecialchars($subject);
    $message = trim($_POST['message']);
    $message = strip_tags($message);
    $message = htmlspecialchars($message);
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use 2SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'vakenme@gmail.com';                 // SMTP username
        $mail->Password = 'passwordkona110;';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('gmonoten25@gmail.com', 'Gaspar Monoten');     // Add a recipient
        $mail->addReplyTo($email, $name);

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ';// $mail->ErrorInfo;
    }
    header('Location: ../index.php');
}