<?
require "cAutorizacion.php";

$modo_depuracion=true;

//Se verifica que el archivo tenga el formato correcto y se actualiza la tabla inscripcion
if (is_uploaded_file ($_FILES['informe']['tmp_name']))
{
	if ($_FILES['informe']['type']<>"application/pdf" ){
		?>
                <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
                <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
                <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
                <body>
                <script>
                    $.prompt('El informe no estaba en formato PDF, por favor vuelva a intentarlo.',  
                    { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vNotificarCulminacion.php" }  })
                </script>	
                </body>
		<?
	}

   	$nombreDirectorio = "upload/informe_final/";
	$nombreFichero = $_SESSION[USBID]."_".$_POST[id].".pdf";

	if ($modo_depuracion) echo $nombreFichero;
	$movido=move_uploaded_file ($_FILES['informe']['tmp_name'], $nombreDirectorio . $nombreFichero);
	if ($movido){


		$sql="UPDATE inscripcion SET fecha_fin_real=now(), horas_acumuladas=".$_POST[horas]." WHERE id='".$_POST[id]."'";
		if ($modo_depuracion) echo $sql;
		$resultado = ejecutarConsulta($sql, $conexion);
		$_SESSION[culminado]=true;

//		include("cVerifInscrito.php");


	?>
                <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
                <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
                <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
                <body>
                <script>
                    $.prompt('El archivo ha sido enviado satisfactoriamente.',  
                    { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
                </script>	
                </body>
	<?

	}else{
	?>
                <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
                <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
                <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
                <body>
                <script>
                    $.prompt('No se pudo mover el archivo. Por Favor vuelva a intentarlo.',  
                    { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
                </script>	
                </body>
	<?
	}
}
else{


?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
        <script>
            $.prompt('No se pudo subir el archivo. Por Favor vuelva a intentarlo.',  
            { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vNotificarCulminacion.php" }  })
        </script>	
        </body>
<?
}
cerrarConexion($conexion);
?>
