<?

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=lista_solicitudes_usb.xls");

include "cBuscarProyecto.php";
								
								
?>

<table width="100%" border="0" cellpadding="5" class="parrafo">
	<? 
	if( $ver_usb){?>	
		<? 
		if ($por_estudiante){?>
			<tr>
				<td><b>Nombre</b></td>
				<td><b>Apellido</b></td>
				<td><b>USBID</b></td>
				<td><b>Carrera</b></td>
				<td><b>Proyecto</b></td>
				<td><b>Tutor</b></td>
				<td><b>Fecha Inscripción</b></td>
				<td><b>Estado</b></td>
				<td><b>Correo</b></td>
			</tr>
			<? foreach ($RESULT_ALL_PROYECTOS as $value): ?>
				<?
					$sql = "SELECT * FROM carrera WHERE codigo='".$value['carrera']."'";
					$resultado = ejecutarConsulta($sql, $conexion);
					$row = obtenerResultados($resultado);
					
				
					$sql = "SELECT nombre, apellido FROM usuario_miembro_usb, usuario WHERE usbid_usuario='".$value['tutor']."' AND usbid = usbid_usuario";
					$resultado = ejecutarConsulta($sql, $conexion);
					$row2 = obtenerResultados($resultado);
					
				?>	
				<tr>
					<td><? echo $value['usuario_nombre']; ?></td>
					<td><? echo $value['usuario_apellido']; ?></td>
					<td><? echo $value['usbid_estudiante']; ?></td>
					<td><? echo $row['nombre'] . " (" . $row['codigo'] . ")"; ?></td>
					<td><? echo $value['codigo']; ?></td>
					<td><? echo $row2['nombre']." ".$row2['apellido']; ?></td>
					<td><? echo $value['fecha_inscip']; ?></td>
					<td><? 

							if ($value['culminacion_validada']=="SI"){
								if($value['obs']=="Retirado por el Sistema"){
									echo "Retirado";
								}else{
									echo "Culminado";
								}
							}else{
								if($value['fecha_fin_real']=='0000-00-00'){
									echo "Activo";
								}else{
									echo "Culminado (No validado por la CCTDS)";
								}								
							}
					?></td>
					<td><? echo $value['email_sec']; ?></td>
				</tr>
			<? endforeach; ?>
		<?  
		}elseif ($por_tutor ){
		?>	
			<tr>
				<td><b>Nombre</b></td>
				<td><b>Apellido</b></td>				
				<td><b>USBID</b></td> 
				<td><b>Estudiantes totales que ha tutoreado</b></td>
			</tr>
			<? foreach ($RESULT_ALL_PROYECTOS as $value): ?>
				<?
					// Obtenemos, y listamos, los estudiantes tutoreados
					$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE tutor='".$value['usbid']."'";
					$resultado = ejecutarConsulta($sql, $conexion);
					$row3 = obtenerResultados($resultado);
				?>
							
				<tr>
					<td><? echo $value['usuario_nombre']; ?></td>
					<td><? echo $value['usuario_apellido']; ?></td>
					<td><? echo $value['tutor']; ?></td>						
					<td><? echo $row3['totales']; ?></td>
				</tr>
			<? endforeach; 
		}?>	
	<? }else{ ?>
			<tr>
				<td><b>Codigo</b></td>
				<td><b>Titulo</b></td>				
				<td><b>Tipo</b></td> 
				<? if($por_estudiante OR $por_tutor): ?>
					<td><b>Fecha de Inscripcion</b></td>
				<? endif; ?>				
				<? if($por_tutor): ?>		
					<td><b>Tutor</b></td>
					<td><b>Estudiante</b></td>
				<? endif; ?>
				<td><b>Estudiantes totales que han inscrito el proyecto</b></td>
				<? if($por_estudiante):?>				
					<td><b>Inscrito por</b></td>				
					<td><b>Tutor</b></td>
				<? endif; ?>
			</tr>
			<? foreach ($RESULT_ALL_PROYECTOS as $value): ?>	
				<?
					// Obtenemos, y listamos, los inscritos que ha tenido el proyecto
					$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE id_proyecto='".$value['id']."'";
					$resultado = ejecutarConsulta($sql, $conexion);
					$_result = array();
					while ($row4 = obtenerResultados($resultado)){
						$_result[] = $row4['totales'];
					}
					$inscritos=implode(', ', $_result); 	
				?>			
				<tr>
					<td>
					<? 
						if ($value['codigo']<>"") {
							echo $value['codigo'];
							$aprobado=true;
						}
						else{ 
							echo "C&oacute;digo no asignado"; 
							$aprobado=false;
						}
					?>
					</td>
					<td><? echo $value['titulo']; ?></td>
					<td><? if ($aprobado) echo $value['tipo']; else echo "No asignado"; ?></td>	
					
					<? if($por_estudiante OR $por_tutor): ?>
						<td><? echo $value['fecha_inscip']; ?></td>
					<? endif; ?>					
					
					<? if($por_tutor): ?>						
						<td><? echo $value['usuario_nombre'] ?> <? echo $value['usuario_apellido'] ?> (<? echo $value['usbid']; ?>)</td>
						<?
							$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE u.usbid='".$value['usbid_estudiante']."'";
							$resultado = ejecutarConsulta($sql, $conexion);
							$_result = array();
							while ($row = obtenerResultados($resultado)){
								$_result[] = $row['nombre'].' '.$row['apellido'];
							}
						?>
						<td><? echo implode(', ', $_result); ?></td>
					<? endif; ?>					
					
					<td><? echo $inscritos; ?></td>
					
					<? if($por_estudiante):?>
						<td><? echo $value['usuario_nombre'] ?><? echo $value['usuario_apellido'] ?> (<? echo $value['usbid']; ?>)</td>
						<td><? echo $value['tutor']; ?></td>
					<? endif?>					
										
				</tr>
			<? endforeach; ?>
	<? } ?>
</table>

