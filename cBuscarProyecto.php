<?php
/*
 * Busqueda de Proyectos.
 */
define('MY_DEBUG', 0);
define('ITEMS_PER_PAGE', 20);
define('DEFAULT_NO_ESPECIFICADO', 'No especificado');

/*
 * Definamos algunas funciones de utileria con querys de busqueda
 */
/*
 * Nos da una array con los campos minimos esperados para una busqueda corrrecta
 */
function get_default_search_query() {
	return array('search' => 1,
		'offset' => 0,
		'items_per_page' => ITEMS_PER_PAGE,
		'por_proyecto' => 1);
}
/*
 * Nos da los parametros de busqueda usados en la consulta.
 * Los parametros de la busqueda realizada pueden ser modificados si se
 * especifican los criterios que se quieran cambiar como parametro.
 *
 * @param  array    $new_search Contiene los nuevos criterios de busqueda
 * @return array    Una lista con los criterios de busqueda.
 */
function get_search_array($new_search = array()) {
	if(isset($_POST['search']))
		$query = $_POST;
	elseif(isset($_GET['search']))
		$query = $_GET;
	else
		$query = get_default_search_query();

	return array_merge($query, $new_search);
}
/*
 * Igual que get_search_array, solo que devuelve un Query String
 */
function get_search_query($new_search = array()) {
	return http_build_query(get_search_array($new_search));
}
/*
 * Trunca la fecha, conservando solo el anio
 */
function truncate_year($fecha) {
	if(!$fecha) return $fecha;

	@list($anio, $mes, $dia) = $time = explode('-', $fecha);
	if(count($time) != 3)
		// return $fecha;
		return '';

	return $anio;
}
/*
 * Trunca la fecha, conservando solo el mes
 */
function truncate_mes($fecha) {
	if(!$fecha) return $fecha;

	@list($anio, $mes, $dia) = $time = explode('-', $fecha);
	if(count($time) != 3)
		// return $fecha;
		return '';

	return $mes;
}
/*
 * Suma/Resta a una fecha, los anios, meses y dias indicados.
 *
 * @return String    La nueva fecha
 */
function sum_fecha($fecha, $anios=0, $meses=0, $dias=0){
	if(!$fecha)
		return $fecha;

	@list($anio, $mes, $dia) = $time = explode('-', $fecha);
	if(count($time) != 3)
		return $fecha;

	$anio = (int)$anio + $anios;
	$mes = (int)$mes + $meses;
	$dia = (int)$dia + $dias;
	return sprintf("%04d-%02d-%02d", $anio, $mes, $dia);
}
/*
 * Obtiene una serie de anios que van desde el incial, hasta el final
 */
function list_anios($desde, $hasta, $count=5) {
	$now = (int)date('Y');
	$hasta = (int)$hasta;
	$desde = (int)$desde;

	if( !$hasta OR $hasta>$now ) $hasta = $now;
	if( !$desde OR $desde > $hasta ) $desde = $hasta - $count;

	$distancia = $hasta - $desde + 1;
	$result = array();
	for($i=0; $i<$distancia AND $desde <= $hasta-$i; $i++){
		$result[] = $hasta-$i;
	}
	// echo "$desde - $hasta\n";
	return array_reverse($result);
}
/*
 * Acomoda el LIMIT de un sql
 */
function fix_param() {
	global $offset, $items_per_page;

	$offset = (int)$offset;
	$items_per_page = (int)$items_per_page;

	if($offset < 0) $offset = 0;
	if(!$items_per_page) $items_per_page = ITEMS_PER_PAGE;
}
/*
 * Obtiene las "opciones "paginas" del menu de paginacion
 */
function get_pagination($offset, $total, $items_per_page = ITEMS_PER_PAGE) {
	$pages = ceil($total/$items_per_page);
	$current = get_current_page($offset, $items_per_page);
	$bound = 2;

	$inicio = ($current-$bound<0)?0:$current-$bound;
	$fin = ($current+$bound+1>$pages)?$pages:$current+$bound+1;
?>
<div class="paginacion_box">
	<ul class="paginacion">
		<li><span class="paginacion_legend">P&aacute;ginas (<?php echo $pages ?>):</span></li>
		<?php if($current>0): ?>
		<li>
			<a href="?<?php
				// $query = get_search_array();
				$new_query = get_search_query(array(
					'offset' => 0
				));
				echo $new_query;
			?>">&lt;&lt;</a>
		</li>
		<li>
			<a href="?<?php
				// $query = get_search_array();
				$new_query = get_search_query(array(
					'offset' => $offset-$items_per_page
				));
				echo $new_query;
			?>">&lt;</a>
		</li>
		<?php endif; ?>
		<?php for($i=$inicio; $i<$fin; $i++): ?>
		<li class="<?php if(get_current_page($offset, $items_per_page)==$i) echo 'actual'; ?>">
			<a href="?<?php
				// $query = get_search_array();
				$new_query = get_search_query(array(
					'offset' => $i*$items_per_page
				));
				echo $new_query;
			?>"><?php echo $i+1 ?></a>
		</li>
		<?php endfor; ?>
		<?php if($current+1 < $pages): ?>
		<li>
			<a href="?<?php
				// $query = get_search_array();
				$new_query = get_search_query(array(
					'offset' => $offset+$items_per_page
				));
				echo $new_query;
			?>">&gt;</a>
		</li>
		<li>
			<a href="?<?php
				// $query = get_search_array();
				$new_query = get_search_query(array(
					'offset' => ($pages-1)*$items_per_page
				));
				echo $new_query;
			?>">&gt;&gt;</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
<?php
}
/*
 * Obtiene el numero de pagina actual
 */
