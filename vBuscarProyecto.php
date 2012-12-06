<?
require "cAutorizacion.php";

if (!isAdmin() && !isCoordinacion() && !isDepartamento()){
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
							if (aviso=="aviso4") {aviso_aux='Esta a punto de retirar al estudiante: '+titulo+'<br/>Esta operación no se puede deshacer.<br/>Desea continuar?';
                                id2='cRetirarEstudiante.php?';
                            }
				var temp = {
					state0: {
                        html:aviso_aux,
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                $.prompt.close()
							else 
								window.location=id2+id+"&tok=<? echo $_SESSION[csrf]?>"
							return false; 
						}
					}
				}
				
				$.prompt(temp);
			}
                        
        //Funcion autocompletar para buscar por codigo
	$(function() {
		var availableTags = [
                    <? foreach($LISTA_PROYECTOS as $value): 
                    ?>                         
                        "<? echo $value['codigo']; ?>",
                    <?                        
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
					Fecha de Ingreso Inicial
					<br />
					<input type="text" name="desde" id="desde" size="10" readonly="readonly" value="<? echo @$_REQUEST['desde']; ?>" />
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
					<input type="text" name="hasta" id="hasta" size="10" readonly="readonly" value="<? echo @$_REQUEST['hasta']; ?>" />
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
					<input type="text" id="tags" name="codigo_proyecto" value="<? echo $_REQUEST['codigo_proyecto'] ?>" />
				</div>
				<div class="box">
					Palabras Clave
					<br />
					<input type="text" id="palabras_clave" name="palabras_clave" value="<? echo $_REQUEST['palabras_clave'] ?>" />
				</div>
				<div class="box">
					Area del Proyecto
					<br />
					<select name="area_proyecto">
						<option value="">Todas</option>
						<? foreach($LISTA_AREA_PROYECTO as $value): ?>
						<option value="<? echo $value['id'] ?>" <? echo ($_REQUEST['area_proyecto']==$value['id'])?'selected="selected"':'' ?> ><? echo $value['nombre'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Comunidad
					<br />
					<select name="comunidad">
						<option value="">Todas</option>
						<? foreach($LISTA_COMUNIDAD as $value): ?>
						<option value="<? echo $value['id'] ?>" <? echo ($_REQUEST['comunidad']==$value['id'])?'selected="selected"':'' ?> ><? echo substr($value['nombre'], 0, 30) . "..." ?></option>
						<? endforeach; ?>
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
						<? foreach($LISTA_ORGANIZACION as $value): ?>
						<option value="<? echo $value['id'] ?>" <? echo ($_REQUEST['organizacion']==$value['id'])?'selected="selected"':'' ?> ><? echo $value['nombre'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Evaluado
					<br />
					<select name="aprobado">
						<option value="">Todos</option>
						<option value="SI" <? echo ($_REQUEST['aprobado']=='SI')?'selected="selected"':'' ?>>Aprobados</option>
						<option value="NO" <? echo ($_REQUEST['aprobado']=='NO')?'selected="selected"':'' ?>>Por Aprobar</option>
					</select>
				</div>
				<div class="box">
					Culminado
					<br />
					<select name="culminado">
						<option value="">Todos</option>
						<option value="SI" <? echo ($_REQUEST['culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <? echo ($_REQUEST['culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
				<div class="box">
					Tipo de proyecto
					<br />
					<select name="tipo_proy">
						<option value="">Todos</option>
						<option value="CONTINUO" <? echo ($_REQUEST['tipo_proy']=='CONTINUO')?'selected="selected"':'' ?>>Continuo</option>
						<option value="PUNTUAL" <? echo ($_REQUEST['tipo_proy']=='PUNTUAL')?'selected="selected"':'' ?>>Puntual</option>
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
					Fecha de inscripción inicial:
					<br />
					<input type="text" name="desde_est" id="desde_est" size="10" readonly="readonly" value="<? echo @$_REQUEST['desde_est']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger3" name="trigger3"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "desde_est",
						button            : "trigger3",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Fecha de inscripción final:
					<br />
					<input type="text" name="hasta_est" id="hasta_est" size="10" readonly="readonly" value="<? echo @$_REQUEST['hasta_est']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger4" name="trigger4"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "hasta_est",
						button            : "trigger4",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Fecha de Culminación Inicial:
					<br />
					<input type="text" name="desde_culmina" id="desde_culmina" size="10" readonly="readonly" value="<? echo @$_REQUEST['desde_culmina']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger5" name="trigger5"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "desde_culmina",
						button            : "trigger5",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Fecha de Culminación Final:
					<br />
					<input type="text" name="hasta_culmina" id="hasta_culmina" size="10" readonly="readonly" value="<? echo @$_REQUEST['hasta_culmina']; ?>" />
					<img alt=""  src="imagenes/iconos/cal.png" id="trigger6" name="trigger5"/>
					<script type="text/javascript">//<![CDATA[
						var cal  = new  Zapatec.Calendar({
						firstDay          : 1,
						lang              : "es",
						theme             : "fancyblue",
						weekNumbers       : false,
						step              : 1,
						range             : [1900.01, 2200.12],
						electric          : false,
						inputField        : "hasta_culmina",
						button            : "trigger6",
						ifFormat          : "%Y-%m-%d",
						daFormat          : "%Y-%m-%d"
					  });
					//]]></script>
				</div>
				<div class="box">
					Culminado
					<br />
					<select name="byest_culminado">
						<option value="">Todos</option>
						<option value="SI" <? echo ($_REQUEST['byest_culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <? echo ($_REQUEST['byest_culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
                                <div class="box">
					Inscrito
					<br />
					<select name="inscrito">
						<option value="">Todos</option>
						<option value="SI" <? echo ($_REQUEST['inscrito']=='SI')?'selected="selected"':'' ?>>Inscritos</option>
						<option value="NO"   <? echo ($_REQUEST['inscrito']=='NO')?'selected="selected"':'' ?>>No Inscritos</option>
					</select>
				</div>
				<div class="box">
					Carnet
					<br />
					<input type="text" name="est_carnet" value="<? echo $_REQUEST['est_carnet'] ?>" />
				</div>
				<div class="box">
					Cohorte
					<br />
					<select name="est_cohorte">
						<option value="">Todas</option>
						<? foreach($LISTA_COHORTE as $value): ?>
						<option value="<? echo $value ?>" <? echo ($_REQUEST['est_cohorte']==$value)?'selected="selected"':'' ?> ><? echo $value ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Carrera
					<br />
					<select name="est_carrera">						
							<option value="">Todas</option>						
						<? foreach($LISTA_CARRERA as $value): ?>
						<option value="<? echo $value['codigo'] ?>" <? echo ($_REQUEST['est_carrera']==$value['codigo'])?'selected="selected"':'' ?> ><? echo $value['nombre'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Duraci&oacute;n de Carrera
					<br />
					<select name="est_carrera_duracion">
						<option value="">Cualquiera</option>
						<option value="Corta" <? echo ($_REQUEST['est_carrera_duracion']=='Corta')?'selected="selected"':'' ?> >Corta</option>
						<option value="Larga" <? echo ($_REQUEST['est_carrera_duracion']=='Larga')?'selected="selected"':'' ?> >Larga</option>
					</select>
				</div>
				<!--
				<div class="box">
					Sede
					<br />
					<select name="est_carrera_sede">
						<option value="">Cualquiera</option>
						<option value="Sartenejas" <? //echo ($_REQUEST['est_carrera_sede']=='Sartenejas')?'selected="selected"':'' ?> >Sartenejas</option>
						<option value="Litoral" <? //echo ($_REQUEST['est_carrera_sede']=='Litoral')?'selected="selected"':'' ?> >Litoral</option>
					</select>
				</div>
				-->
				<div class="box">
					Correo Electr&oacute;nico
					<br />
					<input type="text" name="est_email" value="<? echo $_REQUEST['est_email'] ?>" />
				</div>
				<div class="box">
					Sexo
					<br />
					<select name="est_sexo">
						<option value="">Cualquiera</option>
						<option value="M" <? echo ($_REQUEST['est_sexo']=='M')?'selected="selected"':'' ?>>Masculino</option>
						<option value="F" <? echo ($_REQUEST['est_sexo']=='F')?'selected="selected"':'' ?>>Femenino</option>
					</select>
				</div>
				<div class="box">
					Nombre
					<br />
					<input type="text" name="est_nombre" value="<? echo $_REQUEST['est_nombre'] ?>" />
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
						<? foreach($LISTA_USBID as $value): ?>
						<option value="<? echo $value['usbid_usuario'] ?>" <? echo ($_REQUEST['tutor_usbid']==$value['usbid_usuario'])?'selected="selected"':'' ?> ><? echo $value['usbid_usuario'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Culminado
					<br />
					<select name="culminado">
						<option value="">Todos</option>
						<option value="SI" <? echo ($_REQUEST['culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <? echo ($_REQUEST['culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
				<div class="box">
					Dependencia
					<br />
					<select name="tutor_dependencia">
						<option value="">Todas</option>
						<? foreach($LISTA_DEPENDENCIA as $value): ?>
						<option value="<? echo $value['id'] ?>" <? echo ($_REQUEST['tutor_dependencia']==$value['id'])?'selected="selected"':'' ?> ><? echo $value['nombre'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
				<div class="box">
					Email
					<br />
					<input type="text" name="tutor_email" value="<? echo $_REQUEST['tutor_email'] ?>" />
				</div>
				<div class="box">
					Nombre
					<br />
					<input type="text" name="tutor_nombre" value="<? echo $_REQUEST['tutor_nombre'] ?>" />
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
			<!--<h2>Buscar por Trimestre</h2>
			<div class="pane">
				<form id="search_by_trimestre" method="post" action="?">
				<div class="box">
					Culminado
					<br />
					<select name="culminado">
						<option value="">Todos</option>
						<option value="SI" <? //echo ($_REQUEST['culminado']=='SI')?'selected="selected"':'' ?>>Culminados</option>
						<option value="NO" <? //echo ($_REQUEST['culminado']=='NO')?'selected="selected"':'' ?>>No Culminados</option>
					</select>
				</div>
				<div class="box">
					<input type="hidden" name="por_trimestre" value="1" />
					<input type="hidden" name="ver_usb" value="1" />
					<input type="hidden" name="offset" value="0" />
					<input type="submit" name="search" value="Buscar" />
					<br />
					<a href="vBuscarProyecto.php">Realizar una b&uacute;squeda nueva</a>
				</div>
				</form>
			</div>-->
		</div>
		<script type="text/javascript">
			jQuery(".accordion").tabs(".pane", {
				tabs: 'h2',
				effect: 'slide',
				initialIndex: <?
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
			<? if($por_proyecto): ?>
			<span class="info">Proyectos registrados en el sistema</span>
			<? elseif($por_estudiante): ?>
			<span class="info">Inscripciones realizadas por estos estudiantes</span>
			<? elseif($por_tutor): ?>
			<span class="info">Total de inscripciones tutoriadas</span>
			<? endif; ?>
		</h2>

		<? if( empty($RESULT_PROYECTOS)): ?>
		<p>No hay resultados de busqueda</p>
		<? else:
			$_anios = list_anios($desde, $hasta);
		?>
		<table class="resultados">
			<tr class="head">
				<td class="head_col">Actividades</td>
				<? 
                                $totales_globales=array();
                                foreach($TABLA_RESUMEN as $anio => $result): ?>
				<td><? 
                                    echo $anio; 
                                    $totales_globales[$anio]=0;?>
                                </td>
				<? endforeach; ?>
				<td>TOTALES</td>
			</tr>
			<? $i=0; foreach ($LISTA_AREA_PROYECTO as $area): ?>
			<tr class="<? echo ($i%2==0)?'par':'impar'; ?>">
				<? if( !isset($area_proyecto) || !$area_proyecto || $area_proyecto == $area['id']): ?>
				<td class="head_col">
					<?
					// $query = get_search_array();
					$new_query = get_search_query(array(
						'desde' => sum_fecha('00-00-00', 0),
						'hasta' => '3000-11-30',
						'area_proyecto' => $area['id'],
						'offset' => 0
					));

					if((int)$RESULT_TOTAL_BY_AREA[$area['siglas']]):
					?>
						<a href="?<? echo $new_query; ?>"><? echo $area['siglas']; ?> (<em><? echo $area['nombre']; ?></em>)</a>
					<? else: ?>
						<? echo $area['siglas']; ?> (<em><? echo $area['nombre']; ?></em>)
					<? endif; ?>
				</td>

				<?
				$_totales = 0;
					foreach($TABLA_RESUMEN as $anio => $result):
				?>
				<td>
					<?
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
						<a href="?<? echo $new_query; ?>"><? echo (int)$result[$area['siglas']]; ?></a>
					<?
						else:
							echo 0;
						endif;
					?>
				</td>
				<? endforeach; ?>
				<td><?
					// $query = get_search_array();
					$new_query = get_search_query(array(
						'desde' => sum_fecha('00-00-00', 0),
						'hasta' => '3000-11-30',
						'area_proyecto' => $area['id'],
						'offset' => 0
					));

					if((int)$RESULT_TOTAL_BY_AREA[$area['siglas']]):
					?>
						<!--<a href="?<? echo $new_query; ?>"><? echo $RESULT_TOTAL_BY_AREA[$area['siglas']]; ?></a>-->
						<a href="?<? echo $new_query; ?>"><? echo $_totales; ?></a>
					<?
						else:
							echo 0;
						endif;
					?>
				</td>
				<? endif; ?>

			</tr>
                        <? $i++; endforeach; ?>
                        <tr class="head">
                            <td class="head_col">
                                Total
                            </td>
                        <? $suma=0; foreach($totales_globales as $total): ?>
                            <td>
                                <? echo $total;$suma+=$total; ?>
                            </td>
                        <? endforeach; ?>
                            <td>
                                <? echo  $suma; ?>
                            </td>
                        </tr>
		</table>

		<? if(!$ver_reporte) get_pagination($offset, count($RESULT_ALL_PROYECTOS)); ?>

		<hr />
		<? if($por_estudiante OR $por_tutor): ?>
		<div class="otras_opciones">
			<?
				$new_query = get_search_query(array(
					'ver_usb' => 1,
					'ver_reporte' => 0,
					'offset' => 0
				));
			?>
			<a class="<? echo ($ver_usb && !$ver_reporte)?'active':''; ?>" href="?<? echo $new_query; ?>"><? echo ($por_estudiante)?'Ver Estudiantes':'Ver Tutores'; ?></a>

			<?
				$new_query = get_search_query(array(
					'ver_usb' => 0,
					'ver_reporte' => 0,
					'offset' => 0
				));
			?>
			&nbsp;&nbsp;-&nbsp;&nbsp; <a class="<? echo (!$ver_usb && !$ver_reporte)?'active':''; ?>" href="?<? echo $new_query; ?>">Ver proyectos</a>
		</div>
		<? endif; ?>
		<div class="otras_opciones">
			<?
				$new_query = get_search_query(array(
					'ver_reporte' => 1
				));
			?>
			<a class="<? echo ($ver_reporte)?'active':''; ?>" href="?<? echo $new_query; ?>">Ver reportes</a>
			
			<?
				$new_query = get_search_query(array(
					'load_xml' => 1
				));
			?>
			<? if(!$ver_reporte ): ?>
			&nbsp;&nbsp;-&nbsp;&nbsp; <a href="?<? echo $new_query; ?>">Exportar resultado en XML</a>
			&nbsp;&nbsp;-&nbsp;&nbsp; <a href="vBuscarProyecto2.php?<? echo get_search_query(); ?>">Exportar resultado en Excel</a>
			<? else: ?>			
				&nbsp;&nbsp;-&nbsp;&nbsp; <a href="?">Ver proyectos</a>
			<? endif; ?>
		</div>

		<!-- Listado de resultados -->
		<? if( $ver_reporte ): ?>
		<div class="reportes">
			<h2>Reporte de la b&uacute;squeda</h2>
			<p>
				<img src="http://chart.apis.google.com/chart?<? echo $REP_BYANIO__SRC ?>" alt="" />
			</p>
			<p>
				<img src="http://chart.apis.google.com/chart?<? echo $REP_BYTOTAL__SRC ?>" alt="" />
			</p>
			<p>
				<img src="http://chart.apis.google.com/chart?<? echo $REP_BYTOTAL__SRC2 ?>" alt="" />
			</p>
		</div>
		<? elseif( $ver_usb): ?>
			<? if(!isDepartamento()){ ?>
				<? if($por_proyecto): ?>
				<h2>Listado de proyectos (por inscripciones)</h2>
				<? elseif($por_estudiante): ?>
				<h2>Listado de Estudiagjhntes</h2>
				<? elseif($por_tutor): ?>
				<h2>Listado de Tutores</h2>
				<? endif; ?>
			<? }else{ ?>
				<? if($por_proyecto): ?>
				<h2>Listado de proyectos (por inscripciones)</h2>
				<h2>Postulados o Tutoreadas por miembros USB adscritos al <? echo $_SESSION[nombres] ?></h2>
				<? elseif($por_estudiante): ?>
				<h2>Listado de Estudiantes</h2>
				<h2>Tutoreados por miembros USB adscritos al <? echo $_SESSION[nombres] ?></h2>
				<? elseif($por_tutor): ?>
				<h2>Listado de Tutores</h2>
				<h2>Adscritos al <? echo $_SESSION[nombres] ?></h2>
				<? endif; ?>
			<? } ?>

			<ol id="result_list" start="<? echo $offset+1 ?>">
			<? foreach($RESULT_PROYECTOS as $value): ?>
				<li>
					<?
						$_nombre = implode(', ', array_filter(array($value['usuario_apellido'], $value['usuario_nombre'])));
						if($por_estudiante)
							echo resaltar_palabras_en_frase($est_nombre, $_nombre);
						else
							echo resaltar_palabras_en_frase($tutor_nombre, $_nombre);
					?>
					<? if($por_estudiante): ?>
					<div class="more">
						<b>Usbid:</b> <? echo $value['usbid_estudiante']; ?>		
					</div>
					<div class="more">
						<b>Carrera:</b>
						<?
							$sql = "SELECT * FROM carrera WHERE codigo='".$value['carrera']."' AND carrera_sede='$_SESSION[sede]'";
							$resultado = ejecutarConsulta($sql, $conexion);
							$row = obtenerResultados($resultado);
							echo $row['nombre'] . " (" . $row['codigo'] . ")";
						?>						
						<br><b>Proyecto:</b> <? echo $value['codigo']; ?>
						<br><b>Tutor:</b> 
						<? 
							$sql = "SELECT nombre, apellido FROM usuario_miembro_usb, usuario WHERE usbid_usuario='".$value['tutor']."' AND usbid = usbid_usuario";
							$resultado = ejecutarConsulta($sql, $conexion);
							$row = obtenerResultados($resultado);
							echo $row['nombre']." ".$row['apellido']; 
						?>
						<br><b>Fecha Inscripción:</b> <? echo $value['fecha_inscip']; ?>
						<? 	
							if ($value['culminacion_validada']=="SI"){
								if($value['obs']=="Retirado por el Sistema"){
									echo "<b><br>Estado:</b> Retirado";
								}else{
									echo "<b><br>Estado:</b> Culminado";
								}
							}else{
								if($value['fecha_fin_real']=='0000-00-00'){
									echo "<b><br>Estado:</b> Activo";
								}else{
									echo "<b><br>Estado:</b> Culminado <span class=rojo >(No validado por la CCTDS)</span>";
								}								
							}
						?>
					</div>
					<!--
					<div class="more">
						<b>Tel&eacute;fonos:</b> <? echo implode(', ', array_filter(array($value['telf_hab'], $value['telf_cel']))); ?>
					</div>
					-->
					<? endif; ?>

					<? if($por_tutor): ?>
						<div class="more">
							<b>Usbid:</b> <? echo $value['tutor']; ?>
						</div>
						<div class="more">
							<b>Estudiantes totales que ha tutoreado:</b>
							<?
								// Obtenemos, y listamos, los estudiantes tutoreados
								$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE tutor='".$value['usbid']."'";
								$res = ejecutarConsulta($sql, $conexion);
								$fila = obtenerResultados($res);
								if ($fila['totales']!=0){
									echo "<a href='vVerEstudiantesProyecto.php?opcion=listar_estudiantesXtutor&tutor=".$value['usbid']."'>".$fila['totales']."</a>";
								}else{
									echo "0";
								}
							?>
						</div>
					
					<? endif; ?>

					<div class="more">
						<a href="mailto:<? echo $value['email_sec']; ?>"><? echo $value['email_sec']; ?></a>
					</div>

					<div class="opciones_proyecto">
					<? if(!isCoordinacion() && !isDepartamento()): 
						if($por_estudiante): ?>
							<a href="vActualizarDatosEstudiante.php?usbid=<? echo $value['usbid_estudiante']; ?>"><img src="imagenes/iconos/modinsc.png" alt="" title="Modificar Perfil" /></a>
							<a href="vModificarInscripcion.php?usbid=<? echo $value['usbid_estudiante']?>&id=<? echo $value['id']?>"><img src="imagenes/iconos/txt.png" alt="" title="Modificar Inscripción" /></a>
							<a href='javascript:openprompt("aviso4","<? echo $value['usbid_estudiante']?>","usbid=<? echo $value['usbid_estudiante']?>&id_insc=<? echo $value['id_insc']?>")'><img src="imagenes/iconos/retirar.png" alt="" title="Retirar del Proyecto" /></a>
						
						<? else: ?>
							<a href="vActualizarDatos.php?usbid=<? echo $value['tutor']; ?>"><img src="imagenes/iconos/modinsc.png" alt="" title="Modificar Perfil" /></a>
							<a href="vActualizarDatos.php?usbid=<? echo $value['tutor']; ?>"><img src="imagenes/iconos/blockUser.png" alt="" title="Desabilitar Tutor" /></a>
						<? endif; 
					   endif;?>
					</div>
				</li>
			<? endforeach; ?>
			</ol>

		<? else: ?>
			<? if($por_proyecto): ?>
			<h2>Proyectos desde el a&ntilde;o <? echo truncate_year($RESULT_PROYECTOS[0]['fecha_ingreso']); ?></h2>
			<? elseif($por_estudiante): ?>
			<h2>Inscripciones realizadas por los estudiantes</h2>
			<? elseif($por_tutor): ?>
			<h2>Tutor&iacute;as realizadas (por incripci&oacute;n de proyectos)</h2>
			<? endif; ?>

			<ol id="result_list" start="<? echo $offset+1 ?>">
			<? foreach($RESULT_PROYECTOS as $value): ?>
				<li>
					<b><? 	
						if ($value['codigo']<>"") {
							echo $value['codigo'];
							$aprobado=true;
						}
						else{ 
							echo "C&oacute;digo no asignado"; 
							$aprobado=false;
						}
						?></b>.
					<? echo resaltar_palabras_en_frase($palabras_clave, $value['titulo']); ?>

					<div class="more">
						<b>Tipo:</b> <? if ($aprobado) echo $value['tipo']; else echo "No asignado"; ?>
					</div>

					<? if($por_estudiante OR $por_tutor): ?>
					<div class="more">
						Inscripci&oacute;n realizada el <b><? echo date('m \d\e Y', strtotime($value['fecha_inscip'])); ?></b>
					</div>
					<? endif; ?>

					<? if($por_tutor): ?>
					<div class="more">
						<b>Tutor:</b>
						<?
							$_result = array_filter( array($value['usuario_apellido'], $value['usuario_nombre']) );
							echo implode(', ', $_result);
						?>
					</div>
					<div class="more">
						<b>Estudiante:</b>
						<?
							$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE u.usbid='".$value['usbid_estudiante']."'";
							$resultado = ejecutarConsulta($sql, $conexion);
							$_result = array();
							while ($row = obtenerResultados($resultado)){
								$_result[] = $row['nombre'].' '.$row['apellido'];
							}
							echo implode(', ', $_result);
						?>
					</div>
					<? endif; ?>

					<div class="more">
					<b>Estudiantes totales que han inscrito el proyecto:</b>
					<?
						// Obtenemos, y listamos, los inscritos que ha tenido el proyecto
						$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE id_proyecto='".$value['id']."'";
						$resultado = ejecutarConsulta($sql, $conexion);
						$_result = array();
						while ($row = obtenerResultados($resultado)){
							$_result[] = $row['totales'];
						}
						$inscritos=implode(', ', $_result); 						
                                                if ($inscritos!=0)
                                                    echo "<a href='vVerEstudiantesProyecto.php?opcion=listar_estudiantes&proyecto=".$value['id']."'>".$inscritos."</a>"; 
                                                else
                                                    echo $inscritos;
					?>
					</div>

					<? if($por_estudiante): ?>
					<div class="more">
						<b>Inscrito por:</b> <a href="mailto:<? echo $value['email_sec']; ?>"><? echo $value['usuario_nombre'] ?> <? echo $value['usuario_apellido'] ?> (<? echo $value['usbid']; ?>)</a>
					</div>
					<div class="more">
						<b>Tutor:</b>
						<?
							echo $value['tutor'];
						?>
					</div>
					<? endif; ?>

					<? if($por_tutor): ?>
					<div class="more">
						<b>Tutor a cargo:</b> <a href="mailto:<? echo $value['email_sec']; ?>"><? echo $value['usuario_nombre'] ?> <? echo $value['usuario_apellido'] ?> (<? echo $value['usbid']; ?>)</a>
					</div>
					<? endif; ?>

					<div class="opciones_proyecto">
						<a href="vVerProyecto.php?id=<? echo $value['id'] ?>"><? echo mostrarImagen('ver'); ?></a>&nbsp;&nbsp;
						<? if(!isCoordinacion() && !isDepartamento()){?>
						<a href="vModificarProyecto.php?id=<? echo $value['id'] ?>&tok=<? echo $_SESSION[csrf]?>"><? echo mostrarImagen('modificar'); ?></a>&nbsp;&nbsp;
                                                <a href='javascript:openprompt("aviso2","<? echo $value['codigo'] ?> a <? echo $CHANGE_TIPO[$value['tipo']]; ?>",<? echo $value['id'] ?>)'>
                                                <!--<a href="cCambiarTipoProy.php?id=<? echo $value['id'] ?>" onclick="return confirm('Esta a punto de cambiar el tipo del proyecto <? echo $value['codigo'] ?> a <? echo $CHANGE_TIPO[$value['tipo']]; ?>.\n&iquest;Desea continuar?')">-->
                                                    <img src="imagenes/iconos/reload.png" alt="" width='15' height='15' title="Cambiar a <? echo $CHANGE_TIPO[$value['tipo']]; ?>" /></a>&nbsp;&nbsp;
                                                <a href='javascript:openprompt("aviso3","Esta a punto de <? echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?> el proyecto <? echo $value['codigo'] ?>","<? echo $CHANGE_CULMINADO[$value['culminado']] ?>&id=<? echo $value['id'] ?>")'>
						<!--<a href="cCambiarStatusProy.php?culminado=<? echo $CHANGE_CULMINADO[$value['culminado']] ?>&id=<? echo $value['id'] ?>" onclick="return confirm('Esta a punto de <? echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?> el proyecto <? echo $value['codigo'] ?>.\n&iquest;Desea continuar?')">-->
                                                    <img src="imagenes/iconos/<? echo ($value['culminado'] == 'NO')?'candado_abierto':'candado'; ?>.png" alt="" title="<? echo ($value['culminado'] == 'NO')?'CULMINAR':'REABRIR'; ?>"/></a>
						<? 
						if ($value['codigo']==""){
							?>
                                                <a href='javascript:openprompt("aviso1","<? echo trim($value['titulo']) ?>",<? echo $value['id'] ?>)'>
							<!--<a href="cEliminarProyecto.php?id=<? echo $value['id'] ?>" onclick="return confirm('Esta a punto de eliminar el proyecto: <? echo trim($value['titulo']) ?>. \nEsta operacion no se puede deshacer.\n&iquest;Desea continuar?')">-->
							<?
							echo mostrarImagen('eliminar');
						}  }?></a>
					</div>
				</li>
			<? endforeach; ?>
			</ol>

		<? endif; ?>

		<hr />
		<? if(!$ver_reporte) get_pagination($offset, count($RESULT_ALL_PROYECTOS)); ?>

		<? endif; ?>
	</div>

	<div class="clear">
		<pre><? /* DEBUG */ // print_r( $TABLA_RESUMEN ); ?></pre>
		<pre><? /* DEBUG */ // print_r( $RESULT_PROYECTOS ); ?></pre>
		<pre><? /* DEBUG */ // echo get_search_query(); ?></pre>
	</div>


<? include_once('vFooter.php'); ?>
<?
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
