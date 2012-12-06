<?php

if (MANEJADOR_BD == "mysql") {
	
	function crearConexion($servidor, $usuario, $contrasena) {
		$conexion=mysql_connect($servidor, $usuario, $contrasena) or die ("No se pudo conetar al servidor".mysql_error() );
		mysql_query("SET NAMES 'utf8'");
		return $conexion;
	}
	
	function cerrarConexion($conexion)	{
		mysql_close($conexion);
	}
	
	function numResultados($resultado){
		return mysql_num_rows($resultado);
	}
        
            function ejecutarConsulta($consulta, $conexion){
        
            	$db= mysql_select_db(NOMBRE_BD);// or die ("No se pudo seleccionar la BD ".mysql_error() );
	    	if($db){
               		 if ((preg_match('/^INSERT/', strtoupper($consulta))) || (preg_match('/^DELETE/', strtoupper($consulta)))
                           || (preg_match('/^UPDATE/', strtoupper($consulta)))){
                       
                      		 if( !isset($_SESSION[csrf]) || !isset($_GET[tok])){
                         		die ("No se pudo verificar el token csrf" );
                           
                     		  } else if( empty($_SESSION[csrf]) || empty($_GET[tok])){
                          		 die ("Existen valores del csrf vacios, $_SESSION[csrf];$_GET[tok]" );
		                  } else if( $_SESSION[csrf] != $_GET[tok]) {
                		         die ("inconsistencia del csrf" );
                       		  }
			}

                       $resultado=mysql_query($consulta);
		       if(!$resultado){
				$error_bd=true;
				$mysql_er=mysql_error();
				$sql2= "INSERT INTO error SET ".
				"consulta='".str_replace('\'',"\'",$consulta)."',".
				"msj_error='".str_replace('\'',"\'",$mysql_er)."',".
				"USBID='$_SESSION[USBID]'";
				$resultado2=mysql_query($sql2);// or die ("No se pudo seleccionar la BD ".mysql_error());
				if($resultado2){
					$sql2="SELECT MAX(id_error) FROM error";
					$id = mysql_query($sql2);// or die("No se pudo seleccionar la BD ".mysql_error());
					if($id){
						$res = mysql_fetch_row($id);
						$_SESSION['db_error']="No se pudo ejecutar la consulta, Error $res[0]. Por favor comuniquese con el administrador del sistema";
					}else{
						$_SESSION['db_error'] ="Error 2 con la Base de datos. Por favor comuniquese con el administrador del sistema";
					}
				}else{
					$_SESSION['db_error'] ="Error 3 con la Base de datos. Por favor comuniquese con el administrador del sistema";
				}
			}else{
				if((preg_match('/^INSERT/',strtoupper($consulta))) || (preg_match('/^DELETE/',strtoupper($consulta))) || (preg_match('/^UPDATE/',strtoupper($consulta)))){
 
                			 $sql2= "INSERT INTO log SET ".
		                       "consulta='".str_replace('\'',"\'",$consulta)."',".
          		               "ip='".getIP()."',".
		                       "usbid_usuario='$_SESSION[USBID]'";
                		       $resultado2=mysql_query($sql2);// or die ("No se pudo seleccionar la BD ".mysql_error() );
							if(!$resultado2){
		              			$error_bd=true;
	               				$_SESSION['db_error'] ="Error 4 con la Base de datos. Por favor comuniquese con el administrador del sistema";
			       		 }
				}
                   	}
		}else{
			$error_bd=true;
               		$_SESSION['db_error'] ="Error 5 con la Base de datos. Por favor comuniquese con el administrador del sistema";
		}
		if($error_bd){
?>
                <script type='text/javascript'>
	         history.back();
                </script>
<?php
		}
             //  $resultado = mysql_query($consulta) or die ("No se pudo ejecutar la consulta $consulta <br>".mysql_error());    
               return $resultado;
       }
	
	function obtenerResultados($resultado){
		return mysql_fetch_array($resultado, MYSQL_ASSOC);
	}

	function escaparString($string){
		return mysql_real_escape_string($string);
	}
}

