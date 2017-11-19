<?php
session_start();
require_once("../Connections/conect.php");

require_once("class.usuario.inc.php");
$usuario = new usuario($mysql->get_conect());
$usuario->logout();

header("location: login.php");
?>