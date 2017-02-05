<?php
session_start();
		// Показать все возможные ошибки
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);
/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	header('Location: ../index.php');
		exit;
} */

	//echo "<pre>";
	//var_dump($_POST);
	//echo "</pre>";
?>
<!DOCTYPE html>
<html lang="ru-RU">

	<head>
		<meta charset="UTF-8">
		<title>home</title>
		<link rel="stylesheet" href="CSS/style.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>

	<body>
		<div id="hop"></div>
		<!--*******************************NAV MENU***********************************-->
		<section>
			<nav>
				<ul>
					<li>
						<a id="label" href="index.php"><img src="image/label.jpg" alt="label"></a>
					</li>
					<li>
						<a href="index.php"><img src="image/cartAGreen.png" alt="cartA"><span>ЗАКАЗЫ</span></a>
					</li>
					<li>
						<a href="users.php"><img src="image/avaUsers.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a>
					</li>
					<li>
						<a href="items.php"><img src="image/truck.png" alt="truck"><span>ТОВАРЫ</span></a>
					</li>
					<li>
						<a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a>
					</li>
				</ul>
				<div id="goOut">
					<div>admin@mail.ru</div>
					<a href="logout.php?get_out=out_man">выйти</a>
				</div>
			</nav>
			<div>
				<h1>ЗАКАЗЫ</h1>
				<div>
					<form action="orderInformation.php" method="GET">
						<!--*********************************TABLE**********************************-->
						<table>
							<tr id="headTable">
								<th>НОМЕР ЗАКАЗА</th>
								<th>СТАТУС</th>
								<th>СУММА</th>
								<th>ВРЕМЯ ЗАКАЗА</th>
								<th></th>
							</tr>
							<tbody>
								<?php
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select= "SELECT * FROM dbelotserkovets_orders;";
$result = pg_query($dbconn, "$select") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result);

if($array_bd !== false){ /////////////////////// Варианты статуса
	foreach($array_bd as $key => $value){

		echo '<tr>
				<td>
					<span class="numberBlue">№'.$value['order_id'].'</span>
					<span class="OT">от</span>
					<span class="mail">'.$value['mail_us'].'</span>
				</td>';

		echo '<td class="tdsel">';
		echo		'<div class="wrap_sel">';
		echo		'<input class="cel" type="hidden" value="'.$value['order_id'].'">';
		echo		'<select data-hidd="i17" class="';
					if($value['status'] == 0){ echo 'sel0';}
					if($value['status'] == 1){ echo 'sel1';}
					if($value['status'] == 2){ echo 'sel2';}
					if($value['status'] == 3){ echo 'sel3';}
					if($value['status'] == 4){ echo 'sel4';}
					//  Обновление через 3 сек  
		echo        ' .link" onchange="setTimeout(function() {window.location.reload();}, 3000);">';
		echo			'<option style="color: #0C8FB0;" ';
					if($value['status'] == 0){echo "selected";}
		echo			" value='adopted' onclick=\"statq(this.value, this.parentNode.parentNode.firstElementChild.value);\">Принят</option>";
		echo			'<option style="color: #1BA254;" ';
					if($value['status'] == 1){echo "selected";}
		echo			" value='shipped' onclick=\"/*alert('id:'+this.parentNode.parentNode.firstElementChild.value);*/ /*alert(document.getElementById(this.hiddenId).classList.className);*/ statq(this.value, this.parentNode.parentNode.firstElementChild.value);\">Отгружен</option>";
		echo			'<option style="color: #AD5A00;" ';
					if($value['status'] == 2){echo "selected";}
		echo			" value='do_courier' onclick=\"statq(this.value, this.parentNode.parentNode.firstElementChild.value);\">У курьера</option>";
		echo			'<option style="color: #A01BA2;" ';
					if($value['status'] == 3){echo "selected";}
		echo			" value=delivered onclick=\"statq(this.value, this.parentNode.parentNode.firstElementChild.value);\">Доставлен</option>";
		echo			'<option style="color: #6C6C6C;" ';
					if($value['status'] == 4){echo "selected";}
		echo			"value='cancellation' onclick=\"statq(this.value, this.parentNode.parentNode.firstElementChild.value);\">Отмена</option>";
		echo			'</select>';
		echo			'</div>';

		echo		'</td>
					<td>'.$value['pin'].' руб.</td>';
		$dates = substr($value['date_zakaz'], 0, 10);
		$times = substr($value['date_zakaz'], 11, 5);
		echo		'<td>'.$dates.' в '.$times.'</td>
					
					<td><a href="orderInformation.php?id_orders='. $value['order_id'] .'">просмотр</a></td>					
				</tr>';
	}
}
?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</section>
		<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" defer></script-->
		<!--script src="jquery-3.1.1.slim.min.js"></script-->
		<script src="js/status.js" defer></script>
	</body>
</html>