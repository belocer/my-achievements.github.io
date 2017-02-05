<?php
session_start();
/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	unset($_SESSION);
	unset($_POST);
	unset($_GET);
	session_destroy();
	header('Location: ../index.php');
		exit;
} */ 
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/itemsStyle.css">
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
			<li><a href="items.php"><img src="image/truckGreen.png" alt="truck"><span>ТОВАРЫ</span></a></li>
			<li><a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a></li>
		</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
	</nav>
	<div>
		<h1>ТОВАРЫ</h1>
		
		<!--*********************************TABLE**********************************-->
			<table>
				<tr id="headTable">
					<th>НАЗВАНИЕ КАТЕГОРИИ</th>
					<th colspan="3">КОЛИЧЕСТВО ТОВАРОВ</th>
				</tr>
				<tbody>
				<tr>
					<td class="m_left">
						<img src="image/folder.png">
						<span class="OT">Сноуборды</span>
					</td>
					<td>
<?php
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_i= "SELECT COUNT(*) FROM dbelotserkovets_product WHERE category_name = 'snoubord';";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);

foreach($array_bd_i as $k => $v){
	foreach($v as $key => $val){
	echo $val;
}
}
?>					
					
					</td>
					<td></td>
					<td><a href="items_cat.php?cat=snoubord">просмотр</a></td>
				</tr>
				<tr>
					<td class="m_left">
						<img src="image/folder.png">
						<span class="OT">Самокаты</span>
					</td>
					<td>
<?php
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_i= "SELECT COUNT(*) FROM dbelotserkovets_product WHERE category_name = 'scooter';";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);
	foreach($array_bd_i as $k => $v){
		foreach($v as $key => $val){
		echo $val;
	}
}
?>
					</td>
					<td></td>
					<td><a href="items_cat.php?cat=scooter">просмотр</a></td>
				</tr>
				<tr>
					<td class="m_left">
						<img src="image/folder.png">
						<span class="OT">Роликовые коньки</span>
					</td>
					<td>
<?php
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_i= "SELECT COUNT(*) FROM dbelotserkovets_product WHERE category_name = 'roller';";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);
	foreach($array_bd_i as $k => $v){
		foreach($v as $key => $val){
		echo $val;
	}
}
?>
					</td>
					<td></td>
					<td><a href="items_cat.php?cat=roller">просмотр</a></td>
				</tr>
				<tr>
					<td class="m_left">
						<img src="image/folder.png">
						<span class="OT">Теннисные ракетки</span>
					</td>
					<td>
<?php
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_i= "SELECT COUNT(*) FROM dbelotserkovets_product WHERE category_name = 'tennis';";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);
	foreach($array_bd_i as $k => $v){
		foreach($v as $key => $val){
		echo $val;
	}
}
?>
					</td>
					<td></td>
					<td><a href="items_cat.php?cat=tennis">просмотр</a></td>
				</tr>
				<tr>
					<td class="m_left">
						<img src="image/folder.png">
						<span class="OT">Вейкборды</span>
					</td>
					<td>
<?php
$dconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_i= "SELECT COUNT(*) FROM dbelotserkovets_product WHERE category_name = 'wakeboard';";
$result_i = pg_query($dconn, $select_i) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_i = pg_fetch_all($result_i);
	foreach($array_bd_i as $k => $v){
		foreach($v as $key => $val){
		echo $val;
	}
}
?>
					</td>
					<td></td>
					<td><a href="items_cat.php?cat=wakeboard">просмотр</a></td>
				</tr>
				</tbody>
			</table>
		<div id="addCategory">
			<span>Добавить категорию:</span>
			<input type="text" value="название категории"><br>
			<a href="#">добавить категорию</a>
		</div>
		
	</div>
