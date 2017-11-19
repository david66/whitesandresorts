<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

include("includes/header.php"); 

?>
<div id="wrap">
 <div id="migas"><a href="index.php">WSR</a> > <a href="zonas.php"><?php echo _('Zonas');?></a></div>
 <div id="contenido">
<?php
$sql = "select zon_id,zon_imagen,zon_nombre from zonas order by zon_nombre";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");
while($row = mysql_fetch_array($result))
	{
	if($row['zon_imagen'])
		{
		$imagen = 'dibujar.php?file=admin/archivos/'.$row['zon_imagen'].'&ancho=210&alto=200&cut=1&ac='.date("His");
		}
	else
		{
		$imagen = "images/nologo.jpg";
		}
?>
  <div class="zona">
   <p class="titulo"><?php $nm=$row['zon_nombre'];echo _($nm);?></p>
   <a href="modulos.php?zon=<?php echo $row['zon_id'];?>"><img src="<?php echo $imagen;?>"/></a>
  </div>
<?php
	}
?>
  <div class="clear"></div>
 </div>
</div>
<?php include "includes/foot.php"; ?>