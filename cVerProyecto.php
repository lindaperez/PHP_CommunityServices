<?
require_once "cConstantes.php";

$modo_depuracion=FALSE;
//se buscan los datos del proyecto
$sql_temp="SELECT * FROM proyecto WHERE id='$_GET[id]'";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[proyecto]=$fila;

//se buscan los datos de los beneficiados del proyecto
$sql_temp="SELECT * FROM beneficiados WHERE id_proyecto='$_GET[id]'";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[beneficiados]=$fila;

//se buscan los datos del proponente
$sql_temp=	"SELECT u.* FROM proponente p, usuario u ".
			"WHERE p.id_proyecto='$_GET[id]' and p.usbid_usuario=u.usbid";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[proponente]=$fila;

//se buscan los datos de la comunidad
$sql_temp=	"SELECT c.* FROM comunidad c, proyecto p ".
			"WHERE p.id='$_GET[id]' and p.id_comunidad=c.id";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[comunidad]=$fila;

//se buscan los datos del area
$sql_temp=	"SELECT a.* FROM area_proyecto a, proyecto p ".
			"WHERE p.id='$_GET[id]' and p.id_area_proy=a.id";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[area]=$fila;

//se buscan los datos de los tutores
$sql_temp=	"SELECT u.* FROM usuario u, tutor_proy tp ".
			"WHERE tp.id_proyecto='$_GET[id]' and tp.usbid_miembro=u.usbid ";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$i=0;
while($fila=obtenerResultados($resultado)){
	$_SESSION[tutor][$i]=$fila;
	$i++;
}
$_SESSION[maxtutor]=$i;

//se buscan los datos del representante de la comunidad
$sql_temp=	"SELECT r.* FROM representante r, proyecto p ".
			"WHERE p.id='$_GET[id]' and p.id_representante=r.id";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[representante]=$fila;

//se buscan los datos del representante de la organizacion
$sql_temp=	"SELECT o.* FROM organizacion o, proyecto p ".
			"WHERE p.id='$_GET[id]' and p.id_organizacion=o.id";
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$_SESSION[organizacion]=$fila;

cerrarConexion($conexion);

?>
