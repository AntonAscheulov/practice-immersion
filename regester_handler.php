<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями
$email = $_POST['email'];
$password = $_POST['password'];

$user = get_user_by_email($email);

if (!empty($user)){
set_flash_message('danger', 'Не корректный емэйл');
redirect_to('page_register.php');
}

add_user($password,$email);

set_flash_message('success', 'Вы успешно зарегистрированы!');

redirect_to('page_login.php');