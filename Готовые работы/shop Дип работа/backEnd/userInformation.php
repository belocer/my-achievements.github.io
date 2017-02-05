<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);
	
/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	header('Location: ../index.php');
		exit;
} */
 if(isset($_GET['id'])){
$_SESSION['us_id'] = $_GET['id'];

//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

$id_redirect = $_GET['id'];

$select_id_redirect = "SELECT * FROM dbelotserkovets_users WHERE id = $id_redirect";
$result_select_id = pg_query($dbconn, $select_id_redirect) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_id = pg_fetch_array($result_select_id);

}

	//ПОИСК ПО ID
if(isset($_POST['id_search'])){
	$user_id = trim($_POST['id_search']);
	$_SESSION['us_id'] = trim($_POST['id_search']);
}

	//Проверяю нажата ли кнопка поиска
if( isset($_POST['button_id']) ){
		//Проверяю введено ли число
	if(is_numeric($user_id)){

	//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

$select_id = "SELECT * FROM dbelotserkovets_users WHERE id = $user_id";
$result_select_id = pg_query($dbconn, $select_id) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_id = pg_fetch_array($result_select_id);


}else{$_SESSION['error'] = " это НЕ число!";}

//Очистка результатов
pg_free_result($result_select_id);

	} else if (isset($_POST['button_admin'])){

	//////////////////////////////////////Добавление ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////

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


	//Создание и выполнение запроса на запись данных в БД

$insert = "INSERT INTO dbelotserkovets_users (fio, email, telefone, city, street, hause, apartment) VALUES ('$fio', '$email', '$telefone', '$city', '$street', '$hause', '$apartment')";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());


//////////////////////////////////////ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ////////////////////////////////////////

}else if (isset($_POST['button_admin_change'])){
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

	//Создание и выполнение запроса на запись данных в БД
$insert = "UPDATE dbelotserkovets_users SET fio = '$fio', email = '$email', telefone = '$telefone', city = '$city', street = '$street', hause = '$hause', apartment = '$apartment' WHERE id = '$user_id'";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	//Очистка результатов
pg_free_result($result_insert);

	//Закрытие соединения
pg_close($dbconn);


	////////////////////////////////////УДАЛЕНИЕ ПОЛЬЗОВАТЕЛЯ/////////////////////////////////////

}else if (isset($_POST['button_delete'])){

	//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$user_id = trim($_POST['id_search']);
	//Создание и выполнение запроса на запись данных в БД
$user_delete = "DELETE FROM dbelotserkovets_users WHERE id = '$user_id'";
$result_delete= pg_query($dbconn, $user_delete) or die('Ошибка запроса записи: ' . pg_last_error());

	//Очистка результатов
pg_free_result($result_delete);

	//Закрытие соединения
pg_close($dbconn);

}else{
		session_destroy();
	}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/userInformationStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
		<!--[if lt IE9] <script src="//html5shivgooglecode.com/svn/trunk/html5.js"></script>
<[!endif]-->
</head>
<body>
<section>
<!--*******************************NAV MENU***********************************-->
	<nav>
		<ul>
			<li><a id="label" href="index.php"><img src="image/label.jpg" alt="label"></a></li>
			<li><a href="index.php"><img src="image/cartA.png" alt="cartA"><span>ЗАКАЗЫ</span></a></li>
			<li><a href="users.php"><img src="image/avaUsersGreen.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a></li>
			<li><a href="items.php"><img src="image/truck.png" alt="truck"><span>ТОВАРЫ</span></a></li>
			<li><a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a></li>
		</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
	</nav>
