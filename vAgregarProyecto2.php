<?
require "cAutorizacion.php";

if (!periodoFormulacion($conexion) && (!isEmpleadoCCTDS())){
   echo "Redireccionando...";
   ?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El periodo para introducir nuevos proyectos de servicio comunitario ha caducado', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
        </script>	
    </body>
    
   <?
   cerrarConexion($conexion);
} else {
    
        include_once("cDeterminarBrowser.php");
        $valid_browser=browser_works();
        if (!$valid_browser){
            ?>
            <script>
                window.location.href='vAgregarProyecto.php';
            </script>
            <?
            exit;
        }

require "cAutorizacion.php";

//Se verifica si el usuario ya tiene alguna formulacion de un proyecto
include "cModificarFormulacion.php";

include_once("vHeader.php");
?>
<script>
//--------------------SCRIPT PARA AVISAR QUE CADUCARA UNA SESION------------------->       
setTimeout('afterFourMinutes()',1000*60*4)

function afterFourMinutes(){
    $(function() {
                $( "#dialog" ).dialog({
                        modal: true
                });
        });
}

//------------Crea las tablas con el estilo importado------------>    
  
    $(document).ready(function() {
        $("#tabs").tabs({
            event: "mouseover"
        }).addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');

    });
  
//---------Mostrar y ocultar elementos de las tablas------------->
  
        $(document).ready(function(){
		    
		    $(".buttons").click(function () {
		    var divname= this.value;
		      $("#"+divname).toggle("slow").siblings();
		    });
	});
  
//---------Mostrar acordion para tutores------------->
  
	$(function() {
		$("#accordion").accordion({
                        autoHeight: false,
                        collapsible: true
		});
	});

//---------Mostrar aviso para loading---------------->
        function preloader(){
            document.getElementById("loading").style.display = "none";
            document.getElementById("content").style.display = "block";
        }//preloader
        window.onload = preloader;

    </script>    
    <style type="text/css">
    /* Vertical Tabs
    ----------------------------------*/
    .ui-tabs-vertical { width: 60em; }
    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
    .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 45em;}
    
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
    
<?php
    
?>
    <table align="center">
        <tr>
            <td align="center"><br/><br/><div id="loading"><br/><br/><br/>Cargando... Por favor, espere...</div></td>
        </tr>
    </table>    
    
    <div id="content">
   
<?php foreach( (array)$_ERRORES as $value): ?>
<div class="error"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_WARNING as $value): ?>
<div class="warning"><?php echo $value; ?></div>
<?php endforeach; ?>
<?php foreach( (array)$_SUCCESS as $value): ?>
<div class="success"><?php echo $value; ?></div>
<?php endforeach; ?>

<div class="demo">
<div id="dialog" title="Aviso de Sesi&oacute;n" style="display:none">
    <p>Han transcurrido 4 minutos y su sesi&oacute;n est&aacute; a punto de caducar. <br/><br/><strong style="color:#06F">Se le recomienda guardar lo que ha realizado.</strong></p>
</div>
</div>
<!--<script type="text/javascript" language="javascript" src="cVerifProy.js"></script>-->

