<?php session_start (); 
if(isset($_GET['logout']))
{	
	unset($_GET['logged']);
	unset($_SESSION['logged']);
	unset($_GET[registration]);
	header('Location: index.html');
	session_unset ();
	session_destroy ();
}
?>