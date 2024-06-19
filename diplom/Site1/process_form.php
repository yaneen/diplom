<?php
// Подключение к базе данных
include("connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получение данных из формы
    $name = $_POST['name'];
    $slogan = $_POST['slogan'];
    $price = $_POST['price'];
    $photo = $_POST['photo'];

    // Подготовка SQL-запроса для вставки данных
    $sql = "INSERT INTO dishes (name, slogan, price, photo) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss", $name, $slogan, $price, $photo);

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Данные успешно добавлены!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    // Закрытие запроса и соединения с базой данных
    $stmt->close();
    $db->close();
}
?>
