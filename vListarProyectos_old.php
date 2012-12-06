<?
require "cAutorizacion.php";
include_once("vHeader.php");

if  (!periodoInscripcion($conexion) && isEstudiante()){
	echo "<center><br><br>";
	echo "<span class='parrafo'>Disculpe, no se pueden realizar inscripciones en este momento. Verifique en www.cctds.dex.usb.ve</span></center>";

}else
if ($_SESSION[tipo]=="pregrado" and isset($_SESSION['inscrito'])  and $_SESSION['inscrito']) {
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted ya está inscrito en un proyecto. Si desea cambiarse de Proyecto debe acudir a la CCTDS</span></center>";

}else{

?>
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="parrafo" align="center">
	<span class="titular_negro"><br />
	PROYECTOS DE SERVICIO COMUNITARIO</span><br />
<? if ($_GET[opcion]=="puntuales" or $_GET[opcion]=="continuos" or $_GET[opcion]=="culminados") echo strtoupper($_GET[opcion]);?>
	<br />
	<?
	include "cListarProyectos.php";
	if ($_SESSION[max_proy]==0){
		if (isEmpleadoCCTDS()){
			echo "<br><br>Hasta el momento no hay proyectos ".$_GET[opcion]."<br><br>";
		}else{
			echo "<br><br>Hasta el momento no hay proyectos aprobados.<br><br>";
		}

	} else{ 
            if ($_GET[opcion]=="listar_estudiantes") {
            ?>
        <table width="100%" border="0" cellpadding="5" class="parrafo">
            <tr>
                <tr>
                    <td colspan="2"><br><br><br><b>LISTA DE ESTUDIANTES DEL PROYECTO: <? echo $_SESSION[proyecto][titulo]; ?></b></td>
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
            <?php } else { ?>
            
	  <table width="100%" border="0" cellpadding="5" class="parrafo">
<?
	$area_actual="";
	$area_anterior="";
	for ($i=0;$i<$_SESSION[max_proy];$i++){
		$area_actual=$_SESSION[proyecto][area][$i];

		if ($area_anterior<>$area_actual) {

?>
			<tr>
				<td colspan="2"><? echo "<br><br><br><b>".strtoupper($area_actual)."</b>"; ?>
				</td>
			</tr>
		<?
		}
		$area_anterior=$area_actual;
		?>
        
        <tr>
          <td valign="top"><?=$_SESSION[proyecto][codigo][$i]?></td>
          <td><?

		echo "<b>T&iacute;tulo:</b> ".$_SESSION[proyecto][titulo][$i];
		echo "<br><b>Contacto:</b> ";

		echo "<a href='mailto:".$_SESSION[proyecto][usbid][$i]."@usb.ve'>";
		echo $_SESSION[proyecto][nombre][$i]." ".$_SESSION[proyecto][apellido][$i]."</a> <br>";
                if (!isEstudiante() && !isEmpleadoCCTDS()) {
                    
                    
                        echo "<b>Estudiantes totales que han inscrito el proyecto:</b> ";
                        echo "<a href='vListarProyectos.php?opcion=listar_estudiantes&proyecto=".$_SESSION[proyecto][id][$i]."'>".$_SESSION[proyecto][cant_total][$i]."</a>"."<br/>";
                    
                } 
		//opciones para administrador
		if (isEmpleadoCCTDS()) {
			if($_GET[opcion]=="por evaluar") {
				echo " <b><a href='vEvaluarProyecto.php?id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('evaluar')."</a></b>";
			}else{
				if($_GET[opcion]<>"culminados") {
					echo " <b><a href='cCambiarStatusProy.php?culminado=SI&id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('culminado')."</a></b>";
				if($_GET[opcion]=="puntuales") $tipo="CONTINUO";
				if($_GET[opcion]=="continuos") $tipo="PUNTUAL";
				echo " <b><a href='cCambiarTipoProy.php?id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('cambiar')."</a></b>";

				}else{
					echo " <b><a href='cCambiarStatusProy.php?culminado=NO&id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('no_culminado')."</a></b>";
				}
			}
		}

		//opciones para estudiantes
		if ($_SESSION[tipo]=="pregrado" or $_SESSION[tipo]=="postgrado"){
			if ( $_SESSION[inscrito] and in_array($_SESSION[proyecto][id][$i], $_SESSION[id_proyecto]) ){
				echo "<br> <b><span class='direccion' title='Usted ya esta inscrito en este Proyecto'>".mostrarImagen('inscribir_blanco')."</span></b>";
			}else {
				echo "<br> <b><a href='vInscribirProyecto.php?id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('inscribir')."</a></b>";
			}
		}

		echo " <b><a href='vVerProyecto.php?id=".$_SESSION[proyecto][id][$i]."'>".mostrarImagen('ver')."</a></b>";
		?></td>
        </tr>
	<?
	}//cierra el for
	?>
      </table>
	  <?
	  }//cierra el if
	  ?>    </td>
  </tr>
</table>
<?
}
}
?>
	<div class="clear">
		<pre><?php /* DEBUG */ // print_r( $_SESSION ); ?></pre>
	</div>
<?php include_once('vFooter.php'); ?>