function get_current_page($offset, $items_per_page = ITEMS_PER_PAGE) {
	return ceil($offset/$items_per_page);
}
/*
 * Resalta las palabras de la frase suministrada, que se encuentren en el
 * texto, con sintaxis HTML.
 */
function resaltar_palabras_en_frase($frase = array(), $texto = ''){
	$_colors = array('#B3C6FF', '#C6B3FF', '#ECB3FF', '#FFB3EC', '#B3ECFF', '#FFB3C6');
	$_palabras_clave = array_filter(explode(' ', $frase));
	$_colors_count = count($_colors);

	$i = 0;
	$_word_preg = array();
	$_word_replace = array();
	foreach($_palabras_clave as $_word){
		$_word_preg[] = '/'.strtolower($_word).'/i';
		$_word_replace[] =
			'<span style="background-color:'.$_colors[$i%$_colors_count].'">' .
			'\0' .
			'</span>';
		$i++;
	}
	return preg_replace($_word_preg, $_word_replace, $texto);
}

require "cAutorizacion.php";
// unset($_SESSION[proyecto]);
$modo_depuracion=FALSE;
$CHANGE_TIPO = array(
	'PUNTUAL' => 'CONTINUO',
	'CONTINUO' => 'PUNTUAL'
);
$CHANGE_CULMINADO = array(
	'SI' => 'NO',
	'NO' => 'SI'
);

// Para formulario de proyectos
$LISTA_PROYECTOS = array();
$LISTA_AREA_PROYECTO = array();
$LISTA_COMUNIDAD = array();
$LISTA_ORGANIZACION = array();
//$LISTA_REPRESENTANTE = array();

// para formulario de estudiantes
$LISTA_COHORTE = array();
$LISTA_CARRERA = array();

// para formulario de tutores
$LISTA_USBID = array();
$LISTA_DEPENDENCIA = array();

// Resultados de la busqueda
$RESULT_PROYECTOS = array();
$RESULT_ALL_PROYECTOS = array();
$RESULT_USB_LIST = array();
$TABLA_RESUMEN = array();
$RESULT_TOTAL_BY_AREA = array();

/*
 * Para el formulario de proyectos
 */
// Listado de codigo de Proyectos
$sql = "select codigo FROM proyecto ORDER BY codigo ";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_PROYECTOS[] = $row;

// Listado de areas de Proyecto
$sql = "select * FROM area_proyecto ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_AREA_PROYECTO[] = $row;

// Listado de comunidades
$sql = "select * FROM comunidad ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_COMUNIDAD[] = $row;

// Listado de representantes
$sql = "select * FROM representante ORDER BY apellidos";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_REPRESENTANTE[] = $row;

// Listado de organizaciones
$sql = "select * FROM organizacion ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_ORGANIZACION[] = $row;

/*
 * Para el formulario de estudiantes
 */
for($i = (int)date('y'); $i>=0; $i--) $LISTA_COHORTE[] = sprintf("%02d", $i);
for($i = 99; $i>=80; $i--) $LISTA_COHORTE[] = sprintf("%02d", $i);

// Lista de carreras registradas
// $sql = "SELECT carrera FROM usuario_estudiante WHERE carrera <> '' AND carrera IS NOT NULL GROUP BY carrera";
if(isCoordinacion())
	$sql = "SELECT * FROM carrera WHERE coordinacion = '$_SESSION[USBID]' ORDER BY nombre";
else
	$sql = "SELECT * FROM carrera ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_CARRERA[] = $row;


/*
 * Para formulario de tutores
 */
// Lista de usbid miembros usb (no estudiantes)
$sql = "SELECT * FROM usuario_miembro_usb GROUP BY usbid_usuario;";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_USBID[] = $row;

// Lista de dependencias usb
if(isDepartamento())
	$sql = "SELECT * FROM dependencia WHERE id = '$_SESSION[dependencia]' ORDER BY nombre;";
else
	$sql = "SELECT * FROM dependencia;";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_DEPENDENCIA[] = $row;


// Creamos variables con los datos de entrada, por simplicidad
if(isset($_POST['search']))
	extract($_POST);
else
	extract($_GET);

