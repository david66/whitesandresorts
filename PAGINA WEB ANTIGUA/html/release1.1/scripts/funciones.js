//CARGO LA VARIABLE APRA COMPROVAR SI SE ESTA REALIZANDO UNA LLAMADA AJAX
var enProceso = false;

//OBTENGO LA URL DE LA PAGINA
var URL = unescape(location.href);
var xstart = URL.lastIndexOf("/") + 1;
var xend = URL.length;
var hereName = URL.substring(xstart,xend);
var url2=unescape(hereName);
var xend2 = url2.lastIndexOf("?");
if (xend2>-1)
	{
	var final=hereName.substring(0,xend2);
	var nom_pagina=final.replace(/.php/,"");
	}
else
	{
	var nom_pagina=hereName.replace(/.php/,"");
	}

//chequea si el string ingresado es un email valido
function comprobar_mail(email){
	var filter=/^[A-Za-z0-9][A-Za-z0-9_\.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
	var aux = filter.test(email);
	if(aux == true)
		return false;
	return true;
}

//chequea si el string ingresado es un numero
function IsNumber(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if(tecla==0){
		return true;
	}else{
		if (tecla==8) return true;
		patron = /\d/; // Solo acepta números
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
} 

//chequea si el string ingresado es un flotante
function IsFloat(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if(tecla==0){
		return true;
	}else{
		if (tecla==8) return true;
		patron = /[\d\.]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
}

//chequea que al menos una opcion este seleccionada
function IsChk(chkName)
{
	var found = false;
	var chk = document.getElementsByName(chkName+'[]');
	for (var i=0;i<chk.length;i++)
	{
		if(chk[i].checked)
		{
			found=true;
		}
	}
	return found;
}

//LIMPIA LOS CHECKS
function enptyChk(chkName)
{
	var chk = document.getElementsByName(chkName+'[]');
	for (var i=0;i<chk.length;i++)
		{
		chk[i].checked = false;
		}
}

//CHEQUEA SI UN CAMPO ESTA VACIO O ES NULO	
function isNull(campo)
	{
	if($(campo) != undefined)
		{
		return ($(campo).value=="")?true:false;
		}	
	}

//ELIMINA UN REGISTRO DEL MODULO ACTUAL
function eliminar(cod,archivo)
{
var eli = confirm("¿Deseas eliminar el registro?");
if (eli== true)
	{
	var URL = unescape(location.href);
	var xstart = URL.lastIndexOf("/") + 1;
	var xend = URL.length;
	var pagina = URL.substring(xstart,xend);
	pag=pagina.replace(/&/gi,"|");
	window.open('comandos.php?accion=eliminar&id='+cod+'&pag='+pag , '_parent');
	}
}

//CHEQUEA SI EL REGISTRO INGRESADO ESTA DUPLICADO
function busca_duplicado(modulo,valor,id,tiempo)
{
if (!enProceso) 
	{
	var url = "../includes/duplicado.php?modulo="+modulo+"&valor="+valor+"&id="+id+"&tiempo="+tiempo;
	new Ajax.Request(url,{onComplete: duplicado_cmd});
	enProceso = true;
    }
}

//MUESTRA EL FORMULARIO DE ALTA/MODIFICACION
function mostrar_form(campo)
	{
	$('alta_modi').style.display='block';
	if($('mod_buscador') != undefined)
		{
		$('mod_buscador').style.display='none';
		}
	$('mod_listado').style.display='none';
	if($(campo))
		{
		$(campo).focus();
		}
	limpiar_campos();
	}
	
//MUESTRA EL BUSCADOR DEL MODULO
function mostrar_buscador(campo)
	{
	$('alta_modi').style.display='none';
	$('mod_buscador').style.display='block';
	$('mod_listado').style.display='none';
	if($(campo))
		{
		$(campo).focus();
		}
	}
	
//MUESTRA EL LISTADO NUEVAMENTE
function ocu_form()
	{
	$('alta_modi').style.display='none';
	if($('mod_buscador') != undefined)
		{
		$('mod_buscador').style.display='none';
		}
	$('mod_listado').style.display='block';
	}
	
//ORDENA LOS RESULTADOS DEL LISTADO	
function orden(op,campo,buscador)
{
obj = document.getElementById(op);
var left=obj.offsetParent.offsetLeft;
var query = window.location.search.substring(1);
document.getElementById('marco').style.marginLeft=left+'px';
document.getElementById('marco').style.marginTop=60+'px';
muestra_submen();
col="<div><div id=item><ul><li><a href=javascript:ira('asc','"+campo+"','"+buscador+"') onclick=oculta_submen()>Ordenar Ascendente</a></li></ul></div><div id=item2><ul><li><a href=javascript:ira('desc','"+campo+"')  onclick=oculta_submen()>Ordenar Descendente</a></li></ul></div>";
document.getElementById('interior').innerHTML=col;
}

//APLICA EL ORDEN
function ira(orden,campo,buscador,tab)
{
var URL = unescape(location.href)	
var xstart = URL.lastIndexOf("/") + 1
var xend = URL.length
var pagina = URL.substring(xstart,xend)
var query1=pagina.lastIndexOf("?")	
if (query1<0)
	{pag=pagina+"?ord="+orden+"&campo="+campo}
else
	{
	var inicio=pagina.lastIndexOf("?ord=")	
	if (inicio>0)
		{
			if (orden=='asc') {pag=pagina.replace(/ord=desc/, "ord=asc")}
	    	if (orden=='desc') {pag=pagina.replace(/ord=asc/, "ord=desc")}
		}
	else
		{
		var inicio=pagina.lastIndexOf("&ord=")	
			if (inicio>0)
			{
				if (orden=='asc') {pag=pagina.replace(/ord=desc/, "ord=asc")}
	    		if (orden=='desc') {pag=pagina.replace(/ord=asc/, "ord=desc")}
			}
			else
			{		
			pag=pagina+"&ord="+orden+"&campo="+campo
			}
		}
	}
var inicio=pag.lastIndexOf("campo=")	
if (inicio>0){pag=pag.substring(0,inicio-1)+"&campo="+campo}
if (buscador==1){pag=pag+'&busqueda=1';}
window.open(pag, '_parent')
}	

function oculta_submen()
{
document.getElementById('marco').style.display="none"
}

function muestra_submen()
{
document.getElementById('marco').style.display=""
}

//TABULADOR POR ENTERS
var textareacount = 0;

function tabular(e,obj,skip,tab)
	{
	var destino = 0;
	var tecla = (document.all) ? e.keyCode : e.which;
	var frm = obj.form;
	switch(tecla){
		case 13: //enter
		var tabindex_target = obj.tabIndex+1;
		if(!skip)
			{
			if(obj.type=='textarea' && textareacount<2)
				{
				textareacount++;
				}
			else
				{
				for(i=0;i<frm.elements.length;i++)
					{
					if (frm.elements[i].tabIndex == tabindex_target)
						{
						if((frm.elements[i].type!="hidden" && frm.elements[i].type!='file' && frm.elements[i].disabled!=true && frm.elements[i].readOnly!=true && frm.elements[i].type!='select-multiple') || xinha_editors[destino] != undefined)
							{
							destino = frm.elements[i].id;
							textareacount=0;
							break;
							}
						else
							{
							tabindex_target++;
							i=0;
							}
						}
					}
				}
			}
		else
			{
			return true;
			}
		break;
		default:
			return true;
		return		
	}
	if($(destino) != undefined && destino!=0)
		{
		setTimeout(function()
			{
			if(tab != undefined)
				{
				bto_pestana(tab,destino);
				}
			else
				{
				try
					{
					var isEditor = xinha_editors[destino]!=undefined;
					}
				catch(e)
					{
					var isEditor = false;
					}
				if(isEditor)
					{
					xinha_editors[destino].activateEditor();
					xinha_editors[destino].focusEditor();
					}
				else
					{
					$(destino).focus();
					if($(destino).type == "text"){$(destino).select();}
					}
				}
			campo_activo = destino;
			},45);
		}
	return false;
	}

//FORMULARIO EN PESTAÑA
var pes_activa = 'tb1';

function bto_pestana(tabla,cursor)
	{
	if(pes_activa != tabla)
		{
		$(tabla).show();
		$('pes_'+tabla).className = "bto-current";
		$(pes_activa).hide();
		$('pes_'+pes_activa).className = "bto-active";	
		pes_activa = tabla;
		if(tab_init != undefined)
			{
			tab_init(tabla);
			}
		return false;
		}
	//FOTO EN EL CAMPO DADO
	if(cursor)
		{
		try
			{
			var isEditor = xinha_editors[cursor]!=undefined;
			}
		catch(e)
			{
			var isEditor = false;
			}
		if(isEditor)
			{
			xinha_editors[cursor].activateEditor();
			xinha_editors[cursor].focusEditor();
			}
		else
			{
			$(cursor).focus();
			if($(cursor).type == "text"){$(cursor).select();}
			}
		}
	}
	
//busca un valor en un array
function buscarEnArray(array, dato)
{
	// Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
	var x=0;
	while(array[x])
	{
		if(array[x]==dato) return x;
		x++;
	}
	return null;
}

//actualiza los select dependientes
function cargaContenido(idSelectOrigen,listado,valorpredeterminado,seleccionado)
	{
	//Carga el listado
	eval('var listadoSelects = listadoSelects_'+listado);
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=$(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada = (seleccionado)?seleccionado:selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
	if(opcionSeleccionada==0)
		{
		var x=posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x])
			{
			selectActual=$(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			nuevaOpcion.value=0; 
			nuevaOpcion.innerHTML="Seleccione...";
			selectActual.appendChild(nuevaOpcion);	
			selectActual.disabled=true;
			x++;
			}
		}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1])
		{
		var perdeterminado = "";
		if(valorpredeterminado != undefined){perdeterminado="&predef="+valorpredeterminado;}
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=$(idSelectDestino);
		
		new Ajax.Request("includes/select.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada+perdeterminado,{encoding: 'ISO-8859-1',
		onComplete: function(transport) {
			selectDestino.parentNode.innerHTML=transport.responseText;
			//si el selec de destino no es el ultimo de la cadadena propago la accion
			if(listadoSelects[posicionSelectDestino]!=listadoSelects[listadoSelects.length-1])
				{
				if($(listadoSelects[posicionSelectDestino]).onchange != undefined)
					{
					$(listadoSelects[posicionSelectDestino]).onchange();
					}
				}
			},
		onLoading: function(){
			selectDestino.length=0;
			var nuevaOpcion=document.createElement("option");
			nuevaOpcion.value=0;
			nuevaOpcion.innerHTML="Cargando...";
			selectDestino.appendChild(nuevaOpcion);
			selectDestino.disabled=true;
			if(listadoSelects[posicionSelectDestino]!=listadoSelects[listadoSelects.length-1])
				{
				$(listadoSelects[listadoSelects.length-1]).length=0;
				var otraOpcion=document.createElement("option");
				otraOpcion.value=0;
				otraOpcion.innerHTML="Cargando...";
				$(listadoSelects[listadoSelects.length-1]).appendChild(otraOpcion);
				$(listadoSelects[listadoSelects.length-1]).disabled=true;
				}
			}});
		}
	}
	
function ventana(url)
	{
	window.open(url,"popup","location=0,status=0,width=750"); 
	}
	
function chk_onoff(padre,hijo){
	padre = $(padre);
	hijo = $(hijo);
	if( padre.checked==false ){
		hijo.disabled = true;
	}else{
		hijo.disabled = false;
	}
}