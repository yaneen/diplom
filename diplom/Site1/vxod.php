<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Заказ​ы">
    <meta name="description" content="">
    <title>vxod</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="vxod.css" media="screen">

    <meta name="generator" content="Nicepage 6.11.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

<?php
include("connection/connect.php"); 
error_reporting(0); 
session_start(); 

$message = ""; // Инициализация переменной сообщения

if(isset($_POST['submit']))  
{
    $username = $_POST['username'];  
    $password = $_POST['password'];
    
    if(!empty($_POST["submit"]))   
    {
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='$password'"; // выбор подходящих записей
        $result = mysqli_query($db, $loginquery); // выполнение запроса
        $row = mysqli_fetch_array($result);
        
        if(is_array($row)) 
        {
            $_SESSION["adm_id"] = $row['adm_id']; 
            header("refresh:1;url=admin.php"); 
        } 
        else
        {
            $message = "Неправильный логин или пароль"; 
        }
    }
}
?>

    <script type="application/ld+json">{
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": ""
    }</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="vxod">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="ru">
    <section class="u-clearfix u-grey-5 u-valign-top u-section-1" id="sec-e3d0">
      <div class="u-container-align-center u-container-style u-expanded-width u-gradient u-group u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <img class="u-image u-image-contain u-image-default u-preserve-proportions u-image-1" src="images/logo.png" alt="" data-image-width="188" data-image-height="160">
        </div>
      </div>
      <div class="u-form u-form-1">
        <form action="vxod.php" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form" style="padding: 10px;">
          <div class="u-form-group u-form-name">
            <label for="name-a608" class="u-label">Логин</label>
            <input type="text" id="name-a608" name="username" class="u-input u-input-rectangle" required="">
          </div>
          <div class="u-form-email u-form-group">
            <label for="email-a608" class="u-label">Пароль</label>
            <input type="password" id="password" name="password" class="u-input u-input-rectangle" required="">
          </div>
          <div class="form">
            <span style="color:red;"><?php if(isset($_POST['submit'])) { echo $message; } ?></span>
          </div>
          <div class="u-align-right u-form-group u-form-submit">
            <input type="submit" class="u-btn u-btn-submit u-button-style" id="buttn" name="submit" value="Вход" /> <!--кнопка входа-->
          </div>
          <input type="hidden" value="" name="recaptchaResponse">
          <input type="hidden" name="formServices" value="125fc521-c0a5-a54f-07f1-7a5de386820a">
        </form>
      </div>
    </section>
</body>
</html>