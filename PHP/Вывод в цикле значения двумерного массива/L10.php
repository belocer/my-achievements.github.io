<!DOCTYPE html>
<html>
 <head>
  <title>Lesson 10</title>
 </head>
 <body>

 <?php
 $cities = array(
				'Россия' => array ('Москва', 'Санкт-Петербург', 'Новосибирск', 'Уфа'),
				'Англия' => array ('Лондон', 'Бирмингем', 'Ливерпуль'),
				'Испания' => array ('Барселона', 'Валенсия', 'Бильбао')
					);
					
		foreach($cities as $country => $towns){
			echo "<h2>$country : </h2>";
			
			for($i = 0; $i < count($towns); $i++){
				echo $towns[$i];
				
				if($i < count($towns) - 1)
					echo ', ';
			}
		}
  ?>
  
  <hr><hr><hr>
  
   <?php
 $cities = array(
				'Россия' => array ('Москва', 'Санкт-Петербург', 'Новосибирск', 'Уфа'),
				'Англия' => array ('Лондон', 'Бирмингем', 'Ливерпуль'),
				'Испания' => array ('Барселона', 'Валенсия', 'Бильбао')
					);
					
		foreach($cities as $country => $towns){
			echo "<h2>$country : </h2>";
			echo implode(', ', $towns);
			
		}
  ?>
 
 </body>
</html>