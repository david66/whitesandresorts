<?php 
error_reporting( E_ALL ^ E_NOTICE ); 
session_start();

require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

//Incluyo el script que va a necesitar
$script = '<script type="text/javascript" src="common/js/mootools.js"></script>
<script type="text/javascript" src="scripts/imageMenu.js"></script>';

include("includes/header.php"); 

?>
<div id="wrap">
 <div id="migas"><a href="index.php">WSR</a></div>
 <div id="menu_animado">
   <div id="imageMenu">
     <ul>
<?php
$sql = "select zon_id,zon_imagen,zon_nombre from zonas where zon_portada='1' order by zon_nombre limit 0,4";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");
while($row = mysql_fetch_array($result))
	{
	if($row['zon_imagen'])
		{
		$imagen = 'dibujar.php?file=admin/archivos/'.$row['zon_imagen'].'&ancho=310&alto=300&cut=1&ac='.date("His");
		}
	else
		{
		$imagen = "images/nologo.jpg";
		}
?>
       <li><a href="modulos.php?zon=<?php echo $row['zon_id'];?>" style="background: url('<?php echo $imagen;?>') no-repeat scroll 0%;"><?php echo $row['zon_nombre'];?></a></li>
<?php
	}
?>
       <li class="otros"><a href="zonas.php"><?php echo _('Otras zonas');?></a></li>
     </ul>
   </div>
   <script type="text/javascript">
			
			window.addEvent('domready', function(){
				var myMenu = new ImageMenu($$('#imageMenu a'),{openWidth:310, border:2, onOpen:function(e,i){location.href=e;}});
			});
</script>
 </div>

 <div id="extras"> <a href="usados.php"><div  style="float:left"class="banner"><img src="images/banner2.jpg"/></div></a>
  <a href="usados.php"><div class="banner"><img src="images/turismo.jpg"/></div></a>
<?php
$sql = "select apartamentos.apa_id, apa_nombre, aid_nombre, apa_metros, apa_direccion, apa_dormitorios, apa_precio, apa_url from apartamentos inner join apartamento_idiomas on apartamentos.apa_id=apartamento_idiomas.apa_id where idi_id='".$_SESSION['IDI-SEL']."' and apa_portada='1' order by apa_id DESC";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-36: NO SE PUDO CARGAR LOS APARTAMENTOS");
while($row = mysql_fetch_array($result))
	{
	$sql = "select aga_imagen from apartamento_galerias where apa_id='".$row['apa_id']."' order by aga_id DESC limit 0,1";
	$image = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-40: NO SE PUDO CARGAR LAS IMAGENES");
	
	$imagen = 'images/oferta.jpg';
	if(mysql_num_rows($image)>0)
		{
		$imagen = 'dibujar.php?file=admin/archivos/'.mysql_result($image,0).'&ancho=229&alto=142&cut=1';
		}
		
	//traigo el texto de las descripciones
		$texto_apartamento = strip_tags($row['aid_nombre']);
		$largo_texto = 228;
	
	$txt_array = explode(' ',$texto_apartamento);
	$texto_apartamento = "";
	
	foreach($txt_array as $texto)
		{
		$texto_apartamento = $texto_apartamento.$texto.' ';
		if(strlen($texto_apartamento) >= $largo_texto)
			{
			$texto_apartamento = $texto_apartamento.'…';
			break;
			}
		}
?>
  

  <div id="oferta" onclick="location.href='<?php echo $url;?><?php echo $row['apa_url'];?>'" style="cursor:pointer;">
   <img src="<?php echo $imagen;?>" width="229" height="142" />
   <p class="titulo"><?php echo $row['apa_nombre'];?></p>
   <p><?php echo $texto_apartamento;?></p>
   <!--
   <ul>
    <li><?php echo $row['apa_direccion'].', '.$row['ciu_nombre'];?></li>
    <li><?php echo $row['apa_metros'];?> m2</li>
    <li><?php echo $row['apa_dormitorios'];?> dormitorios</li>
   </ul>
   <p class="precio">Precio: <?php echo $row['apa_precio'];?> €</p>
   -->
  </div>
<?php
	}
?>
<!--
  <div class="modulo">Banner</div>
  <div class="modulo">Link</div>
-->
 </div>
 
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3336765-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<?php include "includes/foot.php"; ?>