<?php
  // название  сервера БД
  define ("HOST", "localhost");
  // пользователь MySQL
  define ("MYSQL_USER", "root");
  // пароль к MYSQL
  define ("MYSQL_PASS", "");
  // название базы данных
  define ("DATABASE", "test");
  // создаем базу данных и таблицу  gb
  $link = mysqli_connect(HOST, MYSQL_USER, MYSQL_PASS, DATABASE) or die("Нет соединения с MySQL сервером!");
?>