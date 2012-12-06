<?
require "cAutorizacion.php";
if (!isset($_GET[id])){
	echo "Codigo de proyecto errado";
	exit();
} 
$modo_depuracion=false;
	
$sql ="SELECT py.*, u.nombre, u.apellido, u.usbid, a.nombre area, a.siglas siglas ";
$sql.="FROM proyecto py, proponente p, usuario u, area_proyecto a ";
$sql.="WHERE py.id_area_proy=a.id AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";
$sql.="AND py.id='$_GET[id]' ";


if ($modo_depuracion) echo "$sql<br>";

$resultado=ejecutarConsulta($sql, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[proyecto][id]=$fila[id];
$_SESSION[proyecto][codigo]=$fila[codigo];
$_SESSION[proyecto][titulo]=$fila[titulo];
$_SESSION[proyecto][nombre]=$fila[nombre];
$_SESSION[proyecto][apellido]=$fila[apellido];
$_SESSION[proyecto][usbid]=$fila[usbid];
$_SESSION[proyecto][area]=$fila[area];
$_SESSION[proyecto][siglas]=$fila[siglas];

$anio=date('y');
$sql ="SELECT max(substring(codigo,6,2)) cod ";
$sql.="FROM proyecto ";
$sql.="WHERE codigo like '%$fila[siglas]-$anio%' ";
//echo $sql; exit();
$resultado=ejecutarConsulta($sql, $conexion);
$num=numResultados($resultado);
if ($num==0){
	$_SESSION[proyecto][codigo_nuevo]=$anio."01";	
}else{
	$fila=obtenerResultados($resultado);	
	$codigo_nuevo=$fila[cod]+1;
	if ($codigo_nuevo<10) $codigo_nuevo="0".$codigo_nuevo;
	$_SESSION[proyecto][codigo_nuevo]=$anio.$codigo_nuevo;	
}



?>
