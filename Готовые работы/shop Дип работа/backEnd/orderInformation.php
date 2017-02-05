<?php
session_start();
/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	header('Location: ../index.php');
		exit;
} */
		// Показать все возможные ошибки
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);

	//echo "<pre>";
	//var_dump($_GET['id_orders']);
	//echo "</pre>";
if( isset($_GET['id_orders']) ){$_SESSION['id_ord'] = $_GET['id_orders'];}


if( isset($_POST['updateOrder']) ){		// Изменение Заказа

						// Метод доставки -- для изменения доставки создаю переменную $_SESSION['delivery_method']
if( isset($_POST['delivery1']) == 'on' ){$_SESSION['delivery_method']='Курьерская доставка';}
if(!isset($_POST['delivery1']) && !isset($_POST['delivery2']) && !isset($_POST['delivery3']) ){$_SESSION['delivery_method']='Курьерская доставка';}
if( isset($_POST['delivery2']) == 'on' ){$_SESSION['delivery_method']='Почта России';}
if( isset($_POST['delivery3']) == 'on' ){$_SESSION['delivery_method']='QIWI Post';}
unset($_POST['delivery1']);
unset($_POST['delivery2']);
unset($_POST['delivery3']);	

		// Соединение сервером БД, и выбор БД
$db=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//echo "<pre>сессия - ";
	//print_r($_SESSION);
	//echo "</pre>";
		///////// Данные по пользователю
	$user_id 	= $_SESSION['user_id'];
	$fio 			= $_POST['fio'];
	$email 		= $_POST['email'];
	$city 		= $_POST['city'];
	$telefone	= $_POST['pfone'];
	$street 	= $_POST['street'];
	$hause 		= $_POST['hause'];
	$apartment 	= $_POST['apartment'];
	
// Создание и выполнение запроса на запись данных в БД по пользователю
$upd = "UPDATE dbelotserkovets_users SET fio = '$fio', email = '$email', telefone = '$telefone', city = '$city', street = '$street', hause = '$hause', apartment = '$apartment' WHERE id = '$user_id'"; 
$result_upd = pg_query($db, $upd) or die('Ошибка запроса записи: ' . pg_last_error());

		///////// Данные по заказу
$delivery_method =	$_SESSION['delivery_method']; //  метод доставки
$or_id = $_SESSION['or_id']; // id заказа
$prim = $_POST['prim']; // коммент к заказу
$email = $_POST['email']; // mail
$pin = $_SESSION['pin']; // Итоговая сумма

	//Создание и выполнение запроса на запись данных в БД по заказу
$up= "UPDATE dbelotserkovets_orders SET dostavka = '$delivery_method', prim='$prim', mail_us = '$email', pin= $pin WHERE order_id = $or_id ";
$result_up= pg_query($db, $up) or die('Ошибка запроса записи: ' . pg_last_error());

$_GET['id_orders'] = $_SESSION['or_id'] ; // Что бы после обновления страницы заказ и заказчик снова подгрузились

			// Очистка результатов
	pg_free_result($result_upd);
	pg_free_result($result_up);

		// Закрытие соединения
	pg_close($db);
}

if( isset($_POST['del_tovar']) ){		// Удаление товара из Заказа

		// Соединение сервером БД, и выбор БД
	$db=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

		// Создание и выполнение запроса на удаление из таблицы zakaz_tovar
	$res_ex = explode("|", $_POST["del_tovar"]);
	$id_article = $res_ex[0]; // Арикул товара
	
	$id_orders = $_SESSION['id_ord'] ;
	
	$tovar_delete = "DELETE FROM dbelotserkovets_zakaz_tovar WHERE article_id = $id_article  AND orders_id = $id_orders";
	$tov_del= pg_query($db, $tovar_delete) or die('Ошибка запроса записи: ' . pg_last_error());

		// Ищу pin в таблице заказов
	$w = trim($_SESSION['or_id']);
	$pin_minus = "SELECT pin FROM dbelotserkovets_orders WHERE order_id 	= $w ";
	$pin= pg_query($db, $pin_minus) or die('Ошибка запроса записи: ' . pg_last_error());
	$pin_sum = pg_fetch_array($pin);

	$res_exp = explode("|", $_POST["del_tovar"]); //  Беру из $_POST["del_tovar"]
	$pin_res = ( $pin_sum['pin'] - ( $res_exp[1] * $res_ex[2] ) );

		// Обновляю данные pin в таблице заказы
	$upd = "UPDATE dbelotserkovets_orders SET pin = $pin_res WHERE order_id = $w";
	$result_insert = pg_query($db, $upd) or die('Ошибка запроса записи: ' . pg_last_error());

			// Очистка результатов
	pg_free_result($pin);
	//pg_free_result($tov_del);

		// Закрытие соединения
	pg_close($db);
	$_GET['id_orders'] = $_SESSION['or_id'] ; // Что бы после обновления страницы заказ и заказчик снова подгрузились
}

