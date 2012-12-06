<?
require "cAutorizacion.php";

if  (!isEmpleadoCCTDS()){
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted no est&aacute; autorizado para ver esta p&aacute;gina</span></center>";
	exit();
}

include_once("vHeader.php");

?>
<script type="text/javascript" language="javascript" src="cVerifMiembroUSB.js"></script>
<form name="datos" action="cAgregarMiembroUSB.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td colspan="4"><p align="center" class="titular_negro"><strong>Agregar Miembro USB</strong><br />
						 
						  <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
						  <span class="buscador"><strong>Fecha: <? echo date('d-m-Y'); ?></strong></span></p>
					</td>
				</tr>

				<tr>
					<td colspan="2" class="parrafo">
					<strong style="color:#06F">Por favor, especifique los siguientes datos:</strong>
					<br />
					<table width="100%" border="0" cellpadding="0">
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Nombre: </div></td>
					  <td><input name="nombre" type="text" class="parrafo" id="nombre" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Apellido: </div></td>
					  <td><input name="apellido" type="text" class="parrafo" id="apellido" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)USBID: </div></td>
					  <td><input name="usbid" type="text" class="parrafo" id="usbid" />
					  @usb.ve</td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)C&eacute;dula: </div></td>
					  <td><input name="ci" type="text" class="parrafo" id="ci" /></td>
					</tr>
					<tr>
					  <td><div align="right">Tipo: </div></td>
					  <td>
						<select name="tipo" class="parrafo" id="tipo">
							<option value="">-- seleccione --</option>
							<option value="pregrado">Estudiante</option>
							<option value="administrativos">Empleado</option>
							<option value="profesores">Profesor</option>
						</select>
					  </td>
					</tr>

<!-- OPCIONES PARA EMPLEADOS Y/O PROFESORES -->
					<tr>
					  <td colspan="2" style="color:#06F"><strong><br />Si es empleado o profesor: </strong></td>
					  </tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Dependencia: </div></td>
					  <td><select name="dep" class="parrafo" id="dep">
					<option value=''>-- seleccione --</option>
					<?
					$texto=armar_dependencias($conexion);
					echo $texto;
					?></select>
					</td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Email secundario: </div></td>
					  <td><input name="email_sec" type="text" class="parrafo" id="email_sec" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Tel&eacute;fono celular: </div></td>
					  <td><input name="cel" type="text" class="parrafo" id="cel" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Tel&eacute;fono ofic: </div></td>
					  <td><input name="tlf_ofic" type="text" class="parrafo" id="tlf_ofic" /></td>
					</tr>
					
					<tr>
					  <td colspan="2" style="color:#06F"><strong><br />Si es estudiante: </strong></td>
					  </tr>
					<tr>

<!-- OPCIONES PARA ESTUDIANTES -->
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Carrera: </div></td>
					<td><select name="carrera" class="parrafo" id="carrera">
					<option value=''>-- seleccione --</option>
					<?
					$texto=armar_carreras($conexion);
					echo $texto;
					?></select>
					</td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Sexo: </div></td>
					  <td><select name="sexo" class="parrafo" id="dependencia">
						<option value="">-- seleccione --</option>
						<option value="F">Femenino</option>
						<option value="M">Masculino</option>
						</select></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Tel&eacute;fono hab: </div></td>
					  <td><input name="tlf_hab" type="text" class="parrafo" id="tlf_hab" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Tel&eacute;fono celular: </div></td>
					  <td><input name="cel_est" type="text" class="parrafo" id="cel_est" /></td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Email secundario: </div></td>
					  <td><input name="email_sec_est" type="text" class="parrafo" id="email_sec_est" /></td>
					</tr>

				</table>
				  </td>
				</tr>			
				<tr>
					<td colspan="4" valign="top" class="parrafo"><div align="center">
					<a href='javascript: verificar()'><?=mostrarImagen('enviar');?></a>
					</div></td>
				</tr>
			
				</table>
			</td>
		</tr>
	</table>
</form>

<?php include_once('vFooter.php'); ?>
