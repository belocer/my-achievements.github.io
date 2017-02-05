<?php

$user_id='';
if ( (isset($_POST['button_id'])) || (isset($_SESSION['id_article'])) ){

	// ПОИСК ПО id_article
	if(isset($_POST['id_search'])){
		$user_id = trim($_POST['id_search']);
	}

	// Проверяю нажата ли кнопка поиска
	if( (isset($_POST['button_id'])) || (isset($_SESSION['id_article'])) ){
		//Проверяю введено ли число
		if(is_numeric($user_id)){

			// Соединение сервером БД, и выбор БД
			$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

			$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
			$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
			$array_bd_id = pg_fetch_array($result_select_id);
			
		}else{
			
			$_SESSION['error'] = " это НЕ число!";
			
			}

		// Очистка результатов
		@pg_free_result($result_select_id);
	}
} 

	// ПОИСК ПО id_article
if( isset( $_GET['id_article'] )){
		$id_article=$_GET['id_article'];

			// Соединение сервером БД, и выбор БД
			$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

			$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$id_article';";
			$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
			$array_bd_id = pg_fetch_array($result_select_id);

		// Очистка результатов
		@pg_free_result($result_select_id);
}
?>
