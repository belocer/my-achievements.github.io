<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Format date</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="media/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/javascript.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
    });
  $.datepicker.setDefaults($.datepicker.regional['ru']);
  </script>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="homepage-hero-module">
    <div class="video-container">
        <div class="filter"></div>
        <video autoplay loop class="fillWidth">
            <source src="video/Love-Coding.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
            <source src="video/Love-Coding.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
      </div>
</div>
<div id="content">
     <h1 class>Калькулятор времени</h1>
     <br>
  <form action="index.php" method="POST">  
    Дата отсчета:<br> <input type="text" id="datepicker" size="30" name="dayMonthYear" placeholder="Дата отсчета"><br><br>
    Колличество дней:<br> <input type="text" name="day" placeholder="Колличество дней"><br><br>
    Колличество часов:<br> <input type="text" name="hour" placeholder="Колличество часов"><br><br>
    Колличество минут:<br> <input type="text" name="minute" placeholder="Колличество минут"><br><br>
    Колличество секунд:<br> <input type="text" name="second" placeholder="Колличество секунд"><br><br>
    <input type="submit" name="button"  class="btn btn-ttc" value="Посчитать"><br><br>
  </form>

Результат:

<h1 id="result" class="jumbotron container">
  <?php
    $day = $_POST['day'];
    $hour = $_POST['hour'];
    $minute = $_POST['minute'];
    $second = $_POST['second'];
    $date = date_create($_POST['dayMonthYear']);
    date_add($date, date_interval_create_from_date_string("$day days + $hour hours + $minute minutes + $second seconds"));
    echo date_format($date, 'd-m-Y H:i:s');
  ?>
</h1>
<br>
<br>
  <h3 id="msk" class="jumbotron container"> <span>Московское время</span> <script>
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

  document.getElementById("time").innerHTML = "<h4 class=msk>" + time + "<br>" +"<?php echo date('d-m-Y');?>" +"</h4>";

  output = setTimeout(printTime, 1000);
}, 1000)
  </script>
<div id="time"></div>
  </h3>
  
</div>
    	 

   
   <br>
   <!--***********************************ПОДВАЛ*************************************-->
    <footer>
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
  </body>
</html>