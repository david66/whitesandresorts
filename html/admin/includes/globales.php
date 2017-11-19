<?php

//VARIABLES DE ARCHIVOS

$_SESSION['MAX_KB_IMG']=1024;

$_SESSION['MAX_KB_FILE']=2048;

$_SESSION['PATH_ARCHIVOS']='archivos/';



//VARIALBES GLOBALES

$url="http://www.pisocoslada.es/";

$url_admin="http://www.pisocoslada.es/admin/";



///PLANTILLA DEL MAIL

$empresa = "www.pisocoslada.es";

$head_mail="<style type=text/css><!--.enca{font-family:Trebuchet MS; font-size:28px; color:#445565; font-weight:bold;padding:10px; border-bottom:4px solid #C7C69E;border-top:4px solid #C7C69E}.cuerpo{font-family:Tahoma; font-size:12pt;color:#000000; padding:10px}.pie{font-family:Tahoma; font-size:11px; color:#C7C69E;font-weight:bold;border-top:3px solid #C7C69E;text-decoration:none;}.link{color:#C7C69E;font-weight:bold;text-decoration:none;}--></style><table width=100% border=0 align=center cellpadding=2 cellspacing=0><tr><td bgcolor=#000000 class=enca><a href=\"".$url."index.php\" target\"_blank\"><img src=\"".$url."images/logo_mail.jpg\" border=0 alt=\"".$empresa."\"/></a></td></tr><tr><td bgcolor=#FFFFFF class=cuerpo>";

$pie_mail="</td></tr><tr><td bgcolor=#000000 class=pie><div align=center><a href=\"".$url."index.php\" target\"_blank\" class=link>".$empresa."</a></div></td></tr></table>";



//ENVIO DE MAILS

$host="smtp.pisocoslada.es";

$port="587";

$username="xdc966c";

$password="Avalia2009";

$from="noreply@pisocoslada.es";



//DESTINATARIOS DE CORREO

$dest_contacto = "info@pisocoslada.es";



//EDITOR HTML, URL DE LAS IMAGENES

$_SESSION['ARCHIVOS']="http://www.pisocoslada.es/admin/".$_SESSION['PATH_ARCHIVOS'];

?>