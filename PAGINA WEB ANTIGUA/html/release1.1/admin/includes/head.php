<?php
require_once("../includes/class.TemplatePower.inc.php");
$tpl = new TemplatePower("../tpl/template.tpl");
$tpl->prepare();

$tpl->assign("TITULO", ":: Backend ::");

$tpl->newBlock("INCLUDE-CSS");
$tpl->assign("RUTA", "../css/estilos.css");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/prototype.js");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/funciones.js");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "scripts/funciones.js");

//$tpl->assign("BODY",'onload="asignaclase();oculta_submen();ocu_form();control_errores('.$error.',\''.$valores.'\');"');

$tpl->newBlock("MENU");
$tpl->assign("ID", "Apartamentos");
$tpl->assign("LINK", "../apartamentos/apartamentos.php");
$tpl->assign("TITULO", "Apartamentos");
$tpl->assign("NOMBRE", "Apartamentos");

$tpl->newBlock("MENU");
$tpl->assign("ID", "Zonas");
$tpl->assign("LINK", "../zonas/zonas.php");
$tpl->assign("TITULO", "Zonas");
$tpl->assign("NOMBRE", "Zonas");

$tpl->newBlock("MENU");
$tpl->assign("ID", "Paises");
$tpl->assign("LINK", "../paises/paises.php");
$tpl->assign("TITULO", "Países");
$tpl->assign("NOMBRE", "Países");

$tpl->newBlock("MENU");
$tpl->assign("ID", "SALIR");
$tpl->assign("LINK", "../usuarios/logout.php");
$tpl->assign("TITULO", "Salir");
$tpl->assign("NOMBRE", "Salir");
?>