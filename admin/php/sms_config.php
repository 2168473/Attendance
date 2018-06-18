<?php
$txt_file    = file_get_contents('../sms_config');
$rows        = explode("\n", $txt_file);
$config = [];
foreach($rows as $row => $data)
{
    $row_data = explode(':', $data);
    $config[trim($row_data[0])]= trim($row_data[1]);
}