if (MANEJADOR_BD == "postgres"){
	
	function crearConexion($servidor, $usuario, $contrasena){
		$dbconn = pg_connect("host=$servidor dbname=postgres user=$usuario password=$contrasena")
    or die('Could not connect: ' . pg_last_error());
		return $dbconn;
	}
	
	function cerrarConexion($conexion){
		
	}
	
	function ejecutarConsulta($consulta, $base_datos, $conexion){
		return pg_query($consulta);	
	}
	
	function obtenerResultados($resultado){
		return pg_fetch_array($resultado, null, PGSQL_ASSOC);
	}

	function escaparString($string){
		return pg_escape_string($string);
	}
}

function mostrarImagen($tipo){
	switch ($tipo){
		case "ver": 
			$aviso="Ver Detalles";
			$texto="<img src='imagenes/iconos/view-icon.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;

		case "gsc":
			$aviso="Gestionar Proyecto";
			$texto="<img src='imagenes/iconos/gsc.png' width='20' height='20'alt='$aviso' title='$aviso' border=0 />";
		break;

		case "inscribir": 
			$aviso="Postularse";
			$texto="<img src='imagenes/iconos/vcs_add.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "inscribir_blanco": 
			$aviso="Usted ya se inscribio en este proyecto";
			$texto="<img src='imagenes/iconos/vcs_add_white.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "imprimir": 
			$aviso="Imprimir planilla";
			$texto="<img src='imagenes/iconos/printer.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "notificar": 
			$aviso="Notificar Culminaci&oacute;n";
			$texto="<img src='imagenes/iconos/folder_important.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "notificar_blanco": 
			$aviso="Usted ya culmin&oacute; este proyecto";
			$texto="<img src='imagenes/iconos/folder_important_white.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "aceptar": 
			$aviso="Aceptar";
			$texto="<img src='imagenes/iconos/apply.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "rechazar": 
			$aviso="Rechazar";
			$texto="<img src='imagenes/iconos/remove4.png' width='20' height='20'  alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "eliminar": 
			$aviso="Eliminar";
			$texto="<img src='imagenes/iconos/delete.png' width='20' height='20'  alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "excel": 
			$aviso="Ver archivo Excel";
			$texto="<img src='imagenes/iconos/excel.jpg' width='40' height='40' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "salir": 
			$aviso="Cerrar Sesi&oacute;n";
			$texto="<img src='imagenes/iconos/exit.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "opciones": 
			$aviso="Opciones";
			$texto="<img src='imagenes/iconos/exec.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "enviar": 
			$aviso="Enviar";
			$texto="<img src='imagenes/iconos/apply2.jpg' width='40' height='40' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "culminado": 
			$aviso="Culminado";
			$texto="<img src='imagenes/iconos/candado_abierto.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "no_culminado": 
			$aviso="Re-abrir el proyecto";
			$texto="<img src='imagenes/iconos/candado.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;		
		case "evaluar": 
			$aviso="Evaluar";
			$texto="<img src='imagenes/iconos/txt.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "cambiar": 
			$aviso="Cambiar Tipo";
			$texto="<img src='imagenes/iconos/reload.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "alerta": 
			$aviso="Pendiente por entregar los recaudos completos";
			$texto="<img src='imagenes/iconos/warning.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "pdf": 
			$aviso="Exportar a PDF";
			$texto="<img src='imagenes/iconos/pdf.png' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "pdf2": 
			$aviso="Certificacion de Cumplimiento de SC";
			$texto="<img src='imagenes/iconos/pdf.png' width='30' height='30' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "email": 
			$aviso="Contactar";
			$texto="<img src='imagenes/iconos/email.jpg' width='30' height='30' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "volver": 
			$aviso="Volver";
			$texto="<img src='imagenes/iconos/back.png' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "login": 
			$aviso="Ingresar al Sistema";
			$texto="<img src='imagenes/iconos/login.png' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "modificar": 
			$aviso="Modificar";
			$texto="<img src='imagenes/iconos/txt.png'  width='15' height='15' alt='$aviso' title='$aviso' border=0  />";
		break;
		case "constancia": 
			$aviso="Generar constancia de inicio";
			$texto="<img src='imagenes/iconos/Clip-icon.gif'  width='20' height='20' alt='$aviso' title='$aviso' border=0  />";
		break;
		case "modificar2": 
			$aviso="Modificar Inscripcion";
			$texto="<img src='imagenes/iconos/modinsc.png'  width='15' height='15' alt='$aviso' title='$aviso' border=0  />";
		break;
		case "desabilitar": 
			$aviso="Desabilitar Tutor";
			$texto="<img src='imagenes/iconos/blockUser.png'  width='15' height='15' alt='$aviso' title='$aviso' border=0  />";
		break;
	}
	return $texto;
}
	
        function getIP() { 
            $ip; 
            if (getenv("HTTP_CLIENT_IP")) 
            $ip = getenv("HTTP_CLIENT_IP"); 
            else if(getenv("HTTP_X_FORWARDED_FOR")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
            else if(getenv("REMOTE_ADDR")) 
            $ip = getenv("REMOTE_ADDR"); 
            else 
            $ip = "UNKNOWN";
        return $ip; 

        }

function isAdmin(){
	if ($_SESSION[USBID]=="coord-psc" || $_SESSION[USBID]=="coop-emp")
		return true;
	else return false;
}

function isExtemp($usbid){
	$sql="SELECT * FROM extemp WHERE usbid='".$usbid."'";
	$resultado=ejecutarConsulta($sql, $conexion);
	$numero=numResultados($resultado);
	if ($numero==0) return false;
	else return true;
}

function isEstudiante(){
	if ($_SESSION[tipo]=="pregrado" or $_SESSION['tipo']=="postgrado")
		return true;
	else
		return false;
}

function isEmpleado() {
    if ($_SESSION[tipo] == "empleados")
        return true;
    else
        return false;
}

function isEmpleadoCCTDS() {
    if (isAdmin() || isAsistente() || isSecretaria())
        return true;
    else
        return false;
}

function isAsistente() {
    if ($_SESSION[ROL] == "asistente")
        return true;
    else
        return false;
}

function isSecretaria() {
    if ($_SESSION[ROL] == "secretaria")
        return true;
    else
        return false;
}

function isDepartamento() {
    if ($_SESSION['tipo'] == "departamento")
        return true;
    else
        return false;
}

function isCoordinacion() {
    if ($_SESSION['tipo'] == "coordinacion")
        return true;
    else
        return false;
}

function mostrarDatosUsuario(){
	if (isset($_SESSION['USBID'])){

	?>
	<div class="parrafo" align="right">
	<strong style="font-size:12px"><?php echo "$_SESSION[nombres] $_SESSION[apellidos]"; if (isAdmin()) echo "<i> - Administrador</i>"; ?></strong><br />
    <i> <?php
    	if ($_SESSION[tipo]=="pregrado" or $_SESSION[tipo]=="postgrado") echo "Estudiante - $_SESSION[carrera]";
		if ($_SESSION[tipo]=="profesores") echo "Miembro USB - Profesor";
		if ($_SESSION[tipo]=="empleados") echo "Miembro USB - Empleado";
		if ($_SESSION[tipo]=="administrativos") echo "Miembro USB - Instituci&oacute;n";
		if ($_SESSION[tipo]=="organizaciones") echo "Organizaci&oacute;n Estudiantil"; ?> </i>
		
      	<p><a href="vListarOpciones.php"><?php echo mostrarImagen("opciones"); ?></a>&nbsp;&nbsp;
	  	<a href="salir.php"><?php echo
		
		mostrarImagen("salir"); ?></a></p>
      </div>
	  <?php
	}
}

function datos_vacios($dato1,$dato2,$dato3,$dato4,$dato5,$dato6){
    if(empty($dato1) && empty($dato2) && empty($dato3) && empty($dato4) && empty($dato5) &&
                      empty($dato6)){
        return true;
    } else return false;
}

function datos_llenos($dato1,$dato2,$dato3,$dato4,$dato5,$dato6){
    if(!empty($dato1) && !empty($dato2) && !empty($dato3) && !empty($dato4) && !empty($dato5) &&
                         !empty($dato6)){
        return true;
    } else return false;
}

function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return 1;
    else
       return 0;
}

