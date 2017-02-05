<?php
session_start();
/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	unset($_SESSION);
	unset($_POST);
	unset($_GET);
	session_destroy();
	header('Location: ../index.php');
		exit;
} */
require_once 'php/delete_item.php';
require_once 'php/creation_item.php';
require_once 'php/edit_item.php';
require_once 'php/search_item.php'; 

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<meta charset="UTF-8">
<title>Информация о товаре</title>
<link rel="stylesheet" href="CSS/itemInformationStyle.css">
<link rel="stylesheet" href="CSS/fonts.css">
	<!--[if lt IE9] <script src="//html5shivgooglecode.com/svn/trunk/html5.js"></script>
<[!endif]-->
</head>
<body>
<section>
<!--*******************************NAV MENU***********************************-->
<nav>
	<ul>
		<li>
			<a id="label" href="index.php"><img src="image/label.jpg" alt="label"></a>
		</li>
		<li>
			<a href="index.php"><img src="image/cartA.png" alt="cartA"><span>ЗАКАЗЫ</span></a>
		</li>
		<li>
			<a href="users.php"><img src="image/avaUsers.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a>
		</li>
		<li>
			<a href="items.php"><img src="image/truckGreen.png" alt="truck"><span>ТОВАРЫ</span></a>
		</li>
		<li>
			<a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a>
		</li>
	</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
</nav>

<!--***************1БЛОК******************-->
	<h1>ПРОСМОТР ТОВАРА</h1>
	<form action="itemInformation.php" method="POST" enctype="multipart/form-data">
		<div id="top_part_search">
			<div class="headBlock">
				<h4>Поиск товара по артиклу</h4>
			</div>
<span>Введите артикул:</span>
<span>
<?php 
	if(isset($_SESSION['error'])){
	echo $_SESSION['error'];
	}
?>
</span>
		<br>
		<input type="text" 
		value="<?php if(isset($array_bd_id['id_article'])){ echo trim($array_bd_id['id_article']);} ?>" 
		name="id_search" autofocus>
		<br>								
		<button name="button_id" type="submit">Искать</button>
	</div>

	<div id="block1">
		<div class="headBlock">
			<h4 id="left_sdvig">ИНФОРМАЦИЯ О ТОВАРЕ</h4>
		</div>
		<div id="productDescription">
			<span>Название товара:</span>
			<br>
			<br>
			<input type="text" value="<?php if( isset($array_bd_id['product_name']) ){ echo trim($array_bd_id['product_name']);} ?>" name="name_product" required>
			<br>
			<br>
			<br>
			<span>Цена: руб.</span>
			<br>
			<br>
			<input type="text" value="<?php if( isset($array_bd_id['price']) ){ echo trim($array_bd_id['price']);} ?>" name="price" required>
			<br>
			<br>
			<br>
			<span>Описание товара:</span>
			<br>
			<br>
			<textarea name="specification" required><?php if( isset($array_bd_id['specification']) ){ echo trim($array_bd_id['specification']);} ?></textarea>
		</div>
		
		<div id="badge">
			<span>Бейджик:</span>
			<br>
			<br>
			<label>
				<span <?php if( (isset($array_bd_id['badge'])) && ($array_bd_id['badge']==="absent" ) ){ echo 'class="active_check"';}else{ echo 'class="passive_check"';} ?> id="check_1" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="badge" id="absent" value="absent" checked>&nbsp;<i>Отсутствует</i>
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['badge'])) && ($array_bd_id['badge']==="new" ) ){ echo 'class="active_check"';}else{ echo 'class="passive_check"';} ?> id="check_2" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="badge" id="new" value="new">&nbsp;<i>NEW</i>
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['badge'])) && ($array_bd_id['badge']==="hot" ) ){ echo 'class="active_check"';}else{ echo 'class="passive_check"';} ?> id="check_3" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="badge" id="hot" value="hot">&nbsp;<i>HOT</i>
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['badge'])) && ($array_bd_id['badge']==="sale" ) ){ echo 'class="active_check"';}else{ echo 'class="passive_check"';} ?> id="check_4" onClick="rev_elem(event);"></span>
				<input type="radio" class="qwe" name="badge" id="sale" value="sale">&nbsp;<i>SALE</i>
				<br>
				<br>
			</label>
		</div>
		
		<div id="category">
			<span>Категория:</span>
			<br>
			<br>
			<label>
				<span <?php if( (isset($array_bd_id['category_name'])) && ($array_bd_id['category_name']==="snoubord" ) ){ echo 'class="active_check1"';}else{ echo 'class="passive_check1"';} ?> id="snoubord" onClick="rev_elem1(event);"></span>
					<input type="radio" class="qwe1" name="category" id="snoubord" value="snoubord" checked>&nbsp;<i>Сноуборд</i>				
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['category_name'])) && ($array_bd_id['category_name']==="scooter" ) ){ echo 'class="active_check1"';}else{ echo 'class="passive_check1"';} ?> id="scooter" onClick="rev_elem1(event);"></span>
					<input type="radio" class="qwe1" name="category" id="scooter" value="scooter">&nbsp;<i>Самокат</i>				
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['category_name'])) && ($array_bd_id['category_name']==="roller" ) ){ echo 'class="active_check1"';}else{ echo 'class="passive_check1"';} ?> id="roller" onClick="rev_elem1(event);"></span>
					<input type="radio" class="qwe1" name="category" id="roller" value="roller">&nbsp;<i>Роликовые&nbsp;коньки</i>				
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['category_name'])) && ($array_bd_id['category_name']==="tennis" ) ){ echo 'class="active_check1"';}else{ echo 'class="passive_check1"';} ?> id="tennis" onClick="rev_elem1(event);"></span>
					<input type="radio" class="qwe1" name="category" id="tennis" value="tennis">&nbsp;<i>Теннисные&nbsp;ракетки</i>				
				<br>
				<br>
			</label>
			<label>
				<span <?php if( (isset($array_bd_id['category_name'])) && ($array_bd_id['category_name']==="wakeboard" ) ){ echo 'class="active_check1"';}else{ echo 'class="passive_check1"';} ?> id="wakeboard" onClick="rev_elem1(event);"></span>
					<input type="radio" class="qwe1" name="category" id="wakeboard" value="wakeboard">&nbsp;<i>Вейкборд</i>				
			</label>
		</div>
		<br>
		<br>
	</div>
