<?php
/* CLASE DE ACCIONES DE LAS paisesES */
class accion_paises
	{
	public $conect;
	
	/* INICIA LA CLASE RECIBIENDO EL ID DE LA CONECCION SQL */
	function __construct($conect='')
		{
		if($conect)
			{
			$this->conect = $conect;
			}
		}
		
	/* GUARDA LOS CAMBIOS EN LA paises, RECIBIENDO EL OBJETO DE paises */
	function guardar($paises='',$path='../archivos/')
		{
		
		/* CHEQUEO SI ES UN OBJETO, SI NO DEVUELVO FALSE */
		if(is_object($paises))
			{
			/* SI LA paises TIENE ASIGNADO UN ID ACTUALIZO LOS DATOS SI NO LOS GUARDO */
			if($paises->get_id())
				{
				$sql = "update paises set pai_nombre='".$paises->get_nombre()."' where pai_id='".$paises->get_id()."'";
				
				/* EJECUTO LA CONSULTA O MUESTRO ERROR */
				mysql_query($sql,$this->conect) or die("ERR PAI-29: NO SE PUDO GUARDAR LOS DATOS DEL PAIS");				
				}
			else
				{
				$sql = "insert into paises (pai_nombre) VALUES ('".$paises->get_nombre()."')";
				
				/* EJECUTO LA CONSULTA O MUESTRO ERROR */
				mysql_query($sql,$this->conect) or die("ERR PAI-36: NO SE PUDO GUARDAR LOS DATOS DEL PAIS");
				
				//OBTENGO EL ID DE LA ZONA INSERTADA
				$paises->set_id(mysql_insert_id($this->conect));
				}
			
			//GUARDO/ACTUALIZO LA IMAGEN	
			if($paises->get_logo())
				{
				$imagen = $paises->get_id().'_PAI.jpg';
				file_put_contents($path.$imagen, $paises->get_logo()) or die("ERR ZON 35: NO SE PUDO GUARDAR EL ARCHIVO");
				@chmod($path.$imagen,0777);
				
				$sql = "update paises set pai_imagen='".$imagen."' where pai_id='".$paises->get_id()."'";
				mysql_query($sql,$this->conect) or die("ERR PAI-42: NO SE PUDO BORRAR LA IMAGEN");				
				}
			else
				{
				//SI NO BORRO LA IMAGEN
				if($paises->get_del())
					{
					$sql = "select pai_imagen from paises where pai_id='".$paises->get_id()."'";
					$imagen = mysql_query($sql,$this->conect) or die("ERR PAI-49: NO SE PUDO BORRAR LA IMAGEN");
					if(mysql_num_rows($imagen)>0)
						{
						@unlink($path.mysql_result($imagen,0));
						$sql = "update paises set pai_imagen='' where pai_id='".$paises->get_id()."'";
						mysql_query($sql,$this->conect) or die("ERR PAI-55: NO SE PUDO BORRAR LA IMAGEN");
						}
					}
				}
					
			return true;
			}
		else
			{
			return false;
			}
		}
	
	/* ELIMINA LOS DATOS DE LA ZONA DADA */
	function eliminar($paises=0)
		{
		/* CHEQUEO SI ES UN OBJETO, SI NO DEVUELVO FALSE */
		if($paises>0)
			{
			$sql = "select pai_imagen from paises where pai_id='".$paises."'";
			$imagen = mysql_query($sql,$this->conect);
			if(mysql_num_rows($imagen)>0)
				{
				@unlink("archivos/".mysql_result($imagen,0));
				}
			$sql = "delete from paises where pai_id='".$paises."'";
			mysql_query($sql,$this->conect) or die("ERR PAI-80: NO SE PUDO BORRAR LOS DATOS DEL PAIS");
			return true;
			}
		else
			{
			return false;
			}
		}
		
	/* DEVUELVE LA CONSULTA NECESARIA PARA ARMAR EL LISTADO */
	function listado($busqueda='')
		{
		$sql = "select paises.pai_id,paises.pai_nombre,paises.pai_imagen from paises";
		if(is_object($busqueda))
			{
			// SI SE PASO UN OBJETO CON DATOS ARMA LA BUSQUEDA
			if($busqueda->get_nombre())
				{
				$sql_where .= ($sql_where)?" and":" where";
				$sql_where .= " paises.pai_nombre like '".$busqueda->get_nombre()."%'";
				}
			$sql = $sql.$sql_where;
			unset($sql_where);
			if($busqueda->get_campo())
				{
				$sql .= " order by ".$busqueda->get_campo()." ".$busqueda->get_orden();
				}
			}
		// DEVUELVE EL SQL
		return $sql;
		}
		
	//CHEQUEO QUE LA ZONA NO SE HAYA REGISTRADO PREVIAMENTE
	function chequear($valor='',$id=0)
		{
		if (!$id)
			{
			$sql="select count(*) from paises where pai_nombre='".$valor."'";
			}
		else
			{
			$sql="select count(*) from paises where pai_nombre='".$valor."' and pai_id<>'".$id."'";
			}
		$result = mysql_query($sql,$this->conect) or die("ERR PAI-124: NO SE PUDO COMPROBAR EL PAIS");
		return mysql_result($result,0);
		}
		
	//DEVUELVE UN ARRAY DE JSON CON LOS DATOS DE LAS paises
	function cargar($id,$path='../archivos/')
		{
		$sql="select paises.pai_id,paises.pai_nombre,paises.pai_imagen from paises where pai_id='".$id."'";
		$result = mysql_query($sql,$this->conect) or die("ERR PAI-131: NO SE PUDO ZONGAR LA paises");
		if(mysql_num_rows($result)>0)
			{
			$row = mysql_fetch_array($result);
			}
		return $row[0].'|'.$row[1].'|'.(($row[2])?$path.$row[2]:'');
		}
	}
?>