function comprobar_carnet($carnet){
    $reg = "/^[0-9]{2}-[0-9]{5}$/i";
        return preg_match($reg, $carnet);
} 

function comprobar_telefono($numero)
{
    $reg = "/^\([0-9]{4}\)[0-9]{3}-[0-9]{4}$/i";
        return preg_match($reg, $numero);
}
//-----------Utilizadas para subir lista en excel de estudiantes----------//
function comprobar_telefono_2($numero)
{
    $reg = "/^[0-9]{10}$/i";
        return preg_match($reg, $numero);
}

function comprobar_codigo($codigo)
{   
    $reg = "/^[A-Z]{2}[0-9]{4}$/i";
        return (preg_match($reg, $codigo) && (strlen($codigo)==6));
}

// Esta funcion recibe el codigo sin formato correcto y lo conierte en AB-1234
function reemplazar_codigo($codigo)
{
    $mat=  substr($codigo, 0,2);
    $num=  substr($codigo, 2,4);
    $new_codigo=  $mat.'-'.$num;
        return $new_codigo;
}

// Esta funcion recibe 10 numeros y los reemplaza al formato (0416)232-1234
function reemplazar_telefono_2($numero)
{
    $operadora=substr($numero,0,3);
    $num_1=substr($numero,3,3);
    $num_2=substr($numero,6,4);
    $telefono = '(0'.$operadora.')'.$num_1.'-'.$num_2;
            return $telefono;
}

