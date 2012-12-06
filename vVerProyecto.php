<?
//require "cAutorizacion.php";
include "cVerProyecto.php";

$TITLE = 'Ver Proyecto';
include_once("vHeader.php");
?>

<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td colspan="3"><p align="center" class="titular_negro"><strong>DESCRIPCI&Oacute;N DEL </strong><strong>PROYECTO DE SERVICIO COMUNITARIO</strong><br />
          </p></td>
        </tr>
      <tr>
        <td colspan="3" nowrap="nowrap" class="parrafo"><div align="left">Fecha de Ingreso:          <b>
          <?=$_SESSION[proyecto][fecha_ingreso]?>
        </b></div></td>
        </tr>
      <tr>
        <td valign="top" nowrap="nowrap" class="parrafo"><div align="right"><strong>T&Iacute;TULO  DEL PROYECTO </strong></div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][titulo]?>        </td>
      </tr>
      <tr>
        <td valign="top" nowrap="nowrap" class="parrafo"><div align="right"><strong>C&Oacute;DIGO: </strong></div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][codigo]?>        </td>
      </tr>
      <tr>
        <td colspan="3"><p class="parrafo"><strong>PROPONENTE DEL PROYECTO</strong></p></td>
        </tr>
      <tr>
        <td colspan="3" valign="top" class="parrafo">
			  <table width="100%" border="0" cellpadding="0">
				<tr>
				  <td width="31%" valign="top"><div align="right">Nombre:</div></td>
				  <td width="69%"><?=$_SESSION[proponente][nombre]?></td>
				</tr>
				<tr>
				  <td valign="top"><div align="right">Apellido:</div></td>
				  <td><?=$_SESSION[proponente][apellido]?></td>
				</tr>
				<tr>
				  <td valign="top"><div align="right">Email:</div></td>
				  <td><?=$_SESSION[proponente][usbid]?>@usb.ve</td>
				</tr>
		    </table>          </td>
        </tr>
      <tr>
        <td colspan="3" class="parrafo"><strong>COMUNIDAD BENEFICIARIA</strong></td>
        </tr>
      <tr>
        <td width="29%" valign="top" class="parrafo"><div align="right">nombre:</div></td>
        <td width="71%" colspan="2" class="parrafo"><?=$_SESSION[comunidad][nombre]?></td>
      </tr>
	  <!--
      <tr>
        <td valign="top" class="parrafo"><div align="right">ubicaci&oacute;n:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[comunidad][ubicacion]?></td>
      </tr>
   -->
      <tr>
        <td valign="top" class="parrafo"><div align="right">descripci&oacute;n:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[comunidad][descripcion]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo">&nbsp;</td>
        <td colspan="2" class="parrafo">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>&Aacute;REA DEL PROYECTO</strong>
            <br />
        </div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[area][nombre]?></td>
      </tr>
      <tr>
        <td border="1" valign="top" class="parrafo"><div align="right"><strong>CANTIDAD DE BENEFICIADOS</strong>
            <br />
        </div></td>
        <td colspan="2" class="parrafo">
            <table width="100%" border="0" cellpadding="0">
                <tr>
                    <td width="31%" valign="top"><div align="right">
                        Mujeres</div></td><td width="69%"><?=$_SESSION[beneficiados][sexo_fem]?>
                    </td>
                </tr>
                <tr>
                    <td width="31%" valign="top"><div align="right">
                        Hombres</div></td><td width="69%"><?=$_SESSION[beneficiados][sexo_masc]?>
                    </td>
                </tr>
                <tr>
                    <td width="31%" valign="top"><div align="right">
                        Discapacitados</div></td><td width="69%"><?=$_SESSION[beneficiados][discapacidad]?>
                    </td>
                </tr>
                <tr>
                    <td width="31%" valign="top"><div align="right">
                        Edades entre</div></td><td width="69%"><?=$_SESSION[beneficiados][edad_min]?>-<?=$_SESSION[beneficiados][edad_max]; echo " años";?>
                    </td>
                </tr>
            </table>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>IMPACTO SOCIAL</strong><br />
        </div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][impacto_social]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>RESUMEN  DEL PROYECTO</strong></div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][resumen]?></td>
      </tr>
      <tr>
        <td colspan="3" valign="top" class="parrafo">
          <div align="left"><strong>TUTORES DE SERVICIO COMUNITARIO</strong> 
              <br />
          </div></td>
        </tr>
      <tr>
        <td colspan="3" valign="top" class="parrafo"><div align="right">
          <?
		  for ($i=0;$i<$_SESSION[maxtutor];$i++){
		  	?>
			  <table width="100%" border="0" cellpadding="0">
				<tr>
				  <td width="31%"><div align="right">Nombre:</div></td>
				  <td width="69%"><?=$_SESSION[tutor][$i][nombre]?></td>
				</tr>
				<tr>
				  <td><div align="right">Apellido:</div></td>
				  <td><?=$_SESSION[tutor][$i][apellido]?></td>
				</tr>
				<tr>
				  <td><div align="right">Email:</div></td>
				  <td><?=$_SESSION[tutor][$i][usbid]?>@usb.ve</td>
				</tr>
			  </table>	
			  <br>		
			<?
		  }
		  ?>

        </div></td>
        </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>&Aacute;REA DE TRABAJO</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][area_de_trabajo]?></td>
      </tr>
      <tr>
        <td colspan="3" valign="top" class="parrafo"><p><strong>REPRESENTANTE DE LA   COMUNIDAD</strong></p></td>
        </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right">Apellidos:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][apellidos]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right">Nombres:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][nombres]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right">Instituci&oacute;n:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][institucion]?></td>
      </tr>
	  <!--
      <tr>
        <td valign="top" class="parrafo"><div align="right">Direcci&oacute;n:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][direccion]?></td>
      </tr>
	  -->
      <tr>
        <td valign="top" class="parrafo"><div align="right">Cargo:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][cargo]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right">Correo Electr&oacute;nico: </div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][email]?></td>
      </tr>
	  <!--
      <tr>
        <td valign="top" class="parrafo"><div align="right">Tel&eacute;fono:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[representante][telefono]?></td>
      </tr>
   -->
      <tr>
        <td colspan="3" valign="top" class="parrafo"><p align="left"><strong>ORGANIZACI&Oacute;N DE  DESARROLLO SOCIAL QUE PROMUEVE EL PROYECTO 
        </strong> </p></td>
        </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right">Nombre:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[organizacion][nombre]?></td>
      </tr>
	  <!--
      <tr>
        <td valign="top" class="parrafo"><div align="right">Direcci&oacute;n:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[organizacion][direccion]?></td>
      </tr>
   -->
      <tr>
        <td valign="top" class="parrafo"><div align="right">Correo Electr&oacute;nico: </div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[organizacion][email]?></td>
      </tr>
	  <!--
      <tr>
        <td valign="top" class="parrafo"><div align="right">Tel&eacute;fono:</div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[organizacion][telefono]?></td>
      </tr>
   -->
      <tr>
        <td colspan="3" valign="top" class="parrafo"><p><strong>DESCRIPCI&Oacute;N DEL PROYECTO</strong></p>          </td>
        </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Antecedentes</strong><br />
        </p></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][antecedentes]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>Objetivo general</strong></div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][obj_general]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Objetivos espec&iacute;ficos</strong> <strong></strong></p></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][obj_especificos]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Descripci&oacute;n  del Proyecto General</strong></p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][descripcion]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Actividades espec&iacute;ficas del estudiante</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][actividades]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Perfil curricular</strong><br />
        </p></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][perfil]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Recursos requeridos y fuentes de financiamiento<br />
        </strong></p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][recursos]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Logros sociales</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][logros]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>C&oacute;mo  se aplican las directrices y valores expuestos en la ley</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][directrices]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Magnitud  del Proyecto</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][magnitud]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>Participaci&oacute;n  de miembros de la comunidad</strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][participacion]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>PLAN DE APLICACI&Oacute;N </strong><br />
        </p>          </td>
        <td colspan="2" class="parrafo">
