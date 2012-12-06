<?
require "cAutorizacion.php";
$modo_depuracion=false;

$desde = $_SESSION[desde];
$hasta = $_SESSION[hasta];

	$sql1=" SELECT EC.usbid_estudiante AS carnet, EC.horas AS horas, EC.fecha_culminacion AS fecha, 
			U.nombre AS nombre, U.apellido AS apellido, E.carrera AS carrera 
			FROM estudiantes_culminados EC, usuario U, usuario_estudiante E 
			WHERE EC.usbid_estudiante = U.usbid 
			AND EC.usbid_estudiante = E.usbid_usuario 
			AND EC.fecha_culminacion BETWEEN '$desde' AND '$hasta';";
	
	if ($modo_depuracion) echo "$sql1<br>";
	
	$resultado1=ejecutarConsulta($sql1, $conexion);
	
	$html = "<html><title><head></head></title><body><table width=\"500\" align=\"center\" border=\"0\"><tr><td align=\"center\">";
	$html .= "<img src=\"imagenes/top.jpg\" width=\"500\" height=\"184\"></td></tr>";
	$html .= "<tr><td align=\"center\"><br><br><h2>ESTUDIANTES CULMINADOS EN PROYECTOS DE SERVICIO COMUNITARIO <br> (Reporte para DACE)</h2><br></td></tr></table>";
	$html .= "<br><table width=\"500\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"6\" style=\"font-size:10px\"><center>";
	?>
	
    <table border="0" cellpadding="4" cellspacing="8" style="font-size:11px">
    <tr>
    	<td align="center" style="color:#06F; font-size:12px"><b> Carnet </b></td>
       	<td align="center" style="color:#06F; font-size:12px"><b> Nombre y Apellido </b></td>
      	<td align="center" style="color:#06F; font-size:12px"><b> Carrera </b></td>
    	<td align="center" style="color:#06F; font-size:12px"><b> Fecha de Culminaci&oacute;n </b></td>
        <td align="center" style="color:#06F; font-size:12px"><b> Cumplimiento </b></td>
    </tr>
	   
	<?
	$html .= "<tr>
    	<td align=center> Carnet </td>
       	<td align=center> Nombre y Apellido </td>
      	<td align=center> Carrera </td>
    	<td align=center> Fecha Culminacion </td>
		<td align=center> Cumplimiento </td>
        </tr>";
		
			while($res=obtenerResultados($resultado1)){
				$this_loop = "<tr><td align=center>".$res[carnet]."</td>";
				$this_loop .= "<td align=center>".$res[nombre]." ".$res[apellido]."</td>";
				$this_loop .= "<td align=center>".$res[carrera]."</td>";
				$this_loop .= "<td align=center>".$res[fecha]."</td>";
				$this_loop .= "<td align=center>".$res[horas]." horas</td></tr>";
			
				$html .= $this_loop;
				echo $this_loop;
			}
	
	?>
    </table>
    <br />
<?
    $html .= "</table></center></body></html>";
	$_SESSION[html] = $html;
	
	cerrarConexion($conexion);
?>