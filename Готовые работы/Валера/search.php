<?php
session_start();
error_reporting(E_ALL);	
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);
	
	$data = $_POST;
	$errors = array();
	
	if( trim($data['name']) == '') {
		$errors[] = "не указали имя!";
	}	
	if( trim($data['email']) == '') {
		$errors[] = "Не указал mail";
	}	
	if( trim($data['comment']) == '') {
		$errors[] = "Вы не оставили комментарий";
	}	
		
	if( empty($errors) ){

			/*Подключение к серверу MySQL*/
		$db = mysqli_connect('localhost', 'y9283007_base', 'titova2007', 'y9283007_base') or die('Ошибка соединения с сервером!');	
			/*Установка кодировки соединения*/
		mysqli_set_charset($db, 'utf8') or die('Не уставновлена кодировка соединения!');	
		
		/*Создаю переменные*/
		$name = $data['name'];
		$email = $data['email'];
		$comment = $data['comment'];
											/*Безопасность по XSS*/
										$name = nl2br(htmlspecialchars($name));	
										$email = nl2br(htmlspecialchars($email));	
										$comment = nl2br(htmlspecialchars($comment));	

											/*Безопасность по SQL-запросам*/
										$name = mysqli_real_escape_string($db, $name);
										$email = mysqli_real_escape_string($db, $email);
										$comment = mysqli_real_escape_string($db, $comment);
			/*Запись данных в БД*/

			/*Создаю запрос*/
		$insert = "INSERT INTO gb (name, email, comment) VALUES ('$name', '$email', '$comment')";
			/*Выполнение запроса*/
		$res_insert = mysqli_query($db, $insert);
		$good = '<div style="color: green;">Ваш коммент ниже..</div>';
		
			/*Выборка name text date*/
		$res = mysqli_query($db, 'SELECT name, email, comment, date FROM gb ORDER BY id DESC');
		$data = mysqli_fetch_all($res, MYSQLI_ASSOC);			
		foreach ($data as $k => $value){
			echo "<span>{$value['name']}</span><div class=jumbotron><p>{$value['comment']}</p><br><span style='float: right; color: #9D9D9D;'>{$value['date']}</span></div>";
		}
			
	}else{
		echo "<div style='color: red;'>". array_shift($errors) ."</div><hr>";
	}
	


			
?>