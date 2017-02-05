<?php
session_start();
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error()); 
require_once 'php/del_arr_elem.php';	
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>Корзина</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<link rel="stylesheet" href="CSS/shoppingCartStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/cart.js"></script>
</head>
<body>
<?php
 require_once 'php/header.php'; 
?>


<span id="res_n" style="width: 100px; height: 100px;"></span>	

<!--*************************ЗАГОЛОВОК  И  Таблица****************************************-->

<section>
			<div id="section">
			<div id="carLetter">КОРЗИНА</div>
	<div id="infoCart">
		<table>
			<tr>
				<th colspan="2">Товар</th>
				<th>Доступность</th>
				<th>Стоимость</th>
				<th>Количество</th>
				<th>Итого</th>
				<th></th>
			</tr>

<div id="psps"></div>			
<?php

if( (isset($_SESSION['arr_cart'])) && (!empty($_SESSION['arr_cart'])) ){
	
	
	foreach ($_SESSION['arr_cart'] as $key => $value) {

if(isset($_SESSION['arr_cart'][$value["id_article"]]['qty'])){$a = $_SESSION['arr_cart'][$value["id_article"]]['qty'];}else{$a=1;}
		$v = substr($value['path_file1'], 1);
			echo	'<form action="shopping_cart.php" method="POST">';
			echo	'<tr>';
			echo	'<td><img class="oneColumn" src="backEnd' . $v . '" alt="Изображение товара"></td>';
			echo	'<td class="twoColumn">'. $value['product_name'] .'</td>';
			echo	'<td class="threeColumn">Есть в наличии</td>';
			echo	'<td class="fourColumn">' . $value['price'] . '<span> руб.</span></td>';
			echo	'<td class="fiveColumn">
			<div class="center">
				<a href="shopping_cart.php?id_article='.$value["id_article"].'&nums=' . $value["id_article"] .'"><div class="minus" id="minus"> - </div></a>
				<div class="kol1" id="result">'.$a.'</div>
				<a href="shopping_cart.php?bid_article='.$value["id_article"].'&numsplus=' . $value["id_article"] .'"><div class="plus" id="plus" > + </div></a>						
			</div></td>';
		
			echo	'<td class="sixColumn">';
			if(isset($value['price_res'])){
				
				echo $value['price_res']; 
				
			}else{
				
				$value['price'] = str_replace(" ", "", $value['price']);
				
			}
		
			echo '<span> руб.</span></td>
					<td class="sevenColumn">
					</form>
					<form action="shopping_cart.php" method="POST">
						<div class="cross" id="wrap-cross" onClick="$(this).parent().parent().hide(1000);">
							<img class="cross" src="image/cross.png" alt="cross">
							<input id="cross" class="id_del cross" type="submit" name="btn_del" value="'. $value["id_article"] .'|'. $value["price"] .'">
						</div>
					</td>				
				</tr>
				</form>';
	}
	unset($value['price_res']);
	unset($value);
	unset($key);
	unset($a);
	unset($v);
}else{
$_SESSION['arr_cart'] = 0;	
}
?>		
		</table>
		<div id="totalBuy">
			<div id="return"><a href="index.php">Вернуться к покупкам</a></div>
			<div id="inTotal">Итого:</div>			
			<div id="sum"><?php if(isset($_SESSION['pin'])){echo $_SESSION['pin'];}else{echo 0;} ?> руб.</div>		
			<?php
if( isset($_SESSION['pin']) ){
echo		'<div id="chekOut"><a href="checkout.php">Оформить заказ</a></div>';}
			?>
		</div>
	</div>	
		</div>
	</section>

<?php require_once 'php/foot.php'?>
