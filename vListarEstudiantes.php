<?
require "cAutorizacion.php";
if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Listar Estudiantes que culminaron - SERVICIO COMUNITARIO</title>

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
	LISTA DE ESTUDIANTES QUE CULMINARON EL PROYECTO DE SERVICIO COMUNITARIO</span><br />
	<br />
	<?
	include "cListarEstudiantes.php";
	if ($_SESSION[max_estudiantes]==0){
		echo "<br><br>Hasta el momento en el sistema no hay estudiantes que hayan culminado proyectos.<br><br>";	
	} else{
	?>  
	  <table width="100%" border="0" cellpadding="5" class="parrafo">
		<tr>
			<td valign="top"><strong>Nro</strong></td>
			<td valign="top"><strong>CARNET</strong></td>
			<td valign="top"><strong>APELLIDO Y NOMBRE</strong></td>
			<td valign="top"><strong>CARRERA</strong></td>
			<td valign="top"><strong>CODIGO PROYECTO</strong></td>
			<td valign="top"><strong>PERIODO</strong></td>
		</tr>
	<?
		$data=array();
		$fila=array();

		for ($i=0;$i<$_SESSION[max_estudiantes];$i++){
		$j=$i+1;
	?>
		<tr>
		<td valign="top"><?=$j?></td>
		<td valign="top"><? echo $_SESSION[estudiantes][carnet][$i];	?></td>
		<td valign="top"><? 	$nombre=$_SESSION[estudiantes][apellido][$i]." ".$_SESSION[estudiantes][nombre][$i];
					echo $nombre;	?></td>
		<td valign="top"><? echo $_SESSION[estudiantes][carrera][$i];	?></td>
		<td valign="top"><? echo $_SESSION[estudiantes][codigo][$i];	?></td>
		<td valign="top"><? $periodo=$_SESSION[estudiantes][periodo][$i]." ".$_SESSION[estudiantes][anio][$i];
					echo $periodo; ?></td>
		</tr>
		<?
		$fila=array(	"Num" => $j, 
				"Carnet" => $_SESSION[estudiantes][carnet][$i], 
				"Apellido y Nombre" => $nombre,
				"Carrera" => $_SESSION[estudiantes][carrera][$i],
				"Codigo Proyecto" => $_SESSION[estudiantes][codigo][$i],
				"Periodo" => $periodo);
		array_push($data, $fila);
		}//cierra el for

		$_SESSION[data]=$data;
		echo "<a href='cCrearExcel.php?nombre=ListaEstudiantes'>".mostrarImagen('excel')."</a>"
		?>
		</table>
	  <?
	  }//cierra el else
	  ?>    </td>
  </tr>
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
