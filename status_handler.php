<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

$user_id = $_POST['user_id'];
$status = $_POST['status'];

set_status($status, $user_id);
set_flash_message('success', 'Профиль успешно обновлен!');
redirect_to('page_profile.php?id='.$user_id);