<?php
session_start();
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

if( isset ( $_POST["logout"] ) ){
	
// Запись в БД таблица transaction
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$user_id = $_SESSION['users_id'];
$log_out = 1;
$insert_to = "INSERT INTO dbelotserkovets_transaction(users_id, log_out, date_time) VALUES ('$user_id', '$log_out', NOW());";
pg_query($dbconn, $insert_to) or die('Ошибка запроса записи: ' . pg_last_error());	
	
	
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	unset($_SESSION);
	unset($_POST);
	unset($_GET);
	session_destroy();
	header('Location: index.php');
	}
