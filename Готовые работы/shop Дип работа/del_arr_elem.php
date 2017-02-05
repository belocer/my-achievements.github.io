<?php

if(isset($_POST['id_del'])){
	
	$key = array_search(2, $_SESSION['arr_cart']);
	
	if($key !== false){
		
		unset($_SESSION['arr_cart'][$key]);
		
		}
	
/*
$numb = $_POST['id_del']; 	  // номер в массиве 
//$_SESSION['arr_cart'] // сам массив
unset($_SESSION['arr_cart'][2]);

//$numb = $_POST['id_del']; 
//echo $numb;*/
	


}
	echo "Массив $_POST";
	echo "<pre>";
	var_dump($_POST['id_del']);
	print_r($_POST['id_del']);
	echo 'Массив $_SESSION["arr_cart"]';
	var_dump($_SESSION["arr_cart"]);
	print_r($_SESSION["arr_cart"]);
	echo "</pre>";
?>
