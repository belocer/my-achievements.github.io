<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lesson 14</title>
	<link rel="stylesheet" href="media/assets/style.css">
	<link rel="stylesheet" href="media/assets/jquery.formstyler.css">
	</head>
<body>

<div id="logout">
		<form action="logout.php" method=GET>
		<hr><div style="color: green;">Вы авторизованы!</div><hr>
			<img src="image/6.png" alt="awatar"><br>
			<input class="styler" type="submit" value="ВЫХОД" name="logout">
		</form>
</div>

<?php

				//Убираю ошибки если что то не заполнено
if($surname == " ")   {$surname=null;}	
if($name == " ")      {$name=null;}	
if($patronymic == " "){$patronymic=null;}	
if($login == " ")     {$login=null;}		
if($pass1 == " ")     {$pass1=null;}	
if($pass2 == " ")     {$pass2=null;}	
if($email == " ")     {$email=null;}

				//Чек боксы для понятной записи
if($_SESSION["all_info"]==="on"){$_SESSION["all_info"]="all_info";}
if($_SESSION["new_book"]==="on"){$_SESSION["new_book"]="new_book";}
if($_SESSION["not_info"]==="on"){$_SESSION["not_info"]="not_info";}		

?>
	
<div id="bottom1"> 

<h1>Профиль пользователя <?php echo $_SESSION["login"]; echo $_SESSION['logg'];?> :</h1>

 <?php
 $myArrDanger = array();
 
 
								//Массив с данными
$myarr=array($_SESSION["surname"], $_SESSION["name"], $_SESSION["patronymic"], $_SESSION["login"], $_SESSION["pass1"], $_SESSION["pass2"], $_SESSION["sex"], $_SESSION["email"], $_SESSION["all_info"], $_SESSION["new_book"], $_SESSION["not_info"], $_SESSION["day"], $_SESSION["month"], $_SESSION["year"], $_SESSION["about_me"]);


								//Создаём дозаписываемые файлы
$x = fopen("infoUser.csv","a+");
$filename = 'infoUser.csv';


								//Записываем данные из массива в файл
if($_SESSION['entry'] === 1){
	//если пользователь пришёл со стр. inspect.php тогда записываем данные в файл//
	
//Существует ли файл?
if (file_exists($filename)) {
	echo "<br><strong style='color: green;'>infoUser.csv создан!</strong>";
} else {
    echo "<br>Файл 'infoUser.csv' не создан!";
}	

if($x===false){
	echo "<strong style='color: red;'>Файл не создан</strong>";
	}

	
	
	
								//Существует ли и доступен для записи файл
if(is_writable("infoUser.csv")){
	echo '<br><strong style="color: green;">infoUser.csv Доступен для записи!</strong><br><br>';
}else{
	echo '<br>infoUser.csv <strong style="color: red;">НЕ Доступен для записи!</strong>';
}
		fputcsv($x,$myarr);
}



									
								//Выводим в браузер данные из файла
$i = "infoUser.csv";						
$infor = file($i);	
$a = 1;
$arrays='';
for($n = 0; ($infor[$n]); $n++)
{
	//echo $a . " - " . $infor[$n] . "<br>";
	$arrays = explode(",", $infor[$n]);

	
/////////////////////////////////////////////////////////////////ВХОД///////////////////////////////////////////////////////
		if( ($arrays[3] == $_SESSION["logg"]) && ($arrays[4] == $_SESSION["pass"]) )
			{
			echo "<table>";
			echo "<tr><td class='styler'>Фамилия: " . "<td>" . $arrays[0] . "<br>";	
			echo "<tr><td class='styler'>Имя: " .   "<td>".$arrays[1] . "<br>";	
			echo "<tr><td class='styler'>Отчество: " .  "<td>".$arrays[2] . "<br>";	
						
			//Преобразую месяц в число
switch(trim($arrays[12])){
	case "Январь":
	$arrays[12] = 1;
	break;
	case "Февраль":
	$arrays[12] = 2;
	break;
	case "Март":
	$arrays[12] = 3;
	break;
	case "Апрель":
	$arrays[12] = 4;
	break;
	case "Май":
	$arrays[12] = 5;
	break;
	case "Июнь":
	$arrays[12] = 6;
	break;
	case "Июль":
	$arrays[12] = 7;
	break;
	case "Август":
	$arrays[12] = 8;
	break;
	case "Сентябрь":
	$arrays[12] = 9;
	break;
	case "Октябрь":
	$arrays[12] = 10;
	break;
	case "Ноябрь":
	$arrays[12] = 11;
	break;
	case "Декабрь":
	$arrays[12] = 12;
	break;
}	
			//Сегодняшняя дата
			$d = date("j"); //Порядковый номер дня месяца без ведущего нуля	
			$m = date("n"); //Порядковый номер месяца без ведущего нуля	
			$y = date("Y");
			
			//Д.Р. Пользователя
			$dd = $arrays[11];
			$mm = $arrays[12];
			$yy = $arrays[13];
			
			$day = $d - $dd;
			$month = $m - $mm;
			$year = $y - $yy;
			

			echo "<tr><td class='styler'>Возраст: ";
		if( ($month < 0) || ($mm == $m && $dd < 0) ){
			$ages = $year - 1;
			echo "<td>". $ages . "</td>";
////////////////////////////////////////////////////Акция!!!/////////////////////////////////////////////////////////////
								if($ages < 18){
									echo "<h3 style='color: blue;'>Для всех моложе 18 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/2L5t/HbwPf8BkV'>Получить книги</a></h3>";
								}elseif($ages > 50){
									echo "<h3 style='color: blue;'>Для всех старше 50 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/6Ld8/P2SQutnXp'>Получить книги</a></h3>";
								}
		}else{
			echo "<td>". $year . "</td>";
////////////////////////////////////////////////////Акция!!!/////////////////////////////////////////////////////////////
								if($year < 18){
									echo "<h3 style='color: blue;'>Для всех моложе 18 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/2L5t/HbwPf8BkV'>Получить книги</a></h3>";
								}elseif($year > 50){
									echo "<h3 style='color: blue;'>Для всех старше 50 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/6Ld8/P2SQutnXp'>Получить книги</a></h3>";
								}
		}
			echo "</table>";
			break;						
			}
	$a++;
}


