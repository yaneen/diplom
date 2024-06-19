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
    $stmt = $conn->prepare("INSERT INTO sklad (namebl, colvsklad, colvonado) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }
    $stmt->bind_param("sis", $productName, $quantity, $necessity);

    // Установка параметров и выполнение
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $necessity = $_POST['necessity'];

    if ($stmt->execute()) {
        echo "Новый продукт успешно добавлен";
    } else {
        echo "Ошибка выполнения запроса: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>