// Esto se asegura de que algunos parametros esten bien formados
fix_param();

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Consultas de busqueda
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
if(isset($por_estudiante)) {
	// Busqueda por estudiante!!
	$sql_proyecto =
"SELECT i.observaciones obs, i.id id_insc, i.*, e.*,
u.usbid, u.nombre usuario_nombre, u.apellido usuario_apellido,
a.*, eva.*, p.* "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_estudiante e ON (i.usbid_estudiante = e.usbid_usuario) "
		. " LEFT JOIN usuario_miembro_usb up ON (i.tutor = up.usbid_usuario) "
		. " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " LEFT JOIN carrera c ON (c.codigo = e.carrera) "
		. " WHERE p.status_proy='POSTULADO' ";
            if ($_SESSION[sede]=='Litoral') {
 $sql_proyecto  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
		. " Length(e.usbid_usuario)=7)) ";
            } else
            if ($_SESSION[sede]=='Sartenejas') {
 $sql_proyecto  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
                . " Length(e.usbid_usuario)=8)) ";
            }
		//. " WHERE ''='' ";

	$sql_totales = "SELECT i.*, e.*, u.*, a.*, eva.*, p.*, COUNT(*) totales "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_estudiante e ON (i.usbid_estudiante = e.usbid_usuario) "
		. " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " LEFT JOIN usuario_miembro_usb up ON (i.tutor = up.usbid_usuario) "
		. " LEFT JOIN carrera c ON (c.codigo = e.carrera) "
		. " WHERE p.status_proy='POSTULADO' ";
            if ($_SESSION[sede]=='Litoral') {
  $sql_totales  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
		. " Length(e.usbid_usuario)=7)) ";
            } else
            if ($_SESSION[sede]=='Sartenejas') {
  $sql_totales  .=" AND (e.estudiante_sede='$_SESSION[sede]' OR (e.estudiante_sede IS NULL AND "
                . " Length(e.usbid_usuario)=8)) ";
            }
                //. " WHERE ''='' ";
	if(isCoordinacion()){
		$sql_proyecto .= " AND c.coordinacion = '$_SESSION[USBID]' ";
		$sql_totales .= " AND c.coordinacion = '$_SESSION[USBID]' ";
	}
	if(isDepartamento()){
		$sql_proyecto .= " AND up.dependencia ='$_SESSION[dependencia]' ";
		$sql_totales .= " AND up.dependencia ='$_SESSION[dependencia]' ";
	}
}
elseif(isset($por_tutor)) {
	// Busqueda por tutor!!
	$sql_proyecto =
"SELECT i.*, e.*,
u.usbid, u.nombre usuario_nombre, u.apellido usuario_apellido,
a.*, eva.*, p.* "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_miembro_usb e ON (i.tutor = e.usbid_usuario) "
		. " JOIN departamento dep ON (e.dependencia = dep.id AND dep.sede = '$_SESSION[sede]') "
		. " JOIN usuario_estudiante ue ON (i.usbid_estudiante = ue.usbid_usuario) "
		. " LEFT JOIN carrera c ON (c.codigo = ue.carrera) "
				. " LEFT JOIN usuario u ON (i.tutor = u.usbid) "
                . " LEFT JOIN dependencia d ON (d.id = e.dependencia) "
		. " WHERE p.status_proy='POSTULADO' ";
                //. " WHERE ''='' ";
        
	$sql_totales = "SELECT i.*, e.*, u.*, a.*, eva.*, p.*, COUNT(*) totales "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_miembro_usb e ON (i.tutor = e.usbid_usuario) "
		. " JOIN usuario_estudiante ue ON (i.usbid_estudiante = ue.usbid_usuario) "
		. " JOIN departamento dep ON (e.dependencia = dep.id AND dep.sede = '$_SESSION[sede]') "
		. " LEFT JOIN carrera c ON (c.codigo = ue.carrera) "
                . " LEFT JOIN usuario u ON (i.tutor = u.usbid) "
                . " LEFT JOIN dependencia d ON (d.id = e.dependencia) "
		. " WHERE p.status_proy='POSTULADO' ";
                //. " WHERE ''='' ";
				
	if(isCoordinacion()){
		$sql_proyecto .= " AND c.coordinacion = '$_SESSION[USBID]' ";
		$sql_totales .= " AND c.coordinacion = '$_SESSION[USBID]' ";
	}
	if(isDepartamento()){
		$sql_proyecto .= "AND d.id ='$_SESSION[dependencia]' ";
		$sql_totales .= "AND d.id ='$_SESSION[dependencia]' ";
	}
}
//elseif(isset($por_trimestre)){
//}
else {
	// Busqueda por proyecto!!

	$sql_totales = "SELECT a.*, eva.*, p.*, COUNT(*) totales "
		. " FROM proyecto p "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " WHERE p.status_proy='POSTULADO' ";
				
	if(isCoordinacion()){
		$sql_kenyer = " AND p.id IN (SELECT DISTINCT id_proyecto FROM inscripcion i, usuario_estudiante ue, carrera ca WHERE ue.carrera = ca.codigo AND i.usbid_estudiante = ue.usbid_usuario  AND ca.coordinacion = '$_SESSION[USBID]') ";
		
		$sql_proyecto = "SELECT a.*, eva.*, p.* "
			. " FROM inscripcion i "
			. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
			. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
			. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
			. " JOIN carrera ca "
			. " LEFT JOIN usuario_estudiante ue ON (i.usbid_estudiante = ue.usbid_usuario) "
			. " WHERE p.status_proy='POSTULADO' AND ue.carrera = ca.codigo AND ca.coordinacion = '$_SESSION[USBID]'";
		
	}elseif(isDepartamento()){
		
		$sql_kenyer = " AND (p.usbid_postula = '$_SESSION[dependencia]' OR p.id IN (SELECT DISTINCT id_proyecto FROM inscripcion i, usuario_miembro_usb up WHERE i.tutor = up.usbid_usuario AND up.dependencia = '$_SESSION[dependencia]')) ";
		
		$sql_proyecto = "SELECT a.*, eva.*, p.* "
			. " FROM inscripcion i "
			. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
			. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
			. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
			. " LEFT JOIN usuario_miembro_usb up ON (i.tutor = up.usbid_usuario) "
			. " WHERE p.status_proy='POSTULADO' AND (up.dependencia = '$_SESSION[dependencia]' OR  p.usbid_postula = '$_SESSION[dependencia]') ";
	}else{
		$sql_kenyer = "";
	
		$sql_proyecto = "SELECT a.*, eva.*, p.* "
		. " FROM proyecto p "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " WHERE p.status_proy='POSTULADO' ";	
	}
}

