<?
require "cAutorizacion.php";
$modo_depuracion=false;

$sql_temp="UPDATE proyecto SET culminado='$_GET[culminado]' WHERE id='$_GET[id]'"; 

if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);



cerrarConexion($conexion);
if ($modo_depuracion) exit(); 
	?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El status del Proyecto ha sido cambiado satisfactoriamente.', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
        </script>	
    </body>
