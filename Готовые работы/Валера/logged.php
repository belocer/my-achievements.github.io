<?php session_start(); 
if( isset($_POST['logged']) ){
	
if( (trim($_SESSION["logg"]) == "admin") && ((trim($_SESSION["pass"]) == "admin"))){
	header('Location: indexadmin.php');
}	

			/////Сверка логина
	$e = 'infoUser.csv';
	$f = fopen('infoUser.csv',r);
	$g = file('infoUser.csv');
	$gg = count($g);
	
	for( $i=0; $i<$gg; $i++ ){
		
		$exp = explode(',', $g[$i]);

		if( trim($_POST['logg']) === trim($exp[0]) )
			{
				//Логин верен
				$logSum="1";
			}
		}

	/////Сверка пароля
$x = 'infoUser.csv';
$y = fopen('infoUser.csv',r);
$z = file('infoUser.csv');
$gg = count($z);
for( $j=0; $j<$gg; $j++ )
{
$exp = explode(',', $z[$j]);

if( trim($_POST['pass']) === trim($exp[1]) )
	{
		//Пароль верен
		$pasSum="1";
	}
}

/////Общая сверка
if(($logSum+$pasSum)=="2")
{
	$_SESSION['auth']=1; //Сессионная переменная для вошедшего
	header('Location: home.php');
	fclose($f);
	fclose($y);
	exit;
}
elseif(($logSum+$pasSum)<"2")
{
	$_SESSION['Danger']="Не верен <br> логин <br> или <br> пароль!";
	header('Location: index1.php');
	fclose($f);
	fclose($y);
	exit;
}

}else{
	 $_SESSION['Danger']="Не верен <br> логин <br> или <br> пароль!";
		header('Location: index1.php');
		exit;	
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>5555555</title>
</head>
<body>

</body>
</html>









