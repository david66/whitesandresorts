<?php
$tpl->newBlock("SUBMENU");
$tpl->assign("TITULO", "Contenido");

$tpl->newBlock("SUBMENU-OPCION");
$tpl->assign("LINK", "../apartamentos/apartamentos.php");
$tpl->assign("NOMBRE", "Apartamentos");

$tpl->newBlock("SUBMENU-OPCION");
$tpl->assign("LINK", "../zonas/zonas.php");
$tpl->assign("NOMBRE", "Zonas");

$tpl->newBlock("SUBMENU-OPCION");
$tpl->assign("LINK", "../paises/paises.php");
$tpl->assign("NOMBRE", "Países");

$tpl->newBlock("SUBMENU");
$tpl->assign("TITULO", "Mantenimiento");

$tpl->newBlock("SUBMENU-OPCION");
$tpl->assign("LINK", "../usuarios/usuarios.php");
$tpl->assign("NOMBRE", "Cambiar Contrase&ntilde;a");

$tpl->newBlock("SUBMENU-OPCION");
$tpl->assign("LINK", "../usuarios/logout.php");
$tpl->assign("NOMBRE", "Salir");
?>