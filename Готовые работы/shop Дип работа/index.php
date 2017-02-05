<?php
session_start(); 
if($_SESSION['arr_cart'] === 0){$_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0;}
if($_SESSION['qty_res'] === 0){$_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0;}
if($_SESSION['pin'] === 0){$_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0;}
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);
if(!isset($_SESSION['online'])){$_SESSION['online'] = 0;} 
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Создание таблиц//////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/* // Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
//////////****Создаю таблицы**
$orders = '
CREATE TABLE dbelotserkovets_orders (
    order_id serial NOT NULL,
    users_id integer,
    dostavka character varying,
    status integer,
    prim character varying,
    date_zakaz timestamp without time zone,
    mail_us character varying,
    pin integer
)';
$product = '
CREATE TABLE dbelotserkovets_product (
    id_article serial NOT NULL,
    category_name character varying,
    product_name character varying,
    specification character varying,
    price character varying,
    badge character varying,
    path_file1 character varying,
    path_file2 character varying,
    path_file3 character varying,
    path_file4 character varying,
    variable1 character varying,
    variable2 character varying,
    variable3 character varying
)';
$transaction = '
CREATE TABLE dbelotserkovets_transaction (
    id_transaction serial NOT NULL,
    users_id integer,
    log_in smallint,
    log_out smallint,
    article_id integer,
    buy_goods integer,
    date_time timestamp without time zone
)';
$users = '
CREATE TABLE dbelotserkovets_users (
    id serial NOT NULL,
    fio character varying,
    email character varying,
    password character varying,
    telefone character varying,
    city character varying,
    street character varying,
    hause character varying,
    apartment character varying,
    role integer
)';
$zakaz_tovar = '
CREATE TABLE dbelotserkovets_zakaz_tovar (
    zakaz_tovar_id serial NOT NULL,
    orders_id integer,
    article_id integer,
    quantity smallint
)';

$result = pg_query($dbconn, $orders);
$result = pg_query($dbconn, $product);
$result = pg_query($dbconn, $transaction);
$result = pg_query($dbconn, $users);
$result = pg_query($dbconn, $zakaz_tovar); */
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////


//echo "<pre>";
//print_r($_SESSION['users_id']);
//echo "</pre>";
//echo "<pre>";
//print_r($_SESSION['admin']);
//echo "</pre>";

if( isset ( $_POST["logout"] ) ){
	
// Запись в БД таблица transaction ---->
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$user_id = $_SESSION['users_id'];
$log_out = 1;
$insert_to = "INSERT INTO dbelotserkovets_transaction(users_id, log_out, date_time) VALUES ('$user_id', '$log_out', NOW());";
pg_query($dbconn, $insert_to) or die('Ошибка запроса записи: ' . pg_last_error());	
	
	unset($_SESSION['online']);
	unset($_POST);
	session_destroy();
	header('Location: index.php');
}

// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

$select_roller = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'roller';";
$result_select_roller = @pg_query($dbconn, "$select_roller") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_roller = pg_fetch_all($result_select_roller);

$select_snoubord = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'snoubord' LIMIT 4;";
$result_select_snoubord = pg_query($dbconn, "$select_snoubord") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_snoubord = pg_fetch_all($result_select_snoubord);

$select_scooter = "SELECT id_article, product_name, price, badge, path_file1 FROM dbelotserkovets_product WHERE category_name = 'scooter';";
$result_select_scooter = pg_query($dbconn, "$select_scooter") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_scooter = pg_fetch_all($result_select_scooter);

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>SShop</title>
	<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
	<header>
		<div id="back">
			<div id="groundTop"><img src="image/biker.jpg" alt="biker"></div>
			<div id="groundTop1"><img src="image/biker.png" alt="biker"></div>
			<div id="groundLet">SUPER&nbsp;SHOP</div>

			<!--****************************МЕНЮ********************************************-->
			<div id="header">
				<a href="index.php">
					<div id="label">
						<div id="super">SUPER</div>
						<div id="shop">SHOP</div>
					</div>
				</a>
				<div class="menu">
					<ul>
						<li><a href="category.php">Сноуборд</a>
						<li><a href="category1.php">Самокат</a>
						<li><a href="category2.php">Роликовые коньки</a>
						<li><a href="category3.php">Теннисные ракетки</a>
						<li><a href="category4.php">Вейкборд</a>
							<?php
					if(isset($_SESSION['online'])){
						if($_SESSION['online'] == 0){

							if(empty($_SESSION['qty_res'])){$_SESSION['qty_res'] = 0;}
							if(empty($_SESSION['pin'])){$_SESSION['pin'] = 0;}


							echo '
										<li id="liAva">
											<a href="login.php">
												<sub><img src="image/avatar.png" alt="avatar"></sub>
												<span id="dottR">Войти</span>
											</a>
										<li id="liReg"><a href="registr.php"><span id="dottB">Регистрация</span></a>
									</ul>
									<a href="shopping_cart.php">
										<div id="basket">
											<span id="totalCost">'.$_SESSION['pin'].' <span id="rub">руб.</span></span>
											<br>
											<span id="subject">' . $_SESSION['qty_res'] . ' предмета</span>
											<img id="cart" src="image/cart.png" alt="basket">
										</div>
									</a>
							    ';

						}else if($_SESSION['online'] == 1) {
						if(empty($_SESSION['qty_res'])){$_SESSION['qty_res'] = 0;}
						if(empty($_SESSION['pin'])){$_SESSION['pin'] = 0;}

echo '

<style>
	#dottB{
	overflow: hidden;
	color: #000;
	width: 111px;
	height: 65px;
	cursor: pointer;
	text-align: center;
	display: block;
	font: 14px Supermolot;
	background-color: white;
	}

	#dottB:hover {
		background-color: #021563;
		color: white;
		transition: all .3s;
	}
