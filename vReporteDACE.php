<?
require "cAutorizacion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estudiantes Culminados - SERVICIO COMUNITARIO</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="zapatec/utils/zapatec.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/utils/zpdate.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/zpcal/src/calendar.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/zpcal/lang/calendar-es.js" type="text/javascript"></script>
</head>

<body>

<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
<td height="184" valign="bottom" style ="background-image:url(imagenes/top.jpg); background-repeat:no-repeat;">
<div align="right"><span class="parrafo">
    <? mostrarDatosUsuario();?>
  </span></div></td>
  </tr>
  
  <tr>
  <td valign="top" class="parrafo" align="center">
	<span class="titular_negro"><br />
	ESTUDIANTES CULMINADOS EN PROYECTOS DE SERVICIO COMUNITARIO<br />(Reporte para DACE)</span>
<br /><br />
   <p style="color:#06F"><b>Introduzca las fechas sobre las que desea emitir el reporte.</b><br />
<br /> 
<table>
<tr>

<form id="rango_fechas" name="rango_fechas" method="post" action="vReporteDACE.php">    

<td>Desde: <INPUT type="text" name="desde" id="desde" size="10" readonly="readonly"></td>
<td><img src="imagenes/iconos/cal.png" id="trigger1" name="trigger1"/></td>
    <script type="text/javascript">//<![CDATA[
		var cal  = new  Zapatec.Calendar({
        firstDay          : 1,
        lang              : "es",
        theme             : "fancyblue",
        weekNumbers       : false,
        step              : 1,
        range             : [1900.01, 2200.12],
        electric          : false,
        inputField        : "desde",
        button            : "trigger1",
        ifFormat          : "%Y-%m-%d",
        daFormat          : "%Y-%m-%d"
      });
//]]></script>
<td>&nbsp;&nbsp;</td>
<td>Hasta: <input type="text" id="hasta" name="hasta" size="10" readonly="readonly"></td>
<td><img src="imagenes/iconos/cal.png" id="trigger2" name="trigger2"/></td>
    <script type="text/javascript">//<![CDATA[
		var cal  = new  Zapatec.Calendar({
        firstDay          : 1,
        lang              : "es",
        theme             : "fancyblue",
        weekNumbers       : false,
        step              : 1,
        range             : [1900.01, 2200.12],
        electric          : false,
        inputField        : "hasta",
        button            : "trigger2",
        ifFormat          : "%Y-%m-%d",
        daFormat          : "%Y-%m-%d"
      });
//]]></script>
</tr>

<tr>
<td colspan="5" align="center">
<br />
<input type="submit" name="aceptar" id="aceptar" value="Generar Reporte" />
</td>
</form>
</tr>

</table>

<? if (isset($_POST[aceptar])) {
	echo "<br /> <center>";
	$titulo = "SSC_Culminados_(".$_POST[desde].")__(".$_POST[hasta].").pdf";
?>
	<a href="cGeneraPDF.php?titulo=<?=$titulo?>" target="_blank"><? echo mostrarImagen("pdf");?> </a></center>
<?
	$_SESSION[desde] = $_POST[desde];
	$_SESSION[hasta] = $_POST[hasta];
	include "cReporteDACE.php";
?>
 
 <tr>
 </table>   
  <? } ?>   
   </td>
   
  </tr>
  
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
