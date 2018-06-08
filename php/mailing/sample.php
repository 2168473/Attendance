<?php
$body = file_get_contents("style.html");
$body .= "<div id='main_content'>";
$body .= file_get_contents("content.html");
$body .= "<a class='pure-button pure-button-primary' href='#" . "'>Activate my Xitle account</a>";
$body .= "<p>If you didn't register for an account in our site, please ignore this email</p>";
$body .= "</div>";

echo $body;