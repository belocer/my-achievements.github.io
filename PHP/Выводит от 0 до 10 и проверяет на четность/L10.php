<!DOCTYPE html>
<html>
 <head>
  <title>Lesson 10</title>
 </head>
 <body>

 <?php
 $i=0;
	do{
		if($i == 0){
					echo $i . ' - Это ноль' . '<br>';
				}elseif(($i % 2) == 0){
					echo $i . ' - Четное число' . '<br>';
				}else{
					echo "$i - Нечетное число <br>";
				}
				++$i;
		}while($i<=9);
  ?>
  
 
 </body>
</html>