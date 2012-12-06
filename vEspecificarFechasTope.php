<?php
require "cAutorizacion.php";

if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}
include "cEspecificarFechasTopePre.php";

$TITLE = 'Especificar Fechas Tope';
include_once("vHeader.php");
?>
<script type="text/javascript" language="javascript" src="cCalendario.js"></script>
<script type="text/javascript" language="javascript" src="cVerifFechasTope.js"></script>
<script type="text/javascript">
    function mostrarOpc(){
        var evento = document.getElementById('evento').value;

        if (evento==1){
            $("#opcTrimestre").show();
        }else{
            $("#opcTrimestre").hide();
        }

    }
    $(document).ready(function(){

        $("#opcTrimestre").hide();

    });
    
    <!-------------------------Calendario---------------------------->

	$(function() {
		$( "#datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showWeek: true,
                    firstDay: 1,
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    dayNamesMin: ['D','L','M','M','J','V','S'],
                    weekHeader: 'Sem.',
                    dateFormat: 'dd/mm/yy'
                });
	});
	$(function() {
		$( "#datepicker2" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showWeek: true,
                    firstDay: 1,
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    dayNamesMin: ['D','L','M','M','J','V','S'],
                    weekHeader: 'Sem.',
                    dateFormat: 'dd/mm/yy'
                });
	});
</script>

