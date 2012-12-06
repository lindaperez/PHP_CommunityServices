<?php
require "cAutorizacion.php";
require "cAgregarProyectoCCTDS.php";

if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

$TITLE = 'Instrucciones para subir Estudiantes por cascada';
include_once("vHeader.php");
?>
<meta charset="utf-8">
<link rel="stylesheet" href="scripts/jqueryui/themes/redmond/jquery.ui.all.css">
<link rel="stylesheet" href="scripts/jqueryui/demos.css">
<!------------Crea las tablas con el estilo importado------------>    
    <script>
    $(document).ready(function() {
        $("#tabs").tabs({
            event: "mouseover"
        }).addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');

    });
    </script>

    <style type="text/css">
    /* Vertical Tabs
    ----------------------------------*/
    .ui-tabs-vertical { width: 50em; }
    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
    .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 35em;}
    </style>     
    
<p align="center" class="titular_negro"><strong>INSTRUCCIONES PARA SUBIR ESTUDIANTES POR CASCADA</strong><br /><br />
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td>
    <div class="demo">

    <div id="tabs">
            <ul>
                    <li><a href="#tabs-1">Paso #1</a></li>
                    <li><a href="#tabs-2">Paso #2</a></li>
                    <li><a href="#tabs-3">Paso #3</a></li>
                    <li><a href="#tabs-4">Paso #4</a></li>
                    <li><a href="#tabs-5">Paso #5</a></li>
            </ul>
            <div id="tabs-1">
                    <p>Almacene los siguientes datos de los estudiantes en un documento ".xls" en el orden indicado y formato correcto.</p>
                    <table align="center" cellpading="0">
                        <tr>
                            <td>
                                <span class="parrafo"><strong><font  color="0000ff"><div align="right">Campo</div></font></strong></span>
                            </td>
                            <td>
                                <span class="parrafo"><strong><font  color="0000ff">Ejemplo</font></strong></span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right">USBID: </div></strong></span></td>
                            <td><span class="parrafo">01-23456</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right">Apellido: </div></strong></span></td>
                            <td><span class="parrafo">Apellido</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right">Nombre: </div></strong></span></td>
                            <td><span class="parrafo">Nombre</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right"><span class="rojo">*</span>C&eacute;dula: </div></strong></span></td>
                            <td><span class="parrafo">12345678</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right">Carrera: </div></strong></span></td>
                            <td><span class="parrafo">0123</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right">Sexo: </div></strong></span></td>
                            <td><span class="parrafo">M o F</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong><div align="right"><span class="rojo">*</span>Tel&eacute;fono habitaci&oacute;n: </div></strong></span></td>
                            <td><span class="parrafo">2129876543</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right"><span class="rojo">*</span>Tel&eacute;fono celular: </div></strong></span></td>
                            <td><span class="parrafo">4169876543</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right">Correo electr&oacute;nico: </div></strong></span></td>
                            <td><span class="parrafo">ejemplo@usb.ve</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right">C&oacute;digo del proyecto: </div></strong></span></td>
                            <td><span class="parrafo">AB1234</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right">USBID del tutor: </div></strong></span></td>
                            <td><span class="parrafo">usbid</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right"><span class="rojo">**</span>Fecha de inicio: </div></strong></span></td>
                            <td><span class="parrafo">01/01/2012</span></td>
                        </tr>
                        <tr>
                            <td align="rigth"><span class="parrafo"><strong><div align="right"><span class="rojo">***</span>N&uacute;mero de horas: </div></strong></span></td>
                            <td><span class="parrafo">30</span></td>
                        </tr>
                    </table><br />
                    <span class="parrafo"><font  color="0000ff"><strong>Observaciones:</strong></font></span><br />
                    <span class="parrafo"><span class="rojo">*</span>Estos campos se pueden dejar vacíos.</span><br />
                    <span class="parrafo"><span class="rojo">**</span>Recuerde colocar el formato de celda como tipo "Fecha".</span><br />
                    <span class="parrafo"><span class="rojo">***</span>Recuerde que debe ser mayor a 30 y menor a 120 horas.</span>
                    
            </div>
            <div id="tabs-2">
                    <table>
                        <tr>
                            <td>
                                <span class="parrafo">Ub&iacute;quese en la hoja que desea subir y posteriormente seleccione File -> Save As...</span><br /><br />
                            </td>
                        </tr>
                        <tr>
                                <td align="center">
                                    <img src="imagenes/ejemplo_subir/csv0.jpg">
                                </td>
                        </tr>
                    </table>
            </div>
            <div id="tabs-3">
                    <table>
                        <tr>
                            <td>
                                <span class="parrafo">Seleccione como formato de salida "Text CSV (.csv)"</span><br /><br />
                            </td>
                        </tr>
                        <tr>
                                <td align="center">
                                    <img src="imagenes/ejemplo_subir/csv1.jpg" width="100%" height="100%" >
                                </td>
                        </tr>
                    </table>
            </div>
            <div id="tabs-4">
                    <table>
                        <tr>
                            <td>
                                <span class="parrafo">Posteriormente seleccione la opción que dice "Keep Current Format"</span><br /><br />
                            </td>
                        </tr>
                        <tr>
                                <td align="center">
                                    <img src="imagenes/ejemplo_subir/csv2.jpg" width="100%" height="100%" >
                                </td>
                        </tr>
                    </table>
            </div>
            <div id="tabs-5">
                    <table>
                        <tr>
                            <td>
                                <span class="parrafo">Mantenga los siguientes campos con el siguiente formato:</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong>Character set:</strong> Unicode (UTF-8)</span></td>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong>Field delimeter:</strong> ;</span>
                        </tr>
                        <tr>
                            <td><span class="parrafo"><strong>Text delimeter:</strong> '</span><br /><br /></td>
                        </tr>
                        <tr>
                                <td align="center">
                                    <img src="imagenes/ejemplo_subir/csv3.jpg" width="100%" height="100%" >
                                </td>
                        </tr>
                    </table>
            </div>
    </div>

    </div><!-- End demo -->
    </td></tr>
</table>    
    
    

<?php include_once('vFooter.php'); ?>