$constrains = '';
// restricciones comunes
if(isset($por_proyecto)) {
	if( !empty($desde) )    $constrains .= " AND fecha_ingreso >= '".$desde."' ";
	if( !empty($hasta) )    $constrains .= " AND fecha_ingreso <= '".$hasta."' ";
} else {
	if( !empty($desde) )    $constrains .= " AND i.fecha_inscip >= '".$desde."' ";
	if( !empty($hasta) )    $constrains .= " AND i.fecha_inscip <= '".$hasta."' ";
}

if( !empty($tipo_proy) )    $constrains .= " AND eva.tipo = '".$tipo_proy."' ";

if( !empty($palabras_clave) ){
	$_palabras_clave = array_filter(explode(' ', $palabras_clave));
	foreach($_palabras_clave as $_word){
		$constrains .= " AND p.titulo LIKE '%".$_word."%' ";
	}
}

// restricciones por proyecto
if( !empty($codigo_proyecto))$constrains .= " AND codigo = '".$codigo_proyecto."' ";
if( !empty($area_proyecto) ) $constrains .= " AND id_area_proy = '".$area_proyecto."' ";
if( !empty($comunidad) )     $constrains .= " AND id_comunidad = '".$comunidad."' ";
//if( !empty($representante) ) $constrains .= " AND id_representante = '".$representante."' ";
if( !empty($organizacion) )  $constrains .= " AND id_organizacion = '".$organizacion."' ";
if( !empty($aprobado) )      $constrains .= " AND aprobado = '".$aprobado."' ";
if( !empty($culminado) )     $constrains .= " AND culminado = '".$culminado."' ";

// restricciones por estudiante
if( $byest_culminado == 'SI')$constrains .= " AND i.culminacion_validada = 'SI' ";
if( $byest_culminado == 'NO')$constrains .= " AND i.culminacion_validada = '' AND fecha_fin_real='0000-00-00' "; 
if( $byest_culminado == 'SI_NV')$constrains .= " AND i.culminacion_validada = '' AND fecha_fin_real != '0000-00-00' "; 
if( $inscrito == 'SI')       $constrains .= " AND i.aprobado = 'SI' ";
if( $inscrito == 'NO')       $constrains .= " AND i.aprobado = '' "; 
if( !empty($desde_est) )     $constrains .= " AND fecha_inscip	 >= '".$desde_est."' ";
if( !empty($hasta_est) )     $constrains .= " AND fecha_inscip	 <= '".$hasta_est."' ";
if( !empty($desde_culmina) )     $constrains .= " AND fecha_fin_real >= '".$desde_culmina."' AND fecha_fin_real != 0000-00-00 ";
if( !empty($hasta_culmina) )     $constrains .= " AND fecha_fin_real <= '".$hasta_culmina."' AND fecha_fin_real != 0000-00-00 ";
if( !empty($est_carnet) )    $constrains .= " AND usbid = '".$est_carnet."' ";
if( !empty($est_cohorte) )   $constrains .= " AND cohorte = '".$est_cohorte."' ";
if( !empty($est_carrera) )   $constrains .= " AND carrera = '".$est_carrera."' ";
if( !empty($est_email) )     $constrains .= " AND email_sec LIKE '%".$est_email."%' ";
if( !empty($est_sexo) )      $constrains .= " AND sexo = '".$est_sexo."' ";
if( !empty($est_nombre) )    $constrains .= " AND CONCAT(u.nombre, u.apellido) LIKE '%".$est_nombre."%' ";
if( !empty($est_carrera_duracion) )   $constrains .= " AND c.carrera_duracion = '".$est_carrera_duracion."' ";
if( !empty($est_carrera_sede) )       $constrains .= " AND (carrera_sede LIKE '%".$est_carrera_sede."%' OR e.estudiante_sede = '".$est_carrera_sede."')";

