<?
require "cAutorizacion.php";
$modo_depuracion=false;

if ($_GET[id]=="all"){

        //proponentes sin proyectos asociados
        $sql ="SELECT prop.id_proyecto, u.nombre nombre, u.apellido apellido ";
        $sql.="FROM proponente prop ";
        $sql.="LEFT JOIN proyecto p ON prop.id_proyecto=p.id ";
        $sql.="LEFT JOIN usuario u ON prop.usbid_usuario=u.usbid ";
        $sql.="WHERE  p.id IS NULL ";

        if ($modo_depuracion) {
                echo "$sql<br>";
                exit();
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                while ($fila=obtenerResultados($resultado)){
                        $sql2="DELETE FROM proponente WHERE id_proyecto='$fila[id_proyecto]'";
                        if ($modo_depuracion) echo "$sql2<br>";
                        else $resultado2=ejecutarConsulta($sql2, $conexion);
                }
        }

}else{

        $sql_temp="DELETE FROM proponente WHERE id_proyecto=$_GET[id]";
        if ($modo_depuracion) echo "$sql_temp<br>";
        else $resultado=ejecutarConsulta($sql_temp, $conexion);
}

cerrarConexion($conexion);

?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El proponente ha sido eliminado satisfactoriamente', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vLimpiarProponentes.php" }  })
        </script>	
    </body>

