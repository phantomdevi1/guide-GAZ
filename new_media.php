<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
  <title>Добавление медиафайлов</title>
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
<div class="content_admin">
    <div class="burger-menu">
        <a href="index.php">Главная</a>
        <a href="all_news.php">Новости</a>
        <a href="guide.php">Справочник</a>
        <a class="admin_auth" href="#">Для администратора</a>
    </div>
    <div class="admin_toolbar">
        <a href="admin.php">Добавление пользователей</a>
        <a href="add_news.php">Добавление новостей</a>
        <a href="add_slider.php">Добавление слайдов</a>
        <a href="new_media.php">Добавление в медиатеку</a>
    </div>
    <h2>Добавление в медиатеку</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input class="new_user-btn" type="submit" value="Добавить">
    </form>
    <?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "img/mediateka/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<script>alert('Файл не является изображением');</script>";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "<script>alert('Такой файл уже существует');</script>";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "<script>alert('Извините, ваш файл слишком большой');</script>";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Извините, только JPG, JPEG, PNG и GIF файлы разрешены');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Ваш файл не был загружен.');</script>";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO media_library (filepath) VALUES ('$target_file')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Файл успешно добавлен в базу данных');</script>";
                } else {
                    echo "<script>alert('Ошибка: " . $sql . " " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Извините, произошла ошибка при загрузке вашего файла.');</script>";
            }
        }
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
</script>
</body>
</html>