// restricciones por tutor
if( !empty($tutor_usbid) )       $constrains .= " AND e.usbid_usuario = '".$tutor_usbid."' ";
if( !empty($tutor_dependencia) ) $constrains .= " AND d.id = '".$tutor_dependencia."' ";
if( !empty($tutor_email) )       $constrains .= " AND email_sec LIKE '%".$tutor_email."%' ";
if( !empty($tutor_nombre) )      $constrains .= " AND CONCAT(u.nombre, u.apellido) LIKE '%".$tutor_nombre."%' ";


// Proyectos, con paginacion
if(!isCoordinacion() and !isDepartamento())
	$sql = $sql_proyecto . $constrains . (($ver_usb)?'GROUP BY usbid ORDER BY p.codigo, usuario_apellido, usuario_nombre':'ORDER BY p.codigo') . " LIMIT ". $offset . ", ".$items_per_page;
else
	$sql = $sql_proyecto . $constrains . (($ver_usb)?'GROUP BY usbid ORDER BY p.codigo, usuario_apellido, usuario_nombre':'GROUP BY p.codigo ORDER BY p.codigo') . " LIMIT ". $offset . ", ".$items_per_page;
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$RESULT_PROYECTOS[] = $row;
if(MY_DEBUG) echo "DEBUG: $sql || $aprobado<br />";

// Proyectos totales, sin paginacion
if(!isCoordinacion())
	$sql = $sql_proyecto . $constrains . (($ver_usb)?'GROUP BY usbid ORDER BY p.codigo ':' ORDER BY p.codigo');
else
	$sql = $sql_proyecto . $constrains . (($ver_usb)?'GROUP BY usbid ORDER BY p.codigo ':'GROUP BY p.codigo ORDER BY p.codigo');
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$RESULT_ALL_PROYECTOS[] = $row;
if(MY_DEBUG) echo "DEBUG RESULT_ALL_PROYECTOS: $sql || $aprobado<br />";

/*
// Miembros USB involucrados en los proyectos resultados de busqueda
if($ver_usb AND $por_estudiante ){
	$sql = $sql_proyecto . $constrains . " GROUP BY usbid_estudiante LIMIT ". $offset . ", ".$items_per_page;
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$RESULT_USB_LIST[] = $row;
	if(MY_DEBUG) echo "DEBUG: $sql || $aprobado<br />";
}
elseif($ver_usb AND $por_tutor ){
	$sql = $sql_proyecto . $constrains . " GROUP BY usbid_usuario LIMIT ". $offset . ", ".$items_per_page;
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$RESULT_USB_LIST[] = $row;
	if(MY_DEBUG) echo "DEBUG: $sql || $aprobado<br />";
}
*/


// Vamos a buscar totales de proyectos, por anio
// usamos $sql_totales

$_anios = list_anios($desde, $hasta);
$_max_tabla_resumen = 0;
foreach($_anios as $_anio){
	$new_sql = $sql_totales . $constrains . $sql_kenyer;

	if($por_tutor || $por_estudiante){
		$new_sql .= " AND YEAR(i.fecha_inscip) = '$_anio' GROUP BY a.siglas ".(($ver_usb)?', usbid ':'')." ORDER BY a.nombre";
	} else {
		/*
		 *  En caso de buscar por estudiante/tutor, hay que mirar las fechas
		 * de inscripciones, no las de creacion del proyecto
		 */
		$new_sql .= " AND YEAR(p.fecha_ingreso) = '$_anio' GROUP BY a.siglas ORDER BY a.nombre";
	}

	// DEBUG
	if(MY_DEBUG) echo 'TABLA_RESUMEN: ' . $new_sql.'<br />';
	$resultado = ejecutarConsulta($new_sql, $conexion);

	// Inicializamos
	$TABLA_RESUMEN[''.$_anio] = array();
	foreach($LISTA_AREA_PROYECTO as $area)
		$TABLA_RESUMEN[''.$_anio][$area['siglas']] = 0;

	while ($row = obtenerResultados($resultado)) {
		if($ver_usb AND $por_tutor){
			/*
			 * En este caso particular, no nos interesa contar inscripciones,
			 * sino el numero de apariciones de cada tutor
			 */
			++$TABLA_RESUMEN[''.$_anio][$row['siglas']];
			if($TABLA_RESUMEN[''.$_anio][$row['siglas']] > $_max_tabla_resumen)
				$_max_tabla_resumen = $TABLA_RESUMEN[''.$_anio][$row['siglas']];
		} else {
			// Procedimiento normal
			$TABLA_RESUMEN[''.$_anio][$row['siglas']] += (int)$row['totales'];
			if($TABLA_RESUMEN[''.$_anio][$row['siglas']] > $_max_tabla_resumen)
				$_max_tabla_resumen = $TABLA_RESUMEN[''.$_anio][$row['siglas']];
		}
	}
}

