<?
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
?>