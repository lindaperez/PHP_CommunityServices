<?
session_start();
require "cAutorizacion.php";
include "cNotificarCulminacion.php";
//include_once("cVerifInscrito.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Notificar Culminacion - SERVICIO COMUNITARIO</title>
<?php include_once("vHeader.php"); ?>
<script language="javascript" src="cVerifCulminacion.js"></script>
</head>


<body>
    
    
<?php 
if ($_SESSION[tipo]=="pregrado" and isset($_SESSION['inscrito'])  and $_SESSION[fecha_culminado]!="0000-00-00") {
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted ya notific&oacute; la culminaci&oacute;n de un proyecto. Si desea cambiarse de Proyecto debe acudir a la CCTDS</span></center>";

}else{    
?>    
    
<form name="datos" action="cAgregarNotificacion.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
        <td colspan="4"><p align="center" class="titular_negro">
              <strong>NOTIFICACI&Oacute;N DE CULMINACI&Oacute;N DE PROYECTO DE SERVICIO COMUNITARIO</strong><br />
              <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br />
               </p></td>
        </tr>
      <tr>
	<input type="hidden" name="id" value="<?=$_GET[id]?>" />
        <td colspan="2" class="parrafo"><div align="right"><b>Fecha</b></div></td>
        <td colspan="2" class="parrafo"><? echo date('d-m-Y'); ?></td>
      </tr>
      <tr>
        <td colspan="4"><p class="parrafo"><strong>DATOS DEL PROYECTO</strong></p></td>
        </tr>
      <tr>
        <td colspan="2" valign="top" class="parrafo"><div align="right">
		C&oacute;digo:</div>
	</td>
        <td colspan="2" class="parrafo">
		<?=$_SESSION[proyecto][codigo]?>
	</td>
      </tr>
	<tr>
        <td colspan="2" valign="top" class="parrafo"><div align="right">
		T&iacute;tulo:</div>
	</td>
        <td colspan="2" class="parrafo">
		<?=$_SESSION[proyecto][titulo]?><br><br>
	</td>
      </tr>
	<tr>
        <td colspan="2" valign="top" class="parrafo"><div align="right">
		<strong>Horas Acumuladas:</strong></div>
	</td>
        <td colspan="2" class="parrafo">
		<select name="horas">
		<?
		for ($i=30;$i<=120;$i++){
			echo "<option value=$i>$i</option>";
		}
		?>
		</select>
	</td>
      </tr>

      <tr>
        <td colspan="2" valign="top" align="right" class="parrafo"><strong><span class="rojo">*</span>INFORME FINAL </strong>
	</td>
        <td colspan="2" class="parrafo" valign="">
		<input name="informe" type="file" class="parrafo" id="informe" /><br><br>
                  <div align="justify">
                    <span class="buscador">- El informe debe contener todos los puntos establecidos en la plantilla para trabajo final (<a href="ANEXO_5_Plantilla_para_trabajo_final.doc">ANEXO 5</a>). El archivo debe estar en formato PDF y <b>no ocupar m&aacute;s de 2MB.</b> <br><br>
	- Recuerde que el proyecto no se considera culminado hasta que no consigne la planilla de certificaci&oacute;n de cumplimiento (<a href="ANEXO 6_CERTIFICACION_del_servicio_comunitario.doc">ANEXO 6</a>) ante la Coordinaci&oacute;n de Cooperaci&oacute;n T&eacute;cnica y Desarrollo Social.
	</span>
                  </div>
                  <br>
	</td>
      </tr>


      <tr>
        <td colspan="4" valign="top" class="parrafo"><div align="center">
        <a href='javascript: verificar()'><?=mostrarImagen('enviar');?></a>

		
        </div></td>
        </tr>
    </table>    </td>

</form>
</body>
</html>

<?php 
}
include_once('vFooter.php');
?>