// GROUP BY a.siglas ORDER BY a.nombre;

// Traemos los totales globales por area de proyecto
$sql = $sql_totales . $constrains . $sql_kenyer . " GROUP BY a.siglas";
$resultado = ejecutarConsulta($sql, $conexion);

// Inicializamos
foreach($LISTA_AREA_PROYECTO as $area) $RESULT_TOTAL_BY_AREA[$area['siglas']] = 0;

$_max_total_result = 0;
while ($row = obtenerResultados($resultado)){
	$RESULT_TOTAL_BY_AREA[$row['siglas']] = (int)$row['totales'];
	if((int)$row['totales']>$_max_total_result)
		$_max_total_result = (int)$row['totales'];
}
if(MY_DEBUG) echo "DEBUG: $sql || $aprobado<br />";



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Generador de reportes graficos :D
 *
 * Usando las herramientas de google para generar los reportes.
 * http://code.google.com/intl/es-CL/apis/chart/
 * http://code.google.com/intl/es-CL/apis/chart/docs/gallery/chart_gall.html
 */
$_REP_COLORS = array();
$_REP_COLORS_ = array(
	'FF906B', 'FFDA6B', 'DAFF6B', '90FF6B',
	'00B4F0', 'FF6B90', 'FF622E', 'F03C00',
	'DA6BFF', '906BFF', '6B90FF'
);
$i=0;
$len=count($_REP_COLORS_);
foreach($LISTA_AREA_PROYECTO as $area) {
	$_REP_COLORS[$area['siglas']] = $_REP_COLORS_[$i%($len)];
	$i++;
}

/* * * * Resultados anuales * * * */
// Parametros con los datos
$rep_byanio_chd = array();
$rep_byanio_chxl = array();
$rep_byanio_chxr =
	str_replace('{max}', $_max_tabla_resumen, '0,0,{max}');
$rep_byanio_chco = array();
$rep_byanio_chds = array();
$rep_byanio_chdl = array();
$rep_byanio_chtt = '';

if($por_proyecto){
	$rep_byanio_chtt = 'Proyectos';
} elseif($por_estudiante){
	$rep_byanio_chtt = 'Inscripciones realizadas por estos estudiantes';
} elseif($por_tutor){
	$rep_byanio_chtt = 'Tutor&iacute;as realizadas';
}

// Datos
$_anios = list_anios($desde, $hasta);
$_temp_color = array();
foreach($LISTA_AREA_PROYECTO as $area)
{
	if( !isset($area_proyecto) || !$area_proyecto || $area_proyecto == $area['id'])
	{
		$_temp_color[] = $_REP_COLORS[$area['siglas']];

		$_temp = array();
		foreach($_anios as $_anio)
		{
				$_temp[] = $TABLA_RESUMEN[''.$_anio][$area['siglas']];
			// echo $TABLA_RESUMEN[''.$_anio][$area['siglas']];
		}
		$rep_byanio_chd[] = implode(',', $_temp);
		$rep_byanio_chds[] = "0,{max}";
		$rep_byanio_chdl[] =
			str_replace(' ', '+', $area['nombre']." (".$area['siglas'].")");
	}
}
$rep_byanio_chd = 't:' . implode('|', $rep_byanio_chd);
$rep_byanio_chds =
	str_replace('{max}', $_max_tabla_resumen, implode(',', $rep_byanio_chds));
$rep_byanio_chco = implode(',', $_temp_color);
$rep_byanio_chdl = implode('|', $rep_byanio_chdl);

// Leyenda
foreach($_anios as $_anio)
	$rep_byanio_chxl[] = $_anio;
$rep_byanio_chxl = '1:|' . implode('|', $rep_byanio_chxl);

$REP_BYANIO__SRC = http_build_query(array(
	'cht' => 'bvg',
	'chxt' => 'y,x',
	'chbh' => 'r,0,16',
	'chdlp' => 'r',
	'chg' => '0,20',
	'chs' => '700x350',
	'chf' => 'bg,lg,0,FFFFFF,0,F7F7F7,1',
	'chtt' => $rep_byanio_chtt,
	'chts' => '000000,18',
	// 'chm' => 'N*p0*,333333,0,-1,'.$_max_tabla_resumen,
	'chd' => $rep_byanio_chd,
	'chxl' => $rep_byanio_chxl,
	'chxr' => $rep_byanio_chxr,
	'chco' => $rep_byanio_chco,
	'chds' => $rep_byanio_chds,
	'chdl' => $rep_byanio_chdl
));
$REP_BYANIO__SRC = urldecode($REP_BYANIO__SRC);

