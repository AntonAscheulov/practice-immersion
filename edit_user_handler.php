<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

// данные для добавления дополнительной информации
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];

edit_information($name, $last_name, $job_title, $phone, $address, $user_id);

set_flash_message('success', 'Профиль успешно обновлен!');

redirect_to('users.php');
