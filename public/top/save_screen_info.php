<?php

$file = 'user_data.txt';

$screen_info = isset($_POST['screen_info']) ? $_POST['screen_info'] : '';
$device_info = isset($_POST['device_info']) ? $_POST['device_info'] : '';

if ($screen_info) {
    file_put_contents($file, "Screen Info: $screen_info\n", FILE_APPEND);
}
if ($device_info) {
    file_put_contents($file, "Device Info: $device_info\n", FILE_APPEND);
}

?>
