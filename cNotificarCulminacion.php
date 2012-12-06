<?
require "cAutorizacion.php";
$id=$_GET[id]; //id inscripcion
	$modo_depuracion=false;
	//Se buscan los datos del proyecto
	$sql ="SELECT p.titulo, p.codigo ";
	$sql.="FROM proyecto p, inscripcion i ";
	$sql.="WHERE  i.id='$id' AND i.id_proyecto=p.id";
	
	if ($modo_depuracion) echo "$sql<br>";

	$resultado=ejecutarConsulta($sql, $conexion);
	$fila=obtenerResultados($resultado);
	$_SESSION[proyecto][codigo]=$fila[codigo];
	$_SESSION[proyecto][titulo]=$fila[titulo];
	
        
$sql2=	"SELECT i.id id, p.id id_proyecto, i.fecha_fin_real fecha_culminacion ".
	"FROM inscripcion i, proyecto p WHERE usbid_estudiante='$_SESSION[USBID]' ".
	"AND i.id_proyecto=p.id AND i.id='$id'";
        $resultado2=ejecutarConsulta($sql2, $conexion);
        $fila2=obtenerResultados($resultado2);
        $_SESSION[fecha_culminado]= $fila2[fecha_culminacion];
        
        
	cerrarConexion($conexion);
?>




