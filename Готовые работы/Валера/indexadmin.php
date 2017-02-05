<?php
session_start();
if($_SESSION['auth']!==1)
{	
	header('Location: index1.php');
	exit;
}
/*Вывод ошибок*/
error_reporting(E_ALL);	
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

$data = $_POST;
if( isset($data['submit']) ){
// каталог для загрузки файлов
$dir = './upload/';
if(isset($_FILES["upfile1_up"])) 
{ 
	$file_unic = uniqid() . 1;
	$upfile = $_FILES["upfile1_up"]["tmp_name"];//— РНР Сохраняет Принятые фа-ы во временном каталоге, в
												//этом поле массива хранится имя временного файла
	$upfile_name = $_FILES["upfile1_up"]["name"]; //- имя файла на компьютере пользователя;
	$error_code = $_FILES["upfile1_up"]["error"]; //— КОД Ошибки

	// Если ошибок нет
	if($error_code == 0) 
	{
	//Путь сохранения файла
	$path_file1 = $dir.$file_unic.$upfile_name; 
	copy($upfile, $path_file1);
	}
}

$errors = array();
	
	if( trim($data['name_product']) == '') {
		$errors[] = "Пропустил название продукта";
	}	
	if( trim($data['tags']) == '') {
		$errors[] = "Не указал тэги";
	}	
	if( trim($data['page']) == '') {
		$errors[] = "Не указал страницу";
	}	
		
	if( empty($errors)){
				// Все хорошо можно писать в JSON
				// Создаём дозаписываемые файлы
		$filename = 'answer.json';
		$x = fopen($filename,"a+");

										// Берем переменные
		$name_product = $data['name_product'];
		$tags = $data['tags'];
		$page = $data['page'];
		$description = $data['description'];
		$path_file1 = substr($path_file1, 1);
		$video = $data['video'];

		$jsonobj = array(
						"name_product" => $name_product,
						"tags" => $tags,
						"page"=> $page,
						"description" => $description,
						"path_file1" => $path_file1,
						"video" => $video
						);
		$jsonobj = json_encode( $jsonobj );
		
			// Получаем содержимое файла config.json
			// Допустим, там закодированный массив вида
		$json = file_get_contents('answer.json');
			// Декодируем
		$json = json_decode($json, true);
			// Добавляем элемент
		$current = file_get_contents($filename);
		$current = str_replace("]", "", $current);
		$current .= ','.$jsonobj.']';
			// Превращаем опять в JSON
		$json = json_encode($json);
			// Перезаписываем файл
		file_put_contents($filename, $current);
		unset($data);
		$good = '<div style="color: green;">Запись удачно внесена в Базу Данных!</div>';
	}	
}
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
								<li><a href="#">ДОБАВИТЬ ОТВЕТЫ</a></li>
								<li><a href="#ans">ВОПРОСЫ</a></li>
								<li><a href="#reg">РЕГИСТРАЦИЯ</a></li>
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
				<hr>
					<h2>Добавление новых ответов</h2>
				<hr>
			</div>
		<br>
<?php
	if( !empty($errors)){
		echo "<div style='color: red;'>". array_shift($errors) ."</div><hr>";
	}else if (isset($good)){
		echo $good;
	}		
