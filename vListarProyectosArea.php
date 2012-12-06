<?
require "cAutorizacion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listar Proyectos por &Aacute;rea y Status - SERVICIO COMUNITARIO</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="zapatec/utils/zapatec.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/utils/zpdate.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/zpcal/src/calendar.js" type="text/javascript"></script>
<script language="javascript" src="zapatec/zpcal/lang/calendar-es.js" type="text/javascript"></script>

</head>

<body>
<table width="502" align="center" border="0" cellpadding="0" cellspacing="0">

  <tr>
<td height="184" valign="bottom" style ="background-image:url(imagenes/top.jpg); background-repeat:no-repeat;">
<div align="right"><span class="parrafo">
    <? mostrarDatosUsuario();?>
  </span></div></td>
  </tr>
  <tr>
    <td valign="top" class="parrafo" align="center">
	<span class="titular_negro"><br />
	PROYECTOS DE SERVICIO COMUNITARIO PROPUESTOS<br />(&Aacute;reas Vs. Status)</span>
    <br /><br />
   <p style="color:#06F"><b>Introduzca las fechas sobre las que desea emitir el reporte.</b><br />
	<br /> </p></td></tr></table>
    
<table width="350" align="center">
<tr>
<form id="rango_fechas" name="rango_fechas" method="post" action="vListarProyectosArea.php">    
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
        button            : "triggelkjlkjr1",
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
	$titulo = "SSC_Proyectos_Areas_Status.pdf";
?>
	<a href="cGeneraPDF.php?titulo=<?=$titulo?>" target="_blank"><? echo mostrarImagen("pdf");?> </a></center>
<?
	$_SESSION[desde] = $_POST[desde];
	$_SESSION[hasta] = $_POST[hasta];
	include "cListarProyectosArea.php";
	
	$html = "<html><title><head></head></title><body><table width=\"500\" align=\"center\" border=\"0\"><tr><td align=\"center\">";
	$html .= "<img src=\"imagenes/top.jpg\" width=\"500\" height=\"184\"></td></tr>";
	$html .= "<tr><td align=\"center\"><br><br><h2>PROYECTOS DE SERVICIO COMUNITARIO PROPUESTOS (Areas Vs. Status)</h2><br>";
	$html .= "<h4>Del: $desde, al: $hasta.</h4></td></tr></table><center>";
	$html .= "<br><br><table width=\"500\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"6\" style=\"font-size:10px\">";
	$html .= "
			<tr>
			<td valign=\"top\" align=\"center\" style=\"color:#06F\"><strong>AREA</strong></td>
			<td valign=\"top\" align=\"center\" style=\"color:#06F\"><strong>APROBADOS</strong></td>
			<td valign=\"top\" align=\"center\" style=\"color:#06F\"><strong>POR APROBAR</strong></td>
			<td valign=\"top\" align=\"center\" style=\"color:#06F\"><strong>CONTINUOS</strong></td>
			<td valign=\"top\" align=\"center\" style=\"color:#06F\"><strong>PUNTUALES</strong></td>
			</tr>";
?>
 
 <table width="502" align="center" border="0" cellpadding="5" class="parrafo">
		<tr>
			<td valign="top" align="center" style="color:#06F"><strong>AREA</strong></td>
			<td valign="top" align="center" style="color:#06F"><strong>APROBADOS</strong></td>
			<td valign="top" align="center" style="color:#06F"><strong>POR APROBAR</strong></td>
			<td valign="top" align="center" style="color:#06F"><strong>CONTINUOS</strong></td>
			<td valign="top" align="center" style="color:#06F"><strong>PUNTUALES</strong></td>
		</tr>
