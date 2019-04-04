<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Гостевая книга</title>
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="jquery.js"></script>
  <?php include ("dbconnect.php");?>
</head>
<body>
  <h1>Гостевая книга</h1>
  <div id="messages"></div>
  <div id="error"></div>
  <h3>Добавить сообщение</h3>
  <!-- код формы -->
  <form action="" id="loading" method="POST" enctype="multipart/form-data">
    <label for="username">Имя: </label>
    <input type="text" name="username" id="username" placeholder="Ваше имя">
    <label for="email">e-mail: </label>
    <input type="email" name="email" id="email" placeholder="e-mail">
    <label for="homepage">Домашняя страницa: </label>
    <input type="text" name="homepage" id="homepage" placeholder="Домашняя страницa">
    <label for="country">Страна: </label>
    <input type="text" name="country" id="country" placeholder="Вашa Страна">
    <label for="country_img">Картинка страны: </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <input type="file" name="country_img" id="country_img">
    <textarea placeholder="Комментарий" name="text" id="text" required></textarea>
    <textarea placeholder="Придумайте теги" name="tags" id="tags" required></textarea>
    <input id="btn" name="add" type="submit" value="Отправить сообщение">
  </form>
  <!-- форма отправки сообщения -->
  <script>
    //проверка заполнения формы
    function splash() {
      if (document.loading.username.value == '') {
        alert("Заполните имя пользователя!");
        return false;
      }
      if (document.loading.text.value == '') {
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
      // Проверка заполненности фармы
      $("#loading").submit(function() {
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
        //отправка данных на сервер
        $.ajax({
          type: "POST",
          url: "action.php",
          data: "username=" + $("#username").val() + 
                "&email=" +  $("#email").val() +
                "&homepage=" +  $("#homepage").val() +
                "&country=" +  $("#country").val() +
                "&country_img=" + $("#country_img").val() +
                "&text=" +  $("#text").val() +
                "&tags=" +  $("#tags").val(),
          enctype: 'multipart/form-data',
          headers: {
            'X-Csrf-Token':token
          },  // Защита от CSRF-атак
          processData: false,  // jQuery не обрабатывать данные
          contentType: false,  // jQuery не устанавливет тип контента
          success: function(text) {
            show_messages();
          },
          error: function(xhr, status, error) {
            alert(xhr.responseText + '|\n' + status + '|\n' +error);
          }
          })
        });
        return false;
    });
  </script>
</body>
</html>
