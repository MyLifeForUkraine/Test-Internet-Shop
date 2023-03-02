<?php
require '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ProductPage</title>
   <link rel="stylesheet" href="../css/product-page.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <div class="content">
            <div class="about-product">
               <?php $product = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `books` WHERE id=" . (int)$_GET['id'])); ?>
               <div class="about-product__control">
                  <div class="about-product__image">
                     <img src="../static/books/<?php echo $product['image'] ?>" alt="">
                  </div>
                  <div class="about-product__buttons">
                     <a class="about-product__button" href="">
                        <img src="../static/svg/favourite-empty.svg" alt="">
                     </a>
                     <a class="about-product__button" href="">
                        <img src="../static/svg/basket.svg" alt="">
                     </a>
                  </div>
               </div>
               <div class="about-product__info info-about-product">
                  <div class="info-about-product__title">
                     <?php echo $product['title']  ?>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Автор:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo $product['author']  ?>
                     </div>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Жанр:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT name FROM `book_id` WHERE id=" . $product['book_id']))['name'] ?>
                     </div>
                  </div>
                  <div class="info-about-product__isInStock isInStock-info-about-product">
                     <?php
                     if ($product['count'] > 0) {
                     ?>
                        <div class="isInStock-info-about-product__true">
                           У наявності
                        </div>
                     <?php
                     } else {
                     ?>
                        <div class="isInStock-info-about-product__false">
                           Немає у наявності
                        </div>
                     <?php
                     }
                     ?>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Країна написання:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT country FROM `countries` WHERE id=" . $product['country']))['country'] ?>
                     </div>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Мова:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT name FROM `languages` WHERE id=" . $product['language']))['name']  ?>
                     </div>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Рік написання:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo $product['year']; ?>
                     </div>
                  </div>
                  <div class="info-about-product__item item-info-about-product">
                     <div class="item-info-about-product__title">
                        Опис:
                     </div>
                     <div class="item-info-about-product__text">
                        <?php echo $product['description'] ?>
                     </div>
                  </div>
                  <div class="info-about-product__money">
                     <div class="info-about-product__price">
                        <?php echo $product['price'] . ' грн' ?>
                     </div>
                     <?php
                     if ($product['count'] > 0) {
                     ?>
                        <a class="info-about-product__buy-active" href="">
                           Купити
                        </a>
                     <?php
                     } else {
                     ?>
                        <div class="info-about-product__buy-not-active" href="">
                           Купити
                        </div>
                     <?php
                     }
                     ?>
                  </div>
               </div>
            </div>
            <div class="catalog">
               <?php
               $bestsellers = mysqli_query($connection, "SELECT * FROM `books` WHERE country = " . $product['country']);
               ?>
               <div class="catalog__title">
                  Книги, які можуть Вас зацікавити
               </div>
               <div class="catalog__body">
                  <?php
                  while ($bestseller = mysqli_fetch_assoc($bestsellers)) {
                  ?>
                     <div class="catalog__item item-catalog">
                        <div class="item-catalog__body">
                           <a href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <img class='item-catalog__bookimage' src="../static/books/<?php echo $bestseller['image'] ?>" alt="">
                           </a>
                           <img id=<?php echo $bestseller['id'] ?> class='item-catalog__favourite' src="../static/svg/favourite-empty.svg" alt="">
                           <a class="item-catalog__title" href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <?php echo $bestseller['title']; ?>
                           </a>
                           <div class="item-catalog__author">
                              <?php echo $bestseller['author']; ?>
                           </div>
                           <div class="item-catalog__price">
                              <?php echo $bestseller['price'] . ' грн'; ?>
                           </div>
                           <div class="item-catalog__buttons">
                              <a class="item-catalog__decription item-catalog__button" href="">
                                 Опис
                              </a>
                              <a class="item-catalog__buy item-catalog__button" href="">
                                 У кошик
                              </a>
                           </div>
                        </div>
                     </div>
                  <?php
                  }
                  ?>
               </div>
               <!-- <a class="catalog__button" href="/Test-Internet-Shop/pages/catalog.php">
                  Catalog
               </a> -->
            </div>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src="../js/index.js"></script>
</body>

</html>