<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['currentFavourites']);
unset($_SESSION['currentBasket']);
header('Location: authorization.php');
