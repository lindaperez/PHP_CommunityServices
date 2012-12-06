<?
session_start();
require "cAutorizacion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listar Estudiantes por &Aacute;rea y Carreras - SERVICIO COMUNITARIO</title>

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
	ESTUDIANTES POR AREAS DE PROYECTO</span>
    <br /><br />
   <p style="color:#06F"><b>Introduzca las fechas sobre las que desea emitir el reporte.</b><br />
	<br /> 
<table>
<tr>

<form id="rango_fechas" name="rango_fechas" method="post" action="vListarEstudiantesArea.php">    
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
	$_SESSION[desde] = $_POST[desde];
	$_SESSION[hasta] = $_POST[hasta];
	include "cListarEstudiantesArea.php";
?>
    <br /><br />
	  <table width="100%" border="0" cellpadding="5" class="parrafo">
		<tr>
			<td valign="top" align="center" width="15%"><strong>SIGLAS AREA</strong></td>
			<td valign="top" align="center" width="30%"><strong>NOMBRE AREA</strong></td>
			<td valign="top" align="center" width="15%"><strong>ESTUDIANTES INSCRITOS</strong></td>
            <td valign="top" align="center" width="40%"><strong>CARRERA</strong></td>
		</tr>
<?
	$data=array();
	$fila=array();
	
	for ($i=0;$i<$_SESSION[max_rows];$i++){
?>
	<tr>
		<td valign="top" align="center"><strong><? $a_siglas = $_SESSION[areas][siglas][$i]; echo $a_siglas; ?></strong></td>
		<td valign="top" align="center"><? $a_nombre = $_SESSION[areas][nombre][$i]; echo $a_nombre; ?></td>
		<td valign="top" align="center"><? $nro_estudiantes = 0 + $_SESSION[areas][nro_estudiantes][$i]; echo $nro_estudiantes; ?></td>
        <td valign="top" align="center"><? $carrera = $_SESSION[areas][carrera][$i]; echo $carrera; ?></td>
 </tr>
<? /* Al sumar cero en los valores anteriores, se setea el tipo de dato como entero.
    * De esta manera al crear el .xls, Excel reconoce el tipo de datos y muestra los valores alineados.
	*/

//se arma el arreglo que se le pasará al script que crea el archivo en excel
		$fila=array("SIGLAS AREA" => $a_siglas,
				"NOMBRE AREA" => $a_nombre, 
				"ESTUDIANTES INSCRITOS" => $nro_estudiantes,
				"CARRERA" => $carrera);
		array_push($data, $fila);
	}//cierra el for
		
    $_SESSION[data]=$data;
	echo "<a href='cCrearExcel.php?nombre=ListaEstudiantesArea'>".mostrarImagen('excel')."</a><br><br>"
	?>
      </table>
 <? } ?>     
<br /><br />      
   </td>
  </tr>
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
