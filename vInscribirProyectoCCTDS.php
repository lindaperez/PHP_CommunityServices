<?php
require "cAutorizacion.php";
require "cAgregarProyectoCCTDS.php";

if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

$sql = "SELECT * FROM carrera ORDER BY nombre";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$LISTA_CARRERA[] = $row;

$TITLE = 'Inscripci&oacute;n de estudiantes que no se encuentren registrados en el sistema';
include_once("vHeader.php");
?>

<?php foreach( (array)$_ERRORES as $value): ?>
<div class="error"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_WARNING as $value): ?>
<div class="warning"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_SUCCESS as $value): ?>
<div class="success"><?php echo $value; ?></div>
<?php endforeach; ?>

<meta charset="utf-8">
<link rel="stylesheet" href="scripts/jqueryui/themes/redmond/jquery.ui.all.css">
<link rel="stylesheet" href="scripts/jqueryui/demos.css">

<!-----------------Cambiar dinamicamente un tutor---------------->
<?php

    $sql="SELECT * FROM proyecto ".
        "WHERE aprobado like 'SI' ".
        "ORDER BY codigo";
        $resultado=ejecutarConsulta($sql, $conexion);
        $LISTA_PROYECTOS = array();
        while ($row = obtenerResultados($resultado))
                $LISTA_PROYECTOS[] = $row;

    $sql="SELECT * FROM usuario u, usuario_estudiante e ".
        "WHERE u.usbid=e.usbid_usuario ".
        "ORDER BY apellido, nombre, usbid";
        $resultado=ejecutarConsulta($sql, $conexion);
        $LISTA_ESTUDIANTES = array();
        while ($row = obtenerResultados($resultado))
                $LISTA_ESTUDIANTES[] = $row;        
        
        
?>
                                            

<!------------Lista de tutor dinamica segun el proyecto inscrito--------------->
<script language="javascript">
    
function Combos(x)
{
ItDepend=document.getElementById('tutor');
if(!ItDepend){return;}
var mitems=new Array();
mitems['Elige']=[''];
<?php foreach($LISTA_PROYECTOS as $value): 
    ?>
    mitems[<?php echo "'".$value['id']."'" ;?>]=[ 'Seleccione',<?php 
                        $sql="SELECT DISTINCT(usbid_miembro) FROM tutor_proy WHERE id_proyecto='".$value['id']."'";
                                $resultado=ejecutarConsulta($sql, $conexion);
                                $LISTA_TUTORES = array();
                                while ($row = obtenerResultados($resultado))
                                        $LISTA_TUTORES[] = $row;
                        foreach($LISTA_TUTORES as $value):
                    ?>'<?php echo $value['usbid_miembro'] ; ?>',<?php
                        endforeach; ?> 
    ];
<?php endforeach; ?>
 
ItDepend.options.length=0;
ItActual=
mitems[x.options[x.selectedIndex].value];
 
if(!ItActual){return;}
ItDepend.options.length=ItActual.length;
for(var i=0;i<ItActual.length;i++)
{
ItDepend.options[i].text=ItActual[i];
}
 
}
</script>
<!------------Crea las tablas con el estilo importado------------>    
    <script>
    $(function() {
            $( "#tabs" ).tabs({
                    event: "mouseover",
                    collapsible: true
            });
    });
    </script>
<!---------Mostrar y ocultar elementos de las tablas------------->
    <script>
        $(document).ready(function(){
		    
		    $(".buttons").click(function () {
		    var divname= this.value;
		      $("#"+divname).toggle("slow").siblings();
		    });
	});
    </script>

<!-------------------------Calendario---------------------------->
        <script>
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
	</script>

        <script>
        //---------Mostrar aviso para loading---------------->
        function preloader(){
            document.getElementById("loading").style.display = "none";
            document.getElementById("content").style.display = "block";
        }//preloader
        window.onload = preloader;
        </script>
      <style type="text/css">
    /* Barra de cargar */
    div#content {
    display: none;
    }
 
    div#loading {
    top: 200 px;
    margin: auto;
    position: absolute;
    z-index: 1000;
    width: 160px;
    height: 50px;
    background: url(imagenes/iconos/loading.gif) no-repeat;
    cursor: wait;
    }

    </style>     
        
