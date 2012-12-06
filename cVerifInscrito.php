<?php
$sql2=	"SELECT i.id id, p.id id_proyecto, codigo, fecha_fin_real, i.aprobado aprobado, i.culminacion_validada culminacion, i.horas_acumuladas horas, i.observaciones obs ".
	"FROM inscripcion i, proyecto p WHERE usbid_estudiante='$_SESSION[USBID]' AND i.observaciones!='Retirado por el sistema'  ".
	"AND i.id_proyecto=p.id ORDER BY i.id";
$resultado2=ejecutarConsulta($sql2, $conexion);
if (numResultados($resultado2)>0){
	$i=0;

	$_SESSION[id_inscripcion]=array();
	$_SESSION[id_proyecto]=array();
	$_SESSION[cod_proyecto_culminado]=array();
	$_SESSION[cod_proyecto]=array();
	$_SESSION[proy_aprobado]=array();
	$_SESSION[alerta_culminado]=array();
	$_SESSION[horas]=0;
	$_SESSION[obs]=array();;
        $_SESSION[inscrito]=false;

	while($fila2=obtenerResultados($resultado2)){
		array_push($_SESSION[id_inscripcion], $fila2[id]);
		array_push($_SESSION[id_proyecto], $fila2[id_proyecto]);
		array_push($_SESSION[cod_proyecto], $fila2[codigo]);
		array_push($_SESSION[proy_aprobado], $fila2[aprobado]);
		array_push($_SESSION[alerta_culminado], $fila2[culminacion]);
		array_push($_SESSION[obs], $fila2[obs]);
		
		//cuando la culminacion está validada el alumno ya no está isncrito en ese proyecto
		if ($_SESSION[alerta_culminado][$i]!="SI") 
                    $_SESSION[inscrito]=true;

		if ($modo_depuracion) echo "fecha fin =$fila2[fecha_fin_real]";
		if ($fila2[fecha_fin_real]<>"0000-00-00"){
			array_push($_SESSION[cod_proyecto_culminado], $fila2[codigo]);
		}

		$_SESSION[horas]+=$fila2[horas];
	$i++;
	} if ($modo_depuracion) exit();
}else{
	$_SESSION[inscrito]=false;
}

?>
