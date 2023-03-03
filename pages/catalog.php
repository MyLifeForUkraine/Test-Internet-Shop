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
   <title>Catalog</title>
   <link rel="stylesheet" href="../css/catalog.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <?php
   ?>
   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <div class="content">
            <form class="sideBar" method="get">
               <?php
               $currentGenres = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isGenre' . $i]) {
                     // var_dump($_GET['isGenre' . $i]);
                     $currentGenres[] = $_GET['isGenre' . $i];
                  }
               }
               ?>
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Жанри
                  </div>
                  <?php $Genres = mysqli_query($connection, "SELECT * FROM `book_id`"); ?>
                  <div class="section-sideBar__items" name="sort_by_genre">
                     <?php
                     while ($Genre = mysqli_fetch_assoc($Genres)) {
                     ?>
                        <div class="section-sideBar__checkbox">
                           <input type="checkbox" <?php if (in_array($Genre['id'], $currentGenres)) {
                                                      echo 'checked';
                                                   } ?> name="isGenre<?php echo $Genre['id'] ?>" id="genre<?php echo $Genre['id'] ?>" value="<?php echo $Genre['id'] ?>" class="section-sideBar__item genre<?php echo $Genre['id'] ?> genre">
                           <label for="genre<?php echo $Genre['id'] ?>" class="section-sideBar__label"> <?php echo $Genre['name'] ?></label>
                        </div>
                     <?php
                     }
                     ?>
                     <button class="section-sideBar__button sort-by-genres">Пошук</button>
                  </div>
               </div>
               <?php
               $currentCountries = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isCountry' . $i]) {
                     // var_dump($_GET['isGenre' . $i]);
                     $currentCountries[] = $_GET['isCountry' . $i];
                  }
               }
               ?>
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Країна
                  </div>
                  <?php $Сountries = mysqli_query($connection, "SELECT * FROM `countries`") ?>
                  <div class="section-sideBar__items" name="sort_by_country">
                     <?php
                     while ($Country = mysqli_fetch_assoc($Сountries)) {
                     ?>
                        <div class="section-sideBar__checkbox">
                           <input type="checkbox" <?php if (in_array($Country['id'], $currentCountries)) {
                                                      echo 'checked';
                                                   } ?> name="isCountry<?php echo $Country['id'] ?>" id="country<?php echo $Country['id'] ?>" value="<?php echo $Country['id'] ?>" class="section-sideBar__item country<?php echo $Country['id'] ?> country">
                           <label for="country<?php echo $Country['id'] ?>" class="section-sideBar__label"> <?php echo $Country['country'] ?></label>
                        </div>
                     <?php
                     }
                     ?>
                     <button class="section-sideBar__button sort-by-countries">Пошук</button>
                  </div>
               </div>
               <?php
               $currentLanguages = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isLanguage' . $i]) {
                     $currentLanguages[] = $_GET['isLanguage' . $i];
                  }
               }
               ?>
               <div class="sideBar__section section-sideBar">
                  <div class="section-sideBar__title">
                     Мова
                  </div>
                  <?php $Languages = mysqli_query($connection, "SELECT * FROM `languages`") ?>
                  <div class="section-sideBar__items" name="sort_by_language">
                     <?php
                     while ($Language = mysqli_fetch_assoc($Languages)) {
                     ?>
                        <div class="section-sideBar__checkbox">
                           <input type="checkbox" <?php if (in_array($Language['id'], $currentLanguages)) {
                                                      echo 'checked';
                                                   } ?> name="isLanguage<?php echo $Language['id'] ?>" id="language<?php echo $Language['id'] ?>" value="<?php echo $Language['id'] ?>" class="section-sideBar__item language<?php echo $Language['id'] ?> language">
                           <label for="language<?php echo $Language['id'] ?>" class="section-sideBar__label"> <?php echo $Language['name'] ?></label>
                        </div>
                     <?php
                     }
                     ?>
                     <button class="section-sideBar__button sort-by-languages">Пошук</button>
                  </div>
               </div>
            </form>
            <div class="catalog">
               <?php
               //initialize $genres
               $parametrs = '?';
               $genres = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isGenre' . $i]) {
                     // var_dump($_GET['isGenre' . $i]);
                     $genres[] = $_GET['isGenre' . $i];
                     $parametrs .= 'isGenre' . $i . '=' . $_GET['isGenre' . $i] . '&';
                  }
               }
               //initialize $countries
               $countries = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isCountry' . $i]) {
                     // var_dump($_GET['isGenre' . $i]);
                     $countries[] = $_GET['isCountry' . $i];
                     $parametrs .= 'isCountry' . $i . '=' . $_GET['isCountry' . $i] . '&';
                  }
               }
               //initialize $languages
               $languages = [];
               for ($i = 0; $i < 100; $i++) {
                  if ($_GET['isLanguage' . $i]) {
                     // var_dump($_GET['isGenre' . $i]);
                     $languages[] = $_GET['isLanguage' . $i];
                     $parametrs .= 'isLanguage' . $i . '=' . $_GET['isLanguage' . $i] . '&';
                  }
               }
               $request = '';
               if ($isaccess === 'no') {
                  $request .= "(isforeveryone = 'yes')";
               }
               if (count($genres) > 0 && $request != '') {
                  $request .= " AND ";
               }
               if (count($genres) > 0) {
                  $request .= "(";
               }
               for ($i = 0; $i < count($genres); $i++) {
                  $request .=  'book_id = ' . $genres[$i];
                  if ($i + 1 != count($genres)) {
                     $request .= " OR ";
                  }
               }
               if (count($genres) > 0) {
                  $request .= ")";
               }
               if (count($countries) > 0 && $request != '') {
                  $request .= " AND ";
               }
               if (count($countries) > 0) {
                  $request .= " ( ";
               }
               for ($i = 0; $i < count($countries); $i++) {
                  $request .=  'country = ' . $countries[$i];
                  if ($i + 1 != count($countries)) {
                     $request .= " OR ";
                  }
               }
               if (count($countries) > 0) {
                  $request .= " ) ";
               }
               if (count($languages) > 0 && $request != '') {
                  $request .= " AND ";
               }
               if (count($languages) > 0) {
                  $request .= " ( ";
               }
               for ($i = 0; $i < count($languages); $i++) {
                  $request .=  'language = ' . $languages[$i];
                  if ($i + 1 != count($languages)) {
                     $request .= " OR ";
                  }
               }
               if (count($languages) > 0) {
                  $request .= " ) ";
               }
               // echo $request;
               $condition = '';
               if ($request != '') {
                  $condition = "WHERE " . $request;
               }
               // echo $condition;
               $currentPage = 1;
               $perPage = 12;
               if (isset($_GET['page'])) {
                  $currentPage = (int) $_GET['page'];
               }
               // echo "SELECT COUNT('id') AS 'count_id' FROM `books`" . $condition;
               $bestsellers_t = mysqli_query($connection, "SELECT COUNT('id') AS 'count_id' FROM `books`" . $condition);
               $totalElements = mysqli_fetch_assoc($bestsellers_t)['count_id'];
               $totalPages = ceil($totalElements / $perPage);
               // echo  $currentPage;
               if ($currentPage < 1 || $currentPage > $totalPages) {
                  $currentPage = 1;
               }
               // echo "SELECT * FROM `books` " . $condition;
               $bestsellers = mysqli_query($connection, "SELECT * FROM `books` " . $condition . "LIMIT " . $perPage . " OFFSET " . $perPage * ($currentPage - 1));
               if (mysqli_num_rows($bestsellers) == 0) {
               ?>
                  <div class="catalog__empty">
                     За Вашими параметрами книжок немає
                  </div>
               <?php
               } else { ?>
                  <div class="catalog__title">
                     Каталог
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
                                 <?php echo ceil($bestseller['price'] * $discount) . ' грн'; ?>
                              </div>
                              <div class="item-catalog__buttons">
                                 <a class="item-catalog__decription item-catalog__button" href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
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
                  <div class="catalog__pagination">
                     <?php if ($currentPage > 1) {
                     ?>
                        <a class="catalog__pagination-button" href="<?php echo $parametrs == '' ? '?' : $parametrs  ?>page=<?= $currentPage - 1 ?>"> Попередня сторінка</a>
                     <?php } else {
                     ?>
                        <p class="catalog__pagination-button-notactive"> Попередня сторінка</p>
                     <?php } ?>

                     <p class="catalog__pagination-current-page"><?= $currentPage ?></p>
                     <?php
                     if ($currentPage * $perPage + 1 <= $totalElements) {
                     ?>
                        <a class="catalog__pagination-button" href="<?php echo $parametrs == '' ? '?' : $parametrs  ?>page=<?= $currentPage + 1 ?>"> Наступна сторінка</a>
                     <?php
                     } else { ?>
                        <p class="catalog__pagination-button-notactive"> Наступна сторінка</p>
                     <?php
                     }
                     ?>

                  </div>
               <?php
               }
               ?>

            </div>
         </div>

      </div>
      <?php require '../includes/footer.php'; ?>
   </div>
   </div>
   <script src="../js/index.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script>
      // $(document).ready(function() {
      //    $('button.sort-by-genres').on('click', function() {
      //       let genres = [];
      //       // console.log($('.genre')[0].checked)
      //       for (let i = 0; i < 100; i++) {
      //          if ($('.genre')[i]) {
      //             if ($('.genre')[i].checked === true) {
      //                genres.push($('input.genre' + (i + 1)).val());
      //             } else {
      //                continue;
      //             }
      //          }
      //       }
      //       console.log(genres);
      //       $.ajax({
      //          url: '../forms/sortBy.php',
      //          method: 'POST',
      //          // isGenre
      //          data: {
      //             GENRES: genres,
      //          },
      //          success: function(response) {
      //             console.log(response);
      //          },
      //          error: function(xhr, status, error) {
      //             console.log(error);
      //          }
      //       });
      //    })
      // });
   </script>
</body>

</html>