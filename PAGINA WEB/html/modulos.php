<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

$sql = "select zon_id,zon_nombre from zonas where zon_id='".$_GET['zon']."'";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");
if(mysql_num_rows($result)>0)
	{
	$zon_id = mysql_result($result,0,0);
	$zona = mysql_result($result,0,1);
	}

//$sql = "select apartamentos.apa_id,apa_nombre,aid_nombre,apa_direccion,apa_metros,apa_dormitorios,apa_precio,apa_url from apartamentos inner join apartamento_idiomas on apartamentos.apa_id=apartamento_idiomas.apa_id where idi_id='".$_SESSION['IDI-SEL']."' and zon_id='".$zon_id."' and apa_estado='1' order by apa_id DESC";

$sql = "select apartamentos.apa_id,apa_nombre,aid_nombre,apa_url from apartamentos inner join apartamento_idiomas on apartamentos.apa_id=apartamento_idiomas.apa_id where idi_id='".$_SESSION['IDI-SEL']."' and zon_id='".$zon_id."' and apa_estado='1' order by apa_order ASC";

$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-36: NO SE PUDO CARGAR LOS APARTAMENTOS");
$cantidad = mysql_num_rows($result);
/*
if($cantidad<1)
	{
	header('usados.php?zon='.$zon_id);
	}
*/
	
include("includes/header.php"); 	
?>
<div id="wrap">
 <div id="migas"><a href="index.php">WSR</a> > <a href="zonas.php"><?php $nz=$zona;echo _($nz);?></a> > <a href="<?php echo $_SERVER['REQUEST_URI'];?>"></a><a href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo _('Obra nueva');?></a></div>
 <div id="contenido">
<?php
if($cantidad<1)
	{
	$mensaje = _('No hay obras nuevas cargadas para esta zona');
?>
<div class="paginador"><?php echo $mensaje;?></div>
<?php
	}
else
	{
?>
<div id="obrasnuevas">
<?php
	$i = 0;
	while($row = mysql_fetch_array($result))
		{
		$texto_apartamento = strip_tags($row['aid_nombre']);
		
		$salto = "";
		switch($cantidad)
			{
		case 1:
			$clase = 'medio';
			$cortar = '&ancho=460&alto=450&cut=1';
			$largo_texto = 400;
			
			if($i>0)
				$salto = '<div class="clear"></div>';
		break;
		case 2:
			$clase = 'medio';
			$cortar = '&ancho=460&alto=450&cut=1';
			$largo_texto = 400;
			
			if($i>0)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		case 3:
			if($i<1)
				{
				$clase = 'medio';
				$cortar = '&ancho=460&alto=450&cut=1';
				$largo_texto = 400;
				}
			else
				{
				$clase = 'cuarto';
				$cortar = '&ancho=460&alto=216&cut=1';
				$largo_texto = 260;
				}
			if($i>2)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		case 4:
			if($i<1)
				{
				$clase = 'medio';
				$cortar = '&ancho=460&alto=450&cut=1';
				$largo_texto = 400;
				}
			else
				{
				if($i<2)
					{
					$clase = 'cuarto';
					$cortar = '&ancho=460&alto=216&cut=1';
					$largo_texto = 260;
					}
				else
					{
					$clase = 'octavo';
					$cortar = '&ancho=221&alto=216&cut=1';
					$largo_texto = 128;
					}
				}
			if($i>3)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		case 5:
			if($i<1)
				{
				$clase = 'medio';
				$cortar = '&ancho=460&alto=450&cut=1';
				$largo_texto = 400;
				}
			else
				{
				$clase = 'octavo';
				$cortar = '&ancho=220&alto=216&cut=1';
				$largo_texto = 128;
				}
			if($i>4)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		case 6:
			if($i<2)
				{
				$clase = 'cuarto';
				$cortar = '&ancho=460&alto=216&cut=1';
				$largo_texto = 260;
				if($i>1)
					$salto = '<div class="clear"></div>';
				}
			else
				{
				$clase = 'octavo';
				$largo_texto = 128;
				$cortar = '&ancho=221&alto=216&cut=1';
				}
			if($i>5)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		case 7:
			if($i<1)
				{
				$clase = 'cuarto';
				$cortar = '&ancho=460&alto=216&cut=1';
				$largo_texto = 260;
				if($i==2)
					{
					$salto = '<div class="clear"></div>';
					}
				}
			else
				{
				$clase = 'octavo';
				$cortar = '&ancho=221&alto=216&cut=1';
				$largo_texto = 128;
				}
			if($i>6)
				{
				$salto = '<div class="clear"></div>';
				$i=0;
				}
		break;
		default:
			$clase = 'octavo';
			$cortar = '&ancho=221&alto=216&cut=1';
			$largo_texto = 128;
		break;
			}
			
		//traigo el texto de las descripciones
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
			
		$sql = "select aga_imagen from apartamento_galerias where apa_id='".$row['apa_id']."' order by aga_id DESC limit 0,1";
		$image = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-40: NO SE PUDO CARGAR LAS IMAGENES");
		
		$imagen = 'images/promo-'.$clase.'.jpg';
		if(mysql_num_rows($image)>0)
			{
			$imagen = 'dibujar.php?file=admin/archivos/'.mysql_result($image,0).$cortar;
			}
		else
			{
			$imagen = 'dibujar.php?file=images/noimage-grande.jpg'.$cortar;
			}
?> 
  <div class="promo-<?php echo $clase;?>" onclick="location.href='<?php echo $url;?><?php echo $row['apa_url'];?>'" style="cursor:pointer;">
   <img src="<?php echo $imagen;?>"/>
   <p class="titulo"><?php echo $row['apa_nombre'];?></p>
   <p><?php echo $texto_apartamento;?></p>
<!--   
   <ul style="margin-left:20px;">
    <li><?php echo $row['apa_direccion'].', '.$row['ciu_nombre'];?></li>
    <li><?php echo $row['apa_metros'];?> m2</li>
    <li><?php echo $row['apa_dormitorios'];?> dormitorios</li>
   </ul>
   <p class="precio">Precio: <?php echo $row['apa_precio'];?> €</p>
-->
  </div>
<?php
		echo $salto;
		$i++;
		}
?>   
</div>
<?php
	}
?>   
  <div class="clear"></div>
<?php
/*
$sql = "select count(*) from apartamentos where zon_id='".$zon_id."' and apa_estado='0'";
$result = mysql_query($sql,$mysql->get_conect());

if(mysql_result($result,0)>0)
	{
*/
?>  
  <div class="segundamano"><a href="usados.php?zon=<?php echo $_GET['zon'];?>"><?php echo _('Ver los apartamentos de segunda mano en esta zona');?> &raquo;</a></div>
<?php
/*
	}
*/
?>
 </div>
</div>
<?php include "includes/foot.php"; ?>