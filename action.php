<?php
  include ("dbconnect.php");
  else ($_FILES['country_img']['error'] !== 0){
    $error_types = array(
      0 => 'There is no error, the file uploaded with success',
      1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      3 => 'The uploaded file was only partially uploaded',
      4 => 'No file was uploaded',
      6 => 'Missing a temporary folder',
      7 => 'Failed to write file to disk.',
      8 => 'A PHP extension stopped the file upload.',
    );
    $error_message = $error_types[$_FILES['userfile']['error']];
  }
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