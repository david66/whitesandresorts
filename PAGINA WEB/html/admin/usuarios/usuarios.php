<?php
session_start();
require_once("../Connections/conect.php");

include("../includes/head.php");
include("../includes/menu.php");

	$tpl->gotoBlock('_ROOT');
	$tpl->assign('TEXTO','CAMBIAR CONTRASEÑA');
	if($_SESSION['ok'])
		{
		$tpl->assign('BODY','onload="mensajes(\'clave\')"');
		unset($_SESSION['ok']);
		}
	else
		{
		$tpl->assign('BODY','onload="$(\'txt_clave_1\').focus()"');
		}
	
	//INDICO LA CONTRASEÑA ACTUAL
	$tpl->newBlock("INCLUDE-JAVASCRIPT");
	$tpl->assign("RUTA", "../scripts/md5.js");
	
	$tpl->newBlock('JAVASCRIPT');
	$tpl->newBlock('JAVASCRIPT-TEXT');
	$tpl->assign('JAVASCRIPT',"var actual = '".strtoupper(md5($_SESSION['USU_CLAVE']))."'");
	
	//MUESTRO EL FORMULARIO DE CLIENTE
	$tpl->newBlock('FORMULARIO');
	$tpl->assign('FORM','form1');
	$tpl->newBlock('FB');

	//CAMPO CLAVE
	$tpl->newBlock('FILA');
	$tpl->newBlock('CAMPO');
	$tpl->assign('TITULO','Ingrese la Clave Actual');
	$tpl->assign('CLASE-TEXTO','2');
	$tpl->assign('CLASE','fm-campo');
	
	$tpl->newBlock('PASSWORD');
	$tpl->assign('NAME','txt_clave_1');
	$tpl->assign('ID','txt_clave_1');
	$tpl->assign('MAX','22');
	$tpl->assign('VALOR','');
	$tpl->assign('TAB',1);
	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');
	
	//CAMPO CLAVE NUEVA
	$tpl->newBlock('FILA');
	$tpl->newBlock('CAMPO');
	$tpl->assign('TITULO','Ingrese la Clave Nueva');
	$tpl->assign('CLASE-TEXTO','2');
	$tpl->assign('CLASE','fm-campo');
	
	$tpl->newBlock('PASSWORD');
	$tpl->assign('NAME','txt_clave_2');
	$tpl->assign('ID','txt_clave_2');
	$tpl->assign('MAX','22');
	$tpl->assign('VALOR','');
	$tpl->assign('TAB',2);
	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');
	
	//CAMPO REINGRESAR CLAVE
	$tpl->newBlock('FILA');
	$tpl->newBlock('CAMPO');
	$tpl->assign('TITULO','Reingrese la Clave Nueva');
	$tpl->assign('CLASE-TEXTO','2');
	$tpl->assign('CLASE','fm-campo');
	
	$tpl->newBlock('PASSWORD');
	$tpl->assign('NAME','txt_clave_3');
	$tpl->assign('ID','txt_clave_3');
	$tpl->assign('MAX','22');
	$tpl->assign('VALOR','');
	$tpl->assign('TAB',3);
	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	//BOTONES
	$tpl->newBlock('BOTONES');
	$tpl->newBlock('BOTON-INPUT');
	$tpl->assign('ACCION','javascript:cambiar()');
	$tpl->assign('VALOR','Cambiar Contraseña');
	$tpl->assign('NOMBRE','guardar');
	$tpl->assign('CLASS','bto-guardar');
	$tpl->assign('TAB',4);
	
include("../includes/footer.php");	
?>