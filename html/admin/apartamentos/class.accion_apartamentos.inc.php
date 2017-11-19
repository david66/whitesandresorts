<?php

/* CLASE DE ACCIONES DE LOS APARTAMENTOS */

class accion_apartamentos

	{

	public $conect;
	private $path;
	private $admin;

	

	/* INICIA LA CLASE RECIBIENDO EL ID DE LA CONECCION SQL */

	function __construct($conect='',$admin=0)

		{

		if($conect)

			{

			$this->conect = $conect;

			$this->admin = ($admin>0)?true:false;

			}
		$this->path = "../archivos/";

		}

		

	/*GUARDA EL APARTAMENTO RECIBIENDO UN OBJETO APARTAMENTO*/

	function guardar($apartamentos='',$path='../archivos/')

		{

		$sql="select idi_id from idiomas order by idi_id ASC";

		$idiomas = mysql_query($sql, $this->conect) or die(mysql_error());

		

		/*VERIFICO QUE SEA UN OBJECTO*/

		if(is_object($apartamentos))

			{

			/* VERIFICO SI TIENE ID, SI LO TIENE ACTUALIZO EL REGISTRO SINO INSERTO UNO NUEVO*/

			if($apartamentos->get_id())

				{

				$sql = "UPDATE apartamentos SET 
				apa_nombre='".$apartamentos->get_nombre()."',
				zon_id='".$apartamentos->get_zona()."',
				pai_id='".$apartamentos->get_pais()."',
				apa_provincia='".$apartamentos->get_provincia()."',
				apa_ciudad='".$apartamentos->get_ciudad()."',
				apa_cp='".$apartamentos->get_cp()."',
				apa_direccion='".$apartamentos->get_direccion()."',
				apa_estado='".$apartamentos->get_estado()."',
				apa_metros='".$apartamentos->get_metros()."',
				apa_dormitorios='".$apartamentos->get_dormitorios()."',
				apa_precio='".$apartamentos->get_precio()."',
				apa_portada='".$apartamentos->get_portada()."',
				apa_url='".$apartamentos->get_url()."',
				apa_order='".$apartamentos->get_order()."' WHERE apa_id='".$apartamentos->get_id()."'";

				mysql_query($sql,$this->conect) or die('ERR DTO-31 - NO SE PUDO ACTUALIZAR EL APARTAMENTO');

				

				//guardo los detalles basandome en la posicion del idioma en la lista

				$descripciones = $apartamentos->get_descripcion();

				$ubicacion = $apartamentos->get_ubicacion();

				$tipologia = $apartamentos->get_tipologia();

				$pago = $apartamentos->get_pago();

				$informacion = $apartamentos->get_informacion();

				

				$puntero_idioma = 0;

				

				mysql_data_seek($idiomas,0);

				while($rid = mysql_fetch_array($idiomas))

					{

					$sql = "update apartamento_idiomas set aid_nombre='".$descripciones[$puntero_idioma]."',aid_ubicacion='".$ubicacion[$puntero_idioma]."',aid_tipologia='".$tipologia[$puntero_idioma]."',aid_pago='".$pago[$puntero_idioma]."',aid_informacion='".$informacion[$puntero_idioma]."' where idi_id='".$rid['idi_id']."' and apa_id='".$apartamentos->get_id()."'";

					mysql_query($sql, $this->conect) or die(mysql_error());

					$puntero_idioma++;

					}

				

				if($apartamentos->get_del_plano())

					{

					$sql = "select apa_plano from apartamentos where apa_id='".$apartamentos->get_id()."'";

					$planos = mysql_query($sql,$this->conect) or die('ERR DTO-132 - NO SE PUDO BORRAR EL PLANO DEL APARTAMENTO');

					while($row = mysql_fetch_array($planos))

						{

						if($row['apa_plano'])

							{

							@unlink($path.$row['apa_plano']);

							}

						}

				

					$sql = "update apartamentos set apa_plano=null where apa_id='".$apartamentos->get_id()."'";

					mysql_query($sql, $this->conect) or die(mysql_error());

					}

				

				if($apartamentos->get_del())

					{

					$indice = split("\|",$apartamentos->get_del());

					for($i=0;$i<=100;$i++)

						{

						if($indice[$i])

							{

							$sql="SELECT aga_imagen FROM apartamento_galerias WHERE aga_id='".$indice[$i]."' limit 0,1";

							$arc = mysql_query($sql, $this->conect) or die("ERR CLI-43: ERROR AL CARGAR LAS IMAGENES");

							if(mysql_num_rows($arc)>0)

								{

								@unlink($path.mysql_result($arc,0));

								$sql="DELETE FROM apartamento_galerias where aga_id='".$indice[$i]."'";

								mysql_query($sql, $this->conect) or die("ERR CLI-48: ERROR AL CARGAR LAS IMAGENES");

								}

							}

						}

					}

				

				}

			else

				{

				$sql = "INSERT INTO apartamentos (apa_nombre,zon_id,pai_id,apa_provincia,apa_ciudad,apa_cp,apa_direccion,apa_estado,apa_metros,apa_dormitorios,apa_precio,apa_portada,apa_alta,apa_url,apa_order) VALUES (
																																																				'".$apartamentos->get_nombre()."',
																																																				'".$apartamentos->get_zona()."',
																																																				'".$apartamentos->get_pais()."',
																																																				'".$apartamentos->get_provincia()."',
																																																				'".$apartamentos->get_ciudad()."',
																																																				'".$apartamentos->get_cp()."',
																																																				'".$apartamentos->get_direccion()."',
																																																				'".$apartamentos->get_estado()."',
																																																				'".$apartamentos->get_metros()."',
																																																				'".$apartamentos->get_dormitorios()."',
																																																				'".$apartamentos->get_precio()."',
																																																				'".$apartamentos->get_portada()."',
																																																				'".date("Y-m-d")."',
																																																				'".$apartamentos->get_url()."',
																																																				'".$apartamentos->get_order()."')";

				mysql_query($sql,$this->conect) or die('ERR DTO-63 - NO SE PUDO GUARDAR EL APARTAMENTO');

				

				$apartamentos->set_id(mysql_insert_id($this->conect));

				

				//guardo los detalles basandome en la posicion del idioma en la lista

				$descripciones = $apartamentos->get_descripcion();

				$ubicacion = $apartamentos->get_ubicacion();

				$tipologia = $apartamentos->get_tipologia();

				$pago = $apartamentos->get_pago();

				$informacion = $apartamentos->get_informacion();

				$puntero_idioma = 0;

				

				mysql_data_seek($idiomas,0);

				while($rid = mysql_fetch_array($idiomas))

					{

					$sql = "insert into apartamento_idiomas (idi_id,apa_id,aid_nombre,aid_ubicacion,aid_tipologia,aid_pago,aid_informacion) values ('".$rid['idi_id']."','".$apartamentos->get_id()."','".$descripciones[$puntero_idioma]."','".$ubicacion[$puntero_idioma]."','".$tipologia[$puntero_idioma]."','".$pago[$puntero_idioma]."','".$informacion[$puntero_idioma]."')";

					mysql_query($sql, $this->conect) or die(mysql_error());

					$puntero_idioma++;

					}

				}

			//GUARDA LAS GALERIAS DE LOS APARTAMENTOS
			if($apartamentos->get_galeria())
				{
				require_once("../includes/class_imagen.inc.php");
				$image = $apartamentos->get_galeria();				
				for($i=0;$i<100;$i++)
					{
					if (is_uploaded_file($image["gene_".$i]['tmp_name'])) 
						{ 
						$this->cargarImagen($image,$i,1,$apartamentos->get_id());
						}
					if (is_uploaded_file($image["loca_".$i]['tmp_name'])) 
						{ 
						$this->cargarImagen($image,$i,2,$apartamentos->get_id());
						}
					if (is_uploaded_file($image["prec_".$i]['tmp_name'])) 
						{ 
						$this->cargarImagen($image,$i,3,$apartamentos->get_id());
						}
					if (is_uploaded_file($image["ento_".$i]['tmp_name'])) 
						{ 
						$this->cargarImagen($image,$i,4,$apartamentos->get_id());
						}
					if (is_uploaded_file($image["serv_".$i]['tmp_name'])) 
						{ 
						$this->cargarImagen($image,$i,5,$apartamentos->get_id());
						}
					}
				}
				

			if($apartamentos->get_plano())

				{

				if (is_uploaded_file($image['file_plano']['tmp_name'])) 

					{

					$extension = explode('.',$image["file_plano"]["name"]);

					$extension = strtolower('.'.array_pop($extension));

					move_uploaded_file($image["file_plano"]["tmp_name"],$path."PLANO_".$apartamentos->get_id().$extension);

					chmod($path."PLANO_".$apartamentos->get_id().$extension,0777);

					

					$sql = "update apartamentos set apa_plano='PLANO_".$apartamentos->get_id().$extension."' where apa_id='".$apartamentos->get_id()."'";

					mysql_query($sql, $this->conect) or die(mysql_error());

					}	

				}
			return true;
			}
		else
			{
			return false;
			}
		}

	
	/* CARGA LAS IMAGENES DE LA GALERIA */
	function cargarImagen($image,$i = 0,$tipo = 1,$id)
		{
		switch($tipo)
			{
			case 1:
				$tipos = "gene_";
			break;
			case 2:
				$tipos = "loca_";
			break;
			case 3:
				$tipos = "prec_";
			break;
			case 4:
				$tipos = "ento_";
			break;
			case 5:
				$tipos = "serv_";
			break;
			}
		
		$nuevo_nombre=str_replace(array(' ','á','é','í','ó','ú','ñ'),array("_",'a','e','i','o','u','n'),$id."_DTO_".strtolower($image[$tipos.$i]['name']));
		
		$sql = "INSERT INTO apartamento_galerias (apa_id,aga_imagen,aga_orden,aga_tipo) VALUES ('".$id."','".$nuevo_nombre."',9999,".$tipo.")";
		mysql_query($sql, $this->conect) or die("ERR DTO-78: ERROR AL CARGAR LAS IMAGENES");
	
		$imagen = new imagen($image[$tipos.$i]["tmp_name"], $image[$tipos.$i]["type"],0,0);
		$imagen = $imagen->tratar("460","450");
		
		file_put_contents($this->path.$nuevo_nombre, $imagen) or die("ERR CAR 79: NO SE PUDO GUARDAR EL ARCHIVO");
		chmod($this->path.$nuevo_nombre,0777);
		
		unset($imagen);
		}
		
		
	/*ELIMINAMOS UN APARTAMENTO, RECIBIMOS COMO PARAMETRO UN ID Y NO UN OBJETO*/

	function eliminar($id='',$path='../archivos/')

		{

		/*COMPROBAMOS QUE EL ID SEA MAYOR A 0, PARA PODER BORRAR UN REGISTRO*/

		if($id>0)

			{

			$sql = "select apa_plano from apartamentos where apa_id='".$id."'";

			$galeria = mysql_query($sql,$this->conect) or die('ERR DTO-132 - NO SE PUDO BORRAR EL PLANO DEL APARTAMENTO');

			while($row = mysql_fetch_array($galeria))

				{

				if($row['apa_plano'])

					{

					@unlink($path.$row['apa_plano']);

					}

				}

			

			$sql = "select aga_imagen from apartamento_galerias where apa_id='".$id."'";

			$galeria = mysql_query($sql,$this->conect) or die('ERR DTO-139 - NO SE PUDO BORRAR LA GALERIA DEL APARTAMENTO');

			while($row = mysql_fetch_array($galeria))

				{

				@unlink($path.$row['aga_imagen']);

				}

			//BORRO LOS DATOS DEL APARTAMENTO

			$sql = "delete from apartamentos where apa_id='".$id."'";

			mysql_query($sql,$this->conect) or die('ERR DTO-128 - NO SE PUDO BORRAR EL APARTAMENTO');

			$sql = "delete from apartamento_idiomas where apa_id='".$id."'";

			mysql_query($sql,$this->conect) or die('ERR DTO-128 - NO SE PUDO BORRAR EL APARTAMENTO');

			return true;

			}

		else

			{

			return false;

			}

		}

		

	//CHEQUEO QUE EL EVENTO NO SE HAYA REGISTRADO PREVIAMENTE

	function chequear($valor='',$id=0)

		{

		if (!$id)

			{

			$sql="select count(*) from apartamentos where apa_nombre='".$valor."'";

			}

		else

			{

			$sql="select count(*) from apartamentos where apa_nombre='".$valor."' and apa_id<>'".$id."'";

			}

		$result = mysql_query($sql,$this->conect) or die("ERR DTO-148: NO SE PUDO COMPROBAR EL EVENTO");

		return mysql_result($result,0);

		}

		

	/* DEVUELVE LA CONSULTA NECESARIA PARA ARMAR EL LISTADO */

	function listado($busqueda='')

		{

		$sql="SELECT apartamentos.apa_id,

apartamentos.apa_nombre,

zonas.zon_id,

zonas.zon_nombre,

paises.pai_id,

paises.pai_nombre,

apartamentos.apa_provincia,

apartamentos.apa_ciudad,

apartamentos.apa_cp,

apartamentos.apa_direccion,

apartamentos.apa_estado,

apartamentos.apa_metros,

apartamentos.apa_dormitorios,

apartamentos.apa_precio,

apa_url, 

apa_order,

apartamentos.apa_portada 

FROM paises inner join (apartamentos inner join zonas on apartamentos.zon_id=zonas.zon_id) on paises.pai_id=apartamentos.pai_id";

		

		if(is_object($busqueda))

			{

			if($busqueda->get_estado())

				{

				$estado = ($busqueda->get_estado()==2)?0:1;

				

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_estado='".$estado."'";

				}

			if($busqueda->get_nombre())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_nombre like '".$busqueda->get_nombre()."%'";

				}

			if($busqueda->get_zona())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " zonas.zon_id = '".$busqueda->get_zona()."'";

				}

			if($busqueda->get_pais())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " paises.pai_id = '".$busqueda->get_pais()."'";

				}

			if($busqueda->get_provincia())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_provincia = '".$busqueda->get_provincia()."'";

				}

			if($busqueda->get_ciudad())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_ciudad = '".$busqueda->get_ciudad()."'";

				}				

			if($busqueda->get_metros())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_metros>='".$busqueda->get_metros()."'";

				}

			if($busqueda->get_dormitorios())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_dormitorios>='".$busqueda->get_dormitorios()."'";

				}

			if($busqueda->get_id())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_id = '".$busqueda->get_id()."'";

				}

			if($busqueda->get_precio_min() && $busqueda->get_precio_max())

				{

				$sql_where .= ($sql_where)?" and":" where";

				$sql_where .= " apartamentos.apa_precio between '".$busqueda->get_precio_min()."' and '".$busqueda->get_precio_max()."'";

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

		

	//DEVUELVE UN ARRAY DE TODOS CON LOS DATOS DEL APARTAMENTO

	function cargar($id)

		{

		$sql="SELECT apartamentos.apa_id,
apartamentos.apa_nombre,
zonas.zon_id,
paises.pai_id,
apartamentos.apa_provincia,
apartamentos.apa_ciudad,
apartamentos.apa_cp,
apartamentos.apa_direccion,
apartamentos.apa_estado,
apartamentos.apa_metros,
apartamentos.apa_dormitorios,
apartamentos.apa_precio,
apartamentos.apa_plano,
apartamentos.apa_portada, 
apartamentos.apa_order
FROM paises inner join (apartamentos inner join zonas on apartamentos.zon_id=zonas.zon_id) on paises.pai_id=apartamentos.pai_id WHERE apartamentos.apa_id='".$id."'";

		$result = mysql_query($sql,$this->conect) or die("ERR DTO-249: NO SE PUDO CARGAR EL APARTAMENTO");

		if(mysql_num_rows($result)>0)

			{

			$row = mysql_fetch_array($result);

			}

			

		//IDIOMA

		$sql="SELECT * FROM apartamento_idiomas WHERE apa_id='".$id."' order by idi_id";

		$result = mysql_query($sql,$this->conect) or die("ERR DTO-269: NO SE PUDO CARGAR LAS CATEGORIAS DEL APARTAMENTO");

		while($otros = mysql_fetch_array($result))

			{

			$detalles .= ($detalles)?'<@>':'';

			$detalles .= $otros['aid_nombre']; //DONDE <@> es el simbolo de corte

			

			$ubicacion .= ($ubicacion)?'<@>':'';

			$ubicacion .= $otros['aid_ubicacion']; //DONDE <@> es el simbolo de corte

			

			$tipologia .= ($tipologia)?'<@>':'';

			$tipologia .= $otros['aid_tipologia']; //DONDE <@> es el simbolo de corte

			

			$pago .= ($pago)?'<@>':'';

			$pago .= $otros['aid_pago']; //DONDE <@> es el simbolo de corte

			

			$informacion .= ($informacion)?'<@>':'';

			$informacion .= $otros['aid_informacion']; //DONDE <@> es el simbolo de corte

			}			

		//GALERIA GENERAL
		$sql="SELECT aga_id FROM apartamento_galerias WHERE apa_id='".$id."' and aga_tipo='1'";
		$result = mysql_query($sql,$this->conect) or die("ERR DTO-277: NO SE PUDO CARGAR LAS IMAGENES DEL APARTAMENTO");
		$galeria_general = mysql_num_rows($result);
		while($otros = mysql_fetch_array($result))
			{
			$galeria_general .= '@'.$otros[0];
			}
			
		//GALERIA LOCALIZACION
		$sql="SELECT aga_id FROM apartamento_galerias WHERE apa_id='".$id."' and aga_tipo='2'";
		$result = mysql_query($sql,$this->conect) or die("ERR DTO-277: NO SE PUDO CARGAR LAS IMAGENES DEL APARTAMENTO");
		$galeria_localizacion = mysql_num_rows($result);
		while($otros = mysql_fetch_array($result))
			{
			$galeria_localizacion .= '@'.$otros[0];
			}
			
		//GALERIA PRECIO
		$sql="SELECT aga_id FROM apartamento_galerias WHERE apa_id='".$id."' and aga_tipo='3'";
		$result = mysql_query($sql,$this->conect) or die("ERR DTO-277: NO SE PUDO CARGAR LAS IMAGENES DEL APARTAMENTO");
		$galeria_precio = mysql_num_rows($result);
		while($otros = mysql_fetch_array($result))
			{
			$galeria_precio .= '@'.$otros[0];
			}
			
		//GALERIA ENTORNO
		$sql="SELECT aga_id FROM apartamento_galerias WHERE apa_id='".$id."' and aga_tipo='4'";
		$result = mysql_query($sql,$this->conect) or die("ERR DTO-277: NO SE PUDO CARGAR LAS IMAGENES DEL APARTAMENTO");
		$galeria_entorno = mysql_num_rows($result);
		while($otros = mysql_fetch_array($result))
			{
			$galeria_entorno .= '@'.$otros[0];
			}
			
		//GALERIA SERVICIOS
		$sql="SELECT aga_id FROM apartamento_galerias WHERE apa_id='".$id."' and aga_tipo='5'";
		$result = mysql_query($sql,$this->conect) or die("ERR DTO-277: NO SE PUDO CARGAR LAS IMAGENES DEL APARTAMENTO");
		$galeria_servicios = mysql_num_rows($result);
		while($otros = mysql_fetch_array($result))
			{
			$galeria_servicios .= '@'.$otros[0];
			}

		return $row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|'.$row[4].'|'.$row[5].'|'.$row[6].'|'.$row[7].'|'.$row[8].'|'.$ubicacion.'|'.$row[9].'|'.$row[10].'|'.$tipologia.'|'.$row[11].'|'.$pago.'|'.$informacion.'|'.$row[12].'|'.$row[13].'|'.$detalles."|".$galeria_general."|".$galeria_localizacion."|".$galeria_precio."|".$galeria_entorno."|".$galeria_servicios.'|'.$row[14];
		}

	}

?>