<!--***************2БЛОК******************-->
<div id="block2">
	<div>
		<div class="headBlock">
			<h4>ФОТОГРАФИИ ТОВАРА</h4>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
		</div>
<?php 
if( (isset($array_bd_id['path_file1'])) && ($array_bd_id['path_file1'] != "") ){
   echo '<div class="imgBlock">
			<img src="' . $array_bd_id['path_file1'] . '" alt="не загружено">
			
			<label for="foto1_update">
				<input type="file" class="no_decoration" name="upfile1_up" id="foto1_update" accept="image/png, image/jpeg">
				<br>
				<span class="change center_font_change">Изменить</span>
			</label>				
		<input type="hidden" name="file1" value="'. $array_bd_id['path_file1'] .'">
			<label for="foto1_delete">
				<input type="submit" class="no_decoration" name="foto1_delete" id="foto1_delete" accept="image/png, image/jpeg">
				<br>
				<span class="delete center_font_delete">Удалить</span>
			</label>
		</div>';						
															
	}else{
	echo'<div class="imgBlock">
			<img src="" alt="не загружено">

			<label for="foto1_add">
				<input type="file" class="no_decoration" name="upfile1" id="foto1_add" accept="image/png, image/jpeg">
				<br>
				<span class="add center_font_add">Загрузить</span>
			</label>
		</div>';				
		}	
	 ?>

<?php 
if( (isset($array_bd_id['path_file2'])) && ($array_bd_id['path_file2'] != "") ){
	echo '<div class="imgBlock">
			<img src="' . $array_bd_id['path_file2'] . '" alt="не загружено">

			<label for="foto2_update">
				<input type="file" class="no_decoration" name="upfile2_up" id="foto2_update" accept="image/png, image/jpeg">
				<br>
				<span class="change center_font_change">Изменить</span>
			</label>
		<input type="hidden" name="file2" value="'. $array_bd_id['path_file2'] .'">
			<label for="foto2_delete">
				<input type="submit" class="no_decoration" name="foto2_delete" id="foto2_delete" accept="image/png, image/jpeg">
				<br>
				<span class="delete center_font_delete">Удалить</span>
			</label>
		</div>';	
	}else{		
	echo'<div class="imgBlock">
			<img src="" alt="не загружено">

			<label for="foto2_add">
				<input type="file" class="no_decoration" name="upfile2" id="foto2_add" accept="image/png, image/jpeg">
				<br>
				<span class="add center_font_add">Загрузить</span>
			</label>
		</div>';				
		}	
	 ?>

	<?php 
