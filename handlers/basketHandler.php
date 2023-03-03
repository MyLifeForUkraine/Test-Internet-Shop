<?php
session_start();
require '../includes/config.php';

$id = $_POST['id'];
// echo $id;
// print_r($_SESSION['currentBasket']);
// for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
//    echo $_SESSION['currentBasket'][$i];
// }
// $id = $_POST['id'];
$newCurrentBasket = [];
// $isInArray = false;
for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
   // if ($_SESSION['currentBasket'][$i] == $id) {
   //    $isInArray = true;
   //    continue;
   // } else {
   //    $newCurrentBasket[] = $_SESSION['currentBasket'][$i];
   // }
   $newCurrentBasket[] = $_SESSION['currentBasket'][$i];
}
// print_r($newCurrentBasket);
$newCurrentBasket[] = $id;
// print_r($newCurrentBasket);
// if (!$isInArray) {
//    $newCurrentBasket[] = $id;
// }
// echo $_SESSION['user']['username'];

$_SESSION['currentBasket'] = $newCurrentBasket;

if ($_SESSION['user']['username']) {
   $newBasketInDB = '';
   for ($i = 0; $i < count($newCurrentBasket); $i++) {
      $newBasketInDB .= $newCurrentBasket[$i] . ',';
   }
   // echo $newBasketInDB;
   mysqli_query($connection, "UPDATE `users` SET `basket` = '$newBasketInDB' WHERE `users`.`id` = " . $_SESSION['user']['id']);
}
// UPDATE `users` SET `basket` = '1,2,3,4,' WHERE `users`.`id` = 20;