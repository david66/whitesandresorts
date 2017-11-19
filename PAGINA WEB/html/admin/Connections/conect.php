<?php
if(!is_object($conect)){
	require_once("mysql.inc.php");
	$mysql = new mysql('lldf444.servidoresdns.net','qgv565','Avalia2009');
	$mysql->is_utf8();
	$mysql->set_conect('qgv565');
}
?>