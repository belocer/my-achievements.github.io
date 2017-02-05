<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);
/* 
if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	header('Location: ../index.php');
		exit;
} */
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/itemsInCategoryStyle.css">
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
	<div>
		<h1>ТОВАРЫ</h1>
		
		<div id="currentCategory">
			<span>Текущая категория:</span>
			<input type="text" value="Название категории 1">
			<a href="#">переименовать</a>
		</div>
		
		<!--*********************************TABLE**********************************-->
			<table>
				<tr id="headTable">
					<th>НАЗВАНИЕ ТОВАРА</th>
					<th colspan="3">СТОИМОСТЬ</th>
				</tr>
				<tbody>
				<tr>
					<td>
						<span class="OT">Название товара 1</span>
					</td>
					<td>4 953руб.</td>
					<td><a href="orderInformation.html">просмотр</a></td>
				</tr>
				<tr>
					<td>
						<span class="OT">Название товара 2</span>
					</td>
					<td>55 000руб.</td>
					<td><a href="orderInformation.html">просмотр</a></td>
				</tr>
				<tr>
					<td>
						<span class="OT">Название товара 3</span>
					</td>
					<td>6 400руб.</td>
					<td><a href="orderInformation.html">просмотр</a></td>
				</tr>
				</tbody>
			</table>
		
		
	</div>
