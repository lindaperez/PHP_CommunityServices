<?php
session_start();

$login=$_SESSION[USBID];
$cohorte_array = explode("-", $login);
$cohorte = $_SESSION[cohorte] = $cohorte_array[0];
$nombres=$_SESSION[nombres];
$apellidos=$_SESSION[apellidos];
$ci=$_SESSION[cedula];
$carrera=$_SESSION[carrera];
$carnet=$_SESSION[carnet];
$tipo=$_SESSION[tipo];
		  
require_once "cConstantes.php";	 

$sql="SELECT * FROM usuario WHERE usbid='$login'";
$resultado=ejecutarConsulta($sql, $conexion);

//Se verifica que el USBID est� almacenado en la BD local al Sistema 
if (numResultados($resultado)==0){
	$sql4="INSERT INTO usuario(usbid, nombre, apellido, ci, tipo) VALUES ('$login', '$nombres', '$apellidos', '$ci', '$tipo')";
	$resultado4=ejecutarConsulta($sql4, $conexion);
	
	if	($_SESSION[tipo]=="pregrado" or $_SESSION[tipo]=="postgrado") {
		$sql7="SELECT codigo FROM carrera WHERE nombre='$carrera'";
		$resultado7=ejecutarConsulta($sql7, $conexion);
		
		$cod_carrera = obtenerResultados($resultado7);
		$cod = $cod_carrera[codigo];
		
		$sql5="INSERT INTO usuario_estudiante (usbid_usuario, carnet, cohorte, carrera) VALUES ('$login', '$carnet', '$cohorte', '$cod')";
		$resultado5=ejecutarConsulta($sql5, $conexion);
	}
	else{
		$sql6="INSERT INTO usuario_miembro_usb(usbid_usuario) VALUES ('$login')";
		$resultado6=ejecutarConsulta($sql6, $conexion);
	}
}

// Se verifica localmente si el Usuario es del tipo coordinacion
// y se le asignan sus atributos correspondientes

$sql_cor="SELECT * FROM coordinacion WHERE usbid='$login'";
$resultado_cor=ejecutarConsulta($sql_cor, $conexion);

if (numResultados($resultado_cor) != 0){
	$usr = obtenerResultados($resultado_cor);
	
	$_SESSION[tipo] = "coordinacion";
	$_SESSION[nombres] = "Coordinacion de ".$usr[nombre];
	$_SESSION[apellidos] = "";
	
	
	$sql3 = "SELECT carrera_sede, codigo FROM carrera WHERE coordinacion='$login'";
	$resultado3=ejecutarConsulta($sql3, $conexion);
	$fila3=  obtenerResultados($resultado3);
	$_SESSION[sede]=$fila3[carrera_sede];
			
}else{

	// Se verifica localmente si el Usuario es del tipo departamento
	// y se le asignan sus atributos correspondientes

	$sql_dep="SELECT * FROM departamento WHERE usbid='$login'";
	$resultado_dep=ejecutarConsulta($sql_dep, $conexion);

	if (numResultados($resultado_dep) != 0){
		$usr = obtenerResultados($resultado_dep);
		
		$_SESSION[tipo] = "departamento";
		$_SESSION[nombres] = "Departamento de ".$usr[nombre];
		$_SESSION[apellidos] = "";
		$_SESSION[dependencia] = $usr[id];
		$_SESSION[sede]=$usr[sede];
	}else{

		// Asignacion de sedes, roles y carreras segun el tipo de usuario

		if ($tipo=="empleados" || $tipo=="administrativos"){
			if (existe_en_bd($login,'rol_sistema', 'usbid')){
				$sql2 = "SELECT sede, rol FROM rol_sistema WHERE usbid='$login'";
				$resultado2=ejecutarConsulta($sql2, $conexion);
				$fila2=  obtenerResultados($resultado2);
				$_SESSION[sede]=$fila2[sede];
				$_SESSION[ROL]=$fila2[rol];
			}else {$_SESSION[sede]=''; $_SESSION[ROL]='';}
			
		} elseif($_SESSION[tipo]=="pregrado" || $_SESSION[tipo]=="postgrado"){
			if(strlen($_SESSION[carnet]) == 7){
				$_SESSION[sede]='Sartenejas'; $_SESSION[ROL]='';
			}else{
				$_SESSION[sede]='Litoral'; $_SESSION[ROL]='';
			}
			
		} elseif ($_SESSION[tipo]=="profesores"){
				$sql2 = "SELECT d.sede FROM usuario_miembro_usb m, departamento d WHERE d.id=m.dependencia AND usbid_usuario='$login'";
				$resultado2=ejecutarConsulta($sql2, $conexion);
				$fila2=  obtenerResultados($resultado2);
			$_SESSION[sede]=$fila2[sede]; $_SESSION[ROL]='';
			
		}else{
			$_SESSION[sede]=''; $_SESSION[ROL]='';		
		}
	}
}

header("Location: vListarOpciones.php");

?>