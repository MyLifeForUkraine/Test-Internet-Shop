<?php

require '../includes/config.php';
session_start();
// if ($_SESSION['user']['username']) {
//    $discount = 0.9;
//    $isaccess = 'yes';
//    // $_SESSION['currentFavourites'] = $SESS;
// } else {
//    $discount = 1;
//    $isaccess = 'no';
//    if (!$_SESSION['currentFavourites']) {
//       $_SESSION['currentFavourites'] = [];
//    }
//    if (!$_SESSION['currentBasket']) {
//       $_SESSION['currentBasket'] = array();
//    }
// }

$title =  $_POST['title'];
$author =  $_POST['author'];
$description =  $_POST['description'];
$book_id =  $_POST['book_id'];
$price =  $_POST['price'];
$count =  $_POST['count'];
$year =  $_POST['year'];
$language =  $_POST['language'];
$country =  $_POST['country'];
$sold_count =  $_POST['sold_count'];
$isforeveryone =  $_POST['isforeveryone'];

// echo $title . '<br>';
// echo $author  . '<br>';
// echo $description . '<br>';
// echo $book_id . '<br>';
// echo $price . '<br>';
// echo $count . '<br>';
// echo $year . '<br>';
// echo $language . '<br>';
// echo $country . '<br>';
// echo $sold_count . '<br>';
// echo $isforeveryone . '<br>';
$description_safe = '';
for ($i = 0; $i < mb_strlen($description); $i++) {
   if ($description[$i] !== "'") {
      $description_safe[$i] = $description[$i];
   }
}
$path =  time() . $_FILES['image']['name'];
// echo $path . '<br>';
// echo $_FILES['image']['tmp_name'] . '<br>';
// echo '../static/books/' . $path . '<br>';
move_uploaded_file($_FILES['image']['tmp_name'], '../static/books/' . $path);
// if () {
//    // echo 'UUUUUUUURRRRRRRRRRAAAAAAAAAAA';
// }
// // ../static/books/
// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';
echo "INSERT INTO `books` (`id`, `title`, `author`, `description`, `image`, `book_id`, `publication_date`, `price`, `count`, `year`, `language`, `country`, `sold_count`, `isforeveryone`)
VALUES (NULL, '$title', '$author, '$description_safe, '$path', '$book_id, CURRENT_TIMESTAMP, '$price', '$count', '$year', '$language', '$country', '$sold_count', '$isforeveryone')";
mysqli_query($connection, "INSERT INTO `books` (`id`, `title`, `author`, `description`, `image`, `book_id`, `publication_date`, `price`, `count`, `year`, `language`, `country`, `sold_count`, `isforeveryone`)
VALUES (NULL, '$title', '$author', '$description_safe', '$path', '$book_id' , CURRENT_TIMESTAMP, '$price', '$count', '$year', '$language', '$country', '$sold_count', '$isforeveryone')");


header('Location: ../pages/AdminPage.php');
