<?php
session_start();
error_reporting( E_ALL ^ E_NOTICE );
require_once('../includes/seguridad.php'); 
require_once('../Connections/conect.php');

//INCLUYO LAS CLASES UTILIZADAS
require_once("class.usuario.inc.php");

// ELIMINO EL CLIENTE DADO
if ($_REQUEST['accion']=='cambiar')
	{
	$numero = count($_POST);
	$tags = array_keys($_POST);
	$valores = array_values($_POST);
	for($i=0;$i<$numero;$i++)
		{
		if($valores[$i]!="")
			{
			$$tags[$i]=mysql_real_escape_string(trim($valores[$i]));
			}
		}
	
	$acciones = new usuario($mysql->get_conect());	
	$acciones->cambiar_clave($_SESSION['USU_ID'],$txt_clave_2);	
	//indico que se cambio la clave
	$_SESSION['ok'] = true;
	}

$url=str_replace("|","&",$_REQUEST['pag']);
header("Location: ".$url);
?>