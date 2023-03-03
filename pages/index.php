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
   <title><?php echo $config['title']; ?></title>
   <link rel='stylesheet' href='../css/index.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <div class="wrapper">
      <div class="container">

         <?php
         // print_r($_SESSION['currentFavourites']);
         // print_r($_SESSION['currentBasket']);
         // echo '<pre>';
         // // print_r($newCurrentBasket);
         // print_r($_SESSION['currentBasket']);
         // echo '</pre>';
         ?>
         <?php require '../includes/header.php'; ?>
         <div class="bestsellers">
            <?php
            if ($isaccess === 'no') {
               $additionalParametr = ' WHERE isforeveryone = "yes" ';
            } else {
               $additionalParametr = '';
            }
            $bestsellers = mysqli_query($connection, "SELECT * FROM `books`" . $additionalParametr . " ORDER BY `sold_count` DESC LIMIT 12");
            ?>
            <div class="bestsellers__title">
               Найбільш популярні книги
            </div>
            <div class="bestsellers__body">
               <?php
               while ($bestseller = mysqli_fetch_assoc($bestsellers)) {
               ?>
                  <div class="bestsellers__item item-bestsellers">
                     <div class="item-bestsellers__body">
                        <a href="../pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                           <img class='item-bestsellers__bookimage' src="../static/books/<?php echo $bestseller['image'] ?>" alt="">
                        </a>
                        <?php
                        if (in_array($bestseller['id'], $_SESSION['currentFavourites'])) {
                        ?>
                           <img id="favourite<?php echo $bestseller['id'] ?>" class='item-bestsellers__favourite' src="../static/svg/favourite.svg" alt="">
                        <?php
                        } else {
                        ?>
                           <img id="favourite<?php echo $bestseller['id'] ?>" class='item-bestsellers__favourite' src="../static/svg/favourite-empty.svg" alt="">
                        <?php
                        }
                        ?>
                        <a class="item-bestsellers__title" href="../pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                           <?php echo $bestseller['title']; ?>
                        </a>
                        <div class="item-bestsellers__author">
                           <?php echo $bestseller['author']; ?>
                        </div>
                        <div class="item-bestsellers__price">
                           <?php echo ceil($bestseller['price'] * $discount) . ' грн'; ?>
                        </div>
                        <div class="item-bestsellers__buttons">
                           <a class="item-bestsellers__decription item-bestsellers__button" href="../pages/ProductPage.php?id=<?= $bestseller['id'] ?>">
                              Опис
                           </a>
                           <div id="basket<?php echo $bestseller['id'] ?>" class="item-bestsellers__buy item-bestsellers__button">
                              У кошик
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>
            </div>
            <a class="bestsellers__button" href="../pages/catalog.php">
               <!-- <a class="bestsellers__link" href="../pages/catalog.php"> -->
               Catalog
               <!-- </a> -->
            </a>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src='../js/index.js'></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.item-bestsellers__favourite').on('click', function(event) {
            // console.log(event.target);
            // console.log(event.target.getAttribute('src'));
            if (event.target.getAttribute('src').includes('empty')) {
               event.target.setAttribute('src', '../static/svg/favourite.svg')
            } else {
               event.target.setAttribute('src', '../static/svg/favourite-empty.svg')
            }

            let id = event.target.id;
            id = Number(id.slice(9));
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
         $('.item-bestsellers__buy').on('click', function(event) {
            let id = event.target.id;
            id = Number(id.slice(6));

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