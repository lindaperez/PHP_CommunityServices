<?
require "cAutorizacion.php";
$modo_depuracion=false;
	
	$sql =	"SELECT * FROM bono ORDER BY id DESC LIMIT 0, 1";
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$i=0;
		$fila=obtenerResultados($resultado);
		$_SESSION[bono][monto]=$fila[monto];
	}
cerrarConexion($conexion);
?>



