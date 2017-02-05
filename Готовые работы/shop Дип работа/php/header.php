<?php  
//if($_SESSION['arr_cart'] == 0){$_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0;}
//if($_SESSION['qty_res'] == 0){$_SESSION['pin'] = 0;}
//if($_SESSION['pin'] == 0){$_SESSION['qty_res'] = 0;}
if(!isset($_SESSION['arr_cart'])){$_SESSION['arr_cart'] = array();}
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	// ВЫХОД
if( isset ( $_POST["logout"] ) ){
	
// Запись в БД таблица transaction ---->
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$user_id = $_SESSION['users_id'];
$log_out = 1;
$insert_to = "INSERT INTO dbelotserkovets_transaction(users_id, log_out, date_time) VALUES ('$user_id', '$log_out', NOW());";
pg_query($dbconn, $insert_to) or die('Ошибка запроса записи: ' . pg_last_error());	
	
	
	unset($_SESSION);
	unset($_POST);
	session_destroy();
	header('Location: index.php');
	}
?>

<style>
@font-face {
font-family: 'Supermolot';
src: url('../fonts/Supermolot/Supermolot.eot');
src: local('Supermolot'), url('../fonts/Supermolot/Supermolot.woff') format('woff'), url('../fonts/Supermolot/Supermolot.ttf') format('truetype'), url('../fonts/Supermolot/Supermolot.svg') format('svg');
font-weight: normal;
font-style: normal;
}
@font-face {
font-family: 'Supermolot Light';
src: url('../fonts/Supermolot-Light/Supermolot-Light.eot');
src: local('Supermolot Light'), url('../fonts/Supermolot-Light/Supermolot-Light.woff') format('woff'), url('../fonts/Supermolot-Light/Supermolot-Light.ttf') format('truetype'), url('../fonts/Supermolot-Light/Supermolot-Light.svg') format('svg');
font-weight: normal;
font-style: normal;
}
@font-face {
font-family: 'Supermolot Bold';
src: url('../fonts/Supermolot-Bold/Supermolot-Bold.eot');
src: local('Supermolot Bold'), url('../fonts/Supermolot-Bold/Supermolot-Bold.woff') format('woff'), url('../fonts/Supermolot-Bold/Supermolot-Bold.ttf') format('truetype'), url('../fonts/Supermolot-Bold/Supermolot-Bold.svg') format('svg');
font-weight: normal;
font-style: normal;
}
@font-face {
font-family: 'Supermolot Light Italic';
src: url('../fonts/Supermolot-Light-Italic/Supermolot-Light-Italic.eot');
src: local('Supermolot Light Italic'), url('../fonts/Supermolot-Light-Italic/Supermolot-Light-Italic.woff') format('woff'), url('../fonts/Supermolot-Light-Italic/Supermolot-Light-Italic.ttf') format('truetype'), url('../fonts/Supermolot-Light-Italic/Supermolot-Light-Italic.svg') format('svg');
font-weight: normal;
font-style: normal;
}
@font-face {
font-family: 'Supermolot Italic';
src: url('../fonts/Supermolot-Italic/Supermolot-Italic.eot');
src: local('Supermolot Italic'), url('../fonts/Supermolot-Italic/Supermolot-Italic.woff') format('woff'), url('../fonts/Supermolot-Italic/Supermolot-Italic.ttf') format('truetype'), url('../fonts/Supermolot-Italic/Supermolot-Italic.svg') format('svg');
font-weight: normal;
font-style: normal;
}
</style>
<header>
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
		</div>
</header>
