function MultiSelector( list_target, form_target, max){
	this.list_target = list_target;
	this.form_target = form_target;
	this.count = 0;
	this.id = 0;
	if( max ){
		this.max = max;
	} else {
		this.max = -1;
	};
	//evento agregar elemento, se activa al seleccionar un archivo
	this.addElement = function( element ){
		//si es un input file oculta el input anterior y crea un nuevo input
		if( element.tagName == 'INPUT' && element.type == 'file'){					  
				element.name = 'foto_' + this.id++;
				element.multi_selector = this;
				element.onchange = function(){
						
				var archivo = element.value;
				var extpermitidas = new Array(".gif", ".jpg", ".jpeg", ".png", ".bmp"); 
				var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
				var permitida = false;
				for (var i = 0; i < extpermitidas.length; i++) {
					if (extpermitidas[i] == extension) {
						permitida = true;
						break;
				   }
				} 
				//cehquea si el archivo es una imagen o no
				if (permitida) {
						var new_element = document.createElement( 'input' );
						new_element.type = 'file';
						this.parentNode.insertBefore( new_element, this );
						//GUARDAR
						this.style.visibility = "hidden";
						this.style.display = "none";
						
						this.multi_selector.addElement( new_element );
						this.multi_selector.addListRow( this );					
						new_element.className = "multiarchivo_file";
				} else {
						alert( 'El Archivo que has seleccionado no es una imagen' );
						//ocultamos el input viejo
						this.style.visibility = "hidden";
						this.style.display = "none";
						/*Creo el nuevo elemento*/
						var new_element = document.createElement('input');
						new_element.type='file';
						/*antepone el nuevo elemento*/
						this.parentNode.insertBefore(new_element,this);
						new_element.className = "multiarchivo_file";
						this.multi_selector.addElement(new_element);
						this.parentNode.removeChild(this);
						this.multi_selector.count--;				
				};
			};
			if( this.max != -1 && this.count >= this.max){
			element.disabled = true;
			};
			this.count++;
			this.current_element = element;
		} else {
			alert( 'No has seleccionado ninguna imagen' );
		};
	};
	//añade la vista previa
	this.addListRow = function( element ){
		var new_row = document.createElement( 'div' );
		var new_row_button = document.createElement( 'input' );
		new_row.className = "Preview_de_imagen";
		new_row_button.type = 'button';
		new_row_button.value = 'Eliminar';
		new_row.element = element;
		new_row_button.onclick= function(){
			//instalar top y left para la posicion recordada
			var eliminado = document.getElementById('ver'+this.parentNode.element.name)
			this.parentNode.element.parentNode.removeChild( this.parentNode.element );
			this.parentNode.parentNode.removeChild( this.parentNode );
			this.parentNode.element.multi_selector.count--;
			this.parentNode.element.multi_selector.current_element.disabled = false;
			return false;
		};
		new_row.innerHTML = '<iframe src="includes/preview.php" id="ver'+element.name+'" name="ver'+element.name+'" scrolling="no"></iframe>';
		new_row.appendChild( new_row_button );				
		this.list_target.appendChild( new_row );
		multi_selector.prever( element.name );
	};
	//muestra la vista previa
	this.prever = function(f){
		var actionActual = multi_selector.form_target.action;
		var targetActual = multi_selector.form_target.target;
		multi_selector.form_target.action = "includes/preview.php?img="+f;
		multi_selector.form_target.target = "ver"+f;
		multi_selector.form_target.submit();
		multi_selector.form_target.action = actionActual;
		multi_selector.form_target.target = targetActual;
	};
	
};