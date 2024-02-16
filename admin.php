<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
  <title>Добавление</title>
  <link rel="icon" href="img\favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <img src="img/logo1.svg" alt="" onclick="toggleMenu(event)"/>
    <h1>Справочник </h1>
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
  <h2>Добавление пользователей</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="fio" placeholder="ФИО" required>
    <input type="text" name="post" placeholder="Должность" required>
    <input type="text" name="division" placeholder="Подразделение" required>
    <input type="text" name="phone" placeholder="Телефон" required>
    <input type="text" name="office" placeholder="Кабинет" required>
    <input type="text" name="mail" placeholder="Почта" required>
    <input class="new_user-btn" type="submit" value="Добавить">
  </form>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gazprom_guide";

  // Подключение к базе данных
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Проверка соединения
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Проверяем, была ли отправлена форма
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $fio = $_POST['fio'];
    $post = $_POST['post'];
    $division = $_POST['division'];
    $phone = $_POST['phone'];
    $office = $_POST['office'];
    $mail = $_POST['mail'];

    // Проверка на заполненность всех полей
    if(!empty($fio) && !empty($post) && !empty($division) && !empty($phone) && !empty($office) && !empty($mail)) {
      // Подготавливаем SQL запрос
      $sql = "INSERT INTO guide (FIO, post, division, phone, office, mail) VALUES ('$fio', '$post', '$division', '$phone', '$office', '$mail')";

      if ($conn->query($sql) === TRUE) {
        echo "<script>alert(' Данные успешно добавлены в базу данных');</script>";
      } else {
        echo "<script>alert(' Ошибка: " . $sql . " " . $conn->error . "');</script>";
      }
    } else {
      echo "<script>alert(' Все поля должны быть заполнены');</script>";
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
