<?php
session_start();
error_reporting( E_ALL ^ E_NOTICE );
@ini_set("memory_limit","64M");

require_once('../includes/globales.php'); 
require_once('../Connections/conect.php');

//INCLUYO LAS CLASES UTILIZADAS
require_once("class.paises.inc.php");
require_once("class.accion_paises.inc.php");

//GUARDO LA ACTUALIZACION DE LAS paises
if ($_REQUEST['accion']=='guardar')
	{
	//CREO Y CHEQUEO LOS DATOS DE LAS paises
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
	//CREO EL OBJETO DE LAS paises
	$paises = new paises();	
	$paises->set_nombre($txt_nombre);
	$paises->set_id($txt_id);
	$paises->set_del($txt_del);
	//$paises->set_portada($chk_portada);
	//SI SUBIO UNA IMAGEN
	if (is_uploaded_file($_FILES['txt_logo']['tmp_name'])) 
		{ 
		if ($tamano<($_SESSION['MAX_KB_IMG']*1000))
			{
			require_once("../includes/class_imagen.inc.php");
			$imagen = new imagen($_FILES["txt_logo"]["tmp_name"], $_FILES["txt_logo"]["type"],0,1);
			$imagen = $imagen->tratar("310");
			
			$paises->set_logo($imagen);
			}
		else
			{
			$_SESSION['error']=true;
			$_SESSION['error_campos']=$txt_nombre."|".$txt_id."|".$_SESSION['MAX_KB_IMG'];
			}
		}
	
	// CHEQUEO SI OCURRIO ALGUN ERROR
	if(!$_SESSION['error'])
		{
		// GUARDO/ACTUALIZO LOS DATOS
		$acciones = new accion_paises($mysql->get_conect(),$admin);	
		$acciones->guardar($paises);
		}
	}
	
/* ELIMINO LA ZONA DADA */
if ($_REQUEST['accion']=='eliminar')
	{
	$acciones = new accion_paises($mysql->get_conect(),$admin);	
	$acciones->eliminar($_GET['id']);	
	}
	
$url=str_replace("|","&",$_REQUEST['pag']);
header("Location: ".$url);
?>