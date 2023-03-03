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
   <title>Admin</title>
   <link rel='stylesheet' href='../css/admin-page.css'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <?php
   if ($_SESSION['user']['role'] !== 'admin') {
      header('Location: index.php');
   }
   ?>
   <div class="wrapper">
      <div class="container">
         <?php require '../includes/header.php'; ?>
         <?php
         // $area = false;
         ?>
         <div class="main">
            <div class="main__sidebar sidebar-main">
               <div class="sidebar-main__body">
                  <div class="sidebar-main__item">
                     <img id="area1" class="sidebar-main__area" src="../static/svg/users.svg">
                     <div class="sidebar-main__title">
                        Користувачі
                     </div>
                  </div>
                  <div class="sidebar-main__item">
                     <img id="area2" class="sidebar-main__area" src="../static/svg/books.svg">
                     <div class="sidebar-main__title">
                        Книги
                     </div>
                  </div>
                  <div class="sidebar-main__item">
                     <img id="area3" class="sidebar-main__area" src="../static/svg/orders.svg">
                     <div class="sidebar-main__title">
                        Заявки
                     </div>
                  </div>
               </div>
            </div>
            <div class="main__content">
               <div class="main__default main__area">
                  <div class="main__default-title">
                     Оберіть область для керування в боковій панелі
                  </div>

               </div>
               <div class="main__users main__area">
                  users
               </div>
               <div class="main__books main__area">
                  <div class="main__books-title">
                     Створити новий товар
                  </div>
                  <form action="../handlers/addBook.php" method="post" class="form-content__form" enctype="multipart/form-data">
                     <label class="form-content__label">Назва</label>
                     <input required type="text" name="title" class="form-content__input" placeholder="Введіть назву книги">
                     <label class="form-content__label">Автор</label>
                     <input required type="text" name="author" class="form-content__input" placeholder="Введіть автора">
                     <label class="form-content__label">Опис</label>
                     <textarea placeholder="Напишіть опис книги" name="description" id="" cols="30" rows="10" required class="form-content__textarea"></textarea>
                     <label class="form-content__label">Зображення</label>
                     <input required type="file" name="image" class="form-content__input">
                     <label class="form-content__label">Жанр</label>
                     <input required type="text" name="book_id" class="form-content__input" placeholder="Введіть код жанру">
                     <label class="form-content__label">Ціна</label>
                     <input required type="text" name="price" class="form-content__input" placeholder="Введіть ціну без знижки">
                     <label class="form-content__label">Кількість на складі</label>
                     <input required type="text" name="count" class="form-content__input" placeholder="Введіть наявну кількість книжок даного типу">
                     <label class="form-content__label">Рік написання</label>
                     <input required type="text" name="year" class="form-content__input" placeholder="Введіть рік написання книги">
                     <label class="form-content__label">Якою мовою</label>
                     <input required type="text" name="language" class="form-content__input" placeholder="Введіть код мови">
                     <label class="form-content__label">Країна</label>
                     <input required type="text" name="country" class="form-content__input" placeholder="Введіть код країни">
                     <label class="form-content__label">Кількість проданих екземплярів</label>
                     <input required type="text" name="sold_count" class="form-content__input" placeholder="Введіть кількість проданих книжок даного типу">
                     <label class="form-content__label">Чи буде доступна незареєстрованим користувачам</label>
                     <input required type="text" name="isforeveryone" class="form-content__input" placeholder="Чи буде книга доступна незареєстрованим покупцям? yes/no">
                     <button type="submit" class="form-content__button">Створити товар</button>
                  </form>
               </div>
               <div class="main__orders main__area">
                  Orders
               </div>
            </div>
         </div>
         <?php require '../includes/footer.php'; ?>
      </div>
   </div>
   <script src="../js/admin.js">

   </script>
</body>

</html>