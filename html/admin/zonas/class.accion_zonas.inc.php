<?php
/* CLASE DE ACCIONES DE LAS ZONASES */
class accion_zonas
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
		
	/* GUARDA LOS CAMBIOS EN LA ZONAS, RECIBIENDO EL OBJETO DE ZONAS */
	function guardar($zonas='',$path='../archivos/')
		{
		
		/* CHEQUEO SI ES UN OBJETO, SI NO DEVUELVO FALSE */
		if(is_object($zonas))
			{
			/* SI LA ZONAS TIENE ASIGNADO UN ID ACTUALIZO LOS DATOS SI NO LOS GUARDO */
			if($zonas->get_id())
				{
				$sql = "update zonas set zon_nombre='".$zonas->get_nombre()."',zon_portada='".$zonas->get_portada()."' where zon_id='".$zonas->get_id()."'";
				
				/* EJECUTO LA CONSULTA O MUESTRO ERROR */
				mysql_query($sql,$this->conect) or die("ERR ZON-34: NO SE PUDO GUARDAR LOS DATOS DE LAS ZONAS");				
				}
			else
				{
				$sql = "insert into zonas (zon_nombre,zon_portada) VALUES ('".$zonas->get_nombre()."','".$zonas->get_portada()."')";
				
				/* EJECUTO LA CONSULTA O MUESTRO ERROR */
				mysql_query($sql,$this->conect) or die("ERR ZON-34: NO SE PUDO GUARDAR LOS DATOS DE LAS ZONAS");
				
				//OBTENGO EL ID DE LA ZONA INSERTADA
				$zonas->set_id(mysql_insert_id($this->conect));
				}
			
			//GUARDO/ACTUALIZO LA IMAGEN	
			if($zonas->get_logo())
				{
				$imagen = $zonas->get_id().'_ZON.jpg';
				file_put_contents($path.$imagen, $zonas->get_logo()) or die("ERR ZON 35: NO SE PUDO GUARDAR EL ARCHIVO");
				@chmod($path.$imagen,0777);
				
				$sql = "update zonas set zon_imagen='".$imagen."' where zon_id='".$zonas->get_id()."'";
				mysql_query($sql,$this->conect) or die("ERR ZON-42: NO SE PUDO ZONGAR LA IMAGEN");				
				}
			else
				{
				//SI NO BORRO LA IMAGEN
				if($zonas->get_del())
					{
					$sql = "select zon_imagen from zonas where zon_id='".$zonas->get_id()."'";
					$imagen = mysql_query($sql,$this->conect) or die("ERR ZON-49: NO SE PUDO ZONGAR LA IMAGEN");
					if(mysql_num_rows($imagen)>0)
						{
						@unlink($path.mysql_result($imagen,0));
						$sql = "update zonas set zon_imagen='' where zon_id='".$zonas->get_id()."'";
						mysql_query($sql,$this->conect) or die("ERR ZON-55: NO SE PUDO BORRAR LA IMAGEN");
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
	function eliminar($zonas=0)
		{
		/* CHEQUEO SI ES UN OBJETO, SI NO DEVUELVO FALSE */
		if($zonas>0)
			{
			$sql = "select zon_imagen from zonas where zon_id='".$zonas."'";
			$imagen = mysql_query($sql,$this->conect);
			if(mysql_num_rows($imagen)>0)
				{
				@unlink("archivos/".mysql_result($imagen,0));
				}
			$sql = "delete from zonas where zon_id='".$zonas."'";
			mysql_query($sql,$this->conect) or die("ERR ZON-80: NO SE PUDO BORRAR LOS DATOS DE LA ZONA");
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
		$sql = "select zonas.zon_id,zonas.zon_nombre,zonas.zon_imagen from zonas";
		if(is_object($busqueda))
			{
			// SI SE PASO UN OBJETO CON DATOS ARMA LA BUSQUEDA
			if($busqueda->get_nombre())
				{
				$sql_where .= ($sql_where)?" and":" where";
				$sql_where .= " zonas.zon_nombre like '".$busqueda->get_nombre()."%'";
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
			$sql="select count(*) from zonas where zon_nombre='".$valor."'";
			}
		else
			{
			$sql="select count(*) from zonas where zon_nombre='".$valor."' and zon_id<>'".$id."'";
			}
		$result = mysql_query($sql,$this->conect) or die("ERR ZON-124: NO SE PUDO COMPROBAR LA ZONAS");
		return mysql_result($result,0);
		}
		
	//DEVUELVE UN ARRAY DE JSON CON LOS DATOS DE LAS ZONAS
	function cargar($id,$path='../archivos/')
		{
		$sql="select zonas.zon_id,zonas.zon_nombre,zonas.zon_portada,zonas.zon_imagen from zonas where zon_id='".$id."'";
		$result = mysql_query($sql,$this->conect) or die("ERR ZON-131: NO SE PUDO ZONGAR LA ZONAS");
		if(mysql_num_rows($result)>0)
			{
			$row = mysql_fetch_array($result);
			}
		return $row[0].'|'.$row[1].'|'.$row[2].'|'.(($row[3])?$path.$row[3]:'');
		}
	}
?>