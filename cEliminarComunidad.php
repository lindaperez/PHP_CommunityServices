<?
require "cAutorizacion.php";
$modo_depuracion=false;
if ($_GET[id]=="all"){

        $sql ="SELECT c.id, c.nombre nombre ";
        $sql.="FROM comunidad c  ";
        $sql.="LEFT JOIN proyecto py ";
        $sql.="ON c.id=py.id_comunidad  ";
        $sql.="WHERE  py.id_comunidad IS NULL ";

        if ($modo_depuracion) {
                echo "$sql<br>";
                exit();
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                while ($fila=obtenerResultados($resultado)){
                        $sql2="DELETE FROM comunidad WHERE id=".$fila[id];
                        if ($modo_depuracion) echo "$sql2<br>";
                        else $resultado2=ejecutarConsulta($sql2, $conexion);
                }
        }

}else{

        $sql_temp="DELETE FROM comunidad WHERE id=$_GET[id]";
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
        $.prompt('La comunidad ha sido eliminado satisfactoriamente', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vLimpiarComunidades.php" }  })
        </script>	
    </body>

