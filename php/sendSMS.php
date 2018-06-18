<?php
include_once"ViaNettSMS.php";
date_default_timezone_set('Asia/Manila');
// Declare variables.
$Username = "gmonoten25@gmail.com";
$Password = "efp0m";
$DestinationAddress = "639951032064";
$MsgSender = "639453513902";

// Create ViaNettSMS object with params $Username and $Password
$ViaNettSMS = new ViaNettSMS($Username, $Password);
$ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
