<?php

session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

if (is_not_authorize()) {
    redirect_to('page_login.php');
}

if ( ! is_admin(get_athorizated_user()) and is_not_author()) {
    set_flash_message('danger', 'Можно удалить только свой профиль!');
    redirect_to('users.php');
}

$user_id = $_GET['id'];

$user = get_user_by_id($user_id);

delete_user($user_id);

if (is_equal($user, get_athorizated_user())) {
    unset($_SESSION['user']);
    session_destroy();
    redirect_to('page_register.php');
}else{
    set_flash_message('success', 'Пользователь успешно удален!');
    redirect_to('users.php');
}
