<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>{TITULO}</title>

<link href="../css/login.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="../scripts/prototype.js" type="text/javascript"></script>

<script language="javascript" src="../scripts/funciones.js" type="text/javascript"></script>

<script language="javascript" src="scripts/funciones.js" type="text/javascript"></script>



</head>

<body onload="mensajes('{RESULTADO}');">

<div id="login">

  <!-- START BLOCK : LOGO -->

  <img src="{LOGO}" />

  <!-- END BLOCK : LOGO -->

  <form action="{DESTINO}" method="post" name="form_usuario" style="margin:0px" autocomplete="on">

		<br />

		<div id="label">{USUARIO}</div>

		<div id="label2"><input name="usuario" id="usuario" type="text" class="box" maxlength="50" tabindex="1" onkeyup="return tabular(event,this)"/>

		</div><br />

		<div id="label">{CLAVE}</div>

		<div id="label2"><input name="clave" id="clave" type="password" class="box" maxlength="22" tabindex="2" onkeyup="return tabular(event,this)"/>

		</div>

		<div id="label3"><input id="ingresar" type="button" value="{BOTON}" class="boton" tabindex="3" onclick="validausu()"/></div>

  </form>

</div>

</body>

</html>