<?
require "cAutorizacion.php";
$modo_depuracion=false;

$TIPOS = array(
	'PUNTUAL' => 'CONTINUO',
	'CONTINUO' => 'PUNTUAL'
);

$sql="SELECT * FROM evaluacion WHERE id='$_GET[id]'";
$resultado = ejecutarConsulta($sql, $conexion);
$row = obtenerResultados($resultado);

if(!empty($row)){
	// Cambiamos el tipo
	$tipo = $TIPOS[$row['tipo']];

	$sql_temp="UPDATE evaluacion SET tipo='$tipo' WHERE id='$_GET[id]'";

	if ($modo_depuracion) echo "$sql_temp<br>";
	$resultado=ejecutarConsulta($sql_temp, $conexion);
}

cerrarConexion($conexion);
if ($modo_depuracion) exit(); 
	?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El tipo de Proyecto ha sido cambiado satisfactoriamente.', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
        </script>	
    </body>