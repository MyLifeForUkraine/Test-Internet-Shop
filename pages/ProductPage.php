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
            <?php
            if ($isaccess === 'no') {
               $banned = mysqli_query($connection, "SELECT id FROM `books` WHERE isforeveryone = 'no' ");
               $currentID = $_GET['id'];
               // echo $currentID;
               while ($id = mysqli_fetch_assoc($banned)) {
                  if ($currentID == $id['id']) {
                     header('Location: ../pages/catalog.php');
                  }
               }
            }
            ?>
            <div class="about-product">
               <?php $product = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `books` WHERE id=" . (int)$_GET['id'])); ?>
               <div class="about-product__control">
                  <div class="about-product__image">
                     <img src="../static/books/<?php echo $product['image'] ?>" alt="">
                  </div>
                  <div class="about-product__buttons">
                     <?php
                     if (in_array($product['id'], $_SESSION['currentFavourites'])) {
                     ?>
                        <img id="favourite<?php echo $product['id'] ?>" class='item-bestsellers__favourite about-product__button' src="../static/svg/favourite.svg" alt="">
                     <?php
                     } else {
                     ?>
                        <img id="favourite<?php echo $product['id'] ?>" class='item-bestsellers__favourite about-product__button' src="../static/svg/favourite-empty.svg" alt="">
                     <?php
                     }
                     ?>
                     <img id="basket<?php echo $product['id'] ?>" class="about-product__button item-bestsellers__buy" src="../static/svg/basket.svg" alt="">
                     <!-- <img > -->
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
                        <?php echo ceil($product['price'] * $discount) . ' грн' ?>
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
               // print_r($_SESSION['currentFavourites']);
               // print_r($_SESSION['currentBasket']);
               ?>
               <?php
               if ($isaccess === 'no') {
                  $request = "(isforeveryone = 'yes') AND ";
               } else {
                  $request = '';
               }
               // echo "SELECT * FROM `books` WHERE" . $request . "  country = " . $product['country'];
               // echo "SELECT * FROM `books` WHERE id != " . $_GET['id'] . " AND " . $request . " country = " . $product['country'];
               $bestsellers = mysqli_query($connection, "SELECT * FROM `books` WHERE id != " . $_GET['id'] . " AND " . $request . " country = " . $product['country']);
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
                           <a href="../pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <img class='item-catalog__bookimage' src="../static/books/<?php echo $bestseller['image'] ?>" alt="">
                           </a>
                           <?php
                           if (in_array($bestseller['id'], $_SESSION['currentFavourites'])) {
                           ?>
                              <img id="favourite<?php echo $bestseller['id'] ?>" class='item-catalog__favourite ' src="../static/svg/favourite.svg" alt="">
                           <?php
                           } else {
                           ?>
                              <img id="favourite<?php echo $bestseller['id'] ?>" class='item-catalog__favourite ' src="../static/svg/favourite-empty.svg" alt="">
                           <?php
                           }
                           ?>
                           <a class="item-catalog__title" href="../pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <?php echo $bestseller['title']; ?>
                           </a>
                           <div class="item-catalog__author">
                              <?php echo $bestseller['author']; ?>
                           </div>
                           <div class="item-catalog__price">
                              <?php echo ceil($bestseller['price'] * $discount) . ' грн'; ?>
                           </div>
                           <div class="item-catalog__buttons">
                              <a class="item-catalog__decription item-catalog__button" href="">
                                 Опис
                              </a>
                              <div id="basket<?php echo $bestseller['id'] ?>" class="item-catalog__buy item-catalog__button">
                                 У кошик
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php
                  }
                  ?>
               </div>
               <!-- <a class="catalog__button" href="../pages/catalog.php">
                  Catalog
               </a> -->
            </div>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src="../js/index.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.item-catalog__favourite, .item-bestsellers__favourite').on('click', function(event) {
            // console.log(event.target);
            // console.log(event.target.getAttribute('src'));
            if (event.target.getAttribute('src').includes('empty')) {
               event.target.setAttribute('src', '../static/svg/favourite.svg')
            } else {
               event.target.setAttribute('src', '../static/svg/favourite-empty.svg')
            }

            let id = event.target.id;
            id = Number(id.slice(9));
            console.log(event.target);
            $.ajax({
               method: 'POST',
               url: '../handlers/favouriteHandler.php',
               // isGenre
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
            // console.log(event.target.id);
            // console.log(id);
         })
      });
   </script>
   <script>
      $(document).ready(function() {
         $('.item-bestsellers__buy, .item-catalog__buy').on('click', function(event) {
            let id = event.target.id;
            id = Number(id.slice(6));
            console.log(id);
            $.ajax({
               method: 'POST',
               url: '../handlers/basketAddHandler.php',
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