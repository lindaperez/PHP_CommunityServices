            
<?
require "cAutorizacion.php";
include_once("vHeader.php");
include "cVerEstudiantesProyecto.php";

if  (!isEmpleadoCCTDS()){
	echo "<center><br><br>";
	echo "<span class='parrafo'>Disculpe, usted no está autorizado para ingresar a esta página.</span></center>";

}?>
			<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" class="parrafo" align="center">
					<span class="titular_negro"><br />
					PROYECTO DE SERVICIO COMUNITARIO</span><br />
					
            <?if ($_GET[opcion]=="listar_estudiantes") {    ?>       
						<table width="100%" border="0" cellpadding="5" class="parrafo">
							<tr>
								<?
								if ($_SESSION[max_estudiantes]==0){
									echo "<span class='parrafo'><br><br>Disculpe, el proyecto <strong>".$_SESSION[proyecto][titulo]."</strong> no tiene estudiantes asignados.<br><br></span>";
								} else {
								?>
								
							</tr>
							<tr>
								<td colspan="2"><br><b>PROYECTO: <? echo $_SESSION[proyecto][titulo]; ?></b></td>
							</tr>
							<tr>
								<td align="right">
									<strong>Cantidad Total de Estudiantes:</strong></td>
								<td>
									<? echo "<b>".($_SESSION[proyecto][fem] + $_SESSION[proyecto][masc] + $_SESSION[proyecto][sin_sex])."</b>"; ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<strong>Cantidad de Mujeres:</strong></td><td><? echo $_SESSION[proyecto][fem]; ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<strong>Cantidad de Hombres:</strong> </td><td><? echo $_SESSION[proyecto][masc]; ?>
								</td>
							</tr>
							<tr>
								<td align="right" nowrap>
									<strong>No han definido sexo:</strong> </td><td><? echo $_SESSION[proyecto][sin_sex]; ?>
								</td>
							</tr>
							<tr>
								<td align="right" valign="center"><b>Lista de carreras: </b></td>
								<td>
									<?
										foreach ($_SESSION[proyecto][carreras] as $carrera){
											echo $carrera."<br/>";
										}
									?>
								</td>
							<tr>
								<td colspan="2"><br><b>LISTA DE ESTUDIANTES DEL PROYECTO</b></td>
							</tr>
							<?php for ($i=0;$i<$_SESSION[max_estudiantes];$i++){ ?>
							<tr>
								<td valign="down" align="right">
									Estudiante # <?php echo $i+1 ?>:
								</td>
							<td valign="top">
								<?php
								echo "<b>Nombre y Apellido:</b> ".$_SESSION[proyecto][nombre_est][$i]." ".$_SESSION[proyecto][apellido_est][$i];
								echo "<br/><b>USBID:</b> ".$_SESSION[proyecto][usbid_est][$i];
								echo "<b> Carrera:</b> ".$_SESSION[proyecto][carrera_est][$i];
								echo "<br/><b>E-mail:</b> <a href='mailto:".$_SESSION[proyecto][email_est][$i]."'>".$_SESSION[proyecto][email_est][$i]."</a>";
								echo "<br/><b>Tel&eacute;fono habitaci&oacute;n:</b> ".$_SESSION[proyecto][telf_hab_est][$i];
								echo "<br/><b>Tel&eacute;fono celular:</b> ".$_SESSION[proyecto][telf_cel_est][$i];
								echo "<br/><b>Inscripci&oacute;n aprobada:</b> ";
									if (empty($_SESSION[proyecto][status_insc][$i])) echo "PENDIENTE"; else echo $_SESSION[proyecto][status_insc][$i];
								echo "<br/><b>Servicio comunitario culminado:</b> ";
									if (empty($_SESSION[proyecto][insc_culminada][$i])) echo "EN PROCESO"; else echo $_SESSION[proyecto][insc_culminada][$i];
							?>
							</td>
							</tr>
							<?php } ?>
						</tr>    
					</table>
            <?php } 
		}elseif ($_GET[opcion]=="listar_estudiantesXtutor") {
		
			$proy = "";
			?>
			
			<table width="100%" border="0" cellpadding="5" class="parrafo">
				<tr>
					<tr>
						<td colspan="2"><br><br><br><b>LISTA DE ESTUDIANTES TUTOREADOS POR: <? echo $_GET['tutor']; ?></b></td>
					</tr>
					<?php for ($i=0;$i<$_SESSION[max_estudiantes];$i++){ 
							if($proy != $_SESSION[proyecto][titulo][$i]){								
								?> <tr> 
									<td colspan="2"><br/><b>PROYECTO:</b> <? echo $_SESSION[proyecto][titulo][$i]; ?>
								</tr> <?
								$proy = $_SESSION[proyecto][titulo][$i];
							}					
					?>
					
					<tr>
						<td valign="down" align="right">
							Estudiante # <?php echo $i+1 ?>:
						</td>
					<td valign="top">
						<?php
						echo "<b>Nombre y Apellido:</b> ".$_SESSION[proyecto][nombre_est][$i]." ".$_SESSION[proyecto][apellido_est][$i];
						echo "<br/><b>USBID:</b> ".$_SESSION[proyecto][usbid_est][$i];
						echo "<br/><b> Carrera:</b> ".$_SESSION[proyecto][carrera_est][$i];
						echo "<br/><b>E-mail:</b> <a href='mailto:".$_SESSION[proyecto][email_est][$i]."'>".$_SESSION[proyecto][email_est][$i]."</a>";
						echo "<br/><b>Tel&eacute;fono habitaci&oacute;n:</b> ".$_SESSION[proyecto][telf_hab_est][$i];
						echo "<br/><b>Tel&eacute;fono celular:</b> ".$_SESSION[proyecto][telf_cel_est][$i];
						echo "<br/><b>Inscripci&oacute;n aprobada:</b> ";
							if (empty($_SESSION[proyecto][status_insc][$i])) echo "PENDIENTE"; else echo $_SESSION[proyecto][status_insc][$i];
						echo "<br/><b>Servicio comunitario culminado:</b> ";
							if (empty($_SESSION[proyecto][insc_culminada][$i])) echo "EN PROCESO"; else echo $_SESSION[proyecto][insc_culminada][$i];
					?>
					</td>
					</tr>
					<?php } ?>
				</tr>    
			</table>
		
		<? } ?>
	
					</td>
				</tr>
			</table>
    