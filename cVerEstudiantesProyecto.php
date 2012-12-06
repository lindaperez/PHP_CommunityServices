<?php
require "cAutorizacion.php";
unset($_SESSION[proyecto]);
$modo_depuracion=false;

        if ($_GET[opcion]=="listar_estudiantes"){
                
                $sql2 ="SELECT u.usbid, u.nombre, u.apellido, u.ci, ue.*, i.tutor, i.aprobado, ";
                $sql2.="i.culminacion_validada, p.titulo ";
                $sql2.="FROM usuario u, usuario_estudiante ue, inscripcion i, proyecto p ";
                $sql2.="WHERE u.usbid=ue.usbid_usuario AND i.id_proyecto=$_GET[proyecto] ";
                $sql2.="AND u.usbid=i.usbid_estudiante ";
                $sql2.="AND p.id=i.id_proyecto ORDER BY carrera";
                $resultado2=ejecutarConsulta($sql2, $conexion);
		$i=0;
                $_SESSION[proyecto][fem]=0;
                $_SESSION[proyecto][masc]=0;
                $_SESSION[proyecto][sin_sex]=0;
                $carreras=array();
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
                    $carreras[]=$fila2[carrera];
                    if ($fila2[sexo]=="F")
                        $_SESSION[proyecto][fem]++;
                    if ($fila2[sexo]=="M")
                        $_SESSION[proyecto][masc]++;
                    if ($fila2[sexo]!="M" && $fila2[sexo]!="F")
                        $_SESSION[proyecto][sin_sex]++;
		}
		$_SESSION[max_estudiantes]=$i;
                $carreras = array_unique( $carreras );
                $_SESSION[proyecto][carreras]= array();
                foreach ($carreras as $i){
                    $sql2 ="SELECT nombre ";
                    $sql2.="FROM carrera ";
                    $sql2.="WHERE codigo='$i' ";
                    $resultado=ejecutarConsulta($sql2, $conexion);
                    $fila=  obtenerResultados($resultado);
                    $_SESSION[proyecto][carreras][]= "<strong>".$i."</strong> - " . $fila[nombre];
                }
	}elseif ($_GET[opcion]=="listar_estudiantesXtutor"){
		$totales = 0; 
		$i = 0;
		
		$sql = "SELECT COUNT(*) sub_total, id_proyecto FROM inscripcion WHERE tutor='".$_GET['tutor']."' GROUP BY id_proyecto";
		$resultado = ejecutarConsulta($sql, $conexion);		
		while ($fila = obtenerResultados($resultado)){	
			$totales = $totales + $fila['sub_total'];
			$sql2 ="SELECT u.usbid, u.nombre, u.apellido, u.ci, ue.*, i.tutor, i.aprobado, ";
                $sql2.="i.culminacion_validada, p.titulo ";
                $sql2.="FROM usuario u, usuario_estudiante ue, inscripcion i, proyecto p ";
                $sql2.="WHERE u.usbid=ue.usbid_usuario AND i.id_proyecto=".$fila['id_proyecto']." ";
                $sql2.="AND u.usbid=i.usbid_estudiante AND i.tutor='".$_GET['tutor']."' ";
                $sql2.="AND p.id=i.id_proyecto ";
                $resultado2=ejecutarConsulta($sql2, $conexion);

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
						$_SESSION[proyecto][titulo][$i]=$fila2[titulo];
						$i ++;
			}
			$_SESSION[max_estudiantes]=$totales;							
		} 	
	}
        cerrarConexion($conexion);
?>
