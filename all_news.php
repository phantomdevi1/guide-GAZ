<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
  <title>Новости</title>
  <link rel="icon" href="img\favicon.png" type="image/x-icon">
  <style>
    .all_news-content {
      overflow: hidden;
      max-height: 100px; 
      transition: max-height 0.3s ease-out;
    }
    .read-more {
      display: none;
    }
    .all_news-item.expanded .all_news-content {
      max-height: none;
    }
    .all_news-item.expanded .read-more {
      display: none;
    }
  </style>
</head>
<body>
<header>
    <img src="img/logo1.svg" alt="" onclick="toggleMenu(event)"/>
    <h1>Новости</h1>
</header>
<div class="burger-menu">
        <a href="index.php">Главная</a>
        <a href="all_news.php">Новости</a>
        <a href="guide.php">Справочник</a>
        <a class="admin_auth" href="#">Для администратора</a>
    </div>
<div class="content_all_news">

<div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="loginForm" method="post">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password">
                <button type="submit" name="login">Войти</button>
            </form>
        </div>
    </div>
    <?php
    session_start();
    if (isset($_POST['login'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        include 'config.php';

        $sql = "SELECT * FROM admin_info WHERE name='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit;
        } else {
            echo "<script>alert('Неверный логин или пароль');</script>";
        }

        $conn->close();
    }
    ?>

<p class="title_all_news">Все новости</p>
    <?php
      // Подключение к базе данных
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "gazprom_guide";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Запрос для получения всех новостей из базы данных
      $sql = "SELECT * FROM news ORDER BY date DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Вывод всех новостей
          while ($row = $result->fetch_assoc()) {
              $content = $row["content"];
              $isContentLong = mb_strlen($content) > 200; // Используем mb_strlen для корректной работы с многобайтовыми символами
              echo "<div class='all_news-item" . ($isContentLong ? " expanded" : "") . "'>";
              echo "<h3 class='news-title'>" . $row["title"] . "</h3>";
              echo "<span class='all_news-date'>" . $row["date"] . "</span>";
              echo "<div class='all_news-content'>" . $content . "</div>";
              if ($isContentLong) {
                echo "<button class='read-more' onclick='toggleReadMore(this)'>Читать далее</button>";
              }
              echo "</div>";
          }
      } else {
          echo "<p>Новостей нет.</p>";
      }

      $conn->close();
    ?>
</div>
<script>
  function toggleMenu(event) {
    var burgerMenu = document.querySelector('.burger-menu');
    burgerMenu.classList.toggle('active');
    event.stopPropagation();
  }


  function closeModal() {
        var loginModal = document.getElementById('loginModal');
        loginModal.style.display = 'none';
    }

    document.querySelector('.admin_auth').addEventListener('click', function(event) {
        event.preventDefault();
        var loginModal = document.getElementById('loginModal');
        loginModal.style.display = 'block';
    });
</script>
</body>
</html>
