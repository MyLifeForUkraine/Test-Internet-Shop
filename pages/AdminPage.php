<?php
require '../includes/config.php';
session_start();
if ($_SESSION['user']['username']) {
   $discount = 0.9;
   $isaccess = 'yes';
} else {
   $discount = 1;
   $isaccess = 'no';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
   <link rel='stylesheet' href='../css/index.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <?php
   if ($_SESSION['user']['role'] !== 'admin') {
      header('Location: index.php');
   }
   ?>
   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         Admin Page
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
</body>

</html>