<?
require "cAutorizacion.php";
$modo_depuracion=false;

$desde = $_SESSION[desde];
$hasta = $_SESSION[hasta];

	$sql1="select * from carrera order by codigo asc";
	$sql2="select * from area_proyecto order by siglas asc";
	
	if ($modo_depuracion) echo "$sql1<br>$sql2";
	
	$resultado1=ejecutarConsulta($sql1, $conexion);
	$resultado2=ejecutarConsulta($sql2, $conexion);
	
	$carreras=$areas=array();
	$i=$j=0;
	
	while($carrera=obtenerResultados($resultado1)) {
    	$nombres_carreras[$i]=$carrera[nombre];
		$codigos_carreras[$i]=$carrera[codigo];
		$i++;
	}
	
	while($area=obtenerResultados($resultado2)) {
    	$areas_nombres[$j]=$area[nombre];
		$areas_siglas[$j]=$area[siglas];
		$areas_id[$j]=$area[id];
    	$j++;
	}
	
	$html = "<html><title><head></head></title><body><table width=\"500\" align=\"center\" border=\"0\"><tr><td align=\"center\">";
	$html .= "<img src=\"imagenes/top.jpg\" width=\"500\" height=\"184\"></td></tr>";
	$html .= "<tr><td align=\"center\"><br><br><h2>ESTUDIANTES CULMINADOS EN PROYECTOS DE SERVICIO COMUNITARIO (Carreras Vs. Areas)</h2><br>";
	$html .= "<h4>Del: $desde, al: $hasta.</h4></td></tr></table><center>";
	$html .= "<br><table width=\"500\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"6\" style=\"font-size:10px\">";
	?>
	
    <table border="0" cellpadding="4" cellspacing="8" style="font-size:11px">
	<tr>
    	<td width=200 style="color:#06F; font-size:12px" align="center"><b>&Aacute;reas Vs. Carreras<c></td>
	<?
   $html .= "<tr><td width=\"180\" align=\"left\" style=\"color:#06F; font-size:12px\"><b>Carreras Vs. Areas<b></td>";

	for($x=0;$x<$j;$x++){
		$this_loop = "<td width=\"50\" align=\"center\" style=\"color:#06F; font-size:12px\"><b>".$areas_siglas[$x]."</b></td>";
		$html .= $this_loop;
		echo $this_loop;
	}
    $html .= "</tr>";
	?>
	</tr>
    
	<?
	for($y=0;$y<$i;$y++){
		echo "<tr align=left>";
		echo "<td><b>$nombres_carreras[$y]</b></td>";
		$html .= "<tr align=\"left\"><td><b>".$nombres_carreras[$y]."</b></td>";

		for($x=0;$x<$j;$x++){
			$sql3="SELECT COUNT(DISTINCT I.usbid_estudiante) AS nro_est
			   FROM inscripcion I, usuario_estudiante E, proyecto P 
			   WHERE E.usbid_usuario = I.usbid_estudiante 
			   AND I.id_proyecto = P.id 
			   AND E.carrera = $codigos_carreras[$y] 
			   AND fecha_fin_real BETWEEN '$desde' AND '$hasta' 
			   AND P.id_area_proy = $areas_id[$x]
			   AND culminacion_validada = 'SI';";
			$resultado3=ejecutarConsulta($sql3, $conexion);
			$num_est=obtenerResultados($resultado3);
			if ($num_est[nro_est] > 0) {
				$nro_est_X_Y = $num_est[nro_est];
			}
			else {
				$nro_est_X_Y = " 0 ";
			}
		
			$this_loop = "<td align=\"center\">".$nro_est_X_Y."</td>";
			$html .= $this_loop;
			echo $this_loop;
		}
		echo "</tr>";
		$html .= "</tr>";
	}
	
	?>
    </table>
    <br />
    <table>
    <tr><td colspan="2"><strong>Leyenda</strong></td></tr>
    <?
    for($x=0;$x<$j;$x++){
		echo "<tr><td><b>$areas_siglas[$x]</b></td>
				<td>$areas_nombres[$x]</td>
			  </tr>";
	}
	?>
    </table>    
<?
    $html .= "</table></center></body></html>";
	$_SESSION[html] = $html;
	
	cerrarConexion($conexion);
?>



