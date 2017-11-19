//VALIDA EL FORMULARIO DE ZONAS
function validar()
	{
	var validado = true;
	
	if(isNull('txt_nombre') && validado!=false){alert("Ingrese el nombre de la zona");validado=false;$('txt_nombre').focus();}
	
	if(validado==true)
		{
		busca_duplicado('zonas',$('txt_nombre').value,$('txt_id').value);
		}
	}
	
//CHEQUEA QUE NO ESTE DUPLICADA LA ZONA
function duplicado_cmd(resultado)
	{
	enProceso = false;
	if(resultado.responseText<1)
		{
		var URL = unescape(location.href);
		var xstart = URL.lastIndexOf("/") + 1;
		var xend = URL.length;
		var pagina = URL.substring(xstart,xend);
		pag=pagina.replace(/&/gi,"|");
	
		$('form1').action = "comandos.php?accion=guardar&pag="+pag;
		$('form1').submit();
		}
	else
		{
		alert("La zona ingresada ya se encuentra registrada");
		validado=false;
		$('txt_nombre').value="";
		$('txt_nombre').focus();
		}
	}
	
//ZONGA LOS DATOS EN EL FORMULARIO	
function cargar(id)
	{
	var url = "../includes/cargar.php?modulo=zonas&id="+id;
	new Ajax.Request(url,{onComplete: 
	function(transport)
		{
		$('alta_modi').style.display='block';
		$('mod_listado').style.display='none';
		
		enProceso = false;	
		var arr = transport.responseText.split("|");
		$('txt_id').value=arr[0];
		
		$('txt_nombre').value=arr[1];
		
		if(arr[2]==1)
			{
			$('chk_portada').checked = true;
			}
		else
			{
			$('chk_portada').checked = false;
			}
		
		$('txt_del').value='0';
		
		if(arr[3])
			{
			$('fila_imagen').style.display="block";
			$('imagen-adjunto').src=arr[3];
			}
		else
			{
			$('fila_imagen').style.display="none";
			}
		
		$('txt_nombre').focus();
		$('txt_nombre').select();
		}
	});
	enProceso = true;
	}
	
//LIMPIA LOS CAMPOS DEL FORMULARIO
function limpiar_campos()
	{
	$('fila_imagen').style.display='none';
	$('txt_id').value='';
	$('txt_nombre').value='';
	$('chk_portada').checked = false;
	$('txt_del').value='0';
	}
	
//BUSCADOR
function buscador()
	{
	if($('busc_nombre').value=='')
		{
		alert("Debes ingresar la zona a buscar");
		}
	else
		{
		$('form2').action = "zonas.php?busqueda=1";
		$('form2').submit();
		}
	}
	
//GESTION DE ERRORES EN LA IMAGEN DE CATEGORIAS
function errores(datos)
	{
	$('alta_modi').style.display='block';
	$('mod_listado').style.display='none';
	$('fila_imagen').style.display='none';
	
	var arr = datos.split("|");
	$('txt_id').value=arr[0];
	$('txt_nombre').value=arr[1];

	if(arr[2]==1)
		{
		$('chk_portada').checked = true;
		}
	else
		{
		$('chk_portada').checked = false;
		}

	$('txt_del').value='0';
	
	$('txt_nombre').focus();
	$('txt_nombre').select();
	
	alert('La imagen es demasiado grande, el tamaño de la misma no debe superar los '+arr[3]+' KB');
	}
	
//Quita la imagen de la zona
function quitar_imagen()
	{
	$('txt_del').value='1';
	$('fila_imagen').style.display="none";
	}