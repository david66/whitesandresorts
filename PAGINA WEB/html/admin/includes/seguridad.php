<?php
session_start();
if (!$_SESSION['USU_ID']) 
	{
	session_unset();
	session_destroy();
	header("Location: ../usuarios/login.php?i=endsessions");
	}
?>
