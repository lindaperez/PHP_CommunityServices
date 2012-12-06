<?php
require "cAutorizacion.php";
unset($_SESSION[proyecto]);
$modo_depuracion=false;

        if ($_GET[opcion]=="listar_estudiantes"){
                
                $sql2 ="SELECT u.usbid, u.nombre, u.apellido, u.ci, ue.*, i.tutor, i.aprobado, ";
                $sql2.="i.culminacion_validada, p.titulo ";
                $sql2.="FROM usuario u, usuario_estudiante ue, inscripcion i, proyecto p ";
                $sql2.="WHERE u.usbid=ue.usbid_usuario AND i.id_proyecto=$_GET[proyecto] ";
                $sql2.="AND u.usbid=i.usbid_estudiante AND i.tutor='$_SESSION[USBID]' ";
                $sql2.="AND p.id=i.id_proyecto ";
                $resultado2=ejecutarConsulta($sql2, $conexion);
		$i=0;
		while ($fila2=obtenerResultados($resultado2)){ 
                    $_SESSION[proyecto][usbid_est][$i]=$fila2[usbid];
                    $_SESSION[proyecto][nombre_est][$i]=$fila2[nombre];
                    $_SESSION[proyecto][apellido_est][$i]=$fila2[apellido];
                    $_SESSION[proyecto][ci_est][$i]=$fila2[ci];
                    $_SESSION[proyecto][carrera_est][$i]=$fila2[carrera];
                    $_SESSION[proyecto][email_est][$i]=$fila2[email_sec];
                    $_SESSION[proyecto][telf_hab_est][$i]=$fila2[telf_hab];
                    $_SESSION[proyecto][telf_cel_est][$i]=$fila2[telf_cel];
                    $_SESSION[proyecto][status_insc][$i]=$fila2[aprobado];
                    $_SESSION[proyecto][insc_culminada][$i]=$fila2[culminacion_validada];
                    $_SESSION[proyecto][titulo]=$fila2[titulo];
                    $i++;
		}
		$_SESSION[max_estudiantes]=$i;
	} else {
        
        $sql_select ="SELECT py.*, YEAR(py.fecha_ingreso) as anio, u.nombre, u.apellido, u.usbid, a.nombre area ";
		$sql_from ="FROM proyecto py, usuario u, area_proyecto a ";
		//$sql_from.=", proponente p ";
		$sql_where="WHERE py.id_area_proy=a.id ";
		//$sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";
		$sql_where.="AND py.status_proy='POSTULADO' ";
		$sql_order="ORDER BY area";
	if ($_GET[opcion]=="por evaluar"){
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND (py.codigo='' OR py.aprobado<>'SI') ";
	}
	if ($_GET[opcion]=="" ){
		$sql_from.=", evaluacion e ";
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND e.id_proyecto=py.id ";
		$sql_where.="AND culminado<>'SI' ";	
		$sql_where.="AND aprobado='SI' AND codigo<>'' ";	
	}
	if ($_GET[opcion]=="continuos"){
		$sql_select.=", e.id id_eval ";
		$sql_from.=", evaluacion e ";
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND e.id_proyecto=py.id AND e.tipo='CONTINUO' ";
		$sql_where.="AND culminado<>'SI' ";	
		$sql_where.="AND aprobado='SI' AND codigo<>'' ";	
	}

	if ($_GET[opcion]=="puntuales"){
		$sql_select.=", e.id id_eval ";
		$sql_from.=", evaluacion e ";
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND e.id_proyecto=py.id AND e.tipo='PUNTUAL' ";
		$sql_where.="AND culminado<>'SI' ";	
		$sql_where.="AND aprobado='SI' AND codigo<>'' ";	
	}
        if ($_GET[opcion]=="tutoreados"){
                $sql_select.=", t.* ";
                $sql_from.=", tutor_proy t ";
		$sql_where.="AND t.usbid_miembro=u.usbid AND py.id=t.id_proyecto ";
		$sql_where.="AND u.usbid='$_SESSION[USBID]' ";
		$sql_order="ORDER BY py.fecha_ingreso DESC, area ASC";
	}
        if ($_GET[opcion]=="propios"){
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND u.usbid='$_SESSION[USBID]' ";	
		$sql_order="ORDER BY py.fecha_ingreso DESC, area ASC";
	}
	if ($_GET[opcion]=="culminados"){
                $sql_from.=", proponente p ";//AQUI
                $sql_where.="AND py.id=p.id_proyecto AND p.usbid_usuario=u.usbid ";//AQUI
		$sql_where.="AND culminado='SI' ";	
	}
	
	
	$sql="$sql_select $sql_from $sql_where $sql_order";
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$i=0;
		while ($fila=obtenerResultados($resultado)){ 
			$_SESSION[proyecto][id][$i]=$fila[id];
			$_SESSION[proyecto][codigo][$i]=$fila[codigo];
			$_SESSION[proyecto][titulo][$i]=$fila[titulo];
			$_SESSION[proyecto][resumen][$i]=$fila[resumen];
			$_SESSION[proyecto][nombre][$i]=$fila[nombre];	
			$_SESSION[proyecto][apellido][$i]=$fila[apellido];
			$_SESSION[proyecto][usbid][$i]=$fila[usbid];
			$_SESSION[proyecto][area][$i]=$fila[area];
			$_SESSION[proyecto][id_eval][$i]=$fila[id_eval];			
			$_SESSION[proyecto][culminado][$i]=$fila[culminado];
			$_SESSION[proyecto][fecha][$i]=$fila[fecha_ingreso];
			$_SESSION[proyecto][anio][$i]=$fila[anio];
                        
                        if ($_GET[opcion]=="propios" || $_GET[opcion]=="tutoreados"){
                            $sql1 ="SELECT COUNT(*) totales ";
                            $sql1.="FROM inscripcion ";
                            $sql1.="WHERE id_proyecto='$fila[id]' AND tutor='$_SESSION[USBID]' ";	
                            $resultado1=ejecutarConsulta($sql1, $conexion);
                            $fila1=obtenerResultados($resultado1);
                            $_SESSION[proyecto][cant_total][$i]=  $fila1[totales];
                            
                        }
			$i++;	
		}
		$_SESSION[max_proy]=$i;
	}
        
        }
cerrarConexion($conexion);
?>