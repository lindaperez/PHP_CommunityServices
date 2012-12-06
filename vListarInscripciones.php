<?

include "cListarInscripciones.php";

$TITLE = 'Listar Inscripciones - SERVICIO COMUNITARIO';
include_once("vHeader.php");

//Se obtiene la contrasena del coordinador
echo "<script>"; 
echo "var a='".$password."';"; 
echo "</script>"; 


?>

<script>

			function verificacionEliminar(id){
				
				var formstr = '<p>Por favor, ingrese la contraseña del coordinador de la CCTDS:</p>'+
					'<div class="field"><label for="intamount">Contraseña: </label><input type="password" name="intamount" id="intamount" /></div>';
					
					
				jqistates = {
					state0: {
						html: formstr,
						focus: 1,
						buttons: { Cancelar: false, Cofirmar: true },
						submit: function(e, v, m, f){
							var e = "";
							m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
							
							if (v) {
								
								if( a!= (f.intamount))
									e += "La contraseña no coincide.<br />";
					
								
								if (e == "") {
                                                                    window.location="cEvaluarInscripcion.php?id="+id+"&status=eliminado&tok=<?=$_SESSION[csrf]?>";
                                                                        return true;
								}
								else{
									jQuery('<div class="errorBlock" style="display: none;">'+ e +'</div>').prependTo(m).show('slow');
								}
								return false;
							}
							else return true;
						}
					}
				};
                                
				
				$.prompt(jqistates, {show:'slideDown'});
			}
		
</script>

