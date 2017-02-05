<!DOCTYPE html>
<html>
 <head>
  <title>Lesson 10</title>
 </head>
 <body>

 <?php
 $capitals = array('Москва', 'Париж', 'Лондон', 'Токио', "Кочубеевское");//Объявление массива
 
 $capitals[] = 'Вашингтон';//Добавление элемента в конец массива
 
 array_pop($capitals);//Удаление последнего элемнта массива
 
	for($i = 0; $i < count($capitals); $i++){
		echo $capitals[$i] . '<br>'; 
}
 ?>

 <br><select>
 
 <?php
  	for($i = 0; $i < count($capitals); $i++){
		echo "<option value=$capitals[$i]>$capitals[$i]</option>"; 
}
 ?>
 
 </select><br><br>
 
 
 <?php
 $capitals1 = array(
						'Россия' => 'Москва',
						'Франция' => 'Париж',
						'Англия' => 'Лондон'
 );
  
  foreach($capitals1 as $country => $town){
	  
	  echo "$town-$country <br>";
  }
  
  ?>
 
 
 
 </body>
</html>