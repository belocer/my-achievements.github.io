<!DOCTYPE html>
<html>
	<head></head>
	<body>
<div id="res_img">		
<?php
if (isset($_POST['submit'])){


	/*************=====================Загрузка изображений товара=========================**************/

	
	/*
	 Переход в нужный каталог и открытие прав доступа Linux Ubuntu х64	
	postgres@p:~$ cd /var/www/html/backEnd/
	postgres@p:/var/www/html/backEnd$ chmod 777 ./upload/
	*/
	
	// каталог для загрузки файлов
	$dir = './upload/';
 
		$file_unic = uniqid() . 1;
		$upfile = $_FILES["upfile1_up"]["tmp_name"]; /*— РНР Сохраняет Принятые фа-ы во временном каталоге, в
		этом поле массива хранится имя временного файла;*/
		$upfile_name = $_FILES["upfile1_up"]["name"]; //- имя файла на компьютере пользователя;
		$error_code = $_FILES["upfile1_up"]["error"]; //— КОД Ошибки

		// Если ошибок нет
		if($error_code == 0) 
		{
			//Путь сохранения файла
			$path_file1 = $dir.$file_unic.$upfile_name; 
			$_SESSION['path_file1'] = $path_file1; 
			copy($upfile, $path_file1);
		}
	
	
	if(isset($_POST['file1'])){$path_file1 = $_POST['file1'];}
	
	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$insert = "UPDATE dbelotserkovets_product SET path_file1 = '$path_file1' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd_id = pg_fetch_array($result_select_id);
echo $array_bd_id['path_file1'];
	//Очистка результатов
	pg_free_result($result_insert);

	//Закрытие соединения
	pg_close($dbconn);
	
}	
	echo 321;
	?>
	5555
	</div>
	</body>
</html>