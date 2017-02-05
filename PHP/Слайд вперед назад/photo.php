<?php

$id = $_GET['id'];
$id_prev = ($id > 1) ? $id - 1 : 5; 
$id_next = ($id < 5) ? $id + 1 : 1;

?>
<img src="img/<?php echo $id?>.jpg" width="300"/><br>
<a href="photo.php?id=<?php echo $id_prev?>">Назад</a>
<a href="photo.php?id=<?php echo $id_next?>">Вперед</a>
<h3>Текст о картинке <?php echo $id?></h3>