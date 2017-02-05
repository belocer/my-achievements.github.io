<?php
 
$user_id = 0;					
if (isset($_POST['update'])){

if(isset($_POST['file1'])){$path_file1 = $_POST['file1'];}else{$path_file1  = '';}
if(isset($_POST['file2'])){$path_file2 = $_POST['file2'];}else{$path_file2  = '';}
if(isset($_POST['file3'])){$path_file3 = $_POST['file3'];}else{$path_file3  = '';}
if(isset($_POST['file4'])){$path_file4 = $_POST['file4'];}else{$path_file4  = '';}
 
	/*************=====================Загрузка изображений товара=========================**************/
	
	/*
	 Переход в нужный каталог и открытие прав доступа Linux Ubuntu х64	
	postgres@p:~$ cd /var/www/html/backEnd/
	postgres@p:/var/www/html/backEnd$ chmod 777 ./upload/
	*/
	// каталог для загрузки файлов
$dir = './upload/';
  
	if(isset($_FILES["upfile1_up"])) 
	{ 
		$file_unic = uniqid() . 1;
		$upfile = $_FILES["upfile1_up"]["tmp_name"]; /*— РНР Сохраняет Принятые фа-ы во временном каталоге, в
		этом поле массива хранится имя временного файла;*/
		$upfile_name = $_FILES["upfile1_up"]["name"]; //- имя файла на компьютере пользователя;
		$error_code = $_FILES["upfile1_up"]["error"]; //— КОД Ошибки

		// Если ошибок нет
		if($error_code == 0) 
		{
			//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на удаление данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file1'];
	unlink($del);
			//Путь сохранения файла
			$path_file1 = $dir.$file_unic.$upfile_name; 
			$_SESSION['path_file1'] = $path_file1; 
			copy($upfile, $path_file1);
		}
	}

	if(isset($_FILES["upfile2_up"])) 
	{ 
		$file_unic = uniqid() . 2;
		$upfile = $_FILES["upfile2_up"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
		этом поле массива хранится имя временного файла;*/
		$upfile_name = $_FILES["upfile2_up"]["name"]; //- имя файла на компьютере пользователя;
		$error_code = $_FILES["upfile2_up"]["error"]; //- КОД Ошибки

		// Если ошибок нет
		if($error_code == 0) 
		{
			//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на удаление данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file2'];
	unlink($del);
			//Путь сохранения файла
			$path_file2 = $dir.$file_unic.$upfile_name; 
			$_SESSION['path_file2'] = $path_file2; 
			copy($upfile, $path_file2);
		}
	}

	if(isset($_FILES["upfile3_up"])) 
	{ 
		$file_unic = uniqid() . 3;
		$upfile = $_FILES["upfile3_up"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
		этом поле массива хранится имя временного файла;*/
		$upfile_name = $_FILES["upfile3_up"]["name"]; //- имя файла на компьютере пользователя;
		$error_code = $_FILES["upfile3_up"]["error"]; //— КОД Ошибки

		// Если ошибок нет
		if($error_code == 0) 
		{ 
			//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на удаление данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file3'];
	unlink($del);
			//Путь сохранения файла
			$path_file3 = $dir.$file_unic.$upfile_name; 
			$_SESSION['path_file3'] = $path_file3; 
			copy($upfile, $path_file3);
		}
	}

	if(isset($_FILES["upfile4_up"])) 
	{ 
		$file_unic = uniqid() . 4;
		$upfile = $_FILES["upfile4_up"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
		этом поле массива хранится имя временного файла;*/
		$upfile_name = $_FILES["upfile4_up"]["name"]; //- имя файла на компьютере пользователя;
		$error_code = $_FILES["upfile4_up"]["error"]; //— КОД Ошибки

		// Если ошибок нет
		if($error_code == 0) 
		{
			//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на удаление данных в БД
	$user_id = $_POST['id_search'];
	$select_id = "SELECT * FROM dbelotserkovets_product WHERE id_article = '$user_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd = pg_fetch_array($result_select_id);
	$del = $array_bd['path_file4'];
	unlink($del);
			//Путь сохранения файла
			$path_file4 = $dir.$file_unic.$upfile_name; 
			$_SESSION['path_file4'] = $path_file4;
			copy($upfile,$path_file4);
		}
	}
 
///Загрузка изображений товара в случае загрузки вчерез поле изменить//////////////////////////


// каталог для загрузки файлов
$dir = './upload/';

 
if(isset($_FILES["upfile1"])) 
{ 
	$file_unic = uniqid() . 1;
	$upfile = $_FILES["upfile1"]["tmp_name"]; /*— РНР Сохраняет Принятые фа-ы во временном каталоге, в
	этом поле массива хранится имя временного файла;*/
	$upfile_name = $_FILES["upfile1"]["name"]; //- имя файла на компьютере пользователя;
	$error_code = $_FILES["upfile1"]["error"]; //— КОД Ошибки

	// Если ошибок нет
	if($error_code == 0) 
	{
	//Путь сохранения файла
	$path_file1 = $dir.$file_unic.$upfile_name; 
	$_SESSION['path_file1'] = $path_file1; 
	copy($upfile, $path_file1);
	}
}

if(isset($_FILES["upfile2"])) 
{ 
	$file_unic = uniqid() . 2;
	$upfile = $_FILES["upfile2"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
	этом поле массива хранится имя временного файла;*/
	$upfile_name = $_FILES["upfile2"]["name"]; //- имя файла на компьютере пользователя;
	$error_code = $_FILES["upfile2"]["error"]; //— КОД Ошибки

	// Если ошибок нет
	if($error_code == 0) 
	{
		//Путь сохранения файла
		$path_file2 = $dir.$file_unic.$upfile_name; 
		$_SESSION['path_file2'] = $path_file2; 
		copy($upfile, $path_file2);
	}
}

if(isset($_FILES["upfile3"])) 
{ 
	$file_unic = uniqid() . 3;
	$upfile = $_FILES["upfile3"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
	этом поле массива хранится имя временного файла;*/
	$upfile_name = $_FILES["upfile3"]["name"]; //- имя файла на компьютере пользователя;
	$error_code = $_FILES["upfile3"]["error"]; //— КОД Ошибки

	// Если ошибок нет
	if($error_code == 0) 
	{ 
		//Путь сохранения файла
		$path_file3 = $dir.$file_unic.$upfile_name; 
		$_SESSION['path_file3'] = $path_file3; 
		copy($upfile, $path_file3);
	}
}

if(isset($_FILES["upfile4"])) 
{ 
	$file_unic = uniqid() . 4;
	$upfile = $_FILES["upfile4"]["tmp_name"]; /*— РНР Сохраняет Принятые фаЙЛЫ ВО вре-менном каталоге, в
	этом поле массива хранится имя временного файла;*/
	$upfile_name = $_FILES["upfile4"]["name"]; //- имя файла на компьютере пользователя;
	$error_code = $_FILES["upfile4"]["error"]; //— КОД Ошибки

	// Если ошибок нет
	if($error_code == 0) 
	{
		//Путь сохранения файла
		$path_file4 = $dir.$file_unic.$upfile_name; 
		$_SESSION['path_file4'] = $path_file4;
		copy($upfile,$path_file4);
		
	}
} 

	// Проверяю какой выбран бейдж
	if( isset($_POST["badge_absent"]) ) {
			$badge = "absent";
		} else if(isset($_POST["badge_new"])){
			$badge = "new";
		} else if(isset($_POST["badge_hot"])){
			$badge = "hot";
		} else if(isset($_POST["badge_sale"])){
			$badge = "sale";
		}else{
			$badge = "absent";
	}

	// Проверяю какая выбрана категория
	if( isset($_POST["snoubord"]) ) {
			$category_name = "snoubord";
		} else if(isset($_POST["scooter"])){
			$category_name = "scooter";
		} else if(isset($_POST["roller"])){
			$category_name = "roller";
		} else if(isset($_POST["tennis"])){
			$category_name = "tennis";
		} else if(isset($_POST["wakeboard"])){
			$category_name = "wakeboard";
		}else{
			$category_name = "snoubord";	
	}

	$name_product = $_POST["name_product"]; // Имя продукта
	$specification = $_POST["specification"]; // Описание товара
	$variable1 = $_POST["variable1"]; // 1 вариант товара
	$variable2 = $_POST["variable2"]; // 2 вариант товара
	$variable3 = $_POST["variable3"]; // 3 вариант товара
	$price = $_POST['price']; // Цена
	$user_id = $_POST['id_search']; 
	
	//Очистка от пробелов, удаление символов, удаление HTML и PHP тегов, преобразуем спецсимволы в HTML сущности
	function clean($value = ''){
		$value = trim($value);
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);

		return $value;
	}

	$name_product = clean($name_product);
	$specification = clean($specification);
	$variable1 = clean($variable1);
	$variable2 = clean($variable2);
	$variable3 = clean($variable3);
	$price = clean($price);
	$category_name = $_POST['category'];
	$badge = $_POST['badge'];

	//Соединение сервером БД, и выбор БД
	$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

	//Создание и выполнение запроса на запись данных в БД
	$insert = "UPDATE dbelotserkovets_product SET category_name = '$category_name', product_name = '$name_product', specification = '$specification', price = '$price', badge = '$badge', variable1 = '$variable1', variable2 = '$variable2', variable3 = '$variable3', path_file1 = '$path_file1', path_file2 = '$path_file2', path_file3 = '$path_file3', path_file4 = '$path_file4' WHERE id_article = '$user_id';";
	$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

	//Очистка результатов
	pg_free_result($result_insert);

	//Закрытие соединения
	pg_close($dbconn);
	
}
if(isset($_POST['id_search'])){
		$user_id = $_POST['id_search'];
	$_SESSION['id_article'] = $user_id;
}


?>