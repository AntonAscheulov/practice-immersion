<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

$user_id = $_POST['user_id'];
$avatar = $_FILES['avatar'];

upload_avatar($avatar, $user_id);
set_flash_message('success', 'Профиль успешно обновлен!');
redirect_to('page_profile.php?id='.$user_id);