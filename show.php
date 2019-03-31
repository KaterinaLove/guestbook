<!-- блок отображения сообщений-->
<?php
  include ("dbconnect.php");
  $c = 0;
  $result = mysqli_query ($link, $sql = "SELECT * FROM `gbook`  \n"
    . "ORDER BY `gbook`.`created_at` DESC"); // выбор всех записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  // для каждой записи организуем вывод.
  {
    if ($c % 2)
      $col="bgcolor='#f9f9f9'";	// цвет для четных записей
    else
      $col="bgcolor='#f0f0f0'";	// цвет для нечетных записей
?>
<table <? echo $col; ?>>
  <tr>
    <td>Имя пользователя:</td>
    <td>
      <?php echo $row['username']; ?>
    </td>
  </tr>
  <tr>
    <td>Дата опубликования:</td>
    <td>
      <?php echo $row['created_at']; ?>
    </td>
  </tr>
  <tr>
    <td>Сообщение:</td>
    <td>
      <?php echo $row['text']; ?>
    </td>
  </tr>
  <tr>
    <td>Страна:</td>
    <td>
      <?php echo $row['country']; ?>
    </td>
  </tr>
  <tr>
    <td>Страна:</td>
    <td>
      <img src="img/<?php echo $row['country_img']; ?>" alt="<?php echo $row['country']; ?>">
    </td>
  </tr>
  <tr>
    <td>Дата опубликования:</td>
    <td>
      <?php echo $row['created_at']; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <?php echo $row['msg']; ?>
      <br>
    </td>
  </tr>

</table>
<?php
    $c++;
  }
  if ($c == 0) // если ни одной записи не встретилось
    echo "Гостевая книга пуста!<br>";
// закрываем подключение
    mysqli_close($link);
?>