<style>
.fdg_sortable {cursor:pointer;text-decoration:underline;color:#00f}
.alterRow {background-color:#dfdfdf}
</style>
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="parrafo" align="center">
	<span class="titular_negro"><br /> 
<?
if ($_GET['opcion']=="validar_culminacion") {
	echo "CULMINACIONES DE PROYECTOS DE SERVICIO COMUNITARIO<br>";
	echo "</span><span class='texto'> Recuerde que cada alumno debe entregar en papel la planilla de culminación firmada por el tutor académico y en digital el informe final el cual puede ser revisado en el bot&oacute;n Ver Detalles (lupa)</span>";
        $color_tabla="odd gradeC";
}
else {
	echo "INSCRIPCIONES EN PROYECTOS DE SERVICIO COMUNITARIO";
        $color_tabla="odd gradeA";
}
?>
            
</span><br />
	<br /><br />
	<?

	if ($_SESSION[max_inscrip]==0){
		if ($_GET['opcion']=="validar_culminacion"){
			echo "<br><br>Hasta el momento no hay culimaciones por evaluar.<br><br>";
		}else{
			echo "<br><br>Hasta el momento no hay inscripciones por evaluar.<br><br>";
		}
	} else{
            

	?>
        
        <span class="buscador"><strong style="color:#06F">Consejo:</strong> Se le recomienda utilizar el campo de "B&uacute;squeda" y seleccionar 
            sobre las columnas de su<br>preferencia para organizar los Estudiantes en forma ascendente o descendente.<br>Si desea ordenarlo en 
            funci&oacute;n a m&aacute;s de un campo, debe presionar la tecla "SHIFT" y darle a la(s) columnas.<br><br></span>
        
                <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
				$('#example').dataTable({
                                     "sPaginationType": "full_numbers",
                                     "bJQueryUI": true,
                                     "iDisplayLength": 10,
                                     "aLengthMenu": [[10, 15, 25, 50, 100 , -1], [10, 15, 25, 50, 100, "Todos"]],
                                     "bAutoWidth": true
                                     
                                });
			} );                        
                </script>
        
<!--@import "scripts/themes/smoothness/jquery-ui-1.8.4.custom.css";-->
<style type="text/css" title="currentStyle">
			@import "scripts/demo_page.css";
			@import "scripts/demo_table.css";
                        @import "scripts/jqueryui/themes/redmond/jquery-ui-1.8.20.custom.css";
</style>


 <div class="main-container">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>C&oacute;digo</th>
			<th>Per&iacute;odo</th>
			<th>A&ntilde;o</th>
			<th>USBID</th>
			<th>Estudiante</th>
			<th>Carrera</th>
			<th>Tutor</th>
			<th>Recaudos completos?</th>
		</tr>
	</thead>
	<tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php
                for ($i=0;$i<$_SESSION[max_inscrip];$i++){
            ?>
                
		<tr class="<?php echo $color_tabla; ?>" >
                    
			<td class="center"><strong><?=$_SESSION[inscripcion][codigo][$i]?></strong></td>
			<td><?=$_SESSION[inscripcion][periodo][$i]?></td>
			<td><?=$_SESSION[inscripcion][anio][$i]?></td>
			<td class="center" nowrap><?=$_SESSION[inscripcion][usbid][$i]?></td>
			<td nowrap><?=$_SESSION[inscripcion][nombre][$i]."<br>".$_SESSION[inscripcion][apellido][$i]?></td>
			<td class="center" nowrap><?=$_SESSION[inscripcion][carrera][$i]?></td>
			<td nowrap><?=$_SESSION[inscripcion][nombreT][$i]."<br>".$_SESSION[inscripcion][apellidoT][$i]?></td>
			<td class="center" nowrap>
                            <?php
                                if ($_GET['opcion']=="validar_culminacion"){
                                        $archivo=$_SESSION[inscripcion][usbid][$i]."_".$_SESSION[inscripcion][id][$i].".pdf";
                                        $nombre_archivo ='upload/informe_final/'.$archivo;
                                        if (file_exists($nombre_archivo)) {
                                        echo "<a href='upload/informe_final/$archivo'>".mostrarImagen('ver')."</a>&nbsp;&nbsp;&nbsp;";
                                        echo "<a href='cCulminarServicio.php?id=";
                                        echo $_SESSION[inscripcion][id][$i]."&status=SI&tok=".$_SESSION[csrf]."'>".mostrarImagen('aceptar')."</a> &nbsp;&nbsp;&nbsp;"; 
                                        }
                                        echo "<a href='cCulminarServicio.php?id=";
                                        echo $_SESSION[inscripcion][id][$i]."&status=NO&tok=".$_SESSION[csrf]."'>".mostrarImagen('rechazar')."</a>"; 
                                        if ($_SESSION[inscripcion][culminacion_validada][$i]=="NO") echo "   ".mostrarImagen('alerta');
                                }else{
                                        echo "<a href='cEvaluarInscripcion.php?id=";
                                        echo $_SESSION[inscripcion][id][$i]."&status=SI&tok=".$_SESSION[csrf]."'>".mostrarImagen('aceptar')."</a> &nbsp;&nbsp;&nbsp;"; 
                                        if ($_SESSION[inscripcion][aprobado][$i]=="NO"){
                                                echo mostrarImagen('alerta')."&nbsp;&nbsp;&nbsp; ";
                                        }else{
                                                echo "<a href='cEvaluarInscripcion.php?id=";
                                                echo $_SESSION[inscripcion][id][$i]."&status=NO&tok=".$_SESSION[csrf]."'>".mostrarImagen('rechazar')."</a> &nbsp;&nbsp;&nbsp;"; 
                                        }
                                        if (!isAdmin()){
                                            echo "<a href='javascript:verificacionEliminar(";
                                            echo $_SESSION[inscripcion][id][$i].")'>".mostrarImagen('eliminar')."</a>"; 
                                        }
                                        else {
                                            echo "<a href='cEvaluarInscripcion.php?id=";
                                            echo $_SESSION[inscripcion][id][$i]."&status=eliminado&tok=".$_SESSION[csrf]."'>".mostrarImagen('eliminar')."</a>"; 
                                        }
                                }
                            ?>
                        </td>
		</tr>
           <? } ?>     
	</tbody>
	<tfoot>
		<tr>
			<th>C&oacute;digo</th>
			<th>Per&iacute;odo</th>
			<th>A&ntilde;o</th>
			<th>USBID</th>
			<th>Estudiante</th>
			<th>Carrera</th>
			<th>Tutor</th>
			<th>Recaudos completos?</th>
		</tr>
	</tfoot>
</table>
   
 </div>
<div class="spacer"></div>

</table>

<?
}//cierra el else
?>
<?php include_once('vFooter.php'); ?>
