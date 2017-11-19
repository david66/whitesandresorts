//VARIALBE GLOBAL DE LA GALERIA

var gal = 0;



//VALIDA EL FORMULARIO DE APARTAMENTO

function validar()
	{
	var validado = true;
	
	if(isNull('txt_nombre') && validado!=false){alert("Ingrese el Nombre del apartamento");validado=false;bto_pestana('tb1','txt_nombre');}

	if($('txt_zona').selectedIndex==0 && validado!=false){alert("Seleccione la zona del apartamento");validado=false;bto_pestana('tb2','txt_zona');}
	if($('txt_pais').selectedIndex==0 && validado!=false){alert("Seleccione la país del apartamento");validado=false;bto_pestana('tb2','txt_pais');}

	if($('txt_provincia').selectedIndex==0 && validado!=false){alert("Ingrese la provincia del apartamento");validado=false;bto_pestana('tb2','txt_provincia');}
	if($('txt_ciudad').selectedIndex==0 && validado!=false){alert("Ingrese la ciudad del apartamento");validado=false;bto_pestana('tb2','txt_ciudad');}
	if(($('txt_precio').value=="" || $('txt_precio').value<1) && validado!=false){alert("Ingrese el precio del apartamento");validado=false;bto_pestana('tb4','txt_precio');}
	
	if(validado==true)
		{
		busca_duplicado('apartamentos',$('txt_nombre').value,$('txt_id').value);
		}
	}

	
//cancela la operacion
function cancel_form()
	{
	var URL = unescape(location.href);
	var xstart = URL.lastIndexOf("/") + 1;
	var xend = URL.length;
	var pagina = URL.substring(xstart,xend);

	$('alta_modi').style.display='none';
	if($('mod_buscador') != undefined)
		{
		$('mod_buscador').style.display='none';
		}
	window.open(pagina, '_parent');
	}
	
//CHEQUEA QUE NO ESTE DUPLICADO EL APARTAMENTO
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
		
		$('alta_modi').style.display='none';
		
		$('form1').submit();
		}
	else
		{
		alert("El nombre del apartamento ingresado ya se encuentra registrado");
		validado=false;
		$('txt_nombre').value="";
		$('txt_nombre').focus();
		}
	}
	

