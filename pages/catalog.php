<?php
require '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Catalog</title>
   <link rel="stylesheet" href="../css/catalog.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <div class="content">
            <div class="sideBar">
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Жанри
                  </div>
                  <?php $genres = mysqli_query($connection, "SELECT name FROM `book_id`") ?>
                  <div class="section-sideBar__items">
                     <?php
                     while ($genre = mysqli_fetch_assoc($genres)) {
                     ?>
                        <div class="section-sideBar__item">
                           <?php echo $genre['name'] ?>
                        </div>
                     <?php
                     }
                     ?>
                  </div>
               </div>
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Країна
                  </div>
                  <?php $countries = mysqli_query($connection, "SELECT country FROM `countries`") ?>
                  <div class="section-sideBar__items">
                     <?php
                     while ($country = mysqli_fetch_assoc($countries)) {
                     ?>
                        <div class="section-sideBar__item">
                           <?php echo $country['country'] ?>
                        </div>
                     <?php
                     }
                     ?>
                  </div>
               </div>
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Мова
                  </div>
                  <?php $languages = mysqli_query($connection, "SELECT name FROM `languages`") ?>
                  <div class="section-sideBar__items"></div>
                  <?php
                  while ($language = mysqli_fetch_assoc($languages)) {
                  ?>
                     <div class="section-sideBar__item">
                        <?= $language['name'] ?>
                     </div>
                  <?php
                  }
                  ?>
               </div>
            </div>
            <div class="catalog">
               <?php
               $bestsellers = mysqli_query($connection, "SELECT * FROM `books` ORDER BY `sold_count` DESC LIMIT 12");
               ?>
               <div class="catalog__title">
                  Найбільш популярні книги
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
                           <img class='item-catalog__favourite' src="../static/svg/favourite-empty.svg" alt="">
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

      </div>
      <?php require '../includes/footer.php'; ?>
   </div>
   </div>
   <script src="../js/index.js"></script>
</body>

</html>