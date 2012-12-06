<?
require "cAutorizacion.php";

if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

// Controlador de esta vista
require_once("cBuscarProyecto.php");

$TITLE = 'Buscador de proyectos';
include_once("vHeader.php");
?>
        <script>
            
			function openprompt(aviso,titulo,id){
                            if (aviso=="aviso1") {aviso_aux='Esta a punto de eliminar el proyecto: '+titulo+'<br/>Esta operación no se puede deshacer.<br/>Desea continuar?';
                                id2='cEliminarProyecto.php?id=';
                            }
                            if (aviso=="aviso2") {aviso_aux='Esta a punto de cambiar el tipo del proyecto '+titulo+'<br/>Desea continuar?';
                                id2='cCambiarTipoProy.php?id=';
                            }
                            if (aviso=="aviso3") {aviso_aux=titulo+'<br/>Desea continuar?';
                                id2='cCambiarStatusProy.php?culminado=';
                            }
				var temp = {
					state0: {
                                                html:aviso_aux,
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                                            $.prompt.close()
							else window.location=id2+id
							return false; 
						}
					}
				}
				
				$.prompt(temp);
			}
                        
        //Funcion autocompletar para buscar por codigo
	$(function() {
		var availableTags = [
                    <?php foreach($LISTA_PROYECTOS as $value): 
                    ?>                         
                        "<?php echo $value['codigo']; ?>",
                    <?php                        
                    endforeach;
                    ?> 
		];
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>
	<script language="javascript" type="text/javascript" src="scripts/jquery.tools.min.js"></script>

        <!--
        <DIV style="position: fixed; top: 0px; width:100%; height: 100px;">
            HEader content goes here
        </DIV>
        <DIV style="margin-top: 100px;">
            Main content goes here
        </DIV>
-->
	<div id="sidebar">
		<div class="accordion">
			<h2>Buscar por Proyectos</h2>
			<div class="pane">
				<form id="search_by_proyecto" method="post" action="?">
				<div class="box">
					Fecha de ingreso Inicial
					<br />
					<input type="text" name="desde" id="desde" size="10" readonly="readonly" value="<?php echo @$_REQUEST['desde']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger1" name="trigger1"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "desde",
						button            : "trigger1",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Fecha de Ingreso Final:
					<br />
					<input type="text" name="hasta" id="hasta" size="10" readonly="readonly" value="<?php echo @$_REQUEST['hasta']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger2" name="trigger2"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "hasta",
						button            : "trigger2",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Código
					<br />
					<input type="text" id="tags" name="codigo_proyecto" value="<?php echo $_REQUEST['codigo_proyecto'] ?>" />
				</div>
				<div class="box">
					Palabras Clave
					<br />
					<input type="text" id="palabras_clave" name="palabras_clave" value="<?php echo $_REQUEST['palabras_clave'] ?>" />
				</div>
				<div class="box">
					Area del Proyecto
					<br />
					<select name="area_proyecto">
						<option value="">Todas</option>
						<?php foreach($LISTA_AREA_PROYECTO as $value): ?>
						<option value="<?php echo $value['id'] ?>" <?php echo ($_REQUEST['area_proyecto']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Comunidad
					<br />
					<select name="comunidad">
						<option value="">Todas</option>
						<?php foreach($LISTA_COMUNIDAD as $value): ?>
						<option value="<?php echo $value['id'] ?>" <?php echo ($_REQUEST['comunidad']==$value['id'])?'selected="selected"':'' ?> ><?php echo substr($value['nombre'], 0, 30) . "..." ?></option>
						<?php endforeach; ?>
					</select>
				</div>
<!--				<div class="box">
					Representante
					<br />
					<select name="representante">
						<option value="">Todos</option>
						< ?php foreach($LISTA_REPRESENTANTE as $value): ?>
						<option value="< ?php echo $value['id'] ?>" < ?php echo ($_REQUEST['representante']==$value['id'])?'selected="selected"':'' ?> >< ?php echo $value['apellidos'] . ', ' . $value['nombres'] ?></option>
						< ?php endforeach; ?>
					</select>
				</div>-->
				<div class="box">
					Organizaci&oacute;n
					<br />
					<select name="organizacion">
						<option value="">Todas</option>
						<?php foreach($LISTA_ORGANIZACION as $value): ?>
						<option value="<?php echo $value['id'] ?>" <?php echo ($_REQUEST['organizacion']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Evaluado
					<br />
					<select name="aprobado">
						<option value="">Todos</option>
						<option value="SI" <?php echo ($_REQUEST['aprobado']=='SI')?'selected="selected"':'' ?>>Aprobados</option>
						<option value="NO" <?php echo ($_REQUEST['aprobado']=='NO')?'selected="selected"':'' ?>>Por Aprobar</option>
					</select>
				</div>
				<div class="box">
					Culminado
					<br />
					<select name="culminado">
						<option value="">Todos</option>
						<option value="SI" <?php echo ($_REQUEST['culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <?php echo ($_REQUEST['culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
				<div class="box">
					Tipo de proyecto
					<br />
					<select name="tipo_proy">
						<option value="">Todos</option>
						<option value="CONTINUO" <?php echo ($_REQUEST['tipo_proy']=='CONTINUO')?'selected="selected"':'' ?>>Continuo</option>
						<option value="PUNTUAL" <?php echo ($_REQUEST['tipo_proy']=='PUNTUAL')?'selected="selected"':'' ?>>Puntual</option>
					</select>
				</div>
				<div class="box">
					<input type="hidden" name="por_proyecto" value="1" />
					<input type="hidden" name="offset" value="0" />
					<input type="hidden" name="items_per_page" value="50" />
					<input type="submit" name="search" value="Buscar" />
					<br />
					<a href="vBuscarProyecto.php">Realizar una b&uacute;squeda nueva</a>
				</div>
				</form>
			</div>
			<h2>Buscar por Estudiante</h2>
			<div class="pane">
				<form id="search_by_estudiante" method="post" action="?">
				<div class="box">
					Culminado
					<br />
					<select name="byest_culminado">
						<option value="">Todos</option>
						<option value="SI" <?php echo ($_REQUEST['byest_culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <?php echo ($_REQUEST['byest_culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
                                <div class="box">
					Inscrito
					<br />
					<select name="inscrito">
						<option value="">Todos</option>
						<option value="SI" <?php echo ($_REQUEST['inscrito']=='SI')?'selected="selected"':'' ?>>Inscritos</option>
						<option value="NO"   <?php echo ($_REQUEST['inscrito']=='NO')?'selected="selected"':'' ?>>No Inscritos</option>
					</select>
				</div>
				<div class="box">
					Carnet
					<br />
					<input type="text" name="est_carnet" value="<?php echo $_REQUEST['est_carnet'] ?>" />
				</div>
				<div class="box">
					Cohorte
					<br />
					<select name="est_cohorte">
						<option value="">Todas</option>
						<?php foreach($LISTA_COHORTE as $value): ?>
						<option value="<?php echo $value ?>" <?php echo ($_REQUEST['est_cohorte']==$value)?'selected="selected"':'' ?> ><?php echo $value ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Carrera
					<br />
					<select name="est_carrera">
						<option value="">Todas</option>
						<?php foreach($LISTA_CARRERA as $value): ?>
						<option value="<?php echo $value['codigo'] ?>" <?php echo ($_REQUEST['est_carrera']==$value['codigo'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Duraci&oacute;n de Carrera
					<br />
					<select name="est_carrera_duracion">
						<option value="">Cualquiera</option>
						<option value="Corta" <?php echo ($_REQUEST['est_carrera_duracion']=='Corta')?'selected="selected"':'' ?> >Corta</option>
						<option value="Larga" <?php echo ($_REQUEST['est_carrera_duracion']=='Larga')?'selected="selected"':'' ?> >Larga</option>
					</select>
				</div>
				<div class="box">
					Sede
					<br />
					<select name="est_carrera_sede">
						<option value="">Cualquiera</option>
						<option value="Sartenejas" <?php echo ($_REQUEST['est_carrera_sede']=='Sartenejas')?'selected="selected"':'' ?> >Sartenejas</option>
						<option value="Litoral" <?php echo ($_REQUEST['est_carrera_sede']=='Litoral')?'selected="selected"':'' ?> >Litoral</option>
					</select>
				</div>
				<div class="box">
					Correo Electr&oacute;nico
					<br />
					<input type="text" name="est_email" value="<?php echo $_REQUEST['est_email'] ?>" />
				</div>
				<div class="box">
					Sexo
					<br />
					<select name="est_sexo">
						<option value="">Cualquiera</option>
						<option value="M" <?php echo ($_REQUEST['est_sexo']=='M')?'selected="selected"':'' ?>>Masculino</option>
						<option value="F" <?php echo ($_REQUEST['est_sexo']=='F')?'selected="selected"':'' ?>>Femenino</option>
					</select>
				</div>
				<div class="box">
					Nombre
					<br />
					<input type="text" name="est_nombre" value="<?php echo $_REQUEST['est_nombre'] ?>" />
				</div>
				<div class="box">
					<input type="hidden" name="por_estudiante" value="1" />
					<input type="hidden" name="ver_usb" value="1" />
					<input type="hidden" name="offset" value="0" />
					<input type="submit" name="search" value="Buscar" />
					<br />
					<a href="vBuscarProyecto.php">Realizar una b&uacute;squeda nueva</a>
				</div>
				</form>
			</div>

			<h2>Buscar por Tutor</h2>
			<div class="pane">
				<form id="search_by_tutor" method="post" action="?">
				<div class="box">
					USBID
					<br />
					<select name="tutor_usbid">
						<option value="">Todas</option>
						<?php foreach($LISTA_USBID as $value): ?>
						<option value="<?php echo $value['usbid_usuario'] ?>" <?php echo ($_REQUEST['tutor_usbid']==$value['usbid_usuario'])?'selected="selected"':'' ?> ><?php echo $value['usbid_usuario'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Culminado
					<br />
					<select name="culminado">
						<option value="">Todos</option>
						<option value="SI" <?php echo ($_REQUEST['culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <?php echo ($_REQUEST['culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
				<div class="box">
					Dependencia
					<br />
					<select name="tutor_dependencia">
						<option value="">Todas</option>
						<?php foreach($LISTA_DEPENDENCIA as $value): ?>
						<option value="<?php echo $value['id'] ?>" <?php echo ($_REQUEST['tutor_dependencia']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="box">
					Email
					<br />
					<input type="text" name="tutor_email" value="<?php echo $_REQUEST['tutor_email'] ?>" />
				</div>
				<div class="box">
					Nombre
					<br />
					<input type="text" name="tutor_nombre" value="<?php echo $_REQUEST['tutor_nombre'] ?>" />
				</div>
				<div class="box">
					<input type="hidden" name="por_tutor" value="1" />
					<input type="hidden" name="ver_usb" value="1" />
					<input type="hidden" name="offset" value="0" />
					<input type="submit" name="search" value="Buscar" />
					<br />
					<a href="vBuscarProyecto.php">Realizar una b&uacute;squeda nueva</a>
				</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(".accordion").tabs(".pane", {
				tabs: 'h2',
				effect: 'slide',
				initialIndex: <?php
					if($_REQUEST['por_estudiante']) echo 1;
					elseif($_REQUEST['por_tutor']) echo 2;
					else echo 0;
				?>
			});
		</script>
	</div>

	<div class="content">
		<h2>
			Resultados de la B&uacute;squeda
			<br />
			<?php if($por_proyecto): ?>
			<span class="info">Proyectos registrados en el sistema</span>
			<?php elseif($por_estudiante): ?>
			<span class="info">Inscripciones realizadas por estos estudiantes</span>
			<?php elseif($por_tutor): ?>
			<span class="info">Total de inscripciones tutoriadas</span>
			<?php endif; ?>
		</h2>

		<?php if( empty($RESULT_PROYECTOS)): ?>
		<p>No hay resultados de busqueda</p>
		<?php else:
			$_anios = list_anios($desde, $hasta);
		?>
		<table class="resultados">
			<tr class="head">
				<td class="head_col">Actividades</td>
				<?php 
                                $totales_globales=array();
                                foreach($TABLA_RESUMEN as $anio => $result): ?>
				<td><?php 
                                    echo $anio; 
                                    $totales_globales[$anio]=0;?>
                                </td>
				<?php endforeach; ?>
				<td>TOTALES</td>
			</tr>
			<?php $i=0; foreach ($LISTA_AREA_PROYECTO as $area): ?>
			<tr class="<?php echo ($i%2==0)?'par':'impar'; ?>">
				<?php if( !isset($area_proyecto) || !$area_proyecto || $area_proyecto == $area['id']): ?>
				<td class="head_col">
					<?php
					// $query = get_search_array();
					$new_query = get_search_query(array(
						'desde' => sum_fecha('00-00-00', 0),
						'hasta' => '3000-11-30',
						'area_proyecto' => $area['id'],
						'offset' => 0
					));

					if((int)$RESULT_TOTAL_BY_AREA[$area['siglas']]):
					?>
						<a href="?<?php echo $new_query; ?>"><?php echo $area['siglas']; ?> (<em><?php echo $area['nombre']; ?></em>)</a>
					<?php else: ?>
						<?php echo $area['siglas']; ?> (<em><?php echo $area['nombre']; ?></em>)
					<?php endif; ?>
				</td>

				<?php
				$_totales = 0;
					foreach($TABLA_RESUMEN as $anio => $result):
				?>
				<td>
					<?php
					// $query = get_search_array();
					$new_query = get_search_query(array(
						'desde' => sum_fecha($anio.'-00-00', 0),
						'hasta' => $anio.'-11-30',
						'area_proyecto' => $area['id'],
						'offset' => 0
					));
					
					if((int)$result[$area['siglas']]):
						$_totales += (int)$result[$area['siglas']];
                                                $totales_globales[$anio]+=(int)$result[$area['siglas']];
					?>
						<a href="?<?php echo $new_query; ?>"><?php echo (int)$result[$area['siglas']]; ?></a>
					<?php
						else:
							echo 0;
						endif;
					?>
				</td>
				<?php endforeach; ?>
				<td><?php
					// $query = get_search_array();
					$new_query = get_search_query(array(
						'desde' => sum_fecha('00-00-00', 0),
						'hasta' => '3000-11-30',
						'area_proyecto' => $area['id'],
						'offset' => 0
					));

					if((int)$RESULT_TOTAL_BY_AREA[$area['siglas']]):
					?>
						<!--<a href="?<?php echo $new_query; ?>"><?php echo $RESULT_TOTAL_BY_AREA[$area['siglas']]; ?></a>-->
						<a href="?<?php echo $new_query; ?>"><?php echo $_totales; ?></a>
					<?php
						else:
							echo 0;
						endif;
					?>
				</td>
				<?php endif; ?>

			</tr>
                        <?php $i++; endforeach; ?>
                        <tr class="head">
                            <td class="head_col">
                                Total
                            </td>
                        <?php $suma=0; foreach($totales_globales as $total): ?>
                            <td>
                                <?php echo $total;$suma+=$total; ?>
                            </td>
                        <?php endforeach; ?>
                            <td>
                                <?php echo  $suma; ?>
                            </td>
                        </tr>
		</table>

		<?php if(!$ver_reporte) get_pagination($offset, count($RESULT_ALL_PROYECTOS)); ?>

		<hr />
		<?php if($por_estudiante OR $por_tutor): ?>
		<div class="otras_opciones">
			<?php
				$new_query = get_search_query(array(
					'ver_usb' => 1,
					'ver_reporte' => 0,
					'offset' => 0
				));
			?>
			<a class="<?php echo ($ver_usb && !$ver_reporte)?'active':''; ?>" href="?<?php echo $new_query; ?>"><?php echo ($por_estudiante)?'Ver Estudiantes':'Ver Tutores'; ?></a>

			<?php
				$new_query = get_search_query(array(
					'ver_usb' => 0,
					'ver_reporte' => 0,
					'offset' => 0
				));
			?>
			&nbsp;&nbsp;-&nbsp;&nbsp; <a class="<?php echo (!$ver_usb && !$ver_reporte)?'active':''; ?>" href="?<?php echo $new_query; ?>">Ver proyectos</a>
		</div>
		<?php endif; ?>
		<div class="otras_opciones">
			<?php
				$new_query = get_search_query(array(
					'ver_reporte' => 1
				));
			?>
			<a class="<?php echo ($ver_reporte)?'active':''; ?>" href="?<?php echo $new_query; ?>">Ver reportes</a>
			
			<?php
				$new_query = get_search_query(array(
					'load_xml' => 1
				));
			?>
			&nbsp;&nbsp;-&nbsp;&nbsp; <a href="?<?php echo $new_query; ?>">Exportar resultado en XML</a>
		</div>

		<!-- Listado de resultados -->
		<?php if( $ver_reporte ): ?>
		<div class="reportes">
			<h2>Reporte de la b&uacute;squeda</h2>
			<p>
				<img src="http://chart.apis.google.com/chart?<?php echo $REP_BYANIO__SRC ?>" alt="" />
			</p>
			<p>
				<img src="http://chart.apis.google.com/chart?<?php echo $REP_BYTOTAL__SRC ?>" alt="" />
			</p>
			<p>
				<img src="http://chart.apis.google.com/chart?<?php echo $REP_BYTOTAL__SRC2 ?>" alt="" />
			</p>
		</div>
		<?php elseif( $ver_usb): ?>
			<?php if($por_proyecto): ?>
			<h2>Listado de proyectos (por inscripciones)</h2>
			<?php elseif($por_estudiante): ?>
			<h2>Listado de Estudiantes</h2>
			<?php elseif($por_tutor): ?>
			<h2>Listado de Tutores</h2>
			<?php endif; ?>

			<ol id="result_list" start="<?php echo $offset+1 ?>">
			<?php foreach($RESULT_PROYECTOS as $value): ?>
				<li>
					<?php
						$_nombre = implode(', ', array_filter(array($value['usuario_apellido'], $value['usuario_nombre'])));
						if($por_estudiante)
							echo resaltar_palabras_en_frase($est_nombre, $_nombre);
						else
							echo resaltar_palabras_en_frase($tutor_nombre, $_nombre);
					?>
					<?php if($por_estudiante): ?>
					<div class="more">
						<b>Usbid:</b> <?php echo $value['usbid_estudiante']; ?>
					</div>
					<div class="more">
						<b>Carrera:</b>
						<?php
							$sql = "SELECT * FROM carrera WHERE codigo='".$value['carrera']."'";
							$resultado = ejecutarConsulta($sql, $conexion);
							$row = obtenerResultados($resultado);
							echo $row['nombre'] . " (" . $row['codigo'] . ")";
						?>
					</div>
					<!--
					<div class="more">
						<b>Tel&eacute;fonos:</b> <?php echo implode(', ', array_filter(array($value['telf_hab'], $value['telf_cel']))); ?>
					</div>
					-->
					<?php endif; ?>

					<?php if($por_tutor): ?>
					<div class="more">
						<b>Usbid:</b> <?php echo $value['tutor']; ?>
					</div>
					<div class="more">
					<b>Proyectos totales que ha tutoreado:</b>
					<?php
						// Obtenemos, y listamos, los tutores que ha tenido el proyecto
						$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE tutor='".$value['usbid']."'";
						$resultado = ejecutarConsulta($sql, $conexion);
						$_result = array();
						while ($row = obtenerResultados($resultado)){
							$_result[] = $row['totales'];
						}
						echo implode(', ', $_result);
					?>
					</div>
					<?php endif; ?>

					<div class="more">
						<a href="mailto:<?php echo $value['email_sec']; ?>"><?php echo $value['email_sec']; ?></a>
					</div>

					<div class="opciones_proyecto">
						<?php if($por_estudiante): ?>
						<a href="vActualizarDatosEstudiante.php?usbid=<?php echo $value['usbid_estudiante']; ?>"><img src="imagenes/iconos/txt.png" alt="Modificar" title="Modificar" /></a>
						<?php else: ?>
						<a href="vActualizarDatos.php?usbid=<?php echo $value['tutor']; ?>"><img src="imagenes/iconos/txt.png" alt="Modificar" title="Modificar" /></a>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
			</ol>

		<?php else: ?>
			<?php if($por_proyecto): ?>
			<h2>Proyectos desde el a&ntilde;o <?php echo truncate_year($RESULT_PROYECTOS[0]['fecha_ingreso']); ?></h2>
			<?php elseif($por_estudiante): ?>
			<h2>Inscripciones realizadas por los estudiantes</h2>
			<?php elseif($por_tutor): ?>
			<h2>Tutor&iacute;as realizadas (por incripci&oacute;n de proyectos)</h2>
			<?php endif; ?>

			<ol id="result_list" start="<?php echo $offset+1 ?>">
			<?php foreach($RESULT_PROYECTOS as $value): ?>
				<li>
					<b><?php 	
						if ($value['codigo']<>"") {
							echo $value['codigo'];
							$aprobado=true;
						}
						else{ 
							echo "C&oacute;digo no asignado"; 
							$aprobado=false;
						}
						?></b>.
					<?php echo resaltar_palabras_en_frase($palabras_clave, $value['titulo']); ?>

					<div class="more">
						<b>Tipo:</b> <?php if ($aprobado) echo $value['tipo']; else echo "No asignado"; ?>
					</div>

					<?php if($por_estudiante OR $por_tutor): ?>
					<div class="more">
						Inscripci&oacute;n realizada el <b><?php echo date('m \d\e Y', strtotime($value['fecha_inscip'])); ?></b>
					</div>
					<?php endif; ?>

					<?php if($por_tutor): ?>
					<div class="more">
						<b>Tutor:</b>
						<?php
							$_result = array_filter( array($value['usuario_apellido'], $value['usuario_nombre']) );
							echo implode(', ', $_result);
						?>
					</div>
					<div class="more">
						<b>Estudiante:</b>
						<?php
							$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE u.usbid='".$value['usbid_estudiante']."'";
							$resultado = ejecutarConsulta($sql, $conexion);
							$_result = array();
							while ($row = obtenerResultados($resultado)){
								$_result[] = $row['nombre'].' '.$row['apellido'];
							}
							echo implode(', ', $_result);
						?>
					</div>
					<?php endif; ?>

					<div class="more">
					<b>Estudiantes totales que han inscrito el proyecto:</b>
					<?php
						// Obtenemos, y listamos, los inscritos que ha tenido el proyecto
						$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE id_proyecto='".$value['id']."'";
						$resultado = ejecutarConsulta($sql, $conexion);
						$_result = array();
						while ($row = obtenerResultados($resultado)){
							$_result[] = $row['totales'];
						}
						$inscritos=implode(', ', $_result); 						
						echo $inscritos; 
						
					?>
					</div>

					<?php if($por_estudiante): ?>
					<div class="more">
						<b>Inscrito por:</b> <a href="mailto:<?php echo $value['email_sec']; ?>"><?php echo $value['usuario_nombre'] ?> <?php echo $value['usuario_apellido'] ?> (<?php echo $value['usbid']; ?>)</a>
					</div>
					<div class="more">
						<b>Tutor:</b>
						<?php
							echo $value['tutor'];
						?>
					</div>
					<?php endif; ?>

					<?php if($por_tutor): ?>
					<div class="more">
						<b>Tutor a cargo:</b> <a href="mailto:<?php echo $value['email_sec']; ?>"><?php echo $value['usuario_nombre'] ?> <?php echo $value['usuario_apellido'] ?> (<?php echo $value['usbid']; ?>)</a>
					</div>
					<?php endif; ?>

					<div class="opciones_proyecto">
						<a href="vVerProyecto.php?id=<?php echo $value['id'] ?>"><? echo mostrarImagen('ver'); ?></a>&nbsp;&nbsp;
						<a href="vModificarProyecto.php?id=<?php echo $value['id'] ?>"><? echo mostrarImagen('modificar'); ?></a>&nbsp;&nbsp;
                                                <a href='javascript:openprompt("aviso2","<?php echo $value['codigo'] ?> a <?php echo $CHANGE_TIPO[$value['tipo']]; ?>",<?php echo $value['id'] ?>)'>
                                                <!--<a href="cCambiarTipoProy.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Esta a punto de cambiar el tipo del proyecto <?php echo $value['codigo'] ?> a <?php echo $CHANGE_TIPO[$value['tipo']]; ?>.\n&iquest;Desea continuar?')">-->
                                                    <img src="imagenes/iconos/reload.png" alt="" width='15' height='15' title="Cambiar a <?php echo $CHANGE_TIPO[$value['tipo']]; ?>" /></a>&nbsp;&nbsp;
                                                <a href='javascript:openprompt("aviso3","Esta a punto de <?php echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?> el proyecto <?php echo $value['codigo'] ?>","<?php echo $CHANGE_CULMINADO[$value['culminado']] ?>&id=<?php echo $value['id'] ?>")'>
						<!--<a href="cCambiarStatusProy.php?culminado=<?php echo $CHANGE_CULMINADO[$value['culminado']] ?>&id=<?php echo $value['id'] ?>" onclick="return confirm('Esta a punto de <?php echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?> el proyecto <?php echo $value['codigo'] ?>.\n&iquest;Desea continuar?')">-->
                                                    <img src="imagenes/iconos/<?php echo ($value['culminado'] == 'NO')?'candado_abierto':'candado'; ?>.png" alt="" title="<?php echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?>"/></a>
						<? 
						if ($value['codigo']==""){
							?>
                                                <a href='javascript:openprompt("aviso1","<?php echo trim($value['titulo']) ?>",<?php echo $value['id'] ?>)'>
							<!--<a href="cEliminarProyecto.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Esta a punto de eliminar el proyecto: <?php echo trim($value['titulo']) ?>. \nEsta operacion no se puede deshacer.\n&iquest;Desea continuar?')">-->
							<?
							echo mostrarImagen('eliminar');
						}  ?></a>
					</div>
				</li>
			<?php endforeach; ?>
			</ol>

		<?php endif; ?>

		<hr />
		<?php if(!$ver_reporte) get_pagination($offset, count($RESULT_ALL_PROYECTOS)); ?>

		<?php endif; ?>
	</div>

	<div class="clear">
		<pre><?php /* DEBUG */ // print_r( $TABLA_RESUMEN ); ?></pre>
		<pre><?php /* DEBUG */ // print_r( $RESULT_PROYECTOS ); ?></pre>
		<pre><?php /* DEBUG */ // echo get_search_query(); ?></pre>
	</div>


<?php include_once('vFooter.php'); ?>
<?php
/*

Variable $_SESSION como administrador

Array
(
    [phpCAS] => Array
        (
            [user] => coord-psc
        )

    [usuario_validado] => 1
    [USBID] => coord-psc
    [nombres] => Coordinacion Cooperacion
    [apellidos] => Tecnica y
    [cedula] => 6917611
    [carrera] =>
    [carnet] =>
    [tipo] => administrativos
    [cohorte] => coord
)
 */
