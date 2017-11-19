<?php
error_reporting( E_ALL ^ E_NOTICE );
session_start();
require_once("admin/Connections/conect.php");

//CARGO LAS VARIABLES GLOBALES
require_once('admin/includes/globales.php');

//contacto
if ($_REQUEST['accion']=='contacto')
	{
	//email destino
	$email=$dest_contacto;
	
	//cuerpo del mail
	$cuerpo="Nombre: ".$_POST['txt_nombre'];
	if($_POST['txt_apellidos'])
		{
		$cuerpo.="<br />Apellidos: ".$_POST['txt_apellidos']."<br />";
		}
	$cuerpo.="<br />Correo electrónico: ".$_POST['txt_email'];
	if($_POST['txt_telefono'])
		{
		$cuerpo.="<br />Teléfono: ".$_POST['txt_telefono']."<br />";
		}
	$cuerpo.="<br />Consulta: ".$_POST['txt_mensaje']."<br />"; 
	//asusto
	$mensaje="Contacto - ".$empresa; 
	
	//envio el email
	require "includes/mensajes_cmd.php";
	
	$_SESSION['mensaje']=true;
	}
	
//enviar a un amigo
if ($_REQUEST['accion']=='amigos')
	{
	//email destino
	$email=$_POST['txt_para'];
	
	$sql = "SELECT apa_nombre,apa_url from apartamentos where apa_id='".$_POST['txt_id']."'";
	$result = mysql_query($sql,$mysql->get_conect()) or die("ERR APA-30: NO SE PUDO CARGAR LA FICHA");
	if(mysql_num_rows($result)>0)
		{
		$row = mysql_fetch_array($result);
		}
	
	//cuerpo del mail
	$cuerpo = _('Estimado ');
	$cuerpo.= $_POST['txt_amigo'].",<br />";
	$cuerpo.= '<a href="mailto:'.$_POST['txt_para'].'" target"_blank">'.$_POST['txt_nombre']."</a> ";
	$cuerpo.= _('Te ha enviado el anuncio del apartamento');
	$cuerpo.= " <a href=\"".$url.$row['apa_url']."\">".$row['apa_nombre']."</a> ";
	$cuerpo.= _(' de ');
	$cuerpo.= "<a href=\"".$url."\">".$empresa."</a> ";
	if($_POST['txt_mensaje'])
		{
		$cuerpo .= _("con el siguiente mensaje:");
		$cuerpo .= " <br/>".$_POST['txt_mensaje']."<br />";
		}
	//asusto
	$mensaje = $_POST['txt_para'].' ';
	$mensaje .= _('ha visto el apartamento de tu sueños');
	
	//envio el email
	require "includes/mensajes_cmd.php";
	
	$_SESSION['mensaje']=true;
	}

//URL
$url=($_REQUEST['pag'])?str_replace("|","&",$_REQUEST['pag']):'index.php';
	
header("Location: ".$url);
?>