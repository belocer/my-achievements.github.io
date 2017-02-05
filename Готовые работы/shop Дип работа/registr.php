<?php
require_once 'php/require.php';
?>
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta charset="UTF-8">
		<title>РЕГИСТРАЦИЯ</title>
		<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<link rel="stylesheet" href="CSS/registrStyle.css">
		<link rel="stylesheet" href="CSS/fonts.css">
	</head>
<body>
<?php require_once 'php/header.php'; ?>

<!--****************************Центральный блок***************************************-->
<section>
<div class="topic">РЕГИСТРАЦИЯ</div>
	<div id="section">
	
	<form action="php/registrpg.php" method="POST">
				<div id="leftBlock">
					<span>Контактное лицо (ФИО):</span><br>
					<?php
					if(isset($_SESSION['fio'])<5){
						echo '<input type="text" name="fio" style="color: #949698" placeholder="Не заполнено" autofocus autocomplete="off" autocapitalize="words"><br><br>';
						}else{
						echo '<input type="text" name="fio" value="'. $_SESSION['fio'] .'" autocapitalize="words"><br><br>';	
						}
					?>
					<span>E-mail адрес:</span><br>
					<?php
					if(isset($_SESSION['email'])<5){
						echo '<input type="email" name="email" style="color: #949698" placeholder="Не заполнено" autofocus autocomplete="off"><br>';
						}else{
						echo '<input type="email" name="email" value="'. $_SESSION['email'] .'"><br>';	
						}
					?>
				</div>
				<div id="rightBlock">
					<span>Пароль:</span><span id="res"></span><br>
<script>
function pass_Auth(){
		if(	document.getElementById('pass_1').value !== document.getElementById('pass_2').value	){
				document.getElementById('res').innerHTML = "<style> #registr{ display: none; } </style><span style='color: red;'> Пароли не совпадают! </span>";
			}else{
				
				document.getElementById('res').innerHTML = "<span style='color: green;'> Пароли совпали! </span>";
			}
}
</script>
					<?php
					if(isset($_SESSION['password'])<5){
						echo '<input id="pass_1" type="password" name="password" required><br><br>';
						}else{
						echo '<input id="pass_1" type="password" name="password" value="'. $_SESSION['password'] .'"><br><br>';	
						}
					?>
					<span>Повторите пароль:</span><br>
					<?php
					if(isset($_SESSION['passwordtwo'])<5){
						echo '<input id="pass_2" onKeyUp="pass_Auth();" type="password" name="passwordtwo" required><br>';
						}else{
						echo '<input id="pass_2" onKeyUp="pass_Auth();" type="password" name="passwordtwo" value="'. $_SESSION['passwordtwo'] .'"><br>';	
						}
					?>
				</div>
	
	
	<button id="registr" href="index.html" name="button">Зарегистрироваться</button>	
	</form>
	<?php
	if(isset($_SESSION['error'])){
	echo $_SESSION['error'];
	}
	?>
	</div>
</section>

<?php include 'php/foot.php'?>