<?
	$nombre_archivo = "/var/www/SC/upload/plan_aplicacion/".$_SESSION['proyecto']['codigo'].".pdf";
        $nombre_archivo2 = "/var/www/SC/upload/plan_aplicacion/".$_GET['id'].".pdf";

	if (file_exists($nombre_archivo)) { ?>
		<a href='upload/plan_aplicacion/<?=$_SESSION['proyecto']['codigo']?>.pdf' >Ver documento PDF</a>
	<?php
	} else {
            
            if (file_exists($nombre_archivo2)){ ?>
                <a href='upload/plan_aplicacion/<?php echo $_GET['id'] ;?>.pdf' >Ver documento PDF</a>
            <?php
            } else{
                echo "El PDF no ha sido cargado";
            }
	}
?>
        </td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>&iquest;REQUERE FORMACI&Oacute;N ESPEC&Iacute;FICA? </strong></div></td>
        <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][formacion]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><div align="right"><strong>ESPECIFIQUE LA FORMACI&Oacute;N REQUERIDA</strong> <span class="buscador"><br />
        </span></div></td>
        <td colspan="2" valign="top" class="parrafo"><?=$_SESSION[proyecto][formacion_desc]?></td>
      </tr>
      <tr>
        <td valign="top" class="parrafo"><p align="right"><strong>No. DE HORAS ACREDITABLES</strong><br />
        </p>          </td>
        <td colspan="2" valign="middle" class="parrafo">
          <?=$_SESSION[proyecto][horas]?>        </td>
      </tr>
      <tr>
        <td colspan="3" valign="top" class="parrafo"><div align="center"></div></td>
        </tr>
    </table>    </td></tr>
</table>

<?php include_once('vFooter.php'); ?>
