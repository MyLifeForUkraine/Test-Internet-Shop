<?php

session_start();
require_once '../includes/config.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

   $user = mysqli_fetch_assoc($check_user);
   $favourites = [];
   $currentFavourite = '';
   // echo $user['favourite'] . PHP_EOL;
   for ($i = 0; $i < mb_strlen($user['favourite']); $i++) {
      if ($user['favourite'][$i] !== ',') {
         $currentFavourite .= $user['favourite'][$i];
      } else {
         $favourites[] = (int)$currentFavourite;
         $currentFavourite = '';
      }
      // echo $user['favourite'][$i] . PHP_EOL;
      // echo 'asa';
   }
   $basket = [];
   $currentBasket = '';
   $tempBasket = '';
   echo $user['basket'] . '<br>';
   // echo $user['favourite'] . PHP_EOL;
   for ($i = 0; $i < mb_strlen($user['basket']); $i++) {
      if ($user['basket'][$i] !== ',') {
         $currentBasket .= $user['basket'][$i];
      } else {
         echo $currentBasket . '<br>';
         for ($j = 0; $j < mb_strlen($currentBasket); $j++) {
            if ($currentBasket[$j] !== 'x') {
               $tempBasket .= $currentBasket[$j];
               echo $tempBasket . '<br>';
            } else {
               // echo $tempBasket . '<br>';
               $basket[count($basket)][0] = (int)$tempBasket;
               $tempBasket = '';
            }
            if ($j + 1 === mb_strlen($currentBasket)) {
               $basket[count($basket) - 1][1] = (int)$tempBasket;
               $tempBasket = '';
            }
         }
         $currentBasket = '';
         // $basket[] = $currentBasket;
         // $currentBasket = '';
      }
      // echo $user['favourite'][$i] . PHP_EOL;
      // echo 'asa';
   }
   // echo ("<pre>") . $basket .("</pre>")

   echo '<pre>';
   print_r($basket);
   echo '</pre>';
   // print_r($basket);
   // echo gettype($favourites[0]);
   $_SESSION['user'] = [
      "id" => $user['id'],
      "username" => $user['username'],
      "role" => $user['role'],
      'favourites' => $favourites,
      // "password" => $user['password'],
      // "email" => $user['email']
   ];
   $_SESSION['currentFavourites'] = $favourites;
   $_SESSION['currentBasket'] = $basket;

   header('Location: /Test-Internet-Shop/pages/index.php');
} else {
   $_SESSION['message'] = 'Не вірний логін чи пароль';
   header('Location: authorization.php');
}
