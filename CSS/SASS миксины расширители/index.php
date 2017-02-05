<?php

 $err_message = '';
 $Uname = $_GET['Uname'];

if( empty($Uname) ){
  echo "Заполните строку ФИО!!!";
  $err_message .= "Не введен Логин";    
}else{
  print("Ваше имя: $_POST['Uname'] <br>\n"); 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>