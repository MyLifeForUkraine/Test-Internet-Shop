<?php
require '../includes/config.php';
session_start();
// if ($_SESSION['user']['username']) {
//    $discount = 0.9;
//    $isaccess = 'yes';
//    // $_SESSION['currentFavourites'] = $SESS;
// } else {
//    $discount = 1;
//    $isaccess = 'no';
//    if (!$_SESSION['currentFavourites']) {
//       $_SESSION['currentFavourites'] = [];
//    }
//    if (!$_SESSION['currentBasket']) {
//       $_SESSION['currentBasket'] = array();
//    }
// }

$lastname =  $_POST['lastname'];
$firstname =  $_POST['firstname'];
$patronymic =  $_POST['patronymic'];
$email =  $_POST['email'];
$phone =  $_POST['phone'];
$posttype =  $_POST['posttype'];
$region =  $_POST['region'];
$settlement =  $_POST['settlement'];
$street =  $_POST['street'];
$home =  $_POST['home'];
// $bid =  $_SESSION['currentBasket'];
$price = $_SESSION['total-price'];
// echo '<pre>';
// // print_r($newCurrentBasket);
// print_r($_SESSION['currentBasket']);
// echo '</pre>';
$bid = '';
for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
   $bid .= $_SESSION['currentBasket'][$i][0] . 'x' . $_SESSION['currentBasket'][$i][1] . ',';
}


echo $bid . '<br>';
echo $lastname . '<br>';
echo $firstname . '<br>';
echo $patronymic . '<br>';
echo $email . '<br>';
echo $phone . '<br>';
echo $posttype . '<br>';
echo $region . '<br>';
echo $settlement . '<br>';
echo $street . '<br>';
echo $home . '<br>';
echo $bid . '<br>';
echo $price . '<br>';
mysqli_query($connection, "INSERT INTO `orders` (`id`, `lastname`, `firstname`, `patronymic`, `email`, `phone`, `region`, `settlement`, `street`, `home`, `bid`, `posttype`, `price`) VALUES 
                                                (NULL, '$lastname', '$firstname', '$patronymic', '$email', '$phone', '$region', '$settlement', '$street', '$home', '$bid', '$posttype', '$price')");
$_SESSION['currentBasket'] = [];
if ($_SESSION['user']['username']) {
   mysqli_query($connection, "UPDATE `users` SET `basket` = '' WHERE `users`.`id` = " . $_SESSION['user']['id']);
}
header('Location: ../pages/purchase.php');
