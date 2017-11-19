<?php
//$url="http://192.168.1.100/whitesandresorts/testing/";
require_once('admin/includes/globales.php');

if (isSet($_GET["lang"]))
	{
	$sql="select idi_id from idiomas where idi_locale='".$_GET["lang"]."' limit 0,1";
	$preferencias = mysql_query($sql, $mysql->get_conect()) or die(mysql_error());
	if(mysql_num_rows($preferencias)>0)
		{
		$_SESSION['IDI-SEL'] = mysql_result($preferencias,0);
		$_SESSION['IDI-PAIS'] = $_GET["lang"];
		}		
	
	}

if(!(isset($_SESSION['IDI-SEL']) && isset($_SESSION['IDI-PAIS'])))
	{
	$sql="select idi_locale,idi_id from idiomas where idi_id='1' limit 1";
	$preferencias = mysql_query($sql, $mysql->get_conect()) or die(mysql_error());
	if(mysql_num_rows($preferencias)>0)
		{
		$_SESSION['IDI-PAIS'] = mysql_result($preferencias,0,0);
		$_SESSION['IDI-SEL'] = mysql_result($preferencias,0,1);
		}
	}

putenv("LC_ALL=".$_SESSION['IDI-PAIS']);
setlocale(LC_ALL, $_SESSION['IDI-PAIS']);
bindtextdomain("messages", "./locale");
textdomain("messages");
?>