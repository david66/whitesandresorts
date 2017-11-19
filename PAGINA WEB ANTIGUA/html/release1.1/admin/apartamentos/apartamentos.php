<?php

session_start();



require_once("../Connections/conect.php");



//CARGA LAS VARIABLES GLOBALES

require_once('../includes/globales.php');



//CONTROLA EL CIERRE DE SESSION

require_once('../includes/seguridad.php');



include("../includes/head.php");

include("../includes/menu.php");



//BUSCAMOS LAS CLANES QUE NECESITAMOS

require_once("class.accion_apartamentos.inc.php");

require_once("class.paginador.inc.php");

require_once("class.apartamentos.inc.php");



$tpl->gotoBlock('_ROOT');

$tpl->assign('TEXTO','APARTAMENTOS');



$tpl->newBlock("INCLUDE-CSS");
$tpl->assign("RUTA", "../scripts/calendar/dhtmlgoodies_calendar.css");

$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/calendar/dhtmlgoodies_calendar.js");

$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/XinhaConfig.js");

$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/editor/XinhaCore.js");

$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/dynamic_multifile.php?i=img_general&f=gene_&t=1");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/dynamic_multifile.php?i=img_localizacion&f=loca_&t=2");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/dynamic_multifile.php?i=img_precio&f=prec_&t=3");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/dynamic_multifile.php?i=img_entorno&f=ento_&t=4");
$tpl->newBlock("INCLUDE-JAVASCRIPT");
$tpl->assign("RUTA", "../scripts/dynamic_multifile.php?i=img_servicios&f=serv_&t=5");


$tpl->newBlock("JAVASCRIPT");
$tpl->assign("JAVASCRIPT",'
    _editor_url  = "../scripts/editor/";
    _editor_lang = "es"; 
');


//FORMULARIO DE ALTA

//IDIOMAS

$sql="select idi_id from idiomas order by idi_id ASC";

$idiomas = mysql_query($sql, $mysql->get_conect()) or die(mysql_error());



//MUESTRO EL FORMULARIO DE APARTAMENTOS

$tpl->newBlock('FORMULARIO');

$tpl->assign('FORM','form1');

$tpl->assign('PARAM','id="alta_modi"');



$tpl->newBlock('FB');

$tpl->newBlock('FILA');

$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-current');

$tpl->assign('ID','tb1');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb1\',\'txt_nombre\')"');

$tpl->assign('TEXTO','RESORT  General');



$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-active');

$tpl->assign('ID','tb2');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb2\',\'txt_zona\')"');

$tpl->assign('TEXTO','Localizacion y Accesos');



$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-active');

$tpl->assign('ID','tb4');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb4\',\'txt_precio\')"');

$tpl->assign('TEXTO','Vivienda y Precio');



$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-active');

$tpl->assign('ID','tb3');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb3\',\'txt_metros\')"');

$tpl->assign('TEXTO','Entorno y Actividades');



$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-active');

$tpl->assign('ID','tb5');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb5\',\'txt_informacion\')"');

$tpl->assign('TEXTO','Información y Servicios');



$tpl->newBlock('PESTANA');

$tpl->assign('CLASS','bto-active');

$tpl->assign('ID','tb6');

$tpl->assign('ACCION',' onclick="bto_pestana(\'tb6\')"');

$tpl->assign('TEXTO','Galería de Fotos');



$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb1" class="tab-tabla"');



$tabindex=1;

//CAMPO ORDEN JON

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','order');

$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_order');

$tpl->assign('ID','txt_order');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

//CAMPO APARTAMENTOSS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Apartamento');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_nombre');

$tpl->assign('ID','txt_nombre');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



//CAMPO ESTADO

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Estado');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','txt_estado');

$tpl->assign('ID','txt_estado');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','1');

$tpl->assign('TEXTO','Nuevo');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','0');

$tpl->assign('TEXTO','Segunda Mano');



