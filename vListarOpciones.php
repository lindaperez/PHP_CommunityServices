<? 

session_start();
require_once "cAutorizacion.php";

$TITLE = 'Opciones';
require("cListarOpciones.php");
include_once("vHeader.php");


?>

    
	<h2>Opciones</h2>

	<ul id="opciones_admin">
	<?
		//Se muestran las opciones de estudiantes
		if ($_SESSION[tipo]=="pregrado" or $_SESSION[tipo]=="postgrado"){
			include_once("cVerifInscrito.php");

		//	if (isset($_SESSION['inscrito']) and $_SESSION['inscrito']) {
			if (sizeof($_SESSION[cod_proyecto])!=0) {
				?>
				<li class="without_list">
					<br /><b>Proyectos en los que usted est&aacute; involucrado:</b>
				</li>
				<? 
			} ?>
			<li class="without_list parrafo">
			<?

			$anulados = "NO";
			if(sizeof($_SESSION[cod_proyecto])>2 or (sizeof($_SESSION[cod_proyecto])==2 and $_SESSION[alerta_culminado][sizeof($_SESSION[cod_proyecto])-1]=="SI")){
				$anulados = "SI";
				echo" <hr> <span class=rojo>Anulados: Horas invalidadas</span>";
			}
			for ($i=0; $i<sizeof($_SESSION[cod_proyecto]);$i++){
								
				if($anulados=="SI" and $_SESSION[obs][$i]==""){
					echo "<hr>";
					$anulados="NO";
				}
				
				echo "<br><b>".$_SESSION[cod_proyecto][$i]." </b>".
				"<a href='vVerProyecto.php?id=".$_SESSION[id_proyecto][$i]."'>".mostrarImagen('ver')."</a> ".
				"<a href='cCrearPlanillaI.php?id=".$_SESSION[id_inscripcion][$i]."'>".mostrarImagen('imprimir')."</a> ";

				if (in_array($_SESSION[cod_proyecto][$i], $_SESSION[cod_proyecto_culminado])){
					if ($_SESSION[alerta_culminado][$i]=="SI"){
						echo mostrarImagen('notificar_blanco'); 
					}else{
						echo mostrarImagen('alerta'); echo "<span class=rojo >Usted debe pasar por la CCTDS y llevar el documento: </span>";
                                                echo "<a href='cGenerarConstanciaCulm.php?id=".$_SESSION[id_inscripcion][$i]."'>".mostrarImagen('pdf2')."</a>";
					}
				}else{
					if ($_SESSION[proy_aprobado][$i]=="SI"){
						echo "<a href='vNotificarCulminacion.php?id=".$_SESSION[id_inscripcion][$i]."'>".mostrarImagen('notificar')."</a>";
					}
					if ($_SESSION[proy_aprobado][$i]=="SI" || $_SESSION[proy_aprobado][$i]==" "){
						echo "<a href='cGenerarConstanciaIns.php?id=".$_SESSION[id_inscripcion][$i]."'>".mostrarImagen('constancia')."</a>";
echo "<a href='cIntegracion.php'>".mostrarImagen('gsc')."</a>";
					}
					if ($_SESSION[proy_aprobado][$i]=="NO"){
						echo mostrarImagen('alerta'); echo "<span class=rojo >Usted debe pasar por la CCTDS</span>";
					}
					if ($_SESSION[proy_aprobado][$i]==" "){
						echo "<br></br>"
						?>
							<div id="message<? echo 2;?>"><? echo $messages_alerta[1]; ?></div>
							<div id="message<? echo 4;?>"><? echo $messages_alerta[0]; ?></div>
						<? 
					}
					if ($_SESSION[proy_aprobado][$i]=="SI"){
						$dias_restantes = prontaculminacion($conexion,$_SESSION['USBID']);
						if ($dias_restantes){
							?>
								<div id="message<? echo 4;?>"><? echo $messages_alerta[2]." Quedan ".$dias_restantes." d&iacute;a(s)"; ?></div>
							<?
						}
					}
				}

			} //cierra el for
			if($anulados=="SI"){echo "<hr>";}else{echo "<br>";};
			if ($_SESSION[horas]>0) echo "<br>Usted tiene acumuladas $_SESSION[horas] horas";
			?>
			</li>
		<?
//		} //cierra el if inscrito
		?>
<br>
<?
if (isset($_SESSION['inscrito']) and !$_SESSION['inscrito'] and $_SESSION[horas]<120) {
        ?>
            <? if  (periodoInscripcion($conexion)){ ?>
                    <li class="titular_negro"><a href='vListarProyectos.php'><span style='background-color: #FFFF00'>
                                Inscribirme en un proyecto de servicio comunitario</span></a></li>	
            <? } 

             if (isExtemp($_SESSION[USBID])){
		?>
				<li class="parrafo"> <a href='vListarProyectos.php'><b>INSCRIBIRME DE FORMA EXTEMPORANEA</b> en un proyecto</a></li>	
		<?
		}


?>
                    <li class="parrafo"><a href="vVerMisInscripciones.php">Ver los proyectos en los que estoy inscrito(a)</a> </li>
                    <?
                }?>
                <? 
				if  (periodoFormulacion($conexion)){ ?>
                    <li class="parrafo"><a href="vAgregarProyecto.php">Formular un proyecto nuevo</a></li><? 
				} ?>    
                    <li class="parrafo"><a href="vActualizarDatosEstudiante.php">Actualizar Perfil</a></li><?
		//cierra el if pregrado or postgrado
		}elseif (isEmpleadoCCTDS()){    //Se muestran las opciones del administrador
			if (isSecretaria()){
				?>
				<li class="parrafo">
					Opciones Administrativas
					<ul>
						<li class="parrafo"><a href="vAgregarProyecto.php">Formular un proyecto nuevo</a></li>
						<li class="parrafo"><a href="vListarProyectos.php?opcion=por evaluar">Evaluar Proyectos </a></li>
						<li class="parrafo"><a href="vListarInscripciones.php">Evaluar Inscripciones</a> </li>
						<li class="parrafo"><a href="vListarInscripciones.php?opcion=validar_culminacion">Certificar culminaci&oacute;n de servicio</a></li>        
									<li class="parrafo"><a href="vEnvioCorreo.php">Env&iacute;o masivo de correos</a></li>
									<li class="parrafo"><a href="vInscribirProyectoCCTDS.php">Inscribir  estudiante que no est&eacute; registrado</a></li>
									<li class="parrafo"><a href="vActualizarDatos.php">Actualizar Perfil</a></li>
						<li class="parrafo"><a href="vAgregarMiembroUSB.php">Agregar Miembro USB</a></li>
					</ul>
				</li>
				<?
			}
			
			if (isAsistente()){
				?>
				
				<?
			}
			
			//Vista para el caso de ser admin
			if (isAdmin()){		
				//Se muestran los alertas y avisos del sistema-->
				$index=0;
				if(isset($messages_error)):
					foreach($messages_error as $messg): ?>
						<div id="message<? echo $index+1;?>"><? echo $messages_error[$index]; ?></div>
						<? $index++; 
					endforeach; 
				endif;
				$index2=0;
				if(isset($messages)): 
					foreach($messages as $messg): ?>
						<div id="message<? echo $index+1;?>"><? echo $messages[$index2]; ?></div>
						<? $index++; $index2++; 
					endforeach;
				endif;?>
										
				<li class="parrafo">
					Opciones Administrativas
					<ul>
						<li class="parrafo"><a href="vAgregarProyecto2.php">Formular un proyecto nuevo</a></li>
						<? 
						if ($_SESSION[sede]=='Sartenejas'){ ?>
							<li class="parrafo"><a href="vListarProyectos.php?opcion=por evaluar">Evaluar Proyectos </a></li><?
						} ?>
						<li class="parrafo"><a href="vListarInscripciones.php">Evaluar Inscripciones</a> </li>						
						<li class="parrafo"><a href="vListarInscripciones.php?opcion=validar_culminacion">Certificar culminaci&oacute;n de servicio</a></li>
						<!--<li class="parrafo"><b>Consultas</b>
							<ul>
								<li class="parrafo">
									<b>Reportes</b>
									<ul>
										<li class="parrafo"><a href="vListarProyectosArea.php">Proyectos Propuestos por &Aacute;reas y Status</a></li>
										<li class="parrafo"><a href="vListarProyectosComunidades.php">Proyectos Propuestos por &Aacute;reas y Comunidades</a></li>
										<li class="parrafo"><a href="vListarEstAreaCarreras.php">Estudiantes Inscritos por &Aacute;reas y Carreras </a></li>
										<li class="parrafo"><a href="vListarEstAprobadosAC.php">Estudiantes Culminados por &Aacute;reas y Carreras </a></li>
										<li class="parrafo"><a href="vListarEstCarreraCohortes.php">Estudiantes Inscritos por Carreras y Cohortes </a></li>
										<li class="parrafo"><a href="vListarEstAprobadosCC.php">Estudiantes Culminados por Carreras y Cohortes </a></li>
										<li class="parrafo"><a href="vReporteDACE.php">Estudiantes Culminados (Reporte para DACE) </a></li>
									</ul>
								</li>
							</ul>
						</li>
					 -->
						<li class="parrafo"><a href="vEnvioCorreo.php">Env&iacute;o masivo de correos</a></li>
						<li class="parrafo"><a href="vInscribirProyectoCCTDS.php">Inscribir  estudiante que no est&eacute; registrado</a></li>
						<li class="parrafo"><a href="vActualizarDatos.php">Actualizar Perfil</a></li>
						<li class="parrafo"><a href="vAgregarMiembroUSB.php">Agregar Miembro USB</a></li>
						<li class="parrafo"><a href="vBuscarProyecto.php">B&uacute;squedas y Reportes</a></li>
					</ul>
				</li>
				<?        
				if ($_SESSION[sede]=='Sartenejas'){
					?>
					<li class="parrafo">
						Opciones de Mantenimiento
						<ul>
								<li class="parrafo"><a href="vLimpiarComunidades.php">Limpiar tabla de Comunidades</a> </li>
								<li class="parrafo"><a href="vLimpiarRepresentantes.php">Limpiar tabla de Representantes</a> </li>
								<li class="parrafo"><a href="vLimpiarProponentes.php">Limpiar tabla de Proponentes</a> </li>
								<li class="parrafo"><a href="vLimpiarInscripciones.php">Limpiar tabla de Inscripciones</a> </li>
						</ul>
					</li> <? 
				} ?>
				<li class="parrafo">
					Opciones de Configuraci&oacute;n
					<ul><? 
						if ($_SESSION[sede]=='Sartenejas'){ ?>
							<li class="parrafo"><a href="vEstablecerMonto.php">Establecer el monto del bono para tutores</a></li>
							<li class="parrafo"><a href="vEspecificarRoles.php">Especificar Roles</a></li><? 
						}?>
						<li class="parrafo"><a href="vEspecificarFechasTope.php">Especificar Fechas Tope</a></li>
					<li class="parrafo"><a href="vCorreo.php">Respaldo del Sistema</a></li>						
					</ul>
				</li>
				
				<li class="parrafo">
					B&uacute;squedas predefinidas
					<ul>
						<li class="parrafo"><a href="vBuscarProyecto.php?desde=&hasta=&area_proyecto=&comunidad=&representante=&organizacion=&aprobado=SI&culminado=&tipo_proy=CONTINUO&por_proyecto=1&offset=0&items_per_page=50&search=Buscar">Ver lista de proyectos aprobados (Continuos)</a> </li>
						<li class="parrafo"><a href="vBuscarProyecto.php?desde=&hasta=&area_proyecto=&comunidad=&representante=&organizacion=&aprobado=SI&culminado=&tipo_proy=PUNTUAL&por_proyecto=1&offset=0&items_per_page=50&search=Buscar">Ver lista de proyectos aprobados (Puntuales)</a> </li>
						<li class="parrafo"><a href="vBuscarProyecto.php?desde=&hasta=&area_proyecto=&comunidad=&representante=&organizacion=&aprobado=&culminado=SI&tipo_proy=&por_proyecto=1&offset=0&items_per_page=50&search=Buscar">Ver lista de proyectos culminados</a> </li>
						<li class="parrafo"><a href="vBuscarProyecto.php?culminado=SI&est_carnet=&est_cohorte=&est_carrera=&est_email=&est_sexo=&est_nombre=&por_estudiante=1&offset=0&search=Buscar">Ver lista de estudiantes que cumplieron el Servicio Comunitario</a></li>
						<li class="parrafo"><a href="vBuscarProyecto.php?tutor_usbid=&culminado=SI&tutor_dependencia=&tutor_email=&tutor_nombre=&por_tutor=1&offset=0&search=Buscar">Ver lista de tutores de proyectos aprobados</a></li>
					</ul>
				</li><?
			// cierra if de Administradores
			}
		// cierra if de empleadoCCTDS
		}elseif(isCoordinacion()){
			?>
			<li class="parrafo"><a href="vBuscarProyecto.php">B&uacute;squedas y Reportes</a></li>
			<li class="parrafo"><a href="#">Actualizar Datos Personales</a></li>
			<?
		//  <li class="parrafo"><a href="vActualizarDatos.php">Actualizar Datos Personales</a></li>
		}elseif(isDepartamento()){
			?>
			<li class="parrafo"><a href="vBuscarProyecto.php">B&uacute;squedas y Reportes</a></li>
			<li class="parrafo"><a href="#">Actualizar Datos Personales</a></li>	
			<?
		}else{		//Se muestran las opciones de miembros USB
			?>
			<li class="parrafo">
				Opciones para miembros USB
				<ul>
					<li class="parrafo"><a href="vActualizarDatos.php">Actualizar Datos Personales</a></li>
					<li class="parrafo"><a href="vListarProyectos.php?opcion=propios">Ver mis proyectos</a></li>
					<li class="parrafo"><a href="vListarProyectos.php">Ver lista de proyectos aprobados</a></li>
							<? if  (periodoFormulacion($conexion)){ ?>
					<li class="parrafo"><a href="vAgregarProyecto2.php">Formular un proyecto nuevo</a></li>
							<? } ?>
				</ul>
			</li><?
		}?>
	</ul>

<? include_once('vFooter.php'); ?>
