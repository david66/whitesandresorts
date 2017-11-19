<?php 

session_start();

require_once("admin/Connections/conect.php");

require_once('includes/globales.php');

include("includes/header.php"); 


if($_SESSION['mensaje']){$pestanas=',{defaultTab:5}';}


$sql = "SELECT apartamentos.apa_id,

apartamentos.apa_nombre,

apartamento_idiomas.aid_nombre,

zonas.zon_id,

zonas.zon_nombre,

paises.pai_id,

paises.pai_nombre,

apartamentos.apa_provincia,

apartamentos.apa_ciudad,

apartamentos.apa_cp,

apartamentos.apa_direccion,

apartamentos.apa_estado,

apartamento_idiomas.aid_ubicacion,

apartamentos.apa_metros,

apartamentos.apa_dormitorios,

apartamento_idiomas.aid_tipologia,

apartamentos.apa_precio,

apartamento_idiomas.aid_pago,

apartamento_idiomas.aid_informacion,

apartamentos.apa_plano,

apartamentos.apa_url 

FROM paises inner join (apartamento_idiomas inner join (apartamentos inner join zonas on apartamentos.zon_id=zonas.zon_id) on apartamento_idiomas.apa_id=apartamentos.apa_id) on paises.pai_id=apartamentos.pai_id where idi_id='".$_SESSION['IDI-SEL']."' and apartamentos.apa_id='".$dto_id."';";



$result = mysql_query($sql,$mysql->get_conect()) or die("ERR APA-30: NO SE PUDO CARGAR LA FICHA");

if(mysql_num_rows($result)>0)

	{

	$row = mysql_fetch_array($result);

	}

//CHEQUEO EL TIPO DE APARTAMENTO
if($row['apa_estado']==1)
	{
	switch($_GET['s'])
		{
	case 5:
		$pestanas=',{defaultTab:4}';
		$tipo_galeria = 5;
	break;
	case 4:
		$pestanas=',{defaultTab:3}';
		$tipo_galeria = 4;
	break;
	case 3:
		$pestanas=',{defaultTab:2}';
		$tipo_galeria = 3;
	break;
	case 2:
		$pestanas=',{defaultTab:1}';
		$tipo_galeria = 2;
	break;
	default:
		$pestanas=',{defaultTab:0}';
		$tipo_galeria = 1;
	break;
		
		}
	}

//CARGO EL SCRIPT DE LA GALERIA
if($row['apa_estado']==1)
	{
	$sql="select aga_imagen from apartamento_galerias where apa_id ='".$row['apa_id']."' and aga_tipo='".$tipo_galeria."' order by aga_id DESC";
	}
else
	{
	$sql="select aga_imagen from apartamento_galerias where apa_id ='".$row['apa_id']."' order by aga_id DESC";
	}

$galeria = mysql_query($sql, $mysql->get_conect()) or die(mysql_error());

$jsgaleria.= "function galeria(puntero){switch(puntero){";

$numimg=0;

while($gal = mysql_fetch_array($galeria)){

	if($numimg==0){

		$img_grande='dibujar.php?file=admin/archivos/'.$gal['aga_imagen'].'&ancho=363&alto=300&cut=1';

	}

	$arrgaleria[]= 'admin/archivos/'.$gal['aga_imagen'];

	$jsgaleria.= 'case '.$numimg.':document.getElementById(\'imagen_principal\').src="images/cargando.gif";document.getElementById(\'imagen_principal\').src="'.'dibujar.php?file=admin/archivos/'.$gal['aga_imagen'].'&ancho=363&alto=300&cut=1";break;';

	$numimg++;

}

$jsgaleria.= "}}";

	

if($img_grande)

	{

	$img_principal .= $img_grande;

	

	if(is_array($arrgaleria))

		{

		if(count($arrgaleria)>1)

			{

			$numimg=0;	

			$fila = 0;

			$numimgfila = 0;

			foreach($arrgaleria as $gal)

				{

				if($numimgfila>3)

					{

					$fila++;

					$numimgfila=0;

					}

				$ficha[$fila] .='<img id="img-mini" src="dibujar.php?file='.$gal.'&ancho=69&alto=49&cut=1" onclick="galeria('.$numimg.')" title="Click para agrandar">';

				$numimg++;

				$numimgfila++;

				}

			}

		}

	}

else

	{

	$img_principal = "images/noimage-grande.jpg";

	}

	

$permalink = $url.$row['apa_url'];

?>

<script type="text/javascript">

var pagactual = 0;

var paglimit = <?php echo count($ficha)-1;?>;

<!--

<?php echo $jsgaleria;?>



-->



