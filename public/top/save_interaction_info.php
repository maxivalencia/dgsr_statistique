<?php

$file = 'user_data.txt';

$click_info = isset($_POST['click_info']) ? $_POST['click_info'] : '';

if ($click_info) {
    file_put_contents($file, "Click Info: $click_info\n", FILE_APPEND);
}

?>