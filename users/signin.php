<?php

session_start();
require_once '../includes/config.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

   $user = mysqli_fetch_assoc($check_user);

   $_SESSION['user'] = [
      "id" => $user['id'],
      "username" => $user['username'],
      // "password" => $user['password'],
      // "email" => $user['email']
   ];

   header('Location: /Test-Internet-Shop/pages/index.php');
} else {
   $_SESSION['message'] = 'Не вірний логін чи пароль';
   header('Location: authorization.php');
}
