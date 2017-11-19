<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{TITULO}</title>
	<!-- START BLOCK : INCLUDE-CSS -->
	<link href="{RUTA}" rel="stylesheet" type="text/css" />
	<!-- END BLOCK : INCLUDE-CSS -->
	<!-- START BLOCK : JAVASCRIPT -->
	<script type="text/javascript">
	<!--	
	<!-- START BLOCK : JAVASCRIPT-TEXT -->
	{JAVASCRIPT}
	<!-- END BLOCK : JAVASCRIPT-TEXT -->
	{JAVASCRIPT}
	-->
	</script>
	<!-- END BLOCK : JAVASCRIPT -->	
	<!-- START BLOCK : INCLUDE-JAVASCRIPT -->
	<script type="text/javascript" src="{RUTA}"></script>
	<!-- END BLOCK : INCLUDE-JAVASCRIPT -->
	<!-- START BLOCK : CSS -->
	<style type="text/css">
	<!--	
	{CSS}
	-->
	</style>
	<!-- END BLOCK : CSS -->	

</head>
<body {BODY}>
<!-- START BLOCK : INCLUDE-JAVASCRIPT-BODY -->
<script type="text/javascript" src="{RUTA}"></script>
<!-- END BLOCK : INCLUDE-JAVASCRIPT-BODY -->
<div id="container">
	<div id="head"></div>
	<div id="menucontainer">
		<div id="menu">
			<ul>
				<!-- START BLOCK : MENU -->
				<li><a id="{ID}" href="{LINK}" title="{TITULO}" {CLASS}>{NOMBRE}</a></li>
				<!-- END BLOCK : MENU -->
			</ul>
		</div>
	</div>
	<div id="menuizq">
		<!-- START BLOCK : SUBMENU -->
		<div id="menuizq_tit">{TITULO}</div>
		<div id="menuizq_opciones">
			<!-- START BLOCK : SUBMENU-OPCION -->
			<a href="{LINK}">{NOMBRE}</a><br />
			<!-- END BLOCK : SUBMENU-OPCION -->
		</div>
		<!-- END BLOCK : SUBMENU -->
	</div>
	<div id="cuerpo">
	<div id="titulo">{TEXTO}</div>
	
	<!-- START BLOCK : FORMULARIO -->
		<div {PARAM}>
		<form action="{RUTA}" method="post" name="{FORM}" id="{FORM}" enctype="multipart/form-data" {ACCIONES}>
		<!-- START BLOCK : FB -->
		<div {PARAM}>
			<!-- START BLOCK : FILA -->
			<div class="fm-fila {CLASE}" {ACCIONES}>
				<!-- START BLOCK : PESTANA -->
				<div class="{CLASS}" {ACCION} id="pes_{ID}">
					{TEXTO}
				</div>
				<!-- END BLOCK : PESTANA -->
				{TEXTO}
				<!-- START BLOCK : CAMPO -->
			<div class="fm-texto{CLASE-TEXTO}">{TITULO}</div>
			<div class="{CLASE}" {ACCIONES}>
					<!-- START BLOCK : INPUT -->
					<input name="{NAME}" type="text" id="{ID}" autocomplete="off" maxlength="{MAX}" value="{VALOR}" tabindex="{TAB}" {ACCIONES} class="input" {READONLY}/>
					<!-- END BLOCK : INPUT -->
					<!-- START BLOCK : PASSWORD -->
					<input name="{NAME}" type="password" id="{ID}" autocomplete="off" maxlength="{MAX}" value="{VALOR}" tabindex="{TAB}" {ACCIONES} class="input" {READONLY}/>
					<!-- END BLOCK : PASSWORD -->
					<!-- START BLOCK : TEXT -->
						<textarea name="{NAME}" id="{ID}" tabindex="{TAB}" {ACCIONES} class="input" {READONLY} rows="8"/>{VALOR}</textarea>
					<!-- END BLOCK : TEXT -->					
					<!-- START BLOCK : FILE -->
					<input name="{NAME}" type="file" id="{ID}" tabindex="{TAB}" size="21" {ACCIONES} class="input" {READONLY}/>
					<!-- END BLOCK : FILE -->					
					<!-- START BLOCK : SELECT -->	
					<select name="{NAME}" id="{ID}" class="select" {ACCIONES} tabindex="{TAB}" class="select" {READONLY}>
						<!-- START BLOCK : SELECT-OPTION -->
						<option value="{VALOR}" {SELECTED} {ACCIONES}>{TEXTO}</option>
						<!-- END BLOCK : SELECT-OPTION -->
					</select>
					<!-- END BLOCK : SELECT -->
					<!-- START BLOCK : CHECK -->
					<input type="checkbox" name="{NAME}" id="{ID}" tabindex="{TAB}" {ACCIONES} {READONLY} {CHECKED} /> {TEXTO}
					<!-- END BLOCK : CHECK -->
					{TEXTO}
				</div>
				<!-- START BLOCK : ICON -->
				<div class="icon">{TEXTO}</div>
				<!-- END BLOCK : ICON -->
				<!-- END BLOCK : CAMPO -->	
			</div>
			<!-- END BLOCK : FILA -->
			<!-- START BLOCK : BOTONES -->
			<div class="fm-botonera" {PARAM}>
				<!-- START BLOCK : BOTON -->
				<div class="fm-boton {BOTON-CLASS}" {BOTON-PARAM}><a href="{BOTON-LINK}" {ACCIONES}><img src="{BOTON-IMAGEN}" {BOTON-ALT} />&nbsp;{BOTON-TEXTO}</a></div>
				<!-- END BLOCK : BOTON -->		
				<!-- START BLOCK : BOTON-INPUT -->
				<input type="button" name="{NOMBRE}" id="{NOMBRE}" class="{CLASS}" tabindex="{TAB}" value="{VALOR}" onclick="{ACCION}" {ACCIONES} style="margin:6px 0px;"/>
				<!-- END BLOCK : BOTON-INPUT -->			
				<!-- START BLOCK : PAGINA -->
				<div class="fm-boton left">{BOTON}</div>
				<!-- END BLOCK : PAGINA -->
				<!-- START BLOCK : HIDDEN -->
				<input type="hidden" name="{NOMBRE}" id="{NOMBRE}" value="{VALOR}" />
				<!-- END BLOCK : HIDDEN -->
			</div>
			<!-- END BLOCK : BOTONES -->		
		</div>
		<!-- END BLOCK : FB -->
		</form>
		</div>
	<!-- END BLOCK : FORMULARIO -->
	
	<!-- START BLOCK : TABLA -->
	<div {CLASS}>
		<!-- START BLOCK : BUSQUEDA -->
		<div id="busqueda">
			<div style="float:left; padding-top:4px">{TEXTO} 
				<!-- START BLOCK : BUSQUEDA-INPUT -->
				<input name="{ID}" type="text" id="{ID}" {ACCION} size="40" maxlength="{MAX}" value="{VALOR}" />
				<!-- END BLOCK : BUSQUEDA-INPUT -->
				<!-- START BLOCK : BUSQUEDA-SELECT -->
				<select name="{ID}" id="{ID}" {ACCION}>
					<!-- START BLOCK : BUSQUEDA-SELECT-OPTION -->
					<option value="{VALOR}" {SELECTED}>{TEXTO}</option>
					<!-- END BLOCK : BUSQUEDA-SELECT-OPTION -->
				</select>
				<!-- END BLOCK : BUSQUEDA-SELECT -->
				<!-- START BLOCK : BUSC-BOTON -->
				<a href="{LINK}"/>{TEXTO}</a> {SEPARADOR}
				<!-- END BLOCK : BUSC-BOTON -->
			</div>
			<!-- START BLOCK : PAGINADOR -->
			<div id="recuento">
				<!-- START BLOCK : P-OBJETO -->
				{TEXTO}
				<!-- END BLOCK : P-OBJETO -->
				{TEXTO}
			</div>
			<!-- END BLOCK : PAGINADOR -->
		</div>
		<!-- END BLOCK : BUSQUEDA -->
		<!-- START BLOCK : ORDEN -->
		<div id="contenedor-marco" style="position:relative;height:0px;" >
			<div id="marco" onmouseover="muestra_submen()" onmouseout="oculta_submen()" style="display:none;">
				<div id="interior"></div>
			</div>
		</div>
		<!-- END BLOCK : ORDEN -->
		<table class="tabla" border="0" cellpadding="2" cellspacing="0" {PARAM}>
			<!-- START BLOCK : TABLA-HEAD -->
			<thead>
				<!-- START BLOCK : TABLA-HEAD-FILA -->
				<tr {PARAM}>
					<!-- START BLOCK : TABLA-HEAD-ROW -->
					<th {PARAM}>{TEXTO}</th>
					<!-- END BLOCK : TABLA-HEAD-ROW -->
				</tr>
				<!-- END BLOCK : TABLA-HEAD-FILA -->
			</thead>
			<!-- END BLOCK : TABLA-HEAD -->
			<!-- START BLOCK : TABLA-FILA -->
			<tr {PARAM}>
				<!-- START BLOCK : TABLA-ROW -->
				<td {PARAM}>{TEXTO}</td>
				<!-- END BLOCK : TABLA-ROW -->
			</tr>
			<!-- END BLOCK : TABLA-FILA -->
		</table>
		<!-- START BLOCK : BUSQUEDA-PIE -->
		<div id="busqueda_pie">
			<div id="recuento">
				{TEXTO}
			</div>
		</div>
		<!-- END BLOCK : BUSQUEDA-PIE -->
		{TEXTO}
	</div>
	<!-- END BLOCK : TABLA -->	
	</div>
	<!-- START BLOCK : FOOTER -->	
	<div id="footer">{TEXTO}</div>
	<!-- END BLOCK : FOOTER -->	
</div>
</body>
</html>