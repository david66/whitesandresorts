<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

include("includes/header.php"); 

$sql = "select zon_id,zon_nombre from zonas where zon_id='".$_GET['zon']."'";
$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");
if(mysql_num_rows($result)>0)
	{
	$zona = mysql_result($result,0,1);
	}

?>
<div id="wrap">
<div id="migas"><a href="index.php">WSR</a> > <a href="contacto.php"><?php echo _('Contacto');?></a></div>
 <div id="contenido">
  <div id="galeria"><img src="images/email1.gif" width="349" height="255" id="imagen_principal"/></div>
  <div id="info">
    <p id="vivienda"><?php echo _("Contacto");?></p>
	<?php
	if($_SESSION['mensaje'])
		{
	?>
	<div class="mensajeenviado">
	<?php echo _('Su mensaje ha sido enviado correctamente');?>
	</div>
	<?php
		unset($_SESSION['mensaje']);
		}
	?>
    <div>
		<form name="form1" id="form1" method="post" action="">
		<table>
		  <tr>
			<td class="nombre-campo"><?php echo _("Nombre *");?></td>
			<td><input name="txt_nombre" id="txt_nombre" type="text" /></td>
			<td class="nombre-campo"><?php echo _("Apellidos *");?></td>
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
<?php include "includes/foot.php"; ?>