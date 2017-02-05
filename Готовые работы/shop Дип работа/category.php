<?php
require_once 'php/require.php';

/*=====Вывод из определенной категории======*/ 

//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error()); 
/*$select_snoubord = "SELECT product_name, price, badge, path_file1 FROM product WHERE category_name = 'snoubord' LIMIT 9;";*/
$select_snoubord = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'snoubord' ORDER BY random() LIMIT 9;";
$result_select_snoubord = pg_query($dbconn, "$select_snoubord") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_snoubord = pg_fetch_all($result_select_snoubord);


//Создаю таблицу product и поля
/*$result = pg_query($dbconn, "CREATE TABLE product(
													id_article serial,
													category_name varchar,
													product_name varchar,
													specification varchar,
													price varchar,
													badge varchar,
													variable1 varchar,
													variable2 varchar,
													variable3 varchar,
													path_file1 varchar,
													path_file2 varchar,
													path_file3 varchar,
													path_file4 varchar );
 "); 
*/ 

/*

//Создаю таблицу category и поля
$result = pg_query($dbconn, "CREATE TABLE category(
													id serial,
													category_name varchar,
													id_parent integer
													);"); 
*/ 




?>
	<!DOCTYPE html>
	<html lang="ru-RU">

	<head>
		<meta charset="UTF-8">
		<title>СНОУБОРДЫ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/categoryStyle.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>

	<body>
		<?php require_once 'php/header.php'; ?>

			<!--***************************************КАТЕГОРИИ ТОВАРА********************************************-->
			<section>
				<div id="section">
					<span class="category">СНОУБОРДЫ</span>
					<br>
					<span class="thisLook">ПОКАЗАНО 1-17 ИЗ 100 ТОВАРОВ</span>

					<div class="pageCategory">
						<div id="po">
							<div class="page">Страницы</div>
							<div class="page1"><a href="#">1</a></div>
							<!--div class="page2"><a href="#">2</a></div>
							<div class="page3"><a href="#">3</a></div-->
						</div>
					</div>
					<img src="image/categoryBiker.jpg" alt="baner" class="categoryBiker">

<?php
foreach($array_bd_snoubord as $key => $value){
$v = substr($value["path_file1"], 1);
if($value["badge"]=="new"){
		$badge = " newWrapper";
		$badge_img = '<div class="new"><img src="image/newgreen.png" alt="new"></div>';
	}else if($value["badge"]=="hot"){
		$badge = " hotWrapper";
		$badge_img = '<div class="hot"><img src="image/hotyelow.png" alt="hot"></div>';
	}else if($value["badge"]=="sale"){
		$badge = " saleWrapper";
		$badge_img = '<div class="sale"><img src="image/salered.png" alt="sale"></div>';
	}else{
		$badge = '';
		$badge_img = '';
}
echo '<div class="blokProdukt borR'. $badge .'">
	<a class="bp" href="product.php?id_article='.$value["id_article"].'">
	<img src="backEnd' . $v . '" alt="Изображение товара">
	<span>' . $value["product_name"] . '<sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $value["price"] . '&nbsp;<span>руб.</span></sub>
	</span>'. $badge_img .'
	</a>
	</div>';

}
?>

<?php
echo '<div class="my-flex-container">';
echo '<div class="my-flex-block">';
/*$select_snoubord = "SELECT product_name, price, badge, path_file1 FROM product WHERE category_name = 'snoubord' LIMIT 9;";*/
/*$select_snoubord1 = "SELECT product_name, price, badge, path_file1 FROM product WHERE category_name = 'snoubord' ORDER BY random() LIMIT 4;";*/
$select_snoubord1 = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'snoubord' AND id_article > 9 LIMIT 4;";
$result_select_snoubord1 = pg_query($dbconn, "$select_snoubord1") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_snoubord_desc1 = pg_fetch_all($result_select_snoubord1);
foreach($array_bd_snoubord_desc1 as $key => $value){
	$v = substr($value["path_file1"], 1);
	if($value["badge"]=="new"){
			$badge = " newWrapper";
			$badge_img = '<div class="new"><img src="image/newgreen.png" alt="new"></div>';
		}else if($value["badge"]=="hot"){
			$badge = " hotWrapper";
			$badge_img = '<div class="hot"><img src="image/hotyelow.png" alt="hot"></div>';
		}else if($value["badge"]=="sale"){
			$badge = " saleWrapper";
			$badge_img = '<div class="sale"><img src="image/salered.png" alt="sale"></div>';
		}else{
			$badge = '';
			$badge_img = '';
	}
	
	
	echo '<div class="blokProdukt borR'. $badge .'">
			<a class="bp" href="product.php?id_article='.$value["id_article"].'">
			<img src="backEnd' . $v . '" alt="Изображение товара">				
				<span>' . $value["product_name"] . '<sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $value["price"] . '&nbsp;<span>руб.</span></sub>
				</span>'. $badge_img .'
			</a>
		</div>';
	
} 
echo '</div>';
?>
						
							<div class="banerRight my-flex-block">
								<span>ЗАГОЛОВОК<div>ПРОМО-ТОВАРА</div></span>
								<div id="description">Описание промо-товара</div>
								<sub>4 540<span>руб.</span></sub>
								<div id="look"><a href="product.html">Посмотреть +</a></div>
								<img src="image/girlsCap.png" alt="bannerRight">
							</div>
						</div>

<?php
echo '<div id="blokBottom">';
$select_snoubord1 = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'snoubord' ORDER BY random() LIMIT 4;";
$result_select_snoubord1 = pg_query($dbconn, "$select_snoubord1") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_snoubord_desc = pg_fetch_all($result_select_snoubord1);
foreach($array_bd_snoubord_desc as $key => $value){
	$v = substr($value["path_file1"], 1);
	if($value["badge"]=="new"){
			$badge = " newWrapper";
			$badge_img = '<div class="new"><img src="image/newgreen.png" alt="new"></div>';
		}else if($value["badge"]=="hot"){
			$badge = " hotWrapper";
			$badge_img = '<div class="hot"><img src="image/hotyelow.png" alt="hot"></div>';
		}else if($value["badge"]=="sale"){
			$badge = " saleWrapper";
			$badge_img = '<div class="sale"><img src="image/salered.png" alt="sale"></div>';
		}else{
			$badge = '';
			$badge_img = '';
	}
	
	
	echo '<div class="blokProdukt borR'. $badge .'">
			<a class="bp" href="product.php?id_article='.$value["id_article"].'">
			<img src="backEnd' . $v . '" alt="Изображение товара">				
				<span>' . $value["product_name"] . '<sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $value["price"] . '&nbsp;<span>руб.</span></sub>
				</span>'. $badge_img .'
			</a>
		</div>';
	
}
echo '</div>';


		// Очистка результатов
	pg_free_result($result_select_snoubord1);
	pg_free_result($result_select_snoubord);

		// Закрытие соединения
	pg_close($dbconn);
?>

							<div class="pageCategory">
								<div>
									<div class="page">Страницы</div>
									<div class="page1"><a href="#">1</a></div>
								
								</div>
							</div>

						</div>
			</section>

			<?php include 'php/foot.php'?>
