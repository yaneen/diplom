<?php
include("connection/connect.php");

// Проверка, что данные переданы через POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы редактирования
    $name = $_POST['name'];
    $slogan = $_POST['slogan'];
    $price = $_POST['price'];
    $photo = $_POST['photo'];
	$vid = $_POST['vid'];

    // Подготовка SQL запроса для редактирования записи в базе данных
    $stmt = $db->prepare("UPDATE menu SET slogan = ?, price = ?, photo = ?, vid = ? WHERE name = ?");
	if (!$stmt) {
		die("Ошибка при подготовке запроса: " . $db->error);
		}
    $stmt->bind_param("sdsss", $slogan, $price, $photo, $vid, $name);

    // Выполнение SQL запроса
    if ($stmt->execute()) {
        // Проверка успешности выполнения запроса
        if ($stmt->affected_rows > 0) {
            echo "Запись успешно отредактирована";
        } else {
            echo "Не найдена запись для редактирования с названием: $name";
        }
    } else {
        echo "Ошибка при редактировании записи: " . $stmt->error;
    }

    // Закрытие подготовленного запроса
    $stmt->close();
}

// Закрытие подключения к базе данных
mysqli_close($db);
?>
