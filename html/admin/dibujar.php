<?php
include 'includes/rd.php';

$a = $_GET['file'];
$w = $_GET['ancho'];
$h = $_GET['alto'];
$cut = $_GET['cut'];

$rd = new Redimension($a,$w,$h,$cut);

if(isset($_GET['download'])) 
    $rd->dlImg();
else 
    $rd->prImg();
?> 