//CAMPO DESCRIPCION

mysql_data_seek($idiomas,0);

while($lang = mysql_fetch_array($idiomas))

	{

	$tpl->newBlock('FILA');

	$tpl->newBlock('CAMPO');

	$tpl->assign('TITULO','Presentación <img src="../img/flags/flags_'.$lang['idi_id'].'.gif" height="14">');

	$tpl->assign('CLASE','fm-campo2');



	$tpl->newBlock('TEXT');

	$tpl->assign('NAME','txt_descripcion[]');

	$tpl->assign('ID','txt_descripcion_'.$lang['idi_id']);

	$tpl->assign('TAB',$tabindex++);

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}

	

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

	

//SEGUNDA PESTAÑA

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb2" class="tab-tabla" style="display:none;"');



//ZONAS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Zona');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('SELECT');

$tpl->assign('NAME','txt_zona');

$tpl->assign('ID','txt_zona');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');



$sql = "select zon_id,zon_nombre from zonas";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR PRO-148: NO SE PUDO CARGAR LAS ZONAS");

while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['zon_id']);

	$tpl->assign('TEXTO',$row['zon_nombre']);

	}



//PAIS

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','País');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('SELECT');

$tpl->assign('NAME','txt_pais');

$tpl->assign('ID','txt_pais');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');



$sql = "select pai_id,pai_nombre from paises";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR PRO-148: NO SE PUDO CARGAR LOS PAISES");

while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['pai_id']);

	$tpl->assign('TEXTO',$row['pai_nombre']);

	}

	

//PROVINCIAS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Provincia');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_provincia');

$tpl->assign('ID','txt_provincia');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



/*	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','txt_provincia');

$tpl->assign('ID','txt_provincia');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" disabled');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');



$sql = "select pro_id,pro_nombre from provincias";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR PRO-148: NO SE PUDO CARGAR LAS PROVINCIAS");

while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['pro_id']);

	$tpl->assign('TEXTO',$row['pro_nombre']);

	}

*/

	

//CAMPO LOCALIDAD

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Ciudad');



$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_ciudad');

$tpl->assign('ID','txt_ciudad');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	

/*

$tpl->newBlock('SELECT');

$tpl->assign('NAME','txt_ciudad');

$tpl->assign('ID','txt_ciudad');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" disabled');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

*/



//CAMPO DIRECCIÓN

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Dirección');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_direccion');

$tpl->assign('ID','txt_direccion');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



//CAMPO CP

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Código Postal');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_cp');

$tpl->assign('ID','txt_cp');

$tpl->assign('MAX','60');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



//MAS INFORMACION

mysql_data_seek($idiomas,0);

while($lang = mysql_fetch_array($idiomas))

	{

	$tpl->newBlock('FILA');

	$tpl->newBlock('CAMPO');

	$tpl->assign('TITULO','Información <img src="../img/flags/flags_'.$lang['idi_id'].'.gif" height="14">');

	$tpl->assign('CLASE','fm-campo2');



	$tpl->newBlock('TEXT');

	$tpl->assign('NAME','txt_ubicacion[]');

	$tpl->assign('ID','txt_ubicacion_'.$lang['idi_id']);

	$tpl->assign('TAB',$tabindex++);

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}

//TERCERA PESTAÑA

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb3" class="tab-tabla" style="display:none;"');



//CAMPO METOS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Metros');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_metros');

$tpl->assign('ID','txt_metros');

$tpl->assign('MAX','10');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');



//CAMPO DORMITORIOS

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Dormitorios');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_dormitorios');

$tpl->assign('ID','txt_dormitorios');

$tpl->assign('MAX','10');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');



//tipologia

mysql_data_seek($idiomas,0);

