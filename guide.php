<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"/>
    <title>Справочник</title>
    
</head>
<body>
<header>
    <img src="img/logo1.svg" alt="" onclick="toggleMenu(event)"/>
    <h1>Справочник</h1>
</header>
<div class="content_guide">
    <div class="burger-menu">
        <a href="#">Для администратора</a>
    </div>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="loginForm" action="login.php" method="post">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password">
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
    <p>
        Для поиска по справочнику нажмите сочетание клавиш Ctrl+Q
    </p>
    <p>
        В случае обнаружения неточности в справочнике просьба сообщать на почту
        <a href="support@gazprom.ru">support@gazprom.ru</a>
    </p>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Фото</th>
            <th>Должность</th>
            <th>Подразделение</th>
            <th>Телефон</th>
            <th>Кабинет</th>
            <th>Почта</th>
        </tr>
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


        $sql = "SELECT `FIO`, `post`, `division`, `phone`, `office`, `mail`, `img` FROM `guide`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Вывод данных в таблицу
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["FIO"] . "</td>";
                if ($row["img"] != NULL) {
                    echo "<td class='img_table'><img class='nonstatic_ava' src='" . $row["img"] . "' alt='Фото'></td>";
                } else {
                    echo "<td class='img_table'><img src='img\ava\default_photo.jpg' alt='Дефолт'></td>";
                }
                echo "<td>" . $row["post"] . "</td>";
                echo "<td>" . $row["division"] . "</td>";
                echo "<td class='num_phone'>" . $row["phone"] . "</td>";
                echo "<td>" . $row["office"] . "</td>";
                echo "<td><a href='mailto:" . $row["mail"] . "'>" . $row["mail"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 результатов";
        }
        $conn->close();
        ?>
    </table>
</div>

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

    document.querySelector('.burger-menu a').addEventListener('click', function(event) {
        event.preventDefault();
        var loginModal = document.getElementById('loginModal');
        loginModal.style.display = 'block';
    });
</script>
</body>
</html>
