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
               <a class="item-navigation-footer__link" href="MainPage.html">Головна</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="MenuPage.html">Каталог</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="BlogPage.html">Бажані</a>
            </li>
            <li class="navigation-footer__item item-navigation-footer">
               <a class="item-navigation-footer__link" href="ContactsPage.html">Корзина</a>
            </li>
         </ul>
      </div>
   </div>
</footer>