<?php
session_start();
require __DIR__.'/functions.php'; //подключаем файл с функциями

$email = $_POST['email'];
$password = $_POST['password'];

authorize($email,$password);

