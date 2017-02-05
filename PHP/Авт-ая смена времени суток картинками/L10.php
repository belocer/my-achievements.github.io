<?php
 $h = date('H');
if(($h>=6) && ($h < 12))
	$img = 'morning';
elseif(($h>=12) && ($h < 18))
	$img = 'day';
elseif($h >=18)
	$img = 'evening';
else
	$img = 'night';
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Lesson 10</title>
 </head>
 <body style="width: 100%;
				height: 768px;
				background: url(img/<?php echo $img;?>.jpg); background-size: cover;">
				<h1><?php echo $h;?></h1>
 </body>
</html>