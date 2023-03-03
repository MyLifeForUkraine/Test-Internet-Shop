<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../css/basket.css">
</head>

<body>


   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <div class="content">
            <div class="content__goods goods-content">
               <div class="goods-content__body">

                  <div class="goods-content__item item-goods-content">

                     <div class="item-goods-content__img">
                        <img src="../static/books/the-alchemist.jpeg" alt="">
                     </div>
                     <div class="item-goods-content__info info-item-goods-content">
                        <div class="info-item-goods-content__title">
                           Алхімік
                        </div>
                        <div class="info-item-goods-content__author">
                           Пауло Коельйо
                        </div>
                        <div class="info-item-goods-content__isInStock info-item-goods-content__isInStock__true">
                           У наявності
                        </div>
                        <div class="info-item-goods-content__price">
                           194 грн
                        </div>
                     </div>
                     <div class="item-goods-content__delete">
                        Видалити
                     </div>
                  </div>

                  <div class="goods-content__item item-goods-content">

                     <div class="item-goods-content__img">
                        <img src="../static/books/the-alchemist.jpeg" alt="">
                     </div>
                     <div class="item-goods-content__info info-item-goods-content">
                        <div class="info-item-goods-content__title">
                           Алхімік
                        </div>
                        <div class="info-item-goods-content__author">
                           Пауло Коельйо
                        </div>
                        <div class="info-item-goods-content__isInStock info-item-goods-content__isInStock__true">
                           У наявності
                        </div>
                        <div class="info-item-goods-content__price">
                           194 грн
                        </div>
                     </div>
                     <div class="item-goods-content__delete">
                        Видалити
                     </div>
                  </div>

                  <div class="goods-content__item item-goods-content">

                     <div class="item-goods-content__img">
                        <img src="../static/books/the-alchemist.jpeg" alt="">
                     </div>
                     <div class="item-goods-content__info info-item-goods-content">
                        <div class="info-item-goods-content__title">
                           Алхімік
                        </div>
                        <div class="info-item-goods-content__author">
                           Пауло Коельйо
                        </div>
                        <div class="info-item-goods-content__isInStock info-item-goods-content__isInStock__true">
                           У наявності
                        </div>
                        <div class="info-item-goods-content__price">
                           194 грн
                        </div>
                     </div>
                     <div class="item-goods-content__delete">
                        Видалити
                     </div>
                  </div>

               </div>

               <div class="goods-content__total">
                  Загалом: 582 грн
               </div>
            </div>
            <div class="content__form form-content">
               <form action="../users/order.php" method="post" class="form-content__form">
                  <label class="form-content__label">Прізвище</label>
                  <input type="text" name="lastname" class="form-content__input" placeholder="Введіть Ваше прізвище">
                  <label class="form-content__label">Ім'я</label>
                  <input type="text" name="firstname" class="form-content__input" placeholder="Введіть Ваше ім'я">
                  <label class="form-content__label">По-батькові</label>
                  <input type="text" name="patronymic" class="form-content__input" placeholder="Введіть Ваше по-батькові">
                  <label class="form-content__label">Пошта</label>
                  <input type="email" name="email" class="form-content__input" placeholder="Введіть адресу Вашої пошти">
                  <label class="form-content__label">Номер телефону</label>
                  <input type="phone" name="phone" class="form-content__input" placeholder="Введіть Ваш номер телефону">
                  <button type="submit" class="form-content__button">Замовити</button>
               </form>
            </div>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>


</body>

</html>