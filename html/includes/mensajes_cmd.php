<?php
require_once('admin/includes/globales.php');

require_once("includes/mailer/class.phpmailer.php");
$mail = new phpmailer();
$mail->PluginDir = "";
$mail->Mailer = "smtp";
$mail->Host = $host;
$mail->Port = $port;
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->Username = $username;
$mail->Password = $password;
$mail->From = $from;
$mail->FromName = $empresa;
$mail->Timeout=25;
$mail->Subject = $mensaje;
$mail->AddAddress($email);
$mail->IsHTML(true);
$mail->Body = $head_mail.$cuerpo.$pie_mail;
$mail->Send();
?>
