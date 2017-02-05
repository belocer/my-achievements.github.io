<?php
require_once 'php/require.php';

//echo "<pre>";
//print_r($_SESSION['arr_cart']);
//echo "</pre>";
if($_SESSION['online'] === 1){
	$_SESSION['contact_fio'] 		= $_SESSION['fio'];
	$_SESSION['contact_email'] 		= $_SESSION['email'];
	$_SESSION['contact_telefone']	= $_SESSION['telefone'];						
	$_SESSION['contact_city'] 		= $_SESSION['city'];
	$_SESSION['contact_street'] 	= $_SESSION['street'];
	$_SESSION['contact_hause'] 		= $_SESSION['hause'];
	$_SESSION['contact_apartment'] 	= $_SESSION['apartment'];
}

	//Если нажата кнопка ВОЙТИ
if(isset($_POST['comeIn'])){
				
	$email = $_POST['email'];
	$password = $_POST['password'];

//Очистка от пробелов, удаление символов, удаление HTML и PHP тегов, преобразуем спецсимволы в HTML сущности
function clean($value = ''){
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
	
	return $value;
}

$_SESSION['email'] = clean($email);
$_SESSION['password'] = clean($password);

	//Проверяю есть ли значения в нутри переменных(заполнены ли инпуты)
if(	(strlen($_SESSION['email'])<3) || (strlen($_SESSION['password'])<3)	)
{ 
	$_POST['error'] = 'Заполните поля email адресс и пароль';
	header('Location: ..//checkout.php'); 
	exit;
}
else
{
	
	//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	


	//Создание и выполнение запроса на поиск данных в БД
$email = $_SESSION['email'];
$password = $_SESSION['password'];	

	//Поиск записей в БД и сравнение их с введенными данными
	
$select = "SELECT * FROM dbelotserkovets_users WHERE email = '$email'"; //Беру всё из таблицы users где email = введенному email
$result_select = pg_query($dbconn, $select) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_array($result_select); //Массив с нужной строкой из БД	
							
				if(!empty($array_bd)){
					$_POST['resemail'] = "Логин верно";
					
							//Поиск записей в БД и сравнение их с введенными данными
						if($array_bd['password'] == $password){
							$_POST['respas'] = "Пароль верно";
							$_SESSION['online']		= 1;
							$_SESSION['idman'] 		= $array_bd['id'];
							$_SESSION['fio'] 		= $array_bd['fio'];
							$_SESSION['email'] 		= $array_bd['email'];
							$_SESSION['telefone'] 	= $array_bd['telefone'];
							$_SESSION['city'] 		= $array_bd['city'];
							$_SESSION['street'] 	= $array_bd['street'];
							$_SESSION['hause'] 		= $array_bd['hause'];
							$_SESSION['apartment'] 	= $array_bd['apartment'];
							
// Запись в БД таблица transaction
$users_id = $array_bd['id'];
$_SESSION['users_id'] = $array_bd['id']; // сохраняю id для выхода
$log_in = 1;
$insert = "INSERT INTO dbelotserkovets_transaction(users_id, log_in, date_time) VALUES ('$users_id', '$log_in', NOW());";
pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());
							
							header('Location: checkout.php'); 
							exit;
						}else{
							$_POST['respas'] = "<span style='color: red'>*Пароль НЕ верно</span>";	
						}
				}else{
					$_POST['resemail'] = "<span style='color: red'>*email НЕ верно</span>";
				}			
		}
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>ОФОРМЛЕНИЕ</title>
	<script href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<link rel="stylesheet" href="CSS/checkOutStyle.css">
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
			<div>
				1.&nbsp;<span>Контактная информация</span>
			</div>
		</div>
		<div id="left">
			<form action="checkout_2.php" method="POST">
				<div class="topic1">Для новых покупателей</div><br>
				<div class="leftBlock">Контактное лицо (ФИО):<br><input type="text" name="contact_fio" value="<?php echo @$_SESSION['contact_fio']; ?>" required autofocus></div><br>
				<div class="leftBlock">Контактный телефон:<br><input type="tel" name="contact_telefone" value="<?php echo @$_SESSION['contact_telefone']; ?>" required></div><br>
				<div class="leftBlock">E-mail:<br><input type="email" name="contact_email" value="<?php echo @$_SESSION['contact_email']; ?>" required></div><br>
				<a href="checkout_2.php"><input class="proceed" name="button" type="submit" value="Продолжить"></a>
				<?php
				if(isset($_SESSION['$errors'])){ echo '<div style="color: #C61208;">*'. array_shift($_SESSION['$errors']) .'</div>'; }
				?>
			</form>
		</div>
		<form action="#" method="POST">
<?php
if($_SESSION['online'] === 0){
	echo '<div id="right">
			<div class="topic1">Быстрый вход</div><br>';
				
if(isset($_POST['resemail'])){ echo $_POST['resemail']; }
if(isset($_POST['respas'])){ echo $_POST['respas']; }
	echo   '<div class="leftBlock">Ваш e-mail:<br><input type="email" name="email" required placeholder="mail@company.ru"></div><br>
			<div class="leftBlock">Пароль:<br><input type="password" name="password" required></div><br>
			<input class="comeIn" name="comeIn" type="submit" value="Войти">
			<button name="forgotYourPassword" href="#" id="forgotYourPassword">Восстановить пароль</button>
		</div>';
}
?>	
</form>
	<div class="delevery otstup">
		<a href="#">
			<div>
				2.&nbsp;<span>Информация о доставке</span>
			</div>
		</a>
	</div>		
	<div class="confirmation">
		<a href="#">
			<div>
				3.&nbsp;<span>Подтверждение заказа</span>
			</div>
		</a>
	</div>		
	</div>	
</section>
<?php include 'php/foot.php'?>
