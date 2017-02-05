<?php
session_start();
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error()); 
