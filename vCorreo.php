<?php
$TITLE = 'Correo';

session_start();
require_once "cAutorizacion.php";


if ($_GET["action"]=="logout"){
header("Location: salir.php");}	

if  (!isEmpleadoCCTDS()){
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted no est&aacute; autorizado para ver esta p&aacute;gina</span></center>";
	exit();
}

include_once("vHeader.php");

?>
<script type="text/javascript" language="javascript" src="cVerifResp.js"></script>
<FORM name="datos" action="cPreCorreo.php" method="post" enctype="multipart/form-data">
 <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td colspan="4"><p align="center" class="titular_negro"><strong>Respaldo del Sistema</strong><br />
						 
						  <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
						  <span class="buscador"><strong>Fecha: <?php echo date('d-m-Y'); ?></strong></span></p>
					</td>
				</tr>

				<tr>
					<td colspan="2" class="parrafo">
					<strong style="color:#06F">Por favor, especifique los siguientes datos:</strong>
					<br />
					<table width="100%" border="0" cellpadding="0">
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Frecuencia: </div></td>
					  <td><select name="frecuencia" class="parrafo" id="frecuencia">
						<option value="">-- seleccione --</option>
						<option value="1">Diario</option>
						<option value="7">Semanal</option>
						<option value="28">Mensual</option>
						<option value="364">Anual</option></select>
					  </td>
					</tr>
					<tr>
					  <td><div align="right">(<span class="rojo">*</span>)Correo: </div></td>
					  <td><INPUT type="email" name="email_to" class="parrafo" id="email_to" /></td>
					</tr>
					
					<tr>
					<td colspan="4" valign="top" class="parrafo"><div align="center">
					<a href='javascript: verificar()'><?php echo mostrarImagen('enviar');?></a>
					</div></td>
					</tr>
					
					</table>
					</td>
				</tr>			
				
			
			</table>
		</td>
	</tr>
</table>
</FORM>
 
 
<?php include_once('vFooter.php'); ?>