function comprobar_fecha($fecha)
{
    $reg = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/i";
    $exp = preg_match($reg, $fecha);
    $aux= strtotime (str_replace('/', '-',$fecha)) ? date ('d-m-Y', strtotime ($fecha)) : false;
        return ($exp && $aux);
}

function comprobar_trimestre($periodo)
{
    $aux=true;
    if ($periodo=="Enero-Marzo" OR $periodo=="Abril-Julio" 
            OR $periodo=="Septiembre-Diciembre") $aux=true;
    else $aux=false;
        return $aux;
}

//Esta funcion se necesita para el envio de correos
function break_line($linea)
{
    $reg = "\'";
    $rep = '\'';
    $linea1 = str_replace($reg, $rep, $linea);
    $reg1 = '\"';
    $rep1 = "\"";
    $linea2 = str_replace($reg1, $rep1, $linea1);
    $reg2 = '\r\n';
    $rep2 = "\n";
        return str_replace($reg2, $rep2, $linea2);

}

function replace_form($linea)
{
    $reg = "\'";
    $rep = '\"';
        return str_replace($reg, $rep, $linea);
}

function armar_dependencias($conexion){
	$opciones="";
	$sql="SELECT * FROM dependencia ORDER BY nombre ";
	$resultado=ejecutarConsulta($sql, $conexion);
	while($fila=obtenerResultados($resultado)){
		$opciones.="<option value='$fila[id]'>$fila[nombre]</option>";
	}
	return $opciones;
}

function armar_carreras($conexion){
	$opciones="";
	$sql="SELECT * FROM carrera ORDER BY nombre ";
	$resultado=ejecutarConsulta($sql, $conexion);
	while($fila=obtenerResultados($resultado)){
		$opciones.= "<option value='$fila[codigo]'>$fila[nombre]</option>";
	}
	return $opciones;
}
function armar_tutores($conexion, $usbid){
	$opciones="";
	$sql="SELECT u.usbid, u.nombre, u.apellido FROM usuario_miembro_usb um, usuario u WHERE u.usbid=um.usbid_usuario ORDER BY u.apellido ";
	$resultado=ejecutarConsulta($sql, $conexion);
	while($fila=obtenerResultados($resultado)){
		$opciones.= "<option value='$fila[usbid]'";
		if ($usbid<>"" and $usbid==$fila[usbid]) $opciones.=" selected";
		$opciones.=">$fila[apellido], $fila[nombre] ($fila[usbid])</option>";
	}
	return $opciones;
}

