<?php
require_once 'php/require.php';

/* echo "<pre>";
print_r($_SESSION);
echo "</pre>"; */
//////////////////////////////////////ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////

if(isset($_POST['button_admin_change'])){
	$fio 		= $_POST['fio'] . ' ';
	$email 		= $_POST['email'];
	$city 		= $_POST['city'];
	$telefone	= $_POST['telefone'];
	$street 	= $_POST['street'];
	$hause 		= $_POST['hause'];
	$apartment 	= $_POST['apartment'];
	$password 	= $_POST['password'];

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
$password 	= clean($password);

	// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

if(isset($_SESSION['idman'])){$user_id = $_SESSION['idman'];}

	// Если был изменен пароль то запрос такой
if($password != ''){

	// Создание и выполнение запроса на запись данных в БД
$insert = "UPDATE dbelotserkovets_users SET fio = '$fio', email = '$email', telefone = '$telefone', city = '$city', street = '$street', hause = '$hause', apartment = '$apartment', password= '$password' WHERE id = '$user_id'";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	// Очистка результатов
pg_free_result($result_insert);

	// Закрытие соединения
pg_close($dbconn);

	// Если не был изменен пароль
}else if($password == ''){
	// Создание и выполнение запроса на запись данных в БД
$insert = "UPDATE dbelotserkovets_users SET fio = '$fio', email = '$email', telefone = '$telefone', city = '$city', street = '$street', hause = '$hause', apartment = '$apartment' WHERE id = '$user_id'";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	// Очистка результатов
pg_free_result($result_insert);

	// Закрытие соединения
pg_close($dbconn);

	}
}

?>

<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta charset="UTF-8">
		<title>ЛИЧНЫЙ КАБИНЕТ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/accountStyle.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>
<body>
<?php
	require_once 'php/header.php';
	?>

	<!--*********************************Центральный блок*****************************************************-->
<section>
<div class="topic">ЛИЧНЫЙ КАБИНЕТ</div>
<div id="section">
<div id="blockFloatLeft">
		<form action="account.php" method="POST">
				<div class="leftBlock">
					<div>
					<h4>Ваши данные </h4><br>		<div>Мой id: <span><?php if(isset($_SESSION['idman'])){echo $_SESSION['idman'];} ?></span></div><br>
						<span>Контактное лицо (ФИО):</span><br>
						<input type="text" name="fio" value="<?php if(isset($_POST['fio'])){ echo trim($_POST['fio']);}else if(isset($_SESSION['fio'])){ echo $_SESSION['fio'];} ?>"><br><br>
						<span>Контактный телефон:</span><br>
						<input type="tel" name="telefone" value="<?php if(isset($_POST['telefone'])){ echo trim($_POST['telefone']);}else if(isset($_SESSION['telefone'])){ echo $_SESSION['telefone'];} ?>"><br><br>
						<span>E-mail адрес:</span><br>
						<input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo trim($_POST['email']);}else if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>"><br><br>

					<h4>Адрес доставки</h4><br><br>
						<span>Город:</span><br>
						<input type="text" name="city" value="<?php if(isset($_POST['city'])){ echo trim($_POST['city']);}else if(isset($_SESSION['city'])){ echo $_SESSION['city'];} ?>"><br><br>
						<span>Улица:</span><br>
						<input type="text" name="street" value="<?php if(isset($_POST['street'])){ echo trim($_POST['street']);}else if(isset($_SESSION['street'])){ echo $_SESSION['street'];} ?>"><br>

						<div id="short">
							<span>Дом:</span><br>
							<input style="font:16px 'Supermolot Light';color:black;" id="short" type="text" name="hause" value="<?php if(isset($_POST['hause'])){ echo trim($_POST['hause']);}else if(isset($_SESSION['hause'])){ echo $_SESSION['hause'];} ?>"><br>
						</div>

						<div id="short1" >
							<span>Квартира:</span><br>
							<input type="text" name="apartment" value="<?php if(isset($_POST['apartment'])){ echo trim($_POST['apartment']);}else if(isset($_SESSION['apartment'])){ echo $_SESSION['apartment'];} ?>"><br>
						</div><br><br>
						<script>
						function pass_Auth(){
								if(	document.getElementById('pass_1').value !== document.getElementById('pass_2').value	){
										document.getElementById('res').innerHTML = "<style> #save{ display: none; } </style><p style='color: red;'> Пароли не совпадают! </p>";
									}else{

										document.getElementById('res').innerHTML = "<p style='color: green;'> Пароли совпали! </p>";
									}
						}
						</script>
					<h4>Изменение пароля</h4><br><br>
						<span>Введите новый пароль:</span><span id="res"></span><br>
						<input type="password" id="pass_1" name="password"><br><br>
						<span>Повторите новый пароль:</span><br>
						<input type="password" id="pass_2" onKeyUp="pass_Auth();" name="password_2"><br><br>

						<div><button name="button_admin_change" id="save" type="submit">Сохранить</button></div>
					</div>
				</div>

				<div class="rightBlock">
					<h4>Ваши заказы</h4><br><br>
<?php
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$idman = $_SESSION['idman'];
$select= "SELECT * FROM dbelotserkovets_orders WHERE users_id = $idman";
$result = pg_query($dbconn, "$select") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result);
//echo "<pre>";
//var_dump($array_bd);
//echo "</pre>";
if($array_bd !== false){
	foreach( $array_bd as $key => $value){
		echo 		'<div class="orderInfo">
							<div class="orderNumber">№'.$value['order_id'].'</div>
							<div class="sum">('.$value['pin'].' руб.)</div>';
	$dates = substr($value['date_zakaz'], 0, 10);
	$times = substr($value['date_zakaz'], 11, 5);
		echo		'<div class="dateTime">'.$dates.' в '.$times.'</div>';
		echo		'<div class="orderStep">';
	if($value['status'] == 0){
		echo "Принят";
	} else if($value['status'] == 1){
		echo "Отгружен";
	} else if($value['status'] == 2){
		echo "У курьера";
	}else if($value['status'] == 3){
		echo "Доставлен";
	}else if($value['status'] == 4){
		echo "Отменен";
	}
		echo ' </div>
						</div>';
	}
}else{
	echo '<div class="orderNumber">Заказов не было</div>';
}
?>
				</div>
	</form>
</div>
</div>
</section>

<?php include 'php/foot.php'?>
