<?php
require_once 'php/require.php';

//echo "<pre>";
//print_r($_SESSION['arr_cart']);
//echo "</pre>";	

		/*// Функция отправления почты заказчику и админу
function mail_order($order_res, $contact_email){
		// Тема письма
	$subject = "Заказ в интернет магазине SUPER SHOP";	
		// Заголовки
	$headers ='';
	$headers .= "Content-type: text/plain; charset=utf-8\r\n";
	$headers .= "From: SUPER SHOP";
		// Тело письма
	$mail_body = "Спасибо за покупку!\r\n Номер Вашего заказа - {$order_res}\r\n\r\n Заказанные товары:\r\n";
		// Заказанные товары
foreach($_SESSION['arr_cart'] as $goods_id => $value){
	$mail_body .= "Наименование : {$value['product_name']}, Цена: {$value['price']}, Колличество: {$value['qty']} шт. \r\n";
}
	$mail_body .= "\r\n Итого: {$_SESSION['qty_res']} шт. на сумму : {$_SESSION['pin']}";
	mail($contact_email, $subject, $mail_body, $headers);
	mail('belocerkovecden@mail.ru', $subject, $mail_body, $headers);
		// Удаляю переменные
unset($_SESSION['arr_cart']);
unset($_SESSION['error']);
unset($_SESSION['$errors1']);
unset($_SESSION['contact_email']);
unset($_SESSION['contact_fio']);
unset($_SESSION['contact_telefone']);
unset($_SESSION['contact_city']);
unset($_SESSION['contact_street']);
unset($_SESSION['contact_hause']);
unset($_SESSION['pin']);
unset($_SESSION['qty_res']);
unset($_SESSION['contact_apartment']);
unset($_POST);
unset($_GET);
}*/

		//// функция добавления не зарегистрированного пользователя
function add_customer($fio, $mail, $phone, $city, $street, $hause, $apart){
			// Если пользователь не авторизован
	if($_SESSION['online'] === 0){	
			// Соединение сервером БД, и выбор БД
		$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	
		$query = "INSERT INTO dbelotserkovets_users (fio, email, telefone, city, street, hause, apartment) VALUES ( '$fio', '$mail', '$phone', '$city', '$street', '$hause', '$apart' )";
		$result_insert = pg_query($dbconn, $query) or die('Ошибка запроса записи: ' . pg_last_error());

			// Проверяю добавился ли пользователь
		if(pg_affected_rows($result_insert) > 0){
			// Если гость добавлен в таблицу берем его id
		$query_id = "SELECT MAX(id) FROM dbelotserkovets_users";
		$result_id = pg_query($dbconn, $query_id) or die('Ошибка запроса записи: ' . pg_last_error());
		$user_id = pg_fetch_result($result_id,0,0);

$_SESSION['users_id'] = $user_id; // Для записи в транзакции если польователь новый
		
			// Вызываю функцию записи заказа
			 $mail_us = $_SESSION['contact_email'];
			 $pin = $_SESSION['pin'];
			 $order_comment = $_SESSION['order_comment'];		
			 $delivery = $_SESSION['delivery_method'];
			 save_order($user_id, $delivery, $order_comment, $mail_us, $pin);
			 return $user_id;
			// $user_id ----> id	
		} else {
			// если произошла ошибка и заказчик не добавлен
			$_SESSION['error'] = "<div>Произошла ошибка при регистрации заказа!</div>";
			return false;
		}
	}else if($_SESSION['online'] === 1){ // Если пользователь не авторизован
		$user_id = $_SESSION['idman'];
		
// Вызываю функцию записи заказа
			 $mail_us = $_SESSION['contact_email'];
			 $pin = $_SESSION['pin'];
			 $order_comment = $_SESSION['order_comment'];		
			 $delivery = $_SESSION['delivery_method'];
			 save_order($user_id, $delivery, $order_comment, $mail_us, $pin);
			 return $user_id;
			// $user_id ----> id
	}
	
}

		//// Функция сохранения заказа
