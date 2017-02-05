<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);

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
//if(isset($_GET)){
	//echo "<pre>";
	//print_r($_GET);
	//echo "</pre>";
//}
	//Выборка БД
//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product LIMIT 30";
if($_GET['cat'] == 'snoubord'){
	$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product WHERE category_name = 'snoubord' LIMIT 30";
} else if($_GET['cat'] == 'scooter'){
	$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product WHERE category_name = 'scooter' LIMIT 30";
} else if($_GET['cat'] == 'roller'){
	$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product WHERE category_name = 'roller' LIMIT 30";
} else if($_GET['cat'] == 'tennis'){
	$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product WHERE category_name = 'tennis' LIMIT 30";
} else if($_GET['cat'] == 'wakeboard'){
	$select_id = "SELECT id_article, product_name, badge, price FROM dbelotserkovets_product WHERE category_name = 'wakeboard' LIMIT 30";
}

$result_select_id = pg_query($dbconn, $select_id) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result_select_id);

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/items_cat.css">
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

	<!--*********************************TABLE**********************************-->
	<div id="aboveTheTable">
		<h1 id="head_cat">ТОВАРЫ КАТЕГОРИИ
<?php
		if( trim($_GET['cat']) == 'snoubord' ){echo 'СНОУБОРДЫ';}
		if( trim($_GET['cat']) == 'scooter' ){echo 'САМОКАТЫ';}
		if( trim($_GET['cat']) == 'roller' ){echo 'РОЛЛИКОВЫЕ КОНЬКИ';}
		if( trim($_GET['cat']) == 'tennis' ){echo 'ТЕННИСНЫЕ РАКЕТКИ';}
		if( trim($_GET['cat']) == 'wakeboard' ){echo 'ВЕЙКБОРДЫ';}
?></h1>
	</div>
		<div id="topPart">
			<table>
				<tr class="headTable">
					<th class="headTable" id="headTable">Название товара</th>
					<th class="headTable" id="headTable">Бэйдж</th>
					<th class="headTable" id="headTable" colspan="2">Цена</th>
				</tr>
				<tbody>
					<form action="userInformation.php" method="GET">
						<?php
if($array_bd !== false){
							foreach($array_bd as $key => $value){
									echo '<tr>';

										echo '<td>';
										echo '<span>' . $value['product_name']. '</span>';
										echo '</td>';
										echo '<td>';

if( $value['badge'] == 'hot'){
	echo "<span style='color: #B62D2D;'>HOT</span>";
} else if($value['badge'] == 'new'){
	echo "<span style='color: #64A0E6;'>NEW</span>";
} else if($value['badge'] == 'sale'){
	echo "<span style='color: #E2C059;'>SALE</span>";
} else if($value['badge'] == 'absent'){
	echo "<span style='color: #A19F9A;'>без бейджа</span>";
}
										echo '</td>';
										echo '<td>';
										echo '<span class="price_font">' . $value['price'] . '</span>';
										echo '</td>';
										echo '<td><a href="itemInformation.php?id_article='.$value['id_article'].'">просмотр</a></td>';
									echo '</tr>';
							}
}
						?>
					</form>
				</tbody>
			</table>
		</div>
	</div>
</section>
<body>
</html>
