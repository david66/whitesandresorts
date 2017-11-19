<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _('White Sand Resorts');?></title>

<link href="css/imageMenu.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
echo $script;
?>
<script type="text/javascript" src="scripts/funciones.js"></script>
<script type="text/javascript" src="scripts/buscador.php"></script>
</head>

<body>

<div id="head">
 <div id="header">
  <div id="izq">
   <div id="idioma"><?php echo _('Idioma:');?><br />
<?php
$sql="select * from idiomas where idi_id<>'".$_SESSION['IDI-SEL']."';";
$idiomas = mysql_query($sql, $mysql->get_conect()) or die(mysql_error());
while($idi = mysql_fetch_array($idiomas))
	{
?>
<? if($_GET['zon']){$zonactiva=$_GET['zon'];};?>
<a href="<?php echo $_SERVER['PHP_SELF']."?lang=".$idi['idi_locale']."&zon=".$zonactiva;?>" ></a><a href="<?php echo $_SERVER['PHP_SELF']."?lang=".$idi['idi_locale']."&zon=".$zonactiva;;?>" ><img src="images/flags/flags_<?php echo $idi['idi_id'];?>.gif" border="0"/></a>
<?php
	}
unset($idiomas,$sql,$idi);
?>
   </div>
   <div id="contacto"><?php echo _('637 728 733 / ');?><a href="contacto.php"><?php echo _('Contacto');?></a></div>
  </div>
  
  <div id="logo">
	<div id="logo-img">
	<a href="index.php"><img src="images/logoTR.png" border="0" /></a>
	</div>
	&nbsp;
  </div>
  <div id="frase"><?php echo _('Casas a precios');?><br /><?php echo _('de hoy u otro claim');?></div>
 </div>
</div>