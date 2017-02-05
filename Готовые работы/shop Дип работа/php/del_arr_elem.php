<?php
/*  

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<pre> GET ";
print_r($_GET);
echo "</pre>"; */
/////////////////////////////////////////////*************************
// Запись транзакции добавление товара в корзину ---->
if( isset($_SESSION['buy_article']) ) {
	
	// Запись в БД таблица transaction
// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$article_id = $_SESSION['buy_article'];
if( isset($_SESSION['users_id']) ) { $user_id = $_SESSION['users_id'];}else{$user_id = 0;}
$insert_to = "INSERT INTO dbelotserkovets_transaction(users_id, article_id, date_time) VALUES ('$user_id', '$article_id', NOW());";
pg_query($dbconn, $insert_to) or die('Ошибка запроса записи: ' . pg_last_error());	
	
}
																						//*******// Отнимаю минусом
if( isset($_GET['id_article']) && ($_SESSION['arr_cart'][$_GET['nums']]['qty'] > 1) ){	
	
$article_id = $_GET['id_article'];
unset($_GET['id_article']);

	// Соединение сервером БД, и выбор БД
	$dbconn = pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
	$select_id = "SELECT price FROM dbelotserkovets_product WHERE id_article = '$article_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd_id = pg_fetch_array($result_select_id);

	$array_bd_id['surprice'] = str_replace(" ", "", $array_bd_id['price']);
			
	$_SESSION['qty_res'] = ($_SESSION['qty_res'] - 1); // Уменьшаю на один общее количество товара
	$_SESSION['arr_cart'][$_GET['nums']]['qty'] = ($_SESSION['arr_cart'][$_GET['nums']]['qty'] - 1); // Уменьшаю на один кол
	$_SESSION['arr_cart'][$_GET['nums']]['price_res'] = ($_SESSION['arr_cart'][$_GET['nums']]['price_res'] - $array_bd_id['surprice']); // Уменьшаю на один кол
	$_SESSION['pin'] = $_SESSION['pin'] - $array_bd_id['surprice']; // Отнимаю цену товара от общей суммы
	//unset($_SESSION['arr_cart'][$_GET['nums']]);
	//if( $_SESSION['qty_res']===0 ){unset($_SESSION["arr_cart"]);unset($_SESSION['arr_cart'][$_GET['nums']]);} // В случае если в корзине 0 товаров, удаляю переменную в которой они все были
	unset($_GET);
	unset($array_bd_id);
	unset($article_id);
		// Очистка результатов
	pg_free_result($result_select_id);
		// Закрытие соединения
	pg_close($dbconn);
													// Если остался одна единица товара и нажать минус
}else if( isset($_GET['id_article']) && ($_SESSION['arr_cart'][$_GET['nums']]['qty'] == 1 ) ){
		
		if( (isset($_SESSION['arr_cart'])) && (!empty($_SESSION['arr_cart'])) ){
			
		$_SESSION['qty_res'] = $_SESSION['qty_res'] - 1; // Уменьшаю общее колличество товара
		$_SESSION['pin'] = $_SESSION['pin'] - $_SESSION['arr_cart'][$_GET['nums']]['price_res']; // Уменьшаю общую сумму
		$_SESSION['arr_cart'][$_GET['nums']];
		unset($_SESSION['arr_cart'][$_GET['nums']]);	
		unset($_GET); 	// Удаляю переменную			 
		}		
	}


																					//*******// Добавляю плюсом
if( isset($_GET['bid_article']) ){

$article_id = $_GET['bid_article'];
unset($_GET['bid_article']);

	// Работа с БД
	$dbconn = pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
	$select_id = "SELECT price FROM dbelotserkovets_product WHERE id_article = '$article_id';";
	$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
	$array_bd_id = pg_fetch_array($result_select_id);

	$array_bd_id['price'] = str_replace(" ", "", $array_bd_id['price']);

	if(!isset($_SESSION['arr_cart'][$_GET['numsplus']]['price_res'])){$_SESSION['arr_cart'][$_GET['numsplus']]['price_res']=$array_bd_id['price'];}
			
	$_SESSION['pin'] = $_SESSION['pin']+$array_bd_id['price'];
	$_SESSION['arr_cart'][$_GET['numsplus']]['qty'] = $_SESSION['arr_cart'][$_GET['numsplus']]['qty'] + 1; // Добавляю на один общее количество товара
	$_SESSION['arr_cart'][$_GET['numsplus']]['price_res'] = $_SESSION['arr_cart'][$_GET['numsplus']]['price_res'] + $array_bd_id['price']; // Добавляю на один общее количество товара
	$_SESSION['qty_res'] += 1; // Добавляю на один общее количество товара
	unset($article_id);
	unset($array_bd_id);
	unset($_GET);
		// Очистка результатов
	pg_free_result($result_select_id);
		// Закрытие соединения
	pg_close($dbconn);
}

/////////////////////////////////////////////*************************

if( $_SESSION['pin'] <= 0 ) { $_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0; }
if(isset($_SESSION['arr_cart']) <= 0){$_SESSION['qty_res'] = 0; $_SESSION['pin'] = 0;}


						// Удаление элемента из корзины и массива
