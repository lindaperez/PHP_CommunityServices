<?
require "cAutorizacion.php";
if (!isAdmin()){
        echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
        exit();
}
unset($_SESSION[proponentes]);
$modo_depuracion=false;

        //proponentes con proyectos asociados
        $sql ="SELECT prop.id_proyecto, u.nombre, u.apellido, count(*) num ";
        $sql.="FROM proponente prop, proyecto p, usuario u ";
        $sql.="WHERE  prop.id_proyecto=p.id ";
        $sql.="AND    prop.usbid_usuario=u.usbid ";
        $sql.="GROUP BY prop.usbid_usuario ";
        $sql.="ORDER BY u.apellido";

        if ($modo_depuracion) {
                echo "$sql<br>";
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                $_SESSION[repre]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[proponentes][id_proyecto][$i]=$fila[id_proyecto];
                        $_SESSION[proponente][nombre][$i]=$fila[nombre];
                        $_SESSION[proponente][apellido][$i]=$fila[apellido];
                        $_SESSION[proponente][num][$i]=$fila[num];
                        $i++;
                }
                $_SESSION[max_proponente]=$i;
        }
        
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
                $_SESSION[vacio]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[vacio][id_proyecto][$i]=$fila[id_proyecto];
                        $_SESSION[vacio][nombre][$i]=$fila[nombre];
                        $_SESSION[vacio][apellido][$i]=$fila[apellido];
                        $i++;
                }
                $_SESSION[max_vacia]=$i;
        }

cerrarConexion($conexion);
?>
