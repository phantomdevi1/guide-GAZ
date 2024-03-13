<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
  <title>Добавление новостей</title>
  <link rel="icon" href="img\favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <img src="img/logo1.svg" alt="" onclick="toggleMenu(event)"/>
    <h1>Справочник</h1>
    <span>администратор</span>
</header>
<div class="content_admin">
<div class="burger-menu">
        <a href="index.php">Главная</a>
        <a href="all_news.php">Новости</a>
        <a href="guide.php">Справочник</a>
        <a class="admin_auth" href="#">Для администратора</a>
    </div>
    <div class="admin_toolbar">
      <a href="admin.php">Добавление позователей</a>
      <a href="add_news.php">Добавление новостей</a>
      <a href="add_slider.php">Добавление слайдов</a>
    </div>
  <h2>Добавление новостей</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="title" placeholder="Напишите заголовок" required>
    <textarea name="content" id="" cols="30" rows="10" placeholder="Напишите новость" required></textarea>
    <input class="new_user-btn" type="submit" value="Добавить">
  </form>
  <?php
  include 'config.php';

  // Проверяем, была ли отправлена форма
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $title = $_POST['title'];
    $content = $_POST['content'];

    if(!empty($title) && !empty($content)) {
      $sql = "INSERT INTO news (`date`, `title`, `content`) VALUES (CURDATE(),'$title', '$content')"; // Заменили date() на CURDATE() для корректной вставки текущей даты

      if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Данные успешно добавлены в базу данных');</script>";
      } else {
        echo "<script>alert('Ошибка: " . $sql . " " . $conn->error . "');</script>";
      }
    } else {
      echo "<script>alert('Пожалуйста, заполните все поля');</script>";
    }
  }

  // Закрываем соединение
  $conn->close();
  ?>
  
</div>
<script>
   function toggleMenu(event) {
        var burgerMenu = document.querySelector('.burger-menu');
        burgerMenu.classList.toggle('active');
        event.stopPropagation(); // Остановка всплытия события
    }
</script>
</body>
</html>
