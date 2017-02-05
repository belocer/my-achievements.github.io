<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('error_repoting', E_ALL);
	ini_set('display_errors', 1);

/* if( $_SESSION['online']	!== 2  ){
	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	header('Location: ../index.php');
		exit;
} */

	//Выборка БД
//Соединение сервером БД, и выбор БД
$dbconn=pg_connect("host=localhost dbname=twi2_sql user=postgres password=330117") or die('Нет соединения с сервером PostgreSQL: ' . pg_last_error());

$select_id = "SELECT * FROM dbelotserkovets_users LIMIT 30";
$result_select_id = pg_query($dbconn, $select_id) or die('Ошибка запроса поиска записи: ' . pg_last_error());
$array_bd = pg_fetch_all($result_select_id);

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="CSS/usersStyle.css">
	<link rel="stylesheet" href="CSS/fonts.css">
		<!--[if lt IE9] <script src="//html5shivgooglecode.com/svn/trunk/html5.js"></script>
<[!endif]-->
</head>
<body>
<section>

<!--************************NAV MENU****************************-->
	<nav>
		<ul>
			<li><a id="label" href="index.php"><img src="image/label.jpg" alt="label"></a></li>
			<li><a href="index.php"><img src="image/cartA.png" alt="cartA"><span>ЗАКАЗЫ</span></a></li>
			<li><a href="users.php"><img src="image/avaUsersGreen.png" alt="avaUsers"><span>ПОЛЬЗОВАТЕЛИ</span></a></li>
			<li><a href="items.php"><img src="image/truck.png" alt="truck"><span>ТОВАРЫ</span></a></li>
			<li><a href="category.php"><img src="image/circles.png" alt="circles"><span>СТАТИСТИКА</span></a></li>
		</ul>
		<div id="goOut">
			<div>admin@mail.ru</div>
			<a href="logout.php?get_out=out_man">выйти</a>
		</div>
	</nav>
	<div>

	<!--*********************************TABLE**********************************-->
	<div id="aboveTheTable">
		<h1>ПОЛЬЗОВАТЕЛИ</h1>
	</div>
		<div id="topPart">
			<table>
				<tr class="headTable">
					<th class="headTable" id="headTable">ИМЯ</th>
					<th class="headTable" id="headTable">E-mail</th>
					<th class="headTable" id="headTable" colspan="2">ТЕЛЕФОН</th>
				</tr>
				<tbody>
					<form action="userInformation.php" method="GET">
						<?php
							foreach($array_bd as $key => $value){
									echo '<tr>';

										echo '<td>';
										$fi = explode(' ', $value['fio']);
										//var_dump($fi);
										
										if( count($fi)<2 ){
											echo '<span>' . $value['fio'] . '</span>';
											}else{
											echo '<span>' . $fi[0] . ' ' . $fi[1] . '</span>';
										}
										
										echo '</td>';

										echo '<td>';
										echo '<span>' . $value['email'] . '</span>';
										echo '</td>';

										echo '<td>';
										echo '<span class="tel">' . $value['telefone'] . '</span>';
										echo '</td>';

										echo '<td><a href="userInformation.php?id='.$value['id'].'">просмотр</a></td>';

									echo '</tr>';
							}
						?>
					</form>
				</tbody>
			</table>
		</div>
	</div>
</section>
<body>
</html>
