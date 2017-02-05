<?php

//date_default_timezone_set('UTC');

// Если нажата кнопка "Добавить новый товар"
if(isset($_POST["input_submit"])){
$path_file1 = '';
$path_file2 = '';
$path_file3 = '';
$path_file4 = '';
 
/*************=====================Загрузка изображений товара=========================**************/
 
// каталог для загрузки файлов
$dir = './upload/';
//http://shoggoth.ru/edu/09/dbelotserkovets//backEnd/index.php

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

// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error()); 

if(isset($_SESSION['path_file1'] )){$path_file1 = $_SESSION['path_file1'];}
if(isset($_SESSION['path_file2'] )){$path_file2 = $_SESSION['path_file2'];}
if(isset($_SESSION['path_file3'] )){$path_file3 = $_SESSION['path_file3'];}
if(isset($_SESSION['path_file4'] )){$path_file4 = $_SESSION['path_file4'];}

$name_product = $_POST["name_product"]; // Имя продукта
$specification = $_POST["specification"]; // Описание товара
$variable1 = $_POST["variable1"]; // 1 вариант товара
$variable2 = $_POST["variable2"]; // 2 вариант товара
$variable3 = $_POST["variable3"]; // 3 вариант товара
$price = $_POST['price']; // Цена
$badge = $_POST['badge'];
$category_name = $_POST['category'];

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
$badge = clean($badge);
$category_name = clean($category_name);

// Запись в БД
$insert = "INSERT INTO dbelotserkovets_product(category_name, product_name, specification, price, badge, variable1, variable2, variable3, path_file1, path_file2, path_file3, path_file4) VALUES ('$category_name', '$name_product', '$specification', '$price', '$badge', '$variable1', '$variable2','$variable3', '$path_file1', '$path_file2', '$path_file3', '$path_file4');";
$result_insert = pg_query($dbconn, $insert) or die('Ошибка запроса записи: ' . pg_last_error());

// Поиск по артиклу товара

}else{
	session_destroy();	
	}
?>





































































































































































