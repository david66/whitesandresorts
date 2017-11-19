<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Avalia Inmobiliaria</title>


<link href="imageMenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="common/js/mootools.js"></script>
<script type="text/javascript" src="imageMenu.js"></script>
</head>

<body>

<div id="wrap">
 <div id="header">
  <div id="izq">
   <div id="idioma">Idioma:<br />
    <img src="images/uk-flag.gif"/><img src="images/portugal-flag.gif"  />
   </div>
   <div id="contacto">902 658 655 / Contacto</div>
  </div>
  
  <div id="logo"><img src="images/logo.jpg" /></div>
  <div id="frase">"Casas a precios<br />de hoy u otro claim"</div>
 </div>
 <div id="migas">Avalia > Andalucía > Obra nueva</div>
 <div id="menu_animado">
   <div id="imageMenu">
     <ul>
       <li class="landscapes"><a href="">Andalucía</a></li>
       <li class="people"><a href="">Portugal</a></li>
       <li class="nature"><a href="">Costa Mediterránea</a></li>
       <li class="urban"><a href="">Baleares</a></li>
       <li class="abstract"><a href="">Otras zonas</a></li>
     </ul>
   </div>
   <script type="text/javascript">
			
			window.addEvent('domready', function(){
				var myMenu = new ImageMenu($$('#imageMenu a'),{openWidth:310, border:2, onOpen:function(e,i){alert(e);}});
			});
</script>
 </div>
 <div id="extras">
  <div id="oferta">
   <img src="images/oferta.jpg"/>
   <p class="titulo">Ático Madrid Centro</p>
   <p>Cerca de la villa medieval de Óbidos, a orillas de la laguna del mismo nombre, y en plena Costa de la Prata...</p>
   <ul>
    <li>Calle Ayala</li>
    <li>130 m2</li>
    <li>3 dormitorios</li>
   </ul>
   <p class="precio">Precio: 139.000 €</p>
  </div>
  <div class="modulo">Banner</div>
  <div class="modulo">Link</div>
 </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3333085-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<?php include "foot.php"; ?>