function save_order($user_id, $delivery, $order_comment, $mail_us, $pin){
		// Соединение сервером БД, и выбор БД
	$status = 0;	
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	
	$query_order = "INSERT INTO dbelotserkovets_orders (users_id, date_zakaz, dostavka, status, prim, mail_us, pin) VALUES ($user_id, NOW(), '$delivery', $status, '$order_comment', '$mail_us', $pin)";
	pg_query($dbconn, $query_order) or die('Ошибка запроса записи: ' . pg_last_error());

		// Если orders добавлен в таблицу берем его id
	$query_order_id = "SELECT MAX(order_id) FROM dbelotserkovets_orders";
	$result_order_id = pg_query($dbconn, $query_order_id) or die('Ошибка запроса записи: ' . pg_last_error());
	$order_id = pg_fetch_result($result_order_id,0,0);

		// ID Сохраненного товара
 	$val = '';
	foreach($_SESSION['arr_cart'] as $items_id => $value){
		$val .= "($order_id, $items_id, {$value['qty']}),";
	}
	$val = substr($val, 0, -1); // Удаляю последнюю запятую
	$que = "INSERT INTO dbelotserkovets_zakaz_tovar (orders_id, article_id, quantity) VALUES $val";
 	pg_query($dbconn, $que) or die('Ошибка запроса записи: ' . pg_last_error());

$_SESSION['order_res'] = $order_id;

//mail_order($_SESSION['order_res'], $_SESSION['contact_email']); // Отправляем на почту админу и заказчику

		// Записываю заказ в транзакции ------->
$user_id = $_SESSION['users_id'];		
$insert_to = "INSERT INTO dbelotserkovets_transaction(users_id, buy_goods, date_time) VALUES ('$user_id', '$order_id', NOW());";
pg_query($dbconn, $insert_to) or die('Ошибка запроса записи: ' . pg_last_error());	

		// Закрытие соединения
pg_close($dbconn);
}
	
if( isset($_POST['confirm_order']) ){ // Если нажата кнопка подтвердить заказ на странице checkout_3.php
	
	if( empty($_SESSION['$errors1']) ){ // Если массив с ошибками пуст
			
			// Вызываю функцию для записи нового пользователя
						$fio 	= $_SESSION['contact_fio'];
						$mail 	= $_SESSION['contact_email'];
						$phone 	= $_SESSION['contact_telefone'];						
						$city	= $_SESSION['contact_city'];
						$street = $_SESSION['contact_street'];
						$hause 	= $_SESSION['contact_hause'];
						$apart 	= $_SESSION['contact_apartment'];
			
		 add_customer($fio, $mail, $phone, $city, $street, $hause, $apart);	
	}

}
?>
<!DOCTYPE html>
<html lang="ru-RU"> 
	<head>
		<meta charset="UTF-8">
		<title>ОФОРМЛЕНИЕ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/checkOut_4Style.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>
<body>
<?php
	require_once 'php/header.php';
	?>
	<!--*********************************Центральный блок*****************************************************-->
<section>
<div class="topic">ОФОРМЛЕНИЕ ЗАКАЗА</div>
<div id="section">
			
<div id="blockFloatLeft">
	<span id="orderNumber">Заказ № <?php echo $_SESSION['order_res']; ?></span>	<span id="good">&nbsp;успешно оформлен</span><br><br>
	<div id="thanks">Спасибо за Ваш заказ:</div><br><br>
	<div id="contactTheOperator">В ближайшее время с Вами свяжется оператор<br><span>для уточнения времени доставки.</span></div><br>
</div>	
<a id="backShop" href="index.php">Вернуться в магазин</a>		
									
</div>
</section>

<?php require_once 'php/foot.php'; 

 
//echo "<pre>";
//print_r($_SESSION['arr_cart']);
//echo "</pre>";	
?>
