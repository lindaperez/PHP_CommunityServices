<?php
/*
 * Modificacion de proyectos
 */

define('MY_DEBUG', 0);
define('DEFAULT_NO_ESPECIFICADO', 'No especificado');

// Creamos variables con los datos de entrada, por simplicidad
if( isset($_POST['modificar_proyecto']))
	extract($_POST);
else
	extract($_GET);

// Resultados del script
$PROYECTO = false;		// Datos del proyecto a modificar

// Modificamos los datos del proyecto
$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();

/*
*/
// Verificamos los errores del formulario
if(isset($modificar_proyecto) AND $modificar_proyecto){
	$_numbers = array('comunidad', 'area_proyecto', 'representante', 'cant_fem',
                'cant_masc', 'min_edad', 'max_edad');

	$_noempty = array('title', 'impacto_social', 'resumen', 'area_de_trabajo',
		'antecedentes', 'obj_general', 'obj_especificos', 'descripcion',
		'actividades', 'perfil', 'recursos', 'logros', 'directrices',
		'magnitud', 'participacion', 'proponente', 'tutor0');

	foreach($_numbers as $value){
		if( ! $$value  )
			$_ERRORES[] = 'El campo "'.$value.'" NO es valido.';
	}
	foreach($_noempty as $value){
		if( empty($$value) )
			$_ERRORES[] = 'El campo "'.$value.'" es obligatorio.';
	}
	if( !in_array($formacion, array('SI', 'NO')))
		$_ERRORES[] = 'Debe seleccionar una opcion para formacion.';
        
        if ($cant_disc < 0)
                $_ERRORES[] = 'La cantidad de personas discapacitadas no puede ser menor que 0.';
        
        if ($min_edad>=$max_edad)
                $_ERRORES[] = 'La edad m&aacute;xima debe ser mayor que la m&iacute;nima en el campo de beneficiados.';
        
	if(empty($_ERRORES)){
		// Todo fino, actualizamos
		$sql = "UPDATE proyecto SET ";
		$sql .= " titulo='".$title."'";
		$sql .= ", impacto_social='".replace_form($impacto_social)."'";
		$sql .= ", resumen='".replace_form($resumen)."'";
		$sql .= ", area_de_trabajo='".replace_form($area_de_trabajo)."'";
		$sql .= ", antecedentes='".replace_form($antecedentes)."'";
		$sql .= ", obj_general='".replace_form($obj_general)."'";
		$sql .= ", obj_especificos='".replace_form($obj_especificos)."'";
		$sql .= ", descripcion='".replace_form($descripcion)."'";
		$sql .= ", actividades='".replace_form($actividades)."'";
		$sql .= ", perfil='".replace_form($perfil)."'";
		$sql .= ", recursos='".replace_form($recursos)."'";
		$sql .= ", logros='".replace_form($logros)."'";
		$sql .= ", directrices='".replace_form($directrices)."'";
		$sql .= ", magnitud='".replace_form($magnitud)."'";
		$sql .= ", participacion='".replace_form($participacion)."'";
		$sql .= ", formacion='".replace_form($formacion)."'";
		$sql .= ", formacion_desc='".replace_form($formacion_desc)."'";
		$sql .= ", horas='".replace_form($horas)."'";
		$sql .= ", id_representante='".replace_form($representante)."'";
		$sql .= ", id_comunidad='".replace_form($comunidad)."'";
		$sql .= ", id_area_proy='".replace_form($area_proyecto)."'";
		$sql .= " WHERE id=".$id;
		$resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

		//actualizamos el proponente
		$sql = "UPDATE proponente SET ";
		$sql .= "usbid_usuario='".$proponente."'";
		$sql .= " WHERE usbid_usuario='".$old_proponente."' AND id_proyecto=".$id;
		$resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

		//Eliminamos primero los beneficiados
                $sql = "DELETE FROM beneficiados ";
                $sql.= " WHERE id_proyecto=".$id;
                $resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

                //Se insertan los datos en la tabla beneficiados
                $sql="INSERT INTO beneficiados VALUES(".
                "$id, ".//id del proyecto
                "trim('".replace_form($_POST[cant_fem])."'), ".//cantidad de mujeres
                "trim('".replace_form($_POST[cant_masc])."'), ".//cantidad de hombres
                "trim('".replace_form($_POST[min_edad])."'), ".//edad minima
                "trim('".replace_form($_POST[max_edad])."'), ".//edad maxima
                "trim('".replace_form($_POST[cant_disc])."') ".//cantidad de discapacitados
                ")";
		$resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

		//actualizamos los tutores, se deben borrar los registros viejos de la tabla tutor_proy y agregar los nuevos
		$sql = "DELETE FROM tutor_proy ";
		$sql .= " WHERE id_proyecto=".$id;
		$resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

		$sql = "INSERT INTO tutor_proy ";
		$sql .= " VALUES ('$tutor0',$id)";
		$resultado = ejecutarConsulta($sql, $conexion);
		if( ($error = mysql_error()) )
			echo "ERROR: $error - $sql";
		if(MY_DEBUG>1) echo "$sql<br />";

		if ($tutor1<>""){
			$sql = "INSERT INTO tutor_proy ";
			$sql .= " VALUES ('$tutor1',$id)";
			$resultado = ejecutarConsulta($sql, $conexion);
			if( ($error = mysql_error()) )
				echo "ERROR: $error - $sql";
			if(MY_DEBUG>1) echo "$sql<br />";
		}

		if ($tutor2<>""){
			$sql = "INSERT INTO tutor_proy ";
			$sql .= " VALUES ('$tutor2',$id)";
			$resultado = ejecutarConsulta($sql, $conexion);
			if( ($error = mysql_error()) )
				echo "ERROR: $error - $sql";
			if(MY_DEBUG>1) echo "$sql<br />";
		}
		if ($tutor3<>""){
			$sql = "INSERT INTO tutor_proy ";
			$sql .= " VALUES ('$tutor3',$id)";
			$resultado = ejecutarConsulta($sql, $conexion);
			if( ($error = mysql_error()) )
				echo "ERROR: $error - $sql";
			if(MY_DEBUG>1) echo "$sql<br />";
		}
		if ($tutor4<>""){
			$sql = "INSERT INTO tutor_proy ";
			$sql .= " VALUES ('$tutor4',$id)";
			$resultado = ejecutarConsulta($sql, $conexion);
			if( ($error = mysql_error()) )
				echo "ERROR: $error - $sql";
			if(MY_DEBUG>1) echo "$sql<br />";
		}

		$_SUCCESS[] = 'Actualizado satisfactoriamente.';
	} else {
		$_WARNING[] = 'No se pudo actualizar el proyecto. <br/> 
                    Verifique todos los campos que hab&iacute;a modificado y revise si los tutores son correctos.';
	}
}

