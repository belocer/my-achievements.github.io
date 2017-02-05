<?php
session_start ();

if(isset($_GET[registration])){
		
				//перебрасываю значения
$_SESSION["login"] = $_GET["login"];
$_SESSION["pass1"] = $_GET["pass1"];
$_SESSION["pass2"] = $_GET["pass2"];
$_SESSION["email"] = $_GET["email"];


//Проверяю логин
$z="infoUser.csv";
$logs = fopen('infoUser.csv',r);
$openArr = file('infoUser.csv');
$op = count($openArr);
for( $i = 0; $i < $op; $i ++ )
{
	$temper = explode(',', $openArr[$i]);	
	
	if( trim($_GET['login']) === trim($temper[0]) )
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
	
	if( trim($_GET['email']) === trim($temperMail[3]) )
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
if((strlen($_SESSION['login'])<=0) 	   ||
   (strlen($_SESSION['pass1'])<=0) 	   ||
   (strlen($_SESSION['pass2'])<=0) 	   ||
   (strlen($_SESSION['email'])<=0)      ||
   ($_SESSION['pass1'])!==($_SESSION['pass2'])
){  
	header("Location: indexadmin.php");
	exit;
}else{
	header("Location: write.php");
	exit;
}
}
?>
