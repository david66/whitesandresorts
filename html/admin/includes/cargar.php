<?php
error_reporting( E_ALL ^ E_NOTICE ); 
require_once('../Connections/conect.php'); 

//Defino la cabecera del documento
header('Content-Type: text/html; charset=utf-8');

if ($_REQUEST['modulo'])
	{
	//INCLUYO LAS CLASES UTILIZADAS
	require_once("../".$_REQUEST['modulo']."/class.accion_".$_REQUEST['modulo'].".inc.php");
	$objeto = "accion_".$_REQUEST['modulo'];
	$acciones = new $objeto($mysql->get_conect(),$admin);	
	echo $acciones->cargar($_REQUEST['id']);	
	}
?>