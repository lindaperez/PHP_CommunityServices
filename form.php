<?php
/*
 * Solo los estudiantes pueden inscribirse en un proyecto
*/
include "cInscribirProyecto.php";

$USBID = $_SESSION['USBID'];
$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE usbid='$USBID'";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$ESTUDIANTE = $row;

if(empty($ESTUDIANTE['estudiante_sede'])){
	header('Location: vActualizarDatosEstudiante.php?actualizar_para_inscribir=1');
	exit;
}

$TITLE = 'Inscribir Proyecto - SERVICIO COMUNITARIO'; 
include_once("vHeader.php");
?>

<script language="javascript" src="cVerifInscrip.js"></script>
<form name="datos" id="datos" action="form2.php" method="post" enctype="multipart/form-data">
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="4" class="parrafo" align="center">	
			<table id="tabla_actividades" border=1 class="parrafo">
			<tr>
				<TD><span class='rojo'>*</span><input type='text' name='actividad[]' id="actividad" maxlength="30"></TD>
				<TD><span class='rojo'>*</span><input type='text' name='fecha[]'></TD>
				<TD><span class='rojo'>*</span><input type='text' name='horas[]' size="3"> </TD>
				<TD><a href='javascript: eliminarAct(1)'><?=mostrarImagen('rechazar');?></a></TD>
			</tr>
			</table>  
		</td>  
	</tr>
      <tr>

			<td colspan="4" class="parrafo" align="center">	
				<input type="button" class="parrafo" value="Agregar M&aacute;s Actividades" onClick="agregarAct();"> <br><br><br>
				<a href='javascript: verificar()'><?=mostrarImagen('enviar');?></a>
			</td>  
        </tr>
    </table>
</form>
