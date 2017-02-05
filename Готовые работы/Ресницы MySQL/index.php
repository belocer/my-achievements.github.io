<?php
session_start ();
header("Content-type: text/html; charset=utf-8");

		/*Подключение к серверу MySQL*/
		$db = @mysqli_connect('127.0.0.1', 'root', '', 'bg') or die('Ошибка соединения с сервером!');	
			/*Установка кодировки соединения*/
		mysqli_set_charset($db, 'utf8') or die('Не уставновлена кодировка соединения!');


//РЕШЕНИЕ ПРОБЛЕМЫ F5
if(!empty($_POST)){
	if(isset($_POST['go'])){
	

			/*Создаю переменные*/
		$name = $_POST['name'];
		$text = $_POST['coment'];
														/*Безопасность по XSS*/
													$name = nl2br(htmlspecialchars($name));	
													$text = nl2br(htmlspecialchars($text));	
		
														/*Безопасность по SQL-запросам*/
													$name = mysqli_real_escape_string($db, $name);
													$text =	mysqli_real_escape_string($db, $text);
			/*Запись данных в БД*/
			/*Создаю запрос*/
		$insert = "INSERT INTO gb (name, text) VALUES ('$name', '$text')";
			/*Выполнение запроса*/
		$res_insert = mysqli_query($db, $insert);	
		}
	
	header("Location: {$_SERVER['PHP_SELF']}");
	exit;
}
date_default_timezone_set('Europe/Moscow');
?>
	<!DOCTYPE html>
	<html lang="ru">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ресницы</title>

		<!-- Bootstrap -->
		<link href="css/cerulean.css" rel="stylesheet">
		<link href="media/style.css" rel="stylesheet">

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
								<li><a href="#top">ГЛАВНАЯ</a></li>
								<li><a href="#works">РАБОТЫ</a></li>
								<li><a href="#info">ИНФОРМАЦИЯ</a></li>
								<li><a href="#contact">КОНТАКТЫ</a></li>
								<li><a href="#comment">КОММЕНТАРИИ</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="#">НИНА&nbsp;&nbsp;&nbsp; &#9742;&#65039;&nbsp;8-966-770-86-20 </a></li>

							</ul>
						</nav>
					</div>
				</div>
			</header>
		</div>

		<!--**********&#1050;&#1040;&#1056;&#1059;&#1057;&#1045;&#1051;&#1068;***********-->
		<div id="carusel">
			<a name="top"></a>
			<div id="carousel-example-generic" class="carousel slide affix-top" data-ride="carousel" data-slide-to="-2">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					<li data-target="#carousel-example-generic" data-slide-to="4"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="image/1f.png" alt="img">
						<div class="carousel-caption">
							<h2>Наращивание ресниц, классика, объём!</h2>
						</div>
					</div>
					<div class="item">
						<img src="image/2f.png" alt="img">
						<div class="carousel-caption">
							<h2>Наращивание ресниц, классика, объём!</h2>
						</div>
					</div>
					<div class="item">
						<img src="image/3f.png" alt="img">
						<div class="carousel-caption">
							<h2>Наращивание ресниц, классика, объём!</h2>
						</div>
					</div>
					<div class="item">
						<img src="image/4f.png" alt="img">
						<div class="carousel-caption">
							<h2>Наращивание ресниц, классика, объём!</h2>
						</div>
					</div>
					<div class="item">
						<img src="image/5f.png" alt="img">
						<div class="carousel-caption">
							<h2>Наращивание ресниц, классика, объём!</h2>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>



		<div class="container" id="content">
			<a name="info"></a>
			<div class="row featurette">
				<div class="col-md-7">
					<h2 class="featurette-heading">Памятка по уходу за ресницами.<br><span class="text-muted">Следуя этим простым правилам, Вы продлите срок носки искуственных ресниц и не навредите своим.</span></h2>
					<p class="lead"><span style="color: green;">*</span>В течениt первых 24 часов после наращивания избегайте контакта с водой.</p>
					<p class="lead"><span style="color: green;">*</span>Не подвергайте ресницы лишнему механическому воздействию, не трите глаза.</p>
					<p class="lead"><span style="color: green;">*</span>Избегайте попадания на ресницы средств на масляной основе.</p>
					<p class="lead"><span style="color: green;">*</span>Не стоит красить нарощенные ресницы тушью</p>
					<p class="lead"><span style="color: green;">*</span>Снимайте ресницы только профессиональными средствами у мастера.</p>
					<p class="lead"><span style="color: green;">*</span>Ухаживайте за ресницами с помощью специальной щеточки.</p>
				</div>
				<div class="col-md-5">
					<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="image/6f.png">
				</div>
			</div>
			<hr class="featurette-divider">
			<div class="row featurette">
				<div class="col-md-5">
					<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="http://sweet59.ru/image/cache/data/sertifikati/resnici-500x500.jpg">
				</div>
				<div class="col-md-7">
					<h2 class="featurette-heading">На заметку!</h2>
					<p class="lead">Максимальная масса искуственной ресницы рассчитывается исходя из длины (3-12 мм) и толщины (0,05-0,11 мм) родной ресницы.
						<br> Искусственная ресница не более чем в 2 раза длиннее натуральной.
						<br> Это делает наращивание абсолютно безопасным для родных ресниц, как бы долго Вы их ни наращивали!</p>
				</div>
			</div>
			<hr class="featurette-divider">
			<div class="row featurette">
				<div class="col-md-7">
					<h2 class="featurette-heading">Помните: нарощенные ресницы не боятся воды!<br><span class="text-muted">Поэтому не избегайте процедуры умывания</span></h2>
					<p class="lead">Для умывания лица используйте мягкие средства. От мыла лучше отказаться. Моющее средство не должно попадать в глаза!</p>
					<p class="lead">Следите за качеством воды, которой умываетесь. Хлорированная вода уменьшает срок жизни Вашего наращивания! Как и средства для снятия стойкого макияжа.</p>
					<p class="lead">Влажные ресницы следует расчесать специальной щеточкой. Тереть полотенцем их не нужно. Лучше слегка промокните их бумажными салфетками.</p>
					<p class="lead">Не бойтесь совершать Ваши ежедневные гигиенические процедуры!</p>

				</div>
				<div class="col-md-5">
					<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="http://img0.liveinternet.ru/images/attach/d/0/129/726/129726194_3416556_13245305_783246145110366_754900888973391825_n.jpg">
				</div>
			</div>
			<a name="works"></a>
			<hr class="featurette-divider">
			<br>
			<br>

			<!--WORKS-->
			<div class="container" id="foto">
				<a name="works"></a>
				<div onMouseOver="document.getElementById('dDiv').innerHTML=this.innerHTML" onMouseOut="document.getElementById('dDiv').innerHTML=''">
					<img src="image/1f.png" class="img-rounded imgSize" alt="Responsive image">
				</div>
				<div onMouseOver="document.getElementById('dDiv').innerHTML=this.innerHTML" onMouseOut="document.getElementById('dDiv').innerHTML=''">
					<img src="image/2f.png" class="img-rounded imgSize" alt="Responsive image">
				</div>
				<div onMouseOver="document.getElementById('dDiv').innerHTML=this.innerHTML" onMouseOut="document.getElementById('dDiv').innerHTML=''">
					<img src="image/3f.png" class="img-rounded imgSize" alt="Responsive image">
				</div>
				<div onMouseOver="document.getElementById('dDiv').innerHTML=this.innerHTML" onMouseOut="document.getElementById('dDiv').innerHTML=''">
					<img src="image/4f.png" class="img-rounded imgSize" alt="Responsive image">
				</div>
				<div onMouseOver="document.getElementById('dDiv').innerHTML=this.innerHTML" onMouseOut="document.getElementById('dDiv').innerHTML=''">
					<img src="image/5f.png" class="img-rounded imgSize" alt="Responsive image">
				</div>
			</div>
			<div class="container">
				<div id="dDiv">

				</div>
			</div>
			<br>
			<a name="contact"></a>
			<hr class="featurette-divider">
			<br>
			<br>
			<br>

			<div id="content1" class="container">

				<hr class="featurette-divider">
				<h3>Мои контакты</h3>
				<p>телефон: +7-966-770-86-20 </p>
				<hr class="featurette-divider">
			</div>
			<hr class="featurette-divider">
			<br>
			<br>
		</div>
		<form action="index.php" method="POST">

			<div class="container">
				<h2>Комментарии</h2>
				<a name="comment"></a>
				<div class="form-group col-xs-4">
					<label class="sr-only" for="exampleInputEmail2">Имя</label>
					<input type="text" class="form-control" placeholder="&#1048;&#1084;&#1103;" name="name">
				</div>
				<textarea class="form-control" rows="3" placeholder="Текст комментария" name="coment"></textarea>
				<br>
				<button type="submit" class="btn btn-primary" name="go">Отправить</button>
			</div>

		</form>

		<br>
		<hr class="featurette-divider">
		<br>
		<div class="container">

			<?php