// echo '<img src="http://chart.apis.google.com/chart?'.$REP_BYANIO__SRC.'" alt="" />';
// print_r(urldecode($REP_BYANIO__SRC));
// echo "(". strlen($rep_byanio__src) .")";

$rep_bytotal_chd = array();	// resultados, por anios
$rep_bytotal_chl = array();
$rep_bytotal_chco = array();
$rep_bytotal_chtt = '';

if($por_proyecto){
	$rep_bytotal_chtt = 'Proyectos (Totales)';
} elseif($por_estudiante){
	$rep_bytotal_chtt = 'Inscripciones realizadas por estos estudiantes (Totales)';
} elseif($por_tutor){
	$rep_bytotal_chtt = 'Tutor&iacute;as realizadas (Totales)';
}

$i=0;
foreach($RESULT_TOTAL_BY_AREA as $area => $result)
{
	$rep_bytotal_chco[] = $_REP_COLORS[$area];
	$rep_bytotal_chd[] = $result;
	$rep_bytotal_chl[] =
		str_replace(' ', '+', $LISTA_AREA_PROYECTO[$i]['nombre']." (".$LISTA_AREA_PROYECTO[$i]['siglas'].")");
	$i++;
}
$rep_bytotal_chco = implode(',', $rep_bytotal_chco);
$rep_bytotal_chd = 't:' . implode(',', $rep_bytotal_chd);
$rep_bytotal_chl = implode('|', $rep_bytotal_chl);

$REP_BYTOTAL__SRC = http_build_query(array(
	'cht' => 'p3',
	'chbh' => 'a,0,16',
	'chs' => '650x200',
	'chf' => 'bg,lg,0,FFFFFF,0,F7F7F7,1',
	'chtt' => $rep_bytotal_chtt,
	'chts' => '000000,18',
	'chd' => $rep_bytotal_chd,
	'chco' => $rep_bytotal_chco,
	'chl' => $rep_bytotal_chl,
));
$REP_BYTOTAL__SRC = urldecode($REP_BYTOTAL__SRC);


$rep_bytotal_chxl = array();
$rep_bytotal_chco = array();
$rep_bytotal_chxr =
	str_replace('{max}', $_max_tabla_resumen, '0,0,{max}');
$rep_bytotal_chds = array();
$rep_bytotal_chdl = array();

$i=0;
foreach($RESULT_TOTAL_BY_AREA as $area => $result)
{
	$rep_bytotal_chco[] = $_REP_COLORS[$area];
	$rep_bytotal_chxl[] = trim($LISTA_AREA_PROYECTO[$i]['siglas']);
	$rep_bytotal_chds[] = "0,{max}";
	$rep_bytotal_chdl[] = trim($LISTA_AREA_PROYECTO[$i]['nombre']);
	$i++;
}
$rep_bytotal_chl = implode('|', $rep_bytotal_chl);
$rep_bytotal_chco = implode('|', $rep_bytotal_chco);
$rep_bytotal_chds =
	str_replace('{max}', $_max_total_result, implode(',', $rep_bytotal_chds));
$rep_bytotal_chxl = '1:|' . implode('|', $rep_bytotal_chxl);
$rep_bytotal_chdl = implode('|', $rep_bytotal_chdl);

$REP_BYTOTAL__SRC2 = http_build_query(array(
	'cht' => 'bvg',
	'chxt' => 'y,x',
	'chbh' => 'a,0,16',
	'chdlp' => 'r',
	'chg' => '0,20',
	'chs' => '650x300',
	'chf' => 'bg,lg,0,FFFFFF,0,F7F7F7,1',
	'chtt' => $rep_bytotal_chtt . ' - En Barras',
	'chts' => '000000,18',
	'chd' => $rep_bytotal_chd,
	'chxl' => $rep_bytotal_chxl,
	'chxr' => $rep_bytotal_chxr,
	'chco' => $rep_bytotal_chco,
	'chds' => $rep_bytotal_chds,
	// 'chl' => $rep_bytotal_chl,
	'chdl' => $rep_bytotal_chdl
));
$REP_BYTOTAL__SRC2 = urldecode($REP_BYTOTAL__SRC2);

// echo '<img src="http://chart.apis.google.com/chart?'.$REP_BYTOTAL__SRC.'" alt="" />';
// print_R($REP_BYTOTAL__SRC);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Exportar resultados como un XML
 *
 * Sencillo, si nos piden el XML, simplemente armamos uno, lo imprimimos
 * y TERMINAMOS EL SCRIPT.
 */
