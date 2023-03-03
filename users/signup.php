<?php
session_start();
require_once '../includes/config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {
   $password = md5($password);
   if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email'")) >= 1) {
      $_SESSION['message'] = 'Користувач з такою поштою вже зареєстрований!';
      header('Location: registration.php');
   } else  if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'")) >= 1) {
      $_SESSION['message'] = 'Користувач з даним юзернеймом і паролем вже існує! Увійдіть в систему';
      header('Location: registration.php');
   } else {
      mysqli_query($connection, "INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `favourite`, `basket`) VALUES (NULL, '$username', '$password', '$email', 'user', NULL, NULL)");
      $_SESSION['message'] = 'Реєстрація пройшла успішно!';
      header('Location: authorization.php');
   }
} else {
   $_SESSION['message'] = 'Паролі не співпадають!';
   header('Location: registration.php');
}
