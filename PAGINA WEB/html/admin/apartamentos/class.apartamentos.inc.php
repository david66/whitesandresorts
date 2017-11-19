<?php

class apartamentos

	{

	private $id;

	private $nombre;

	private $estado;
	
	private $order;
	

	//DESCRIPCION

	private $descripcion; //ARRAY IDIOMAS

	

	//ZONA

	private $zona;

	private $pais;

	

	private $direccion;

	private $provincia;

	private $ciudad;

	private $cp;

	private $ubicacion;



	//tipologia

	private $dormitorios;

	private $metros;

	private $tipologia;

	private $plano;

	private $del_plano;

	

	//ARRAY DE CATEGORIAS

	private $precio;

	private $precio_min;

	private $precio_max;

	private $pago;

	

	//INFROMACION

	private $informacion;

	

	//PORTADA

	private $portada;

	

	//URL

	private $url;

	

	//IDIOMA

	private $idioma;

	

	//CONTIENE LAS IMAGENES UTILIZADAS POR EL APARTAMENTO

	private $galeria; //ARRAY TIPO BLOB

	private $gal_del;

	//GUARDAMOS EL CAMPO EN EL CUAL QUEREMOS HACER LA BUSQUEDA

	private $campo;

	//GUARDAMOS EL TIPO DE ORDEN DE LA BUSQUEDA "ASC" O "DESC"

	private $orden;

	

	//SETEA EL ID DEL APARTAMENTO

	function set_id($id = 0)

		{

		$this->id = $id;

		}

	//DEVUELVE EL ID DEL APARTAMENTO

	function get_id()

		{

		return $this->id;

		}

		

	//SETEA EL NOMBRE DEL APARTAMENTO

	function set_nombre($nombre = '')

		{

		$this->nombre = $nombre;

		}
		
		

	//DEVUELVE EL NOMBRE DEL APARTAMENTO

	function get_nombre()

		{

		return $this->nombre;

		}
		
//SETEA EL  ORDEN JON

	function set_order($order = '')

		{

		$this->order = $order;

		}

//DEVUELVE EL ORDEN DEL APARTAMENTO JON

	function get_order()

		{

		return $this->order;

		}
	

	//SETEA EL ARRAY DE DESCRIPCIONES DEL APARTAMENTO

	function set_descripcion($descripcion = '')

		{

		$this->descripcion = $descripcion;

		}

	//DEVUELVE EL ARRAY DE DESCRIPCIONES DEL APARTAMENTO

	function get_descripcion()

		{

		return $this->descripcion;

		}

		

	//SETEA EL TIPO DEL APARTAMENTO

	function set_estado($estado = '')

		{

		$this->estado = $estado;

		}

	//DEVUELVE EL TIPO DEL APARTAMENTO

	function get_estado()

		{

		return $this->estado;

		}



	//SETEA LA ZONA

	function set_zona($zona = 0)

		{

		$this->zona = $zona;

		}

	//DEVUELVE LA ZONA

	function get_zona()

		{

		return $this->zona;

		}

		

	//SETEA LA PAIS

	function set_pais($pais = 0)

		{

		$this->pais = $pais;

		}

	//DEVUELVE LA PAIS

	function get_pais()

		{

		return $this->pais;

		}

		

	//SETEA LA PROVINCIA

	function set_provincia($provincia = 0)

		{

		$this->provincia = $provincia;

		}

	//DEVUELVE LA PROVINCIA

	function get_provincia()

		{

		return $this->provincia;

		}		

		

	//SETEA LA CIUDAD

	function set_ciudad($ciudad = 0)

		{

		$this->ciudad = $ciudad;

		}

	//DEVUELVE LA CIUDAD

	function get_ciudad()

		{

		return $this->ciudad;

		}

		

	//SETEA EL DIRECCION DEL APARTAMENTO

	function set_direccion($direccion = '')

		{

		$this->direccion = $direccion;

		}

	//DEVUELVE EL DIRECCION DEL APARTAMENTO

	function get_direccion()

		{

		return $this->direccion;

		}

		

	//SETEA EL CP DEL APARTAMENTO

	function set_cp($cp = '')

		{

		$this->cp = $cp;

		}

	//DEVUELVE EL CP DEL APARTAMENTO

	function get_cp()

		{

		return $this->cp;

		}

		

	//SETEA EL TEXTO DE UBICACION DEL APARTAMENTO

	function set_ubicacion($ubicacion = '')

		{

		$this->ubicacion = $ubicacion;

		}

		

	//DEVUELVE EL TEXTO DE UBICACION DEL APARTAMENTO

	function get_ubicacion()

		{

		return $this->ubicacion;

		}

		

	//SETEA LOS M2 DEL APARTAMENTO

	function set_metros($metros = 0)

		{

		$this->metros = $metros;

		}

	//DEVUELVE LOS M2 DEL APARTAMENTO

	function get_metros()

		{

		return $this->metros;

		}

		

	//SETEA LAS HABITACIONES DEL APARTAMENTO

	function set_dormitorios($dormitorios = 0)

		{

		$this->dormitorios = $dormitorios;

		}

	//DEVUELVE LAS HABITACIONES DEL APARTAMENTO

	function get_dormitorios()

		{

		return $this->dormitorios;

		}

		

	//SETEA EL TEXTO DE TIPOLOGIAS

	function set_tipologia($tipologia = 0)

		{

		$this->tipologia = $tipologia;

		}

	//DEVUELVE EL TEXTO DE TIPOLOGIAS

	function get_tipologia()

		{

		return $this->tipologia;

		}

		

	//COMO TODO EL ATRIBUTO FILE SE CARGA CON LA GALERIA SOLO INDICAMOS SI DENTRO DEL FILE ESTA EL ARCHIVO DEL PLANO

	function set_plano($plano = 0)

		{

		$this->plano = $plano;

		}

	//DEVUELVE LA INFO SI SE CARGO UN PLANO

	function get_plano()

		{

		return $this->plano;

		}

		

	//SETEAMOS SI TENEMOS QUE ELIMINAR EL PLANO

	function set_del_plano($del_plano = 0)

		{

		$this->del_plano = $del_plano;

		}

	//DEVUELVE LA INFO SI SE ELIMINO UN PLANO

	function get_del_plano()

		{

		return $this->del_plano;

		}

	

	//SETEA EL PRECIO DEL APARTAMENTO

	function set_precio($precio = 0)

		{

		$this->precio = $precio;

		}

	//DEVUELVE EL PRECIO DEL APARTAMENTO

	function get_precio()

		{

		return $this->precio;

		}	

		

	//SETEA EL PRECIO DEL APARTAMENTO

	function set_precio_min($precio_min = 0)

		{

		$this->precio_min = $precio_min;

		}

	//DEVUELVE EL PRECIO DEL APARTAMENTO

	function get_precio_min()

		{

		return $this->precio_min;

		}	

		

	//SETEA EL PRECIO DEL APARTAMENTO

	function set_precio_max($precio_max = 0)

		{

		$this->precio_max = $precio_max;

		}

	//DEVUELVE EL PRECIO DEL APARTAMENTO

	function get_precio_max()

		{

		return $this->precio_max;

		}	

		

	//SETEA LA FORMA DE PAGO DEL APARTAMENTO

	function set_pago($pago = '')

		{

		$this->pago = $pago;

		}

	//DEVUELVE LA FORMA DE PAGO DEL APARTAMENTO

	function get_pago()

		{

		return $this->pago;

		}	

	

	//SETEA LA INFORMACION DEL APARTAMENTO

	function set_informacion($informacion = '')

		{

		$this->informacion = $informacion;

		}

	//DEVUELVE LA INFORMACION DEL APARTAMENTO

	function get_informacion()

		{

		return $this->informacion;

		}	

	

	//SETEA LA GALERIA DEL APARTAMENTO

	function set_galeria($galeria = array())

		{

		if(is_array($galeria))

			{

			$this->galeria = $galeria;

			}

		}

	//DEVUELVE LA GALERIA DEL APARTAMENTO

	function get_galeria()

		{

		return $this->galeria;

		}

		

	//SETEA LAS IMAGENES A ELIMINAR

	function set_del($gal_del = 0)

		{

		$this->gal_del = $gal_del;

		}

	//DEVUELVE LAS IMAGENES A ELIMINAR

	function get_del()

		{

		return $this->gal_del;

		}

	

	//SETEA LA VARIABLE PORTADA

	function set_portada($portada = 0)

		{

		$this->portada = $portada;

		}

	//DEVUELVE EL VALOR DE LA VARIABLE PORTADA

	function get_portada()

		{

		return $this->portada;

		}

	

	//SETEA LA URL DE APARTAMENTO

	function set_url($url = '')

		{

		$this->url = $url;

		}

	//DEVUELVE LA URL DEL APARTAMENTO

	function get_url()

		{

		return $this->url;

		}

	

	//SETEA LA VARIABLE CAMPO PARA REALIZAR LA BUSQUEDA

	function set_campo($campo=0)

		{

		$this->campo = $campo;

		}

	//DEVUELVE EL VALOR DE LA VARIABLE CAMPO PARA REALIZAR LA BUSQUEDA

	function get_campo()

		{

		return $this->campo;

		}

		

	//SETEA LA VARIABLE ORDEN PARA REALIZAR LA BUSQUEDA

	function set_orden($orden=0)

		{

		$this->orden = $orden;

		}

	//DEVUELVE EL VALOR DE LA VARIABLE ORDEN PARA REALIZAR LA BUSQUEDA

	function get_orden()

		{

		return $this->orden;

		}

		

	//SETEA EL idioma DEL APARTAMENTO

	function set_idioma($idioma = '')

		{

		$this->idioma = $idioma;

		}

	//DEVUELVE EL idioma DEL APARTAMENTO

	function get_idioma()

		{

		return $this->idioma;

		}

	}

?>