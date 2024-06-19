<?php
include("connection/connect.php");

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка, что данные переданы через POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подготовка и привязка
    $stmt = $conn->prepare("INSERT INTO menu (name, slogan, price, photo, vid) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }
    $stmt->bind_param("sisss", $name, $slogan, $price, $photo, $vid);

    // Установка параметров и выполнение
    $name = $_POST['name'];
    $slogan = $_POST['slogan'];
    $price = $_POST['price'];
	$photo = $_POST['photo'];
	$vid = $_POST['vid'];
	
    if ($stmt->execute()) {
        echo "Новый продукт успешно добавлен в меню";
    } else {
        echo "Ошибка выполнения запроса: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>