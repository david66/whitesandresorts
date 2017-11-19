//BUSCADOR

function buscador()

	{

	var validado = true;

	if($('busc_pais').selectedIndex<1 && $('busc_provincia').selectedIndex<1 && $('busc_ciudad').selectedIndex<1 && $('busc_dormitorios').value=='' && $('busc_metros').value=='' && $('busc_precio_min').value=='' && $('busc_precio_max').value=='' && $('busc_estado').selectedIndex<1) //$('busc_zona').selectedIndex<1 && $('busc_estado').selectedIndex<1 &&

		{

		alert("<?php echo _('Debes ingresar como mínimo un dato a buscar');?>");

		}

	else

		{

		if($('busc_precio_min').value!='' || $('busc_precio_max').value!='')

			{

			if($('busc_precio_min').value!='' && $('busc_precio_max').value!='')

				{

				if(parseFloat($('busc_precio_min').value) > parseFloat($('busc_precio_max').value))

					{

					validado = false;

					alert("<?php echo _('El precio máximo debe ser mayor al precio mínimo');?>");

					}

				}

			else

				{

				validado = false;

				alert("<?php echo _('ingrese el precio mínimo y máximo para realizar la búsqueda por precios');?>");

				}

			}

		

		if(validado)

			{

			$('form2').action = "usados.php?busqueda=1";

			$('form2').submit();

			}

		}

	}

	

//valida el formulario de contacto

function valida_contacto(){

	if(document.form1.txt_nombre.value==""||document.form1.txt_apellidos.value==""){

		alert("<?php echo _('Escriba su nombre completo');?>");

		document.form1.txt_nombre.focus();

	}else{

		if(document.form1.txt_email.value==""){

			alert("<?php echo _('Ingrese su dirección de correo');?>");

			document.form1.txt_email.focus();

		}else{

			if(comprobar_mail(document.form1.txt_email.value)){

				alert("<?php echo _('El correo ingresado es incorrecto o está mal escrito');?>");

				document.form1.txt_email.focus();

			}else{

				if(document.form1.txt_mensaje.value==""){

					alert("<?php echo _('Ingrese su mensaje');?>");

					document.form1.txt_mensaje.focus();

				}else{

					var URL = unescape(location.href);

					var xstart = URL.lastIndexOf("/") + 1;

					var xend = URL.length;

					var pagina = URL.substring(xstart,xend);

					pag=pagina.replace(/&/gi,"|");

					accion="contacto";

					document.form1.action="comandos.php?accion="+accion+"&pag="+pag;

					document.form1.submit();

				}

			}

		}

	}

}

	

//valida el formulario de amigo

function valida_amigo(){

	if(document.form1.txt_nombre.value==""){

		alert("<?php echo _('Ingrese su nombre');?>");

		document.form1.txt_nombre.focus();

	}else{

		if(document.form1.txt_email.value==""){

			alert("<?php echo _('Ingrese su dirección de correo');?>");

			document.form1.txt_email.focus();

		}else{

			if(comprobar_mail(document.form1.txt_email.value)){

				alert("<?php echo _('El correo ingresado es incorrecto o está mal escrito');?>");

				document.form1.txt_email.focus();

			}else{



				if(document.form1.txt_amigo.value==""){

					alert("<?php echo _('Ingrese el nombre de su amigo');?>");

					document.form1.txt_amigo.focus();

				}else{

					if(document.form1.txt_para.value==""){

						alert("<?php echo _('Ingrese la dirección de correo de su amigo');?>");

						document.form1.txt_para.focus();

					}else{

						if(comprobar_mail(document.form1.txt_para.value)){

							alert("<?php echo _('El correo ingresado es incorrecto o está mal escrito');?>");

							document.form1.txt_para.focus();

						}else{

							var URL = unescape(location.href);

							var xstart = URL.lastIndexOf("/") + 1;

							var xend = URL.length;

							var pagina = URL.substring(xstart,xend);

							pag=pagina.replace(/&/gi,"|");

							accion="amigos";

							document.form1.action="comandos.php?accion="+accion+"&pag="+pag;

							document.form1.submit();

						}

					}

				}

			}

		}

	}

}

	

// Declaro los selects que componen el documento HTML. Su ID debe figurar aqui.

var listadoSelects_1=new Array();

listadoSelects_1[0]="txt_zona";

listadoSelects_1[1]="txt_provincia";

listadoSelects_1[2]="txt_ciudad";

//busquedas

var listadoSelects_2=new Array();

listadoSelects_2[0]="busc_pais";

listadoSelects_2[1]="busc_provincia";

listadoSelects_2[2]="busc_ciudad";	