while($lang = mysql_fetch_array($idiomas))

	{

	$tpl->newBlock('FILA');

	$tpl->newBlock('CAMPO');

	$tpl->assign('TITULO','Tipología <img src="../img/flags/flags_'.$lang['idi_id'].'.gif" height="14">');

	$tpl->assign('CLASE','fm-campo2');



	$tpl->newBlock('TEXT');

	$tpl->assign('NAME','txt_tipologia[]');

	$tpl->assign('ID','txt_tipologia_'.$lang['idi_id']);

	$tpl->assign('TAB',$tabindex++);

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}

	

//PLANO

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Plano');

$tpl->assign('CLASE','fm-campo2');



$tpl->newBlock('FILE');

$tpl->assign('NAME','file_plano');

$tpl->assign('ID','file_plano');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' '); //insertar script de plano



//PLANO ACTUAL

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','&nbsp;');

$tpl->assign('CLASE','fm-campo2');



$tpl->assign('TEXTO','<div id="plano_altual" style="display:none;"><b>Plano Actual:</b> <span id="plano_nombre"></span> <input type="button" id="eliminar_plano" class="bto-eliminar" onclick="borrar_plano()"></div>');



//CUARTA PESTAÑA

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb4" class="tab-tabla" style="display:none;"');



//CAMPO PRECIO

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Precio');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','txt_precio');

$tpl->assign('ID','txt_precio');

$tpl->assign('MAX','10');

$tpl->assign('VALOR','');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsFloat(event)" onkeyup="return tabular(event,this)"');



//pago

mysql_data_seek($idiomas,0);

while($lang = mysql_fetch_array($idiomas))

	{

	$tpl->newBlock('FILA');

	$tpl->newBlock('CAMPO');

	$tpl->assign('TITULO','Forma de Pago <img src="../img/flags/flags_'.$lang['idi_id'].'.gif" height="14">');

	$tpl->assign('CLASE','fm-campo2');



	$tpl->newBlock('TEXT');

	$tpl->assign('NAME','txt_pago[]');

	$tpl->assign('ID','txt_pago_'.$lang['idi_id']);

	$tpl->assign('TAB',$tabindex++);

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}



//QUINTA PESTAÑA

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb5" class="tab-tabla" style="display:none;"');



//informacion util

mysql_data_seek($idiomas,0);

while($lang = mysql_fetch_array($idiomas))

	{

	$tpl->newBlock('FILA');

	$tpl->newBlock('CAMPO');

	$tpl->assign('TITULO','Información Útil <img src="../img/flags/flags_'.$lang['idi_id'].'.gif" height="14">');

	$tpl->assign('CLASE','fm-campo2');



	$tpl->newBlock('TEXT');

	$tpl->assign('NAME','txt_informacion[]');

	$tpl->assign('ID','txt_informacion_'.$lang['idi_id']);

	$tpl->assign('TAB',$tabindex++);

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}

	

//GALERIA

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="tb6" class="tab-tabla" style="display:none;"');



//CAMPO ARCHIVO
$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Generales');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','multiarchivo');
$tpl->assign('ID','multiarchivo');
$tpl->assign('TAB',$tabindex++);
$tpl->assign('ACCIONES','class="multiarchivo_file"');

