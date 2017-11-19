<?php

if(isset($_GET['source'])) { 
    highlight_file(__FILE__); 
    exit; 
} 

/**
 * Redimension de imagenes v2.0
 * @author Myokram
 * 29/09/07
 */

/**
 * Para usar esta clase:
 * Visita http://php.myokram.info/go/redimensionar-imagenes-con-php-y-gd
 *      
 */

class Redimension {
    
    var $output;
    var $source = null;
    var $url = "/";
    var $ext = "jpg";
    var $w;
    var $h;
    var $mh;
    var $mw;
    var $rh;
    var $rw;
    var $cut = 0;
    var $info = array();
    var $f1 = "imagecreatefromjpeg";
    var $f2 = "imageJpeg";
    var $type = "jpeg";
    
    function Redimension($url=null,$maxancho=null,$maxalto=null,$cut=null) {
        if($cut !== null) $this->cut = 1;
        
        //Verificamos que se haya definido un archivo válido
        $url = trim($url);
        
        if(empty($url)) {
            $this->info['basename'] = "rd_".substr(md5(rand()),0,8).".jpg";
            $this->error("No se específico la imagen");
            return;
        }

        $this->url = $url;
        
        //Extension del archivo
        $this->info = pathinfo($this->url);
        
        //Esta parte es colaboración de Kaninox
        //http://www.forosdelweb.com/f18/redimencioandor-imagenes-externa-518772/#post2205597
        $this->info['extension'] = strtolower($this->info['extension']);
        
        switch($this->info['extension']) {
            case 'jpg': $this->f1 = "imagecreatefromjpeg"; $this->f2 = "imageJpeg"; $this->type = "jpeg"; break;
            case 'gif': $this->f1 = "imagecreatefromgif"; $this->f2 = "imageGif"; $this->type = "gif"; break;
            case 'png': $this->f1 = "imagecreatefrompng"; $this->f2 = "imagePng"; $this->type = "png"; break;
            default: $this->info['basename'] = $this->info['basename'].".jpg"; $this->error("El tipo de archivo definido no es válido"); return; break;
        }
        
//        if(!file_exists($this->url)) {
//            $this->error("El archivo no existe");
//            return;
//        }
        
        //DImensiones de la imagen nueva
        $this->mw = (!is_numeric($maxancho) or $maxancho < 1) ? null : $maxancho;
        $this->mh = (!is_numeric($maxalto) or $maxalto < 1) ? null : $maxalto;
        
        //Abrimos la imagen
        $f1 = $this->f1;
        $this->source = @$f1($this->url);
        if (!$this->source) {
            $this->error("No se pudo abrir la imagen");
            return;
        } else
            $this->parseImg();
    }
    
    function parseImg() {
        //Dimensiones
        $this->w = imagesx($this->source);
        $this->h = imagesy($this->source);
        
        //DImensiones de la imagen nueva
        $this->mw = (empty($this->mw)) ? $this->w : $this->mw;
        $this->mh = (empty($this->mh)) ? $this->h : $this->mh;
        $diff_w = $this->w/$this->mw;
        $diff_h = $this->h/$this->mh;
        if($this->cut == 1) {
            $this->rh = $this->mh;
            $this->rw = $this->mw;
            if($diff_w > $diff_h) {
                $prop = $this->mh/$this->h;
                $this->mw = round($this->w*$prop);
                $dist_x = ($this->rw-$this->mw)/2;
            } else {
                $prop = $this->mw/$this->w;
                $this->mh = round($this->h*$prop);
                $dist_y = ($this->rh-$this->mh)/2;
            }
        } else {
            if($diff_w > $diff_h) {
                $prop = $this->mw/$this->w;
                $this->mh = round($this->h*$prop);
            } else {
                $prop = $this->mh/$this->h;
                $this->mw = round($this->w*$prop);
            }
            $this->rw = $this->mw;
            $this->rh = $this->mh;
        }
        $this->output = imagecreatetruecolor($this->rw, $this->rh);
        imagecopyresampled($this->output, $this->source, $dist_x, $dist_y, 0, 0, $this->mw, $this->mh, $this->w, $this->h);
    }
    
    
    function error($msg) {
        $this->output = @imagecreate (370, 170);
        $background_color = imagecolorallocate ($this->output, 230, 230, 230);
        $text_color_red = imagecolorallocate ($this->output, 255,0,0);
        $text_color_black = imagecolorallocate ($this->output, 50, 50, 50);
        imagestring ($this->output, 5, 19, 30, "ERROR: LA IMAGEN NO PUDO SER CARGADA", $text_color_red);
        imagestring ($this->output, 3, 16, 70, "Hubo un error procesando la imagen", $text_color_black); 
        imagestring ($this->output, 3, 16, 85, "RUTA: ".$this->url, $text_color_black); 
        imagestring ($this->output, 3, 16, 125,  $msg, $text_color_black); 
    }
    
    function prImg() {
        Header("Content-type: image/".$this->type);
        $f2 = $this->f2;
        $f2($this->output,null,100);
        exit;
    }
    
    function dlImg() {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$this->info['basename']."\"\n");
        $f2 = $this->f2;
        $f2($this->output);
        exit;
    }
    
}

$rd = new Redimension($_GET['file'],$_GET['ancho'],$_GET['alto'],$_GET['cut']);

if(isset($_GET['d'])) $rd->dlImg();
else $rd->prImg();

?> 