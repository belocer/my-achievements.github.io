<?php session_start (); 
if($_SESSION['auth']!==1)
{	
	header('Location: index1.php');
	exit;
}

$i	= "infoUser.csv";
	
if($login == " "){$login=null;}		
if($pass1 == " "){$pass1=null;}	
if($pass2 == " "){$pass2=null;}	
if($email == " "){$email=null;}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Админ</title>
	<!-- Bootstrap -->
	<link href="CSS/cerulean.css" rel="stylesheet">
	<link href="CSS/style.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
			<header role="banner" class="navbar navbar-fixed-top navbar-inverse" id="navHead">
				<div class="container">
					<div class="navbar-header">
						<button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					</div>
					<div class="navbar-inverse side-collapse in">
						<nav role="navigation" class="navbar-collapse">
							<ul class="nav navbar-nav">
								<li><a href="http://tbkrussia.ru/" target="_blank">ГЛАВНАЯ TBK</a></li>
								<li><a href="http://y9283007.bget.ru/home.php" target="_blank">ОТВЕТЫ `TBK`</a></li>
								<li><a href="http://y9283007.bget.ru/indexadmin.php">ДОБАВИТЬ ОТВЕТЫ</a></li>
								<li><a href="http://y9283007.bget.ru/indexadmin.php#ans">ВОПРОСЫ</a></li>
								<li><a href="http://y9283007.bget.ru/indexadmin.php#reg">РЕГИСТРАЦИЯ</a></li>
								<li><a href="http://y9283007.bget.ru/write.php">ПОСМОТРЕТЬ СПИСОК</a></li>
							</ul>							
						</nav>
					</div>
				</div>
			</header>
		</div>
		<br>
		<br>
		<br>
<div class="container">		
	<h1 id="head_write">Зарегистрированные пользователи:</h1>
	<div id="bottom1"> 

<?php
	 if( isset($_SESSION["login"]) && isset($_SESSION["pass1"]) && isset($_SESSION["pass2"]) && isset($_SESSION["email"]) ){
	 $myArrDanger = array();
	 
									//Массив с данными
	$myarr=array($_SESSION["login"], $_SESSION["pass1"], $_SESSION["pass2"], $_SESSION["email"]);
		//unset($_SESSION);
		unset($_POST);
		unset($_GET);
									//Создаём дозаписываемые файлы
	$x = fopen("infoUser.csv","a+");
	$filename = 'infoUser.csv';

									//Существует ли файл?
	if (file_exists($filename)) {
		//echo "<br><h4 style='color: green;'>infoUser.csv создан!</h4>";
	} else {
		echo "<br>Файл 'infoUser.csv' не создан!<br>";
	}	

	if($x===false){
		echo "<h1 style='color: red;'>Файл не создан</h1>";
		}

				//Существует ли и доступен для записи файл
	if(is_writable("infoUser.csv")){
		//echo '<br><h4 style="color: green;">infoUser.csv Доступен для записи!</h4>';
	}else{
		echo '<br>infoUser.csv <h1 style="color: red;">НЕ Доступен для записи!</h1>';
	}

									//Записываем данные из массива в файл
			fputcsv($x,$myarr);									
									
	 }
	 //Выводим в браузер данные из файла
	$infor = file($i);
		if($infor===false)
		{
			echo "Не могу прочитать из файла";
		}
		
	$a = 1;
	for($n = 0; ($infor[$n]); $n++)
	{
		echo $a . " - " . $infor[$n] . "<br>";
		$a++;
	}
	fclose($x);
		unset($_SESSION);
		unset($_POST);
		unset($_GET);	
		session_unset ();
		session_destroy ();
	?>	

	</div> 
</div>
<br>
<br>
<br>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/ajax.js"></script>
	</body>
</html>
