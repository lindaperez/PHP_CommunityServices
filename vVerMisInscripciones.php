<?
require "cAutorizacion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mis Inscripciones en Proyectos - SERVICIO COMUNITARIO</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
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
	PROYECTOS DE SERVICIO COMUNITARIO EN LOS QUE ESTOY INSCRITO(A)</span><br /><br /><br />
    
    <?
	include "cVerMisInscripciones.php";
	if ($_SESSION[max_proyecto_inscrito]==0){
		echo "<br>Hasta el momento usted no est&aacute; inscrito(a) en ning&uacute;n proyecto<br>";		
	}
	else{
	?>  
	<table width="100%" border="0" cellpadding="5" class="parrafo">
        <tr>
        <th> C&Oacute;DIGO DEL PROYECTO</th>
        <TH> NOMBRE DEL PROYECTO</TH>
        <TH> FUNCIONES</TH>
        </tr>
    <?  
		for ($i=0;$i<$_SESSION[max_proyecto_inscrito];$i++){
	?>
			<tr><td> <?=$_SESSION[proyecto_inscrito][codigo][$i]?></td>
				<td> <?=$_SESSION[proyecto_inscrito][titulo][$i]?></td>
				<td align="center"><a href="vVerProyecto.php?id=<?=$_SESSION[proyecto_inscrito][id][$i]?>"><? echo mostrarImagen("ver"); ?></a>
<!--            &nbsp;&nbsp;
                <a href="cCrearPlanillaI.php?id=<? //=$_SESSION[proyecto_inscrito][id_insc][$i]?>"><? //echo mostrarImagen('imprimir'); ?></a> 
-->
                &nbsp;&nbsp;
          <?   if ($_SESSION['proyecto_inscrito']['aprobado'][$i]=='SI'){
				echo "<a href='vNotificarCulminacion.php?id=".$_SESSION[proyecto_inscrito][id_insc][$i]."'>".mostrarImagen('notificar')."";
			}else{
				echo "<span class='direccion'>Su inscripci&oacute;n a&uacute;n no ha sido aprobada por la CCTDS.</span>";
				}
				// print_r($_SESSION['proyecto_inscrito']['aprobado'][$i]);
		  ?>
                </td>
			</tr>
    <? } //cierra el for
	} //cierra el else
    ?>
    </table>
    
    </td>
  </tr>
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>
</body>
</html>