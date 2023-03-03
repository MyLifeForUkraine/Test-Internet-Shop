<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Authorization</title>
   <link rel=stylesheet href="../css/authorization.css">
   <link rel='stylesheet' href='../css/index.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

   <div class="wrapper-authorization">
      <div class="container-authorization">
         <?php require '../includes/header.php'; ?>
         <div class="content-authorization">
            <form action="signin.php" method="post" class="form">
               <label>Username</label>
               <input type="text" name="username" class="input" placeholder="Введіть свій логін">
               <label>Пароль</label>
               <input type="password" name="password" class="input" placeholder="Введіть свій пароль">
               <button class="button" type="submit">Увійти</button>
               <p class="p">
                  У Вас немає акаунта? - <a class="a" href="registration.php">зареєструйтесь</a>!
               </p>
               <?php
               if ($_SESSION['message']) {
                  echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
               }
               unset($_SESSION['message']);
               ?>
            </form>
         </div>

         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
</body>

</html>