if(isset($_POST['cancelOrder'])){  // Удаляю заказ

		// Соединение сервером БД, и выбор БД
	$db=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
		// Создание и выполнение запроса на удаление из таблицы orders и zakaz_tovar
	$q = trim($_SESSION['or_id']);
	$order_delete = "DELETE FROM dbelotserkovets_orders WHERE order_id = $q ";
	$result_delete= pg_query($db, $order_delete) or die('Ошибка запроса записи: ' . pg_last_error());
	$zakaz_delete = "DELETE FROM dbelotserkovets_zakaz_tovar WHERE orders_id = $q ";
	$delete= pg_query($db, $zakaz_delete) or die('Ошибка запроса записи: ' . pg_last_error());

		// Очистка результатов
	pg_free_result($result_delete);
	pg_free_result($delete);

		// Закрытие соединения
	pg_close($db);
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/orderInformationStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
		<!--[if lt IE9] <script src="//html5shivgooglecode.com/svn/trunk/html5.js"></script>
<[!endif]-->
</head>
<body>
<section>
<!--************************NAV MENU****************************-->
	<nav>
		<ul>
			<li><a id="label" href="index.php"><img src="image/label.jpg" alt="label"></a></li>
			<li><a href="index.php"><img src="image/cartAGreen.png" alt="cartA"><span>ЗАКАЗЫ</span></a></li>
			<li><a href="users.php"><img src="image/avaUsers.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a></li>
			<li><a href="items.php"><img src="image/truck.png" alt="truck"><span>ТОВАРЫ</span></a></li>
			<li><a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a></li>
		</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
	</nav>
<form action="orderInformation.php" method="POST">
	<div>
	<!--*********************************TABLE**********************************-->
	<div id="aboveTheTable">
		<h1>ЗАКАЗ</h1>
		<h1>№<?php if(isset($_GET)){echo  $_GET["id_orders"];}?></h1>
		<h1><a>(у курьера)</a></h1>
	</div>
		<div id="topPart">
			<table>
				<tr id="headTable">
					<th class="headTable" id="headTable" colspan="5">СОДЕРЖИМОЕ ЗАКАЗА</th>
				</tr>
				<tbody>
				<tr>
<?php
if(isset($_GET['id_orders'])){
	// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	// Выборка из таблицы заказов
$id = trim($_GET['id_orders']);
$select = "SELECT * FROM dbelotserkovets_orders WHERE order_id = $id;";
$result = pg_query($dbconn, "$select") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result);

$_SESSION['or_id'] = $array_bd[0]['order_id']; // Ложу в сессионную переменную что бы не потерялась id заказа :)

	// Выборка из таблицы zakaz_tovar что бы узнать id товаров и их количество
$select_order = "SELECT article_id, quantity FROM dbelotserkovets_zakaz_tovar WHERE orders_id = $id;";
$result_zakaz = pg_query($dbconn, "$select_order") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_order = pg_fetch_all($result_zakaz);

$del_tovar = 1;

$sd = array();
$a = count($array_order);

if( $a > 1 ){
	$_SESSION['qty_product'] = array();
	for( $i = 0; $a>0; $i++ ){

		$a--;

				// Выборка из таблицы product что бы взять заказанные товары
		$articul = $array_order[$i]['article_id'];

		$select_art = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$articul'";
		$result_art= @pg_query($dbconn, "$select_art") or die('Ошибка запроса поиска записи: ' . pg_last_error());
		if( $result_art == false ){ header("Location: index.php"); }
		$ro_w = pg_fetch_array($result_art);
		$sd[$i] = $ro_w;

		echo		'<td>
							<span class="numberBlue">'. $sd[$i]['product_name'] .'</span>
						</td>
						<td><a href="#"><span>'.$sd[$i]['price'].' руб.</span></a></td>
						<td><input type="text" name="qty|'.$array_order[$i]['article_id'].'" value="'.$array_order[$i]['quantity'].'"></td>';
		$sd[$i]['price'] = str_replace(' ', '', $sd[$i]['price']); // Удаляю пробел

		echo	'<td>'.$sd[$i]['price']*$array_order[$i]['quantity'].' руб.</td>
						<td><input class="hide_inp" type="submit" name="del_tovar" value="'.$array_order[$i]['article_id'].'|'.$sd[$i]['price'].'|'.$array_order[$i]['quantity'].'"><span class="view_span">убрать из заказа</span></td>
					</tr>';

		$_SESSION['qty_product'][] .= $array_order[$i]['article_id'].'|'.$array_order[$i]['quantity'];  // Массив для изменения данныз в заказе
	}
	$id_user = $array_bd[0]['users_id'];
$select_us = "SELECT * FROM dbelotserkovets_users WHERE id = $id_user";
$result_us = pg_query($dbconn, "$select_us") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_us = pg_fetch_all($result_us);
} else if( $a < 2 ){
	////////////////////////////////////////////////////////////////
	// Если один товар в корзине
	////////////////////////////////////////////////////////////////
	$_SESSION['qty_product'] = array();
for( $i = 0; $a>0; $i++ ){

	$a--;

			// Выборка из таблицы product что бы взять заказанные товары
	$articul = $array_order[$i]['article_id'];

	$select_art = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$articul'";
	$result_art= pg_query($dbconn, "$select_art") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	if( $result_art == false ){ header("Location: index.php"); }
	$ro_w = pg_fetch_array($result_art);
	$sd[$i] = $ro_w;

echo			'<td>
						<span class="numberBlue">'. $sd[$i]['product_name'] .'</span>
					</td>
					<td><a href="#"><span>'.$sd[$i]['price'].' руб.</span></a></td>
					<td><input type="text" name="qty|'.$array_order[$i]['article_id'].'" value="'.$array_order[$i]['quantity'].'"></td>';
$sd[$i]['price'] = str_replace(' ', '', $sd[$i]['price']); // Удаляю пробел

echo			'<td>'.$sd[$i]['price']*$array_order[$i]['quantity'].' руб.</td>
				</tr>';

	$_SESSION['qty_product'][] .= $array_order[$i]['article_id'].'|'.$array_order[$i]['quantity'];  // Массив для изменения данных в заказе
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////	
	unset($result_art);
}
$id_user = $array_bd[0]['users_id'];
$select_us = "SELECT * FROM dbelotserkovets_users WHERE id = $id_user";
$result_us = pg_query($dbconn, "$select_us") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_us = pg_fetch_all($result_us);
}
}
$_SESSION['user_id'] = $array_bd[0]['users_id']; // Перекидываю переменную в Сессионную что бы не потерять (id пользователя)

