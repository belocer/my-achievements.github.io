<?php
require_once 'require.php';

if(isset($_POST['button'])){
	$fio = $_POST['fio'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordtwo = $_POST['passwordtwo'];

//Очистка от пробелов, удаление символов, удаление HTML и PHP тегов, преобразуем спецсимволы в HTML сущности
function clean($value = ''){
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
	
	return $value;
}

$_SESSION['fio'] = clean($fio);
$_SESSION['email'] = clean($email);
$_SESSION['password'] = clean($password);
$_SESSION['passwordtwo'] = clean($passwordtwo);
	//Проверяю есть ли значения в нутри переменных(заполнены ли инпуты)
if((strlen($_SESSION['fio'])<5) 		||
   (strlen($_SESSION['email'])<5) 		||	
   (strlen($_SESSION['password'])<5)	||	
   (strlen($_SESSION['passwordtwo'])<5) ||	
   ((strlen($_SESSION['password'])<5) !== (strlen($_SESSION['passwordtwo'])<5))
 )
{ 
	header('Location: ..//registr.php'); 
	exit;
}
else
{
	
	//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	

/*Создаю таблицу и поля
 * $result = pg_query($dbconn, "CREATE TABLE users(
												id serial,
												fio varchar,
												email varchar,
												password varchar,
												telefone varchar,
												city varchar,
												street varchar,
												hause varchar,
												apartment varchar,
												delivery varchar,
												comment text
											  );
");*/

	//Создание и выполнение запроса на запись данных в БД
$fio = $_SESSION['fio'] . ' ';
$email = $_SESSION['email'];
$password = $_SESSION['password'];	

	//Поиск записей в БД и сравнение их с введенными данными
$select = "SELECT email FROM users";
$result_select = pg_query($dbconn, $select) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result_select);

foreach($array_bd as $key => $value){
 	foreach($value as $k => $v){
		 if(trim($v) === trim($email)){
			//этот мэил занят
			$_SESSION['error'] = '<div><span style="color: red;">*</span>Указанный email занят!</div>';
			header('Location: ..//registr.php'); 
			exit;
		}
	}
}

// Если нужно пустить в адвинку нужно ноль поменять на 1

	//Запись в БД
$insert = "INSERT INTO dbelotserkovets_users(fio, email, password, role) VALUES ('$fio', '$email', '$password', 0)";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
header('Location: ..//login.php'); 

$view = "этот мэил свободен<br>";
		
	

	//Очистка результатов
pg_free_result($result_select);
pg_free_result($result_insert);

	//Закрытие соединения
pg_close($dbconn);

} 
 

}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php


?>
</body></html>
