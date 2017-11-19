function validausu()
	{
	if ((document.form_usuario.usuario.value=="" )|(document.form_usuario.clave.value==""))
		{
		alert("Debes ingresar el Usuario y la Clave.")
		document.form_usuario.usuario.focus()
		}
	else
		{
		document.form_usuario.submit()
		}
	}

function mensajes(query)
	{
	if (query=="login"){alert("Los datos ingresados son incorectos.")}
	if (query=="endsessions"){alert("Por favor, Identifíquese.")}
	if (query=="nofile"){alert("No se encuentra autorizado para descargar este archivo.")}
	if (query=="clave"){alert("La contraseña se ha cambiado con éxito")}
	}
	
//VALIDA EL FORMULARIO DEL CAMBIO DE CONTRASEÑA
function cambiar()
	{
	var validado = true;
	var clave_actual = calcMD5($('txt_clave_1').value);
	
	if(isNull('txt_clave_1') && validado!=false){alert("Ingrese la clave actual");validado=false;$('txt_clave_1').focus();}
	if(clave_actual!=actual && validado!=false){alert("La clave actual es incorrecta");validado=false;$('txt_clave_1').value="";$('txt_clave_1').focus();}
	if(isNull('txt_clave_2') && validado!=false){alert("Ingrese la nueva clave");validado=false;$('txt_clave_2').focus();}
	if(isNull('txt_clave_3') && validado!=false){alert("Confirme la nueva clave");validado=false;$('txt_clave_3').focus();}
	if($('txt_clave_1').value==$('txt_clave_2').value && validado!=false){alert("La nueva clave es igual a la anterior");validado=false;$('txt_clave_2').value="";$('txt_clave_3').value="";$('txt_clave_2').focus();}
	if($('txt_clave_2').value!=$('txt_clave_3').value && validado!=false){alert("La nueva clave y su confirmación no coinciden");validado=false;}
	
	if(validado==true)
		{
		var URL = unescape(location.href);
		var xstart = URL.lastIndexOf("/") + 1;
		var xend = URL.length;
		var pagina = URL.substring(xstart,xend);
		pag=pagina.replace(/&/gi,"|");
	
		$('form1').action = "comandos.php?accion=cambiar&pag="+pag;
		$('form1').submit();
		}
	}