function gal_next()

	{

	if(paglimit>=pagactual)

		{

		document.getElementById('flecha_izq').src="images/flecha_izq_pre.jpg";

		document.getElementById('flecha_izq').onclick=gal_prev;

		document.getElementById('flecha_izq').className="cursor";

		

		document.getElementById('galeria_'+pagactual).style.display = 'none';

		

		pagactual++;

		document.getElementById('galeria_'+pagactual).style.display = 'block';

		}

	

	if(paglimit<=pagactual)

		{

		document.getElementById('flecha_der').src="images/flecha_der_ap.jpg";

		document.getElementById('flecha_der').onclick=function(){void(0);}

		document.getElementById('flecha_der').className="none";

		}

	}

	

function gal_prev()

	{

	if(0<=pagactual)

		{

		document.getElementById('flecha_der').src="images/flecha_der_pre.jpg";

		document.getElementById('flecha_der').onclick=gal_next;

		document.getElementById('flecha_der').className="cursor";

		

		document.getElementById('galeria_'+pagactual).style.display = 'none';

		

		pagactual--;

		document.getElementById('galeria_'+pagactual).style.display = 'block';

		}

	

	if(0>=pagactual)

		{

		document.getElementById('flecha_izq').src="images/flecha_izq_ap.jpg";

		document.getElementById('flecha_izq').onclick=function(){void(0);}

		document.getElementById('flecha_izq').className="none";

		}

	}

function cambiarPestana(tipo)
	{
	location.href = '<?php echo $permalink.'?s='?>'+tipo;
	}

</script>

<div id="wrap">

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />



 <div id="migas"><a href="index.php">WSR</a> > <a href="zonas.php"><?php echo $row['zon_nombre'];?></a> > <a href="<?php echo ($row['apa_estado']==1)?'modulos.php?zon='.$row['zon_id']:'usados.php?zon='.$row['zon_id'];?>"><?php echo ($row['apa_estado']==1)?'Obra nueva':'Segunda mano';?></a> &gt; <a href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo $row['apa_nombre'];?></a></div>

 <div id="contenido">

  <div id="galeria">

   <img id="imagen_principal" src="<?php echo $img_principal;?>"/>

   <div id="miniaturas">

    <?php

	echo '<img id="flecha_izq" src="images/flecha_izq_ap.jpg" class="none">';

	

	$lenght = count($ficha);

	for($i=0;$i<$lenght;$i++)

		{

		$estilo = ($i<1)?'style="display:block"':'style="display:none"';

		echo '<div id="galeria_'.$i.'" class="galeria" '.$estilo.'>'.$ficha[$i].'</div>';

		}

		

	if($lenght>1)

		{

		echo '<img id="flecha_der" src="images/flecha_der_pre.jpg" onclick="gal_next()" class="cursor">';

		}

	else

		{

		echo '<img id="flecha_der" src="images/flecha_der_ap.jpg" class="none">';

		}

	?>

   </div>

  </div>

  <div id="info">

    <p id="vivienda"><?php echo $row['apa_nombre'].', '.$row['ciu_nombre'];?></p>

    <div id="TabbedPanels1" class="TabbedPanels">

      <ul class="TabbedPanelsTabGroup">

        <li class="TabbedPanelsTab" tabindex="0" <?php if($row['apa_estado']==1){echo 'onclick="cambiarPestana(1)"';}?>><?php echo _('Ficha de Presentación');?></li>

        <li class="TabbedPanelsTab" tabindex="0" <?php if($row['apa_estado']==1){echo 'onclick="cambiarPestana(2)"';}?>><?php echo _('Ubicación y entorno');?></li>

        <li class="TabbedPanelsTab" tabindex="0" <?php if($row['apa_estado']==1){echo 'onclick="cambiarPestana(3)"';}?>><?php echo _('Tipologías y Planos');?></li>

        <li class="TabbedPanelsTab" tabindex="0" <?php if($row['apa_estado']==1){echo 'onclick="cambiarPestana(4)"';}?>><?php echo _('Precio y forma de pago');?></li>

        <li class="TabbedPanelsTab" tabindex="0" <?php if($row['apa_estado']==1){echo 'onclick="cambiarPestana(5)"';}?>><?php echo _('Información útil');?></li>

		<li class="TabbedPanelsTab" tabindex="0"><?php echo _('Enviar a un amigo');?></li>

      </ul>

      <div class="TabbedPanelsContentGroup">

        <div class="TabbedPanelsContent">

			<p><?php echo $row['aid_nombre'];?></p>

        </div>

        <div class="TabbedPanelsContent">

			<?php echo _('Zona: ').$row['zon_nombre'];?><br />

			<?php echo _('Direccion: ').$row['apa_direccion'];?>, <?php echo $row['apa_cp'];?> - <?php echo $row['apa_ciudad'];?>, <?php echo $row['apa_provincia'];?><br />

			<p><?php echo $row['aid_ubicacion'];?></p>

		</div>

        <div class="TabbedPanelsContent">
