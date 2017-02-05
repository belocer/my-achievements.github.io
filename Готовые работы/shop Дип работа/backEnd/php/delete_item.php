<?php
session_start();
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['button_delete'])){
		
		//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	
	$user_id = trim($_POST['id_search']);
		//Создание и выполнение запроса на запись данных в БД
	$user_delete = "DELETE FROM dbelotserkovets_product WHERE id_article = '$user_id'";
	$result_delete= @pg_query($dbconn, $user_delete) or die('Ошибка запроса записи: ' . pg_last_error());

		//Очистка результатов
	pg_free_result($result_delete);

		//Закрытие соединения
	pg_close($dbconn);	
	
}

/*=============Удаление файла из папки и путей из БД==============*/
if(isset($_POST['foto1_delete'])) 
{
	
	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file1'];
	unlink($del);
	$path_file1 = '';
	$insert = "UPDATE dbelotserkovets_product SET path_file1 = '$path_file1' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
	$_SESSION['id_article'] = $user_id;
}
if(isset($_POST['foto2_delete'])) 
{
	
	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file2'];
	unlink($del);
	$path_file2 = '';
	$insert = "UPDATE dbelotserkovets_product SET path_file2 = '$path_file2' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
	$_SESSION['id_article'] = $user_id;
}
if(isset($_POST['foto3_delete'])) 
{
	
	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file3'];
	unlink($del);
	$path_file3 = '';
	$insert = "UPDATE dbelotserkovets_product SET path_file3 = '$path_file3' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
	$_SESSION['id_article'] = $user_id;
}
if(isset($_POST['foto4_delete'])) 
{
	
	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file4'];
	unlink($del);
	$path_file4 = '';
	$insert = "UPDATE dbelotserkovets_product SET path_file4 = '$path_file4' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
	$_SESSION['id_article'] = $user_id;
}
/*
echo "<pre>";
var_dump($_POST['badge']);
print_r($_POST['badge']);
echo $_POST['badge'];
echo "<hr>";
var_dump($_POST['category']);
echo "</pre>";*/
 
?>













