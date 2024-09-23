<?php

session_start();

if(isset($_SESSION['siid']))
{
	unset($_SESSION['siid']);

}
header("Location: ../login.php");
die;

?>