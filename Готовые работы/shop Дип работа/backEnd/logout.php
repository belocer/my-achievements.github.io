<?php
session_start();
error_reporting(E_ALL); 
ini_set('error_repoting', E_ALL);
ini_set('display_errors', 1);

if( isset($_GET['get_out']) == 'out_man'){

	unset($_SESSION['online']);
	unset($_SESSION['pin']);
	unset($_SESSION['qty_res']);
	unset($_SESSION);
	unset($_POST);
	unset($_GET);
	session_destroy();
	header('Location: ../index.php');

}

?>
