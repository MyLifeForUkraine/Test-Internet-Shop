<?php
require '../includes/config.php';
session_start();

$id = $_POST['id'];
$newCurrentFavourites = [];
$isInArray = false;
for ($i = 0; $i < count($_SESSION['currentFavourites']); $i++) {
   if ($_SESSION['currentFavourites'][$i] == $id) {
      $isInArray = true;
      continue;
   } else {
      $newCurrentFavourites[] = $_SESSION['currentFavourites'][$i];
   }
}
if (!$isInArray) {
   $newCurrentFavourites[] = $id;
}
// echo $_SESSION['user']['username'];
// print_r($newCurrentFavourites);

$_SESSION['currentFavourites'] = $newCurrentFavourites;

if ($_SESSION['user']['username']) {
   $newFavouritesInDB = '';
   for ($i = 0; $i < count($newCurrentFavourites); $i++) {
      $newFavouritesInDB .= $newCurrentFavourites[$i] . ',';
   }
   mysqli_query($connection, "UPDATE `users` SET `favourite` = '$newFavouritesInDB' WHERE `users`.`id` = " . $_SESSION['user']['id']);
}
