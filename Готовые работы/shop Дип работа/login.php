<?php
require_once 'php/require.php';

if( isset ( $_POST['logout'] ) ){
	echo $_POST['logout'];
	}

	// Если нажата кнопка ВОЙТИ
if(isset($_POST['comeIn'])){

		$email = $_POST['email'];
		$password = $_POST['password'];

		// Очистка от пробелов, удаление символов, удаление HTML и PHP тегов, преобразуем спецсимволы в HTML сущности
	function clean($value = ''){
		$value = trim($value);
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);

		return $value;
	}

	$_SESSION['email'] = clean($email);
	$_SESSION['password'] = clean($password);

		// Проверяю есть ли значения в нутри переменных(заполнены ли инпуты)
	if(	(strlen($_SESSION['email'])<3) || (strlen($_SESSION['password'])<3)	)
	{
		$_POST['error'] = 'Заполните поля email адресс и пароль';
		header('Location: ..//login.php');
		exit;
	}
	else
	{

		// Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());


		// Создание и выполнение запроса на запись данных в БД
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];

		// Поиск записей в БД и сравнение их с введенными данными

	$select = "SELECT * FROM dbelotserkovets_users WHERE email = '$email'"; // Беру всё из таблицы users где email = введенному email
	$result_select = pg_query($dbconn, $select) or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select); // Массив с нужной строкой из БД

					if(!empty($array_bd)){
						$_POST['resemail'] = "Логин верно";

								// Поиск записей в БД и сравнение их с введенными данными
							if($array_bd['password'] == $password){
								
/////////////////////////////////// Если входит Админ его отправляю в админ панель
if( $array_bd['role'] == 1 ) {
	$_SESSION['admin'] = $array_bd['role'];
	$_SESSION['online']	= 2;
	header('Location: backEnd/index.php');
	exit;
}
								
								$_POST['respas'] = "Пароль верно";
								$_SESSION['online']		= 1;
								$_SESSION['idman'] 		= $array_bd['id'];
								$_SESSION['fio'] 		= $array_bd['fio'];
								$_SESSION['email'] 		= $array_bd['email'];
								$_SESSION['telefone']	= $array_bd['telefone'];
								$_SESSION['city'] 		= $array_bd['city'];
								$_SESSION['street'] 	= $array_bd['street'];
								$_SESSION['hause'] 		= $array_bd['hause'];
								$_SESSION['apartment'] 	= $array_bd['apartment'];					

// Запись в БД таблица transaction
$users_id = $array_bd['id'];
$_SESSION['users_id'] = $array_bd['id']; // сохраняю id для выхода
$log_in = 1;
$insert = "INSERT INTO dbelotserkovets_transaction(users_id, log_in, date_time) VALUES ('$users_id', '$log_in', NOW());";
pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());



								header('Location: index.php');
								exit;
							}else{
								$_POST['respas'] = "Пароль НЕ верно";
							}
					}else{
						$_POST['resemail'] = "email НЕ верно";
					}
			}
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta charset="UTF-8">
		<title>ВХОД</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/loginStyle.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>
<body>
<?php require_once 'php/header.php'; ?>
	<!--*********************************Центральный блок*****************************************************-->
<section>
<div class="topic">ВХОД</div>
	<div id="section">
		<div id="blockFloatLeft">
			<form action="#" method="POST">
					<div id="leftBlock">
						<div>
							<h4>Зарегистрированный пользователь</h4><br><br>
							<span>E-mail адрес:</span><br><br>
							<input type="email" name="email" required autofocus><br><br>
							<span>Пароль:</span><br><br>
							<input type="password" name="password" required><br>
							<div><button name="comeIn" id="comeIn" href="#" type="submit">Войти</button></div>
							<button name="forgotYourPassword" href="#" id="forgotYourPassword">Забыли пароль?</button>
						</div>
					</div>
				<div id="rightBlock">
					<h4>Новый пользователь</h4><br><br>
					<a id="registr" href="registr.php">Зарегистрироваться</a>
				</div>
			</form>
	</div>
</div>
<?php if(isset($_POST['resemail'])){ echo $_POST['resemail']; }?>
<?php if(isset($_POST['respas'])){ echo $_POST['respas']; }?>
</section>
<?php include 'php/foot.php'?>
