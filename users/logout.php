<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['currentFavourites']);
header('Location: authorization.php');