<form name="datos" action="cAgregarProyecto2.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
        <table width="500" align="center" border="0" cellpadding="0" cellspacing="5">
                <tr>
                        <td colspan="4"><p align="center" class="titular_negro"><strong>MODELO PARA LA FORMULACION</strong><br />
                                    <strong>DE UN PROYECTO DE SERVICIO COMUNITARIO</strong><br />
                                    <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
                                    <span class="buscador"><strong>Fecha: <? echo date('d-m-Y'); ?></strong></span></p>
                        </td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        if ($_SESSION[USBID]==$_SESSION[saved_proy][usbid_postula]) { ?>
                        <div id="message1"><?php echo $messages_fijo[0]; ?></div>
                        <?php } else unset($_SESSION[saved_proy]);?>                
                    </td>
                </tr>
                <!-------------------Tabla del proponente del proyecto---------------------------->
                <tr><td>
    <div class="demo">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">PROPONENTE</a></li>
            <li><a href="#tabs-2">COMUNIDAD</a></li>
            <li><a href="#tabs-3">TUTORES</a></li>
            <li><a href="#tabs-4">REPRESENTANTE</a></li>
            <li><a href="#tabs-5">ORGANIZACI&Oacute;N</a></li>
            <li><a href="#tabs-6">DESCRIPCI&Oacute;N</a></li>
        </ul>
        <!----------------------------------PROPONENTE DEL PROYECTO-------------------------------->
        <div id="tabs-1">
            <span class="parrafo"><div align="titular"><strong>PROPONENTE DEL PROYECTO</strong></div></span><br />
            <span class="parrafo"><div align="left"><span class="rojo">*</span>USBID:</span>
            <span class="parrafo">
                <select name="prop_usbid" class="parrafo" id="prop_usbid">
                            <option value="" >--seleccione--</option>
                            <?foreach($LISTA_PROP as $value): ?>
                                <option value="<?php echo $value['usbid'] ?>" 
                                    <?php 
                                        if (isset($_POST['prop_usbid']))
                                                echo ($_POST['prop_usbid']==$value['usbid'])?'selected="selected"':'';
                                            else if (isset($_SESSION[saved_proy][usbid_prop])) 
                                                echo ($_SESSION[saved_proy][usbid_prop]==$value['usbid'])?'selected="selected"':''; ?> >
                                    <?php echo $value['apellido']. ", " . $value['nombre'] . " (" .$value['usbid'] .")" ;?>
                                </option>
                            <?php endforeach; ?>
                </select>
            </div></span>
            <!--Agregar proponente manualmente-->
            <div id="buttonsDiv">
                <span class="buscador"><br/>Si el proponente no se encuentra en la lista, seleccione aqu&iacute;:
                <input name="AgregarProponente" type="button" id="button1" class="buttons" value="Proponente"></input></span>
            </div>
            <div name="AgregarProponente" id="Proponente" style="display:none">
                <table align="center" cellpading="0">
                    <tr><td>
                        <td colspan="2" class="parrafo">
                            <br /> <br />
                            <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si el proponente <u>no se encuentra</u> en la lista anterior:</strong>
                            <br />
                            <table width="100%" border="0" cellpadding="0">
                            <tr>
                                <td><div align="right">Nombre: </div></td>
                                <td><input name="prop_nombre" type="text" value="<?php if (isset($_POST['prop_nombre'])) echo $_POST['prop_nombre']  ;?>" class="parrafo" id="prop_nombre" /></td>
                            </tr>
                            <tr>
                                <td><div align="right">Apellido: </div></td>
                                <td><input name="prop_apellido" type="text" class="parrafo" id="prop_apellido" value="<?php if (isset($_POST['prop_apellido'])) echo $_POST['prop_apellido']  ;?>" /></td>
                            </tr>
                            <tr>
                                <td><div align="right">Email: </div></td>
                                <td><input name="prop_usbid_nuevo" type="text" class="parrafo" id="prop_usbid_nuevo" value="<?php if (isset($_POST['prop_usbid_nuevo'])) echo $_POST['prop_usbid_nuevo']  ;?>"/>
                                @usb.ve</td>
                            </tr>
                            <tr>
                                <td><div align="right">C&eacute;dula: </div></td>
                                <td><input name="prop_ci" type="text" class="parrafo" id="prop_ci"  value="<?php if (isset($_POST['prop_ci'])) echo $_POST['prop_ci']  ;?>"/> Ej: 12345678</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#06F"><strong><br />Si el proponente es estudiante: </strong></td>
                                </tr>
                            <tr>
                                <td><div align="right">Carnet: </div></td>
                                <td><input name="prop_carnet" type="text" class="parrafo" id="prop_carnet" value="<?php if (isset($_POST['prop_carnet'])) echo $_POST['prop_carnet']  ;?>" /> Ej: 01-23456</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#06F"><strong><br />Si el proponente es miembro de la comunidad USB: </strong></td>
                                </tr>
                            <tr>
                                <td><div align="right">Dependencia: </div></td>
                                <td>
                            <select name="prop_dependencia" class="parrafo" id="prop_dependencia" value="<?php if (isset($_POST['prop_dependencia'])) echo $_POST['prop_dependencia']  ;?>">
                                    <option value=''>-- seleccione --</option>
                                    <?
                                    foreach($LISTA_DEPENDENCIAS as $value): ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo ($_POST['prop_dependencia']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?> </option>
                                    <?php endforeach; ?>

                            </select>

                            </td>
                            </tr>
                            </table>
                    </td></tr>
                </table>
            </div>
        </div>

        
        
        <!----------------------------------COMUNIDAD BENEFICIARIA-------------------------------->        
        <div id="tabs-2">
            <span class="parrafo"><div align="center"><strong>COMUNIDAD BENEFICIARIA</strong></div></span>
            <span class="buscador">Identificar  la comunidad (por ejemplo Sisipa, Liceo Alejo Fortique), y la ubicaci&oacute;n  geogr&aacute;fica</span><br /><br />
            
                <table align="center" cellpading="0">
                    <tr>
                        <td colspan="2" valign="top" class="parrafo">
                        <div align="right"><strong><span class="rojo">*</span></strong>Comunidad: </div></td>
                        <td colspan="2" class="parrafo"><select name="comuni_id" class="parrafo" id="comuni_id" value="<?php if (isset($_POST['comuni_id'])) echo $_POST['comuni_id']  ;?>">
                            <option value="">--seleccione--</option>
                            <?
                            foreach($LISTA_COMUNIDADES as $value): ?>
                            <option value="<?php echo $value['id'] ?>" 
                                <?php 
                                    if (isset($_POST['comuni_id']))
                                        echo ($_POST['comuni_id']==$value['id'])?'selected="selected"':'';
                                    else if (isset($_SESSION[saved_proy][comunidad])) 
                                           echo ($_SESSION[saved_proy][comunidad]==$value['id'])?'selected="selected"':''; ?> >
                                <?php 
                                    $max=45;
                                    if (strlen($value['nombre'])>$max)
                                        echo substr($value[nombre], 0, $max)."...";
                                    else
                                        echo $value['nombre'] ?> 
                            </option>
                            <?php endforeach; ?>

                        </select>
                            <br />
                            <!--Agregar comunidad manualmente-->
                            <div id="buttonsDiv">
                                <span class="buscador"><br/>Si la comunidad no se encuentra en la lista, seleccione aqu&iacute;:
                                <input name="AgregarComunidad" type="button" id="button1" class="buttons" value="Comunidad"></input></span>
                            </div>
                            <div name="AgregarComunidad" id="Comunidad" style="display:none">
                            <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si la comunidad <u>no se encuentra</u> en la lista anterior:</strong>
                            <br />
                            <table width="100%" border="0" cellpadding="0">
                            <tr>
                                <td colspan="2" class="parrafo"><div align="right">Nombre: </div></td>
                                <td colspan="2" class="parrafo"><input name="comuni_nombre" type="text" class="parrafo" id="comuni_nombre" value="<?php if (isset($_POST['comuni_nombre'])) echo $_POST['comuni_nombre']  ;?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="parrafo"><div align="right">Ubicaci&oacute;n: </div></td>
                                <td colspan="2" class="parrafo"><textarea name="comuni_ubic" cols="50" type="text" rows="8" class="parrafo" id="comuni_ubic" style="max-width:400"><?php if (isset($_POST['comuni_ubic'])) echo break_line($_POST['comuni_ubic']); ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="parrafo"><div align="right">Descripci&oacute;n: </div></td>
                                <td colspan="2" class="parrafo"><textarea name="comuni_desc" cols="50" type="text" rows="8" class="parrafo" id="comuni_desc"><?php if (isset($_POST['comuni_desc'])) echo break_line($_POST['comuni_desc'])  ;?></textarea></td>
                            </tr>
                            </table>
                            </div>

                            </td>
                </tr>
                <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>T&Iacute;TULO  DEL PROYECTO </strong></div></td>
                        <td colspan="2" class="parrafo"><textarea name="titulo" type="text" cols="50" rows="8" class="parrafo" id="titulo"><?php if (isset($_POST['titulo'])) echo break_line($_POST['titulo']) ; 
                                                            else if (isset($_SESSION[saved_proy][titulo_proy])) echo break_line($_SESSION[saved_proy][titulo_proy]); ?></textarea></td>
                </tr>
                <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>&Aacute;REA DEL PROYECTO</strong>
                                <br />
                                <span class="buscador">Educativa, t&eacute;cnica, deportiva,  cultural, etc.</span></div></td>
                        <td colspan="2" class="parrafo"><select name="area_proy" class="parrafo">
                        <option value="">--seleccione--</option>
                        <?
                        foreach($AREA_PROYECTO as $value): ?>
                            <option value="<?php echo $value['id'] ?>" 
                                <?php 
                                    if (isset($_POST['area_proy']))
                                        echo ($_POST['area_proy']==$value['id'])?'selected="selected"':'';
                                    else if (isset($_SESSION[saved_proy][area_proy])) 
                                           echo ($_SESSION[saved_proy][area_proy]==$value['id'])?'selected="selected"':''; ?> >
                                <?php echo $value['nombre'] ?> </option>
                        <?php endforeach; ?>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>IMPACTO SOCIAL</strong><br />
                        <span class="buscador">N&uacute;mero  de beneficiarios y descripci&oacute;n. Ejemplo: pacientes renales, adolescentes fuera  de la educaci&oacute;n formal. </span></div></td>
                    <td colspan="2" class="parrafo"><textarea name="impacto" type="text" cols="50" rows="8" class="parrafo" id="impacto"><?php if (isset($_POST['impacto'])) echo break_line($_POST['impacto']);
                                                        else if (isset($_SESSION[saved_proy][impacto_social])) echo break_line($_SESSION[saved_proy][impacto_social]);?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>CANTIDAD DE BENEFICIADOS</strong><br />
                        <span class="buscador">Descripci&oacute;n de la cantidad de personas que ser&aacute;n beneficiadas por el proyecto. Especificando por sexo, edad y personas con discapacidad. </span></div></td>
                    <td>
                    <table>
                        <tr>
                            <td colspan="2" class="parrafo"><strong>
                                Cantidad de Mujeres:</strong>
                            </td>
                            <td>
                                <input name="cant_fem" type="int" class="parrafo" id="cant_fem" size="6" maxlength="5" value="<?php if (isset($_POST['cant_fem'])) echo $_POST['cant_fem'] ;
                                    else if (isset($_SESSION[saved_proy][cant_fem])) echo break_line($_SESSION[saved_proy][cant_fem]); 
                                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="parrafo"><strong>
                                Cantidad de Hombres:</strong>
                            </td>
                            <td>
                                <input name="cant_masc" type="int" class="parrafo" id="cant_masc" size="6" maxlength="5" value="<?php if (isset($_POST['cant_masc'])) echo $_POST['cant_masc']  ;
                                    else if (isset($_SESSION[saved_proy][cant_masc])) echo break_line($_SESSION[saved_proy][cant_masc]);
                                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="parrafo"><strong>
                                Cantidad de personas con discapacidad:</strong>
                            </td>
                            <td>
                                <input name="cant_disc" type="int" class="parrafo" id="cant_disc" size="6" maxlength="5" value="<?php if (isset($_POST['cant_disc'])) echo $_POST['cant_disc']  ;
                                else if (isset($_SESSION[saved_proy][cant_disc])) echo break_line($_SESSION[saved_proy][cant_disc]);
                                ?>" />
                            </td>
                        </tr>
                        <tr>
                        <td colspan="2" class="parrafo"><strong>
                            Edades:</strong>
                        </td>
                        <td colspan="2" class="parrafo">M&iacute;nima: <br/>
                        <select name="min_edad" class="parrafo">
                            <option value="">--seleccione--</option>
                            <option value="0">menos de 10 a&ntilde;os</option>
                            <?php
                            for ($i=10;$i<90;$i=$i+10){?>
                                <option value="<?php echo $i ?>" 
                                        <?php 
                                            if (isset($_POST['min_edad'])) 
                                                echo ($_POST['min_edad']==$i)?'selected="selected"':''; 
                                            else if (isset($_SESSION[saved_proy][edad_min]))
                                                    if ($_SESSION[saved_proy][edad_min]==$i) 
                                                        echo 'selected="selected"'.':'.''; ?> >
                                    <?php echo $i ?> a&ntilde;os</option>";
                            <?php
                            }
                            ?>
                        </select><br/>
                            M&aacute;xima: <br/>
                        <select name="max_edad" class="parrafo">
                            <option value="">--seleccione--</option>
                            <?php
                            for ($i=10;$i<90;$i=$i+10){?>
                                <option value="<?php echo $i ?>" 
                                    <?php 
                                            if (isset($_POST['max_edad'])) 
                                                echo ($_POST['max_edad']==$i)?'selected="selected"':''; 
                                            else if (isset($_SESSION[saved_proy][edad_max]))
                                                    if ($_SESSION[saved_proy][edad_max]==$i) 
                                                        echo 'selected="selected"'.':'.''; ?> >
                                    <?php echo $i ?> a&ntilde;os</option>";
                            <?php
                            }
                            ?>
                            <option value="90">m&aacute;s de 80 a&ntilde;os</option>
                        </select>
                        </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>RESUMEN  DEL PROYECTO</strong></div></td>
                        <td colspan="2" class="parrafo"><textarea name="resumen" type="text" cols="50" rows="8" class="parrafo" id="resumen"><?php if (isset($_POST['resumen'])) echo break_line($_POST['resumen'])  ;
                        else if (isset($_SESSION[saved_proy][resumen])) echo break_line($_SESSION[saved_proy][resumen]);?></textarea></td>
                </tr>
            </table>
        </div>

        
        
        <!------------------------TUTORES DE SERVICIO COMUNITARIO--------------------->        
        <div id="tabs-3">
            <span class="parrafo"><div align="center"><strong>TUTORES DE SERVICIO COMUNITARIO</strong></div></span>
            <span class="buscador">Puede ser un profesor,  empleado, o una persona de la   Universidad con comprobada experticia en el &aacute;rea del proyecto.  Puede ser el mismo proponente en caso de cumplir con lo antes mencionado<br /></span><br /><br />
            

            <div id="accordion">
                    <!----------------------TABLA DE TUTOR 1----------------------------------->
                    <h3><a href="#"><span class="rojo">*</span> Tutor 1</a></h3>
                    <div>
                            <table align="center" cellpading="0">
                                    <tr>
                                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>USBID: </div></td>
                                        <td colspan="2" class="parrafo"><select name="tutor1_usbid" class="parrafo" id="select">
                                        <option value="">--seleccione--</option>

                                        <?
                                        foreach($LISTA_TUTORES as $value): ?>
                                            <option value="<?php echo $value['usbid'] ?>" 
                                                <?php 
                                                    if (isset($_POST['tutor1_usbid']))
                                                        echo ($_POST['tutor1_usbid']==$value['usbid'])?'selected="selected"':'';
                                                    else if (isset($_SESSION[saved_proy][usbid_tutor1])) 
                                                        echo ($_SESSION[saved_proy][usbid_tutor1]==$value['usbid'])?'selected="selected"':''; ?> >
                                                <?php echo $value['apellido']. ", " . $value['nombre'] . " (" .$value['usbid'] .")" ;?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                        <br />
                                        <!--Agregar tutor1 manualmente-->
                                        <div id="buttonsDiv">
                                            <span class="buscador"><br/>Si el tutor no se encuentra en la lista, seleccione aqu&iacute;:
                                            <input name="AgregarTutor1" type="button" id="button1" class="buttons" value="Tutor1"></input></span>
                                        </div>
                                        <div name="AgregarTutor1" id="Tutor1" style="display:none"><br />
                                        <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si el tutor <u>no se encuentra</u> en la lista anterior:</strong>
                                        <table width="100%" border="0" cellpadding="0">
                                        <tr>
                                        <td><div align="right">Nombre:</div></td>
                                        <td><input name="tutor1_nombre" type="text" class="parrafo" id="tutor1_nombre" value="<?php if (isset($_POST['tutor1_nombre'])) echo $_POST['tutor1_nombre']  ;?>"/></td>
                                        </tr>
                                        <tr>
                                        <td><div align="right">Apellido:</div></td>
                                        <td><input name="tutor1_apellido" type="text" class="parrafo" id="tutor1_apellido" value="<?php if (isset($_POST['tutor1_apellido'])) echo $_POST['tutor1_apellido']  ;?>" /></td>
                                        </tr>
                                        <tr>
                                        <td><div align="right">Email:</div></td>
                                        <td><input name="tutor1_usbid_nuevo" type="text" class="parrafo" id="tutor1_usbid_nuevo" value="<?php if (isset($_POST['tutor1_usbid_nuevo'])) echo $_POST['tutor1_usbid_nuevo']  ;?>"/>
                                        @usb.ve</td>
                                        </tr>
                                        <tr>
                                        <td><div align="right">C&eacute;dula:</div></td>
                                        <td><input name="tutor1_ci" type="text" class="parrafo" id="tutor1_ci" value="<?php if (isset($_POST['tutor1_ci'])) echo $_POST['tutor1_ci']  ;?>"/>Ej: 12345678</td>
                                        </tr>

                                        <tr>
                                        <td><div align="right">Dependencia:</div></td>
                                        <td>
                                        <select name="tutor1_dependencia" class="parrafo" id="tutor1_dependencia" value="<?php if (isset($_POST['tutor1_dependencia'])) echo $_POST['tutor1_dependencia']  ;?>">
                                                <option value=''>-- seleccione --</option>
                                                <?
                                                foreach($LISTA_DEPENDENCIAS as $value): ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo ($_POST['tutor1_dependencia']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?> </option>
                                                <?php endforeach; ?>
                                        </select>

                                        </td>
                                        </tr>
                                        <tr>
                                        <td><div align="right">Tel&eacute;fono:</div></td>
                                        <td><input name="tutor1_tlf" type="text" class="parrafo" id="tutor1_tlf" value="<?php if (isset($_POST['tutor1_tlf'])) echo $_POST['tutor1_tlf']  ;?>"/> Ej: (0123)456-7890</td>
                                        </tr>
                                        </table>
                                        </div></td>
                                </tr>
                            </table>
                    </div>
                    <!----------------------TABLA DE TUTOR 2----------------------------------->
                    <h3><a href="#">Tutor 2</a></h3>
                    <div>
                        <table align="center" cellpading="0">
                            <tr>
                                    <td colspan="2" valign="top" class="parrafo"><div align="right">USBID: </div></td>
                                    <td colspan="2" class="parrafo"><select name="tutor2_usbid" class="parrafo" id="select" value="<?php if (isset($_POST['tutor2_usbid'])) echo $_POST['tutor2_usbid']  ;?>">
                                    <option value="">--seleccione--</option>
                                    <?
                                    foreach($LISTA_TUTORES as $value): ?>
                                        <option value="<?php echo $value['usbid'] ?>" 
                                            <?php 
                                                    if (isset($_POST['tutor2_usbid']))
                                                        echo ($_POST['tutor2_usbid']==$value['usbid'])?'selected="selected"':'';
                                                    else if (isset($_SESSION[saved_proy][usbid_tutor2])) 
                                                        echo ($_SESSION[saved_proy][usbid_tutor2]==$value['usbid'])?'selected="selected"':''; ?> >
                                            <?php echo $value['apellido']. ", " . $value['nombre'] . " (" .$value['usbid'] .")" ;?>
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                    <br />
                                    <!--Agregar tutor2 manualmente-->
                                    <div id="buttonsDiv">
                                        <span class="buscador"><br/>Si el tutor no se encuentra en la lista, seleccione aqu&iacute;:
                                        <input name="AgregarTutor2" type="button" id="button1" class="buttons" value="Tutor2"></input></span>
                                    </div>
                                    <div name="AgregarTutor2" id="Tutor2" style="display:none"><br />
                                    <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si el tutor <u>no se encuentra</u> en la lista anterior:</strong>

                                    <table width="100%" border="0" cellpadding="0">
                                    <tr>
                                    <td><div align="right">Nombre:</div></td>
                                    <td><input name="tutor2_nombre" type="text" class="parrafo" id="tutor2_nombre" value="<?php if (isset($_POST['tutor2_nombre'])) echo $_POST['tutor2_nombre']  ;?>"/></td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Apellido:</div></td>
                                    <td><input name="tutor2_apellido" type="text" class="parrafo" id="tutor2_apellido" value="<?php if (isset($_POST['tutor2_apellido'])) echo $_POST['tutor2_apellido']  ;?>"/></td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Email:</div></td>
                                    <td><input name="tutor2_usbid_nuevo" type="text" class="parrafo" id="tutor2_usbid_nuevo" value="<?php if (isset($_POST['tutor2_usbid_nuevo'])) echo $_POST['tutor2_usbid_nuevo']  ;?>"/>
                                    @usb.ve</td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">C&eacute;dula:</div></td>
                                    <td><input name="tutor2_ci" type="text" class="parrafo" id="tutor2_ci" value="<?php if (isset($_POST['tutor2_ci'])) echo $_POST['tutor2_ci']  ;?>"/> Ej: 12345678</td>
                                    </tr>

                                    <tr>
                                    <td><div align="right">Dependencia:</div></td>
                                    <td>
                                    <select name="tutor2_dependencia" class="parrafo" id="tutor2_dependencia" value="<?php if (isset($_POST['tutor2_dependencia'])) echo $_POST['tutor2_dependencia']  ;?>">
                                            <option value=''>-- seleccione --</option>
                                            <?
                                            foreach($LISTA_DEPENDENCIAS as $value): ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo ($_POST['tutor2_dependencia']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?> </option>
                                            <?php endforeach; ?>
                                    </select>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Tel&eacute;fono:</div></td>
                                    <td><input name="tutor2_tlf" type="text" class="parrafo" id="tutor2_tlf" value="<?php if (isset($_POST['tutor2_tlf'])) echo $_POST['tutor2_tlf']  ;?>"/> Ej: (0123)456-7890</td>
                                    </tr>
                                    </table>
                                    </div></td>
                            </tr>
                        </table>
                    </div>
                    <!----------------------TABLA DE TUTOR 3----------------------------------->
                    <h3><a href="#">Tutor 3</a></h3>
                    <div>
                        <table align="center" cellpading="0">
                            <tr>
                                    <td colspan="2" valign="top" class="parrafo"><div align="right">USBID: </div></td>
                                    <td colspan="2" class="parrafo"><select name="tutor3_usbid" class="parrafo" id="select" value="<?php if (isset($_POST['tutor3_usbid'])) echo $_POST['tutor3_usbid']  ;?>">
                                    <option value="">--seleccione--</option>
                                    <?
                                    foreach($LISTA_TUTORES as $value): ?>
                                        <option value="<?php echo $value['usbid'] ?>" 
                                            <?php 
                                                    if (isset($_POST['tutor3_usbid']))
                                                        echo ($_POST['tutor3_usbid']==$value['usbid'])?'selected="selected"':'';
                                                    else if (isset($_SESSION[saved_proy][usbid_tutor3])) 
                                                        echo ($_SESSION[saved_proy][usbid_tutor3]==$value['usbid'])?'selected="selected"':''; ?> >
                                            <?php echo $value['apellido']. ", " . $value['nombre'] . " (" .$value['usbid'] .")" ;?>
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                    <br />
                                    <!--Agregar tutor3 manualmente-->
                                    <div id="buttonsDiv">
                                        <span class="buscador"><br/>Si el tutor no se encuentra en la lista, seleccione aqu&iacute;:
                                        <input name="AgregarTutor3" type="button" id="button1" class="buttons" value="Tutor3"></input></span>
                                    </div>
                                    <div name="AgregarTutor3" id="Tutor3" style="display:none"><br />
                                    <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si el tutor <u>no se encuentra</u> en la lista anterior:</strong>

                                    <table width="100%" border="0" cellpadding="0">
                                    <tr>
                                    <td><div align="right">Nombre:</div></td>
                                    <td><input name="tutor3_nombre" type="text" class="parrafo" id="tutor3_nombre" value="<?php if (isset($_POST['tutor3_nombre'])) echo $_POST['tutor3_nombre']  ;?>" /></td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Apellido:</div></td>
                                    <td><input name="tutor3_apellido" type="text" class="parrafo" id="tutor3_apellido" value="<?php if (isset($_POST['tutor3_apellido'])) echo $_POST['tutor3_apellido']  ;?>"/></td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Email:</div></td>
                                    <td><input name="tutor3_usbid_nuevo" type="text" class="parrafo" id="tutor3_usbid_nuevo"  value="<?php if (isset($_POST['tutor3_usbid_nuevo'])) echo $_POST['tutor3_usbid_nuevo']  ;?>"/>
                                    @usb.ve</td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">C&eacute;dula:</div></td>
                                    <td><input name="tutor3_ci" type="text" class="parrafo" id="tutor3_ci"  value="<?php if (isset($_POST['tutor3_ci'])) echo $_POST['tutor3_ci']  ;?>"/> Ej: 12345678</td>
                                    </tr>

                                    <tr>
                                    <td><div align="right">Dependencia:</div></td>
                                    <td>
                                            <select name="tutor3_dependencia" class="parrafo" id="tutor3_dependencia" value="<?php if (isset($_POST['tutor3_dependencia'])) echo $_POST['tutor3_dependencia']  ;?>">
                                            <option value=''>-- seleccione --</option>
                                            <?
                                            foreach($LISTA_DEPENDENCIAS as $value): ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo ($_POST['tutor3_dependencia']==$value['id'])?'selected="selected"':'' ?> ><?php echo $value['nombre'] ?> </option>
                                            <?php endforeach; ?>
                                    </select>

                                    </td>
                                    </tr>
                                    <tr>
                                    <td><div align="right">Tel&eacute;fono:</div></td>
                                    <td><input name="tutor3_tlf" type="text" class="parrafo" id="tutor3_tlf"  value="<?php if (isset($_POST['tutor3_tlf'])) echo $_POST['tutor3_tlf']  ;?>"/> Ej: (0123)456-7890</td>
                                    </tr>
                                    </table>
                                    </div></td>
                            </tr>
                        </table>
                    </div>
            </div>
            <table align="center" cellpading="0">
                <tr>
                        <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>&Aacute;REA DE TRABAJO</strong><br />
                            <span class="buscador">Como  se articula el proyecto con actividades de Docencia, Investigaci&oacute;n y Extensi&oacute;n</span></p>          </td>
                        <td colspan="2" class="parrafo"><textarea name="area_trabajo" cols="50" rows="8" class="parrafo" id="area_trabajo"><?php if (isset($_POST['area_trabajo'])) echo break_line($_POST['area_trabajo'])  ;
                        else if (isset($_SESSION[saved_proy][area_trabajo])) echo break_line($_SESSION[saved_proy][area_trabajo]);?></textarea></td>
                </tr>
            </table>

            
            
            
            
                    
        </div>
        
        <!---------------------REPRESENTANTE DE LA COMUNIDAD--------------------->        
        <div id="tabs-4">
            <span class="parrafo"><div align="center"><strong>REPRESENTANTE DE LA COMUNIDAD</strong></div></span><br/>
            <table align="center" cellpading="0">
                <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right">Representante: </div></td>
                        <td colspan="2" class="parrafo"><select name="rep_id" class="parrafo" id="select" value="<?php if (isset($_POST['rep_id'])) echo $_POST['rep_id']  ;?>">
                        <option value="">--seleccione--</option>
                        <?php
                        foreach($LISTA_REPRESENTANTES as $value): ?>
                            <option value="<?php echo $value['id'] ?>" 
                                <?php 
                                    if (isset($_POST['rep_id']))
                                        echo ($_POST['rep_id']==$value['id'])?'selected="selected"':'';
                                    else if (isset($_SESSION[saved_proy][representante])) 
                                        echo ($_SESSION[saved_proy][representante]==$value['id'])?'selected="selected"':''; ?> >
                                <?php echo $value['apellidos']. ", " . $value['nombres'];?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                        <br />
                        <!--Agregar representante manualmente-->
                        <div id="buttonsDiv">
                            <span class="buscador"><br/>Si el representante no se encuentra en la lista, seleccione aqu&iacute;:
                            <input name="Representante" type="button" id="button1" class="buttons" value="Representante"></input></span>
                        </div>
                        <div name="Representante" id="Representante" style="display:none"><br />
                        <strong style="color:#06F">Por favor, especifique los siguientes datos &uacute;nicamente si el representante <u>no se encuentra</u> en la lista anterior:</strong>

                        <table width="100%" border="0" cellpadding="0">
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Apellidos: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_apellidos" type="text" class="parrafo" id="rep_apellidos" value="<?php if (isset($_POST['rep_apellidos'])) echo $_POST['rep_apellidos']  ;?>"/></td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Nombres: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_nombres" type="text" class="parrafo" id="rep_nombres" value="<?php if (isset($_POST['rep_nombres'])) echo $_POST['rep_nombres']  ;?>"/></td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>C&eacute;dula: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_ci" type="text" class="parrafo" id="rep_ci" value="<?php if (isset($_POST['rep_ci'])) echo $_POST['rep_ci']  ;?>"/> Ej: 12345678</td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Tlf. Celular: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_cel" type="text" class="parrafo" id="rep_cel" value="<?php if (isset($_POST['rep_cel'])) echo $_POST['rep_cel']  ;?>"/> Ej: (0123)456-7890</td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Tlf. Oficina: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_tlf" type="text" class="parrafo" id="rep_tlf" value="<?php if (isset($_POST['rep_tlf'])) echo $_POST['rep_tlf']  ;?>"/> Ej: (0123)456-7890</td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Instituci&oacute;n: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_inst" type="text" class="parrafo" id="rep_inst" value="<?php if (isset($_POST['rep_inst'])) echo $_POST['rep_inst']  ;?>"/></td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Direcci&oacute;n: </div></td>
                        <td colspan="2" class="parrafo"><textarea name="rep_dir" cols="50" rows="8" class="parrafo" id="rep_dir"><?php if (isset($_POST['rep_dir'])) echo break_line($_POST['rep_dir'])  ;?></textarea></td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Cargo: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_cargo" type="text" class="parrafo" id="rep_cargo" value="<?php if (isset($_POST['rep_cargo'])) echo $_POST['rep_cargo']  ;?>"/></td>
                        </tr>
                        <tr>
                        <td colspan="2" valign="top" class="parrafo"><div align="right"><span class="rojo">*</span>Correo Electr&oacute;nico: </div></td>
                        <td colspan="2" class="parrafo"><input name="rep_email" type="text" class="parrafo" id="rep_email" value="<?php if (isset($_POST['rep_email'])) echo $_POST['rep_email']  ;?>"/> Ej: ejemplo@correo.com</td>
                        </tr>
                        </table>
                        </div></td>
                </tr>
            </table>
        </div>
        
        <!-------------ORGANIZACIÓN DE DESARROLLO SOCIAL------------------>        
        <div id="tabs-5">
            <span class="parrafo"><div align="center"><strong>ORGANIZACI&Oacute;N DE  DESARROLLO SOCIAL QUE PROMUEVE EL PROYECTO</strong></div></span>
            <span class="buscador"><div align="center">(en caso de que aplique)</div><br /></span>
                    <table align="center" cellpading="0">
                        <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Nombre: </div></td>
                            <td colspan="2" class="parrafo"><input name="org_nombre" type="text" class="parrafo" id="org_nombre" value="<?php if (isset($_POST['org_nombre'])) echo $_POST['org_nombre']  ;
                            else if (isset($_SESSION[saved_proy][nombre_organizacion])) echo break_line($_SESSION[saved_proy][nombre_organizacion]);?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Direcci&oacute;n: </div></td>
                            <td colspan="2" class="parrafo"><textarea name="org_dir" cols="50" rows="8" class="parrafo" id="org_dir"><?php if (isset($_POST['org_dir'])) echo break_line($_POST['org_dir'])  ;
                            else if (isset($_SESSION[saved_proy][direccion_organizacion])) echo break_line($_SESSION[saved_proy][direccion_organizacion]);?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Correo Electr&oacute;nico: </div></td>
                            <td colspan="2" class="parrafo"><input name="org_email" type="text" class="parrafo" id="org_email" value="<?php if (isset($_POST['org_email'])) echo $_POST['org_email']  ;
                            else if (isset($_SESSION[saved_proy][email_organizacion])) echo break_line($_SESSION[saved_proy][email_organizacion]);?>"/> Ej: ejemplo@correo.com</td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Tel&eacute;fono: </div></td>
                            <td colspan="2" class="parrafo"><input name="org_tlf" type="text" class="parrafo" id="org_tlf" value="<?php if (isset($_POST['org_tlf'])) echo $_POST['org_tlf']  ;
                            else if (isset($_SESSION[saved_proy][telefono_organizacion])) echo break_line($_SESSION[saved_proy][telefono_organizacion]);?>"/> Ej: (0123)456-7890</td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">Fax: </div></td>
                            <td colspan="2" class="parrafo"><input name="org_fax" type="text" class="parrafo" id="org_fax" value="<?php if (isset($_POST['org_fax'])) echo $_POST['org_fax']  ;
                            else if (isset($_SESSION[saved_proy][fax_organizacion])) echo break_line($_SESSION[saved_proy][fax_organizacion]);?>"/> Ej: (0123)456-7890</td>
                        </tr>
                    </table>
        </div>
        
        <!-----------------DESCRIPCION DEL PROYECTO---------------------->        
        <div id="tabs-6">
            <span class="parrafo"><div align="center"><strong>DESCRIPCI&Oacute;N DEL PROYECTO</strong></div></span>
            <span class="buscador"><div align="center">Incluye  propuesta, antecedentes, justificaci&oacute;n, objetivos, metodolog&iacute;a, estrategia,  viabilidad.</div><br /></span>
                    <table align="center" cellpading="0">
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Antecedentes: </strong><br />
                                        <span class="buscador">Motivo por el cual esta realizando el  proyecto</span></p></td>
                                <td colspan="2" class="parrafo"><textarea name="antecedentes" cols="50" rows="8" class="parrafo" id="antecedentes"><?php if (isset($_POST['antecedentes'])) echo break_line($_POST['antecedentes'])  ;
                                else if (isset($_SESSION[saved_proy][antecedentes])) echo break_line($_SESSION[saved_proy][antecedentes]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>Objetivo General: </strong></div></td>
                                <td colspan="2" class="parrafo"><textarea name="obj_gral" cols="50" rows="8" class="parrafo" id="obj_gral"><?php if (isset($_POST['obj_gral'])) echo break_line($_POST['obj_gral'])  ;
                                else if (isset($_SESSION[saved_proy][obj_general])) echo break_line($_SESSION[saved_proy][obj_general]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Objetivos Espec&iacute;ficos: </strong> <strong></strong></p></td>
                                <td colspan="2" class="parrafo"><textarea name="obj_esp" cols="50" rows="8" class="parrafo" id="obj_esp"><?php if (isset($_POST['obj_esp'])) echo break_line($_POST['obj_esp'])  ;
                                else if (isset($_SESSION[saved_proy][obj_especificos])) echo break_line($_SESSION[saved_proy][obj_especificos]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Descripci&oacute;n General del Proyecto: </strong></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="desc" cols="50" rows="8" class="parrafo" id="desc"><?php if (isset($_POST['desc'])) echo break_line($_POST['desc'])  ;
                                else if (isset($_SESSION[saved_proy][descripcion])) echo break_line($_SESSION[saved_proy][descripcion]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Actividades espec&iacute;ficas del estudiante: </strong><br />
                                    <span class="buscador">Colocar ac&aacute; el trabajo  espec&iacute;fico que realizar&aacute; el estudiante, horas que debe dedicar semanalmente: </span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="act_esp" cols="50" rows="8" class="parrafo" id="act_esp"><?php if (isset($_POST['act_esp'])) echo break_line($_POST['act_esp'])  ;
                                else if (isset($_SESSION[saved_proy][actividades])) echo break_line($_SESSION[saved_proy][actividades]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Perfil Curricular: </strong><br />
                                        <span class="buscador">Describa  si es necesario que los estudiantes a trabajar en el proyecto tengan un perfil  determinado</span></p></td>
                                <td colspan="2" class="parrafo"><textarea name="perfil" cols="50" rows="8" class="parrafo" id="perfil"><?php if (isset($_POST['perfil'])) echo break_line($_POST['perfil'])  ;
                                else if (isset($_SESSION[saved_proy][perfil])) echo break_line($_SESSION[saved_proy][perfil]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Recursos requeridos y fuentes de financiamiento: <br />
                                </strong><span class="buscador">Describa&nbsp; la  factibilidad del proyecto en t&eacute;rminos econ&oacute;micos</span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="recursos" cols="50" rows="8" class="parrafo" id="recursos"><?php if (isset($_POST['recursos'])) echo break_line($_POST['recursos'])  ;
                                else if (isset($_SESSION[saved_proy][recursos])) echo break_line($_SESSION[saved_proy][recursos]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Describa los  logros sociales: </strong><br />
                                    <span class="buscador">Describa los resultados y el beneficio a ser  aportado a la comunidad y cuantas personas ser&aacute;n beneficiadas</span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="logros" cols="50" rows="8" class="parrafo" id="logros"><?php if (isset($_POST['logros'])) echo break_line($_POST['logros'])  ;
                                else if (isset($_SESSION[saved_proy][logros])) echo break_line($_SESSION[saved_proy][logros]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Describa c&oacute;mo  se aplican las directrices y valores expuestos en la Ley: </strong><br />
                                    <span class="buscador">Describa como el estudiante se vincula con la  comunidad. &iquest;Se genera sensibilizaci&oacute;n en el estudiante?, &iquest;C&oacute;mo se logra  aprendizaje de servicio?</span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="directrices" cols="50" rows="8" class="parrafo" id="directrices"><?php if (isset($_POST['directrices'])) echo break_line($_POST['directrices'])  ;
                                else if (isset($_SESSION[saved_proy][directrices])) echo break_line($_SESSION[saved_proy][directrices]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Magnitud  del Proyecto: </strong><br />
                                    <span class="buscador">En que medida se logra resolver el problema  propuesto,&iquest;se puede establecer continuidad del proyecto?</span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="magnitud" cols="50" rows="8" class="parrafo" id="magnitud"><?php if (isset($_POST['magnitud'])) echo break_line($_POST['magnitud'])  ;
                                else if (isset($_SESSION[saved_proy][magnitud])) echo break_line($_SESSION[saved_proy][magnitud]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Participaci&oacute;n  de miembros de la comunidad: </strong><br />
                                    <span class="buscador">Describa en que medida la comunidad es  protagonista.</span></p>          </td>
                                <td colspan="2" class="parrafo"><textarea name="participacion" cols="50" rows="8" class="parrafo" id="participacion"><?php if (isset($_POST['participacion'])) echo break_line($_POST['participacion'])  ;
                                else if (isset($_SESSION[saved_proy][participacion])) echo break_line($_SESSION[saved_proy][participacion]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>PLAN DE APLICACI&Oacute;N </strong><br />
                                    <span class="buscador">Calendario  indicando fecha de inicio y de fin, as&iacute; como las semanas que efectivamente  trabajar&aacute; en el proyecto y las que no. El archivo debe estar en formato <b>PDF</b> </span></p>          </td>
                                <td colspan="2" class="parrafo"><input name="plan" type="file" class="parrafo" id="plan" /></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><div align="right"><strong><span class="rojo">*</span>&iquest;REQUERE FORMACI&Oacute;N ESPEC&Iacute;FICA? </strong></div></td>
                                <td colspan="2" class="parrafo"><select name="formacion_req" class="parrafo" id="formacion_req">
                                    <option value="">--seleccione--</option>
                                    <option value="si" <?php if (isset($_POST['formacion_req'])) echo ($_POST['formacion_req']=="si")?'selected="selected"':''; else 
                                                                if (isset($_SESSION[saved_proy][formacion])) echo ($_SESSION[saved_proy][formacion]=="si")?'selected="selected"':'' ; ?>>
                                        Si
                                    </option>
                                    <option value="no" <?php if (isset($_POST['formacion_req'])) echo ($_POST['formacion_req']=="no")?'selected="selected"':''; else 
                                                                if (isset($_SESSION[saved_proy][formacion])) echo ($_SESSION[saved_proy][formacion]=="no")?'selected="selected"':'' ; ?>>
                                        No
                                    </option>
                                </select>        </td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><div align="right"><br /><strong>ESPECIFIQUE LA FORMACI&Oacute;N REQUERIDA</strong> <span class="buscador"><br />
                                    Detalles de la formaci&oacute;n espec&iacute;fica que puede requerir para un proyecto. Por ejemplo: formaci&oacute;n docente para atender adolescentes.  <br />
                                    <strong>Nota</strong>: Debe coordinar con su tutor de Servicio Comunitario la realizaci&oacute;n de los talleres descritos. </span></div></td>
                                <td colspan="2" valign="top" class="parrafo"><textarea name="formacion_esp" cols="50" rows="8" class="parrafo" id="formacion_esp"><?php if (isset($_POST['formacion_esp'])) echo break_line($_POST['formacion_esp'])  ;
                                    else if (isset($_SESSION[saved_proy][formacion_desc])) echo break_line($_SESSION[saved_proy][formacion_desc]);?></textarea></td>
                        </tr>
                        <tr>
                                <td colspan="2" valign="top" class="parrafo"><p align="right"><strong><span class="rojo">*</span>Nro. DE HORAS ACREDITABLES</strong><br />
                                    <span class="buscador">Horas que pueden reconocerse de la formaci&oacute;n espec&iacute;fica (max 24 horas)</span></p>          </td>
                                <td colspan="2" valign="middle" class="parrafo">
                                <select name="horas" class="parrafo" id="horas">
                                    <?
                                    for ($i=0;$i<=24;$i++){ ?> 
                                        <option value="<?php echo $i; ?>" 
                                            <?php 
                                                if (isset($_POST['horas'])) 
                                                    echo ($_POST['horas']==$i)?'selected="selected"':''; 
                                                else if (isset($_SESSION[saved_proy][horas]))
                                                        if ($_SESSION[saved_proy][horas]==$i) 
                                                            echo 'selected="selected"'.':'.''; ?> >
                                            <?php echo $i;?>
                                        </option>
                                    <?php                                          
                                    }
                                    ?>
                                </select></td>
                        </tr>
                    </table>
        </div>
        
        
        
        
        </div>

    </div><!-- End demo -->
    </td></tr>
                
    <!------------------ENVIAR FORMULARIO------------------------------------->            
    <tr>
    <td colspan="4" valign="top" class="parrafo">
        <div align="center">
        <table>
            <tr>
                <td align="right">
                    <button type="submit" title="Ser&aacute; guardado su proyecto para una futura edici&oacute;n." name="accion" 
                    value="guardar_proyecto" style="cursor:pointer; background-color:#ffffff; border:0px; margin:0px;">
                    <img src="imagenes/iconos/save.png" width="50" height="50" alt=""/>
                    </button>
                </td>
                <td>
                    <strong style="color:#06F">Guardar la informaci&oacute;n del proyecto para su posterior modificaci&oacute;n.</strong>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <button type="submit" title="Ser&aacute; enviado definitivamente a la CCTDS." name="accion" value="agregar_proyecto" 
                    style="cursor:pointer; background-color:#ffffff; border:0px; margin:0px;">
                        <img src="imagenes/iconos/apply2.jpg" width="50" height="50" alt=""/>
                    </button>
                </td>
                <td>
                    <strong style="color:#06F">Enviar su proyecto definitivo a la CCTDS para su validaci&oacute;n. Tenga en cuenta que al optar por esta opci&oacute;n, no podr&aacute; modificar su Proyecto despu&eacute;s.</strong>
                </td>
            </tr>
        
        
        </table>
        </div>
    </td>
    </tr>

    </table>
</form>

<?php include_once('vFooter.php'); 
?>
    </div>
<?php } ?>

    