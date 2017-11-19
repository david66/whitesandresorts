<?php
session_start();
require_once("../Connections/conect.php");

//ZONGA LAS VARIABLES GLOBALES
require_once('../includes/globales.php');

//CONTROLA EL CIERRE DE SESSION
require_once('../includes/seguridad.php'); 

include("../includes/head.php");
include("../includes/menu.php");

//BUSCAMOS LAS CLASES QUE NECESITAMOS
require_once("class.accion_zonas.inc.php");
require_once("class.paginador.inc.php");
require_once("class.zonas.inc.php");

$tpl->gotoBlock('_ROOT');

if($_SESSION['error'])
	{
	$tpl->assign('BODY','onload="errores(\''.$_SESSION['error_campos'].'\')"');
	unset($_SESSION['error'],$_SESSION['error_campos']);
	}

$tpl->assign('TEXTO','ZONAS');

//INCLUYO EL SCRIPT DE TOOLTIPS
$tpl->newBlock('INCLUDE-JAVASCRIPT-BODY');
$tpl->assign('RUTA','../scripts/wz_tooltip.js');

//MUESTRO EL FORMULARIO DE ZONAS
$tpl->newBlock('FORMULARIO');
$tpl->assign('FORM','form1');
$tpl->newBlock('FB');
$tpl->assign('PARAM','id="alta_modi"');

//CAMPO ZONAS
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Zona');
$tpl->assign('CLASE-TEXTO','2');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('INPUT');
$tpl->assign('NAME','txt_nombre');
$tpl->assign('ID','txt_nombre');
$tpl->assign('MAX','60');
$tpl->assign('VALOR','');
$tpl->assign('TAB',1);
$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this);"');

/*
//CAMPO PAIS
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Pais');
$tpl->assign('CLASE-TEXTO','2');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('SELECT');
$tpl->assign('NAME','lst_pais');
$tpl->assign('ID','lst_pais');
$tpl->assign('MAX','60');
$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

$tpl->newBlock('SELECT-OPTION');
$tpl->assign('VALOR','');
$tpl->assign('TEXTO','Seleccione...');

$sql = "select pai_id,pai_nombre from paises";
$paises = mysql_query($sql,$mysql->get_conect()) or die("ERR PRO-148: NO SE PUDO CARGAR LOS PAISES");
while($row = mysql_fetch_array($paises))
	{
	$tpl->newBlock('SELECT-OPTION');
	$tpl->assign('VALOR',$row['pai_id']);
	$tpl->assign('TEXTO',$row['pai_nombre']);
	}
*/
	
//CAMPO DE LA IMAGEN
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Imagen');
$tpl->assign('CLASE-TEXTO','2');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','txt_logo');
$tpl->assign('ID','txt_logo');
$tpl->assign('TAB',2);
$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

