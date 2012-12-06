<?php

require_once "cAutorizacion.php";

$modo_depuracion = false;
//Se buscan los datos de los eventos
    $sql_temp = "SELECT * FROM evento";
    $resultado = ejecutarConsulta($sql_temp, $conexion);
    while ($row = obtenerResultados($resultado))
        $LISTA_EVENTOS[] = $row;

    if ($modo_depuracion)
        echo "$sql_temp<br><br>";


cerrarConexion($conexion);
?>
