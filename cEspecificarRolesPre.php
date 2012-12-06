<?php
require_once "cAutorizacion.php";

    //se buscan las solicitudes de sartenejas
    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='coordinador' AND sede='Sartenejas' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[coordinador] = $fila;

    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='asistente' AND sede='Sartenejas' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[asistente] = $fila;

    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='secretaria' AND sede='Sartenejas' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[secretaria] = $fila;
    
    //se buscan las solicitudes del litoral
    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='coordinador' AND sede='Litoral' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[coordinador_lit] = $fila;

    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='asistente' AND sede='Litoral' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[asistente_lit] = $fila;

    $sql_temp = "SELECT * FROM rol_sistema WHERE rol='secretaria' AND sede='Litoral' ";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    $fila = obtenerResultados($resultado);
    $_SESSION[secretaria_lit] = $fila;

cerrarConexion($conexion);

?>