<!--<?php echo _('Precio: ').$row['apa_precio'];?> &euro;<br />
			<p><?php echo $row['aid_tipologia'];?></p>

			<?php echo _('Caracteristicas: ').$row['apa_metros'];?> M<sup>2</sup>, <?php echo $row['apa_dormitorios'].' '; echo _('dormitorios');?><br /> -->

<?php

if($row['apa_plano'])

	{

	echo '<p align="center"><a href="admin/archivos/'.$row['apa_plano'].'" target="_blank">Descargar Plano</a></p>';

	}

?>

		</div>

        <div class="TabbedPanelsContent">

			

			<p><?php echo $row['aid_pago'];?></p>

		</div>

        <div class="TabbedPanelsContent">

			<p><?php echo $row['aid_informacion'];?></p>

		</div>

        <div class="TabbedPanelsContent">

			<?php

			if($_SESSION['mensaje'])

				{

			?>

			<div class="mensajeenviado">

			<?php echo _('Su mensaje ha sido enviado correctamente');?>

			</div>

			<?php

				}

			?>

			<div>

		<!--		<form name="form1" id="form1" method="post" action="">

				<table>

				  <tr>

					<td class="amigo-campo"><?php echo _("Su Nombre *");?></td>

					<td><input name="txt_nombre" id="txt_nombre" type="text" /></td>

					<td class="nombre-campo"><?php echo _("Email *");?></td>

					<td><input name="txt_email" id="txt_email" type="text" /></td>

				  </tr>

				  <tr>

					<td class="amigo-campo"><?php echo _("Su amigo *");?></td>

					<td><input name="txt_amigo" id="txt_amigo" type="text" /></td>

					<td class="nombre-campo"><?php echo _("Email *");?></td>

					<td><input name="txt_para" id="txt_para" type="text" /></td>

				  </tr>

				  <tr>

					<td class="amigo-campo"><?php echo _("Mensaje");?></td>

					<td colspan="3"><textarea name="txt_mensaje" id="txt_mensaje" cols="" rows=""></textarea></td>

				  </tr>

				  <tr>

					<td class="amigo-campo"></td>

					<td></td>

					<td class="nombre-campo"></td>

					<td>

						<input class="button" name="" value="<?php echo _("Enviar");?>" type="button" onclick="valida_amigo()"/>

						<input name="txt_id" id="txt_id" type="hidden" value="<?php echo $row['apa_id'];?>" />

					</td>

				  </tr>

				</table>

				</form> -->
<form name="form1" id="form1" method="post" action="">
		<table>
		  <tr>
			<td class="nombre-campo"><?php echo _("Nombre *");?></td>
			<td><input name="txt_nombre" id="txt_nombre" type="text" /></td>
			<td class="nombre-campo"><?php echo _("Apellidos");?></td>
			<td><input name="txt_apellidos" id="txt_apellidos" type="text" /></td>
		  </tr>
		  <tr>
			<td class="nombre-campo"><?php echo _("Email *");?></td>
			<td><input name="txt_email" id="txt_email" type="text" /></td>
			<td class="nombre-campo"><?php echo _("Telefono");?></td>
			<td><input name="txt_telefono" id="txt_telefono" type="text" /></td>
		  </tr>
		  <tr>
			<td class="nombre-campo"><?php echo _("Mensaje");?></td>
			<td colspan="3"><textarea name="txt_mensaje" id="txt_mensaje" cols="" rows=""></textarea></td>
		  </tr>
		  <tr>
			<td class="nombre-campo"></td>
			<td></td>
			<td class="nombre-campo"></td>
			<td><input class="button" name="" value="<?php echo _("Enviar");?>" type="button" onclick="valida_contacto()"/></td>
		  </tr>
		</table>
		</form>
			</div>

			<div class="obligatorio">

			<?php echo _('Los campos marcados con el asterisco (*) son obligatorios');?>

			</div>

		</div>

      </div>

    </div>

  </div>

 </div>

<div class="clear"></div>

<?php

if($row['apa_estado']==1)

	{

?>  

  <div class="segundamano"><a href="usados.php?zon=<?php echo $_GET['zon'];?>"><?php echo _('Ver los apartamentos de segunda mano en esta zona');?> &raquo;</a></div>

<?php

	}

?>

</div>



 <!--<div id="permalink"><b><?php echo _('Link permanente: ');?></b> <a href="<?php echo $permalink;?>"><?php echo $permalink;?></a></div> -->

<script type="text/javascript">

<!--

var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1"<?php echo $pestanas?>);

//-->

</script>

<?php 

include "includes/foot.php"; 

unset($_SESSION['mensaje']);

?>