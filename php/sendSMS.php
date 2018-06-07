<?php

include_once("ViaNettSMS.php");

$MsgSender = "63453513902";
$DestinationAddress = "639453513902";
$Message = "Hello World!";

function sendSMS($MsgSender, $DestinationAddress, $Message)
{
    $Username = "gmonoten25@gmail.com";
    $Password = "efp0m";

// Create ViaNettSMS object with params $Username and $Password
    $ViaNettSMS = new ViaNettSMS($Username, $Password);
    try {
        // Send SMS through the HTTP API
        $Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
        // Check result object returned and give response to end user according to success or not.
        if ($Result->Success == true)
            echo $Message = "Message successfully sent!";
        else
            echo $Message = "Error occurred while sending SMS<br />Error code: " . $Result->ErrorCode . "<br />Error message: " . $Result->ErrorMessage;
    } catch (Exception $e) {
        //Error occured while connecting to server.
        echo $Message = $e->getMessage();
    }
}

