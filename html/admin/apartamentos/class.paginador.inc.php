<?php
/* PAGINADOR DE LISTADOS */
class paginador
	{
	private $nro_pagina;
	private $cant_paginas;
	private $reg_paginas;
	private $total_registros;
	public $datos_paginado;
	public $conect;
	
	//INICIO LA CLASE
	function __construct($conect='')
		{
		if($conect)
			{
			$this->conect = $conect;
			}
		//SETEO LOS VALORES POR DEFECTO
		$this->reg_paginas = 20;
		$this->nro_pagina = 0;
		}
	
	//SETEA LA VARIABLE NRO_PAGINA
	function set_nro_pagina($nro_pagina=0)
		{
		if($nro_pagina)
			{
			$this->nro_pagina = $nro_pagina;
			return true;
			}
		return false;
		}
		
	//DEVUELVE EL VALOR DE LA VARIABLE NRO_PAGINA
	function get_nro_pagina($nro_pagina=0)
		{
		return $this->nro_pagina;
		}
		
	//SETEA LA VARIABLE REG_PAGINA
	function set_reg_pagina($reg_paginas=0)
		{
		if($reg_paginas>0)
			{
			$this->reg_paginas = $reg_paginas;
			return true;
			}
		return false;
		}
		
	//DEVUELVE EL VALOR DE LA VARIABLE REG_PAGINA
	function get_reg_pagina($reg_paginas=0)
		{
		return $this->reg_paginas;
		}		
		
	//INICIA LA PAGINACION DEL LISTADO
	function paginar_resultados($sql="")
		{
		//CALCULO EL REGISTRO DESDE EL CUAL SE EMPIEZA A CARGAR LOS DATOS
		$inicio = $this->nro_pagina * $this->reg_paginas;
		
		//PAGINO LOS RESULTADOS
		$query_limit = sprintf("%s LIMIT %d, %d", $sql, $inicio, $this->reg_paginas);
		$this->datos_paginado = mysql_query($query_limit, $this->conect) or die('ERR PAG-66: NO SE HA PODIDO MOSTRAR LOS DATOS DEL LISTADO');
		
		//OBTENGO Y SETEO LA CANTIDAD TOTAL DE REGISTROS
		$all_sql = mysql_query("select count(*) from (".$sql.") as total", $this->conect) or die('ERR PAG-69: NO SE HA PODIDO CARGAR LOS DATOS DEL LISTADO');
		$this->total_registros = mysql_result($all_sql,0);
		
		//SETEO LA CANTIDAD DE PAGINAS
		$this->cant_paginas = ceil($this->total_registros/$this->reg_paginas)-1;
		}
		
	// DEVUELVE EL TOTAL DE PAGINA
	function get_cant_paginas()
		{
		return $this->cant_paginas;
		}
		
	// DEVUELVE EL TOTAL DE PAGINA
	function get_total_registros()
		{
		return $this->total_registros;
		}
		
	// DEVUELVE LOS SIGUIENTES DATOS A MOSTRAR EN EL LISTADO PAGINADO
	function get_fila()
		{
		return mysql_fetch_array($this->datos_paginado);
		}
		
	// DEVUELVE EL NUMERO DE REGISTRO ACTUAL
	function get_reg_actual()
		{
		return ($this->nro_pagina * $this->reg_paginas);
		}
	}
?>