<table align="center">
        <tr>
            <td align="center"><br/><br/><div id="loading"><br/><br/><br/>Cargando... Por favor, espere...</div></td>
        </tr>
    </table>    
    
    <div id="content">
    
<p align="center" class="titular_negro"><strong>INSCRIPCI&Oacute;N DE ESTUDIANTES QUE NO SE ENCUENTREN REGISTRADOS EN EL SISTEMA</strong><br />
<p align="center" class="parrafo"><strong>Existen dos modalidades para subir los estudiantes: <br><br>1.- Subir un estudiante a la vez.
        <br>2.- Subir varios estudiantes en cascada.</strong></p>

        <hr>



        
        
<!-- ------------------------SE ESPECIFICA LA MODALIDAD 1: SUBIR UNO A LA VEZ------------------------- -->

<form name="subir_proy" action="cInscribirProyectoCCTDS.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
                <td colspan="4"><p align="center" class="titular_negro"><strong>MODALIDAD 1: INSCRIPCI&Oacute;N DE UN ESTUDIANTE.</strong><br />
                <span class="buscador">(<span class="rojo">*</span>) campos obligatorios.</span>
        </tr>
        <tr><td><br>
            <div class="demo">
                <div id="tabs">
                        <ul>
                                <li><a href="#tabs-1">Datos del Estudiante</a></li>
                                <li><a href="#tabs-2">Datos del Proyecto</a></li>
                                <li><a href="#tabs-3">Datos de la inscripci&oacute;n</a></li>
                        </ul>
                    
                    
                    
                        <!---------------Se ingresan los datos del estudiante------------>
                        <div id="tabs-1">
                            
                            <p>
                                <!--Lista de los estudiantes de la USB-->
                            <span class="parrafo"><span class="rojo">*</span><strong>USBID: </strong></span>
                            <span class="parrafo"><select name="est_carnet_lista" class="parrafo" id="select" value="<?php if (isset($_POST['est_carnet_lista'])) echo $_POST['est_carnet_lista']  ;?>">
                            <option value="">--seleccione--</option>
                            <?
                            foreach($LISTA_ESTUDIANTES as $value): ?>
                                <option value="<?php echo $value['usbid'] ?>" <?php echo ($_POST['est_carnet_lista']==$value['usbid'])?'selected="selected"':'' ?> ><?php echo $value['apellido']. ", " . $value['nombre'] . " (" .$value['usbid'] .")" ;?></option>
                            <?php endforeach; ?>
                            </select>
                            </span>
                                <!--Agregar estudiante manualmente-->
                            <div id="buttonsDiv">
                                <span class="buscador">Si el estudiante no se encuentra en la lista, seleccione aqu&iacute;:</span>
                                <input name="AgregarEstudiante" type="button" id="button1" class="buttons" value="Agregar"></input>
                            </div>
                            <div name="AgregarEstudiante" id="Agregar" style="display:none">
                            <table>
                                <tr>
                                    <td colspan="4" class="parrafo"><span class="buscador">Por favor especifique los siguientes datos del estudiante:</span></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>USBID:</div></td>
                                    <td><input name="est_carnet" type="text" maxlength=8 class="parrafo" id="est_carnet" value="<?php if (isset($_POST['est_carnet'])) echo $_POST['est_carnet']  ;?>" />
                                    <span class="buscador">Ejemplo: 01-12345</span></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>Nombre:</div></td>
                                    <td><input name="est_nombre" type="text" class="parrafo" id="est_nombre" value="<?php if (isset($_POST['est_nombre'])) echo $_POST['est_nombre']  ;?>" /></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>Apellido:</div></td>
                                    <td><input name="est_apellido" type="text" class="parrafo" id="est_apellido" value="<?php if (isset($_POST['est_apellido'])) echo $_POST['est_apellido']  ;?>" /></td>
                                </tr>
                                <tr><td colspan="1" class="parrafo"><div align="right">C&eacute;dula:</div></td>
                                    <td><input name="est_ci" type="text" class="parrafo" id="est_ci" value="<?php if (isset($_POST['est_ci'])) echo $_POST['est_ci']  ;?>" /></td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>Carrera:</div></td>
                                    <td colspan="2" class="parrafo">
                                            <select name="est_carrera" style="width:200px;">
                                                    <option value="">Todas</option>
                                                    <?php foreach($LISTA_CARRERA as $value): ?>
                                                    <option value="<?php echo $value['codigo'] ?>" <?php echo ($_POST['est_carrera']==$value['codigo'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>Sexo:</div></td>
                                    <td colspan="2" class="parrafo">
                                            <select name="est_sexo" style="width:200px;">
                                                <option value="">Seleccione</option>
                                                <option value="M" <?php echo ($_POST['est_sexo']=="M")?'selected="selected"':'' ?> > <?php echo Masculino; ?>  </option>
                                                <option value="F" <?php echo ($_POST['est_sexo']=="F")?'selected="selected"':'' ?> > <?php echo Femenino; ?>  </option>
                                            </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right">Tel&eacute;fono habitaci&oacute;n:</div></td>
                                    <td><input name="est_tlf_hab" type="text" class="parrafo" id="est_tlf_hab" maxlength="11" value="<?php if (isset($_POST['est_tlf_hab'])) echo $_POST['est_tlf_hab']  ;?>" />
                                    <span class="buscador">Ejemplo: 02129441234</span></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right">Tel&eacute;fono celular:</div></td>
                                    <td><input name="est_tlf_cel" type="text" class="parrafo" id="est_tlf_cel" maxlength="11" value="<?php if (isset($_POST['est_tlf_cel'])) echo $_POST['est_tlf_cel']  ;?>" />
                                    <span class="buscador">Ejemplo: 04169441234</span></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="parrafo"><div align="right"><span class="rojo">*</span>Correo electr&oacute;nico:</div></td>
                                    <td><input name="est_email" type="text" class="parrafo" id="est_email" value="<?php if (isset($_POST['est_email'])) echo $_POST['est_email']  ;?>" />
                                    <span class="buscador">Ejemplo: ejemplo@correo.com</span></td></td>
                                </tr>
                            </table>
                        </div>
                        </div>
                       
                        
                        
                        <!---------------Se ingresan los datos del proyecto---------------->
                        <div id="tabs-2">
                            <table>
                                <tr>
                                    <td class="parrafo"><span class="buscador">Por favor especifique los siguientes datos del proyecto:</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="parrafo"><div align="right">
                                        <span class="rojo">*</span><strong>C&oacute;digo del proyecto: </strong></div>
                                    </td>
                                    <td colspan="2" class="parrafo">
                                        <select name="proyecto_lista" class="parrafo" id="select" value="<?php if (isset($_POST['proyecto_lista'])) echo $_POST['proyecto_lista']  ;?> " onchange="Combos(this)">
                                        <option value="Elige">Seleccione</option>
                                            <?
                                            foreach($LISTA_PROYECTOS as $value): ?>
                                                <option value="<?php echo $value['id'] ;?>" ><?php echo $value['codigo'] ;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="parrafo"><div align="right"><span class="rojo">*</span><strong>Tutor Acad&eacute;mico:</strong></div></td>
                                    <td colspan="2" class="parrafo"> 
                                        <select name="tutor" id="tutor" ></select><br><br>                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        
                        
                        
                        
                        
                        <!---------------Se ingresan los datos de la inscripcion------------>
                        <div id="tabs-3">
                            <table align="center">
                                <tr>
                                    <td colspan="4" class="parrafo"><span class="buscador">Por favor especifique los siguientes datos de la inscripci&oacute;n:</span> </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="parrafo"><strong><div align="center"><span class="rojo">*</span>Fecha de inscripci&oacute;n:</div></strong></td>
                                <tr>
                                    <td><div align="center" class="demo">
                                            <input type="text" id="datepicker" name="ins_fecha" size="10" value="<?php if (isset($_POST['ins_fecha'])) echo $_POST['ins_fecha']  ;?>"/>
                                    </div></td>
                                </tr>
                                <tr>
                                    <td width="14%" align="center">
                                        <strong><span class="rojo">*</span>Per&iacute;odo</strong>:
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <select class="parrafo" name="ins_trimestre">
                                        <option value="Enero-Marzo" <?php 
                                                    if (isset($_POST['ins_trimestre'])) 
                                                        echo ($_POST['ins_trimestre']=='Enero-Marzo')?'selected="selected"':''; ?>>Enero-Marzo</option>
                                        <option value="Abril-Julio" <?php 
                                                    if (isset($_POST['ins_trimestre'])) 
                                                        echo ($_POST['ins_trimestre']=='Abril-Julio')?'selected="selected"':''; ?>|>Abril-Julio</option>
                                        <option value="Septiembre-Diciembre" <?php 
                                                    if (isset($_POST['ins_trimestre'])) 
                                                        echo ($_POST['ins_trimestre']=='Septiembre-Diciembre')?'selected="selected"':''; ?>>Septiembre-Diciembre</option>
                                        </select>
                                        <select class="parrafo" name="ins_anio">
                                        <option value="<?=date('Y')-1?>"
                                                <?php 
                                                    if (isset($_POST['ins_anio'])) 
                                                        echo ($_POST['ins_anio']==(date('Y')-1))?'selected="selected"':''; ?>
                                                > <?=date('Y')-1?> 
                                        </option>
                                        <option value="<?=date('Y')?>"
                                                <?php 
                                                    if (isset($_POST['ins_anio'])) 
                                                        echo ($_POST['ins_anio']==(date('Y')))?'selected="selected"':''; 
                                                    else echo selected ?>
                                                > <?=date('Y')?> 
                                        </option>
                                        <option value="<?=date('Y')+1?>"
                                                <?php 
                                                    if (isset($_POST['ins_anio'])) 
                                                        echo ($_POST['ins_anio']==(date('Y')+1))?'selected="selected"':''; ?>
                                                > <?=date('Y')+1?> </option>	
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="parrafo">
                                        <strong><div align="center"><span class="rojo">*</span>N&uacute;mero de horas:</div></strong>
                                    </td>
                                </tr>
                                <tr>
                                    
                                                      
                                    
                                    <td align="center">
                                        <select name="ins_horas">
                                            <option value="0">0</option>
                                        <?php
                                        for ($i=30;$i<=120;$i++){ ?> 
                                            <option value="<?php echo $i; ?>" 
                                                <?php 
                                                    if (isset($_POST['ins_horas'])) 
                                                        echo ($_POST['ins_horas']==$i)?'selected="selected"':''; ?> >
                                                <?php echo $i;?>
                                            </option>
                                        <?php                                          
                                        }
                                        ?>
                                        </select>
                                        <div align="center"class="buscador"><strong style="color:#06F">AVISO: </strong>En caso de colocar 0 en n&uacute;mero de horas, implica que el estudiante no ha culminado.</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div><!-- End demo -->    
        </td></tr>
    
    
    
    
    
        
        <tr>
            <td colspan="4" valign="top" class="parrafo">
                &nbsp;
                <div align="center">
                    <input type="hidden" name="accion" value="inscribir_proy_cctds" />
                    <input type="image" src="imagenes/iconos/apply2.jpg" />
                </div>
            </td>
        </tr>
            
     </table>    
</form>


<hr>

<!-- ------------------------SE ESPECIFICA LA MODALIDAD 2: SUBIR EN CASCADA------------------------- -->
<form name="inscribir_casc_cctds" action="cInscribirProyectoCCTDS.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="4"><p align="center" class="titular_negro"><strong>MODALIDAD 2: INSCRIPCI&Oacute;N DE ESTUDIANTES EN CASCADA.</strong><br />
                <span class="buscador">Todos los campos son obligatorios <span class="rojo">*</span></span> <br /><br />
            </tr>
            <tr>
                <td colspan="4"  valign="top" class="parrafo"><p><strong>Ingresar estudiantes en 
                            cascada desde un archivo ".csv": </strong></p>
                    Recuerde ingresar los datos en el formato adecuado, instrucciones en la siguiente p&aacute;gina: 
                    <a href='vInstruccionesSubirEstudiantes.php'>aqu&iacute;...</a></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2" class="parrafo"><input name="xls" type="file" class="parrafo" id="xls" /></td>
            </tr>
            <tr>
                <td colspan="4" valign="top" class="parrafo">
                    <div align="center">
                        <input type="hidden" name="accion" value="inscribir_casc_cctds" />
                        <input type="image" src="imagenes/iconos/apply2.jpg" />
                    </div>
                </td>
            </tr>
            
        </table>
</form>

<?php include_once('vFooter.php'); ?>
</div>