//Verifica si el trimestre esta en un periodo valido
function validoEnTrimestre($fecha,$conexion) {
    $sql = "SELECT true FROM evento e WHERE DATE('".$fecha."') >= DATE(e.fecha_inicio) AND ";
    $sql.= "DATE('".$fecha."') <= DATE_ADD(e.fecha_fin, INTERVAL 1 DAY) AND e.codigo='1' ";
    $resultado = ejecutarConsulta($sql, $conexion);
    if (numResultados($resultado) == 0)
        return false;
    else {
        return true;
    }
}

//Verifica si el trimestre esta en un periodo valido
function periodoTrimestre($conexion) {
    $sql = "SELECT true FROM evento e WHERE NOW() >= DATE(e.fecha_inicio) ";
    $sql.= "AND NOW() <= DATE_ADD(e.fecha_fin, INTERVAL 1 DAY) AND e.codigo='1' ";
    $resultado = ejecutarConsulta($sql, $conexion);
    if (numResultados($resultado) == 0)
        return false;
    else {
        return true;
    }
}

//Verifica si es periodo de formulacion
function periodoFormulacion($conexion) {
    $sql = "SELECT true FROM evento e WHERE NOW() >= DATE(e.fecha_inicio) AND ";
    $sql.= "NOW() <= DATE_ADD(e.fecha_fin, INTERVAL 1 DAY) AND e.codigo='2' ";
    $resultado = ejecutarConsulta($sql, $conexion);
    if (numResultados($resultado) == 0)
        return false;
    else {
        return true;
    }
}

//Verifica si es periodo de inscripcion
function periodoInscripcion($conexion) {
    $sql = "SELECT true FROM evento e WHERE NOW() >= DATE(e.fecha_inicio) AND ";
    $sql.= "NOW() <= DATE_ADD(e.fecha_fin, INTERVAL 1 DAY) AND (e.codigo='3' OR e.codigo='4') ";
    $resultado = ejecutarConsulta($sql, $conexion);
    if (numResultados($resultado) == 0)
        return false;
    else {
        return true;
    }
}

//Verifica si falta poco para culminar serComunitario
function prontaculminacion($conexion,$cod) {
	$sql = "SELECT DATEDIFF( NOW(), fecha_inscip) AS dif FROM inscripcion WHERE usbid_estudiante = '".$cod."' AND culminacion_validada != 'SI'";
    $resultado = ejecutarConsulta($sql, $conexion);
	$fechas = obtenerResultados($resultado);
    if ($fechas[dif] < 334)
        return 0;
    else {
        return 364 - $fechas[dif];
    }
}

//Funcion que busca los proyectos que tengan un año o mas
function anioculminacion($conexion,$cod) {
	$sql = "SELECT id AS cod FROM inscripcion WHERE culminacion_validada != 'SI' AND DATEDIFF( NOW(), fecha_inscip)>=364 AND aprobado = 'SI'";
    $resultado = ejecutarConsulta($sql, $conexion);
	while($fila=obtenerResultados($resultado)){
		//observaciones, validacion_culminada
	}
}


//Funcion que verifica si el proponente o tutor ya se encuentra registrado
function existe_en_bd($dato,$tabla,$compare){
    $sql="SELECT * , COUNT(*) existe FROM $tabla WHERE $compare='$dato'";
    $resultado=ejecutarConsulta($sql, $conexion);
    $row = obtenerResultados($resultado);
    if ((int)$row['existe']=="0"){
        return false;
    } else {
        return true;
    }
}

////////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////

function cambiaf_a_normal($fecha) {
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
    return $lafecha;
}
