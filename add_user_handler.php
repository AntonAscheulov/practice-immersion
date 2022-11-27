<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями
// данные для добавления основной информации
$email = $_POST['email'];
$password = $_POST['password'];
// данные для добавления дополнительной информации
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];
// данные для добавления статуса пользовалетеля
$status = $_POST['status'];
// данные для добавления аватарки
$avatar = $_FILES['avatar'];
// данные для добавления соц.сетей
$vk = $_POST['VK'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

$user = get_user_by_email($email);

if (!empty($user)){
    set_flash_message('danger', 'Такой пользовалетель уже существует!');
    redirect_to('create_user.php');
}

$user_id = add_user($email, $password);

edit_information($name, $last_name, $job_title, $phone, $address, $user_id);

set_status($status, $user_id);

upload_avatar($avatar, $user_id);

add_social_links($vk, $telegram, $instagram, $user_id);

set_flash_message('success', 'Новый пользователь добавлен успешно!');
redirect_to('users.php');