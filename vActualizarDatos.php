<?php
require "cAutorizacion.php";

$TITLE = 'Actualizar Datos Tutor - SERVICIO COMUNITARIO';
include_once("vHeader.php");

extract($_GET);
$USBID = $_SESSION['USBID'];

$sql = "SELECT * FROM usuario u LEFT JOIN usuario_miembro_usb e ON (u.usbid=e.usbid_usuario) WHERE u.usbid='$USBID'";
$resultado = ejecutarConsulta($sql, $conexion);
$TUTOR = array();
while ($row = obtenerResultados($resultado))
	$TUTOR = $row;

// Listado de dependencias
$sql = "select * FROM dependencia ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
$LISTA_DEPENDENCIAS = array();
while ($row = obtenerResultados($resultado))
        $LISTA_DEPENDENCIAS[] = $row;
if(MY_DEBUG>1) echo "$sql<br />";

$aux=$_GET[dependencia];
$DEPENDENCIA = array();
	$sql ="SELECT * "
			. " FROM dependencia d "
			. " LEFT JOIN usuario_miembro_usb um ON (d.id = um.dependencia) "
			. " WHERE um.usbid_usuario='$USBID' ";
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$DEPENDENCIA = $row;


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

<?php if(empty($TUTOR)): ?>
	<h2>El tutor no existe</h2>
<?php else: ?>
<form name="datos" action="cActualizarDatos.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
	<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td colspan="4"><p align="center" class="titular_negro">
			  <strong>ACTUALIZAR DATOS PERSONALES</strong><br />
			  <span class="buscador"><strong class="rojo">Todos los campos son obligatorios</strong></span> <br />
			   </p></td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">USBID:</div></td>
			<td colspan="2" class="parrafo">
					<?php echo $TUTOR['usbid'] ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Nombre:</div></td>
			<td colspan="2" class="parrafo">
				<?php if( isAdmin() ): ?>
					<input type="text" name="nombre" value="<?php echo $TUTOR['nombre']?>" />
				<?php else: ?>
					<?php echo $TUTOR['nombre'] ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Apellido:</div></td>
			<td colspan="2" class="parrafo">
				<?php if( isAdmin() ): ?>
					<input type="text" name="apellido" value="<?php echo $TUTOR['apellido']?>" />
				<?php else: ?>
					<?php echo $TUTOR['apellido'] ?>
				<?php endif; ?>
			</td>
		</tr>
                    <?php if( isAdmin() ): ?>
                    <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Contrase&ntilde;a:</div></td>
                            <td colspan="2" class="parrafo"><input type="password" AUTOCOMPLETE='OFF' name="password" value="<?php echo $TUTOR['password'] ?>"></td>
                    </tr>
                    <?php endif; ?>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">C&eacute;dula:</div></td>
			<td colspan="2" class="parrafo"><input type="text" name="ci" value="<?php echo $TUTOR['ci'] ?>"></td>
		</tr>
        	<tr>
                        <td colspan="2" valign="top" class="parrafo">
                            <div align="right">(<span class="rojo">*</span>)Dependencia: </div>
                        </td>
                        <td  colspan="2" valign="top" class="parrafo">
                            <select name="dependencia" class="parrafo" id="dependencia">
                                <?php foreach($LISTA_DEPENDENCIAS as $value): ?>
				<option value="<?php echo $value['id'] ?>" <?php echo ($DEPENDENCIA['id']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?> </option>
				<?php endforeach; ?>
                            </select>
                        </td>
               </tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Email Secundario:</div></td>
			<td colspan="2" class="parrafo"><input type="text" name="email_sec" value="<?php echo $TUTOR['email_sec'] ?>">Ej: ejemplo@correo.com</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Tlf Oficina:</div></td>
			<td colspan="2" class="parrafo"><input type="text" name="telf_hab" value="<?php echo $TUTOR['telf'] ?>">Ej: (0212)123-1234</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="parrafo"><div align="right">Tlf Celular:</div></td>
			<td colspan="2" class="parrafo"><input type="text" name="telf_cel" value="<?php echo $TUTOR['celular'] ?>">Ej: (0412)123-1234</td>
		</tr>
		<tr>
			<td colspan="4" valign="top" class="parrafo">
				<div align="center">
					<input type="hidden" name="accion" value="actualizar_tutor" />
					<input type="image" src="imagenes/iconos/apply2.jpg" />
				</div>
			</td>
		</tr>
    </table>
</form>
<?php endif; ?>

<?php include_once('vFooter.php'); ?>