//MUESTRO LA IMAGEN ACTUAL
$tpl->newBlock('FILA');
$tpl->assign('ACCIONES','id="fila_imagen"');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Imagen Acutal:');
$tpl->assign('CLASE-TEXTO','2');
$tpl->assign('CLASE','fm-campo');
$tpl->assign('TEXTO','<img id="imagen-adjunto" src="../img/noimage.jpg">
	<br /><input type="button" class="bto-logo" name="borrar" id="borrar" value="Borrar Imagen" onclick="quitar_imagen();" />');

//CAMPO PORTADA
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE-TEXTO','2');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('CHECK');
$tpl->assign('NAME','chk_portada');
$tpl->assign('ID','chk_portada');
$tpl->assign('TAB',1);
$tpl->assign('ACCIONES','');
$tpl->assign('TEXTO','<b>Mostrar en portada</b>');

//NOTA
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span class="nota"><b>NOTA:</b> Para que las im&aacute;genes de zonas se vean lo m&aacute;s vistosas posible en la portada se recomienda que sean de 310 x 300 px</span>');
	
//BOTONES
$tpl->newBlock('BOTONES');
$tpl->newBlock('BOTON-INPUT');
$tpl->assign('ACCION','javascript:validar()');
$tpl->assign('VALOR','Guardar');
$tpl->assign('NOMBRE','guardar');
$tpl->assign('CLASS','bto-guardar');
$tpl->assign('TAB',3);

$tpl->newBlock('BOTON-INPUT');
$tpl->assign('ACCION','javascript:ocu_form()');
$tpl->assign('VALOR','Cancelar');
$tpl->assign('NOMBRE','cancelar');
$tpl->assign('CLASS','bto-cancelar');
$tpl->assign('TAB',4);

$tpl->newBlock('HIDDEN');
$tpl->assign('NOMBRE','txt_id');
$tpl->assign('VALOR','');

$tpl->newBlock('HIDDEN');
$tpl->assign('NOMBRE','txt_del');
$tpl->assign('VALOR','0');

//GENERAMOS EL OBJETO DE LA BUSQUEDA SI LA HAY
$vacio = false;
if($_POST)
	{
	$numero = count($_POST);
	$tags = array_keys($_POST);
	$valores = array_values($_POST);
	for($i=0;$i<$numero;$i++)
		{
		if($valores[$i]!="")
			{
			$$tags[$i]=mysql_real_escape_string(trim($valores[$i]));
			}
		}
	$busqueda = new zonas();	
	$busqueda->set_nombre($busc_nombre);
	}
else
	{
	if($_GET['busqueda'])
		{
		$busqueda = unserialize($_SESSION['BUSQUEDA']);
		}
	else
		{
		$busqueda = new zonas();
		//indica si el buscador esta vacio
		$vacio = true;
		}
	}

//GENERAMOS EL LISTADO
	
//INSTACIAMOS EL PAGINADOR Y LA ACCION DE LISTADO
$acciones = new accion_zonas($mysql->get_conect());
$paginas = new paginador($mysql->get_conect());	
$paginas->set_nro_pagina($_GET['pageNum']);

if($_GET['campo'] && $_GET['ord'])
	{
	if(!is_object($busqueda))
		{
		$busqueda = new zonas();	
		}
	$busqueda->set_campo($_GET['campo']);
	$busqueda->set_orden($_GET['ord']);	
	$vacio = false;
	}
//PAGINAMOS LOS RESULTADOS
$paginas->paginar_resultados($acciones->listado($busqueda));

$tpl->newBlock("TABLA");
$tpl->assign("CLASS",' id="mod_listado"');
$tpl->assign("TEXTO",'<div class="ref">Referencias: <img src="../img/icons/camera.png" width="16px"> Imagen - <img src="../img/icons/modificar.png" width="16px"> Modificar - <img src="../img/icons/borrar.png" width="16px"> Borrar</div>');

$tpl->newBlock("BUSQUEDA");
$tpl->assign('TEXTO','<form action="" method="post" name="form2" id="form2" enctype="multipart/form-data" >
<input name="busc_nombre" type="text" id="busc_nombre" size="40" maxlength="60" value="'.$busqueda->get_nombre().'" />
<a href="javascript:buscador();"/>BUSCAR</a>
</form> | ');

$tpl->newBlock("BUSC-BOTON");
$tpl->assign("LINK","javascript:mostrar_form('txt_nombre');");
$tpl->assign("TEXTO","NUEVA ZONAS");

//SERIALIZAMOS Y DESTRUIMOS EL OBJETO
if(!$vacio)
	{
	$campo = $busqueda->get_campo();
	$orden = $busqueda->get_orden();
	
	$_SESSION['BUSQUEDA'] = serialize($busqueda);
	$queryString = "&busqueda=1";
	}
	
unset($busqueda);

if(!$vacio)
	{
	$tpl->assign("SEPARADOR","|");
	$tpl->newBlock("BUSC-BOTON");
	$tpl->assign("LINK","zonas.php");
	$tpl->assign("TEXTO","VOLVER");
	}
// BOTONES DEL PAGINADOR
$paginador_listado = ($paginas->get_nro_pagina() > 0)?'<img src="../img/icon/first-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], 0, $queryString).'\'" >':'<img src="../img/icon/first-ap.png" />';
$paginador_listado .= ($paginas->get_nro_pagina() > 0)?'<img src="../img/icon/left-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], max(0, $paginas->get_nro_pagina() - 1), $queryString).'\'" >':'<img src="../img/icon/left-ap.png" />';
$paginador_listado .= min($paginas->get_reg_actual() + $paginas->get_reg_pagina(), $paginas->get_total_registros()).' de '.$paginas->get_total_registros();
$paginador_listado .= ($paginas->get_nro_pagina() < $paginas->get_cant_paginas())?'<img src="../img/icon/right-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], max($paginas->get_cant_paginas(), $paginas->get_nro_pagina() + 1), $queryString).'\'" >':'<img src="../img/icon/right-ap.png" />';
$paginador_listado .= ($paginas->get_nro_pagina() < $paginas->get_cant_paginas())?'<img src="../img/icon/last-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], $paginas->get_total_registros(), $queryString).'\'" >':'<img src="../img/icon/last-ap.png" />';

$tpl->newBlock("PAGINADOR");
$tpl->assign("TEXTO", $paginador_listado);
/*
if($paginas->get_total_registros()>3)
	{
	$tpl->newBlock("BUSQUEDA-PIE");
	$tpl->assign("TEXTO", $paginador_listado);
	}	
*/

$tpl->newBlock("ORDEN");

$tpl->newBlock("TABLA-HEAD");
$tpl->newBlock("TABLA-HEAD-FILA");
$tpl->assign("PARAM",'class="cabezera_tabla"');
$tpl->newBlock("TABLA-HEAD-ROW");
$tpl->assign("PARAM",'style="position:relative;padding-left:5px;text-align:left;"');
if($campo=="zon_nombre" && ($orden=="asc" || $orden=="desc"))
	{
	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';
	}
else
	{
	$txt_orden = '';
	}
$tpl->assign("TEXTO",'Zona <img id="op1" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op1\',\'zon_nombre\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);

$tpl->newBlock("TABLA-HEAD-ROW");
$tpl->assign("PARAM",'width="64px" style="padding-left:5px;text-align:right;"');

$i=0;
while($row = $paginas->get_fila())
	{
	$i++;
	if ($i>1)
		{
		$color="#ecf0fc";
		$i=0;
		}
	else
		{
		$color="#becaec";
		}
		
	$tpl->newBlock("TABLA-FILA");
	$tpl->assign("PARAM",'bgcolor="'.$color.'"');
	$tpl->newBlock("TABLA-ROW");
	$tpl->assign("PARAM",' style="text-align:left;"');
	$tpl->assign("TEXTO",$row[1]);
	
	$iconos = '';
	if($row[2])
		{
		$ruta = '../'.$_SESSION['PATH_ARCHIVOS'].$row[2];
		
		$iconos .= "<img src=\"../img/icons/camera.png\" width=\"16\" onmouseover=\"Tip('&lt;img src=\'".$ruta."\'  width=\'150\' class=\'foto\'&gt;',CLICKCLOSE, true,FADEIN, 200, FADEOUT, 200,BORDERCOLOR,'#424242')\" onmouseout=\"UnTip()\" />";
		}
	$iconos .= '<img src="../img/icons/modificar.png" title="Editar Localidad" width="16" height="16"  style="cursor:pointer" onclick="cargar(\''.$row[0].'\')" />';
	$iconos .= '<img src="../img/icons/borrar.png" title="Eliminar Localidad" width="16" height="16" style="cursor:pointer" onclick="eliminar(\''.$row[0].'\')" />';
	
	$tpl->newBlock("TABLA-ROW");
	$tpl->assign("PARAM",' style="text-align:right;"');
	$tpl->assign("TEXTO",$iconos);
	
	}	

include("../includes/footer.php");
?>