<?
require "cAutorizacion.php";
if (!isEmpleadoCCTDS()){
	echo "<center>Usted no est&aacute; autorizado para ver esta p&aacute;gina</center>";
	exit();
}
$LISTA_INSCRIPCIONES=array();
//$LISTA_INSCRIPCIONES=$_SESSION[inscripcion];

$modo_depuracion=FALSE;

unset($_SESSION[inscripcion]);

$sql1 = "SELECT u.password, u.usbid FROM usuario u, rol_sistema r ".
$sql1.= "WHERE r.sede='$_SESSION[sede]' AND r.rol='coordinador' ";
$sql1.= "AND u.usbid=r.usbid ";
$resultado1=ejecutarConsulta($sql1, $conexion);
$fila1=obtenerResultados($resultado1);
$password=$fila1[password];

	$sql ="SELECT p.codigo, i.id id_inscrip, i.*, p.id, u.nombre, u.apellido, u.usbid usbid, e.carrera, ".
	$sql.="t.nombre nombreT, t.apellido apellidoT, i.culminacion_validada ";
	$sql.="FROM proyecto p, inscripcion i, usuario u, usuario_estudiante e, usuario t ";
	$sql.="WHERE  i.id_proyecto=p.id AND i.usbid_estudiante=u.usbid ";
        if ($_SESSION[sede]=='Litoral') {
          $sql  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
		. " Length(e.usbid_usuario)=7)) ";
            } else
            if ($_SESSION[sede]=='Sartenejas') {
          $sql  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
                . " Length(e.usbid_usuario)=8)) ";
            }
	if ($_GET['opcion']=="validar_culminacion"){
		$sql.=" AND i.aprobado='SI' AND culminacion_validada<>'SI' AND fecha_fin_real<>'0000-00-00' ";
	}else{
		$sql.=" AND i.aprobado<>'SI' ";
	}
	$sql.="AND i.usbid_estudiante=e.usbid_usuario AND i.tutor=t.usbid ";
	$sql.="ORDER BY p.codigo";
	
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$i=0;
		while ($fila=obtenerResultados($resultado)){
			$_SESSION[inscripcion][id][$i]=$fila[id_inscrip];
			$_SESSION[inscripcion][periodo][$i]=$fila[periodo];
			$_SESSION[inscripcion][anio][$i]=$fila[anio];
			$_SESSION[inscripcion][aprobado][$i]=$fila[aprobado];
			$_SESSION[inscripcion][codigo][$i]=$fila[codigo];
			$_SESSION[inscripcion][nombre][$i]=$fila[nombre];		
			$_SESSION[inscripcion][apellido][$i]=$fila[apellido];	
			$_SESSION[inscripcion][usbid][$i]=$fila[usbid];
			$_SESSION[inscripcion][carrera][$i]=$fila[carrera];		
			$_SESSION[inscripcion][nombreT][$i]=$fila[nombreT];
			$_SESSION[inscripcion][apellidoT][$i]=$fila[apellidoT];	
			$_SESSION[inscripcion][culminacion_validada][$i]=$fila[culminacion_validada];	
			$i++;	
                        $LISTA_INSCRIPCIONES= array_merge($LISTA_INSCRIPCIONES,array ($fila));
                        
                }
		$_SESSION[max_inscrip]=$i;
                
	}
        
cerrarConexion($conexion);
?>



