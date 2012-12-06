<?
require "cAutorizacion.php";
if (!isAdmin()){
        echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
        exit();
}
unset($_SESSION[inscripciones]);
$modo_depuracion=false;

        //inscripcioness con proyectos asociados
        //$sql ="SELECT i.*, p.*, u.usbid, u.nombre usuario_nombre, u.apellido usuario_apellido "
        $sql ="SELECT i.*, p.*, u.usbid, u.nombre usuario_nombre, u.apellido usuario_apellido, count(*) num  "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
                . " LEFT JOIN usuario_miembro_usb e ON (i.tutor = e.usbid_usuario) "
                . " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " WHERE ''='' ";

        if ($modo_depuracion) {
                echo "$sql<br>";
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                $_SESSION[repre]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[inscripcioness][id_proyecto][$i]=$fila[id];
                        $_SESSION[inscripciones][nombre][$i]=$fila[usuario_nombre];
                        $_SESSION[inscripciones][apellido][$i]=$fila[usuario_apellido];
                        $_SESSION[inscripciones][num][$i]=$fila[num];
                        $i++;
                }
                $_SESSION[max_inscripciones]=$i;
        }
        
        $sql="SELECT i.*, p.*, u.usbid, u.nombre usuario_nombre, u.apellido usuario_apellido "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
                . " LEFT JOIN usuario_miembro_usb e ON (i.tutor = e.usbid_usuario) "
                . " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " WHERE p.id IS NULL ";
        
        if ($modo_depuracion) {
                echo "$sql<br>";
                exit();
        }else{
                $resultado=ejecutarConsulta($sql, $conexion);
                $i=0;
                $_SESSION[vacio]="";
                while ($fila=obtenerResultados($resultado)){
                        $_SESSION[vacio][id_proyecto][$i]=$fila[id];
                        $_SESSION[vacio][nombre][$i]=$fila[usuario_nombre];
                        $_SESSION[vacio][apellido][$i]=$fila[usuario_apellido];
                        $i++;
                }
                $_SESSION[max_vacia]=$i;
        }

cerrarConexion($conexion);
?>
