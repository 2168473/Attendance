<?php

include_once("ViaNettSMS.php");

function sendSMS($MsgSender, $DestinationAddress, $Message)
{
    $Username = "gmonoten25@gmail.com";
    $Password = "efp0m";

// Create ViaNettSMS object with params $Username and $Password
    $ViaNettSMS = new ViaNettSMS($Username, $Password);
    try {
        $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
    } catch (Exception $e) {
        //Error occured while connecting to server.
        echo $e->getMessage();
    }
}

