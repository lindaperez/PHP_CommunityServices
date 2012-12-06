<?php
require "cAutorizacion.php";

$TITLE = 'Actualizar Datos Estudiante - SERVICIO COMUNITARIO';
include_once("vHeader.php");

// Para Formulario
for($i = (int)date('y'); $i>=0; $i--) $LISTA_COHORTE[] = sprintf("%02d", $i);
for($i = 99; $i>=80; $i--) $LISTA_COHORTE[] = sprintf("%02d", $i);

$sql = "SELECT * FROM carrera ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_CARRERA[] = $row;

extract($_GET);
if( isset($usbid) AND $usbid AND isAdmin()) {
	$USBID = $usbid;
} elseif( !isAdmin() AND isEstudiante() ) {
	$USBID = $_SESSION[USBID];
}
$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE usbid='$USBID'";
$resultado = ejecutarConsulta($sql, $conexion);
$ESTUDIANTE = array();
while ($row = obtenerResultados($resultado))
	$ESTUDIANTE = $row;

// Caso especial
if(isset($_GET['actualizar_para_inscribir']) AND $_GET['actualizar_para_inscribir'])
	$_ERRORES[] = 'Para poder inscribirse en un proyecto, necesita actualizar TODOS sus datos';

?>

<?php foreach( (array)$_ERRORES as $value): ?>
<div class="error"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_WARNING as $value): ?>
<div class="warning"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_SUCCESS as $value): ?>
<div class="success"><?php echo $value; ?></div>
<?php endforeach; ?>

<?php if(empty($ESTUDIANTE)): ?>
	<h2>El estudiante no existe</h2>
<?php else: ?>
<form name="datos" action="cActualizarDatosEstudiante.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">

<table width="502" border="0" align="center" cellpadding="0" cellspacing="0" id="modificar_estudiante">
	<tr>
		<td colspan="4">
			<p align="center" class="titular_negro">
			  <strong>ACTUALIZAR DATOS PERSONALES</strong><br>Todos los campos son obligatorios
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">USBID:</div></td>
		<td colspan="2" class="parrafo">
				<?php echo $ESTUDIANTE['usbid'] ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Nombre:</div></td>
		<td colspan="2" class="parrafo">
			<?php if( isAdmin() ): ?>
				<input type="text" name="nombre" value="<?php echo $ESTUDIANTE['nombre']?>" />
			<?php else: ?>
				<?php echo $ESTUDIANTE['nombre'] ?>
				<input type="hidden" name="nombre" value="<?php echo $ESTUDIANTE['nombre']?>" />
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Apellido:</div></td>
		<td colspan="2" class="parrafo">
			<?php if( isAdmin() ): ?>
				<input type="text" name="apellido" value="<?php echo $ESTUDIANTE['apellido']?>" />
			<?php else: ?>
				<?php echo $ESTUDIANTE['apellido'] ?>
				<input type="hidden" name="apellido" value="<?php echo $ESTUDIANTE['apellido']?>" />
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">SEDE: </div></td>
		<td colspan="2" class="parrafo">
			<select name="estudiante_sede">
				<option value=""></option>
				<option value="Sartenejas" <?php echo ($ESTUDIANTE['estudiante_sede']=='Sartenejas')?'selected="selected"':'' ?> >Sartenejas</option>
				<option value="Litoral" <?php echo ($ESTUDIANTE['estudiante_sede']=='Litoral')?'selected="selected"':'' ?> >Litoral</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">C&eacute;dula:</div></td>
		<td colspan="2" class="parrafo"><input type="text" name="ci" value="<?php echo $ESTUDIANTE['ci']?>"></td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Carrera:</div></td>
		<td colspan="2">
			<select name="carrera" style="width:200px;">
				<option value="">Todas</option>
				<?php foreach($LISTA_CARRERA as $value): ?>
				<option value="<?php echo $value['codigo'] ?>" <?php echo ($ESTUDIANTE['carrera']==$value['codigo'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Email Secundario:</div></td>
		<td colspan="2" class="parrafo"><input type="text" name="email_sec" value="<?php echo $ESTUDIANTE['email_sec']?>">Ej: ejemplo@correo.com</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Tlf Hab:</div></td>
		<td colspan="2" class="parrafo"><input type="text" name="telf_hab" value="<?php echo $ESTUDIANTE['telf_hab']?>" maxlength=14>Ej: (0212)123-1234</td>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Tlf Celular:</div></td>
		<td colspan="2" class="parrafo"><input type="text" name="telf_cel" value="<?php echo $ESTUDIANTE['telf_cel']?>"  maxlength=14>Ej: (0412)123-1234</td>
	</tr>
	<tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Direcci&oacute;n:</div></td>
			<td colspan="2" class="parrafo">
				<textarea name="direccion" style="width:194px; height:80px;"><?php echo $ESTUDIANTE['direccion']?></textarea>
		</tr>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="parrafo"><div align="right">Sexo:</div></td>
		<td colspan="2">
			<select name="sexo">
				<option value="">Seleccione...</option>
				<option value="M" <?php echo ($ESTUDIANTE['sexo']=='M')?'selected="selected"':'' ?>>Masculino</option>
				<option value="F" <?php echo ($ESTUDIANTE['sexo']=='F')?'selected="selected"':'' ?>>Femenino</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="4" valign="top" class="parrafo">
			<div align="center">
			<input type="hidden" name="accion" value="actualizar_estudiante" />
			<input type="hidden" name="usbid" value="<?php echo $ESTUDIANTE['usbid'] ?>" />
			<input type="image" src="imagenes/iconos/apply2.jpg" />
			</div>
		</td>
	</tr>
    </table>
</form>
<?php endif; ?>

<pre><?php // print_r($ESTUDIANTE) ?></pre>

<?php include_once('vFooter.php'); ?>