$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span style="float:left;padding-top:4px">
<div id="files_list"></div>
<script>
var img_general = new class_img_general( $( \'files_list\' ), $(\'form1\'), 99 );
img_general.addElement( $( \'multiarchivo\' ) );
</script>
</span>');

//CAMPO ARCHIVO
$tpl->newBlock('FILA');
$tpl->assign('ACCIONES','id="img_localizacion" style="display:block;"');

$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Loc. y Accesos');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','multilocalizacion');
$tpl->assign('ID','multilocalizacion');
$tpl->assign('TAB',$tabindex++);
$tpl->assign('ACCIONES','class="multiarchivo_file"');

$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span style="float:left;padding-top:4px">
<div id="localizacion_list"></div>
<script>
var img_localizacion = new class_img_localizacion( $( \'localizacion_list\' ), $(\'form1\'), 99 );
img_localizacion.addElement( $( \'multilocalizacion\' ) );
</script>
</span>');

//CAMPO ARCHIVO
$tpl->newBlock('FILA');
$tpl->assign('ACCIONES','id="img_precio" style="display:block;"');

$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Precios');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','multiprecio');
$tpl->assign('ID','multiprecio');
$tpl->assign('TAB',$tabindex++);
$tpl->assign('ACCIONES','class="multiarchivo_file"');

$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span style="float:left;padding-top:4px">
<div id="precio_list"></div>
<script>
var img_precio = new class_img_precio( $( \'precio_list\' ), $(\'form1\'), 99 );
img_precio.addElement( $( \'multiprecio\' ) );
</script>
</span>');

//CAMPO ARCHIVO
$tpl->newBlock('FILA');
$tpl->assign('ACCIONES','id="img_entorno" style="display:block;"');

$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Entorno');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','multientorno');
$tpl->assign('ID','multientorno');
$tpl->assign('TAB',$tabindex++);
$tpl->assign('ACCIONES','class="multiarchivo_file"');

$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span style="float:left;padding-top:4px">
<div id="entorno_list"></div>
<script>
var img_entorno = new class_img_entorno( $( \'entorno_list\' ), $(\'form1\'), 99 );
img_entorno.addElement( $( \'multientorno\' ) );
</script>
</span>');

//CAMPO ARCHIVO
$tpl->newBlock('FILA');
$tpl->assign('ACCIONES','id="img_servicios" style="display:block;"');

$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','Servicios');
$tpl->assign('CLASE','fm-campo');

$tpl->newBlock('FILE');
$tpl->assign('NAME','multiservicios');
$tpl->assign('ID','multiservicios');
$tpl->assign('TAB',$tabindex++);
$tpl->assign('ACCIONES','class="multiarchivo_file"');

$tpl->newBlock('FILA');
$tpl->newBlock('CAMPO');
$tpl->assign('TITULO','&nbsp;');
$tpl->assign('CLASE','fm-campo2');
$tpl->assign('TEXTO','<span style="float:left;padding-top:4px">
<div id="servicios_list"></div>
<script>
var img_servicios = new class_img_servicios( $( \'servicios_list\' ), $(\'form1\'), 99 );
img_servicios.addElement( $( \'multiservicios\' ) );
</script>
</span>');



//BOTONES

$tpl->newBlock('FB');

$tpl->newBlock('BOTONES');

$tpl->newBlock('BOTON-INPUT');

$tpl->assign('ACCION','javascript:validar()');

$tpl->assign('VALOR','Guardar');

$tpl->assign('NOMBRE','guardar');

$tpl->assign('CLASS','bto-guardar');

$tpl->assign('TAB',$tabindex++);



$tpl->newBlock('BOTON-INPUT');

$tpl->assign('ACCION','javascript:cancel_form()');

$tpl->assign('VALOR','Cancelar');

$tpl->assign('NOMBRE','cancelar');

$tpl->assign('CLASS','bto-cancelar');

$tpl->assign('TAB',$tabindex++);



$tpl->newBlock('HIDDEN');

$tpl->assign('NOMBRE','txt_id');

$tpl->assign('VALOR','');



$tpl->newBlock('HIDDEN');

$tpl->assign('NOMBRE','txt_del');

$tpl->assign('VALOR','');



$tpl->newBlock('HIDDEN');

$tpl->assign('NOMBRE','txt_del_plano');

$tpl->assign('VALOR','');



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

	$busqueda = new apartamentos();	

	$busqueda->set_nombre($busc_nombre);

	$busqueda->set_zona($busc_zona);

	$busqueda->set_provincia($busc_provincia);

	$busqueda->set_ciudad($busc_ciudad);

	$busqueda->set_estado($busc_estado);

	$busqueda->set_dormitorios($busc_dormitorios);

	$busqueda->set_metros($busc_metros);

	$busqueda->set_precio_min($busc_precio_min);

	$busqueda->set_precio_max($busc_precio_max);

	}

else

	{

	if($_GET['busqueda'])

		{

		$busqueda = unserialize($_SESSION['BUSQUEDA']);

		}

	else

		{

		$busqueda = new apartamentos();

		//indica si el buscador esta vacio

		$vacio = true;

		}

	}



//MUESTRO EL FORMULARIO DE APARTAMENTOS

$tpl->newBlock('FORMULARIO');

$tpl->assign('FORM','form2');

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="mod_buscador"');



//ZONAS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Zona');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_zona');

$tpl->assign('ID','busc_zona');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

$tpl->assign('SELECTED',($busqueda->get_zona()=='')?'selected':'');



$sql = "select zon_id,zon_nombre from zonas";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-148: NO SE PUDO CARGAR LAS ZONAS");

while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['zon_id']);

	$tpl->assign('TEXTO',$row['zon_nombre']);

	$tpl->assign('SELECTED',($busqueda->get_zona()==$row['zon_id'])?'selected':'');

	}



/*

//CAMPO ESTADO

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Tipo');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_estado');

$tpl->assign('ID','busc_estado');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','2');

$tpl->assign('TEXTO','Nuevo');

$tpl->assign('SELECTED',($busqueda->get_estado()=='0')?'selected':'');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','1');

$tpl->assign('TEXTO','Segunda Mano');

$tpl->assign('SELECTED',($busqueda->get_estado()=='1')?'selected':'');

*/



//PAIS

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','País');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_pais');

$tpl->assign('ID','busc_pais');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,2)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

$tpl->assign('SELECTED',($busqueda->get_zona()=='')?'selected':'');



$sql = "select pai_id,pai_nombre from paises";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-148: NO SE PUDO CARGAR EL PAIS");

while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['pai_id']);

	$tpl->assign('TEXTO',$row['pai_nombre']);

	$tpl->assign('SELECTED',($busqueda->get_zona()==$row['pai_id'])?'selected':'');

	}



//PROVINCIAS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Provincia');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_provincia');

$tpl->assign('ID','busc_provincia');

$tpl->assign('TAB',$tabindex++);

if($busqueda->get_pais())

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,2)"');

	}

else

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,2)" disabled');

	}



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

$tpl->assign('SELECTED',($busqueda->get_provincia()=='')?'selected':'');



if($busqueda->get_pais())

	{

	$sql = "SELECT apa_provincia from apartamentos WHERE pai_id='".$busqueda->get_pais()."' group by apa_provincia";

	$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-148: NO SE PUDO CARGAR LAS PROVINCIAS");

	while($row = mysql_fetch_array($ciudades))

		{

		$tpl->newBlock('SELECT-OPTION');

		$tpl->assign('VALOR',$row['apa_provincia']);

		$tpl->assign('TEXTO',$row['apa_provincia']);

		$tpl->assign('SELECTED',($busqueda->get_provincia()==$row['apa_provincia'])?'selected':'');

		}

	}



//CAMPO CIUDAD

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Ciudad');

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_ciudad');

$tpl->assign('ID','busc_ciudad');

$tpl->assign('TAB',$tabindex++);

if($busqueda->get_provincia())

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');

	}

else

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" disabled');

	}



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

$tpl->assign('SELECTED',($busqueda->get_ciudad()=='')?'selected':'');	

	

if($busqueda->get_provincia())

	{

	$sql = "SELECT apa_ciudad from apartamentos WHERE apa_provincia='".$busqueda->get_provincia()."' group by apa_ciudad";

	$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-392: NO SE PUDO CARGAR LAS CIUDADES");

	while($row = mysql_fetch_array($ciudades))

		{

		$tpl->newBlock('SELECT-OPTION');

		$tpl->assign('VALOR',$row['apa_ciudad']);

		$tpl->assign('TEXTO',$row['apa_ciudad']);

		$tpl->assign('SELECTED',($busqueda->get_ciudad()==$row['apa_ciudad'])?'selected':'');

		}

	}

	

//CAMPO METOS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Metros');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_metros');

$tpl->assign('ID','busc_metros');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_metros());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');



//CAMPO DORMITORIOS

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Dormitorios');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_dormitorios');

$tpl->assign('ID','busc_dormitorios');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_dormitorios());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');



//CAMPO PRECIO

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Precio desde');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_precio_min');

$tpl->assign('ID','busc_precio_min');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_precio_min());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsFloat(event)" onkeyup="return tabular(event,this)"');



