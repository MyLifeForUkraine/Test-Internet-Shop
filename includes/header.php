<?php
session_start();
?>
<header class="header">
   <div class="header__logo logo-header">
      <img src="../static/svg/logo.svg" alt="">
      <a class='logo-header__text' href="/Test-Internet-Shop/pages/index.php"><?php echo $config['title']; ?></a>
   </div>
   <div class="header__search search-header">
      <form action="" class="search-header__form">
         <input type="text" class="search-header__input">
      </form>
      <img src="../static/svg/magnifying-glass.svg" alt="">
   </div>
   <div class="header__pages">
      <div class="header__page">
         <a href="/Test-Internet-Shop/pages/index.php" class="header__link-to-page">
            Головна
         </a>
      </div>
      <div class="header__page">
         <a href="/Test-Internet-Shop/pages/catalog.php" class="header__link-to-page">
            Каталог
         </a>
      </div>
      <?php
      if ($_SESSION['user']['role'] === 'admin') {
      ?>
         <div class="header__page">
            <a href="/Test-Internet-Shop/pages/AdminPage.php" class="header__link-to-page">
               Адмінка
            </a>
         </div>
      <?php
      }
      ?>
      <?php
      if ($_SESSION['user']) {
      ?>
         <div class="header__page">
            <a href="/Test-Internet-Shop/users/logout.php" class="header__link-to-page">
               Вийти
            </a>
         </div>
      <?php
      } else {
      ?>
         <div class="header__page">
            <a href="/Test-Internet-Shop/users/authorization.php" class="header__link-to-page">
               Увійти
            </a>
         </div>
      <?php
      }
      ?>
      <div class="header__page">
         <a href="/Test-Internet-Shop/pages/favourite.php" class="header__link-to-page">
            <img src="../static/svg/favourite.svg" alt="">
         </a>
      </div>
      <div class="header__page">
         <a href="/Test-Internet-Shop/pages/basket.php" class="header__link-to-page">
            <img src="../static/svg/basket.svg" alt="">
         </a>
      </div>
   </div>
   <?php

   echo $_SESSION['user']['role'];
   ?>
</header>