<?
	for ($i=0;$i<$_SESSION[max_proy];$i++){
?>
	<tr>
		<td valign="top" align="center"><strong><? $a_siglas = $_SESSION[proyectos][siglas][$i]; echo $a_siglas; ?></strong></td>
		<td valign="top" align="center"><? $p_aprobados = 0 + $_SESSION[proyectos][aprobados][$i]; echo $p_aprobados; ?></td>
		<td valign="top" align="center"><? $p_por_aprobar = 0 + $_SESSION[proyectos][por_aprobar][$i]; echo $p_por_aprobar; ?></td>
		<td valign="top" align="center"><? $p_continuo = 0 + $_SESSION[proyectos][continuo][$i]; echo $p_continuo; ?></td>
		<td valign="top" align="center"><? $p_puntual = 0 + $_SESSION[proyectos][puntual][$i]; echo $p_puntual; ?></td>
        
        

<? 
		if ($p_aprobados > 0) {
				$proy_aprobados = $p_aprobados;
			}
			else {
				$proy_aprobados = " 0 ";
			}
			
		if ($p_por_aprobar > 0) {
				$proy_por_aprobar = $p_por_aprobar;
			}
			else {
				$proy_por_aprobar = " 0 ";
			}
			
		if ($p_continuo > 0) {
				$proy_continuo = $p_continuo;
			}
			else {
				$proy_continuo = " 0 ";
			}
			
		if ($p_puntual > 0) {
				$proy_puntual = $p_puntual;
			}
			else {
				$proy_puntual = " 0 ";
			}
			
	$html .= "
		<tr>
		<td valign=\"top\" align=\"center\"><strong>".$a_siglas."</strong></td>
		<td valign=\"top\" align=\"center\">".$proy_aprobados."</td>
		<td valign=\"top\" align=\"center\">".$proy_por_aprobar."</td>
		<td valign=\"top\" align=\"center\">".$proy_continuo."</td>
		<td valign=\"top\" align=\"center\">".$proy_puntual."</td>";


	/* Al sumar cero en los valores anteriores, se setea el tipo de dato como entero.
    * De esta manera al crear el .xls, Excel reconoce el tipo de datos y muestra los valores alineados.
	*/
		$aprobados+=$_SESSION[proyectos][aprobados][$i];
		$por_aprobar+=$_SESSION[proyectos][por_aprobar][$i];
		$continuo+=$_SESSION[proyectos][continuo][$i];
		$puntual+=$_SESSION[proyectos][puntual][$i];
		?>
        </tr>
    <?
	$html .= "</tr>";
	}//cierra el for
	?>
    
	<tr>
		<td valign="top" align="center"><strong>TOTAL</strong></td>
		<td valign="top" align="center"><strong><?=$aprobados?></strong></td>
		<td valign="top" align="center"><strong><?=$por_aprobar?></strong></td>
		<td valign="top" align="center"><strong><?=$continuo?></strong></td>
		<td valign="top" align="center"><strong><?=$puntual?></strong></td>

        </tr>
</table>

<?
		if ($aprobados > 0) {
				$Aprobados = $aprobados;
			}
			else {
				$Aprobados = " 0 ";
			}
			
		if ($por_aprobar > 0) {
				$PorAprobar = $por_aprobar;
			}
			else {
				$PorAprobar = " 0 ";
			}
			
		if ($continuo > 0) {
				$Continuo = $continuo;
			}
			else {
				$Continuo = " 0 ";
			}
			
		if ($puntual > 0) {
				$Puntual = $puntual;
			}
			else {
				$Puntual = " 0 ";
			}
	$html .= "
		<tr>
		<td valign=\"top\" align=\"center\"><strong>TOTAL</strong></td>
		<td valign=\"top\" align=\"center\"><strong>".$Aprobados."</strong></td>
		<td valign=\"top\" align=\"center\"><strong>".$PorAprobar."</strong></td>
		<td valign=\"top\" align=\"center\"><strong>".$Continuo."</strong></td>
		<td valign=\"top\" align=\"center\"><strong>".$Puntual."</strong></td>
        </tr>";
?>

<br />

<table width="200" align="center">
    <tr><td colspan="2"><strong>Leyenda</strong></td></tr>
    <?
    for($x=0;$x<$_SESSION[max_proy];$x++){
		echo "<tr><td><b>".$_SESSION[proyectos][siglas][$x]."</b></td>
				<td>".$_SESSION[proyectos][nombre][$x]."</td>
			  </tr>";
	}
	?>
</table> 
    
<? 
	$html .= "</table></center></body></html>";
	$_SESSION[html] = $html;
	
	} //cierra el if Aceptar ?> 

<table width="502" align="center">
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
