<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

include("includes/header.php"); 
?>
<div id="wrap">
 <div id="migas"><a href="index.php">WSR</a> > <a href="sitemap.php"><?php echo _('Mapa del Sitio');?></a></div>
 <div id="contenido">
	<div class="mapa">
		<h2 class="mp_titulo"><a target="_BLANK" href="index.php"><?php echo _('Inicio');?></a></h2>
		<h2 class="mp_titulo"><a target="_BLANK" href="zonas.php"><?php echo _('Zonas');?></a></h2>
		<ul>
<?php
$sql = "SELECT zon_id,zon_nombre from zonas order by zon_nombre";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");
while($row = mysql_fetch_array($result))
	{
?>
			<li><a target="_BLANK" href="modulos.php?zon=<?php echo $row['zon_id'];?>"><?php echo _($row['zon_nombre']);?></a></li>
<?php
	}
?>
		</ul>
		<h2 class="mp_titulo"><a target="_BLANK" href="quienes.php"><?php echo _('Quiénes somos');?></a></h2>
		<h2 class="mp_titulo"><a target="_BLANK" href="mailto:info@wsresorts.es"><?php echo _('Colabora con nosotros');?></a></h2>
		<h2 class="mp_titulo"><a target="_BLANK" href="contacto.php"><?php echo _('Contacto');?></a></h2>
	</div>
 </div>
</div>
<?php include "includes/foot.php"; ?>