<?
require "cAutorizacion.php";
include "cEspecificarRolesPre.php";

$TITLE = 'EspecificarRoles';
include_once("vHeader.php");
?>
<script type="text/javascript" language="javascript" src="cVerifRoles.js"></script>

<form name="datos" action="cEspecificarRolesPost.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top">
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <tr>
                        <td colspan="4"><p align="center" class="titular_negro"><strong>ESPECIFICAR ROLES</strong><br />
                                <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br /><br />
                                <span class="buscador"><strong>Fecha: <? echo date('d-m-Y'); ?></strong></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: beige "><p class="parrafo" align="center"><b>SEDE: SARTENEJAS.</b></p></td>
                    </tr>
                    <tr>

                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>COORDINADOR:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>   
                    <tr>
                        <td><input name="usbid_coor" type="text" class="parrafo" id="usbid_coor" value="<?= $_SESSION[coordinador][usbid] ?>"/>
                        <td><input name="nombre_coor" type="text" class="parrafo" id="nombre_coor" value="<?= $_SESSION[coordinador][nombre] ?>"/>
                        <td><input name="apellido_coor" type="text" class="parrafo" id="apellido_coor" value="<?= $_SESSION[coordinador][apellido] ?>"/>                 
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>ASISTENTE:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>
                    <tr>
                        <td><input name="usbid_asistente" type="text" class="parrafo" id="usbid_asistente" value="<?= $_SESSION[asistente][usbid] ?>"/>                  
                        <td><input name="nombre_asistente" type="text" class="parrafo" id="nombre_asistente" value="<?= $_SESSION[asistente][nombre] ?>"/>
                        <td><input name="apellido_asistente" type="text" class="parrafo" id="apelllido_asistente" value="<?= $_SESSION[asistente][apellido] ?>"/>        
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>SECRETARIA:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>
                    <tr>
                        <td><input name="usbid_secretaria" type="text" class="parrafo" id="usbid_secretaria" value="<?= $_SESSION[secretaria][usbid] ?>"/>
                        <td><input name="nombre_secretaria" type="text" class="parrafo" id="nombre_secretaria" value="<?= $_SESSION[secretaria][nombre] ?>"/>
                        <td><input name="apellido_secretaria" type="text" class="parrafo" id="apelllido_secretaria" value="<?= $_SESSION[secretaria][apellido] ?>"/>  
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: beige "><p class="parrafo" align="center"><b>SEDE: LITORAL.</b></p></td>
                    </tr>
                    <tr>

                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>COORDINADOR:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>   
                    <tr>
                        <td><input name="usbid_coor_lit" type="text" class="parrafo" id="usbid_coor_lit" value="<?= $_SESSION[coordinador_lit][usbid] ?>"/>
                        <td><input name="nombre_coor_lit" type="text" class="parrafo" id="nombre_coor_lit" value="<?= $_SESSION[coordinador_lit][nombre] ?>"/>
                        <td><input name="apellido_coor_lit" type="text" class="parrafo" id="apellido_coor_lit" value="<?= $_SESSION[coordinador_lit][apellido] ?>"/>                 
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>ASISTENTE:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>
                    <tr>
                        <td><input name="usbid_asistente_lit" type="text" class="parrafo" id="usbid_asistente_lit" value="<?= $_SESSION[asistente_lit][usbid] ?>"/>                  
                        <td><input name="nombre_asistente_lit" type="text" class="parrafo" id="nombre_asistente_lit" value="<?= $_SESSION[asistente_lit][nombre] ?>"/>
                        <td><input name="apellido_asistente_lit" type="text" class="parrafo" id="apelllido_asistente_lit" value="<?= $_SESSION[asistente_lit][apellido] ?>"/>        
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: gainsboro"><p class="parrafo"><b>SECRETARIA:</b></p></td>
                    </tr>
                    <tr>
                        <td><p align="center"><b>Usbid</b></p></td>
                        <td><p align="center"><b>Nombre</b></p></td>
                        <td><p align="center"><b>Apellido</b></p></td>
                    </tr>
                    <tr>
                        <td><input name="usbid_secretaria_lit" type="text" class="parrafo" id="usbid_secretaria_lit" value="<?= $_SESSION[secretaria_lit][usbid] ?>"/>
                        <td><input name="nombre_secretaria_lit" type="text" class="parrafo" id="nombre_secretaria_lit" value="<?= $_SESSION[secretaria_lit][nombre] ?>"/>
                        <td><input name="apellido_secretaria_lit" type="text" class="parrafo" id="apelllido_secretaria_lit" value="<?= $_SESSION[secretaria_lit][apellido] ?>"/>  
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" valign="top" class="parrafo">
                            <div align="center">
                                <a href='javascript: verificar()'><?= mostrarImagen('enviar'); ?></a>
                              <!--  <a href='cCrearPlanillaPermisoPasantia.php'><? //= mostrarImagen('pdf');              ?></a>-->
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>


<?php include_once('vFooter.php'); ?>