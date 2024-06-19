<?php
include("connection/connect.php");

// Получение данных из формы редактирования
$productName = $_POST['productNameEdit'];
$quantity = $_POST['quantityEdit'];
$necessity = $_POST['necessityEdit'];

// SQL запрос для редактирования записи в базе данных
$sql = "UPDATE sklad SET colvsklad = '$quantity', colvonado = '$necessity' WHERE namebl = '$productName'";

// Выполнение SQL запроса
if(mysqli_query($db, $sql)){
    // Проверка успешности выполнения запроса
    if (mysqli_affected_rows($db) > 0) {
        echo "Запись успешно отредактирована";
    } else {
        echo "Не найдена запись для редактирования с названием: $productName";
    }
} else{
    echo "Ошибка при редактировании записи: " . mysqli_error($db);
}

// Закрытие подключения к базе данных
mysqli_close($db);
?>