//CAMPO PRECIO

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO','Hasta');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_precio_max');

$tpl->assign('ID','busc_precio_max');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_precio_max());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsFloat(event)" onkeyup="return tabular(event,this)"');



//BOTONES

$tpl->newBlock('BOTONES');

$tpl->newBlock('BOTON-INPUT');

$tpl->assign('ACCION','javascript:buscador()');

$tpl->assign('VALOR','Buscar');

$tpl->assign('NOMBRE','buscar');

$tpl->assign('CLASS','bto-buscar');

$tpl->assign('TAB',$tabindex++);



$tpl->newBlock('BOTON-INPUT');

$tpl->assign('ACCION','javascript:ocu_form()');

$tpl->assign('VALOR','Cancelar');

$tpl->assign('NOMBRE','cancelar');

$tpl->assign('CLASS','bto-cancelar');

$tpl->assign('TAB',$tabindex++);





//GENERAMOS EL LISTADO

	

//INSTACIAMOS EL PAGINADOR Y LA ACCION DE LISTADO

$acciones = new accion_apartamentos($mysql->get_conect());

$paginas = new paginador($mysql->get_conect());	

$paginas->set_nro_pagina($_GET['pageNum']);



if($_GET['campo'] && $_GET['ord'])

	{

	if(!is_object($busqueda))

		{

		$busqueda = new apartamentos();	

		}

	$busqueda->set_campo($_GET['campo']);

	$busqueda->set_orden($_GET['ord']);	

	$vacio = false;

	}

	

