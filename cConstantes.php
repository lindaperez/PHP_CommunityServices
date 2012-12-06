<?php
/*
// DEBUG
$_SESSION = array_merge($_SESSION, array
(
    'phpCAS' => array
        (
            'user' => 'coord-psc'
        ),
    'usuario_validado' => 1,
    'USBID' => 'coord-psc',
    'nombres' => 'Coordinacion Cooperacion',
    'apellidos' => 'Tecnica y',
    'cedula' => '6917611',
    'carrera' => '',
    'carnet' => '',
    'tipo' => 'administrativos',
    'cohorte' => 'coord'
));
*/
error_reporting(E_ERROR);

define ("MANEJADOR_BD", "mysql");
define ("NOMBRE_BD", "servicio_comunitario");
// define ("NOMBRE_BD", "treswdco_pruebas");
	   
require_once "cFunciones.php";
session_start();

// Conectar con la base de datos
if (MANEJADOR_BD == "mysql") {
	$conexion = crearConexion('localhost', 'cctds', 'cctds');
	// $conexion = crearConexion('localhost', 'treswdco_cctds', 'cctds');
}

if (MANEJADOR_BD == "postgres")	{
	$conexion = crearConexion('localhost', 'postgres', 'postgres');
}

/*
 * Evitamos SQL Injection en datos entrantes!
 */
foreach($_POST as $key => $value)
	$_POST[$key] = escaparString($value);

foreach($_GET  as $key => $value)
	$_GET[$key] = escaparString($value);
