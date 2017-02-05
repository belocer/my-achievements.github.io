<?php
require_once 'php/require.php';

//////////////////////////////////////ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////
//////////////////////////////////////ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////
//////////////////////////////////////ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////


if(isset($_POST['button_admin_change'])){
	$fio 		= $_POST['fio'];
	$email 		= $_POST['email'];
	$city 		= $_POST['city'];
	$telefone	= $_POST['telefone'];
	$street 	= $_POST['street'];
	$hause 		= $_POST['hause'];
	$apartment 	= $_POST['apartment'];
	
//Очистка от пробелов, удаление символов, удаление HTML и PHP тегов, преобразуем спецсимволы в HTML сущности
function clean($value = ''){
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
	
	return $value;
}

$fio 		= clean($fio);
$email 		= clean($email);
$city		= clean($city);
$telefone 	= clean($telefone);
$street 	= clean($street);
$hause 		= clean($hause);
$apartment 	= clean($apartment);
	
	//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	

if(isset($_SESSION['idman'])){$user_id = $_SESSION['idman'];}


	//Создание и выполнение запроса на запись данных в БД
$insert = "UPDATE dbelotserkovets_users SET fio = '$fio', email = '$email', telefone = '$telefone', city = '$city', street = '$street', hause = '$hause', apartment = '$apartment' WHERE id = '$user_id'";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	//Очистка результатов
pg_free_result($result_insert);

	//Закрытие соединения
pg_close($dbconn);	

}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>Мой профиль</title>
	<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<link rel="stylesheet" href="CSS/profileStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
</head>
<body>

<?php require_once 'php/header.php'?>
	
<!--*********************************************************-->

	<div class="topic">ЛИЧНЫЙ КАБИНЕТ</div>
	<div class="flex">
<section>
<form action="profile.php" method="POST">
	<div id="section">
		<h3>Мои данные</h3>
				<div id="leftPart">
					<span>Контактное лицо (ФИО)</span><br>
					<input type="text" name="fio" value="<?php if(isset($_POST['fio'])){ echo trim($_POST['fio']);}else if(isset($_SESSION['fio'])){ echo $_SESSION['fio'];} ?>"><br><br>
					<span>Контактный телефон:</span><br>
					<input type="text" name="telefone" value="<?php if(isset($_POST['telefone'])){ echo trim($_POST['telefone']);}else if(isset($_SESSION['telefone'])){ echo $_SESSION['telefone'];} ?>"><br><br>
					<span>E-mail:</span><br>
					<input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo trim($_POST['email']);}else if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>"><br><br>
				</div>
				<div id="middlePart">
					<span>Город:</span>
					<input type="text" name="city" value="<?php if(isset($_POST['city'])){ echo trim($_POST['city']);}else if(isset($_SESSION['city'])){ echo $_SESSION['city'];} ?>"><br><br>
					<span>Улица:</span>
					<input type="text" name="street" value="<?php if(isset($_POST['street'])){ echo trim($_POST['street']);}else if(isset($_SESSION['street'])){ echo $_SESSION['street'];} ?>"><br><br>
					<span>Дом:</span><br>
					<input  id="short" type="text" name="hause" value="<?php if(isset($_POST['hause'])){ echo trim($_POST['hause']);}else if(isset($_SESSION['hause'])){ echo $_SESSION['hause'];} ?>">
					<div id="lleft">
					<span>Квартира:</span><br>
					<input  id="short1" type="text" name="apartment" value="<?php if(isset($_POST['apartment'])){ echo trim($_POST['apartment']);}else if(isset($_SESSION['apartment'])){ echo $_SESSION['apartment'];} ?>"><br><br>
					</div>							
				</div>
				<div>Мой id: <span><?php if(isset($_SESSION['idman'])){echo $_SESSION['idman'];} ?></span></div>
				<div><button name="button_admin_change" type="submit">Изменить мои данные</button></div>
			</div>
		</form>	
</section>
</div>

	<!--*********************************TABLE**********************************-->
			<table>
				<tr id="headTable">
					<th colspan="3">ИСТОРИЯ ЗАКАЗОВ</th>
				</tr>
				<tbody>
				<tr>
					<td>
						<span class="numberBlue">№4831</span>
					</td>
					<td>48 597 руб.</td>
					<td>01.01.2015 в 16:12</td>
				</tr>
				<tr>
					<td>
						<span class="numberBlue">№4831</span>
					</td>
					<td>48 597 руб.</td>
					<td>01.01.2015 в 16:12</td>
				</tr>
				<tr>
					<td>
						<span class="numberBlue">№4831</span>
					</td>
					<td>48 597 руб.</td>
					<td>01.01.2015 в 16:12</td>
				</tr>
				</tbody>
			</table>
<?php require_once 'php/foot.php'?>
