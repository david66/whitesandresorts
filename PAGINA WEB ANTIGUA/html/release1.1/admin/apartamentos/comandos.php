<?php

session_start();

error_reporting( E_ALL ^ E_NOTICE );

@ini_set("memory_limit","64M");

//require_once('../includes/seguridad.php'); 

require_once('../Connections/conect.php');



//INCLUYO LAS CLASES UTILIZADAS

require_once("class.apartamentos.inc.php");

require_once("class.accion_apartamentos.inc.php");



//DEFINO SI ES UN ADMINISTRADOR

$admin = ($_SESSION['USU_ID'])?'1':'0';



//GUARDO LA ACTUALIZACION DE APARTAMENTOS

if ($_REQUEST['accion']=='guardar')

	{

	//CREO Y CHEQUEO LOS DATOS DEL APARTAMENTO

	$numero = count($_POST);

	$tags = array_keys($_POST);

	$valores = array_values($_POST);

	for($i=0;$i<$numero;$i++)

		{

		if($valores[$i]!="")

			{

			$$tags[$i]=($tags[$i]=='txt_descripcion' || $tags[$i]=='txt_ubicacion' || $tags[$i]=='txt_tipologia' || $tags[$i]=='txt_pago' || $tags[$i]=='txt_informacion')?$valores[$i]:mysql_real_escape_string(trim($valores[$i]));

			}

		}



	//CREO EL OBJETO DE APARTAMENTO

	$apartamentos = new apartamentos();	

	$apartamentos->set_id($txt_id);

	$apartamentos->set_nombre($txt_nombre);

	$apartamentos->set_estado($txt_estado);



	$apartamentos->set_zona($txt_zona);

	$apartamentos->set_pais($txt_pais);

	

	$apartamentos->set_provincia($txt_provincia);

	$apartamentos->set_ciudad($txt_ciudad);

	$apartamentos->set_cp($txt_cp);

	$apartamentos->set_direccion($txt_direccion);

	$apartamentos->set_ubicacion($txt_ubicacion);

	

	$apartamentos->set_dormitorios($txt_dormitorios);

	$apartamentos->set_metros($txt_metros);

	$apartamentos->set_tipologia($txt_tipologia);

	$apartamentos->set_plano($txt_plano);

	$apartamentos->set_del_plano($txt_del_plano);

	

	$apartamentos->set_precio($txt_precio);

	$apartamentos->set_pago($txt_pago);

	

	$apartamentos->set_informacion($txt_informacion);

	

	$chk_portada = ($chk_portada=='on')?'1':'0';

	$apartamentos->set_portada($chk_portada);

	

	$url = str_ireplace(array(' ','ñ','á','é','í','ó','ú'),array('-','ni','a','e','i','o','u'),$txt_nombre);

	$apartamentos->set_url($url);

	$apartamentos->set_order($txt_order);

	$apartamentos->set_del($txt_del);

	//GUARDO LAS IMAGENES GUARDADAS

	$apartamentos->set_galeria($_FILES);



	//GUARDO LAS DESCRIPCIONES

	$apartamentos->set_descripcion($txt_descripcion);

	

	//SETEO EL PLANO

	if(is_uploaded_file($_FILES['file_plano']['tmp_name']))

		{

		$apartamentos->set_plano(1);

		}

	

	/* GUARDO/ACTUALIZO LOS DATOS */

	$acciones = new accion_apartamentos($mysql->get_conect(),$admin);	

	$acciones->guardar($apartamentos);

	}

	

/* ELIMINO EL APARTAMENTO DADO */

if ($_REQUEST['accion']=='eliminar')

	{

	$acciones = new accion_apartamentos($mysql->get_conect(),$admin);	

	$acciones->eliminar($_GET['id']);	

	}



$url=str_replace("|","&",$_REQUEST['pag']);

header("Location: ".$url);

?>