<footer class="footer">
   <div class="footer__body">
      <div class="footer__logo logo-footer">
         <img src="../static/svg/logo-white.svg" alt="">
         <div class="logo-footer__text">
            <?php echo $config['title']; ?>
         </div>
      </div>
      <div class="footer__social social-footer">
         <p class='social-footer__text'>Зв'язатися з нами</p>
         <div class="social-footer__element">
            <a target="_blank" href="<?php echo $config['telegram_url'] ?>">
               <img class="footer__qr" src="../static/svg/telegram-qr.svg">
            </a>
         </div>
      </div>
      <div class="footer__navigation navigation-footer">
         <ul class="navigation-footer__list">
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="/Test-Internet-Shop/pages/index.php">Головна</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="/Test-Internet-Shop/pages/catalog.php">Каталог</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="/Test-Internet-Shop/pages/favourite.php">Бажані</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="/Test-Internet-Shop/pages/basket.php">Корзина</a>
            </li>
         </ul>
      </div>
   </div>
</footer>