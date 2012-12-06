<?
require "cAutorizacion.php";
if (!isAdmin()){
        echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
        exit();
}
unset($_SESSION[inscripcion]);
$modo_depuracion=false;

        //comunidades con proyectos asociados

        $sql ="SELECT r.id, r.nombres nombre, r.apellidos apellido, count(*) num ";
        $sql.="FROM representante r, proyecto p ";
        $sql.="WHERE  r.id=p.id_representante ";
        $sql.="GROUP BY r.id ";
        $sql.="ORDER BY r.apellidos";

        if ($modo_depuracion) {
                echo "$sql<br>";
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                $_SESSION[repre]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[repre][id][$i]=$fila[id];
                        $_SESSION[repre][nombre][$i]=$fila[nombre];
                        $_SESSION[repre][apellido][$i]=$fila[apellido];
                        $_SESSION[repre][num][$i]=$fila[num];
                        $i++;
                }
                $_SESSION[max_repre]=$i;
        }

        //comunidades SIN proyectos asociados
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
                $_SESSION[vacio]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[vacio][id][$i]=$fila[id];
                        $_SESSION[vacio][nombre][$i]=$fila[nombre];
                        $_SESSION[vacio][apellido][$i]=$fila[apellido];
                        $i++;
                }
                $_SESSION[max_vacio]=$i;
        }

cerrarConexion($conexion);
?>
