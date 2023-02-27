<?php
require '../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $config['title']; ?></title>
   <link rel='stylesheet' href='../css/index.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <?php
         $bestsellers = mysqli_query($connection, "SELECT * FROM `books` ORDER BY `sold_count` DESC LIMIT 8");
         ?>
         <div class="bestsellers">
            <div class="bestsellers__title">
               Найбільш популярні книги
            </div>
            <div class="bestsellers__body">
               <?php
               while ($bestseller = mysqli_fetch_assoc($bestsellers)) {
               ?>
                  <div class="bestsellers__item item-bestsellers">
                     <div class="item-bestsellers__body">
                        <a href="">
                           <img class='item-bestsellers__bookimage' src="../static/books/<?php echo $bestseller['image'] ?>" alt="">
                        </a>
                        <img class='item-bestsellers__favourite' src="../static/svg/favourite-empty.svg" alt="">
                        <a class="item-bestsellers__title" href="">
                           <?php echo $bestseller['title']; ?>
                        </a>
                        <div class="item-bestsellers__author">
                           <?php echo $bestseller['author']; ?>
                        </div>
                        <div class="item-bestsellers__price">
                           <?php echo $bestseller['price'] . 'грн'; ?>
                        </div>
                        <div class="item-bestsellers__buttons">
                           <a class="item-bestsellers__decription item-bestsellers__button" href="">
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
            <button class="bestsellers__button">
               <a class="bestsellers__link">
                  Catalog
               </a>
            </button>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src='../js/index.js'></script>
</body>

</html>