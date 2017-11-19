<?php
class usuario 
	{
	public $conect;
	private $usuario;
	private $clave;
	function __construct($conect=null)
		{
		$this->conect = $conect;
		}
	/*SETEA LA VARIABLE USUARIO*/
	function set_usuario($usuario=0)
		{
		$this->usuario = $usuario;
		}
	/*DEVUELVE EL VALOR DE LA VARIABLE USUARIO*/
	function get_usuario($usuario=0)
		{
		return $this->usuario;
		}
		
	/*SETEA LA VARIABLE CLAVE*/
	function set_clave($clave=0)
		{
		$this->clave = $clave;
		}
	/*DEVUELVE EL VALOR DE LA VARIABLE CLAVE*/
	function get_clave($clave=0)
		{
		return $this->clave;
		}
	
	/*CARGAMOS EN SESION AL USUARIO QUE SE ESTA LOGUEANDO*/
	function login($usuario,$clave)
		{
		$sql = "select usu_id,usu_nombre,usu_clave from usuarios where usu_nombre='".$usuario."' and usu_clave='".$clave."'";
		$consulta = mysql_query($sql,$this->conect) or die ('ERR USU-37 - NO SE PUDO COMPROBAR EL USUARIO');
		$total = mysql_num_rows($consulta);
		if($total>0)
			{
			$row = mysql_fetch_assoc($consulta);
			$usu=$row['usu_nombre'];
			$cla=$row['usu_clave'];
			if (($usuario == $usu) & ($clave==$cla))
				{
				$_SESSION['USU_ID']=$row['usu_id'];
				$_SESSION['USU_CLAVE']=$cla;
				$_SESSION['USU_NOMBRE']=$usu;
				return true;
				}
			else
				{
				return false;
				}
			}
		else
			{
			return false;
			}
		}
	/*DESLOGUEA AL USUARIO*/
	function logout()
		{
		unset($_SESSION['USU_ID'],$_SESSION['USU_CLAVE'],$_SESSION['USU_NOMBRE']);
		}
		
	/*MODIFICA LA CLAVE DEL USUARIO */
	function cambiar_clave($id=0,$clave='')
		{
		if($id)
			{
			$sql = "update usuarios set usu_clave='".$clave."' where usu_id='".$id."'";
			$consulta = mysql_query($sql,$this->conect) or die('ERR USU-68 - NO SE PUDO ACTUALIZAR LA CLAVE');
			$_SESSION['USU_CLAVE']=$clave;
			return true;
			}
		}
	}
?>