//CARGA LOS DATOS EN EL FORMULARIO	
function cargar(id)
	{

	var url = "../includes/cargar.php?modulo=apartamentos&id="+id;

	new Ajax.Request(url,{onComplete: 

	function(transport)

		{

		$('alta_modi').style.display='block';

		$('mod_listado').style.display='none';

		bto_pestana('tb1');

	

		enProceso = false;	

		var arr = transport.responseText.split("|");

		

		$('txt_id').value=arr[0];

		$('txt_nombre').value=arr[1];

		//ZONAS

		var combo = $('txt_zona');

		var cantidad = combo.length;

		for (i = 0; i < cantidad; i++) 

			{

			if (combo[i].value == arr[2]) 

				{

				combo[i].selected = true;

				}

			}

			

		//PAIS

		var combo = $('txt_pais');

		var cantidad = combo.length;

		for (i = 0; i < cantidad; i++) 

			{

			if (combo[i].value == arr[3]) 

				{

				combo[i].selected = true;

				}

			}



		$('txt_provincia').value=arr[4];

		$('txt_ciudad').value=arr[5];

			

		//cargaContenido('txt_zona',1,arr[3]);

		//cargaContenido('txt_provincia',1,arr[4],arr[3]);

		

		$('txt_cp').value=arr[6];

		$('txt_direccion').value=arr[7];

		

		var combo = $('txt_estado');

		var cantidad = combo.length;

		for (i = 0; i < cantidad; i++) 

			{

			if (combo[i].value == arr[8]) 

				{

				combo[i].selected = true;

				}

			}

		

		$('txt_dormitorios').value=arr[11];

		$('txt_metros').value=arr[10];

		

		$('txt_precio').value=arr[13];


		$('chk_portada').checked = (arr[17]==1)?true:false;

		$('txt_order').value=arr[24];		

		//cargo el plano

		if(arr[16])

			{

			$('plano_altual').toggle();

			$('plano_nombre').innerHTML = arr[16];

			}

		

		//LIMPIO GALERIA
		var cell = $("files_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiarchivo').disabled=false;

		cell = $("localizacion_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multilocalizacion').disabled=false;
		
		cell = $("precio_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiprecio').disabled=false;
		
		cell = $("entorno_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multientorno').disabled=false;
		
		cell = $("servicios_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiservicios').disabled=false;
	
		//GALERIAS	
		if(arr[19])
			{
			$('txt_del').value=arr[0];
			gal=arr[19].split("@")
			if(gal[0]>0)
				{
				var puntero = 1;
				var cant = 0;
				var cell = $("files_list");
				if ( cell.hasChildNodes() )
					{
					while ( cell.childNodes.length >= 1 )
						{
						cell.removeChild( cell.firstChild );       
						} 
					}
				for(var i=1;i<=gal[0];i++)
					{
					var new_row = document.createElement( 'div' );
					new_row.setAttribute('id','ID_'+gal[puntero]);
					new_row.className = "Preview_de_imagen";
					var new_row_button = document.createElement( 'input' );
					new_row_button.type = 'button';
					new_row_button.value = 'Eliminar';
					new_row.element = gal[puntero] + '&nbsp;';
					eval('new_row_button.onclick= function(){$(\'txt_del\').value = $(\'txt_del\').value+\'|\'+'+gal[puntero]+';this.parentNode.parentNode.removeChild( this.parentNode );img_general.count--;img_general.current_element.disabled = false;return false;}');
					//puntero++;
					new_row.innerHTML = '<iframe src="includes/preview.php?foto='+gal[puntero]+'" id="ver'+gal[puntero]+'" name="ver'+gal[puntero]+'" scrolling="no"></iframe>';
					puntero++;
					new_row.appendChild( new_row_button );
					$('files_list').appendChild( new_row );
					cant++;
					}
				img_general.count=cant;
				if(cant>99)
					{
					$('multiarchivo').disabled=true;
					}
				}
			}
		else
			{
			$('txt_del').value='';
			}

		//GALERIAS
		if(arr[20])
			{
			$('txt_del').value=arr[0];
			gal=arr[20].split("@")
			if(gal[0]>0)
				{
				var puntero = 1;
				var cant = 0;
				var cell = $("localizacion_list");
				if ( cell.hasChildNodes() )
					{
					while ( cell.childNodes.length >= 1 )
						{
						cell.removeChild( cell.firstChild );       
						} 
					}
				for(var i=1;i<=gal[0];i++)
					{
					var new_row = document.createElement( 'div' );
					new_row.setAttribute('id','ID_'+gal[puntero]);
					new_row.className = "Preview_de_imagen";
					var new_row_button = document.createElement( 'input' );
					new_row_button.type = 'button';
					new_row_button.value = 'Eliminar';
					new_row.element = gal[puntero] + '&nbsp;';
					eval('new_row_button.onclick= function(){$(\'txt_del\').value = $(\'txt_del\').value+\'|\'+'+gal[puntero]+';this.parentNode.parentNode.removeChild( this.parentNode );img_localizacion.count--;img_localizacion.current_element.disabled = false;return false;}');
					//puntero++;
					new_row.innerHTML = '<iframe src="includes/preview.php?foto='+gal[puntero]+'" id="ver'+gal[puntero]+'" name="ver'+gal[puntero]+'" scrolling="no"></iframe>';
					puntero++;
					new_row.appendChild( new_row_button );
					$('localizacion_list').appendChild( new_row );
					cant++;
					}
				img_localizacion.count=cant;
				if(cant>99)
					{
					$('multilocalizacion').disabled=true;
					}
				}
			}
		else
			{
			$('txt_del').value='';
			}
			
			
		//GALERIAS
		if(arr[21])
			{
			$('txt_del').value=arr[0];
			gal=arr[21].split("@")
			if(gal[0]>0)
				{
				var puntero = 1;
				var cant = 0;
				var cell = $("precio_list");
				if ( cell.hasChildNodes() )
					{
					while ( cell.childNodes.length >= 1 )
						{
						cell.removeChild( cell.firstChild );       
						} 
					}
				for(var i=1;i<=gal[0];i++)
					{
					var new_row = document.createElement( 'div' );
					new_row.setAttribute('id','ID_'+gal[puntero]);
					new_row.className = "Preview_de_imagen";
					var new_row_button = document.createElement( 'input' );
					new_row_button.type = 'button';
					new_row_button.value = 'Eliminar';
					new_row.element = gal[puntero] + '&nbsp;';
					eval('new_row_button.onclick= function(){$(\'txt_del\').value = $(\'txt_del\').value+\'|\'+'+gal[puntero]+';this.parentNode.parentNode.removeChild( this.parentNode );img_precio.count--;img_precio.current_element.disabled = false;return false;}');
					//puntero++;
					new_row.innerHTML = '<iframe src="includes/preview.php?foto='+gal[puntero]+'" id="ver'+gal[puntero]+'" name="ver'+gal[puntero]+'" scrolling="no"></iframe>';
					puntero++;
					new_row.appendChild( new_row_button );
					$('precio_list').appendChild( new_row );
					cant++;
					}
				img_precio.count=cant;
				if(cant>99)
					{
					$('multiprecio').disabled=true;
					}
				}
			}
		else
			{
			$('txt_del').value='';
			}

		//GALERIAS
		if(arr[22])
			{
			$('txt_del').value=arr[0];
			gal=arr[22].split("@")
			if(gal[0]>0)
				{
				var puntero = 1;
				var cant = 0;
				var cell = $("entorno_list");
				if ( cell.hasChildNodes() )
					{
					while ( cell.childNodes.length >= 1 )
						{
						cell.removeChild( cell.firstChild );       
						} 
					}
				for(var i=1;i<=gal[0];i++)
					{
					var new_row = document.createElement( 'div' );
					new_row.setAttribute('id','ID_'+gal[puntero]);
					new_row.className = "Preview_de_imagen";
					var new_row_button = document.createElement( 'input' );
					new_row_button.type = 'button';
					new_row_button.value = 'Eliminar';
					new_row.element = gal[puntero] + '&nbsp;';
					eval('new_row_button.onclick= function(){$(\'txt_del\').value = $(\'txt_del\').value+\'|\'+'+gal[puntero]+';this.parentNode.parentNode.removeChild( this.parentNode );img_entorno.count--;img_entorno.current_element.disabled = false;return false;}');
					//puntero++;
					new_row.innerHTML = '<iframe src="includes/preview.php?foto='+gal[puntero]+'" id="ver'+gal[puntero]+'" name="ver'+gal[puntero]+'" scrolling="no"></iframe>';
					puntero++;
					new_row.appendChild( new_row_button );
					$('entorno_list').appendChild( new_row );
					cant++;
					}
				img_entorno.count=cant;
				if(cant>99)
					{
					$('multientorno').disabled=true;
					}
				}
			}
		else
			{
			$('txt_del').value='';
			}
			
		//GALERIAS
		if(arr[23])
			{
			$('txt_del').value=arr[0];
			gal=arr[23].split("@")
			if(gal[0]>0)
				{
				var puntero = 1;
				var cant = 0;
				var cell = $("servicios_list");
				if ( cell.hasChildNodes() )
					{
					while ( cell.childNodes.length >= 1 )
						{
						cell.removeChild( cell.firstChild );       
						} 
					}
				for(var i=1;i<=gal[0];i++)
					{
					var new_row = document.createElement( 'div' );
					new_row.setAttribute('id','ID_'+gal[puntero]);
					new_row.className = "Preview_de_imagen";
					var new_row_button = document.createElement( 'input' );
					new_row_button.type = 'button';
					new_row_button.value = 'Eliminar';
					new_row.element = gal[puntero] + '&nbsp;';
					eval('new_row_button.onclick= function(){$(\'txt_del\').value = $(\'txt_del\').value+\'|\'+'+gal[puntero]+';this.parentNode.parentNode.removeChild( this.parentNode );img_servicios.count--;img_servicios.current_element.disabled = false;return false;}');
					//puntero++;
					new_row.innerHTML = '<iframe src="includes/preview.php?foto='+gal[puntero]+'" id="ver'+gal[puntero]+'" name="ver'+gal[puntero]+'" scrolling="no"></iframe>';
					puntero++;
					new_row.appendChild( new_row_button );
					$('servicios_list').appendChild( new_row );
					cant++;
					}
				img_servicios.count=cant;
				if(cant>99)
					{
					$('multiservicios').disabled=true;
					}
				}
			}
		else
			{
			$('txt_del').value='';
			}
			
			
		$('txt_del_plano').value='';
			
		//CARGO EDITOR HTML

		if(!xinha_editors)

			{

			det = arr[9].split('<@>');

			$('txt_ubicacion_1').value=det[0];

			$('txt_ubicacion_2').value=det[1];

			$('txt_ubicacion_3').value=det[2];

			

			det = arr[12].split('<@>');

			$('txt_tipologia_1').value=det[0];

			$('txt_tipologia_2').value=det[1];

			$('txt_tipologia_3').value=det[2];

			

			det = arr[14].split('<@>');

			$('txt_pago_1').value=det[0];

			$('txt_pago_2').value=det[1];

			$('txt_pago_3').value=det[2];

			
			det = arr[15].split('<@>');

			$('txt_informacion_1').value=det[0];

			$('txt_informacion_2').value=det[1];

			$('txt_informacion_3').value=det[2];

		

			det = arr[18].split('<@>');

			

			$('txt_descripcion_1').value=det[0];	

			$('txt_descripcion_2').value=det[1];

			$('txt_descripcion_3').value=det[2];

			

			xinha_init();

			}

		else

			{

			det = arr[18].split('<@>');

			

			xinha_editors['txt_descripcion_1'].setEditorContent(det[0]);

			xinha_editors['txt_descripcion_2'].setEditorContent(det[1]);

			xinha_editors['txt_descripcion_3'].setEditorContent(det[2]);

			

			det = arr[8].split('<@>');

			if(!xinha_editors['txt_ubicacion_1'] == undefined){xinha_editors['txt_ubicacion_1'].setEditorContent(det[0]);}else{$('txt_ubicacion_1').value=det[0];}

			if(!xinha_editors['txt_ubicacion_2'] == undefined){xinha_editors['txt_ubicacion_2'].setEditorContent(det[1]);}else{$('txt_ubicacion_2').value=det[1];}

			if(!xinha_editors['txt_ubicacion_3'] == undefined){xinha_editors['txt_ubicacion_3'].setEditorContent(det[2]);}else{$('txt_ubicacion_3').value=det[2];}

			

			det = arr[12].split('<@>');

			if(!xinha_editors['txt_tipologia_1'] == undefined){xinha_editors['txt_tipologia_1'].setEditorContent(det[0]);}else{$('txt_tipologia_1').value=det[0];}

			if(!xinha_editors['txt_tipologia_2'] == undefined){xinha_editors['txt_tipologia_2'].setEditorContent(det[1]);}else{$('txt_tipologia_2').value=det[1];}

			if(!xinha_editors['txt_tipologia_3'] == undefined){xinha_editors['txt_tipologia_3'].setEditorContent(det[2]);}else{$('txt_tipologia_3').value=det[2];}

			
			det = arr[14].split('<@>');

			if(!xinha_editors['txt_pago_1'] == undefined){xinha_editors['txt_pago_1'].setEditorContent(det[0]);}else{$('txt_pago_1').value=det[0];}

			if(!xinha_editors['txt_pago_2'] == undefined){xinha_editors['txt_pago_2'].setEditorContent(det[1]);}else{$('txt_pago_2').value=det[1];}

			if(!xinha_editors['txt_pago_3'] == undefined){xinha_editors['txt_pago_3'].setEditorContent(det[2]);}else{$('txt_pago_3').value=det[2];}

			

			det = arr[15].split('<@>');

			if(!xinha_editors['txt_informacion_1'] == undefined){xinha_editors['txt_informacion_1'].setEditorContent(det[0]);}else{$('txt_informacion_1').value=det[0];}

			if(!xinha_editors['txt_informacion_2'] == undefined){xinha_editors['txt_informacion_2'].setEditorContent(det[1]);}else{$('txt_informacion_2').value=det[1];}

			if(!xinha_editors['txt_informacion_3'] == undefined){xinha_editors['txt_informacion_3'].setEditorContent(det[2]);}else{$('txt_informacion_3').value=det[2];}

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

	$('txt_id').value='';

	$('txt_del').value='';

	$('txt_nombre').value='';

	$('txt_estado')[0].selected = true;

	$('txt_zona')[0].selected = true;

	$('txt_pais')[0].selected = true;

	

	//RESEREA LA CIUDAD Y LA COMUNIDAD

	//$('txt_provincia')[0].selected = true;

	//cargaContenido('txt_provincia',1);

	$('txt_provincia').value='';

	$('txt_ciudad').value='';

	

	$('txt_cp').value='';

	$('txt_direccion').value='';



	$('txt_dormitorios').value='';

	$('txt_metros').value='';

	

	$('txt_precio').value='';

	

	$('chk_portada').checked=false;

	

	//CARGO EDITOR HTML

		if(!xinha_editors)

			{

			$('txt_ubicacion_1').value='';

			$('txt_ubicacion_2').value='';

			$('txt_ubicacion_3').value='';

			

			$('txt_tipologia_1').value='';

			$('txt_tipologia_2').value='';

			$('txt_tipologia_3').value='';

			

			$('txt_pago_1').value='';

			$('txt_pago_2').value='';

			$('txt_pago_3').value='';

			

			$('txt_informacion_1').value='';

			$('txt_informacion_2').value='';

			$('txt_informacion_3').value='';

			

			$('txt_descripcion_1').value='';

			$('txt_descripcion_2').value='';

			$('txt_descripcion_3').value='';

			

			xinha_init();

			}

		else

			{

			xinha_editors['txt_descripcion_1'].setEditorContent('');

			xinha_editors['txt_descripcion_2'].setEditorContent('');

			xinha_editors['txt_descripcion_3'].setEditorContent('');

			

			if(!xinha_editors['txt_ubicacion_1'] == undefined){xinha_editors['txt_ubicacion_1'].setEditorContent('');}else{$('txt_ubicacion_1').value='';}

			if(!xinha_editors['txt_ubicacion_2'] == undefined){xinha_editors['txt_ubicacion_2'].setEditorContent('');}else{$('txt_ubicacion_2').value='';}

			if(!xinha_editors['txt_ubicacion_3'] == undefined){xinha_editors['txt_ubicacion_3'].setEditorContent('');}else{$('txt_ubicacion_3').value='';}

			

			if(!xinha_editors['txt_tipologia_1'] == undefined){xinha_editors['txt_tipologia_1'].setEditorContent('');}else{$('txt_tipologia_1').value='';}

			if(!xinha_editors['txt_tipologia_2'] == undefined){xinha_editors['txt_tipologia_2'].setEditorContent('');}else{$('txt_tipologia_2').value='';}

			if(!xinha_editors['txt_tipologia_3'] == undefined){xinha_editors['txt_tipologia_3'].setEditorContent('');}else{$('txt_tipologia_3').value='';}

			

			if(!xinha_editors['txt_pago_1'] == undefined){xinha_editors['txt_pago_1'].setEditorContent('');}else{$('txt_pago_1').value='';}

			if(!xinha_editors['txt_pago_2'] == undefined){xinha_editors['txt_pago_2'].setEditorContent('');}else{$('txt_pago_2').value='';}

			if(!xinha_editors['txt_pago_3'] == undefined){xinha_editors['txt_pago_3'].setEditorContent('');}else{$('txt_pago_3').value='';}

			

			if(!xinha_editors['txt_informacion_1'] == undefined){xinha_editors['txt_informacion_1'].setEditorContent('');}else{$('txt_informacion_1').value='';}

			if(!xinha_editors['txt_informacion_2'] == undefined){xinha_editors['txt_informacion_2'].setEditorContent('');}else{$('txt_informacion_2').value='';}

			if(!xinha_editors['txt_informacion_3'] == undefined){xinha_editors['txt_informacion_3'].setEditorContent('');}else{$('txt_informacion_3').value='';}

			}

		

		var cell = $("files_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiarchivo').disabled=false;

		cell = $("localizacion_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multilocalizacion').disabled=false;
		
		cell = $("precio_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiprecio').disabled=false;
		
		cell = $("entorno_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multientorno').disabled=false;
		
		cell = $("servicios_list");
		if(cell)
			{
			if ( cell.hasChildNodes() )
				{
				while ( cell.childNodes.length >= 1 )
					{
					cell.removeChild( cell.firstChild );       
					} 
				}
			}
		img_general.count=0;
		$('multiservicios').disabled=false;

	

	//oculto el plano

	if($('plano_altual').style.display!='none')

		{

		$('plano_altual').style.display = 'none';

		}

	

	//MUEVE A LA PESTAÑA tb1

	bto_pestana('tb1');

	}

	

//BUSCADOR

function buscador()

	{

	var validado = true;

	if($('busc_zona').selectedIndex<1 && $('busc_pais').selectedIndex<1)

		{

		alert("La zona y el país son obligatorios");

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

					alert('El precio máximo debe ser mayor al precio mínimo');

					}

				}

			else

				{

				validado = false;

				alert('ingrese el precio mínimo y máximo para realizar la búsqueda por precios');

				}

			}

		

		if(validado)

			{

			$('form2').action = "apartamentos.php?busqueda=1";

			$('form2').submit();

			}

		}

	}

	

//INICIA LOS EDITORES DE LOS TAB

function tab_init(tabla)

	{

	switch(tabla)

		{

	case 'tb1':

		if(!xinha_editors)

			{

			//Make the editors

			var otros_editor = ['txt_descripcion_1'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_descripcion_1"] = otros_editor["txt_descripcion_1"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_descripcion_1"].generate();

			

			var otros_editor = ['txt_descripcion_2'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_descripcion_2"] = otros_editor["txt_descripcion_2"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_descripcion_2"].generate();

			

			var otros_editor = ['txt_descripcion_3'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_descripcion_3"] = otros_editor["txt_descripcion_3"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_descripcion_3"].generate();

			}

	break;

	case 'tb2':

		if(!xinha_editors['txt_ubicacion_1'])

			{

			//Make the editors

			var otros_editor = ['txt_ubicacion_1'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_ubicacion_1"] = otros_editor["txt_ubicacion_1"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_ubicacion_1"].generate();

			

			//Make the editors

			var otros_editor = ['txt_ubicacion_2'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_ubicacion_2"] = otros_editor["txt_ubicacion_2"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_ubicacion_2"].generate();

			

			//Make the editors

			var otros_editor = ['txt_ubicacion_3'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_ubicacion_3"] = otros_editor["txt_ubicacion_3"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_ubicacion_3"].generate();

			}

	break;

	case 'tb3':

		if(!xinha_editors['txt_tipologia_1'])

			{

			//Make the editors

			var otros_editor = ['txt_tipologia_1'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_tipologia_1"] = otros_editor["txt_tipologia_1"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_tipologia_1"].generate();

			

			//Make the editors

			var otros_editor = ['txt_tipologia_2'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_tipologia_2"] = otros_editor["txt_tipologia_2"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_tipologia_2"].generate();

			

			//Make the editors

			var otros_editor = ['txt_tipologia_3'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_tipologia_3"] = otros_editor["txt_tipologia_3"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_tipologia_3"].generate();

			}

	break;

	case 'tb4':

		if(!xinha_editors['txt_pago_1'])

			{

			//Make the editors

			var otros_editor = ['txt_pago_1'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_pago_1"] = otros_editor["txt_pago_1"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_pago_1"].generate();

			

			//Make the editors

			var otros_editor = ['txt_pago_2'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_pago_2"] = otros_editor["txt_pago_2"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_pago_2"].generate();

			

			//Make the editors

			var otros_editor = ['txt_pago_3'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_pago_3"] = otros_editor["txt_pago_3"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_pago_3"].generate();

			}

	break;

	case 'tb5':

		if(!xinha_editors['txt_informacion_1'])

			{

			//Make the editors

			var otros_editor = ['txt_informacion_1'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_informacion_1"] = otros_editor["txt_informacion_1"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_informacion_1"].generate();

			

			//Make the editors

			var otros_editor = ['txt_informacion_2'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_informacion_2"] = otros_editor["txt_informacion_2"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_informacion_2"].generate();

			

			//Make the editors

			var otros_editor = ['txt_informacion_3'];

			otros_editor = Xinha.makeEditors(otros_editor,xinha_config,xinha_plugins);

			xinha_editors["txt_informacion_3"] = otros_editor["txt_informacion_3"];

			

			//Use generate instead of Xinha.startEditors

			xinha_editors["txt_informacion_3"].generate();

			}

	break;
	case 'tb6':
		if($('txt_estado').selectedIndex>0)
			{
			$('img_localizacion').style.display='none';
			$('img_precio').style.display='none';
			$('img_entorno').style.display='none';
			$('img_servicios').style.display='none';
			}
		else
			{
			$('img_localizacion').style.display='';
			$('img_precio').style.display='';
			$('img_entorno').style.display='';
			$('img_servicios').style.display='';
			}
	break;
		}

	}

	

//OCULTO EL FORMULARIO

function ocultar_form()

	{

	$('alta_modi').style.display='none';

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



//indico que tengo que borrar el plano

function borrar_plano()

	{

	$('txt_del_plano').value='1';

	$('plano_altual').toggle();

	}