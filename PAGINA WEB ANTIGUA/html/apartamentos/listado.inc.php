<?php

require_once("includes/class.TemplatePower.inc.php");

$tpl = new TemplatePower("tpl/template.tpl");

$tpl->prepare();



//BUSCAMOS LAS CLANES QUE NECESITAMOS

require_once("admin/apartamentos/class.accion_apartamentos.inc.php");

require_once("admin/apartamentos/class.paginador.inc.php");

require_once("admin/apartamentos/class.apartamentos.inc.php");



require_once('busqueda.inc.php');



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



if($paginas->get_total_registros()>0)

	{

	$tpl->newBlock("TABLA");

	$tpl->assign("CLASS",' id="listado"');



	$tpl->newBlock("ORDEN");



	$tpl->newBlock("TABLA-HEAD");

	$tpl->newBlock("TABLA-HEAD-FILA");

	$tpl->assign("PARAM",'class="cabezera_tabla"');

	$tpl->newBlock("TABLA-HEAD-ROW");

	$tpl->assign("PARAM",' colspan="2" style="position:relative;padding-left:5px;text-align:left;"');

	$tpl->assign("TEXTO",_('Apartamento'));



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

	$tpl->assign("TEXTO",_('Tipo'). '<img id="op1" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op1\',\'apa_estado\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



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

	$tpl->assign("TEXTO",_('Ciudad'). '<img id="op2" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op2\',\'ciu_nombre\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



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

	$tpl->assign("TEXTO",_('Dirección'). ' <img id="op3" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op3\',\'apa_direccion\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



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

	$tpl->assign("TEXTO",'m<sup>2</sup> <img id="op4" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op4\',\'apa_metros\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



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

	$tpl->assign("TEXTO",_('Dorm.') . '<img id="op5" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op5\',\'apa_dormitorios\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



	$tpl->newBlock("TABLA-HEAD-ROW");

	$tpl->assign("PARAM",' width="12%" style="position:relative;padding-left:5px;text-align:left;"');

	if($campo=="apa_precio" && ($orden=="asc" || $orden=="desc"))

		{

		$txt_orden = ($orden=="desc")?'<span style="font-size:9px">(Z-A)</span>':'<span style="font-size:9px">(A-Z)</span>';

		}

	else

		{

		$txt_orden = '';

		}

	$tpl->assign("TEXTO",_('Precio'). ' <img id="op6" src="images/icon/viniet.gif" width="13" height="9" onclick="orden(\'op6\',\'apa_precio\','.(($vacio)?'0':'1').')" style="cursor:pointer" />'.$txt_orden);



	$i=0;

	while($row = $paginas->get_fila())

		{

		$i++;

		if ($i>1)

			{

			$color="#000000";

			$i=0;

			}

		else

			{

			$color="#000000";

			}

			

		$sql = "select aga_imagen from apartamento_galerias where apa_id='".$row[0]."' order by aga_id ASC limit 0,1";

		$imagen = mysql_query($sql, $mysql->get_conect()) or die("ERR DTO-945: NO SE PUDO MOSTRAR LAS IMAGENES");

		if(mysql_num_rows($imagen)>0)

			{

			$imagen = 'dibujar.php?file=admin/archivos/'.mysql_result($imagen,0).'&ancho=50&alto=40&cut=1';

			}

		else

			{

			$imagen = 'images/noportada.gif';

			}



		$tpl->newBlock("TABLA-FILA");

		$tpl->assign("PARAM",'bgcolor="'.$color.'" class="filas_tabla" onclick="location.href=\''.$url.$row['apa_url'].'\'"');

		$tpl->newBlock("TABLA-ROW");

		$tpl->assign("PARAM",' width="50"');

		$tpl->assign("TEXTO",'<img src="'.$imagen.'" width="50" />');

		$tpl->newBlock("TABLA-ROW");

		$tpl->assign("PARAM",' style="text-align:left;"');

		$tpl->assign("TEXTO",$row['apa_nombre']);

		$tpl->newBlock("TABLA-ROW");

		$tpl->assign("PARAM",' style="text-align:center;"');

		$tpl->assign("TEXTO",(($row['apa_estado']==1)?_('Nuevo'):_('Turismo')));

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

		}



	// BOTONES DEL PAGINADOR

	$tpl->gotoBlock('_ROOT');

	$paginador_listado = ($paginas->get_nro_pagina() > 0)?'<img src="images/icon/first-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], 0, $queryString).'\'" >':'<img src="images/icon/first-ap.png" />';

	$paginador_listado .= ($paginas->get_nro_pagina() > 0)?'<img src="images/icon/left-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], max(0, $paginas->get_nro_pagina() - 1), $queryString).'\'" >':'<img src="images/icon/left-ap.png" />';

	$paginador_listado .= min($paginas->get_reg_actual() + $paginas->get_reg_pagina(), $paginas->get_total_registros()).' de '.$paginas->get_total_registros();

	$paginador_listado .= ($paginas->get_nro_pagina() < $paginas->get_cant_paginas())?'<img src="images/icon/right-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], max($paginas->get_cant_paginas(), $paginas->get_nro_pagina() + 1), $queryString).'\'" >':'<img src="images/icon/right-ap.png" />';

	$paginador_listado .= ($paginas->get_nro_pagina() < $paginas->get_cant_paginas())?'<img src="images/icon/last-pre.png" onclick="location.href=\''.sprintf("%s?pageNum=%d%s", $_SERVER['PHP_SELF'], $paginas->get_total_registros(), $queryString).'\'" >':'<img src="images/icon/last-ap.png" />';



	$tpl->assign("PIE", '<div class="paginador">'.$paginador_listado.'</div>');

	}

else

	{

	$tpl->gotoBlock('_ROOT');

	

	if($queryString != "&busqueda=1")

		{

		$mensaje = _('No hay apartamentos cargados para esta zona');

		}

	else

		{

		$mensaje = _('No hay apartamentos que coincidan con la búsqueda');

		}

	$tpl->assign("PIE", '<div class="paginador">'.$mensaje.'</div>');

	}

	

$tpl->printToScreen();

?>