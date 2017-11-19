<?php
if(!is_object($conect)){
	require_once("mysql.inc.php");
	$mysql = new mysql('llde657.servidoresdns.net','qfb079','Avalia2009');
	$mysql->is_utf8();
	$mysql->set_conect('qfb079');
}
?>