if(isset($id)) {
	// Obtenemos el proyecto en cuestion
	$sql =
"SELECT a.id area_id, a.nombre area_nombre, a.siglas area_siglas,
eva.*, pro.*, r.*, o.*, c.*, b.*, 
p.* "
			. " FROM proyecto p "
			. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
			. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
			. " LEFT JOIN proponente pro ON (pro.id_proyecto = p.id) "
			. " LEFT JOIN representante r ON (r.id = p.id_representante) "
			. " LEFT JOIN organizacion o ON (o.id = p.id_organizacion) "
			. " LEFT JOIN comunidad c ON (c.id = p.id_comunidad) "
			. " LEFT JOIN beneficiados b ON (b.id_proyecto = p.id) "
			. " WHERE p.id='".$id."' ";
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$PROYECTO = $row;
	if(MY_DEBUG>1) echo "$sql<br />";

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
	if(MY_DEBUG>1) echo "$sql<br />";

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

	// Lista de carreras registradas
	// $sql = "SELECT carrera FROM usuario_estudiante WHERE carrera <> '' AND carrera IS NOT NULL GROUP BY carrera";
	$sql = "SELECT * FROM carrera ORDER BY nombre";
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$LISTA_CARRERA[] = $row;

	// Lista de usbid 
	$sql = "SELECT * FROM usuario ORDER BY apellido;";
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$LISTA_USBID[] = $row;
	
	// Tutores del Proyecto en cuestio
	$sql = "SELECT * FROM tutor_proy  WHERE id_proyecto=$id;";
	$resultado = ejecutarConsulta($sql, $conexion);
	while ($row = obtenerResultados($resultado))
		$LISTA_TUTOR[] = $row;
	

}
