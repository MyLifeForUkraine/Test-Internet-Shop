<?php
session_start();
require_once '../includes/config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {
   $password = md5($password);

   mysqli_query($connection, "INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `favourite`, `basket`) VALUES (NULL, '$username', '$password', '$email', 'role', NULL, NULL)");

   $_SESSION['message'] = 'Реєстрація пройшла успішно!';
   header('Location: authorization.php');
} else {
   $_SESSION['message'] = 'Паролі не співпадають!';
   header('Location: registration.php');
}
