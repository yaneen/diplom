<?php
include("connection/connect.php");

// Проверяем, получено ли название продукта
if(isset($_POST['productNameDel'])) {
    $productName = $_POST['productNameDel'];
    
    
    
    // Запрос на удаление строки из таблицы
    $sql = "DELETE FROM sklad WHERE namebl = '$productName'";
    
    // Выполнение запроса
    if(mysqli_query($db, $sql)){
        echo "Запись успешно удалена";
    } else{
        echo "Ошибка при удалении записи: " . mysqli_error($db);
    }
} else {
    echo "Название продукта для удаления не получено";
}

// Закрытие подключения к базе данных
mysqli_close($db);
?>