</style>
				<li id="liAva">
					<a href="account.php">
						<span id="dottR">Профиль</span>
					</a>
				<li id="liReg">
					<form action="#" method="POST">
						<button name="logout" type="submit" id="dottB"><span>ВЫЙТИ</span></button>
					</form>
			</ul>
			<a href="shopping_cart.php">
				<div id="basket">
					<span id="totalCost">'.$_SESSION['pin'].' <span id="rub">руб.</span></span>
					<br>
					<span id="subject">' . $_SESSION['qty_res'] . ' предмета</span>
					<img id="cart" src="image/cart.png" alt="basket">
				</div>
			</a>';
							}
					} else {
						if(empty($_SESSION['qty_res'])){$_SESSION['qty_res'] = 0;}
							if(empty($_SESSION['pin'])){$_SESSION['pin'] = 0;}
						if( !isset($_SESSION['online']) ){$_SESSION['online'] = 0;}
						echo '	<li id="liAva">
											<a href="login.php">
												<sub><img src="image/avatar.png" alt="avatar"></sub>
												<span id="dottR">Войти</span>
											</a>
										<li id="liReg"><a href="registr.php"><span id="dottB">Регистрация</span></a>
									</ul>
									<a href="shopping_cart.php">
										<div id="basket">
											<span id="totalCost">'.$_SESSION['pin'].' <span id="rub">руб.</span></span>
											<br>
											<span id="subject">' . $_SESSION['qty_res'] . ' предмета</span>
											<img id="cart" src="image/cart.png" alt="basket">
										</div>
									</a> ';
						}
					?>
				</div>
				<!--**************************************Надпись слево********************************************-->

				<div id="leftLetter">
					<div id="nameP">НАЗВАНИЕ</div>
					<div id="promo">ПРОМО-ТОВАРА</div>
					<div id="description">Описание промо-товара</div>
				</div>
				<div id="look">
					<a href="product.php?id_article=66">Посмотреть +</a>
				</div>
			</div>
		</div>
	</header>

	<!--***************************************КАТЕГОРИИ ТОВАРА********************************************-->

	<section>
		<div id="section">
			<div id="carousel" class="carousel">Новые товары
				<img class="arrow next" src="image/arrowRight.png" alt="arrow" onClick="rights();" id="arrowRight">
				<img class="arrow prev" src="image/arrowLeft.png" alt="arrow" onClick="lefts();" id="arrowLeft">
			</div>

<script>
if (typeof shiftl === "undefined"){var shiftl = 0;};
function rights(){
	shiftl = shiftl + 290;
	document.getElementById('galery').style.marginLeft = "-"+shiftl+"px";
};

function lefts(){
	shiftl = shiftl - 290;
	document.getElementById('galery').style.marginLeft = "-"+shiftl+"px";
};
</script>
		<div id="galery">
<?php
if($array_bd_roller !== false){
	foreach($array_bd_roller as $key => $value){
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
}	
?>
</div>
<?php
if($array_bd_snoubord !== false){
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
}
?>
			<div class="bannerCenter">
				<div><img src="image/snowbordman.jpg" alt="bannerCenter">
					<span id="one">ЗАГОЛОВОК <br><span>ПРОМО-ТОВАРА</span></span>
				</div>
				<div><img src="image/climber.jpg" alt="bannerCenter">
					<span id="two">ЗАГОЛОВОК <br><span>ПРОМО-ТОВАРА</span></span>
				</div>
				<div><img id="skateGirls" src="image/girlsskait.jpg" alt="bannerCenter">
					<span id="three">ЗАГОЛОВОК <br><span>ПРОМО-ТОВАРА</span></span>
				</div>
			</div>

			<div id="productBottom">
				<div id="carousel1" class="carousel1">Популярные товары
					<img class="arrow next" src="image/arrowRight.png" alt="arrow" onClick="rights1();" id="arrowsRight">
					<img class="arrow prev" src="image/arrowLeft.png" alt="arrow" onClick="lefts1();" id="arrowsLeft">
				</div>

<script>
if (typeof shiftl1 === "undefined"){var shiftl1 = 0;};
function rights1(){
	shiftl1 = shiftl1 + 290;
	document.getElementById('galery1').style.marginLeft = "-"+shiftl1+"px";
};

function lefts1(){
	shiftl1 = shiftl1 - 290;
	document.getElementById('galery1').style.marginLeft = "-"+shiftl1+"px";
};
</script>
	<div id="galery1">
<?php
if($array_bd_scooter !== false){
	foreach($array_bd_scooter as $key => $value){
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
}	
		// Очистка результатов
	pg_free_result($result_select_roller);
	pg_free_result($result_select_snoubord);
	pg_free_result($result_select_scooter);

		// Закрытие соединения
	pg_close($dbconn);

?>
	</div>
</div>

			<div class="oshop">
				<img src="image/snowSkooterMan.jpg" alt="snowSkooterMan">
				<div id="caption">О магазине</div>
				<div id="descriptionShop">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
						<br>
						<br>
						<br> Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras
					</p>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div id="footer">
			<p>Шаблон для экзаменационного задания.
				<br> Разработан специально для «Всероссийской Школы Программирования»
				<br> http://bedev.ru/
			</p>
			<a href="#">Наверх <img src="image/triangle.png" alt="up"></a>
		</div>
	</footer>
</body>
</html>
