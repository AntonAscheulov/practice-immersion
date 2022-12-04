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

function add_user($email, $password){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';

    $statement = $pdo->prepare($sql);
    $statement->execute([
      'email'    => $email,
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
}
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
    }elseif ($user['status'] === 'not_disturb'){
        return 'danger';
    }elseif ($user['status'] === 'away'){
        return 'warning';
    }
}

function edit_information($name, $last_name, $job_title, $phone, $address, $user_id){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "UPDATE users SET name = :name, last_name = :last_name, job_title = :job_title, phone = :phone, address = :address WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
      'id' => $user_id,
      'name'    => $name,
      'last_name' => $last_name,
      'job_title' => $job_title,
      'phone' => $phone,
      'address'=> $address,
    ]);
}

function set_status($status, $user_id){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "UPDATE users SET status = :status WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
      'id' => $user_id,
      'status' => $status,
    ]);
}

function upload_avatar($avatar, $user_id){
    // проверяем нет ли ававтарки у пользователя и если есть удаляем
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "SELECT * FROM users WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (file_exists($result['avatar'])){
        unlink($result['avatar']);
    }
// загружаем аватарку
    $name = $avatar['name'];
    $tmp_name = $avatar['tmp_name'];
    //получаем расширение файла
    $extension = pathinfo($name);
    //делаем уникальное имя
    $uniqeName = uniqid($name);
    //имя директории для загрузки
    $save_directory = 'uploads/avatars/';
    //формируем путь до файла для загрузки в БД
    $image_path = $save_directory.$uniqeName.'.'.$extension['extension'];
    //загружаем файл в папку
    move_uploaded_file($tmp_name,$image_path);

    $sql = "UPDATE users SET avatar = :avatar WHERE id = $user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
      'avatar' => $image_path,
    ]);
}

function get_avatar($user){
    if ($user['avatar'] === null or !file_exists($user['avatar'])){
        return 'uploads/avatars/avatar.png';
    }return $user['avatar'];
}

function add_social_links($vk, $telegram, $instagram, $user_id){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "UPDATE users SET VK = :VK, telegram = :telegram, instagram =:instagram WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
      'id' => $user_id,
      'VK' => $vk,
      'telegram' => $telegram,
      'instagram' => $instagram,
    ]);
}

function is_not_author(){
    if ($_SESSION['user']['id'] !== $_GET['id']){
        return true;
    }return false;
}

function get_user_by_id($id){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'SELECT * FROM users WHERE id =:id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function is_valid_email($email, $current_email){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = 'SELECT email FROM users WHERE email =:email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user_email = $statement->fetch(PDO::FETCH_ASSOC);


    if ($current_email == $email or empty($user_email)){
        return true;
    }return false;
}

function edit_credentials($user_id, $email, $password){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
      'id' => $user_id,
      'email' => $email,
    ]);
    if (!empty($password)){
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
          'id' => $user_id,
          'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}

function delete_user($user_id){
    $pdo = new PDO('mysql:host=127.0.0.1:3306; dbname=immersion;', 'root', '');
    $sql = "SELECT * FROM users WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (file_exists($result['avatar'])){
        unlink($result['avatar']);
    }

    $sql = "DELETE FROM users WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);
}