if($load_xml)
{
	if($ver_usb)
		if($por_estudiante)
			$newXML = new SimpleXMLElement("<estudiantes></estudiantes>");
		else
			$newXML = new SimpleXMLElement("<tutores></tutores>");
	else
		if($por_proyecto)
			$newXML = new SimpleXMLElement("<proyectos></proyectos>");
		else
			// Si no son proyectos, son inscripciones
			$newXML = new SimpleXMLElement("<inscripciones></inscripciones>");

	$newXML->addAttribute('total', count($RESULT_ALL_PROYECTOS));

	foreach($RESULT_ALL_PROYECTOS as $value)
	{
		// $newsXML->addAttribute('newsPagePrefix', 'value goes here');

		// Datos
		if($ver_usb) {
			if($por_estudiante){
				$newUsb = $newXML->addChild('estudiante');

				$newUsb->addChild('usbid', $value['usbid_estudiante']);
				$newUsb->addChild('carnet', $value['carnet']);
				$newUsb->addChild('nombre', $value['usuario_nombre']);
				$newUsb->addChild('apellido', $value['usuario_apellido']);
				$newUsb->addChild('sexo', $value['sexo']);
				$newUsb->addChild('cohorte', $value['cohorte']);
				$newUsb->addChild('carrera', $value['carrera']);
				$newUsb->addChild('email_alternativo', $value['email_sec']);
				$newUsb->addChild('id_insc', $value['id_insc']);
			} elseif($por_tutor) {
				$newUsb = $newXML->addChild('tutor');

				$newUsb->addChild('usbid', $value['tutor']);
				$newUsb->addChild('nombre', $value['usuario_nombre']);
				$newUsb->addChild('apellido', $value['usuario_apellido']);
				$newUsb->addChild('dependencia', $value['dependencia']);
				$newUsb->addChild('email_alternativo', $value['email_sec']);
			}
		} else {
			if($por_estudiante OR $por_tutor) {
				// Estamos manejando inscripciones
				$newInscrip = $newXML->addChild('inscripcion');

				$newInscrip->addChild('usbid_estudiante', $value['usbid_estudiante']);
				$newInscrip->addChild('tutor', $value['tutor']);
				$newInscrip->addChild('periodo', $value['periodo']);
				$newInscrip->addChild('anio', $value['anio']);
				$newInscrip->addChild('fecha_inscip', $value['fecha_inscip']);
				$newInscrip->addChild('objetivos', $value['objetivos']);
				$newInscrip->addChild('observaciones', $value['observaciones']);
				$newInscrip->addChild('culminacion_validada', $value['culminacion_validada']);
				$newInscrip->addChild('fecha_fin_real', $value['fecha_fin_real']);
				$newInscrip->addChild('horas_acumuladas', $value['horas_acumuladas']);

				// Inscrustamos el proyecto en la inscripcion
				$newProyecto = $newInscrip->addChild('proyecto');
			} else {
				// Estamos manejando SOLO proyectos
				$newProyecto = $newXML->addChild('proyecto');
			}

			$newProyecto->addChild('codigo', $value['codigo']);
			$newProyecto->addChild('titulo', $value['titulo']);

			// Los detalles los mostramos en busquedas por proyectos
			if( !($por_estudiante OR $por_tutor) ) {
				$temp = $newProyecto->addChild('area_proyecto');
				$temp->addChild('nombre', $value['nombre']);
				$temp->addChild('acronimo', $value['siglas']);

				$newProyecto->addChild('tipo', $value['tipo']);
				$newProyecto->addChild('status', $value['status']);
				$newProyecto->addChild('modificaciones', $value['modificaciones']);
				$newProyecto->addChild('observaciones', $value['observaciones']);
				$newProyecto->addChild('evaluador', $value['usbid_evaluador']);
				$newProyecto->addChild('fecha_ingreso', $value['fecha_ingreso']);
				$newProyecto->addChild('impacto_social', $value['impacto_social']);
				$newProyecto->addChild('resumen', $value['resumen']);
				$newProyecto->addChild('area_de_trabajo', $value['area_de_trabajo']);
				$newProyecto->addChild('antecedentes', $value['antecedentes']);
				$newProyecto->addChild('objetivo_general', $value['obj_general']);
				$newProyecto->addChild('objetivo_especificos', $value['obj_especificos']);
				$newProyecto->addChild('descripcion', $value['descripcion']);
				$newProyecto->addChild('actividades', $value['actividades']);
				$newProyecto->addChild('perfil', $value['perfil']);
				$newProyecto->addChild('recursos', $value['recursos']);
				$newProyecto->addChild('logros', $value['logros']);
				$newProyecto->addChild('directrices', $value['directrices']);
				$newProyecto->addChild('magnitud', $value['magnitud']);
				$newProyecto->addChild('participacion', $value['participacion']);
				$newProyecto->addChild('aprobado', $value['aprobado']);
				$newProyecto->addChild('culminado', $value['culminado']);
				$newProyecto->addChild('fecha_aprobado', $value['fecha_aprob']);

				$temp = $newProyecto->addChild('formacion');
				$temp->addChild('descripcion', $value['formacion_desc']);
				$temp->addAttribute('requerida', $value['formacion']);
			}
		}
	}

	// Estamos listos...
	Header('Content-type: text/xml');
	echo $newXML->asXML();
	exit;
}
/*\
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
