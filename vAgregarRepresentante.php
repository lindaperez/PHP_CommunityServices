<?
require "cAutorizacion.php";

if  (!isEmpleadoCCTDS()){
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted no est&aacute; autorizado para ver esta p&aacute;gina</span></center>";
	exit();
}

include_once("vHeader.php");

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

<form name="datos" action="cAgregarRepresentante.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="5">
				<tr>
                                    <td colspan="4"><p align="center" class="titular_negro"><strong>Agregar Representante</strong><br />	 
                                        <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
                                        <span class="buscador"><strong>Fecha: <? echo date('d-m-Y'); ?></strong></span></p>
                                    </td>
				</tr>
                                <tr>
                                    <td colspan="2" class="parrafo">
                                        <strong style="color:#06F">Por favor, especifique los siguientes datos:</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <table width="100%" border="0" cellpadding="0">
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Apellidos: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_apellidos" type="text" class="parrafo" id="rep_apellidos" value="<?php if (isset($_POST['rep_apellidos'])) echo $_POST['rep_apellidos']  ;?>"/></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Nombres: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_nombres" type="text" class="parrafo" id="rep_nombres" value="<?php if (isset($_POST['rep_nombres'])) echo $_POST['rep_nombres']  ;?>"/></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>C&eacute;dula: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_ci" type="text" class="parrafo" id="rep_ci" value="<?php if (isset($_POST['rep_ci'])) echo $_POST['rep_ci']  ;?>"/> Ej: 12345678</td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Tlf. Celular: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_cel" type="text" class="parrafo" id="rep_cel" value="<?php if (isset($_POST['rep_cel'])) echo $_POST['rep_cel']  ;?>"/> Ej: (0123)456-7890</td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Tlf. Oficina: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_tlf" type="text" class="parrafo" id="rep_tlf" value="<?php if (isset($_POST['rep_tlf'])) echo $_POST['rep_tlf']  ;?>"/> Ej: (0123)456-7890</td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Instituci&oacute;n: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_inst" type="text" class="parrafo" id="rep_inst" value="<?php if (isset($_POST['rep_inst'])) echo $_POST['rep_inst']  ;?>"/></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Direcci&oacute;n: </div></td>
                                        <td colspan="2" class="parrafo"><textarea name="rep_dir" cols="50" rows="8" class="parrafo" id="rep_dir"><?php if (isset($_POST['rep_dir'])) echo break_line($_POST['rep_dir'])  ;?></textarea></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Cargo: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_cargo" type="text" class="parrafo" id="rep_cargo" value="<?php if (isset($_POST['rep_cargo'])) echo $_POST['rep_cargo']  ;?>"/></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Correo Electr&oacute;nico: </div></td>
                                        <td colspan="2" class="parrafo"><input name="rep_email" type="text" class="parrafo" id="rep_email" value="<?php if (isset($_POST['rep_email'])) echo $_POST['rep_email']  ;?>"/> Ej: ejemplo@correo.com</td>
                                        </tr>
                                        </table>
                        	</table>			
				<tr>
                                    <td align="center">
                                        <button type="submit" title="Agregar Representante a la Base de Datos." name="accion" value="agregar_representante" 
                                        style="cursor:pointer; background-color:#ffffff; border:0px; margin:0px;">
                                            <img src="imagenes/iconos/apply2.jpg" width="50" height="50" alt=""/>
                                        </button>
                                    </td>
				</tr>
                                
                        </td>
                    </tr>
	</table>
</form>

<?php include_once('vFooter.php'); ?>
