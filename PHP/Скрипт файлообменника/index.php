<?
$site = 'http://v2.oposter.ru'; // слеш в конце домена не нужен. Если скрипт стоит в корне, пишем: http://yousite.ru, если в папке, пишем: http://yousite.ru/papka
$name = 'Загрузчик';            // Название сайта
$folder = 'files32';              // Папка куда будут заливатся файлы

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// ДАЛЕЕ НЕ МИНЯЕМ НИ ЧЕГО ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$today = date('d-m-Y');
if($_GET['o'] !== NULL AND $_GET['o'] !== '' AND $_GET['action'] == 'download') {
	$file = ''.$folder.'/'.$_GET['date'].'/'.$_GET['rand'].'/'.$_GET['o'].'';
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
if($_GET['o'] !== NULL AND $_GET['o'] !== '') {
	$url = ''.$folder.'/'.$_GET['date'].'/'.$_GET['rand'].'/'.$_GET['o'].'';
	if(file_exists($url)) {
		$message = '
		<div class="caption lfl stl rev-title-sub" data-x="center" data-y="190" data-speed="800" data-start="1100" data-easing="easeOutExpo">
		<a>'.$_GET['o'].'</a><br>Сcылка для скачивания<br>
		<input class="col-xs-12 col-sm-12 col-md-8 url" type="text" name="name" value="'.$site.'/file/'.$_GET['date'].'/'.$_GET['rand'].'/'.$_GET['o'].'">
		</div>
		<div class="caption lfl stl rev-title-sub2" data-x="center" data-y="360" data-speed="800" data-start="1100" data-easing="easeOutExpo">
			<a class="btn btn-primary btn-custom btn-rounded" href="'.$site.'/file/'.$_GET['date'].'/'.$_GET['rand'].'/'.$_GET['o'].'&action=download">СКАЧАТЬ</a>
		</div>';
	} else {
		$message = '
		<div class="caption lfl stl rev-title-sub" data-x="center" data-y="190" data-speed="800" data-start="1100" data-easing="easeOutExpo">
		Вы собирались скачать<br><a>'.$_GET['o'].'</a><br>который отсутствует на сервере
		</div>
		';
	}
}
if ($_FILES['file']['name'] !== NULL)
{
$rand = rand(100000,999999);
if(!file_exists(''.$folder.'/'.$today.'')) { mkdir(''.$folder.'/'.$today.'', 0777); }
if(!file_exists(''.$folder.'/'.$today.'/'.$rand.'')) { mkdir(''.$folder.'/'.$today.'/'.$rand.'', 0777); }
if(move_uploaded_file($_FILES["file"]["tmp_name"], ''.$folder.'/'.$today.'/'.$rand.'/'.$_FILES['file']['name'].'')) 
	{
		header("Location: ".$site."/file/".$today."/".$rand."/".$_FILES['file']['name'].""); exit();
	}
	else
	{
		header("Location: ".$site.""); exit();
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title><? if($_GET['o'] == NULL OR $_GET['o'] == '') { echo $name; } else { echo 'Скачать '.$_GET['o'].''; } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<? echo $site; ?>/inc/css/css-family=Lato-400,700,300.css" rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="<? echo $site; ?>/inc/css/css-family=Lato.css">
	<link href="<? echo $site; ?>/inc/css/css-family=Lato-400.css">
	<link href="<? echo $site; ?>/inc/css/css-family=Lato-700.css">
	<link href="<? echo $site; ?>/inc/css/css-family=Lato-300.css">
<![endif]-->
<link href="<? echo $site; ?>/inc/css/bootstrap.css" rel="stylesheet">
<link href="<? echo $site; ?>/inc/css/theme.css" rel="stylesheet">
<link href="<? echo $site; ?>/inc/css/settings.css" rel="stylesheet" type="text/css"/>
<!--[if lt IE 9]>
<script src="<? echo $site; ?>/inc/css/html5.js"></script>
<![endif]-->
<style>
body{ background-color: #f0f0f0!important;  margin-bottom: 0px!important; }

</style>
</head>
  <body>
	<div class="fullwidthbanner-container">
		<div class="fullwidthbanner">
			<ul>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="700" >
				<img src="<? echo $site; ?>/inc/img/slider2.jpg" alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
				<div class="tp-caption lfr" data-x="left" data-y="220" data-speed="2400" data-start="800" data-easing="easeOutExpo">
					<img src="<? echo $site; ?>/inc/img/robot.png" alt="" />
				</div>
				<div class="tp-caption lfb" data-x="920" data-y="0" data-speed="1400" data-start="1800" data-easing="easeOutExpo">
					<img src="<? echo $site; ?>/inc/img/rocket.png" alt="" />
				</div>
				<div class="tp-caption lfb" data-x="870" data-y="195" data-speed="1500" data-start="1900" data-easing="easeOutExpo">
					<img src="<? echo $site; ?>/inc/img/flames.png" alt="" />
				</div>
				<div class="caption sft stl" data-x="center" data-y="100" data-speed="1000" data-start="700" data-easing="easeOutExpo">
					<h3 class="rev-title bold"><? echo '<a href="'.$site.'">'.$name.'</a>'; ?></h3>
				</div>
				<? if($_GET['o'] == NULL OR $_GET['o'] == '') { ?>
				<div class="caption lfl stl rev-title-sub" data-x="center" data-y="190" data-speed="800" data-start="1100" data-easing="easeOutExpo">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="upload_file" id="upfile">
						<span><p>Нажмите для загрузки файла<br>или перетащите его сюда</p></span>
						<input type="file" name="file" onchange="document.getElementById('info').style.display = 'block'; document.getElementById('upfile').style.display = 'none';  document.getElementById('send').removeAttribute('disabled');">
						</div>
						<div class="upload_file" id="info" style="display:none;">
						<span><p style="font-size: 18px;">Файл выбран<br>нажмите на кнопку "Загрузить"</p></span>
						</div>
						<input type="submit" name="submit" id="send" class="btn btn-primary btn-custom btn-rounded" disabled="disabled" value="Загрузить">
					</form>
				</div>
				<? } else { echo $message; } ?>
				</li>
			</ul>
		</div>
	</div>
<script src="<? echo $site; ?>/inc/js/jquery.js"></script>			
<script type="text/javascript" src="<? echo $site; ?>/inc/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<? echo $site; ?>/inc/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript">
var revapi;
jQuery(document).ready(function() {
revapi = jQuery('.fullwidthbanner').revolution(
{
	delay:15000,
	startwidth:1170,
	startheight:500,
	touchenabled:"off",	
	fullWidth:"off",
	fullScreen:"on",
	fullScreenOffsetContainer: ""
	});
});

</script>
	</body>
</html>