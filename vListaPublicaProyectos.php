<?
require "cConstantes.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista Publica de Proyectos - SERVICIO COMUNITARIO</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
<td height="184" valign="bottom" style ="background-image:url(imagenes/top.jpg); background-repeat:no-repeat;">
</td>
 </tr>
    
  <tr>
    <td valign="top" class="parrafo">
	<center><span class="titular_negro"><br />
	LISTA P&Uacute;BLICA DE PROYECTOS DE SERVICIO COMUNITARIO</span>
	<br />
    </center>
   <p class="parrafo" align="center">
	A continuaci&oacute;n se listan los Proyectos de Servicio Comunitario aprobados hasta el momento. Si desea realizar su Servicio Comunitario en alguno de esos proyectos, contacte al Tutor que se especifica en el mismo para averiguar la posibilidad de participar en &eacute;l.

<br /> <br />  </p>

<p align="left">
Actualmente, se cuenta con las siguientes &Aacute;reas de Proyecto:
<ul>
<?
		include "cListaPublicaProyectos.php";
		
		for ($j=0;$j<$_SESSION[max_area];$j++){
			$area=$_SESSION[nombre_area][$j];
			echo "<li><a href='#".strtoupper($area)."'>".strtoupper($area)."</a></li>";
		}
?>
    </ul></p>

	<?
	if ($_SESSION[max_proy]==0){
		echo "<br><br>Hasta el momento no hay proyectos aprobados.<br><br>";
	}
	else{
			?>  
			<table width="100%" border="0" cellpadding="2" cellspacing="2" class="parrafo">
			<?
				$area_actual="";
				$area_anterior="";
				$proy_actual="";
				$proy_anterior="";
				for ($i=0;$i<$_SESSION[max_proy];$i++){
					$area_actual=$_SESSION[proyecto][area][$i];
					if ($area_anterior<>$area_actual) {			
						?>
							<tr>
								<td colspan="3" style="color:#06F; font-size:12px" align="center"><? echo "<br><br><br><b><a name='".strtoupper($area_actual)."'>".strtoupper($area_actual)."</a></b>"; ?>
								</td>
							</tr>
						<?
					} //cierra el if anterior<>actual
					$area_anterior=$area_actual;

			?>
			<tr>
				   <td valign="top" nowrap><strong><?=$_SESSION[proyecto][codigo][$i]?></strong></td>
				   <td valign="top">
					<? 
					echo $_SESSION[proyecto][titulo][$i];

					?></td>
				   <td style="font-size:10px">
					<?
					echo "<a href='vVerProyecto.php?id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('ver')."</a>";
					?>
					</td>
			 </tr>
			 <tr>
			 	 <td>&nbsp;</td>
				   <td valign="top" colspan=3><? 

					if ($_SESSION[proyecto][maxtutores][$i] > 1) { 
				 		echo "<strong>Tutores: </strong>";
					}
				 	else { 
				 		echo "<strong>Tutor: </strong>";
					}	

					echo $_SESSION[proyecto][tutores][$i];

					?><br><br></td>
				   
			 </tr>
		<?
			}//cierra el for max_proy
		?>
      </table>
<?
	}//cierra el else
?>

</td>
</tr>
<tr><td colspan="3" align="center">
<?
echo "<br>Total de Proyectos Vigentes: ".$_SESSION[max_proyectos]."<br><br>";
?>
<!--
<a href='index.php'><?=mostrarImagen('volver');?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='scriptcas.php'><?=mostrarImagen('login');?></a>
-->
</td>
</tr>
  <tr>
    <td valign="top"><? include "vBottom.php"; ?></td>
  </tr>
</table>
<?
	session_unset();
	session_destroy();
?>
</body>
</html>
