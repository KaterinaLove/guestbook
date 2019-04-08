<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Гостевая книга</title>
  <link rel="stylesheet" href="css/normaliz.css">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <?php include ("dbconnect.php");?>
</head>

<body>
  <h1 class="headline">Гостевая книга</h1>
  <!-- код формы -->
  <form action="action.php" id="loading" method="POST" enctype="multipart/form-data" class="form">
    <h3>Добавить сообщение</h3>
    <label class="label" for="username">Ваше имя: </label>
    <input class="form-row" type="text" name="username" id="username" placeholder="Ivan Ivanov" required>
    <label class="label" for="email">E-mail: </label>
    <input class="form-row" type="email" name="email" id="email" placeholder="ivanivanov@mail.ru" required>
    <label class="label" for="homepage">Ваш сайт: </label>
    <input class="form-row" type="text" name="homepage" id="homepage" placeholder="homepage.com">
    <label class="label" for="country">Вашa Страна: </label>
    <input class="form-row" type="text" name="country" id="country" placeholder="Россия" required>
    <label id="img" class="label label-img" for="country_img">выберите картинку страны</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <input class="input-img inputfile inputfile-1" type="file" name="country_img" id="country_img" data-multiple-caption="{count} files selected" multiple required>
    <label class="label" for="country_img">Ваше сообщение: </label>
    <textarea class="form-row textarea" placeholder="Комментарий" name="text" id="text" required rows="5"></textarea>
    <select class="form-row textarea" placeholder="Придумайте теги" name="tags" id="tags">
      <option>Дом</option>
      <option>Работа</option>
    </select>
    <input class="submit" id="btn" name="add" type="submit" value="Отправить сообщение">
  </form>
  <div id="messages"></div>
  <div id="error"></div>
  <!-- форма отправки сообщения -->
  <script>
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
        //отправка данных на сервер
        $.ajax({
          type: "POST",
          url: "action.php",
          data: "username=" + $("#username").val() +
            "&email=" + $("#email").val() +
            "&homepage=" + $("#homepage").val() +
            "&country=" + $("#country").val() +
            "&country_img=" + $("#country_img").val() +
            "&text=" + $("#text").val() +
            "&tags=" + $("#tags").val(),
          enctype: 'multipart/form-data',
          processData: false, // jQuery не обрабатывать данные
          contentType: false, // jQuery не устанавливет тип контента
          success: function(text) {
            show_messages();
          },
          error: function(xhr, status, error) {
            alert(xhr.responseText + '|\n' + status + '|\n' + error);
          }
        })
      });
      return false;
    });
    //стилизация input file
    $(document).ready(function() {
      $("#country_img").change(function() {
        var filename = $(this).val().replace(/.*\\/, "");
        $("#img").html(filename);
      });
    });
  </script>

</body>

</html>
