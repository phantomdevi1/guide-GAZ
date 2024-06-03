<?php
session_start();

// Подключение к базе данных
include 'config.php';

// Извлечение медиафайлов из базы данных
$sql = "SELECT * FROM media_library";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
    <title>Главная</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <img src="img/logo1.svg" alt="" onclick="document.location='index.php'"/>
        <div class="toolbar">
            <a href="index.php">Главная</a>
            <a href="all_news.php">Новости</a>
            <a href="guide.php">Справочник</a>
            <a href="mediateka.php">Медиатека</a>
            <a class="admin_auth" href="#">Для администратора</a>
        </div>
    </header>
    <div class="content_index">
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
                if (isset($_POST['login'])) {
                    // Проверка логина и пароля
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Подключение к базе данных
                    include 'config.php';

                    $sql = "SELECT * FROM admin_info WHERE name='$username' AND password='$password'";
                    $loginResult = $conn->query($sql);

                    if ($loginResult->num_rows > 0) {
                        $_SESSION['username'] = $username;
                        header("Location: admin.php");
                        exit;
                    } else {
                        echo "<script>alert('Неверный логин или пароль');</script>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="index_document">
            <p class="document_title">Медиатека</p>
            <div class="media_gallery">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="media_item">';
                        echo '<img src="' . $row['filepath'] . '" alt="Image">';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Ой-Ой... Медиафайлов пока нет.</p>';
                }
                ?>
            </div>
        </div>
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

<?php
$conn->close();
?>
