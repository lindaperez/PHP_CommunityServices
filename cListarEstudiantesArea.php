<?
session_start();
unset($_SESSION[areas]);
require "cAutorizacion.php";

$modo_depuracion=false;

$desde = $_SESSION[desde];
$hasta = $_SESSION[hasta];

$sql="CREATE OR REPLACE VIEW estudiantes_area_proyecto AS
SELECT I.id_proyecto, I.usbid_estudiante, E.carrera, P.id_area_proy
FROM inscripcion I join proyecto P on I.id_proyecto = P.id
JOIN area_proyecto AP on P.id_area_proy = AP.id 
JOIN usuario_estudiante E on E.usbid_usuario = I.usbid_estudiante 
WHERE I.fecha_inscip BETWEEN '$desde' AND '$hasta'
order by P.id_area_proy ;";

if ($modo_depuracion) echo "$sql<br>";	
$resultado=ejecutarConsulta($sql, $conexion);

$sql2="SELECT COUNT(DISTINCT usbid_estudiante) AS nro_estudiantes, id_area_proy, nombre, siglas, carrera
FROM estudiantes_area_proyecto EAP
JOIN area_proyecto AP ON EAP.id_area_proy = AP.id
GROUP BY id_area_proy, nombre, siglas, carrera ;";	

if ($modo_depuracion) echo "$sql2<br>";	
$resultado2=ejecutarConsulta($sql2, $conexion);

$i=0;

	while ($fila=obtenerResultados($resultado2)){
		
		$_SESSION[areas][nro_estudiantes][$i]=$fila[nro_estudiantes];	
		$_SESSION[areas][siglas][$i]=$fila[siglas];
		$_SESSION[areas][nombre][$i]=$fila[nombre];
		
		$sql_carrera = "SELECT nombre FROM carrera WHERE codigo = $fila[carrera];";
		$resultado_carrera=ejecutarConsulta($sql_carrera, $conexion);
		$fila_carrera=obtenerResultados($resultado_carrera);
		
		$_SESSION[areas][carrera][$i]=$fila_carrera[nombre];
		
		$i++;
	}
	
$_SESSION[max_rows]=$i;	
unset($_SESSION[desde], $_SESSION[hasta]);
cerrarConexion($conexion);
?>




