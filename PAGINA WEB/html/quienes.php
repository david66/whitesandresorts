<?php 
session_start();
require_once("admin/Connections/conect.php");
require_once('includes/globales.php');

include("includes/header.php"); 
?>
<div id="wrap">
 <div id="migas"><a href="index.php">WSR</a> > <a href="quienes.php"><?php echo _('Quiénes somos');?></a></div>
<div id="contenido" style="background-color:#FFF; color:#666; padding:20px">
  <img src="images/quienes-somos.gif" name="imagen_principal" width="221" height="237" align="left" id="imagen_principal"/>
  
    <p id="vivienda"><?php echo _("Quiénes somos");?></p>
    <div>
      <p class="titulo"><?php echo _("Historia");?></p>

      <p><?php echo _("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dignissim fermentum fermentum. Nam eget facilisis ante. In mollis mauris non lacus congue at luctus velit venenatis. Praesent fringilla ultricies nisl, a feugiat turpis rutrum ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus fringilla nibh vitae nisl malesuada sit amet luctus velit sagittis. Nullam viverra lobortis massa iaculis cursus. Ut sed purus sed lectus molestie bibendum sit amet quis nunc. In et ipsum magna. Integer et ipsum lectus, ac laoreet odio. Nulla sit amet laoreet ipsum. Fusce non sollicitudin nisi. Etiam vehicula faucibus massa. Fusce in nisl dui, eget laoreet risus.");?></p>
      <p class="titulo"><?php echo _("Casas a precios de hoy");?></p>
      <p><?php echo _("Maecenas semper rutrum malesuada. Pellentesque luctus felis vehicula nulla iaculis tincidunt. Aenean et nunc libero. Nunc pulvinar ultrices elit, ut placerat libero elementum a. Aenean blandit cursus mi, vitae aliquet dui venenatis eget. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam blandit, mauris vitae vestibulum condimentum, est felis dictum nunc, et congue lacus tortor sed odio. Vestibulum a risus id turpis imperdiet vehicula. Integer eget sem felis, eget mattis quam.  In et ipsum magna. Integer et ipsum lectus, ac laoreet odio. Nulla sit amet laoreet ipsum. Fusce non sollicitudin nisi. Etiam vehicula faucibus massa. Fusce in nisl dui, eget laoreet risus.  In et ipsum magna. Integer et ipsum lectus, ac laoreet odio. Nulla sit amet laoreet ipsum. Fusce non sollicitudin nisi.");?></p>
    </div>
  
 </div>
</div>
<?php include "includes/foot.php"; ?>