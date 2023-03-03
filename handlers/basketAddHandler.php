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
$newCurrentBasket = array();
// $isInArray = false;
// echo '<pre>';
// print_r($newCurrentBasket);
// echo '</pre>';
// echo count($newCurrentBasket);
$totalGoods = 0;
for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
   $totalGoods += $_SESSION['currentBasket'][$i][1];
}
// echo $totalGoods;
if ($totalGoods >= 20) {
   // header('Location: ../pages/index.php');
   // echo '<script language="javascript">';
   // echo 'alert("message successfully sent")';
   // echo '</script>';
   die();
}
$isNotOne = false;
if (count($_SESSION['currentBasket']) === 0) {
   $newCurrentBasket[0][0] = $id;
   $newCurrentBasket[0][1] = 1;
   // echo 'aaaaaaaaaaaaaa';
} else {
   for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
      // if ($_SESSION['currentBasket'][$i] == $id) {
      //    $isInArray = true;
      //    continue;
      // } else {
      //    $newCurrentBasket[] = $_SESSION['currentBasket'][$i];
      // }
      // echo 'bbbbbbbbbbbbbbb';
      if ($_SESSION['currentBasket'][$i][0] < $id) {
         $newCurrentBasket[count($newCurrentBasket)][0] = $_SESSION['currentBasket'][$i][0];
         $newCurrentBasket[count($newCurrentBasket) - 1][1] = $_SESSION['currentBasket'][$i][1];
         // if ($_SESSION['currentBasket'][$i + 1][0] > $id) {
         //    $newCurrentBasket[count($newCurrentBasket)][0] = $id;
         //    $newCurrentBasket[count($newCurrentBasket) - 1][1] =  1;
         // }
      } else if ($_SESSION['currentBasket'][$i][0] == $id) {
         // echo 'aaaaaaaaaaaaaa';
         $isNotOne = true;
         $newCurrentBasket[count($newCurrentBasket)][0] = $_SESSION['currentBasket'][$i][0];
         $newCurrentBasket[count($newCurrentBasket) - 1][1] = $_SESSION['currentBasket'][$i][1] + 1;
      } else {
         if (!$isNotOne) {
            $newCurrentBasket[count($newCurrentBasket)][0] = $id;
            $newCurrentBasket[count($newCurrentBasket) - 1][1] =  1;
            $isNotOne = true;
            // echo 'id: ' . $id;
            // echo 'bbbbbbbbbbbbbbbb';
            // echo $_SESSION['currentBasket'][$i][0];
            $newCurrentBasket[count($newCurrentBasket)][0] = $_SESSION['currentBasket'][$i][0];
            $newCurrentBasket[count($newCurrentBasket) - 1][1] = $_SESSION['currentBasket'][$i][1];
         } else {
            $newCurrentBasket[count($newCurrentBasket)][0] = $_SESSION['currentBasket'][$i][0];
            $newCurrentBasket[count($newCurrentBasket) - 1][1] = $_SESSION['currentBasket'][$i][1];
         }
      }
      // $newCurrentBasket[$i] = $_SESSION['currentBasket'][$i];
   }
   if (!$isNotOne) {
      $newCurrentBasket[count($newCurrentBasket)][0] = $id;
      $newCurrentBasket[count($newCurrentBasket) - 1][1] =  1;
      // echo 'Ccccccccccccccc';
   }
}

// print_r($newCurrentBasket);
// $newCurrentBasket[] = $id;
// print_r($newCurrentBasket);
// if (!$isInArray) {
//    $newCurrentBasket[] = $id;
// }
// echo $_SESSION['user']['username'];
// echo '<pre>';
// print_r($newCurrentBasket);
// echo '</pre>';
$_SESSION['currentBasket'] = $newCurrentBasket;

if ($_SESSION['user']['username']) {
   $newBasketInDB = '';
   for ($i = 0; $i < count($newCurrentBasket); $i++) {
      $newBasketInDB .= $newCurrentBasket[$i][0] . 'x' . $newCurrentBasket[$i][1] . ',';
   }
   //echo $newBasketInDB;
   //echo "UPDATE `users` SET `basket` = '$newBasketInDB' WHERE `users`.`id` = " . $_SESSION['user']['id'];
   mysqli_query($connection, "UPDATE `users` SET `basket` = '$newBasketInDB' WHERE `users`.`id` = " . $_SESSION['user']['id']);
}
// // UPDATE `users` SET `basket` = '1,2,3,4,' WHERE `users`.`id` = 20;