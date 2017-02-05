<!DOCTYPE html>
<html>
 <head>
  <title>Lesson 10</title>
 </head>
 <body>

 <?php
	$user = 'Иван|Иванович|Иванов|Москва|89111111111';
	echo $user . '<br>';
	$temp = explode('|' , $user);
	$temp[3] = 'Колыма';
	$user = implode('|' , $temp);
	echo $user . '<br>';
	
	echo '<pre>';
	print_r($temp);
	echo '</pre>';
  ?>
  
 
 </body>
</html>