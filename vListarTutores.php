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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listar Tutores - SERVICIO COMUNITARIO</title>

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
	LISTA DE TUTORES DE PROYECTOS DE SERVICIO COMUNITARIO</span><br />
	<br />
	<?
	include "cListarTutores.php";
	if ($_SESSION[max_tutores]==0){
		echo "<br><br>Hasta el momento no hay inscripciones aprobadas con tutores asignados.<br><br>";	
	} else{
	?>  
	<table width="100%" border="0" cellpadding="5" class="parrafo">
	<tr>
		<td valign="top"><strong>TUTOR</strong></td>
		<td valign="top"><strong>CODIGO</strong></td>
		<td valign="top"><strong>ESTUDIANTE</strong></td>
		<td valign="top"><strong>PERIODO</strong></td>
		<td valign="top"><strong>HORAS</strong></td>
		<td valign="top"><strong>BONO (BsF)</strong></td>
	</tr>
<?
	$data=array();
	$fila=array();
	
	for ($i=0;$i<$_SESSION[max_tutores];$i++){
?>
        <tr>
		<td><? $nombreT=$_SESSION[tutores][nombreT][$i]." ".$_SESSION[tutores][apellidoT][$i];
			echo $nombreT; ?></td>
		<td><? echo $_SESSION[tutores][codigo][$i];?></td>
		<td><? $nombreE=$_SESSION[tutores][nombreE][$i]." ".$_SESSION[tutores][apellidoE][$i]; 
			echo $nombreE; ?></td>
		<td><? $periodo=$_SESSION[tutores][periodo][$i]." ".$_SESSION[tutores][anio][$i];
			echo $periodo; ?></td>
		<td><? echo $_SESSION[tutores][horas][$i];?></td>
		<td><? echo $_SESSION[tutores][bono][$i];?></td>
      	</tr>
<?		//se arma el arreglo que se le pasará al script que crea el archivo en excel
		$fila=array(	"Tutor" => $nombreT,
				"Codigo" => $_SESSION[tutores][codigo][$i], 
				"Estudiante" => $nombreE,
				"Periodo" => $periodo,
				"Horas" => $_SESSION[tutores][horas][$i],
				"Bono (BsF)" => $_SESSION[tutores][bono][$i]);
		array_push($data, $fila);
	}//cierra el for

	$_SESSION[data]=$data;
	echo "<a href='cCrearExcel.php?nombre=ListaTutores'>".mostrarImagen('excel')."</a>"
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
