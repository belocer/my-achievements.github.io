<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Вход</title>
	<link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/style_login.css">
	<!--link rel="stylesheet" href="CSS/jquery.formstyler.css"-->
</head>
<body>
<div id="logged">
<br><br><br>
	<div id="bender">
		<form action="logged.php" method="POST">
				<?php echo "<h3 style='color: #BE3F70'>" . $_SESSION['Danger'] . "</h3><br>";?>
			<h4 class="head">Введите логин и пароль для закрытого раздела</h4>	
			<input class="styler" type="text" placeholder="Логин" name="logg" title="Введите логин зарегистрированного пользователя" required><br>
			<input class="styler" type="password" placeholder="Пароль" name="pass" title="Введите пароль зарегистрированного пользователя" required><br><br>
			<input class="styler" type="submit" value="ВХОД" name="logged">
			<h2>
				<a href="http://tbkrussia.ru/">Вернуться на tbkrussia.ru</a>
			</h2>
		</form><br>
	</div>	
</div>
</body>
</html>