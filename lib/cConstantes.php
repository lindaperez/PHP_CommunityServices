<?
define ("MANEJADOR_BD", "mysql");
define ("NOMBRE_BD", "servicio_comunitario");
require_once "cFunciones.php";
session_start();
// Conectar con la base de datos
if (MANEJADOR_BD == "mysql")
	$conexion = crearConexion('localhost', 'root', '');

if (MANEJADOR_BD == "postgres")
	$conexion = crearConexion('localhost', 'postgres', 'postgres');
	
	
?>