if(isset($_POST['btn_del'])){
	
	if( (isset($_SESSION['arr_cart'])) && (!empty($_SESSION['arr_cart'])) ){
			
		$exp = explode("|", $_POST['btn_del']); /* Разбиваю значение инпута на |, $exp[0]-это порядковый номер товара лежащего в $_SESSION["arr_cart"]
												$exp[1] это цена товара там же лежащего */
		
		$_SESSION['qty_res'] = $_SESSION['qty_res']-$_SESSION['arr_cart'][$exp[0]]['qty']; // Уменьшаю общее колличество товара
		$_SESSION['pin'] = $_SESSION['pin']-$_SESSION['arr_cart'][$exp[0]]['price_res']; // Уменьшаю общую сумму
			
		unset($_SESSION["sum_res"][$exp[0]]); // Удаляю из сессии товар
		unset($_SESSION["sum"][$exp[0]]); 
		unset($_SESSION["arr_cart"][$exp[0]]); 
		unset($_POST['btn_del']); // Удаляю переменную	
		unset($_GET);		 
	}	
}

if(isset($_SESSION['pin']) && ($_SESSION['pin'] <= 0) ){
		unset($_SESSION["sum_res"]); // Удаляю из сессии товар
		unset($_SESSION["sum"]); // Удаляю из сессии товар
}

						//// Поиск товара по id и добавление его в корзину!!!!!!!!!!!!!!

if( isset($_SESSION['buy_article'])  ){	
$article_id = $_SESSION['buy_article'];		 
	// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_id = "SELECT id_article, path_file1, product_name, price FROM dbelotserkovets_product WHERE id_article = '$article_id';";
$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_id = pg_fetch_array($result_select_id);
														// Подсчет количества
if( isset($_SESSION['buy_article']) ){                           // Первый раз в корзине с выбранным товаром
	
			// Если $_SESSION['arr_cart'] не массив сделать его таковым
	if(isset($_SESSION['arr_cart']) && !is_array($_SESSION['arr_cart'])){ $_SESSION['arr_cart']=array(); }	
	
	$array_bd_id['qty'] = 1;
	$price = str_replace(" ", "", $array_bd_id['price']); // Удаляю пробел
	$price = (integer) $price;
	$array_bd_id['price_res'] = $price * $array_bd_id['qty'];
	$_SESSION['arr_cart'][$array_bd_id['id_article']] = $array_bd_id;	
	$_SESSION['pin'] += $price;
	
		// Подсчитываю колличество	
if( isset($_SESSION['qty_res']) ){ ++$_SESSION['qty_res']; } else if( $_SESSION['qty_res'] === 0 ) { $_SESSION['qty_res'] = 1; }
	
				// Удалит одинаковые массивы в многомерном массиве
	$_SESSION['arr_cart'] = array_map("unserialize", array_unique(array_map("serialize",$_SESSION['arr_cart'])));
			// Удалит пустые массивы в многомерном массиве
	if( empty($_SESSION['arr_cart'][0]) ){unset($_SESSION['arr_cart'][0]);}

}
			
		// Удаляю переменную что бы при обновлении еще раз не добавлялся товар
	unset($_SESSION['buy_article']);
	unset($article_id);		
		// Очистка результатов
	pg_free_result($result_select_id);
	unset($array_bd_id);
	
}

if( !isset($_SESSION['buy_article']) && isset($_GET['article_id']) ){	
$article_id = $_GET['article_id'];		 
	// Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());
$select_id = "SELECT id_article, path_file1, product_name, price FROM dbelotserkovets_product WHERE id_article = '$article_id';";
$result_select_id = pg_query($dbconn, "$select_id") or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd_id = pg_fetch_array($result_select_id);
														// Подсчет количества
if( isset($_SESSION['buy_article']) ){                           // Первый раз в корзине с выбранным товаром
	
			// Если $_SESSION['arr_cart'] не массив сделать его таковым
	if(isset($_SESSION['arr_cart']) && !is_array($_SESSION['arr_cart'])){ $_SESSION['arr_cart']=array(); }	
	
	$array_bd_id['qty'] = 1;
	$price = str_replace(" ", "", $array_bd_id['price']); // Удаляю пробел
	$price = (integer) $price;
	$array_bd_id['price_res'] = $price * $array_bd_id['qty'];
	$_SESSION['arr_cart'][$array_bd_id['id_article']] = $array_bd_id;	
	$_SESSION['pin'] += $price;
	
		// Подсчитываю колличество	
if( isset($_SESSION['qty_res']) ){ ++$_SESSION['qty_res']; } else if( $_SESSION['qty_res'] === 0 ) { $_SESSION['qty_res'] = 1; }
	
				// Удалит одинаковые массивы в многомерном массиве
	$_SESSION['arr_cart'] = array_map("unserialize", array_unique(array_map("serialize",$_SESSION['arr_cart'])));
			// Удалит пустые массивы в многомерном массиве
	if( empty($_SESSION['arr_cart'][0]) ){unset($_SESSION['arr_cart'][0]);}

}
			
		// Удаляю переменную что бы при обновлении еще раз не добавлялся товар
	unset($_SESSION['buy_article']);
	unset($article_id);		
		// Очистка результатов
	pg_free_result($result_select_id);
	unset($array_bd_id);
	
}		
?>
