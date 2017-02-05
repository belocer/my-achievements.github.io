<?php
require_once 'php/require.php';

if( isset($_POST['button']) ){
	$data = $_POST;
	$errors = array(); // Собираю не заполненные поля
	
	if(trim($data['contact_fio']) == '')
	{
		$errors[] = 'Вы не указали свое Ф.И.О.';	
	}
	if(trim($data['contact_telefone']) == '')
	{
		$errors[] = 'Вы не указали телефон для связи';	
	}
	if(trim($data['contact_email']) == '')
	{
		$errors[] = 'Вы не указали свой email';	
	}

if( empty($errors) ){	

								/////////Формирую ЗАКАЗ
		$_SESSION['contact_fio'] = $_POST['contact_fio'];
		$_SESSION['contact_telefone'] = $_POST['contact_telefone'];
		$_SESSION['contact_email'] = $_POST['contact_email'];

		//echo "<pre> POST:";
		//print_r($_POST);
		//echo "</pre>";
		unset($_POST);
		unset($data);
	} else {
		if(isset($_POST['contact_fio'])){$_SESSION['contact_fio'] = $_POST['contact_fio'];}
		if(isset($_POST['contact_telefone'])){$_SESSION['contact_telefone'] = $_POST['contact_telefone'];}
		if(isset($_POST['contact_email'])){$_SESSION['contact_email'] = $_POST['contact_email'];}
		$_SESSION['$errors'] = $errors;
		header("Location: checkout.php");
	}
}

?>
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta charset="UTF-8">
		<title>ОФОРМЛЕНИЕ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/checkOut_2Style.css">
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
		<form action="checkout_3.php" method="POST">
			<div class="contactInfo">
				<a href="checkout.php">
					<div>
						1.&nbsp;<span>Контактная информация</span>
					</div>
				</a>
			</div>
			<div class="delevery">
				<div>
					2.&nbsp;<span>Информация о доставке</span>
				</div>
			</div>
			
			<div id="left">
				<div class="topic1">Адрес доставки</div><br>
				<div class="leftBlock">Город:	<br><input type="text" name="contact_city" placeholder="Москва" value="<?php echo @$_SESSION['contact_city']; ?>" required autofocus></div><br>
				<div class="leftBlock">Улица:	<br><input type="text" name="contact_street" value="<?php echo @$_SESSION['contact_street']; ?>" required></div><br>
				<span class="short">   Дом:		<br><input type="text" name="contact_hause" value="<?php echo @$_SESSION['contact_hause']; ?>" required></span>
				<span class="short1">  Квартира:<br><input type="text" name="contact_apartment" value="<?php echo @$_SESSION['contact_apartment']; ?>" required></span><br><br>
				<a href="checkout_3.php"><input class="proceed" type="submit" name="but_checkout_2" value="Продолжить"></a>
				<?php
				if(isset($_SESSION['$errors1'])){ echo '<div style="color: #C61208;">*'. array_shift($_SESSION['$errors1']) .'</div>'; }
				?>
			</div>
			
			<div id="middle">
				<div class="topic1">Способ доставки</div><br>
				
				<label>
				<span class="active_check"	id="check_1" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery1"><span class="middleBlock">&nbsp;&nbsp;Курьерская доставка<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;с оплатой при получении</span><br><br>
				</label>
				
				<label>
				<span class="passive_check" id="check_2" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery2"><span class="middleBlock">&nbsp;&nbsp;Почта России<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;с наложенным платежом</span><br><br>
				</label>
				
				<label>
				<span class="passive_check"  id="check_3" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="delivery3"><span class="middleBlock">&nbsp;&nbsp;Доставка через терминалы<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QIWI Post</span>
				</label>				
			</div>		
			
			<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
			
			<style>
				.qwe{
					display: none;
				}
				
				.active_check{
					background-image: url(image/active.png);
					width: 15px; 
					height: 15px;
					display: inline-block;
				}
				.passive_check{
					background-image: url(image/passive.png);
					width: 15px; 
					height: 15px;
					display: inline-block;
				}
			</style>
			<script>
				function rev_elem(event){
					event = event || window.event; //объект события во всех браузерах
					var x = event.currentTarget.getAttribute('class');
							if(x == 'passive_check'){
								document.getElementById('check_1').setAttribute('class', 'passive_check');
								document.getElementById('check_2').setAttribute('class', 'passive_check');
								document.getElementById('check_3').setAttribute('class', 'passive_check');
							event.currentTarget.setAttribute('class', 'active_check');
								}else{
							event.currentTarget.setAttribute('class', 'passive_check');
							}
				}
			</script>
						
			<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
			
			
			<div id="rightB">
				<div class="topic1">Коментарий к заказу</div>
				<span class="leftBlock">Введите Ваш комментарий:</span><br>
				<textarea name="order_comment"><?php if(isset($_SESSION['contact_apartment'])){echo $_SESSION['contact_apartment'];}else{ echo "Текст комментария"; } ?></textarea>			
			</div>
			
	<div class="confirmation">
		<a href="checkout_3.php">
			<div>
				3.&nbsp;<span>Подтверждение заказа</span>
			</div>
		</a>
	</div>
		</form>
	</div>
	
</section>

<?php include 'php/foot.php'?>
