<?php

if( isset($_POST['id']) ){

				/*Подключение к серверу MySQL*/
		$db = mysqli_connect('localhost', 'y9283007_base', 'titova2007', 'y9283007_base') or die('Ошибка соединения с сервером!');	
			/*Установка кодировки соединения*/
		mysqli_set_charset($db, 'utf8') or die('Не уставновлена кодировка соединения!');

	$id = $_POST['id'];
		//Создание и выполнение запроса на запись данных в БД
$id_delete = "DELETE FROM gb WHERE id = '$id'";
$res = mysqli_query($db, "$id_delete");				
							
		/*Выборка name text date*/
	$res = mysqli_query($db, 'SELECT id, name, email, comment, date FROM gb ORDER BY id DESC');
	$data = mysqli_fetch_all($res, MYSQLI_ASSOC);					
	echo '<input id="dDiv" type="hidden" value="">';
		foreach ($data as $item){
	echo "<div class='jumbotron comment_cent' ><br>
							<input class='hide_inp' type='button' name='btn_del' value='{$item['id']}' onmousedown=\"document.getElementById('dDiv').value=this.value\" onmouseup='del_id();'><br><hr>
							<span>
								<b>Имя</b>: {$item['name']}
							</span>
							<br>
							<span>
								<b>email</b>: {$item['email']}
							</span>
							<hr>
							<br>
							<p>{$item['comment']}</p>
							<br>
							<span style='float: right; color: #9D9D9D; padding-left: 17px;'>{$item['date']}</span>
						</div>";
						}
				
	$_SESSION['input_hidden'] = 1;
}
?>