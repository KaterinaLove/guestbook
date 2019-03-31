<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Гостевая книга</title>
  <script type="text/javascript" src="jquery.js"></script>
  <?php include ("dbconnect.php");?>
</head>
<body>
  <h1>Гостевая книга</h1>
  <div id="messages">
  </div>
  <h3>Добавить сообщение</h3>
  <!-- код формы -->
  <form action="action.php" id="myForm" method="POST" enctype="multipart/form-data">
      Имя:<input type="text" name="username" id="username" placeholder="Ваше имя">
    e-mail:<input type="email" name="email" id="email" placeholder="e-mail">
    Домашняя страницa: <input type="text" name="homepage" id="homepage" placeholder="Домашняя страницa">
    Страна: <input type="text" name="country" id="country" placeholder="Вашa Страна">
    Картинка страны: <input type="file" name="country_img" id="country_img">
    <textarea placeholder="Комментарий" name="text" id="text" required></textarea>
    <textarea placeholder="Придумайте теги" name="tags" id="tags" required></textarea>
          <input id="btn" name="add" type="submit" value="Отправить сообщение">
  </form>
  <!-- форма отправки сообщения -->
  <script>
    //проверка заполнения формы
    function splash() {
      if (document.myForm.username.value == '') {
        alert("Заполните имя пользователя!");
        return false;
      }
      if (document.myForm.text.value == '') {
        alert("Заполните текст сообщения!");
        return false;
      }
      return true;
    }
    // загрузка сообщений из БД в контейнер messages
    function show_messages() {
      $.ajax({
        url: "show.php",
        cache: false,
        success: function(html) {
          $("#messages").html(html);
        }
      });
    }
//отправка данных
    $(document).ready(function() {
      show_messages();
      // контроль и отправка данных на сервер в фоновом режиме при нажатии на кнопку "отправить сообщение"
      $("#myForm").submit(function() {
        var name = $("#username").val();
        var text = $("#text").val();
        if (name == '') {
          alert("Заполните имя пользователя!");
          return false;
        }
        if (text == '') {
          alert("Заполните текст сообщения!");
          return false;
        }

        $.ajax({
          type: "POST",
          url: "action.php",
          data: "username=" + name + "&text=" + text,
          success: function(text) {
            show_messages();
          }
        });
        return false;
      });
    });
  </script>
</body>
</html>
