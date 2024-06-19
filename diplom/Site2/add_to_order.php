
<?php
include("connection/connect.php"); // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $z_id = $_POST['z_id'];
    $stol = $_POST['stol'];
    $bludo = $_POST['bludo'];
    $price = $_POST['price'];
    $status = 0;

    $sql = "INSERT INTO zakaz (stol, bludo, price, z_id, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isisi", $stol, $bludo, $price, $z_id, $status);
        if ($stmt->execute()) {
            echo "Блюдо добавлено в заказ";
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Ошибка подготовки запроса: " . $db->error;
    }

    $db->close();
} else {
    echo "Неправильный метод запроса";
}
?>