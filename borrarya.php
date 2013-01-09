<?

require_once "cConstantes.php";
$sql="SELECT pe.usbid_usuario usuario, pe.carrera carrerape, se.carrera carrerase FROM pasantiasNuevo.`usuario_estudiante` pe, servicio_comunitario.usuario_estudiante se WHERE se.usbid_usuario=pe.usbid_usuario ORDER BY `se`.`carrera` ASC";

$resultado=ejecutarConsulta($sql, $conexion);
$i=1;
while($fila=obtenerResultados($resultado)) {

	if ($fila[carrerase]==""){
		$sql2="UPDATE servicio_comunitario.usuario_estudiante u SET carrera='$fila[carrerape]' WHERE u.usbid_usuario='$fila[usuario]'; ";
		echo $sql2."<br>";
		$i++;
	}
}
?>



