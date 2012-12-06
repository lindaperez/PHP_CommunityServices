<?php
require "cAutorizacion.php";
require "cMensajesCorreos.php";

if (!isEmpleadoCCTDS()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

// Controlador de esta vista
require_once("cBuscarProyecto.php");

$TITLE = 'Env&iacute;o masivo de correos';
include_once("vHeader.php");
include_once("cMensajesCorreos.php");
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

<form name="correos" action="cEnvioCorreo.php" method="post" enctype="multipart/form-data">
	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="4"><p align="center" class="titular_negro"><strong>ENV&Iacute;O MASIVO DE CORREOS</strong><br />
                <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
            </tr>
            <tr>
                <td colspan="4"  valign="top" class="parrafo"><p><strong><span class="rojo">*</span> Lista de destinatarios: </strong></p>
                Ingresar un destinatario por l&iacute;nea, sin agregar espacios ni comas.</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2" class="parrafo"><textarea name="dest" cols="50" rows="6" class="parrafo" id="dest"><?php if (isset($_POST['dest'])) echo break_line($_POST['dest'])  ;?></textarea><br><br></td>
            </tr>
            <tr>
                <td colspan="4" valign="top" class="parrafo"><strong><span class="rojo">*</span>Asunto del correo: </strong></p></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2" class="parrafo"><textarea name="asun" cols="50" rows="2" class="parrafo" id="asun"><?php if (isset($_POST['asun'])) echo break_line($_POST['asun']) ; ?></textarea><br><br></td>
            </tr>
            <tr>
                <td colspan="4" valign="top" class="parrafo"><strong><span class="rojo">*</span>Contenido del correo: </strong></p></td>
                <td><?php '&nbsp;&nbsp;&nbsp;'?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2" class="parrafo"><textarea name="cont" cols="50" rows="8" class="parrafo" id="cont"><?php if (isset($_POST['cont'])) echo break_line($_POST['cont']) ; else echo break_line($firma); ?></textarea><br><br></td>
            </tr>
            
            
            <tr>
                <td colspan="4" valign="top" class="parrafo">
                    <div align="center">
                        <input type="hidden" name="accion" value="envio_correo" />
                    
                        <input type="image" src="imagenes/iconos/apply2.jpg" />
                    </div>
                </td>
            </tr>
            
        </table>
</form>




<?php include_once('vFooter.php'); ?>