?>	
		<div id="wrapper_admin" class="row">
			<div class="wrapper1" id="block_left">
				<div class="data">
					<form action="indexadmin.php" method="post" enctype="multipart/form-data">
						<p>Название товара или услуги:</p>
						<input type="text" name="name_product" placeholder="Название товара или услуги" value="<?php echo @$data['name_product']; ?>"><br><br>
						<p>Предпологаемые слова поиска:</p>
						<input type="text" name="tags" placeholder="например: 'TBK808'" value="<?php echo @$data['tags']; ?>"><br><br>
						<p>Страница:</p>
						<input type="text" name="page" placeholder="http://tbkrussia.ru/" value="<?php echo @$data['page']; ?>"><br><br>
						<p>Видео:</p>
						<input type="text" name="video" placeholder="https://www.youtube.com/embed/..." value="<?php echo @$data['video']; ?>"><br><br>			
						<p>Выбрать фото:</p>
						<input type="file" class="no_decoration" name="upfile1_up" id="foto1_update" accept="image/png, image/jpeg">
						<input type="hidden" name="MAX_FILE_SIZE" value="3000000"><br><br>
						<p>Описание ответа:</p>
						<textarea name="description" id="description" cols="30" rows="10"></textarea><br><br>
						<button type="submit" class="btn btn-primary" name="submit">Загрузить в базу данных</button>
					</form>	
				</div><a name="ans"></a>				
			</div>
			<br>
				<div class="container">
					<hr>
						<h2>Вопросы пользователей</h2>
					<hr>
				</div>
			<br>
			<div id="block_second">
				<div class="comment" id="res_coment">
				
					<?php
						/*Подключение к серверу MySQL*/
					$db = @mysqli_connect('localhost', 'y9283007_base', 'titova2007', 'y9283007_base') or die('Ошибка соединения с сервером!');	
						/*Установка кодировки соединения*/
					mysqli_set_charset($db, 'utf8') or die('Не уставновлена кодировка соединения!');
					
						/*Выборка name text date*/
					$res = mysqli_query($db, 'SELECT id, name, email, comment, date FROM gb ORDER BY id DESC');
					$data = mysqli_fetch_all($res, MYSQLI_ASSOC);					
					echo '<input id="dDiv" type="hidden" value="">';
						foreach ($data as $item){
					echo "<div class='jumbotron comment_cent' ><br>
							<div class='button_del'><input title='удалить комментарий' class='hide_inp' type='button' name='btn_del' value='{$item['id']}' onmousedown=\"document.getElementById('dDiv').value=this.value\" onmouseup='del_id();'>
							</div>
							<br><hr>
							<span>
								<b>Имя</b>: {$item['name']}
							</span>
							<br>
							<span>
								<b>Email</b>: {$item['email']}
							</span>
							<hr>
							<br>
							<p>{$item['comment']}</p>
							<br>
							<span style='float: right; color: #9D9D9D; padding-left: 17px;'>{$item['date']}</span>
						</div>";
						}
					?>	
					
				</div>
			</div><a name="reg"></a>
		</div>
		<br>
			<div class="container">
				<hr>
					<h2>Регистрация нового польователя</h2>
				<hr>
			</div>
		<br>

<div class="container cent_reg wrapper1">
	<form id="myform" action="inspect.php" method="GET">
<p>Логин:</p> 					<?php if(isset($_SESSION["login"])){
					if(strlen($_SESSION["login"])<1){
							 echo '<input class="styler" type=text name="login" style="color: Gray; font-style: italic;" placeholder="Не заполнено"><br><br>';
						  }else{
							 echo '<input class="styler" type=text name="login" value="' . $_SESSION["login"] . '"><br><br>';
						  }
				} else {
					echo '<input class="styler" type=text name="login" placeholder="логин"><br><br>';
				}
			  ?>
<p>Пароль:</p> 
				<?php if(isset($_SESSION["pass1"])){  
					if(strlen($_SESSION["pass1"])<1){
							 echo '<input class="styler" type="password" name="pass1" style="color: Gray; font-style: italic;" placeholder="Не заполнено"><br><br>';
						  }else{
							 echo '<input class="styler" type="password" name="pass1" value="' . $_SESSION["pass1"] . '"><br><br>';
						  }
					} else {
					echo '<input class="styler" type="password" name="pass1" placeholder="пароль"><br><br>';
				}
			  ?>
<p>Подтверждение пароля:</p> 	<?php if(isset($_SESSION["pass2"])){  
					if(strlen($_SESSION["pass2"])<1){
							 echo '<input class="styler" type="password" name="pass2" style="color: Gray; font-style: italic;" placeholder="Не заполнено"><br><br>';
						  }else{
							 echo '<input class="styler" type="password" name="pass2" value="' . $_SESSION["pass2"] . '"><br><br>';
						  }
					if ($_SESSION["pass1"] != $_SESSION["pass2"]){
										echo '<div style="color: red">Пароли не совпадают!</div><br><br>';
						  }
					} else {
					echo '<input class="styler" type="password" name="pass2" placeholder="повторно пароль"><br><br>';
				}
			  ?>

<p>Email:</p> <?php if(isset($_SESSION["email"])){ 
					if(strlen($_SESSION["email"])<1){
							 echo '<input class="styler" type=email name=email style="font-style: italic;" placeholder="Не заполнено"><br><br>';
						  }else{
							 echo '<input class="styler" type="email" name="email" value="'. $_SESSION["email"] . '"><br><br>';
						}
					} else {
					echo '<input class="styler" type="email" name="email" placeholder="email"><br><br>';
				}
			  ?>
<input class="styler" type="submit" value="Зарегистрировать пользователя" name="registration" id="but">
	
	</form>
<?php 
	if (isset($_SESSION['errorLogin'])){echo "<strong style='color: red;'>" . $_SESSION['errorLogin']. "</strong><br>";}
	if (isset($_SESSION['errorMail'])){echo "<strong style='color: red;'>" . $_SESSION['errorMail']. "</strong><br>";}	
?>
</div>
<br>
<br>
<br>	
<!--**********************Регистрация нового пользователя*****************************-->		

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
	</body>
</html>