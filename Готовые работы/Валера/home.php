<?php
session_start ();
if($_SESSION['auth']!==1)
{	
	header('Location: index1.php');
	exit;
}

header("Content-type: text/html; charset=utf-8");
/*Подключение к серверу MySQL*/
		$db = @mysqli_connect('localhost', 'y9283007_base', 'titova2007', 'y9283007_base') or die('Ошибка соединения с сервером!');	
			/*Установка кодировки соединения*/
		mysqli_set_charset($db, 'utf8') or die('Не уставновлена кодировка соединения!');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ответы TBK</title>
	<!-- Bootstrap -->
	<link href="CSS/cerulean.css" rel="stylesheet">
	<link href="CSS/style_tbk.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="wrapper">
			<div id="content">
				<div id="searcharea">
					<label for="search">Часто задаваемые вопросы</label><br>
					<input type="search" class="form-control" name="search" id="search" placeholder="Ваш вопрос...?">
				</div>
			<div id="update"></div>
			</div>
			
				<div id="cent">
				<?php		
				if( !empty($errors)){
			echo "<div style='color: red;'>". array_shift($errors) ."</div><hr>";
				}else if (isset($good)){
			echo $good;
				}
				?> 
					<h2 class="comm">Комментарии</h2>
				<ol>
					<li>Впишите Ваше имя.</li>
					<li>Впишите Ваше e-mail.</li>
					<li>Если желаете прикрепить видео или фото воспользуйтесь облачными хранилищами, 
					здесь будет достаточно ссылки на ваши файлы.</li>
				</ol>
					<h4 class="comm" id="width_answer">На все комментарии отвечу Вам на почту</h4>
						<div class="form-group">
							<h4 id="nam">Имя:</h4>
								<div><input id="name" type="text" class="form-control width_in" placeholder="Имя" name="name"></div><br>
							<h4 id="em">Email:</h4>
								<div><input id="email" type="email" class="form-control width_in" placeholder="Email" name="email"></div>					
						</div>
					<div><textarea id="comment" type="text" class="form-control width_in" placeholder="Опишите проблему" name="comment"  cols="20" rows="5"></textarea></div>
					<br>
					<button onclick="come();" id="go" type="submit" class="btn btn-primary" name="go">Отправить</button>
				</div>

			
			<br>
			<hr class="featurette-divider">
			<br>
			<div class="container" id="res_comment">
			<?php
			/*Выборка name text date*/
				$res = mysqli_query($db, 'SELECT name, email, comment, date FROM gb ORDER BY id DESC');
				$data = mysqli_fetch_all($res, MYSQLI_ASSOC);			
			
			
				foreach ($data as $item){
			echo "<span>{$item['name']}</span><div class=jumbotron><p>{$item['comment']}</p><br><span style='float: right; color: #9D9D9D;'>{$item['date']}</span></div>";
				}
			?>			
			</div>	
<a id="site1" href="http://tbkrussia.ru/">
			<div id="site">
				<img width="120" height="120" src="image/logo.png" alt="логотип ТВК">
				<p><span>перейти&nbsp;на tbkrussia.ru</span></p>
			</div>	
</a>								
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/ajax.js"></script>	
		</div>			
	</body>
</html>