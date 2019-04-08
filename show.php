<!-- блок отображения сообщений-->
<?php
  include ("dbconnect.php");
  $c = 0;
  $result = mysqli_query ($link, $sql = "SELECT * FROM `gbook` ORDER BY `gbook`.`created_at` DESC"); // выбор всех записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  // для каждой записи организуем вывод.
  {
    if ($c % 2)
      $col="bgcolor='#F5E9D9'";	// цвет для четных записей
    else
      $col="bgcolor='#fffdee'";	// цвет для нечетных записей
?>
<table <? echo $col; ?> class="message">
  <tr>
    <td class="name">Имя пользователя:</td>
    <td class="value">
      <?php echo $row['username']; ?>
    </td>
  </tr>
  <tr>
    <td class="name">Дата опубликования:</td>
    <td class="name">
      <?php echo $row['created_at']; ?>
    </td>
  </tr>
  <tr>
    <td class="name" rowspan="2">Страна:</td>
    <td class="value">
      <?php echo $row['country']; ?>
    </td>
  </tr>
  <tr>
    <td class="value">
      <img src="img/<?php echo $row['country_img']; ?>" alt="<?php echo $row['country']; ?>" width="200">
    </td>
  </tr>
  <tr>
    <td colspan="2" class="value mes">
      <?php echo $row['text']; ?>
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
