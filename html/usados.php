<?php 

session_start();

require_once("admin/Connections/conect.php");

require_once('includes/globales.php');



//Incluyo el script que va a necesitar

$script = '<script type="text/javascript" charset="ISO-8859-1" src="scripts/prototype.js"></script>';



include("includes/header.php"); 



$zon_id = ($_GET['zon'])?$_GET['zon']:$_SESSION['zona'];



$sql = "select zon_id,zon_nombre from zonas where zon_id='".$zon_id."'";

$result = mysql_query($sql,$mysql->get_conect()) or die("ERR ZON-13: NO SE PUDO CARGAR LAS ZONAS");

if(mysql_num_rows($result)>0)

	{

	$zon_id = mysql_result($result,0,0);

	$zona = mysql_result($result,0,1);

	$_SESSION['zona'] = $zon_id;

	}

else

	{

	$zona = 'Zonas';

	}



?>

<div id="wrap">

 <div id="migas"><a href="index.php">WSR</a> > <a href="zonas.php"><?php echo _($zona);?></a> ><a href="<?php echo $_SERVER['REQUEST_URI'];?>"></a><a href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo _('Segunda mano');?></a></div>

 <div id="contenido">

<?php

require_once('apartamentos/listado.inc.php');



//$sql = "select count(*) from apartamentos where zon_id='".$zon_id."' and apa_estado='1'";

//$result = mysql_query($sql,$mysql->get_conect());



//if(mysql_result($result,0)>0)

//	{

?>  

  <div class="segundamano"><a href="modulos.php?zon=<?php echo $zon_id;?>"><?php echo _('Ver las obras nuevas en esta zona');?> &raquo;</a></div>

<?php

//	}

?>

 </div>

</div>

<?php include "includes/foot.php"; ?>