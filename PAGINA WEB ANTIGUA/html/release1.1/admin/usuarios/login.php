<?php
session_start();
require_once("../Connections/conect.php");

if(!$_SESSION['USU_NOMBRE'])
	{
	require_once("../includes/class.TemplatePower.inc.php");
	$tpl = new TemplatePower("../tpl/login.tpl");
	$tpl->prepare();
	
	if($_GET['i']=='endsessions')
		{
		$tpl->assign("RESULTADO","endsessions");
		}
	if($_POST)
		{
		require_once("class.usuario.inc.php");
		$usuario = new usuario($mysql->get_conect());
		if($usuario->login(trim($_POST['usuario']),trim($_POST['clave'])))
			{
			header("location: home.php");
			}
		else
			{
			$tpl->assign("RESULTADO","login");
			}
		}
	$tpl->assign("DESTINO",$_SERVER['PHP_SELF']);
	$tpl->assign("TITULO",":: LOGIN ::");
	$tpl->assign("USUARIO","Usuario:");
	$tpl->assign("CLAVE","Clave:");
	$tpl->assign("BOTON","Ingresar");
	$tpl->newBlock('LOGO');
	$tpl->assign("LOGO","../img/logo-login.jpg");
	
	$tpl->printToScreen();
	}
else
	{
	header("location: home.php");
	}
?>