<?php
require_once('../admin/Connections/conect.php');
require_once('../admin/includes/globales.php');

function validaOpcion($opcionSeleccionada)
	{
	return true;
	}

$opcionSeleccionada=$_GET["opcion"];
$opcionpredeterminada=$_GET["predef"];

if(validaOpcion($opcionSeleccionada))
	{
	if($_GET['select']=='txt_ciudad' || $_GET['select']=='busc_ciudad')
		{
		$consulta=mysql_query("SELECT apa_ciudad from apartamentos WHERE apa_provincia='".$opcionSeleccionada."' group by apa_ciudad",$mysql->get_conect()) or die(mysql_error());
		$tabindex = ($_GET['select']=='txt_ciudad')?8:27;
		}
	else
		{
		$consulta=mysql_query("SELECT apa_provincia from apartamentos WHERE pai_id='".$opcionSeleccionada."' group by apa_provincia",$mysql->get_conect()) or die(mysql_error());
		$tabindex = ($_GET['select']=='txt_provincia')?4:26;
		}
	$tipo = ($_GET['select']=='txt_provincia' || $_GET['select']=='txt_provincia')?1:2;
	
	echo '<select name="'.$_GET['select'].'" class="select" id="'.$_GET['select'].'" tabindex="'.$tabindex.'" onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,'.$tipo.')">';
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
		{
		echo "<option value='".$registro[0]."'";
		if($opcionpredeterminada==$registro[0]){echo " selected";}
		echo ">".$registro[0]."</option>";
		}
	echo "</select>";
	}
?>