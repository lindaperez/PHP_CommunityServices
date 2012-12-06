<?php


if (MANEJADOR_BD == "mysql")
{
	function crearConexion($servidor, $usuario, $contrasena)
	{
		$conexion=mysql_connect($servidor, $usuario, $contrasena) or die ("No se pudo conetar al servidor".mysql_error() );
		return $conexion;
	}
	function cerrarConexion($conexion)
	{
		mysql_close($conexion);
	}
	function numResultados($resultado)
	{
		return mysql_num_rows($resultado);
	}
	function ejecutarConsulta($consulta, $conexion)
	{
		mysql_select_db(NOMBRE_BD) or die ("No se pudo seleccionar la BD ".mysql_error() );
		$resultado = mysql_query($consulta) or die ("No se pudo ejecutar la consulta $consulta <br>".mysql_error());
		return $resultado;
	}
	function obtenerResultados($resultado)
	{
		return mysql_fetch_array($resultado, MYSQL_ASSOC);
	}

}
if (MANEJADOR_BD == "postgres")
{
	function crearConexion($servidor, $usuario, $contrasena)
	{
		$dbconn = pg_connect("host=$servidor dbname=postgres user=$usuario password=$contrasena")
    or die('Could not connect: ' . pg_last_error());
		return $dbconn;
	}
	function cerrarConexion($conexion)
	{
		
	}
	function ejecutarConsulta($consulta, $base_datos, $conexion)
	{
		return pg_query($consulta);	
	}
	function obtenerResultados($resultado)
	{
		return pg_fetch_array($resultado, null, PGSQL_ASSOC);
	}

}

function mostrarImagen($tipo){
	switch ($tipo){
		case "ver": 
			$aviso="Ver Detalles";
			$texto="<img src='imagenes/iconos/view-icon.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;

		case "inscribir": 
			$aviso="Inscribirse";
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
			$aviso="Notificar Culminacion";
			$texto="<img src='imagenes/iconos/folder_important.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "notificar_blanco": 
			$aviso="Usted ya culmino este proyecto";
			$texto="<img src='imagenes/iconos/folder_important_white.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "aceptar": 
			$aviso="Aceptar";
			$texto="<img src='imagenes/iconos/apply.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "rechazar": 
			$aviso="Eliminar";
			$texto="<img src='imagenes/iconos/remove4.png' width='20' height='20'  alt='$aviso' title='$aviso' border=0 />"; 
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
			$texto="<img src='imagenes/iconos/apply2.jpg' width='40' height='40' alt='$aviso' title='$aviso' border=0 onclick='javascript: verificar();' />"; 
		break;
		case "culminado": 
			$aviso="Culminado";
			$texto="<img src='imagenes/iconos/candado.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
		break;
		case "no_culminado": 
			$aviso="Re-abrir el proyecto";
			$texto="<img src='imagenes/iconos/candado_abierto.png' width='20' height='20' alt='$aviso' title='$aviso' border=0 />"; 
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
	}
	return $texto;
}

function isAdmin(){
	if ($_SESSION[USBID]=="03-36606")
		return true;
	else return false;
}
function mostrarDatosUsuario(){
	?>
	<div class="parrafo" align="right">
	<strong><? echo "$_SESSION[nombres] $_SESSION[apellidos]" ; ?></strong><br />
    <i> <? echo "$_SESSION[carrera]" ; ?> </i><br />
	<?
	if (isAdmin()){
		echo "Administrador";
	}else{
		if ($_SESSION[carnet]) echo "Estudiante";
		else echo "Miembro USB";
	}
	?><br />
      	<a href="vListarOpciones.php"><? echo mostrarImagen("opciones"); ?></a>&nbsp;&nbsp;
	  	<a href="salir.php"><? echo mostrarImagen("salir"); ?></a> <br />&nbsp;&nbsp;
      <br /></div>
	  <?
}
?>
