<?
require "cAutorizacion.php";
if (!isAdmin()){
        echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
        exit();
}
unset($_SESSION[inscripcion]);
$modo_depuracion=false;

        //comunidades con proyectos asociados

        $sql ="SELECT c.nombre nombre, count(*) num ";
        $sql.="FROM comunidad c, proyecto py ";
        $sql.="WHERE  c.id=py.id_comunidad ";
        $sql.="GROUP BY c.id ";
        $sql.="ORDER BY c.nombre";

        if ($modo_depuracion) {
                echo "$sql<br>";
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                $_SESSION[comunidad]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[comunidad][nombre][$i]=$fila[nombre];
                        $_SESSION[comunidad][num][$i]=$fila[num];
                        $i++;   
                }
                $_SESSION[max_comunidad]=$i;
        }

        //comunidades SIN proyectos asociados
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
                $_SESSION[vacia]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[vacia][id][$i]=$fila[id];
                        $_SESSION[vacia][nombre][$i]=$fila[nombre];

                        $i++;
                }
                $_SESSION[max_vacia]=$i;
        }

cerrarConexion($conexion);
?>