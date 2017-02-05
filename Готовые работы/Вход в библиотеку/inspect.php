<?php
session_start ();

if(isset($_GET[registration])){
		
			//перебрасываю значения
$_SESSION["surname"]   =    $_GET["surname"];
$_SESSION["name"]      =    $_GET["name"];
$_SESSION["patronymic"]=    $_GET["patronymic"];
$_SESSION["login"]     =    $_GET["login"];
$_SESSION["pass1"]     =    $_GET["pass1"];
$_SESSION["pass2"]     =    $_GET["pass2"];
$_SESSION["sex"]       =    $_GET["sex"];
$_SESSION["email"]     =    $_GET["email"];
$_SESSION["all_info"]  =    $_GET["all_info"];
$_SESSION["new_book"]  =    $_GET["new_book"];
$_SESSION["not_info"]  =    $_GET["not_info"];
$_SESSION["day"]       =    $_GET["day"];
$_SESSION["month"]     =    $_GET["month"];
$_SESSION["year"]      =    $_GET["year"];
$_SESSION["about_me"]  =    $_GET["about_me"];


//Проверяю логин
$z="infoUser.csv";
$logs = fopen('infoUser.csv',r);
$openArr = file('infoUser.csv');
$op = count($openArr);
for( $i = 0; $i < $op; $i ++ )
{
	$temper = explode(',', $openArr[$i]);	
	
	if( trim($_GET['login']) === trim($temper[3]) )
	{
		//Логин занят
		$_SESSION['errorLogin']="Этот логин занят!<br>";
		header("Location: registr.php");
		fclose($logs);
		exit;
	}
}
fclose($logs);

//Проверяю mail
$meils = fopen('infoUser.csv',r);
$openArr = file('infoUser.csv');
$ope = count($openArr);
for( $b = 0; $b < $ope; $b ++ )
{
	$temperMail = explode(',', $openArr[$b]);	
	
	if( trim($_GET['email']) === trim($temperMail[7]) )
	{
		//Логин mail
		$_SESSION['errorLogin']="Этот mail уже используется!<br>";
		header("Location: registr.php");
		fclose($meils);
		exit;
	}
}
fclose($meils);	

						//Проверяю есть ли что в значениях супер глобальной переменной сесион + редирект
if((strlen($_SESSION['surname'])<1)    ||
   (strlen($_SESSION['name'])<1)       ||
   (strlen($_SESSION['patronymic'])<1) ||
   (strlen($_SESSION['login'])<1) 	   ||
   (strlen($_SESSION['pass1'])<1) 	   ||
   (strlen($_SESSION['pass2'])<1) 	   ||
   (strlen($_SESSION['email'])<1)      ||
   ($_SESSION['pass1'])!==($_SESSION['pass2'])
){  
	//Не верно!
	header("Location: registr.php");
	exit;
}else{
	//Всё хорошо отправляю на home.php
	$_SESSION['entry'] = 1;
	header("Location: home.php");
	exit;
}
}
?>
