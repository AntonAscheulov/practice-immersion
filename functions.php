<?php
function get_user_by_email($email){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'SELECT * FROM users WHERE email =:email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function set_flash_message($name, $message){
$_SESSION[$name] = $message;
}

function redirect_to($path){
    header("location: /$path");
    exit();
}

function add_user($email, $name, $last_name, $password){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'INSERT INTO users (email, password, name, last_name) VALUES (:email, :password, :name, :last_name)';

    $statement = $pdo->prepare($sql);
    $statement->execute([
      'email'    => $email,
      'name' => $name,
      'last_name' => $last_name,
      'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    return $pdo->lastInsertId();
}

function display_flash_message($name){
    if (isset($_SESSION[$name])){
        echo  "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}



function authorize($email, $password){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'SELECT * FROM users WHERE email=:email';
    $statement=$pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

if (empty($user) or !password_verify($password,$user['password'])){
    set_flash_message('danger', 'Неверное имя пользователя или пароль');
    redirect_to('page_login.php');
}else
    $_SESSION['user'] = ['id' =>$user['id'], 'role' => $user['role']];
    redirect_to('users.php');
}

function is_authorize(){
    if(isset($_SESSION['user'])){
        return true;
    }return false;
}

function is_not_authorize(){
    return !is_authorize();
}

function get_users(){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'SELECT * FROM users';
    $result = $pdo->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function get_athorizated_user(){
    if (is_authorize()){
        return $_SESSION['user'];
    }return false;
}

function is_admin($user){
if (is_authorize()){
    if ($user['role'] === 'admin'){
        return true;
    }return false;
}
}

function is_equal($user, $current_user){
    if($user['id'] === $current_user['id']){
        return true;
    }return false;
}

function get_status($user){
    if ($user['status'] === 'online'){
        return 'success';
    }elseif ($user['status'] === 'offline'){
        return 'danger';
    }elseif ($user['status'] === 'not_in_place'){
        return 'warning';
    }
}