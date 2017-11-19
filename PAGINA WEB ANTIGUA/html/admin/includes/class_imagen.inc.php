<?php
/*
	la clase imagen, se encarga del tratamiento de las imagenes (cambio de resolucion, filtrado, thumb)
	para usar esta clase se debe llamasar definiendo los atributos "contenido","tipo"
	donde contenido es binario, tipo es el tipo mime de contenido ademas "mem" indica "si es 1" que es un string de base de datos y "alwaysJpg" indica si siempre se tiene que guardar en Jpeg
	ejemplo de como llamarla "new imagen($contenido,$tipo[,$mem,$alwaysJpg]);"
	los metodos que posee son:
							"tratar" que modifica la resolucion de la imagen y filtra la misma
							requiere los atributos "ancho final","alto final" donde  ancho y alto 
							definen la resolucion final de la imagen y devuelve la imagen modificada
							ej: "$full = $obj->tratar("120","80");"
	
	Version 1.0.1.5
*/

class imagen{
var $contenido;
var $tipo;
var $ancho;
var $alto;
var $mem;
var $alwaysJpg;
var $error;

function imagen($contenido,$tipo,$mem=0,$alwaysJpg = 1)
	{
	// contructor de la clase
	if($contenido && $tipo)
		{
		$this->contenido = $contenido;
		$this->tipo = $tipo;
		$this->error = "";
		}
	if($mem!="" && $mem!=0)
		{
		$this->mem = 1;
		}
	if($alwaysJpg!="" && $alwaysJpg!=0)
		{
		$this->alwaysJpg = 1;
		}		
	}

function tratar($ancho="0",$alto="0",$nombre_archivo="")
	{
	if($ancho=="0" && $alto=="0")
		{
		$this->error .= "El tamaño indicado es incorrecto";
		return false;
		}
	else
		{
		if ($ancho != "") $this->ancho = $ancho;
		if ($alto != "") $this->alto = $alto;
		// lista los tipo de mime que se pueden tratar
		$mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/bmp");
		//compara el tipo de la imagen con los tipo mimes
		if(!in_array($this->tipo, $mimetypes))
			{
			$this->error .= "El Archivo no es una imagen o se encuentra dañado";
			return false;
			}
		else
			{
			//crea la imagen en ram para el tipo de mimes determinado
			if($this->mem!=1)
				{
				switch($this->tipo)
					{
					case $mimetypes[0]:
					$orig_image = imagecreatefromjpeg($this->contenido);
					break;
					case $mimetypes[1]:
					$orig_image = imagecreatefromjpeg($this->contenido);
					break;
					case $mimetypes[2]:
					$orig_image = imagecreatefromgif($this->contenido);
					break;
					case $mimetypes[3]:
					$orig_image = imagecreatefrompng($this->contenido);
					break;
					case $mimetypes[4]:
					$orig_image = $this->imagecreatefrombmp($this->contenido);
					break;				
					}
				list($width, $height, $type, $attr) = getimagesize($this->contenido);
				}
			else
				{
				$orig_image = imagecreatefromstring($this->contenido);
				$width = imagesx($orig_image);
				$height = imagesy($orig_image);
				}
			// modifica los atributos de la imagen
			if($this->ancho!="0" && $this->alto!="0")
				{
				if ($width > $height)
					{
					$ratio = $this->ancho / $width;
					$height = @round($ratio*$height);
					$width = $this->ancho;
					}
				else
					{
					$ratio = $this->alto / $height;
					$width = @round($ratio*$width);
					$height = $this->alto;
					}
				}
			else
				{
				if ($this->alto=="0")
					{
					$ratio = $this->ancho / $width;
					$height = @round($ratio*$height);
					$width = $this->ancho;
					$this->alto = $height;
					}
				else
					{
					$ratio = $this->alto / $height;
					$width = @round($ratio*$width);
					$height = $this->alto;
					$this->ancho = $width;
					}
				}
			//crea la nueva imagen con los nuevos atributos en ram
			@$sm_image = imagecreatetruecolor($this->ancho,$this->alto);
			//@$sm_color = imagecolorallocate($sm_image, 255, 255, 255); //blanco
			@$sm_color = imagecolorallocate($sm_image, 0, 0, 0);
			@imagefill($sm_image,0,0,$sm_color);
			if($this->mem!=1)
				{
				if($this->ancho!=$width)
					{
					$destx = ($this->ancho-$width)/2;
					}
				if($this->alto!=$height)
					{
					$desty = ($this->alto-$height)/2;
					}
				imagecopyresampled($sm_image,$orig_image,$destx,$desty,0,0,$width,$height,imagesx($orig_image),imagesy($orig_image));							
				}
			else
				{
				imagecopyresized($sm_image,$orig_image,0,0,0,0,$width,$height,imagesx($orig_image),imagesy($orig_image));
				}
			// crea la imagen fiinal en un temporal
			if(!$nombre_archivo)
				{
				ob_start();
				if($this->alwaysJpg)
					{
					imagejpeg($sm_image);
					}
				else
					{
					switch($this->tipo)
						{
						case $mimetypes[0]:
						case $mimetypes[1]:		
							imagejpeg($sm_image, NULL, 100);
						break;
						case $mimetypes[2]:
							imagegif($sm_image);
						break;
						case $mimetypes[3]:
							imagepng($sm_image);
						break;
						case $mimetypes[4]:
							imagejpeg($sm_image, NULL, 100);
						break;
						}
					}
				$full = ob_get_contents();
				ob_end_clean();
				return $full;			
				}
			else
				{
				if($this->alwaysJpg)
					{
					imagejpeg($sm_image, $nombre_archivo, 100);
					}
				else
					{
					switch($this->tipo){
						case $mimetypes[0]:
						case $mimetypes[1]:		
							imagejpeg($sm_image, $nombre_archivo, 100);
						break;
						case $mimetypes[2]:
							imagegif($sm_image, $nombre_archivo);
						break;
						case $mimetypes[3]:
							imagepng($sm_image, $nombre_archivo);
						break;
						case $mimetypes[4]:
							imagejpeg($sm_image, $nombre_archivo, 100);
						break;
						}
					}
				}
			//vacia los temporales y devuelve la imagen final a procesar
			imagedestroy($sm_image);
			imagedestroy($orig_image);
			}
		}
	}
	
//CONVIERTE LAS IMAGENES A IMAGEN JPG SIN REDIMENSIONAMIENTO O COMPRESION ALGUNA
function convertirJPG($nombre_archivo="")
	{
	// lista los tipo de mime que se pueden tratar
	$mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/bmp");
	//compara el tipo de la imagen con los tipo mimes
	if(!in_array($this->tipo, $mimetypes))
		{
		$this->error .= "El Archivo no es una imagen o se encuentra dañado";
		return false;
		}
	else
		{
		//crea la imagen en ram para el tipo de mimes determinado
		if($this->mem!=1)
			{
			switch($this->tipo)
				{
				case $mimetypes[0]:
				$orig_image = imagecreatefromjpeg($this->contenido);
				break;
				case $mimetypes[1]:
				$orig_image = imagecreatefromjpeg($this->contenido);
				break;
				case $mimetypes[2]:
				$orig_image = imagecreatefromgif($this->contenido);
				break;
				case $mimetypes[3]:
				$orig_image = imagecreatefrompng($this->contenido);
				break;
				case $mimetypes[4]:
				$orig_image = $this->imagecreatefrombmp($this->contenido);
				break;				
				}
			}
		else
			{
			$orig_image = imagecreatefromstring($this->contenido);
			}
			
		// crea la imagen fiinal en un temporal
		if(!$nombre_archivo)
			{
			ob_start();
			imagejpeg($orig_image, NULL, 100);
			$full = ob_get_contents();
			ob_end_clean();
			return $full;	
			}
		else
			{
			imagejpeg($orig_image, $nombre_archivo, 100);
			}
		//vacia los temporales y devuelve la imagen final a procesar
		imagedestroy($orig_image);
		}
	}

function imagecreatefrombmp( $filename )
	{
	if (! $f1 = fopen($filename,"rb")) return FALSE;
	$FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
	if ($FILE['file_type'] != 19778) return FALSE;
	$BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
				 '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
				 '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
	$BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
	if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
	$BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
	$BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
	$BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
	$BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
	$BMP['decal'] = 4-(4*$BMP['decal']);
	if ($BMP['decal'] == 4) $BMP['decal'] = 0;
	$PALETTE = array();
	if ($BMP['colors'] < 16777216)
		{
		$PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
		}
	$IMG = fread($f1,$BMP['size_bitmap']);
	$VIDE = chr(0);
	$res = imagecreatetruecolor($BMP['width'],$BMP['height']);
	$P = 0;
	$Y = $BMP['height']-1;
	while ($Y >= 0)
		{
		$X=0;
		while ($X < $BMP['width'])
			{
			if ($BMP['bits_per_pixel'] == 24)
				$COLOR = unpack("V",substr($IMG,$P,3).$VIDE);
			elseif ($BMP['bits_per_pixel'] == 16)
				{ 
				$COLOR = unpack("v",substr($IMG,$P,2));
				$blue  = ($COLOR[1] & 0x001f) << 3;
				$green = ($COLOR[1] & 0x07e0) >> 3;
				$red   = ($COLOR[1] & 0xf800) >> 8;
				$COLOR[1] = $red * 65536 + $green * 256 + $blue;
				}
			elseif ($BMP['bits_per_pixel'] == 8)
				{ 
				$COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
				}
			elseif ($BMP['bits_per_pixel'] == 4)
				{
				$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
				if (($P*2)%2 == 0) $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
				}
			elseif ($BMP['bits_per_pixel'] == 1)
				{
				$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
				if     (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;
				elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;
				elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;
				elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;
				elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8)>>3;
				elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4)>>2;
				elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2)>>1;
				elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
				}
			else
				return FALSE;
			imagesetpixel($res,$X,$Y,$COLOR[1]);
			$X++;
			$P += $BMP['bytes_per_pixel'];
			}
		$Y--;
		$P+=$BMP['decal'];
		}
	fclose($f1);
	return $res;
	}
}
?>