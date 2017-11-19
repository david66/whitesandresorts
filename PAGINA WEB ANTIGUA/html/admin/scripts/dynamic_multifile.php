<?php
if($_GET['i']){
$instancia = $_GET['i'];
$archivo = $_GET['f'];
$tipo = $_GET['t'];
?>
function class_<?php echo $instancia;?>( list_target, form_target, max){
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
				element.name = '<?php echo $archivo;?>' + this.id++;
				element.<?php echo $instancia;?> = this;
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
						
						this.<?php echo $instancia;?>.addElement( new_element );
						this.<?php echo $instancia;?>.addListRow( this );					
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
						this.<?php echo $instancia;?>.addElement(new_element);
						this.parentNode.removeChild(this);
						this.<?php echo $instancia;?>.count--;				
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
			this.parentNode.element.<?php echo $instancia;?>.count--;
			this.parentNode.element.<?php echo $instancia;?>.current_element.disabled = false;
			return false;
		};
		new_row.innerHTML = '<iframe src="includes/preview.php" id="ver'+element.name+'" name="ver'+element.name+'" scrolling="no"></iframe>';
		new_row.appendChild( new_row_button );				
		this.list_target.appendChild( new_row );
		<?php echo $instancia;?>.prever( element.name );
	};
	//muestra la vista previa
	this.prever = function(f){
		var actionActual = <?php echo $instancia;?>.form_target.action;
		var targetActual = <?php echo $instancia;?>.form_target.target;
		<?php echo $instancia;?>.form_target.action = "includes/preview.php?img="+f+"&t=<?php echo $tipo; ?>";
		<?php echo $instancia;?>.form_target.target = "ver"+f;
		<?php echo $instancia;?>.form_target.submit();
		<?php echo $instancia;?>.form_target.action = actionActual;
		<?php echo $instancia;?>.form_target.target = targetActual;
	};
};
<?php
}
?>