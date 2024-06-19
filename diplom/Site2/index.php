<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background: linear-gradient(to right, #ff6f61, #d24d57);
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .u-sheet {
            margin: 20px;
        }
        .u-sheet h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .menu-item {
            background-color: #f0f0f0;
            border-radius: 8px;
            display: inline-block;
            margin: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
        }
        .menu-item img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }
        .menu-item h6 {
            font-size: 16px;
            margin: 10px 0;
        }
        .menu-item a {
            background-color: #ff6f61;
            color: #fff;
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function addToOrder(z_id, stol, bludo, price) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Блюдо добавлено в заказ");
                }
            };
            xhr.send("z_id=" + encodeURIComponent(z_id) +
                     "&stol=" + encodeURIComponent(stol) +
                     "&bludo=" + encodeURIComponent(bludo) +
                     "&price=" + encodeURIComponent(price));
        }
    </script>
</head>
<body data-home-page="Главная.html" data-home-page-title="Главная" data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="ru">
<header class="u-clearfix u-gradient u-header u-header" id="sec-80cf">
    <a href="Страница-1.html">Корзина</a>
</header>
<section class="u-clearfix u-grey-5 u-lightbox u-section-1" id="sec-7cda">
    <div class="u-clearfix u-sheet u-sheet-1">
        <?php
        include("connection/connect.php"); // Подключение к базе данных

        $meal_types = [1 => "Завтраки", 2 => "Обеды", 3 => "Ужины"];
        // Генерируем уникальный идентификатор заказа (z_id)
        $z_id = uniqid();

        // Устанавливаем номер стола (можно заменить на динамический ввод)
        $stol = 1;

        foreach ($meal_types as $vid => $meal_name) {
            echo "<h3 class='u-custom-font u-text u-text-default-xs u-text-1'>{$meal_name}</h3>";

            $sql = "SELECT * FROM menu WHERE vid = ?";
            $stmt = $db->prepare($sql);

            if ($stmt) {$stmt->bind_param("i", $vid);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $bludo = $row['name'];
                        $price = $row['price'];
                        echo "<div class='menu-item'>";
                        echo "<img src='images/{$row['photo']}' alt='{$bludo}' />";
                        echo "<h6>{$bludo} {$price}р</h6>";
                        echo "<a onclick=\"addToOrder('{$z_id}', '{$stol}', '{$bludo}', '{$price}')\" class='u-btn u-button-style u-palette-2-light-1'>+</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No dishes available for {$meal_name}</p>";
                }

                $stmt->close();
            } else {
                echo "Error preparing statement: " . $db->error;
            }
        }

        $db->close();
        ?>
    </div>
</section>
</body>
</html>