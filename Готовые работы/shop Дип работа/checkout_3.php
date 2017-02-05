<?php
require_once 'php/require.php';

if( isset($_POST['but_checkout_2']) ){

	$data1 = $_POST;
	$errors1 = array(); // Собираю не заполненные поля

	if(trim($data1['contact_city']) == ''){
		$errors1[] = 'Вы не указали город доставки';
	}

	if(trim($data1['contact_street']) == ''){
		$errors1[] = 'Вы не указали улицу';
	}

	if(trim($data1['contact_hause']) == ''){
		$errors1[] = 'Вы не указали дом';
	}

	if(trim($data1['contact_apartment']) == ''){
		$errors1[] = 'Вы не указали квартиру';
	}


if( !empty($errors1) ){

		if(isset($_POST['contact_city'])){$_SESSION['contact_city'] = $_POST['contact_city'];}
		if(isset($_POST['contact_street'])){$_SESSION['contact_street'] = $_POST['contact_street'];}
		if(isset($_POST['contact_hause'])){$_SESSION['contact_hause'] = $_POST['contact_hause'];}
		if(isset($_POST['contact_apartment'])){$_SESSION['contact_apartment'] = $_POST['contact_apartment'];}
		if(isset($_POST['order_comment'])){$_SESSION['order_comment'] = $_POST['order_comment'];}
		$_SESSION['$errors1'] = $errors1;
		header("Location: checkout_2.php");
	} else if (empty($errors1)){

		$_SESSION['contact_city'] = $_POST['contact_city'];
		$_SESSION['contact_street'] = $_POST['contact_street'];
		$_SESSION['contact_hause'] = $_POST['contact_hause'];
		$_SESSION['contact_apartment'] = $_POST['contact_apartment'];
		$_SESSION['order_comment'] = $_POST['order_comment'];
								// Метод доставки
		if( isset($_POST['delivery1']) ){$_POST['method_D']='Курьерская доставка';}
		if(!isset($_POST['delivery1']) && !isset($_POST['delivery2']) && !isset($_POST['delivery3']) ){$_POST['method_D']='Курьерская доставка';}
		if( isset($_POST['delivery2']) ){$_POST['method_D']='Почта России';}
		if( isset($_POST['delivery3']) ){$_POST['method_D']='QIWI Post';}
		$_SESSION['delivery_method'] = $_POST['method_D'];
}
}


?>
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta charset="UTF-8">
		<title>ОФОРМЛЕНИЕ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/checkOut_3Style.css">
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
			<div class="contactInfo">
				<a href="checkout.php">
					<div>
						1.&nbsp;<span>Контактная информация</span>
					</div>
				</a>
			</div>
			<div class="delevery">
				<a href="checkout_2.php">
					<div>
						2.&nbsp;<span>Информация о доставке</span>
					</div>
				</a>
			</div>
			<div class="confirmation">
				<div>
					3.&nbsp;<span>Подтверждение заказа</span>
				</div>
			</div>

<div id="left">
	<div class="topic1">Состав заказа</div><br>
</div>
			<!--*******************Таблица**********************-->
<div id="infoCart">
	<table>
		<tr>
			<th>Товар</th>
			<th>Стоимость</th>
			<th>Количество</th>
			<th>Итого</th>
		</tr>
<?php
foreach($_SESSION['arr_cart'] as $key => $value){

	echo '<tr>
			<td class="twoColumn">'.$value['product_name'].'</td>
			<td class="fourColumn">' . $value['price'] . '<span>руб.</span></td>
			<td class="fiveColumn">' . $value['qty'] . '</td>
			<td class="sixColumn">' . $value['price_res'] . '<span>руб.</span></td>
		  </tr>';

}
?>

	</table>
	<div id="totalBuy">
		<div>
			<span id="inTotal">Итого:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="sum"><?php if(isset($_SESSION['pin'])){echo $_SESSION['pin'];}else{echo 0;} ?> руб.</span>
		</div>
	</div>
</div>


<div id="leftBottom">
	<div class="topic1">Доставка</div><br>
	<div class="leftBlock">Контактное лицо (ФИО):<br><span name="FIO"><?php if( isset($_SESSION['contact_fio']) ){echo $_SESSION['contact_fio'];} ?></span></div><br>
	<div class="leftBlock">Контактный телефон:<br><span name="tel"><?php if( isset($_SESSION['contact_telefone']) ){echo $_SESSION['contact_telefone'];} ?></span></div><br>
	<div class="leftBlock">E-mail:<br> <span name="email"><?php if( isset($_SESSION['contact_email']) ){echo $_SESSION['contact_email'];} ?></span></div><br>
</div>


<div id="middleBottom">
	<div class="leftBlock">Город:<br> <span name="city"><?php if( isset($_SESSION['contact_city']) ){echo $_SESSION['contact_city'];} ?></span></div><br>
	<div class="leftBlock">Улица:<br> <span name="street"><?php if( isset($_SESSION['contact_street']) ){echo $_SESSION['contact_street'];} ?></span></div><br>
	<span class="short">Дом:<br><span><?php if( isset($_SESSION['contact_hause']) ){echo $_SESSION['contact_hause'];} ?></span></span>
	<span class="short1">Квартира:<br><span><?php if( isset($_SESSION['contact_apartment']) ){echo $_SESSION['contact_apartment'];} ?></span></span><br><br>
</div>


<div id="rightBottom">
	<div class="leftBlock">Способ доставки:<br><span name="deliveryMethod"><?php if( isset($_SESSION['delivery_method']) ){echo $_SESSION['delivery_method'];} ?></span></div><br>
	<div class="leftBlock">Комментарий к заказу:<br><span name="CommentToTheOrder"><?php if( isset($_SESSION['order_comment']) ){echo $_SESSION['order_comment'];} ?></span></div><br>
</div>
<form action="checkout_4.php" method="POST">
	<!--a href="checkout_4.php"--><input class="proceed" type="submit" name="confirm_order" value="Подтвердить заказ"><!--/a-->
</form>
</div>
</section>

<?php include 'php/foot.php'?>
