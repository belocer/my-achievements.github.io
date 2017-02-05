<?php
//session_start();
// Скрипт изменения статуса товара
echo "php файл";
echo "<pre>";
print_r($_GET);
echo "</pre>"; 

if($_GET['stat'] == 'adopted'){
	$s = 0;
} else if($_GET['stat'] == 'shipped'){
	$s = 1;
} else if($_GET['stat'] == 'do_courier'){
	$s = 2;
} else if($_GET['stat'] == 'delivered'){
	$s = 3;
} else if($_GET['stat'] == 'cancellation'){
	$s = 4;
}

//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());	

	//Создание и выполнение запроса на запись данных в БД
$i = $_GET[th];	
$upd = "UPDATE dbelotserkovets_orders SET status='$s' WHERE order_id='$i'";
$result_insert = pg_query($dbconn, $upd) or die('Ошибка запроса записи: ' . pg_last_error());

	//Очистка результатов
pg_free_result($result_insert);

	//Закрытие соединения
pg_close($dbconn);

?>