<h1>ПРОСМОТР ПОЛЬЗОВАТЕЛЯ</h1>
<!--*******************-ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ-**********************-->
	<form action="userInformation.php" method="POST">
		<div id="bottomPart">
			<div id="top_part">
					<h4>Поиск пользователя по ID</h4><br>
					<span>Введите id:</span><span><?php
					if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
						}

					 ?></span><br>
					<input type="text" name="id_search" value="<?php if(isset($array_bd_id['id'])){ echo trim($array_bd_id['id']);} ?>" autofocus><br><br>
					<button name="button_id" type="submit">Искать</button>
			</div>
			<div class="headTable">ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ</div>
				<div id="leftPart">
					<span>Контактное лицо (ФИО)</span><br>
					<input type="text" name="fio" value="<?php if(isset($array_bd_id['fio'])){ echo trim($array_bd_id['fio']);} ?>" autocapitalize="words" ><br><br>
					<span>Контактный телефон:</span><br>
					<input type="text" name="telefone" value="<?php if(isset($array_bd_id['telefone'])){ echo trim($array_bd_id['telefone']);} ?>" ><br><br>
					<span>E-mail:</span><br>
					<input type="email" name="email" value="<?php if(isset($array_bd_id['email'])){ echo trim($array_bd_id['email']);} ?>"><br><br>
				</div>
				<div id="middlePart">
					<span>Город:</span>
					<input type="text" name="city" value="<?php if(isset($array_bd_id['city'])){ echo trim($array_bd_id['city']);} ?>"><br><br>
					<span>Улица:</span>
					<input type="text" name="street" value="<?php if(isset($array_bd_id['street'])){ echo trim($array_bd_id['street']);} ?>"><br><br>
					<span>Дом:</span><br>
					<input  id="short" type="text" name="hause" value="<?php if(isset($array_bd_id['hause'])){ echo trim($array_bd_id['hause']);} ?>">
					<div id="lleft">
					<span>Квартира:</span><br>
					<input  id="short1" type="text" name="apartment" value="<?php if(isset($array_bd_id['apartment'])){ echo trim($array_bd_id['apartment']);} ?>"><br><br>
					</div>
				</div>
			</div>
		</div>
	<!--*********************************TABLE**********************************-->
<?php
 if( isset($_SESSION['us_id']) ){
// Соединение сервером БД, и выбор БД
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$user_id_or = $_SESSION['us_id'] ;
$user_id_or = trim($user_id_or);
$select_i= "SELECT * FROM dbelotserkovets_orders WHERE users_id = $user_id_or";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);

if( $array_bd_i != false ){
	echo '<table>
					<tr id="headTable">
						<th colspan="3">ИСТОРИЯ ЗАКАЗОВ</th>
					</tr>
					<tbody>';
	$sum = 0;
	foreach($array_bd_i as $key => $value){
		echo '	<tr>
						<td>
							<span class="numberBlue">№'. $value['order_id'] .'</span>
						</td>
						<td>'. $value['pin'] .' руб.</td>';
						
	$sum += $value['pin'];

	$dates = substr($value['date_zakaz'], 0, 10);
	$times = substr($value['date_zakaz'], 11, 5);
	
		echo    '<td>'. $dates  .' в '. $times  .'</td>
					</tr>';
	}
	echo 				'<tr id="notHighlight">
						<td id="bottomTable" colspan="5">
							<div>
								<div>ИТОГОВАЯ<br>СУММА ЗАКАЗОВ</div>
								<div>'. $sum .'</div>
								<div>руб.</div>
							</div>
						</td>
					</tr>
					</tbody>
				</table>';
} else if ($array_bd_i == false){
	echo "<h1 style='color: #747AAF; text-align: center; font-size: 24px;'>Заказов не было! </h1>";
}
unset($_SESSION['us_id']);
}
?>

		<button name="button_delete" type="submit" id="cancelUser">Удалить пользователя</button>
	<div>
		<button name="button_admin" type="submit" id="add_User">Добавить пользователя</button>
	</div>
	<div>
		<button name="button_admin_change" type="submit" id="change_User">Изменить данные</button>
	</div>
		</form>
</section>
<?php

/*Создаю таблицу Транзакций и поля*/
  /*$result = pg_query($dbconn, "CREATE TABLE transaction(
												id_transaction serial,
												user_id integer,
												login timestamp without time zone,
												logout timestamp without time zone,
												items_cart timestamp without time zone,
												purchased_goods timestamp without time zone
												 );
");*/

?>
</body>
</html>
