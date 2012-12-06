<?php

$messages = array();
$messages_alerta = array();
$num_messages = 0;

//Indices de los mensajes por tipo de usuario
$messages_estud = array();

    if (!periodoTrimestre('NOW()',$conexion)){
        $messages_error[] = "Aviso: Debe cambiar las fechas para el trimestre en curso.";
    }
    $error=false;
    $sql = "SELECT * FROM evento ";
    if ($modo_depuracion) echo "$sql<br>";
    else{
            $resultado=ejecutarConsulta($sql, $conexion);
            $i=0;
            while ($fila=obtenerResultados($resultado)){
                if (!validoEnTrimestre($fila[fecha_inicio],$conexion) || !validoEnTrimestre($fila[fecha_fin],$conexion))
                        $error=true;
            }
    }
    if ($error){
        $messages_error[] = "Aviso: Existe una fecha que no corresponde con el rango del trimestre en curso.";
    }
    
    $sql1 ="SELECT COUNT(*) aprobar ".
    $sql1.="FROM proyecto py ";
    $sql1.="WHERE (py.codigo='' OR py.aprobado<>'SI') AND py.status_proy='POSTULADO' ";
    
    if ($modo_depuracion) echo "$sql1<br>";
    else{
        $resultado=ejecutarConsulta($sql1, $conexion);
        $fila=obtenerResultados($resultado);
        $por_aprobar=$fila[aprobar];
    }
    
    $sql2 ="SELECT COUNT(*) evaluar ".
    $sql2.="FROM inscripcion ";
    $sql2.="WHERE aprobado<>'SI' ";
    
    if ($modo_depuracion) echo "$sql2<br>";
    else{
        $resultado=ejecutarConsulta($sql2, $conexion);
        $fila=obtenerResultados($resultado);
        $por_evaluar=$fila[evaluar];
    }
    
    $sql3 ="SELECT COUNT(*) certificar ".
    $sql3.="FROM inscripcion ";
    $sql3.="WHERE  aprobado='SI' AND culminacion_validada<>'SI' ";
    
    if ($modo_depuracion) echo "$sql3<br>";
    else{
        $resultado=ejecutarConsulta($sql3, $conexion);
        $fila=obtenerResultados($resultado);
        $por_certificar=$fila[certificar];
    }
        
    if ($por_aprobar>0){
        $messages[] = "Quedan ".$por_aprobar." proyectos por evaluar.";
    }
    if ($por_evaluar>0){
        $messages[] = "Quedan ".$por_evaluar." inscripciones por evaluar.";
    }    
    if ($por_certificar>0){
        $messages[] = "Quedan ".$por_certificar." certificaciones por evaluar.";
    }    
	$messages_alerta[] = "Su inscripci&oacute;n a&uacute;n no ha sido aprobada. Recuerde consignar los recaudos ante la CCTDS.";
	$messages_alerta[] = "Consignar los siguientes recaudos: <br>  - Planilla de inscripci&oacuten en original y copia. <br>  - Avance acad&eacute;mico actualizado.";
	$messages_alerta[] = "Su proyecto est&aacute; apunto de culminar. ";
?>