if( (isset($array_bd_id['path_file3'])) && ($array_bd_id['path_file3'] != "")){
   echo '<div class="imgBlock">
			<img src="' . $array_bd_id['path_file3'] . '" alt="не загружено">

			<label for="foto3_update">
				<input type="file" class="no_decoration" name="upfile3_up" id="foto3_update" accept="image/png, image/jpeg">
				<br>
				<span class="change center_font_change">Изменить</span>
			</label>
		<input type="hidden" name="file3" value="'. $array_bd_id['path_file3'] .'">
			<label for="foto3_delete">
				<input type="submit" class="no_decoration" name="foto3_delete" id="foto3_delete" accept="image/png, image/jpeg">
				<br>
				<span class="delete center_font_delete">Удалить</span>
			</label>
		</div>';	
	
	}else{		
	echo'<div class="imgBlock">
			<img src="" alt="не загружено">

			<label for="foto3_add">
				<input type="file" class="no_decoration" name="upfile3" id="foto3_add" accept="image/png, image/jpeg">
				<br>
				<span class="add center_font_add">Загрузить</span>
			</label>
		</div>';				
		}	
	 ?>
								
<?php 
if( (isset($array_bd_id[10])) && ($array_bd_id['10'] != "")){
   echo '<div class="imgBlock">
			<img src="' . $array_bd_id[10] . '" alt="не загружено">

			<label for="foto4_update">
				<input type="file" class="no_decoration" name="upfile4_up" id="foto4_update" accept="image/png, image/jpeg">
				<br>
				<span class="change center_font_change">Изменить</span>
			</label>
		<input type="hidden" name="file4" value="'. $array_bd_id['path_file4'] .'">
			<label for="foto4_delete">
				<input type="submit" class="no_decoration" name="foto4_delete" id="foto4_delete" accept="image/png, image/jpeg">
				<br>
				<span class="delete center_font_delete">Удалить</span>
			</label>
		</div>';	
	}else{		
	echo '<div class="imgBlock">
			<img src="" alt="не загружено">

			<label for="foto4_add">
				<input type="file" class="no_decoration" name="upfile4" id="foto4_add" accept="image/png, image/jpeg">
				<br>
				<span class="add center_font_add">Загрузить</span>
			</label>
		</div>';				
		}	
	 ?>
		</div>
	</div>

	<!--***************3БЛОК******************-->
	<div id="block3">
		<div>
			<div class="headBlock">
				<h4>ВАРИАЦИИ ТОВАРА</h4>
			</div>
			<div id="bottomInput">
				<input type="text" name="variable1" value="<?php if( isset($array_bd_id['variable1']) ){ echo trim($array_bd_id['variable1']);} ?>">
				<input type="text" class="no_decoration" id="variable1_add" name="variable1_add">&nbsp;
				<label for="variable1_add">
					<span class="delete_variable">Удалить</span>
				</label>
				<br>

				<input type="text" name="variable2" value="<?php if( isset($array_bd_id['variable2']) ){ echo trim($array_bd_id['variable2']);} ?>">
				<input type="text" class="no_decoration" id="variable2_add" name="variable2_add">&nbsp;
				<label for="variable2_add">
					<span class="delete_variable">Удалить</span>
				</label>
				<br>

				<input type="text" name="variable3" value="<?php if( isset($array_bd_id['variable3']) ){ echo trim($array_bd_id['variable3']);} ?>">
				<input type="text" class="no_decoration" id="variable3_add" name="variable3_add">&nbsp;
				<label for="variable3_add">
					<span class="delete_variable">Удалить</span>
				</label>
				<br>
			</div>
		</div>
	</div>
	<div id="save">
		<input type="submit" name="input_submit" value="Добавить новый товар">
	</div>
	<div id="update">
		<input type="submit" name="update" value="Сохранить изменения">
	</div>
	<div id="remove">
		<input type="submit" name="button_delete" value="Удалить товар">
	</div>
</form>
		</section>		
		<script src="js/script.js"></script>		
	</body>
</html>
