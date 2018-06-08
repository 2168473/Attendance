<?php
include_once"ViaNettSMS.php";
date_default_timezone_set('Asia/Manila');
// Declare variables.
$Username = "vakenme@gmail.com";
$Password = "gheng";
$MsgSender = "63453513902";
$DestinationAddress = "639453513902";

// Create ViaNettSMS object with params $Username and $Password
$ViaNettSMS = new ViaNettSMS($Username, $Password);
$ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
