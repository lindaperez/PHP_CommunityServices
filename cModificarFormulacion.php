<?
require "cAutorizacion.php";

$messages_fijo[] = "Dado que usted ya guard&oacute; un proyecto anteriormente, est&aacute; por modificarlo.
                    <br/><strong>Recuerde que necesita darle a enviar para postular definitivamente el proyecto.</strong>";





//--------------------------BUSQUEDAS QUE SE REALIZAN---------------------------------//
//Lista de los proponentes de los proyectos
$sql="SELECT * FROM usuario ";
if (!isAdmin()) $sql.="WHERE usbid!='coord-psc' ";
$sql.="ORDER BY apellido, nombre, usbid";
$resultado=ejecutarConsulta($sql, $conexion);
$LISTA_PROP = array();
while ($row = obtenerResultados($resultado))
    $LISTA_PROP[] = $row;

//Lista de comunidades
$sql = "SELECT id, nombre FROM comunidad ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
$LISTA_DEPENDENCIAS = array();
while ($row = obtenerResultados($resultado))
    $LISTA_COMUNIDADES[] = $row;

//Lista de areas del proyecto
$sql="SELECT * FROM area_proyecto ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
$AREA_PROYECTO = array();
while ($row = obtenerResultados($resultado))
        $AREA_PROYECTO[] = $row;

//Lista de tutores
$sql="SELECT * FROM usuario u, usuario_miembro_usb m ".
"WHERE u.usbid=m.usbid_usuario ".
"ORDER BY apellido, nombre, usbid";
$resultado=ejecutarConsulta($sql, $conexion);
$LISTA_TUTORES = array();
while ($row = obtenerResultados($resultado))
        $LISTA_TUTORES[] = $row;

//Lista de dependencias
$sql = "select * FROM dependencia ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
$LISTA_DEPENDENCIAS = array();
while ($row = obtenerResultados($resultado))
        $LISTA_DEPENDENCIAS[] = $row;

//Lista de los representantes de la comunidad
$sql="SELECT * FROM representante ".
"ORDER BY apellidos, nombres";
$resultado=ejecutarConsulta($sql, $conexion);
$LISTA_REPRESENTANTES = array();
while ($row = obtenerResultados($resultado))
        $LISTA_REPRESENTANTES[] = $row;

unset($_SESSION[saved_proy]);

$modo_depuracion=FALSE;

    $sql_aux ="SELECT * , COUNT(*) existe FROM proyecto WHERE usbid_postula='$_SESSION[USBID]' ";
    $sql_aux.="AND status_proy='PENDIENTE' ";
    $resultado=ejecutarConsulta($sql, $conexion);
    $row = obtenerResultados($resultado);
    if ((int)$row['existe']=="0"){

        $sql = "SELECT p.*, o.id id_org, o.nombre, o.direccion, o.email, ben.* ";
        $sql.= "FROM proyecto p ";
        $sql.= "LEFT JOIN organizacion o ON (p.id_organizacion= o.id) ";
        $sql.= "LEFT JOIN beneficiados ben ON (p.id= ben.id_proyecto) ";
        $sql.= "WHERE p.usbid_postula='$_SESSION[USBID]' AND p.status_proy='PENDIENTE' ";
        $sql.= "ORDER BY p.id DESC";
        if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$fila=obtenerResultados($resultado);
			$_SESSION[saved_proy][id_proyecto]=$fila[id];
			$_SESSION[saved_proy][usbid_postula]=$fila[usbid_postula];
			$_SESSION[saved_proy][comunidad]=$fila[id_comunidad];
			$_SESSION[saved_proy][titulo_proy]=$fila[titulo];
			$_SESSION[saved_proy][area_proy]=$fila[id_area_proy];
			$_SESSION[saved_proy][impacto_social]=$fila[impacto_social];
			$_SESSION[saved_proy][cant_fem]=$fila[sexo_fem];
			$_SESSION[saved_proy][cant_masc]=$fila[sexo_masc];
			$_SESSION[saved_proy][cant_disc]=$fila[discapacidad];
			$_SESSION[saved_proy][edad_min]=$fila[edad_min];
			$_SESSION[saved_proy][edad_max]=$fila[edad_max];
			$_SESSION[saved_proy][resumen]=$fila[resumen];
			$_SESSION[saved_proy][area_trabajo]=$fila[area_de_trabajo];
			$_SESSION[saved_proy][representante]=$fila[id_representante];
			$_SESSION[saved_proy][antecedentes]=$fila[antecedentes];
			$_SESSION[saved_proy][obj_general]=$fila[obj_general];
			$_SESSION[saved_proy][obj_especificos]=$fila[obj_especificos];
			$_SESSION[saved_proy][descripcion]=$fila[descripcion];
			$_SESSION[saved_proy][actividades]=$fila[actividades];
			$_SESSION[saved_proy][perfil]=$fila[perfil];
			$_SESSION[saved_proy][recursos]=$fila[recursos];
			$_SESSION[saved_proy][logros]=$fila[logros];
			$_SESSION[saved_proy][directrices]=$fila[directrices];
			$_SESSION[saved_proy][magnitud]=$fila[magnitud];
			$_SESSION[saved_proy][participacion]=$fila[participacion];
			$_SESSION[saved_proy][formacion]=$fila[formacion];
			$_SESSION[saved_proy][formacion_desc]=$fila[formacion_desc];
			$_SESSION[saved_proy][horas]=$fila[horas];
                        
                        $_SESSION[saved_proy][organizacion]=$fila[id_org];
                        $_SESSION[saved_proy][nombre_organizacion]=$fila[nombre];
                        $_SESSION[saved_proy][direccion_organizacion]=$fila[direccion];
                        $_SESSION[saved_proy][email_organizacion]=$fila[email];
                        $_SESSION[saved_proy][telefono_organizacion]=$fila[telefono];
                        $_SESSION[saved_proy][fax_organizacion]=$fila[fax];
                                                
                        $sql2 = "SELECT p.usbid_usuario prop_usbid ";
                        $sql2.= "FROM proponente p ";
                        $sql2.= "WHERE p.id_proyecto='$fila[id]'";
                        //Se buscan los tutores del proyecto
                        $resultado2=ejecutarConsulta($sql2, $conexion);
                        $fila2=obtenerResultados($resultado2);
                        $_SESSION[saved_proy][usbid_prop]=$fila2[prop_usbid];
                        
                        $sql3 = "SELECT t.usbid_miembro tutor_usbid ";
                        $sql3.= "FROM tutor_proy t ";
                        $sql3.= "WHERE t.id_proyecto='$fila[id]'";
                        //Se buscan los tutores del proyecto
                        $resultado3=ejecutarConsulta($sql3, $conexion);
                        $i=1;
                        while ($fila3=obtenerResultados($resultado3)){
                            $_SESSION[saved_proy][usbid_tutor.$i]=$fila3[tutor_usbid];
                            $i++;
                        }
	}
    }
        //cerrarConexion($conexion);
?>
