<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

$sql = "select apa_id from apartamentos where apa_url like '".$_GET['apartamento']."'";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERROR");

if(mysql_num_rows($result)>0)
	{
	$dto_id = mysql_result($result,0,0);
	include('apartamentos.php');
	}
else
	{
	header('location: index.php');
	}
?>