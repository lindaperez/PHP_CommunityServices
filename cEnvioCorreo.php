<?php

require "cAutorizacion.php";
require "cMensajesCorreos.php";
extract($_GET);
extract($_POST);

$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();

$modo_depuracion=FALSE;

if( !$dest OR !$asun OR !$cont ){
	$_ERRORES[] = 'Todos los campos son obligatorios';
}

if( isset($accion) AND $accion == 'envio_correo')
{
	if(empty($_ERRORES)){
            $modo_depuracion=false;

            $lines = explode('\r\n', trim($_POST[dest]));
            $lineas = count($lines);

            for ($i=0;$i<$lineas;$i++){
                if (!comprobar_email($lines[$i])) {
                    $_WARNING[] = 'No se podr&aacute; enviar el correo electr&oacute;nico al destinatario "'.$lines[$i].'". 
                                   <br/> Por favor verifique que el correo se encuentre en el formato correcto.';
                }
            }    
            
            if(empty($_WARNING)){
                for ($i=0;$i<$lineas;$i++){
                    $enviado=mail($lines[$i], 
                                  break_line($_POST[asun]), 
                                  break_line($_POST[cont]),
                                  $cabeceras);
                    if (!$enviado) $_WARNING[] = 'No se logr&oacute; enviar el correo electr&oacute;nico al destinatario"'.$lines[$i].'" ';
                }
            }
                
            if(empty($_WARNING)){
                $_SUCCESS[] = 'Se ha enviado el correo electr&oacute;nico satisfactoriamente';
            } else $_ERRORES[] = 'No se logr&oacute; enviar el correo electr&oacute;nico';
            
        } else {
            $_WARNING[] = 'No se logr&oacute; enviar el correo electr&oacute;nico';
	}
}

include('vEnvioCorreo.php');
?>