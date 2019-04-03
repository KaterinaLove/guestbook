<?php
  include ("dbconnect.php");
//переименуем для удобства
  $name = $_FILES['country_img']['name'];
  $tmp_name = $_FILES['country_img']['tmp_name'];
//найдем mime
  $imageFileType = pathinfo($name, PATHINFO_EXTENSION);
  //получим новое имя
  $newname = random_int(1 , 99999999) . '.' . $imageFileType;
  //добавление файла в папку
  move_uploaded_file($tmp_name, "img/" . $newname);
  // добавление данных в БД 
  if (isset($_POST['username'])) {
      $sql = "INSERT INTO `gbook` SET
            `username` = '". $_POST['username'] ."',
            `email` = '". $_POST['email'] ."',
            `homepage` = '". $_POST['homepage'] ."',
            `country` = '". $_POST['country'] ."',
            `country_img` = '". $newname ."',
            `text` = '". $_POST['text'] ."',
            `tags` = '". $_POST['tags'] ."',
            `created_at` = CURDATE()";
      $result = mysqli_query($link, $sql)or die("Ошибка " . mysqli_error($link));
  }
// закрываем подключение
    mysqli_close($link);
?>