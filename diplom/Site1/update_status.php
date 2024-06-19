<?php
// Подключение к базе данных
include("connection/connect.php");

// Проверяем, был ли передан идентификатор заказа
if(isset($_POST['orderId'])){
    // Получаем идентификатор заказа
    $orderId = $_POST['orderId'];
    
    // Обновляем статус заказа на 1
    $updateSql = "UPDATE zakaz SET status = 1 WHERE z_id = '$orderId'";
    mysqli_query($db, $updateSql);
}

// Закрываем подключение к базе данных
mysqli_close($db);
?>
