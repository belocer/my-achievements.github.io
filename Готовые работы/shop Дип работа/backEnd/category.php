<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);
	// Cегодняшняя дата
$date_time = date('Y-m-d H:i:s', time()-(24*60*60));

	// Соединение с сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

////////////////////////////////////////////////////////////// Верхний блок
	// Выборка из таблицы транзакций
$select = "SELECT * FROM dbelotserkovets_transaction WHERE date_time > '$date_time' AND article_id > 0 LIMIT 20;";
$result = pg_query($dbconn, "$select") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_product = pg_fetch_all($result);


////////////////////////////////////////////////////////////// Нижний блок
	// Выборка из таблицы транзакций
$select_us = "SELECT * FROM dbelotserkovets_transaction WHERE date_time > '$date_time' AND users_id > 0 AND log_in>0 OR log_out>0 LIMIT 20;";
$res = pg_query($dbconn, "$select_us") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$us = pg_fetch_all($res);
?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/categoryStyle.css">
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
					<li><a href="users.php"><img src="image/avaUsers.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a></li>
					<li><a href="items.php"><img src="image/truck.png" alt="truck"><span>ТОВАРЫ</span></a></li>
					<li><a href="category.php"><img src="image/circlesGreen.png" alt="circles"><span>СТАТИСТИКА</span></a></li>
				</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
			</nav>

			<div>
				<h1>СТАТИСТИКА ПО САЙТУ</h1>
		<!---------------------------------------- Верхний блок ------------------------------------------->
				<div id="topPart">
					<table>
						<tr id="headTable"><th class="head_zag" colspan="4">Товары положенные в корзину за сутки</th></tr>
						<tr id="headTable">
							<th class="headTable" id="headTable">Товары</th>
							<th class="headTable">id Товара</th>
							<th class="headTable">Время</th>
							<th class="headTable">id Пользователя</th>
						</tr>
						<tbody>
<?php
if($array_bd_product !== false){
	foreach($array_bd_product as $k => $v) {
		$item = $v['article_id'];

		// Выборка из таблицы транзакций
	$select = "SELECT * FROM dbelotserkovets_product WHERE id_article = $item";
	$result = pg_query($dbconn, "$select") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$product = pg_fetch_all($result);

	foreach($product as $key => $value){
					echo		'<tr><td class="name_font">'.$value['product_name'].'</td>';
					echo		'<td class="name_font">'.$value['id_article'].'</td>';

					$dates = substr($v['date_time'], 0, 10);
					$times = substr($v['date_time'], 11, 5);
					echo		'<td>'.$dates.' в '.$times.'</td>';
	}
					echo		'<td>'.$v['users_id'].'</td>';
					echo '</tr>';
	}
}
?>
						</tbody>
					</table>
		<!------------------------------------------------- Нижний блок -------------------------------------------------------->
				<div id="topPart">
					<table>
						<tr id="headTable"><th class="head_zag" colspan="4">Активность пользователей</th></tr>
						<tr id="headTable">
							<th class="headTable" id="headTable"  width="30px">id Пользователя</th>
							<th class="headTable">E-mail</th>
							<th class="headTable">Вошел</th>
							<th class="headTable">Вышел</th>
						</tr>
						<tbody>
<?php
if($us !== false){
	foreach($us as $k => $v) {
		$id = $v['users_id'];

			// Выборка из таблицы транзакций
		$sel = "SELECT email FROM dbelotserkovets_users WHERE id = $id";
		$res = pg_query($dbconn, "$sel") or die('Ошибка запроса поиска записи: ' . pg_last_error());
		$id_man = pg_fetch_array($res);

		echo		'<tr><td class="name_font">'.$v['users_id'].'</td>';
		echo 		'<td>';
		echo 		$id_man['email'];
		echo 		'</td>';
		echo		'<td>';
		
		if($v['log_in'] > 0){
			$dates = substr($v['date_time'], 0, 10);
			$times = substr($v['date_time'], 11, 5);
			echo		$dates.' в '.$times;
		}
				echo		'</td>';
				echo		'<td>';
		if($v['log_out'] > 0){
			$date = substr($v['date_time'], 0, 10);
			$time = substr($v['date_time'], 11, 5);
			echo		$date.' в '.$time;
		}
				echo		'</td>';
				echo		'</tr>';
	}
}
?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</body>
</html>
