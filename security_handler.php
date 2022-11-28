<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

$user_id = $_POST['user_id'];
$current_email = $_POST['current_email'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


// проверка подходит ли емэйл для замены
if (!is_valid_email($email,$current_email)){
    set_flash_message('danger', 'Такой емэйл уже занят!');
    redirect_to('security.php?id='.$user_id);
}

//типо проверка на совпадение введенных паролей
if (strcasecmp($password, $confirm_password) !== 0){
    set_flash_message('danger', 'Введенные пароли не совпадают!');
    redirect_to('security.php?id='.$user_id);
}

// если поле пароля пустое тогда пароль не меняем
edit_credentials($user_id, $email, $password);
set_flash_message('success', 'Профиль успешно обновлен!');
redirect_to('page_profile.php?id='.$user_id);