?>
				<tr id="notHighlight">
					<td id="bottomTable" colspan="5">
						<div>
							<div id="sum">ИТОГОВАЯ<br>СУММА</div>
							<div><?php if(isset($array_bd[0]['pin'])){echo $array_bd[0]['pin'];}  
							// Перекидываю итоговую сумму в session
							$_SESSION['pin'] = $array_bd[0]['pin'];
							?></div>
							<div>руб.</div>
						</div>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<!--*******************НИЖНЯЯ ЧАСТЬ---ИНФОРМАЦИЯ О ЗАКАЗЧИКЕ---***************************************-->
		<div id="bottomPart">
			<div class="headTable" id="headBottomPart">ИНФОРМАЦИЯ О ЗАКАЗЕ</div>
				<div id="leftPart">
					<span>Контактное лицо (ФИО)</span><br>
					<input type="text" name="fio" value="<?php if(isset($array_us)){echo $array_us[0]['fio'];} ?>"><br><br>
					<span>Контактный телефон:</span><br>
					<input type="text" name ="pfone" value="<?php if(isset($array_us)){echo $array_us[0]['telefone'];} ?>"><br><br>
					<span>E-mail:</span><br>
					<input type="email" name="email" value="<?php if(isset($array_us)){echo $array_us[0]['email'];} ?>"><br><br>
				</div>
				<div id="middlePart">
					<span>Город:</span>
					<input type="text" name="city" value="<?php if(isset($array_us)){echo $array_us[0]['city'];} ?>"><br><br>
					<span>Улица:</span>
					<input type="text" name="street" value="<?php if(isset($array_us)){echo $array_us[0]['street'];} ?>"><br><br>
					<span>Дом:</span><br>
					<input  id="short" name="hause" type="text" value="<?php if(isset($array_us)){echo $array_us[0]['hause'];} ?>">
					<div id="lleft">
						<span>Квартира:</span><br>
						<input  id="short1" name="apartment" type="text" value="<?php if(isset($array_us)){echo $array_us[0]['apartment'];} ?>"><br><br>
					</div>
				</div>
