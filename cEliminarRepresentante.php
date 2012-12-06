<?
require "cAutorizacion.php";
$modo_depuracion=false;

if ($_GET[id]=="all"){

        $sql ="SELECT r.id, r.nombres nombre, r.apellidos apellido ";
        $sql.="FROM representante r  ";
        $sql.="LEFT JOIN proyecto p ";
        $sql.="ON r.id=p.id_representante  ";
        $sql.="WHERE  p.id_representante IS NULL ";

        if ($modo_depuracion) {
                echo "$sql<br>";
                exit();
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                while ($fila=obtenerResultados($resultado)){
                        $sql2="DELETE FROM representante WHERE id=".$fila[id];
                        if ($modo_depuracion) echo "$sql2<br>";
                        else $resultado2=ejecutarConsulta($sql2, $conexion);
                }
        }

}else{

        $sql_temp="DELETE FROM representante WHERE id=$_GET[id]";
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
        $.prompt('El representante ha sido eliminado satisfactoriamente', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vLimpiarRepresentantes.php" }  })
        </script>	
    </body>

