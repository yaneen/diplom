<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Заказы">
    <meta name="description" content="">
    <title>zakaz</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="zakaz.css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.11.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <script type="application/ld+json">{
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": ""
    }</script>
    <script>
    $(document).ready(function(){
        $(".u-btn").click(function(){
            var orderId = $(this).data('orderid'); // Получаем идентификатор заказа
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {orderId: orderId}, // Передаем идентификатор заказа на сервер
                success: function(response){
                    // Перезагружаем страницу после обновления статуса
                    location.reload();
                }
            });
        });

        // Обновление страницы каждые 5 секунд
        setInterval(function(){
            location.reload();
        }, 10000);
    });
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="zakaz">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>
<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="ru">
<header class="u-clearfix u-gradient u-header u-header" id="sec-650a">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="admin.php" class="u-btn u-button-style u-btn-1">Главная</a>
        <div class="u-container-align-center u-container-style u-expanded-width u-grey-10 u-group u-group-1">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
                <h2 class="u-align-center u-text u-text-default u-text-1">Заказы</h2>
            </div>
        </div>
    </div>
</header>
<section class="u-clearfix u-section-1" id="sec-bc75">
    <div class="u-clearfix u-sheet u-sheet-1">

        <?php
        // Подключение к базе данных
        include("connection/connect.php");

        // Проверка подключения
        if ($db->connect_error) {
            die("Ошибка подключения: " . $db->connect_error);
        }

        // Запрос на получение всех заказов с группировкой по z_id и подсчетом количества заказов
        $sql = "SELECT z_id, stol, GROUP_CONCAT(bludo SEPARATOR '\n') AS bludo, COUNT(*) AS order_count 
        FROM zakaz 
        WHERE status = 0
        GROUP BY z_id, stol";
        $result = mysqli_query($db, $sql);

        // Проверка выполнения запроса
        if ($result === false) {
            echo "Ошибка выполнения запроса: " . mysqli_error($db);
        } else {
            // Проверка на наличие заказов
            if (mysqli_num_rows($result) > 0) {
                // Цикл для отображения каждого заказа
                while ($row = mysqli_fetch_assoc($result)) {
                    // Отображение данных заказа в виде HTML-разметки
                    echo '<div class="u-container-style u-grey-10 u-group">';
                    echo '<div class="u-container-layout">';
                    echo '<p class="u-text u-text-default">Стол ' . htmlspecialchars($row['stol']) . '</p>';
                    echo '<p class="u-text u-text-default">' . nl2br(htmlspecialchars($row['bludo'])) . '</p>';
                    echo '<a href="#" class="u-btn u-button-style" data-orderid="' . $row['z_id'] . '">Готов к выдаче</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Сообщение об отсутствии заказов
                echo '<p class="u-text u-text-default">Нет заказов</p>';
            }
        }

        // Закрытие подключения к базе данных
        mysqli_close($db);
        ?>

    </div>
</section>
</body>
</html>