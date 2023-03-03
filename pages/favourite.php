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
   <title>Document</title>
   <link rel="stylesheet" href="../css/favourite.css">
   <link rel='stylesheet' href='../css/index.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <!-- <div class="content">
            CONTENT
         </div> -->
         <div class="bestsellers">
            <?php
            if ($isaccess === 'no') {
               $additionalParametr = ' WHERE (isforeveryone = "yes") ';
            } else {
               $additionalParametr = '';
            }
            // echo ;
            if ($_SESSION['user']['username']) {
               $favourites = $_SESSION['currentFavourites'];
            } else {
               $favourites = [1, 4, 5];
            }
            if ($additionalParametr !== '' && count($favourites) !== 0) {
               $favouritesParametr = ' AND (';
            } else if (count($favourites) !== 0) {
               $favouritesParametr = 'WHERE (';
            } else {
               $favouritesParametr = '';
            }

            for ($i = 0; $i < count($favourites); $i++) {
               $favouritesParametr .= 'id = ' . $favourites[$i];
               if ($i + 1 !== count($favourites)) {
                  $favouritesParametr .= ' OR ';
               }
            }
            if (count($favourites) !== 0) {
               $favouritesParametr .= ')';
            }
            echo $favouritesParametr;
            echo "SELECT * FROM `books`" . $additionalParametr . $favouritesParametr;
            // echo $favouritesParametr;
            if ($favouritesParametr !== '') {
               $bestsellers = mysqli_query($connection, "SELECT * FROM `books`" . $additionalParametr . $favouritesParametr);
            ?>
               <div class="bestsellers__title">
                  Ваші бажані книги
               </div>
               <div class="bestsellers__body">
                  <?php
                  while ($bestseller = mysqli_fetch_assoc($bestsellers)) {
                  ?>
                     <div class="bestsellers__item item-bestsellers">
                        <div class="item-bestsellers__body">
                           <a href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <img class='item-bestsellers__bookimage' src="../static/books/<?php echo $bestseller['image'] ?>" alt="">
                           </a>
                           <img id=<?php echo $bestseller['id'] ?> class='item-bestsellers__favourite' src="../static/svg/favourite-empty.svg" alt="">
                           <a class="item-bestsellers__title" href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              <?php echo $bestseller['title']; ?>
                           </a>
                           <div class="item-bestsellers__author">
                              <?php echo $bestseller['author']; ?>
                           </div>
                           <div class="item-bestsellers__price">
                              <?php echo ceil($bestseller['price'] * $discount) . ' грн'; ?>
                           </div>
                           <div class="item-bestsellers__buttons">
                              <a class="item-bestsellers__decription item-bestsellers__button" href="/Test-Internet-Shop/pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                                 Опис
                              </a>
                              <a class="item-bestsellers__buy item-bestsellers__button" href="">
                                 У кошик
                              </a>
                           </div>
                        </div>
                     </div>
                  <?php
                  }
                  ?>
               </div>
            <?php
            } else {
            ?>
               <div class="bestsellers__title">
                  У вас немає бажаних книг
               </div>
            <?php
            }
            ?>
            <a class="bestsellers__button" href="/Test-Internet-Shop/pages/catalog.php">
               Catalog
            </a>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src='../js/index.js'></script>
</body>

</html>