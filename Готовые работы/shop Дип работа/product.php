<?php
require_once 'php/require.php';

$article_id='';
if ( isset($_GET['id_article']) ){

	$article_id = $_GET['id_article'];	
			// Соединение сервером БД, и выбор БД
			$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

			$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$article_id';";
			$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
			$array_bd_id = pg_fetch_array($result_select_id);
			
			// Очистка результатов
		@pg_free_result($result_select_id);
}
/* echo "<pre>";
print_r($array_bd_id); 
echo "</pre>"; */
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Image gallery with description in 4 lines of jQuery code" />
	<meta name="keywords" content="jquery tutorial,image gallery, jquery delegate" />
	<title>Товары</title>
	<link rel="stylesheet" href="CSS/productStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
	<script src="https://cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js"></script>
	<script src="cart.js"></script>
</head>
<body>

<?php
	require_once 'php/header.php';
	?>

	<!--**************************КАТЕГОРИИ ТОВАРА**************************-->
<section>
	<div id="section">
	
	<div id="head">
			<?php
				if($array_bd_id["category_name"] == 'snoubord'){
					$name_category = "Сноуборды";
				}else if($array_bd_id["category_name"] == 'roller'){
					$name_category = "Ролликовые коньки";
				}else if($array_bd_id["category_name"] == 'scooter'){
					$name_category = "Самокаты";
				}else if($array_bd_id["category_name"] == 'tennis'){
					$name_category = "Теннисные ракетки";
				}else if($array_bd_id["category_name"] == 'wakeboard'){
					$name_category = "Вейкборды";
				}	
				?>
		<span id="category"><?=$name_category?></span><br><a href="#" id="backCatalog">ВЕРНУТЬСЯ В КАТАЛОГ</a>
	</div>	
		<div id="productInfo">		
			<div id="gallery">
				<div id="panel">
					<div id="largeImage">
						<img src="backEnd<?php
						$v = substr($array_bd_id["path_file1"], 1);
						echo $v;
						?>" alt="">
					</div>
					<div id="description"></div>
				</div>
				
				<div id="thumbs">
					
					<a href="#" id="arrowLeftInfo"><img src="image/arrowLeftInfo.png" alt="arrow"></a>
					
						<div  class="under" id="box_light1" onMouseOver="document.getElementById('largeImage').innerHTML=this.innerHTML">
							<img src="backEnd<?php $v = substr($array_bd_id["path_file1"], 1); echo $v;?>" alt="">
						</div>
						<div  class="under" id="box_light2" onMouseOver="document.getElementById('largeImage').innerHTML=this.innerHTML">
							<img src="backEnd<?php $v = substr($array_bd_id["path_file2"], 1); echo $v;?>" alt="">
						</div>
						<div  class="under" id="box_light3" onMouseOver="document.getElementById('largeImage').innerHTML=this.innerHTML">
							<img src="backEnd<?php $v = substr($array_bd_id["path_file3"], 1); echo $v;?>" alt="">
						</div>
						<div  class="under" id="box_light4" onMouseOver="document.getElementById('largeImage').innerHTML=this.innerHTML">
							<img src="backEnd<?php $v = substr($array_bd_id["path_file4"], 1); echo $v;?>" alt="">
						</div>
					
					<a href="#" id="arrowRightInfo"><img src="image/arrowRightInfo.png" alt="arrow"></a>
					
				</div>
			</div>
									
			<div id="middle">
				<h1><?php echo $array_bd_id["product_name"]; ?></h1>
				<div>Артикул: <?=$array_bd_id["id_article"]?></div>				
				<?php if( (!empty($array_bd_id["variable1"])) || (!empty($array_bd_id["variable2"])) || (!empty($array_bd_id["variable2"])) ){
					
					echo '<span>Выберите вариант: </span> <select>';
					
					} ?>
				
					<?php if(!empty($array_bd_id["variable1"])){echo '<option>'.$array_bd_id["variable1"].'</option>';} ?>
					<?php if(!empty($array_bd_id["variable2"])){echo '<option>'.$array_bd_id["variable2"].'</option>';} ?>
					<?php if(!empty($array_bd_id["variable3"])){echo '<option>'.$array_bd_id["variable3"].'</option>';} ?>
					
				<?php if( (!empty($array_bd_id["variable1"])) || (!empty($array_bd_id["variable2"])) || (!empty($array_bd_id["variable2"])) ){
					
					echo '</select>';
					
					} ?>	
					
				<div><?php echo $array_bd_id["specification"]; ?></div>	
			</div>
			
			<div id="blokRight">
				<div id="lightBoard">
					<div id="bordBott">
						<span id="through">9 990 руб.</span>
						<div id="cost"><?php echo $array_bd_id["price"]; ?>руб.</div>
						<div><img src="image/daw.png" alt="daw">&nbsp;&nbsp;<b>есть в наличии</b></div>
					</div>
					<a href="shopping_cart.php?article_id=<?php echo $array_bd_id['id_article'];?>">
						<div id="buy">
							<?php $_SESSION['buy_article']=$array_bd_id['id_article']; ?>
							<img src="image/cart20x20.png" alt="cart"><span>КУПИТЬ</span>
						</div>
					</a>
				</div>
				<div id="stick">
					<div>
						<div><img src="image/avto.png" alt="avto"></div>
						<b>БЕСПЛАТНАЯ ДОСТАВКА</b>
						<span>по всей России</span>
					</div>
					<div>
						<div><img src="image/girlsIcon.png" alt="girlsIcon"></div>
						<b>ГОРЯЧАЯ ЛИНИЯ</b>
						<span>8 800 000-00-00</span>
					</div>
					<div>
						<div><img src="image/present.png" alt="present"></div>
						<b>ПОДАРКИ</b>
						<span>каждому покупателю</span>
					</div>					
				</div>
			</div>												
		</div>		
		
		<!-- ==============Нижний блок============== -->	
		<div id="blokBottom">				
		<div id="carousel" class="carousel">Другие товары из "Категории <?=$name_category?>" 
			<img class="arrow next" src="image/arrowRight.png" alt="arrow" onClick="rights();" id="arrowRight"> 
			<img class="arrow prev" src="image/arrowLeft.png" alt="arrow" onClick="lefts();" id="arrowLeft"> 
		</div>	
	
		<div id="galery">
	<?php
				if($array_bd_id["category_name"] == 'snoubord'){
					$name_cat = "snoubord";
				}else if($array_bd_id["category_name"] == 'roller'){
					$name_cat = "roller";
				}else if($array_bd_id["category_name"] == 'scooter'){
					$name_cat = "scooter";
				}else if($array_bd_id["category_name"] == 'tennis'){
					$name_cat = "tennis";
				}else if($array_bd_id["category_name"] == 'wakeboard'){
					$name_cat = "wakeboard";
				}

if(isset($_POST['sum_res'])){			
$sum = $_POST['sum_res'];
}else{
$sum = 1;	
}
					/////////////////Начальный запрос при загрузке страницы/////////////////////
$select_snoubord1 = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'snoubord';";
//$select_snoubord1 = "SELECT id_article, product_name, price, badge, path_file1 FROM product WHERE category_name = 'snoubord' AND id_article > '$sum' LIMIT 4;";
//$select_snoubord1 = "SELECT id_article, product_name, price, badge, path_file1 FROM product WHERE category_name = 'snoubord' LIMIT $sum-1, 4;";
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
		// Очистка результатов
	pg_free_result($result_select_snoubord1);

		// Закрытие соединения
	pg_close($dbconn);
?>				
				
		</div>	
	</div>						
</section>

<?php include 'php/foot.php'?>

<script>
if (typeof shiftl === "undefined"){var shiftl = 0;};
function rights(){
	shiftl = shiftl+290;
	document.getElementById('galery').style.marginLeft = "-"+shiftl+"px";
};

function lefts(){	
	shiftl = shiftl - 290;
	document.getElementById('galery').style.marginLeft = "-"+shiftl+"px";	
};

</script>

	