//PAGINAMOS LOS RESULTADOS

$paginas->paginar_resultados($acciones->listado($busqueda));

//SERIALIZAMOS Y DESTRUIMOS EL OBJETO

if(!$vacio)

	{

	$campo = $busqueda->get_campo();

	$orden = $busqueda->get_orden();

	

	$_SESSION['BUSQUEDA'] = serialize($busqueda);

	$queryString = "&busqueda=1";

	}

	

unset($busqueda);



$tpl->newBlock("TABLA");

$tpl->assign("CLASS",' id="mod_listado"');

$tpl->assign("TEXTO",'<div class="ref">Referencias: <img src="../img/icons/modificar.png" width="16px"> Modificar - <img src="../img/icons/borrar.png" width="16px"> Borrar</div>');



$tpl->newBlock("BUSQUEDA");



$tpl->newBlock("BUSC-BOTON");

$tpl->assign("LINK","javascript:mostrar_buscador();");

$tpl->assign("TEXTO","BUSCAR");

$tpl->assign("SEPARADOR","|");



$tpl->newBlock("BUSC-BOTON");

$tpl->assign("LINK","javascript:mostrar_form('txt_nombre');");

$tpl->assign("TEXTO","NUEVO APARTAMENTOS");



if(!$vacio)

	{

	$tpl->assign("SEPARADOR","|");

	$tpl->newBlock("BUSC-BOTON");

	$tpl->assign("LINK","apartamentos.php");

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

$tpl->assign("PARAM",' colspan="2" style="position:relative;padding-left:5px;text-align:left;"');

$tpl->assign("TEXTO",'Apartamento');



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="10%" style="position:relative;padding-left:5px;text-align:left;"');

if($campo=="apa_estado" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'Tipo <img id="op1" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op1\',\'apa_estado\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="16%" style="position:relative;padding-left:5px;text-align:left;"');

if($campo=="ciu_nombre" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'Ciudad <img id="op2" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op2\',\'ciu_nombre\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="16%" style="position:relative;padding-left:5px;text-align:left;"');

if($campo=="apa_direccion" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'Dirección <img id="op3" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op3\',\'apa_direccion\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="8%" style="position:relative;padding-left:5px;text-align:left;"');

if($campo=="apa_metros" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'m<sup>2</sup> <img id="op4" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op4\',\'apa_metros\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="8%" style="position:relative;padding-left:5px;text-align:left;"');

if($campo=="apa_dormitorios" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'Dorm. <img id="op5" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op5\',\'apa_dormitorios\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="12%" style="position:relative;padding-left:5px;text-align:left;"');$tpl->assign("TEXTO",'Orden');

if($campo=="apa_precio" && ($orden=="asc" || $orden=="desc"))

	{

	$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

	}

else

	{

	$txt_orden = '';

	}

$tpl->assign("TEXTO",'Precio <img id="op6" src="../img/icon/viniet.gif" width="13" height="9" onclick="orden(\'op6\',\'apa_precio\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);

// TAB JON ORDEN
$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",' width="12%" style="position:relative;padding-left:5px;text-align:left;"');$tpl->assign("TEXTO",'Orden');
// EOF JON TAB ORDEN

$tpl->newBlock("TABLA-HEAD-ROW");

$tpl->assign("PARAM",'width="32px" style="padding-left:5px;text-align:right;"');



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

		

	$sql = "select aga_imagen from apartamento_galerias where apa_id='".$row[0]."' limit 0,1";

	$imagen = mysql_query($sql, $mysql->get_conect()) or die("ERR DTO-945: NO SE PUDO MOSTRAR LAS IMAGENES");

	if(mysql_num_rows($imagen)>0)

		{

		$imagen = '../dibujar.php?file=archivos/'.mysql_result($imagen,0).'&width=50&height=40';

		}

	else

		{

		$imagen = '../img/noportada.gif';

		}



	$tpl->newBlock("TABLA-FILA");

	$tpl->assign("PARAM",'bgcolor="'.$color.'"');

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' width="50"');

	$tpl->assign("TEXTO",'<img src="'.$imagen.'" width="50" />');

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:left;"');

	$tpl->assign("TEXTO",$row['apa_nombre']);

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:center;"');

	$tpl->assign("TEXTO",(($row['apa_estado']==1)?'Nuevo':'2<sup>da</sup> Mano'));

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:left;"');

	$tpl->assign("TEXTO",$row['apa_ciudad']);

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:left;"');

	$tpl->assign("TEXTO",$row['apa_direccion']);

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:center;"');

	$tpl->assign("TEXTO",$row['apa_metros']);

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:center;"');

	$tpl->assign("TEXTO",$row['apa_dormitorios']);

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:left;"');

	$tpl->assign("TEXTO",$row['apa_precio'].' &euro;');

	//JON
	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:left;"');

	$tpl->assign("TEXTO",$row['apa_order']);
	//JON

	$iconos = '';

	$iconos .= '<img src="../img/icons/modificar.png" title="Editar Apartamento" width="16" height="16"  style="cursor:pointer" onclick="cargar(\''.$row[0].'\')" />';

	$iconos .= '<img src="../img/icons/borrar.png" title="Eliminar Apartamento" width="16" height="16" style="cursor:pointer" onclick="eliminar(\''.$row[0].'\')" />';

	

	$tpl->newBlock("TABLA-ROW");

	$tpl->assign("PARAM",' style="text-align:right;"');

	$tpl->assign("TEXTO",$iconos);

	

	}	



include("../includes/footer.php");

?>