<?php
require "cAutorizacion.php";


extract($_GET);
extract($_POST);

// Modificamos los datos del proyecto
$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();


$modo_depuracion=FALSE;
    
if( isset($accion) AND $accion == 'agregar_representante')
{
    //Validacion de representante
    $datos_representante_vacio=true;
    $datos_representante_completo=true;
    $DATOS_REPRESENTANTE = array('rep_apellidos','rep_nombres','rep_ci',
                                 'rep_cel','rep_tlf','rep_inst','rep_dir',
                                 'rep_cargo','rep_email');
    
    foreach($DATOS_REPRESENTANTE as $value){
        if( empty( $$value ) )
            $datos_representante_completo=false;
    }
    if (!$datos_representante_completo)
        $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del representante.';
    else {
        if (!is_numeric($rep_ci))
            $_ERRORES[] = 'Error de formato con la c&eacute;dula del representante.';
        if (!comprobar_telefono($rep_tlf))
            $_ERRORES[] = 'Error de formato con el tel&eacute;fono del representante.';
        if (!comprobar_telefono($rep_cel))
            $_ERRORES[] = 'Error de formato con el celular del representante.';
        if (!comprobar_email($rep_email))
            $_ERRORES[] = 'Error de formato con el email del representante.';
        }
                
        if(empty($_ERRORES)){
            $sql_hey="SELECT * FROM representante WHERE email LIKE '%".replace_form($_POST[rep_email])."%'";
            $resultado=ejecutarConsulta($sql_hey, $conexion);
            $fila=obtenerResultados($resultado);
            if (!empty($fila)){
                $rep_email=replace_form($_POST[rep_email]);

                $_WARNING[] = 'El representante "'.replace_form($_POST[rep_nombres]). " ".replace_form($_POST[rep_apellidos]).'" ya se encontraba registrado
                            con el correo "'.replace_form($_POST[rep_email]).'@usb.ve".';
            } else {
            //Se debe insertar primero el representante y luego obtener el id
            $sql_temp="INSERT INTO representante VALUES (".
            "0, ".//id
            "trim('".replace_form($_POST[rep_apellidos])."'), ".//apellidos
            "trim('".replace_form($_POST[rep_nombres])."'), ".//nombres
            "trim('".replace_form($_POST[rep_inst])."'), ".//institucion
            "trim('".replace_form($_POST[rep_cargo])."'), ".//cargo	
            "trim('".replace_form($_POST[rep_dir])."'), ".//direccion
            "trim('".replace_form($_POST[rep_email])."'), ".//email	
            "trim('".replace_form($_POST[rep_tlf])."'), ".//telefono
            "trim('".replace_form($_POST[rep_ci])."'), ".//cedula	
            "trim('".replace_form($_POST[rep_cel])."') ".//celular		
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);

            $sql_temp="SELECT max(id) as id FROM representante";
            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $fila=obtenerResultados($resultado);
            
            $_SUCCESS[] = 'Se ha agregado el proyecto satisfactoriamente';
            }
        }
}

include('vAgregarRepresentante.php');

cerrarConexion($conexion);
?>
