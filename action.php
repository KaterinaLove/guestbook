<?php
  include ("dbconnect.php");
  // получаем переменные из формы
  $username = $_POST['username'];
  $text = $_POST['text'];
  // добавление данных в БД 
  if (isset($_POST['username'])) {
      $sql = "INSERT INTO `gbook` SET
            `username` = '". $_POST['username'] ."',
            `email` = '". $_POST['email'] ."',
            `homepage` = '". $_POST['homepage'] ."',
            `country` = '". $_POST['country'] ."',
            `country_img` = '". $_POST['country_img'] ."',
            `text` = '". $_POST['text'] ."',
            `tags` = '". $_POST['tags'] ."',
            `created_at` = CURDATE()";
      $result = mysqli_query($link, $sql)or die("Ошибка " . mysqli_error($link));
  }
// закрываем подключение
    mysqli_close($link);
?>