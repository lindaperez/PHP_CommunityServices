<?
require "cAutorizacion.php";

$modo_depuracion=false;

$desde = $_SESSION[desde];
$hasta = $_SESSION[hasta];

	$sql1="select * from area_proyecto order by siglas asc";
	$sql2="select distinct tipo from usuario order by tipo desc";
	
	if ($modo_depuracion) echo "$sql1<br>$sql2";
	
	$resultado1=ejecutarConsulta($sql1, $conexion);
	$resultado2=ejecutarConsulta($sql2, $conexion);
	
	$areas=$comunidades=array();
	$i=$j=0;
	
	while($area=obtenerResultados($resultado1)) {
    	$nombres_areas[$i]=$area[nombre];
		$siglas_areas[$i]=$area[siglas];
		$i++;
	}
	
	while($tipo=obtenerResultados($resultado2)) {
    	$tipos[$j]=$tipo[tipo];
    	$j++;
	}
	
	$html = "<html><title><head></head></title><body><table width=\"450\" align=\"center\" border=\"0\"><tr><td align=\"center\">";
	$html .= "<img src=\"imagenes/top.jpg\" width=\"500\" height=\"184\"></td></tr>";
	$html .= "<tr><td align=\"center\"><br><br><h2>PROYECTOS DE SERVICIO COMUNITARIO PROPUESTOS <br> (Areas Vs. Comunidades)</h2><br>";
	$html .= "<h4>Del: $desde, al: $hasta.</h4></td></tr></table><center>";
	$html .= "<br><br><table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:9px\">";
	?>
			
		
    <table width="500" align="center" border="0" cellpadding="4" cellspacing="8" style="font-size:11px">
	<tr>
    	<td width="70" align="center" style="color:#06F; font-size:11px"><b>&Aacute;reas<br>Vs.<br>Comunidades</b></td>
	<?
    $html .= "<tr><td align=\"center\" style=\"color:#06F; font-size:10px\"><b>Areas Vs. Comunidades</b></td>";
	for($x=0;$x<$j;$x++){
		if ($tipos[$x] == 'profesores') $siglas_tipo[$x] = "PROF";
		if ($tipos[$x] == 'pregrado') $siglas_tipo[$x] = "PREG";
		if ($tipos[$x] == 'postgrado') $siglas_tipo[$x] = "POST";
		if ($tipos[$x] == 'empleados') $siglas_tipo[$x] = "EMP";
		if ($tipos[$x] == 'administrativos') $siglas_tipo[$x] = "ADM";
		if ($tipos[$x] == 'organizaciones') $siglas_tipo[$x] = "ORG";
		
		$this_loop = "<td align=\"center\" style=\"color:#06F; font-size:11px\"><b>".$siglas_tipo[$x]."</b></td>";
		$html .= $this_loop;
		echo $this_loop;
	}
    $html .= "</tr>";
	?>
	</tr>
    
	<?
	for($y=0;$y<$i;$y++){
		echo "<tr align=center><td><b>$siglas_areas[$y]</b></td>";
		$html .= "<tr align=\"left\"><td><b>".$siglas_areas[$y]."</b></td>";
		
		for($x=0;$x<$j;$x++){
			$sql3 = "SELECT COUNT(PROY.id) AS nro_proys 
			   FROM proyecto PROY, proponente P, usuario U, area_proyecto AP 
			   WHERE P.id_proyecto = PROY.id 
			   AND U.usbid = P.usbid_usuario 
			   AND U.tipo = '$tipos[$x]' AND PROY.id_area_proy = AP.id 
			   AND AP.siglas = '$siglas_areas[$y]' 
			   AND fecha_ingreso BETWEEN '$desde' AND '$hasta';";
			$resultado3 = ejecutarConsulta($sql3, $conexion);
			
			$num_proys = obtenerResultados($resultado3);
			if ($num_proys[nro_proys] > 0) {
				$nro_proys_X_Y = $num_proys[nro_proys];
			}
			else {
				$nro_proys_X_Y = " 0 ";
			}
		
			$this_loop = "<td align=\"center\">".$nro_proys_X_Y."</td>";
			$html .= $this_loop;
			echo $this_loop;
		}
		echo "</tr>";
		$html .= "</tr>";
	}
	
	$html .= "</table></center></body></html>";
	?>
    
    </table>
    <br />
    <table width="500" align="center">
    <tr><td>
    <table width="250"  align="center">
    <tr><td colspan="2"><strong>Leyenda &Aacute;reas</strong></td></tr>
    <?
    for($x=0;$x<$i;$x++){
		echo "<tr><td><b>$siglas_areas[$x]</b></td>
				<td>$nombres_areas[$x]</td>
			  </tr>";
	}
	?>
    </table> 
    </td>
    <td>
    <table width="250"  align="center">
    <tr><td colspan="2"><strong>Leyenda Comunidades</strong></td></tr>
  	<tr><td><b>ADM</b></td>
		<td>Personal Administrativo</td>
	</tr>
    <tr><td><b>EMP</b></td>
		<td>Empleados</td>
	</tr>
    <tr><td><b>ORG</b></td>
		<td>Organizaciones Estudiantiles</td>
	</tr>
    <tr><td><b>PREG</b></td>
		<td>Estudiantes (Pregrado)</td>
	</tr>
    <tr><td><b>POST</b></td>
		<td>Estudiantes (Postgrado)</td>
	</tr>
    <tr><td><b>PROF</b></td>
		<td>Profesores</td>
	</tr>
    </table></td>
    </tr></table>
<?
	$_SESSION[html] = $html;
	
	cerrarConexion($conexion);
?>