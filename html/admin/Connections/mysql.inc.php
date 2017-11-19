<?php
class mysql
	{
	private $utf8;
	private $server;
	private $usr;
	private $pwd;
	public $conect;
	
	function __construct($server="localhost",$usr="root",$pwd="")
		{
		$this->server = $server;
		$this->usr = $usr;
		$this->pwd = $pwd;
		}
	
	function set_conect($db)
		{
		$this->conect=mysql_connect($this->server,$this->usr,$this->pwd);
		if($this->utf8)
			{
			//esto otro es por si no acepta el charset
			mysql_query("SET NAMES 'utf8'",$this->conect);
			mysql_query("SET CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci'",$this->conect); 
			}
		mysql_select_db($db);
		return $this->conect;
		}

	function is_utf8()
		{
		$this->utf8 = true;
		}
		
	function is_ansi()
		{
		$this->utf8 = false;
		}
		
	function get_conect()
		{
		if(!$this->conect)
			{
			return $this->set_conect();
			}
		else
			{
			return $this->conect;
			}
		}
	}
?>