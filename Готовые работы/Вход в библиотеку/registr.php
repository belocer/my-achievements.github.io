<?php session_start (); 
$sms     =   '';
$i			= "infoUser.csv";
	
if($surname == " ")   {$surname=null;}	
if($name == " ")      {$name=null;}	
if($patronymic == " "){$patronymic=null;}	
if($login == " ")     {$login=null;}		
if($pass1 == " ")     {$pass1=null;}	
if($pass2 == " ")     {$pass2=null;}	
if($email == " ")     {$email=null;}

//Чек боксы для понятной записи
if($_SESSION["all_info"]==="on"){$_SESSION["all_info"]="all_info";}
if($_SESSION["new_book"]==="on"){$_SESSION["new_book"]="new_book";}
if($_SESSION["not_info"]==="on"){$_SESSION["not_info"]="not_info";}		


//Если не указан пол
if (($_SESSION["sex"]!=="male") && ($_SESSION["sex"]!=="female")){
	$sms = '<span style="color: Gray;"><em> Не заполнено</em></span>';
}	

//Если не указаны уведомления
$notification = $_SESSION["all_info"] . $_SESSION["new_book"] . $_SESSION["not_info"];
if ($notification==''){
	$notification = '<span style="color: Gray;"><em> Не заполнено</em></span>';
}elseif($notification!=''){
	$notification='';
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lesson 14</title>
	<link rel="stylesheet" href="media/assets/style.css">
	<link rel="stylesheet" href="media/assets/jquery.formstyler.css">
	</head>
<body>
	<div id="wrapper">
	<div id="left"><img src="image/1.jpg" alt="Книга"></div>
<div id="war">
	<?php 
	echo "<strong style='color: red;'>" . $_SESSION['errorLogin']. "</strong><br>";
	echo "<strong style='color: red;'>" . $_SESSION['errorMail']. "</strong><br>";
	?>
</div>
<div id="centr">
	<form id="myform" action="inspect.php" method="GET">
		<table>
			<tr><td colspan="2" id="tabl"><h3 style=" color: green;">Регистрация нового читателя в библиотеке:</h3>
			<tr><td>Фамилия: 				<td><?php
						    	if(strlen($_SESSION["surname"])<1){
                                          echo '<input class="styler" type=text name="surname" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
									  }else{
                                          echo '<input class="styler" type=text name="surname" value="' . $_SESSION["surname"] . '">';
									  }
						   ?>
			<tr><td>Имя:         			<td><?php
						    	if(strlen($_SESSION["name"])<1){
                                          echo '<input class="styler" type=text name="name" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
									  }else{
                                          echo '<input class="styler" type=text name="name" value="' . $_SESSION["name"] . '">';
									  }
						   ?>
			<tr><td>Отчество: 				<td><?php
						    	if(strlen($_SESSION["patronymic"])<1){
                                          echo '<input class="styler" type=text name="patronymic" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
									  }else{
                                          echo '<input class="styler" type=text name="patronymic" value="' . $_SESSION["patronymic"] . '">';
									  }
						   ?>
			<tr><td>Логин: 					<td><?php
						    	if(strlen($_SESSION["login"])<1){
                                         echo '<input class="styler" type=text name="login" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
								  	  }else{
                                         echo '<input class="styler" type=text name="login" value="' . $_SESSION["login"] . '">';
								  	  }
						  ?>
			<tr><td>Пароль: 				<td><?php
						    	if(strlen($_SESSION["pass1"])<1){
                                         echo '<input class="styler" type=password name="pass1" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
								  	  }else{
                                         echo '<input class="styler" type=password name="pass1" value="' . $_SESSION["pass1"] . '">';
								  	  }
						  ?>
			<tr><td>Подтверждение пароля: 	<td><?php
						    	if(strlen($_SESSION["pass2"])<1){
                                         echo '<input class="styler" type="password" name="pass2" style="color: Gray; font-style: italic;" placeholder="Не заполнено">';
								  	  }else{
                                         echo '<input class="styler" type="password" name="pass2" value="' . $_SESSION["pass2"] . '">';
								  	  }
								if ($_SESSION["pass1"] != $_SESSION["pass2"]){
                                                    echo '<div style="color: red">Пароли не совпадают!</div>';
									  }
						  ?>
						  
			<tr><td>Пол:<? echo $sms; ?>
				<td><input type=radio name="sex" <?php if ($_SESSION["sex"]==="male")  {echo "checked";}?> value="male">  Мужской
					<input type=radio name="sex" <?php if ($_SESSION["sex"]==="female"){echo "checked";}?> value="female">Женский
					
					
			<tr><td>Ваш e-mail: <td><?php
								if(strlen($_SESSION["email"])<1){
                                         echo '<input class="styler" type=email name=email style="font-style: italic;" placeholder="Не заполнено">';
								  	  }else{
                                         echo '<input class="styler" type="email" name="email" value="'. $_SESSION["email"] . '">';
									}
						  ?>
			
			<tr><td>Какую информацию Вы<br>хотели бы получать на e-mail:&nbsp;&nbsp;&nbsp;<?php echo $notification; ?>
				<td><input class="styler" type="checkbox" name="all_info" <?php if($_SESSION["all_info"]==="all_info"){echo "checked";}?>>Всю информацию<br>
					<input class="styler" type="checkbox" name="new_book" <?php if($_SESSION["new_book"]==="new_book"){echo "checked";}?>>Информацию о новых книгах<br>
					<input class="styler" type="checkbox" name="not_info" <?php if($_SESSION["not_info"]==="not_info"){echo "checked";}?>>Не получать информацию
					
			<tr><td>Дата Вашего рождения:
                <?php
		$date_with = $_SESSION["day"] . $_SESSION["month"] . $_SESSION["year"];
		$dt ="1Январь1945";
		if($date_with == $dt){
			echo '<p><span style="color: Gray; font-style: italic;">Не заполнено</span></p>';
				}										
?>
<td>День:&nbsp;&nbsp;&nbsp;
<select name="day">
		<option value="1"><?php if(empty($_SESSION["day"])){echo 1;}else{echo $_SESSION["day"];}?></option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
</select>
		<br>Месяц:
<select name="month">
		<option value="Январь">   <?php if(empty($_SESSION["month"])){echo "Январь";}else{echo $_SESSION["month"];}?></option>
		<option value="Февраль">	Февраль</option>
		<option value="Март">		Март</option>
		<option value="Апрель">	 	Апрель</option>
		<option value="Май">	 	Май</option>
		<option value="Июнь">	 	Июнь</option>
		<option value="Июль">	 	Июль</option>
		<option value="Август">	 	Август</option>
		<option value="Сентябрь">   Сентябрь</option>
		<option value="Октябрь">  	Октябрь</option>
		<option value="Ноябрь">	 	Ноябрь</option>
		<option value="Декабрь">  	Декабрь</option>
</select>
		<br>Год:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="year">
		<option value="1945"><?php if(empty($_SESSION["year"])){echo 1945;}else{echo $_SESSION["year"];}?></option>
		<option value="1946">1946</option>
		<option value="1947">1947</option>
		<option value="1948">1948</option>
		<option value="1949">1949</option>
		<option value="1950">1950</option>
		<option value="1951">1951</option>
		<option value="1952">1952</option>
		<option value="1953">1953</option>
		<option value="1954">1954</option>
		<option value="1955">1955</option>
		<option value="1956">1956</option>
		<option value="1957">1957</option>
		<option value="1958">1958</option>
		<option value="1959">1959</option>
		<option value="1960">1960</option>
		<option value="1961">1961</option>
		<option value="1962">1962</option>
		<option value="1963">1963</option>
		<option value="1964">1964</option>
		<option value="1965">1965</option>
		<option value="1966">1966</option>
		<option value="1967">1967</option>
		<option value="1968">1968</option>
		<option value="1969">1969</option>
		<option value="1970">1970</option>
		<option value="1971">1971</option>
		<option value="1972">1972</option>
		<option value="1973">1973</option>
		<option value="1974">1974</option>
		<option value="1975">1975</option>
		<option value="1976">1976</option>
		<option value="1977">1977</option>
		<option value="1978">1978</option>
		<option value="1979">1979</option>
		<option value="1980">1980</option>
		<option value="1981">1981</option>
		<option value="1982">1982</option>
		<option value="1983">1983</option>
		<option value="1984">1984</option>
		<option value="1985">1985</option>
		<option value="1986">1986</option>
		<option value="1987">1987</option>
		<option value="1988">1988</option>
		<option value="1989">1989</option>
		<option value="1990">1990</option>
		<option value="1991">1991</option>
		<option value="1992">1992</option>
		<option value="1993">1993</option>
		<option value="1994">1994</option>
		<option value="1995">1995</option>
		<option value="1996">1996</option>
		<option value="1997">1997</option>
		<option value="1998">1998</option>
		<option value="1999">1999</option>
		<option value="2000">2000</option>
		<option value="2001">2001</option>
		<option value="2002">2002</option>
		<option value="2003">2003</option>
		<option value="2004">2004</option>
		<option value="2005">2005</option>
		<option value="2006">2006</option>
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
</select>
	<tr><td>Дополнительная информация:<td><?php 
									if(strlen($_SESSION["about_me"])<1){
                                         echo '<textarea class="styler" rows="5" cols="30" name="about_me" style="font-style: italic;" placeholder="Не заполнено"></textarea>';
								  	  }else{
                                         echo '<textarea class="styler" rows="5" cols="30" name="about_me">'. $_SESSION["about_me"] . '</textarea>';
									}
											?>
	<tr><td colspan="2" id="tabl2"><input class="styler" type="submit" value="Зарегистрироваться" name="registration" id="but">
		</table>
		</form>
	</div>	
<div id="right"><img src="image/2.jpg" alt="Книга"></div>
	<div id="bender">
	<h3 style=" color: green;">Вход для зарегистрированных пользователей:</h3>
	<?php echo "<storng style='color: #BE3F70'>" . $_SESSION['Danger'] . "</storng><br>";?>
		<form action="logged.php" method="POST">
			<input class="styler" type="text" placeholder="Логин" name="logg" title="Введите логин зарегистрированного пользователя" required><br>
			<input class="styler" type="password" placeholder="Пароль" name="pass" title="Введите пароль зарегистрированного пользователя" required><br><br>
			<input class="styler" type="submit" value="ВХОД" name="logged">
		</form>
	</div>
</div>
<br>
<br>
<br>
	<script src="media/assets/jquery.formstyler.min.js" defer></script>
	<script src="media/js/core.js" defer></script>
	<script src="media/js/script.js" defer></script>
</body>
</html>