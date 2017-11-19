<?php

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

	$busqueda->set_pais($busc_pais);

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



//SETEO EL ESTADO Y LA ZONA	

if($vacio)

	{

	$busqueda->set_estado(2); //usados

	$busqueda->set_zona($_SESSION['zona']); //zona

	}

	

//MUESTRO EL FORMULARIO DE APARTAMENTOS

$tpl->newBlock('FORMULARIO');

$tpl->assign('FORM','form2');

$tpl->newBlock('FB');

$tpl->assign('PARAM','id="buscador"');



//ZONA

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO',_('Zonas'));

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_zona');

$tpl->assign('ID','busc_zona');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO',_('Seleccione'));

$tpl->assign('SELECTED',($busqueda->get_zona()=='')?'selected':'');



$sql = "select zon_id,zon_nombre from zonas";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-148: NO SE PUDO CARGAR LAS ZONAS");



$zon_id = ($busqueda->get_zona())?$busqueda->get_zona():$zon_id;



while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['zon_id']);

	$tpl->assign('TEXTO',$row['zon_nombre']);

	$tpl->assign('SELECTED',($zon_id==$row['zon_id'])?'selected':'');

	}



//PAIS

//$tpl->newBlock('FILA');
/* PAIS JON */
$tpl->newBlock('CAMPO');

// JON $tpl->assign('TITULO','Pais');

$tpl->assign('CLASE','fm-campo oculto');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_pais');

$tpl->assign('ID','busc_pais');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,2)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO','Seleccione...');

$tpl->assign('SELECTED',($busqueda->get_pais()=='')?'selected':'');



$sql = "select pai_id,pai_nombre from paises";

$ciudades = mysql_query($sql,$mysql->get_conect()) or die("ERR CIU-148: NO SE PUDO CARGAR LOS PAISES");



$pais_actual = ($busqueda->get_pais())?$busqueda->get_pais():$pais_actual;



while($row = mysql_fetch_array($ciudades))

	{

	$tpl->newBlock('SELECT-OPTION');

	$tpl->assign('VALOR',$row['pai_id']);

	$tpl->assign('TEXTO',$row['pai_nombre']);

	$tpl->assign('SELECTED',($pais_actual==$row['pai_id'])?'selected':'');

	}



//CAMPO ESTADO

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

$tpl->assign('TITULO',_('Tipo'));

$tpl->assign('CLASE','fm-campo');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_estado');

$tpl->assign('ID','busc_estado');

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)"');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO',_('Seleccione'));



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','1');

$tpl->assign('TEXTO',_('Nuevo'));

$tpl->assign('SELECTED',($busqueda->get_estado()=='1')?'selected':'');



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','2');

$tpl->assign('TEXTO',_('Turismo'));

$tpl->assign('SELECTED',($busqueda->get_estado()=='2')?'selected':'');

	

//PROVINCIAS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

// $tpl->assign('TITULO','Provincia');

$tpl->assign('CLASE','fm-campo oculto');

	

$tpl->newBlock('SELECT');

$tpl->assign('NAME','busc_provincia');

$tpl->assign('ID','busc_provincia');

$tpl->assign('TAB',$tabindex++);

if($pais_actual)

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" onChange="cargaContenido(this.id,2)"');

	}

else

	{

	$tpl->assign('ACCIONES',' onkeyup="return tabular(event,this)" disabled');

	}



$tpl->newBlock('SELECT-OPTION');

$tpl->assign('VALOR','');

$tpl->assign('TEXTO',_('Seleccione...'));

$tpl->assign('SELECTED',($pais_actual=='')?'selected':'');	

	

if($pais_actual)

	{	

	$sql = "SELECT apa_provincia from apartamentos WHERE pai_id='".$pais_actual."' group by apa_provincia";

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

// $tpl->assign('TITULO','Ciudad');

$tpl->assign('CLASE','fm-campo oculto');

	

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

$tpl->assign('TEXTO',_('Seleccione...'));

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

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

// $tpl->assign('TITULO','Metros');

$tpl->assign('CLASE','fm-campo oculto');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_metros');

$tpl->assign('ID','busc_metros');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_metros());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');





//CAMPO DORMITORIOS

$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

// $tpl->assign('TITULO','Dormitorios');

$tpl->assign('CLASE','fm-campo oculto');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_dormitorios');

$tpl->assign('ID','busc_dormitorios');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_dormitorios());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsNumber(event)" onkeyup="return tabular(event,this)"');



//CAMPO PRECIO

//$tpl->newBlock('FILA');

$tpl->newBlock('CAMPO');

//$tpl->assign('TITULO','Precio desde');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo oculto');



$tpl->newBlock('INPUT');

$tpl->assign('NAME','busc_precio_min');

$tpl->assign('ID','busc_precio_min');

$tpl->assign('MAX','10');

$tpl->assign('VALOR',$busqueda->get_precio_min());

$tpl->assign('TAB',$tabindex++);

$tpl->assign('ACCIONES',' onkeypress="return IsFloat(event)" onkeyup="return tabular(event,this)"');



//CAMPO PRECIO

$tpl->newBlock('CAMPO');

//$tpl->assign('TITULO','Precio hasta');

//$tpl->assign('CLASE-TEXTO','2');

$tpl->assign('CLASE','fm-campo oculto');



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

$tpl->assign('VALOR',_('Buscar'));

$tpl->assign('NOMBRE',_('Buscar'));

$tpl->assign('CLASS','bto-buscar');

$tpl->assign('TAB',$tabindex++);

?>