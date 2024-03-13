<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
  <title>Главная</title>
  <link rel="icon" href="img\favicon.png" type="image/x-icon">

</head>
<body>
<header>
    <img src="img/logo1.svg" alt="" onclick="toggleMenu(event)"/>
</header>
<div class="content_index">
<div class="burger-menu">
        <a href="index.php">Главная</a>
        <a href="all_news.php">Новости</a>
        <a href="guide.php">Справочник</a>
        <a class="admin_auth" href="#">Для администратора</a>
    </div>

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

            <?php
    session_start();
    if (isset($_POST['login'])) {
        // Проверка логина и пароля (замените этот код на вашу реализацию проверки)
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Подключение к базе данных
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
        </div>
    </div>

    <div class="slider-container">
      <div class="slider">
        <?php
          // Подключение к базе данных
          include 'config.php';

          // Запрос для получения слайдов из базы данных
          $sql = "SELECT * FROM slides";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Вывод слайдов
              while ($row = $result->fetch_assoc()) {
                  echo "<div class='slide'><img src='" . $row["image_path"] . "' alt='" . $row["title"] . "'></div>";
              }
          } else {
              echo "<div class='slide'>Слайдов нет</div>";
          }

          $conn->close();
        ?>
        <div class="arrow prev" onclick="prevSlide()">&#10094;</div>
      <div class="arrow next" onclick="nextSlide()">&#10095;</div>
      </div>
      
    </div>

<div class="news">
  <p>Новости</p>
  <a class="view_all_news" href="all_news.php">Смотреть все новости</a>
  <?php
  // Подключение к базе данных
  include 'config.php';

  // Запрос для получения двух последних новостей из базы данных
  $sql = "SELECT * FROM news ORDER BY date DESC LIMIT 2";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Вывод двух последних новостей
      while ($row = $result->fetch_assoc()) {
          echo "<div class='news-item'>";
          echo "<span class='news-date'>" . $row["date"] . "</span>";
          echo "<h3 class='news-title'><a href='#'>" . $row["title"] . "</a></h3>";
          echo "</div>";          
      }
  } else {
      echo "<p>Новостей нет.</p>";
  }

  $conn->close();
  ?>

</div>



</div>
<script>
  var slideIndex = 0;
  var slides = document.querySelectorAll('.slide');

  function showSlide(index) {
    if (index >= slides.length) {
      slideIndex = 0;
    } else if (index < 0) {
      slideIndex = slides.length - 1;
    }

    for (var i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }

    slides[slideIndex].style.display = 'flex';
  }

  function nextSlide() {
    slideIndex++;
    showSlide(slideIndex);
  }

  function prevSlide() {
    slideIndex--;
    showSlide(slideIndex);
  }

  setInterval(nextSlide, 7000); // Перелистывать слайды каждые 7 секунд
</script>

<script>
  function toggleMenu(event) {
        var burgerMenu = document.querySelector('.burger-menu');
        burgerMenu.classList.toggle('active');
        event.stopPropagation(); // Остановка всплытия события
    }

    function closeModal() {
        var loginModal = document.getElementById('loginModal');
        loginModal.style.display = 'none';
    }

    document.addEventListener('click', function (event) {
        var burgerMenu = document.querySelector('.burger-menu');
        if (!event.target.closest('.burger-menu') && burgerMenu.classList.contains('active')) {
            burgerMenu.classList.remove('active');
        }
    });

    document.querySelector('.admin_auth').addEventListener('click', function(event) {
        event.preventDefault();
        var loginModal = document.getElementById('loginModal');
        loginModal.style.display = 'block';
    });
</script>
</body>
</html>
