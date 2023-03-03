<?php
require '../includes/config.php';
session_start();
if ($_SESSION['user']['username']) {
   $discount = 0.9;
   $isaccess = 'yes';
   // $_SESSION['currentFavourites'] = $SESS;
} else {
   $discount = 1;
   $isaccess = 'no';
   if (!$_SESSION['currentFavourites']) {
      $_SESSION['currentFavourites'] = [];
   }
   if (!$_SESSION['currentBasket']) {
      $_SESSION['currentBasket'] = array();
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../css/basket.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>


   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <?php
         // print_r($_SESSION['currentBasket']);
         if (count($_SESSION['currentBasket']) > 0) {
            $request = 'WHERE (';
         } else {
            $request = '';
         }

         for ($i = 0; $i < count($_SESSION['currentBasket']); $i++) {
            $request .= 'id = ' . $_SESSION["currentBasket"][$i][0];
            if ($i + 1 !== count($_SESSION['currentBasket'])) {
               $request .= ' OR ';
            }
         }
         if (count($_SESSION['currentBasket']) > 0) {
            $request .= ')';
         }
         // echo $request;
         if ($request !== '') {
            $goods = mysqli_query($connection, "SELECT * FROM `books` " . $request);
         ?>
            <div class="content">

               <div class="content__goods goods-content">

                  <div class="goods-content__body">
                     <?php
                     $totalSum = 0;
                     $j = 0;
                     while ($good = mysqli_fetch_assoc($goods)) {
                        $totalSum += ceil($good['price'] * $discount) * $_SESSION["currentBasket"][$j][1];
                     ?>
                        <div class=" goods-content__item item-goods-content item<?= $good['id'] ?> ">

                           <a href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $good['id'] ?>" class="item-goods-content__img">
                              <img src="../static/books/<?= $good['image'] ?>" alt="">
                           </a>
                           <div class="item-goods-content__info info-item-goods-content">
                              <a href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $good['id'] ?>" class="info-item-goods-content__title">
                                 <?= $good['title'] ?>
                              </a>
                              <div class="info-item-goods-content__author">
                                 <?= $good['author'] ?>
                              </div>
                              <div class="info-item-goods-content__isInStock info-item-goods-content__isInStock__true">
                                 У наявності
                              </div>
                              <div class="info-item-goods-content__price info-item-goods-content__price<?= $good['id'] ?>">
                                 <?= ceil($good['price'] * $discount) * $_SESSION["currentBasket"][$j][1] ?>
                              </div>
                              <span class="currency">грн </span>
                              <div class="info-item-goods-content__price-m">
                                 <?= 'Кількість: ' ?> <span id="amount<?= $_SESSION["currentBasket"][$j][1] ?>" class="info-item-goods-content__price-amount info-item-goods-content__price-amount<?= $good['id'] ?>"><?= $_SESSION["currentBasket"][$j][1] ?></span>
                              </div>
                           </div>
                           <div id="remove<?= $good['id'] ?>" class="item-goods-content__delete" value="5">
                              Видалити
                           </div>
                        </div>
                     <?php
                        $j++;
                     }
                     ?>
                  </div>
                  <span class="currency">Загалом:</span>
                  <div class="goods-content__total">
                     <?= $totalSum ?>
                  </div>
                  <?php $_SESSION['total-price'] = $totalSum ?>
                  <span class="currency">грн </span>
               </div>
               <div class="content__form form-content">
                  <form action="../users/order.php" method="post" class="form-content__form">
                     <label class="form-content__label">Прізвище</label>
                     <input required type="text" name="lastname" class="form-content__input" placeholder="Введіть Ваше прізвище">
                     <label class="form-content__label">Ім'я</label>
                     <input required type="text" name="firstname" class="form-content__input" placeholder="Введіть Ваше ім'я">
                     <label class="form-content__label">По-батькові</label>
                     <input required type="text" name="patronymic" class="form-content__input" placeholder="Введіть Ваше по-батькові">
                     <label class="form-content__label">Пошта</label>
                     <input required type="email" name="email" class="form-content__input" placeholder="Введіть адресу Вашої пошти">
                     <label class="form-content__label">Номер телефону</label>
                     <input required type="phone" name="phone" class="form-content__input" placeholder="Введіть Ваш номер телефону">
                     <label class="form-content__label">Тип доставки</label>
                     <p class="form-content__radio"><input checked type="radio" name="posttype" value="nova_poshta"> Нова Пошта </p>
                     <p class="form-content__radio"><input type="radio" name="posttype" value="ukr_poshta"> Укр Пошта </p>
                     <label class="form-content__label">Область</label>
                     <input required type="text" name="region" class="form-content__input" placeholder="Введіть область Вашого населеного пункту">
                     <label class="form-content__label">Населений пункт</label>
                     <input required type="text" name="settlement" class="form-content__input" placeholder="Введіть назву Вашого населеного пункту">
                     <label class="form-content__label">Вулиця</label>
                     <input required type="text" name="street" class="form-content__input" placeholder="Введіть назву Вашої вулиці">
                     <label class="form-content__label">Номер будинку</label>
                     <input required type="text" name="home" class="form-content__input" placeholder="Введіть номер Вашого будинку">
                     <button type="submit" class="form-content__button">Замовити</button>
                  </form>
               </div>
            </div>
         <?php

         } else {
         ?>
            <div class="goods-content__body-empty">
               Ваш кошик пустий
            </div>

         <?php
         }

         ?>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.item-goods-content__delete').on('click', function(event) {
            let id = event.target.id;
            id = Number(id.slice(6));
            // console.log(id);
            // if()
            // console.log(`#amount${id}`);
            let amount = document.querySelector(`.info-item-goods-content__price-amount${id}`);
            // console.log(amount);
            // console.log(block);
            // amount = Number(amount.id.slice(6));
            // console.log(amount);
            // console.log(amount.id.slice(6));
            let price = document.querySelector(`.info-item-goods-content__price${id}`);
            // console.log(Number(price.innerHTML));
            // console.log(Number(price.innerHTML));
            // console.log(Math.ceil(Math.floor(Number(price.innerHTML) / (Number(amount.id.slice(6)))) * Number(amount.id.slice(6) - 1)));
            // console.log(Math.floor(Number(price.innerHTML) / (Number(amount.id.slice(6)))))
            let different = Number(price.innerHTML) - Math.ceil(Math.floor(Number(price.innerHTML) / (Number(amount.id.slice(6)))) * Number(amount.id.slice(6) - 1));
            price.innerHTML = Math.ceil(Math.floor(Number(price.innerHTML) / (Number(amount.id.slice(6)))) * Number(amount.id.slice(6) - 1));
            if (amount.id.slice(6) == 1) {
               // console.log(11111111111111);
               let block = document.querySelector(`.item${id}`);
               block.style.display = "none";
            } else {
               amount.id = `amount${Number(amount.id.slice(6))-1}`;
               amount.innerHTML = Number(amount.id.slice(6));
               // console.log();
            }
            let total = document.querySelector('.goods-content__total');
            total.innerHTML = total.innerHTML - different;
            if (total.innerHTML == 0) {
               document.querySelector('.content__goods').style.display = "none";
               document.querySelector('.content__form').style.display = "none";

               // console.log(document.querySelector('.goods-content__body-empty'));
               // document.querySelector('.content').style.display = "initial";
            }
            // console.log(Number(different));
            // total.innerHTML 
            // console.log(event);
            $.ajax({
               method: 'POST',
               url: '../handlers/basketRemoveHandler.php',
               data: {
                  id: id,
               },
               success: function(response) {
                  console.log(response);
               },
               error: function(xhr, status, error) {
                  console.log(error);
               }
            });
         })
      });
   </script>
</body>

</html>