//$i="coment.csv";
//$x='';	   
//
//
//
////Поиск и замена переносов на пробелы)))
//$_POST["coment"] = preg_replace("/\r\n|\n/", ' ', $_POST["coment"]);
//$_POST["coment"] = preg_replace("/</", ' ', $_POST["coment"]);
//$_POST["coment"] = preg_replace("/>/", ' ', $_POST["coment"]);
//$_POST["coment"] = preg_replace('/",/', ' ', $_POST["coment"]);
//$_POST["coment"] = $_POST["coment"] . "|||";
//$_POST["name"] = preg_replace("/\r\n|\n/", ' ', $_POST["name"]);
//$_POST["name"] = preg_replace("/</", ' ', $_POST["name"]);
//$_POST["name"] = preg_replace("/>/", ' ', $_POST["name"]);
//$_POST["name"] = trim($_POST["name"]);
//$_POST["coment"] = trim($_POST["coment"]);
//
//$date = date('d-m-Y H:i:s');
//$date = $date . "|||";
//
// 
//								//Массив с данными
//$myarr = array( $date, $_POST["coment"], $_POST["name"] );
////$myarr = array_reverse( $myarr );
//
//								//&#1057;&#1086;&#1079;&#1076;&#1072;&#1105;&#1084; &#1076;&#1086;&#1079;&#1072;&#1087;&#1080;&#1089;&#1099;&#1074;&#1072;&#1077;&#1084;&#1099;&#1077; &#1092;&#1072;&#1081;&#1083;&#1099;
//$x = fopen("coment.csv","a+");
//
//$filename = 'coment.csv';
//
//								//&#1057;&#1091;&#1097;&#1077;&#1089;&#1090;&#1074;&#1091;&#1077;&#1090; &#1083;&#1080; &#1092;&#1072;&#1081;&#1083;?
//if (file_exists($filename)) {
//	//echo "<br><h4 style='color: green;'>coment.csv создан!</h4>";
//} else {
//    echo "<br>&#1060;&#1072;&#1081;&#1083; 'coment.csv' &#1085;&#1077; &#1089;&#1086;&#1079;&#1076;&#1072;&#1085;!<br>";
//}	
//
//if($x===false){
//	echo "<h1 style='color: red;'>&#1060;&#1072;&#1081;&#1083; &#1085;&#1077; &#1089;&#1086;&#1079;&#1076;&#1072;&#1085;</h1>";
//	}
//
//								//&#1057;&#1091;&#1097;&#1077;&#1089;&#1090;&#1074;&#1091;&#1077;&#1090; &#1083;&#1080; &#1080; &#1076;&#1086;&#1089;&#1090;&#1091;&#1087;&#1077;&#1085; &#1076;&#1083;&#1103; &#1079;&#1072;&#1087;&#1080;&#1089;&#1080; &#1092;&#1072;&#1081;&#1083;
//if(is_writable("coment.csv")){
//	//echo '<br><h4 style="color: green;">coment.csv &#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1077;&#1085; &#1076;&#1083;&#1103; &#1079;&#1072;&#1087;&#1080;&#1089;&#1080;!</h4>';
//}else{
//	echo '<br>coment.csv <h1 style="color: red;">&#1053;&#1045; &#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1077;&#1085; &#1076;&#1083;&#1103; &#1079;&#1072;&#1087;&#1080;&#1089;&#1080;!</h1>';
//}
//
//
//if((strlen($_POST['name'])>3) && (strlen($_POST['coment'])>3)){	
//								//&#1047;&#1072;&#1087;&#1080;&#1089;&#1099;&#1074;&#1072;&#1077;&#1084; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1080;&#1079; &#1084;&#1072;&#1089;&#1089;&#1080;&#1074;&#1072; &#1074; &#1092;&#1072;&#1081;&#1083;
//fputcsv($x,$myarr);
//
//	}								
//								//&#1042;&#1099;&#1074;&#1086;&#1076;&#1080;&#1084; &#1074; &#1073;&#1088;&#1072;&#1091;&#1079;&#1077;&#1088; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1080;&#1079; &#1092;&#1072;&#1081;&#1083;&#1072;
//	 $infor = file($i);
//	if($infor===false)
//	{
//		echo "&#1053;&#1077; &#1084;&#1086;&#1075;&#1091; &#1087;&#1088;&#1086;&#1095;&#1080;&#1090;&#1072;&#1090;&#1100; &#1080;&#1079; &#1092;&#1072;&#1081;&#1083;&#1072;";
//	}
//	
//for($n = 0; ($infor["$n"]); $n++)
//{
//	$data = explode('|||', $infor["$n"]);
//	$dates = array_shift($data);
//	$comment = current($data);
//	$name = array_pop($data);
//	$name = preg_replace('/"/', ' ', $name);
//	$name = preg_replace('/,/', ' ', $name);
//	$dates = preg_replace('/"/', ' ', $dates);
//	$comment = preg_replace('/",/', ' ', $comment);
//	
//	echo '<span>' . $name .'</span>' .'<div class=jumbotron>' . '<p>' . $comment . '"' .'</p>' . '<br>' . '<span style="float: right; color: #9D9D9D;">' . $dates . '</span>' . '</div>';
//}
//	
//fclose($x);
//
//if(isset($_POST['go']))
//{	
//	unset($_POST['name']);	
//	unset($_POST['coment']);
//	unset($_SESSION);
//	session_unset ();
//	session_destroy();
//}	   
//	unset($_POST['name']);	
//	unset($_POST['coment']);
//	unset($_SESSION);
//	session_unset();
?>
	
<?php

/*Выборка name text date*/
$res = mysqli_query($db, 'SELECT name, text, date FROM gb ORDER BY id DESC');
$data = mysqli_fetch_all($res, MYSQLI_ASSOC);			
			
			
foreach ($data as $item){
	echo "<span>{$item['name']}</span><div class=jumbotron><p>{$item['text']}</p><br><span style='float: right; color: #9D9D9D;'>{$item['date']}</span></div>";
}
			
?>	
		</div>
		<!--hr class="featurette-divider" style="width: 80%;"-->
		<footer>
			<address>
				<span id="lll">&reg;"Lashmeyker_krd"</span>	
				<span id="ccc">&#9742;&#65039; 8-966-770-86-20</span> 
				<span id="rrr">2016 год</span>
			</address>
		</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/nav.js"></script>
	</body>
</html>