//////////////////////////////////////Регистрация///////////////////////////////////////////////////////////////
if($_SESSION['entry'] == 1){
echo "<table>";	
echo "<tr><td class='styler'>Фамилия: " . "<td>" .$_SESSION["surname"];	
echo "<tr><td class='styler'>Имя: " . "<td>" .$_SESSION["name"];	
echo "<tr><td class='styler'>Отчество: " . "<td>".$_SESSION["patronymic"];	

//Преобразую месяц в число
switch(trim($arrays[12])){
	case "Январь":
	$arrays[12] = 1;
	break;
	case "Февраль":
	$arrays[12] = 2;
	break;
	case "Март":
	$arrays[12] = 3;
	break;
	case "Апрель":
	$arrays[12] = 4;
	break;
	case "Май":
	$arrays[12] = 5;
	break;
	case "Июнь":
	$arrays[12] = 6;
	break;
	case "Июль":
	$arrays[12] = 7;
	break;
	case "Август":
	$arrays[12] = 8;
	break;
	case "Сентябрь":
	$arrays[12] = 9;
	break;
	case "Октябрь":
	$arrays[12] = 10;
	break;
	case "Ноябрь":
	$arrays[12] = 11;
	break;
	case "Декабрь":
	$arrays[12] = 12;
	break;
}	
			//Сегодняшняя дата
			$d = date("j"); //Порядковый номер дня месяца без ведущего нуля	
			$m = date("n"); //Порядковый номер месяца без ведущего нуля	
			$y = date("Y");
			
			//Д.Р. Пользователя
			$dd = $arrays[11];
			$mm = $arrays[12];
			$yy = $arrays[13];
			
			$day = $d - $dd;
			$month = $m - $mm;
			$year = $y - $yy;
			

			echo "<tr><td class='styler'>Возраст: ";
		if( ($month < 0) || ($mm == $m && $dd < 0) ){
			$ages = $year - 1;
			echo "<td>". $ages . "</td>";
////////////////////////////////////////////////////Акция!!!/////////////////////////////////////////////////////////////
								if($ages < 18){
									echo "<h3 style='color: blue;'>Для всех моложе 18 доступен особый сбор книг!" .
									"<br><a href='https://cloud.mail.ru/public/2L5t/HbwPf8BkV'>Получить книги</a></h3>";
								}elseif($ages > 50){
									echo "<h3 style='color: blue;'>Для всех старше 50 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/6Ld8/P2SQutnXp'>Получить книги</a></h3>";
								}
		}else{
			echo "<td>". $year . "</td>";
////////////////////////////////////////////////////Акция!!!/////////////////////////////////////////////////////////////
								if($year < 18){
									echo "<h3 style='color: blue;'>Для всех моложе 18 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/2L5t/HbwPf8BkV'>Получить книги</a></h3>";
								}elseif($year > 50){
									echo "<h3 style='color: blue;'>Для всех старше 50 доступен особый сбор книг!".
									"<br><a href='https://cloud.mail.ru/public/6Ld8/P2SQutnXp'>Получить книги</a></h3>";
								}
		}
			echo "</table>";
			
echo "</table>";	
}

?>
					
	</div>

<div id="size">
<canvas id="c" width="1362" height="955"></canvas>
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5.1/dat.gui.min.js"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenMax.min.js"></script>
			
</div>
	
<br>
<br>
<br>
	<script src="media/assets/jquery.formstyler.min.js" defer></script>
	<script src="media/js/core.js" defer></script>
	<script src="media/js/script.js" defer></script>
</body>
</html>