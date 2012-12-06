<?

require "cAutorizacion.php";
$modo_depuracion=false;
//busco el id de la comunidad asociada al proyecto
//busco el id del o los tutores asociados al proyecto
//busco el id del proponente asociado al proyecto
//busco el id de la organizacion asociada al proyecto
$sql_temp="SELECT * FROM proyecto WHERE id=$_GET[id]";
if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);

while ($fila = obtenerResultados($resultado)){

//elimino los proponentes de la talba proponente pero no de la tabla usuario
	$sql_temp="DELETE FROM proponente WHERE id_proyecto=$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	else $resultado=ejecutarConsulta($sql_temp, $conexion);
        
//elimino los beneficiados de la talba beneficiados
	$sql_temp="DELETE FROM beneficiados WHERE id_proyecto=$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>";
	else $resultado=ejecutarConsulta($sql_temp, $conexion);        

//elimino los .pdf generados para el proyecto asociado        
        $nombre_archivo = "/var/www/SC/upload/plan_aplicacion/".$_GET[id].".pdf";
        if (file_exists($nombre_archivo)) { ?>
            <?php
            $nombreDirectorio = "upload/plan_aplicacion/";
            if ($modo_depuracion) echo $nombreDirectorio. $_GET[id] ;
            unlink ($nombreDirectorio . $_GET[id] . ".pdf");
        }
        
//elimino los tutores asociados al proyecto de la tabla tutor_proy pero no de la tabla usuario
	$sql_temp="DELETE FROM tutor_proy WHERE id_proyecto=$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	else $resultado=ejecutarConsulta($sql_temp, $conexion);        
        
//elimino la comunidad si no hay otro proyecto asociado a la misma comunidad
	$sql_temp="SELECT id FROM proyecto WHERE id_comunidad=$fila[id_comunidad] AND id<>$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	$resultado2=ejecutarConsulta($sql_temp, $conexion);
	$num = numResultados($resultado2);
	if ($num==0){
		$sql_temp= "DELETE FROM comunidad WHERE id=$fila[id_comunidad]";
		if ($modo_depuracion) echo "$sql_temp<br>"; 
		else $resultado=ejecutarConsulta($sql_temp, $conexion);

	}else{
		if ($modo_depuracion) echo "No se puede eliminar la comunidad porque hay otro proyecto asociado<br>";
	}

//elimino la organizacion si no hay otro proyecto asociado a la misma organizacion
	$sql_temp="SELECT id FROM proyecto WHERE id_organizacion=$fila[id_organizacion] AND id<>$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	$resultado2=ejecutarConsulta($sql_temp, $conexion);
	$num = numResultados($resultado2);
	if ($num==0){
		$sql_temp= "DELETE FROM organizacion WHERE id=$fila[id_organizacion]";
		if ($modo_depuracion) echo "$sql_temp<br>"; 
		else $resultado=ejecutarConsulta($sql_temp, $conexion);

	}else{
		if ($modo_depuracion) echo "No se puede eliminar la organizacion porque hay otro proyecto asociado<br>";
	}

	$sql_temp= "DELETE FROM proyecto WHERE id=$_GET[id]";
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	else $resultado=ejecutarConsulta($sql_temp, $conexion);

}

cerrarConexion($conexion);

?>
<script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
<link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
<body>
    <script>
    $.prompt('El proyecto ha sido eliminado satisfactoriamente', 
    { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vBuscarProyecto.php" }  })
    </script>	
</body>
		

