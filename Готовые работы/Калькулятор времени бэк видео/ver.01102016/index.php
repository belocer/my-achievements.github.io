<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Калькулятор времени</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="media/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/javascript.js"></script>
  <script src="jquery.maskedinput.js" type="text/javascript"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
    });
  $.datepicker.setDefaults($.datepicker.regional['ru']);
  
  jQuery(function($){
   $("#timeInput").mask("99:99:99");

});
  </script>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>

<div id="content">
     <h1 class>Калькулятор времени</h1>
     <br>
  <form action="index.php" method="POST">  
    Дата отсчета:<br> <input type="text" id="datepicker" size="25" name="dayMonthYear" placeholder="<?php echo date('d-m-Y');?>" ><br><br>
	Колличество дней:<br> <input type="text" name="day" placeholder="Введите дни"><br><br>
    Колличество часов:<br> <input type="text" name="hour" placeholder="Введите часы"><br><br>
    Колличество минут:<br> <input type="text" name="minute" placeholder="Введите минуты"><br><br>
    Колличество секунд:<br> <input type="text" name="second" placeholder="Введите секунды"><br><br>
    <input type="submit" name="button"  class="btn btn-ttc" value="Посчитать"><br><br>
  </form>

Результат:

<h1 id="result" class="jumbotron container">
  <?php
  //Сбор инфы из полей инпут
    $day = $_POST['day'];
    $hour = $_POST['hour'];
    $minute = $_POST['minute'];
    $second = $_POST['second'];
    $date = date_create($_POST['dayMonthYear']);
    date_add($date, date_interval_create_from_date_string("$day days + $hour hours + $minute minutes + $second seconds"));
    echo date_format($date, 'd-m-Y H:i:s');
  ?>
</h1>

<form action="index.php" method="POST">
   	
   	<div class="container">
   	<h2>&#1050;&#1054;&#1052;&#1045;&#1053;&#1058;&#1040;&#1056;&#1048;&#1048;</h2>
   	<a name="comment"></a>	
   <div class="form-group col-xs-4">
    <label class="sr-only" for="exampleInputEmail2">&#1048;&#1084;&#1103;</label>
    <input type="text" class="form-control" placeholder="&#1048;&#1084;&#1103;" name="name">
  </div>
   		<textarea class="form-control" rows="3" placeholder="&#1058;&#1077;&#1082;&#1089;&#1090; &#1082;&#1086;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1103;" name="coment"></textarea><br>
   		 <button type="submit" class="btn btn-primary" name="go">&#1054;&#1090;&#1087;&#1088;&#1072;&#1074;&#1080;&#1090;&#1100;</button>
   	</div>
   	
   </form>
   
   <br> 
   <hr class="featurette-divider">
   <br>

<h3 id="msk" class="jumbotron container"> <span>Время</span> 
  <script>
  "use strict";
		var output = setTimeout(function printTime() {
		var now = new Date();

		var min = now.getMinutes();

		  if (min < 10) min = "0" + min;

		var hh = now.getHours();
		  if (hh < 10) hh = "0" + hh;

		var sec = now.getSeconds();
		  if (sec < 10) sec = "0" + sec;

		var time = hh + ":" + min + ":" + sec;

		  document.getElementById("time").innerHTML = "<h4 class=msk>" + time + "<br>" + "Дата" + "<br>" + "<?php echo date('d-m-Y');?>" +"</h4>";

		  output = setTimeout(printTime, 1000);
		}, 1000)
  </script>
  
<div id="time"></div>
  </h3>
  <div class="container"> 
  <?php
$i="coment.csv";
$x='';	   
$myArrDanger = array();
//Поиск и замена переносов на пробелы)))
$string = $_POST["coment"];
$_POST["coment"] = preg_replace("/\r\n|\n/", ' ', $string);
 
							
$myarr=array($_POST["coment"], $_POST["name"]);

							
$x = fopen("coment.csv","a+");
$filename = 'coment.csv';

							
if (file_exists($filename)) {
	//echo "<br><h4 style='color: green;'>coment.csv &#1089;&#1086;&#1079;&#1076;&#1072;&#1085;!</h4>";
} else {
    echo "<br>&#1060;&#1072;&#1081;&#1083; 'coment.csv' &#1085;&#1077; &#1089;&#1086;&#1079;&#1076;&#1072;&#1085;!<br>";
}	

if($x===false){
	echo "<h1 style='color: red;'>&#1060;&#1072;&#1081;&#1083; &#1085;&#1077; &#1089;&#1086;&#1079;&#1076;&#1072;&#1085;</h1>";
	}

								
if(is_writable("coment.csv")){
	//echo '<br><h4 style="color: green;">coment.csv &#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1077;&#1085; &#1076;&#1083;&#1103; &#1079;&#1072;&#1087;&#1080;&#1089;&#1080;!</h4>';
}else{
	echo '<br>coment.csv <h1 style="color: red;">&#1053;&#1045; &#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1077;&#1085; &#1076;&#1083;&#1103; &#1079;&#1072;&#1087;&#1080;&#1089;&#1080;!</h1>';
}


if((strlen($_POST['name'])>3) && (strlen($_POST['coment'])>3)){	
							
fputcsv($x,$myarr);

	}								
								//&#1042;&#1099;&#1074;&#1086;&#1076;&#1080;&#1084; &#1074; &#1073;&#1088;&#1072;&#1091;&#1079;&#1077;&#1088; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1080;&#1079; &#1092;&#1072;&#1081;&#1083;&#1072;
	   
$infor = file($i);
	if($infor===false)
	{
		echo "&#1053;&#1077; &#1084;&#1086;&#1075;&#1091; &#1087;&#1088;&#1086;&#1095;&#1080;&#1090;&#1072;&#1090;&#1100; &#1080;&#1079; &#1092;&#1072;&#1081;&#1083;&#1072;";
	}
	
$a = $_POST["name"];
for($n = 0; ($infor[$n]); $n++)
{
	echo $a . '<div class=jumbotron><p>' . $infor[$n] . '</p></div>';
}
	
fclose($x);


if(isset($_POST['go']))
{	
	unset($_POST['name']);	
	unset($_POST['coment']);
	unset($_SESSION);
	session_unset ();
}	   
	   
?>
 </div>
   <!--***********************************ПОДВАЛ*************************************-->
		<footer class="footer">
			<div class="line"></div>
			<br> 
			  <br> 
			  <br>
			<address>&reg;"Date-Time"<br>
			2010 - <?php echo date('Y');?></address>
				  <br> 
			  <br> 
			  <br>
		</footer>
  
</div>
  </body>
</html>