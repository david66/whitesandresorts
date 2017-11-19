<?php
class zonas
	{
	private $id;
	private $nombre;
	private $pais;
	private $logo; //TIPO BLOB
	private $del; //¿BORRAR IMAGEN?
	private $portada; //PONER EN PORTADA
	//GUARDAMOS EL CAMPO EN EL CUAL QUEREMOS HACER LA BUSQUEDA
	private $campo;
	//GUARDAMOS EL TIPO DE ORDEN DE LA BUSQUEDA "ASC" O "DESC"
	private $orden;
	
	//INICIO EL LOGO COMO NULL
	function __construct()
		{
		$this->logo = null;
		}
	
	//SETEA LA VARIABLE ID
	function set_id($id=0)
		{
		$this->id = $id;
		}
	//DEVUELVE EL VALOR DE LA VARIABLE ID
	function get_id()
		{
		return $this->id;
		}
	
	//SETEA LA VARIABLE NOMBRE	
	function set_nombre($nombre=0)
		{
		$this->nombre = trim($nombre);
		}
	//DEVUELVE EL VALOR DE LA VARIABLE NOMBRE
	function get_nombre()
		{
		return $this->nombre;
		}
		
	//SETEA LA VARIABLE PAIS	
	function set_pais($pais=0)
		{
		$this->pais = trim($pais);
		}
	//DEVUELVE EL VALOR DE LA VARIABLE PAIS
	function get_pais()
		{
		return $this->pais;
		}
		
	//SETEA LA VARIABLE LOGO	
	function set_logo($logo)
		{
		$this->logo = $logo;
		}
	//DEVUELVE EL VALOR DE LA VARIABLE LOGO
	function get_logo()
		{
		return $this->logo;
		}
		
	//SETEA LA VARIABLE DEL	
	function set_del($logo=0)
		{
		$this->del = ($logo>0)?true:false;
		}
	//DEVUELVE EL VALOR DE LA VARIABLE DEL
	function get_del()
		{
		return $this->del;
		}		
	
	//SETEA LA VARIABLE PORTADA
	function set_portada($portada='off')
		{
		if($portada=='on')
			{
			$this->portada = 1;
			}
		else
			{
			$this->portada = 0;
			}
		}
	//DEVUELVE EL VALOR DE LA VARIABLE PORTADA
	function get_portada()
		{
		return $this->portada;
		}
	
	//SETEA LA VARIABLE CAMPO	
	function set_campo($campo=0)
		{
		$this->campo = $campo;
		}
	//DEVUELVE EL VALOR DE LA VARIABLE CAMPO
	function get_campo()
		{
		return $this->campo;
		}
		
	//SETEA LA VARIABLE ORDEN	
	function set_orden($orden=0)
		{
		$this->orden = $orden;
		}
	//DEVUELVE EL VALOR DE LA VARIABLE ORDEN
	function get_orden()
		{
		return $this->orden;
		}
	}
	
?>