<div id="rightPart">
	<span>Способ доставки:</span> <!--Чекбоксы способ доставки-->
		<p>
			<label>
				<span class="<?php 
if( isset( $array_bd) && ($array_bd[0]['dostavka'] == 'Курьерская доставка') ){echo  'active_check';}else{ echo 'passive_check';} // Способ доставки
?>"	id="check_1" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery1"><span class="middleBlock">Курьерская доставка<br>с оплатой при получении</span><br><br>
			</label>

			<label>
				<span class="<?php 
if(isset( $array_bd) && ($array_bd[0]['dostavka'] == 'Почта России')){echo  'active_check';}else{ echo 'passive_check';} // Способ доставки
?>"  id="check_2" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery2"><span class="middleBlock">Почта России<br>с наложенным платежом</span><br><br>
			</label>

			<label>
				<span class="<?php 
if(isset( $array_bd) && ($array_bd[0]['dostavka'] == 'QIWI Post')){echo  'active_check';}else{ echo 'passive_check';} // Способ доставки
?>"  id="check_3" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery3"><span class="middleBlock">Доставка через терминалы<br>QIWI Post</span>
			</label>
		</p> <!--Чекбоксы способ доставки конец-->
	</div>
				<div id="commentBottom">
					<span>Комментарий к заказу:</span><br>
					<textarea cols="30" name="prim" rows="3"><?php if(isset( $array_bd)){echo  $array_bd[0]['prim'];} ?></textarea>
				</div>
				<div id="remove">
					<input type="submit" name="cancelOrder" value="Отменить заказ">
				</div>
				<div id="update">
					<input type="submit" name="updateOrder" value="Внести изменения">
				</div>
		</div>
	</div>
	</form>
</section>
		<script src="js/script.js"></script>
<body>
</html>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<style>
	.qwe{
		display: none;
	}

	.active_check{
		background-image: url(image/active.png);
		width: 15px;
		height: 15px;
		display: inline-block;
	}
	.passive_check{
		background-image: url(image/passive.png);
		width: 15px;
		height: 15px;
		display: inline-block;
	}
</style>
<script>
	function rev_elem(event){
		event = event || window.event; //объект события во всех браузерах
		var x = event.currentTarget.getAttribute('class');
				if(x == 'passive_check'){
					document.getElementById('check_1').setAttribute('class', 'passive_check');
					document.getElementById('check_2').setAttribute('class', 'passive_check');
					document.getElementById('check_3').setAttribute('class', 'passive_check');
				event.currentTarget.setAttribute('class', 'active_check');
					}else{
				event.currentTarget.setAttribute('class', 'passive_check');
				}
	}
</script>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
