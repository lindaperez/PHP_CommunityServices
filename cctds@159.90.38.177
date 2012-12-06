<?
require "cAutorizacion.php";
$modo_depuracion=false;

//Se debe actualizar el campo 'aprobado' de la tabla proyecto para el id actual, ademas se le debe colocar el codigo. Se debe primer verificar que no exista otro proyecto con el mismo codigo
$nuevo_codigo=$_POST[siglas]."-".$_POST[codigo];
$sql_temp="SELECT id FROM proyecto WHERE codigo='$nuevo_codigo' ";
if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);
if (numResultados($resultado)>0){
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
	<script>
            $.prompt('El codigo especificado ya esta asignado a otro proyecto, por favor vuelva a intentarlo.',  
            { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) history.back() }  })
	</script>
        </body>
	<?
	exit();
}else{
	if ($_POST['final'] <> "NO_APROBADO"){

		$sql_temp="UPDATE proyecto SET aprobado='SI', codigo='$nuevo_codigo' where id='$_POST[id_proy]' ";	
        
                $nombre_archivo = "/var/www/SC/upload/plan_aplicacion/".$_POST[id_proy].".pdf";
                if (file_exists($nombre_archivo)) { ?>
                    <?php
                    $nombreDirectorio = "upload/plan_aplicacion/";
                    if ($modo_depuracion) echo $nombreDirectorio;
                    rename ($nombreDirectorio . $_POST[id_proy] . ".pdf", $nombreDirectorio . $nuevo_codigo . ".pdf");
                }
	}else{
		$sql_temp="UPDATE proyecto SET aprobado='NO', codigo='$nuevo_codigo' where id='$_POST[id_proy]' ";	
	}
	if ($modo_depuracion) echo "$sql_temp<br>"; 
	$resultado=ejecutarConsulta($sql_temp, $conexion);
}
//se inserta un registro en la tabla Evaluacion

$sql_temp="INSERT INTO evaluacion VALUES (".
"0, ".//id_evaluacion
"'$_POST[id_proy]', ".//id_proyecto
"'$_POST[final]', ".//status
"'$_POST[modificaciones]', ".//modificaciones
"'$_POST[observaciones]', ".//observaciones		
"'".$_SESSION[USBID]."', ". //evaluador
"'$_POST[tipo]' ".//tipo
")"; //usbid_evaluador

if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);

//se obtiene el ultimo id insertado en la tabla evaluacion
$sql_temp="SELECT max(id) id from evaluacion ";
if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);
$id_eval=$fila[id];

// $respuestas=$_POST['respuesta'];
//por cada respuesta se inserta un registro en la tabla evaluacion_proy
for ($i=0;$i<$_POST[max_preguntas];$i++){
	$j=$i+1;
	$sql_temp="INSERT INTO evaluacion_proy VALUES (".
			// "'$id_eval', '$j', '".$respuestas[$i]."')";
			"'$id_eval', '$j', '".$_POST['respuesta_'.$i]."')";
	if ($modo_depuracion) echo "$sql_temp<br>"; else 
	$resultado=ejecutarConsulta($sql_temp, $conexion);
			
}
cerrarConexion($conexion);

?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
	<script>
            $.prompt('La evaluacion ha sido registrada satisfactoriamente.',  
            { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php?opcion=evaluar" }  })
        </script>	
        </body>