<form name="datos" action="cEspecificarFechasTopePost.php?tok=<?php echo $_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top">
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <tr>
                        <td colspan="4"><p align="center" class="titular_negro"><strong>Especificar Fechas Tope</strong><br /><br/>
                                <span class="buscador">El color rojo representa que el evento no se encuentra dentro del rango del trimestre.<br />
                                <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
                                <span class="buscador"><strong>Fecha: <?php echo date('d-m-Y'); ?></strong></span></p>
                        </td>
                    </tr>

                    <tr><td colspan="4">
                            <table width="100%" border="1" cellpadding="5" cellspacing="0"  align="center" >
                                <tr style="background-color: gainsboro">
                                    <td><p align="center"><b>Evento</b></p></td>
                                    <td><p align="center"><b>Fecha Inicio</b></p></td>
                                    <td><p align="center"><b>Fecha Fin</b></p></td>
                                    <td><p align="center"><b>Nombre Trimestre</b></p></td>
                                    <?php foreach ($LISTA_EVENTOS as $value): ?>
                                        <?php $desde[] = $value['fecha_inicio'] ?>
                                        <?php $hasta[] = $value['fecha_fin'] ?>
                                        <?php $nombre[] = $value['nombre_trimestre_actual'] ?>
                                    <?php endforeach; ?>
                                </tr>
                                <tr style="background-color: greenyellow">
                                    <td><p align="center"><b>Trimestre <br>(Desde sem 1 del trimestre hasta sem 0 del pr&oacute;x. trimestre)</b></p></td>
                                    <td><p align="center"><b><?php echo  cambiaf_a_normal($desde[0]) ?></b></p></td>
                                    <td><p align="center"><b><?php echo  cambiaf_a_normal($hasta[0]) ?></b></p></td>
                                    <td><p align="center"><b><?php echo  $nombre[0] ?></b></p></td>
                                </tr>
								<?php if($_SESSION[sede]=='Litoral'){ ?>
									<tr>
										<td><p align="center"><b>Inscripción</b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($desde[4]) ?></b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($hasta[4]) ?></b></p></td>
										<td <?php
											if ((DATE($desde[4])>=DATE($desde[0])) && (DATE($hasta[4])<=DATE($hasta[0]))) 
												echo "style='background-color: greenyellow'";
											else
												echo "style='background-color: red'"; ?>
											><p align="center"><b></b></p></td>
									</tr>
								<?php }else{ ?>
									<tr>
										<td><p align="center"><b>Formulación de Proyectos</b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($desde[1]) ?></b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($hasta[1]) ?></b></p></td>
										<td <?php
											if ((DATE($desde[1])>=DATE($desde[0])) && (DATE($hasta[1])<=DATE($hasta[0]))) 
												echo "style='background-color: greenyellow'";
											else
												echo "style='background-color: red'"; ?>
											><p align="center"><b></b></p></td>
									</tr>
									<tr>
										<td><p align="center"><b>Inscripción</b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($desde[2]) ?></b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($hasta[2]) ?></b></p></td>
										<td <?php
											if ((DATE($desde[2])>=DATE($desde[0])) && (DATE($hasta[2])<=DATE($hasta[0]))) 
												echo "style='background-color: greenyellow'";
											else
												echo "style='background-color: red'"; ?>
											><p align="center"><b></b></p></td>
									</tr>
									<tr>
										<td><p align="center"><b>Inscripción extemporánea</b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($desde[3]) ?></b></p></td>
										<td><p align="center"><b><?php echo  cambiaf_a_normal($hasta[3]) ?></b></p></td>
										<td <?php
											if ((DATE($desde[3])>=DATE($desde[0])) && (DATE($hasta[3])<=DATE($hasta[0]))) 
												echo "style='background-color: greenyellow'";
											else
												echo "style='background-color: red'"; ?>
											><p align="center"><b></b></p></td>
									</tr>
								<?php } ?>
                            </table>  </td>
                  </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td><div align="right"><span class="rojo">*</span> Evento: </div></td>
                        <td colspan="2" class="parrafo">
                            <select name="evento" class="parrafo" id="evento" onchange="javascript: mostrarOpc()">
                                <option value="seleccione">--seleccione--</option>
								<?php 
									$select = 0;
									if($_SESSION[sede]=='Sartenejas'){ ?>
										<?php foreach ($LISTA_EVENTOS as $value): 
												if($select != 4){?>
													<option value="<?php echo $value['codigo'] ?>"><?php echo $value['nombre'] ?></option>
										<?php   }
											  $select = $select + 1;
											  endforeach; ?>
								<?php }else{ 
											foreach ($LISTA_EVENTOS as $value): 
												if($select == 4){?>
													<option value="<?php echo $value['codigo'] ?>"><?php echo $value['nombre'] ?></option>
										<?php   }
											  $select = $select + 1;
											  endforeach; 
									 }?>
                            </select>
                        </td>
                    </tr>
                    <tr id="opcTrimestre">
                        <td><div align="right"><span class="rojo">*</span>Nombre Trimestre: </div></td>
                        <td colspan="2" class="parrafo">
                            <select name="trimestre" class="parrafo" id="trimestre">
                                <option value="Enero-Marzo">Enero-Marzo</option>
                                <option value="Abril-Julio">Abril-Julio</option>
                                <option value="Septiembre-Diciembre">Septiembre-Diciembre</option>

                            </select>
                        </td>
                 </tr>

                    <!--
                    <tr>
                        <td><div align="right">Fecha Inicio Actual:</div></td>
                        <td colspan="2" class="parrafo">

                        </td>
                    </tr>
                    <tr>
                        <td><div align="right">Fecha Fin Actual:</div></td>
                        <td colspan="2" class="parrafo">

                        </td>
                    </tr>      -->

                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td><div align="right"><span class="rojo">*</span>Cambiar Fecha Inicio: </div></td>
                        <td><div align="left" class="demo">
                            <input type="text" id="datepicker" readonly="readonly" name="desde1" size="10" />
                        </div></td>
                    </tr>
                    <tr>
                        <td><div align="right"><span class="rojo">*</span>Cambiar Fecha Fin: </div></td>
                        <td><div align="left" class="demo">
                            <input type="text" id="datepicker2" readonly="readonly" name="hasta1" size="10" />
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="4" valign="top" class="parrafo">
                            <div align="center">
                                <a href='javascript: verificar()'><?php echo  mostrarImagen('enviar'); ?></a>
                              <!--  <a href='cCrearPlanillaPermisoPasantia.php'><?php //= mostrarImagen('pdf');             ?></a>-->
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>

<?php include_once('vFooter.php'); ?>
