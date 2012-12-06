<?
require "cAutorizacion.php";
//echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

if (!isEmpleadoCCTDS()){
	unset ($_SESSION[USBID]);
	require "cAutorizacion.php";
}
$TITLE = "Evaluacion de Proyecto - Servicio Comunitario";

include_once("vHeader.php");
?>
<form id="datos" name="datos" method="post" action="cAgregarEvaluacion.php?tok=<?=$_SESSION[csrf]?>">
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="parrafo">
	<div align="center"><span class="titular_negro">PLANILLA DE EVALUACI&Oacute;N DE PROYECTO DE SERVICIO COMUNITARIO </span>	  </div>	</td>
  </tr>
	<? include "cEvaluarProyecto.php";?>
	<tr>
	<td valign="top" class="parrafo"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="26%"><strong class="textomenu">T&iacute;tulo del proyecto: </strong></td>
        <td width="74%"><? echo $_SESSION[proyecto][titulo];
		echo " <a href='vVerProyecto.php?id=".$_SESSION[proyecto][id]."'>".mostrarImagen('ver')." </a>"; ?>
          <input type="hidden" name="id_proy" value="<?=$_GET[id]?>"></td>
      </tr>
      <tr>
        <td class="textomenu">Proponente:</td>
        <td><? 
		echo $_SESSION[proyecto][nombre]." ";
		echo $_SESSION[proyecto][apellido]." - ";
		echo $_SESSION[proyecto][usbid]."@usb.ve";
		
		?></td>
      </tr>
      <tr>
        <td colspan="2"><strong class="textomenu">NOTAS:</strong>
          <div align="justify">
            <ol>
              <li> La planilla de evaluaci&oacute;n consta de 4 secciones, las tres primeras relativas al proyecto (calidad, coherencia y factibilidad; impacto en el estudiante y en la comunidad) y la cuarta secci&oacute;n se refiere a la replicabilidad. Cada secci&oacute;n tiene un n&uacute;mero de par&aacute;metros, que llamaremos renglones o &iacute;tems, para valoraci&oacute;n por parte del experto con un SI, un NO o un N/A. </li>
              <li> La evaluaci&oacute;n ser&aacute; considerada negativa si, en cualquiera de los renglones de las tres primeras secciones, el proyecto NO cumple con los par&aacute;metros expuestos (queda exceptuada la secci&oacute;n GENERAL que puede tener un NO como valoraci&oacute;n). </li>
              <li>Es posible que en algunos de los proyectos, el par&aacute;metro de valoraci&oacute;n No Aplique  (N/A). Por ejemplo, en una evaluaci&oacute;n diagn&oacute;stica en la que el grado de participaci&oacute;n de la comunidad sea m&iacute;nimo o nulo. El proyecto puede tener uno o m&aacute;s &iacute;tems con N/A y a&uacute;n ser evaluado positivamente.</li>
              <li>En cualquier caso, una evaluaci&oacute;n negativa (NO) o no aplica (N/A) debe ser justificada en las observaciones. </li>
              <li>En caso de ser aprobado con Modificaciones, favor incluir las modificaciones recomendadas. El proyecto en estas condiciones no ser&aacute; evaluado nuevamente y ser&aacute; el Coordinador de Formaci&oacute;n T&eacute;cnica y Desarrollo Social quien tome la decisi&oacute;n sobre la aprobaci&oacute;n del proyecto, una vez hechas las modificaciones sugeridas. </li>
            </ol>
          </div></td>
        </tr>
    </table></td>
	</tr>
	
	
	<tr>	
    <td valign="top" class="parrafo">
	<table width="100%" border="0" cellpadding="5">
      		
		<?
		$num_preguntas=0;
		$sql="SELECT * FROM pregunta";
		$resultado=ejecutarConsulta($sql, $conexion);
		$seccion_anterior="";
		$i=0;
		while($fila=obtenerResultados($resultado)){
			if ($fila[seccion]<>$seccion_anterior){
				$seccion_anterior=$fila[seccion];
				// $i=1;
				?>
				<tr>
				<td class="textomenu"><b><?=$fila[seccion]?></b></td>
				<td></td>
				</tr>
				<?
			}
		?>
		  <tr>
			<td><? echo "$i.- $fila[enunciado]"; ?></td>
			<td><select name="respuesta_<?php echo $i ?>" class="parrafo">
			<option value="si">SI</option>
			<option value="no">NO</option>
			<option value="NA">N/A</option>						
			</select>			</td>
		  </tr>
		<?
		$i++;
		$num_preguntas++;
		}//cierra el while
		?>
		<input name="max_preguntas" type="hidden" value="<?=$num_preguntas?>" />
	  </table>		</td>
	<tr>
	<td valign="top" class="parrafo">
	  <div align="center">
	    <table width="100%" border="0" cellpadding="5">
          <tr>
            <td width="26%"><strong class="textomenu">EVALUACI&Oacute;N FINAL:</strong></td>
            <td width="74%"><select name="final" class="parrafo">
              <option value="APROBADO">APROBADO</option>
              <option value="CON_MODIFICACIONES">APROBADO CON MODIFICACIONES</option>
              <option value="NO_APROBADO">NO APROBADO</option>
            </select></td>
          </tr>
          <tr>
            <td width="26%"><strong class="textomenu">Tipo de Proyecto:</strong></td>
            <td width="74%"><select name="tipo" class="parrafo">
		<option value="CONTINUO">CONTINUO</option>
		<option value="PUNTUAL">PUNTUAL</option>
		</select></td>
          </tr>
          <tr>
            <td><strong class="textomenu">Modificaciones sugeridas: </strong></td>
            <td><textarea name="modificaciones" cols="40" rows="4" class="parrafo"></textarea></td>
          </tr>
          <tr>
            <td><strong class="textomenu">Observaciones:</strong></td>
            <td><textarea name="observaciones" cols="40" rows="4" class="parrafo"></textarea></td>
          </tr>
          <tr>
            <td class="textomenu">&Aacute;rea del proyecto: </td>
            <td><? 	echo $_SESSION[proyecto][area]; ?></td>
          </tr>
          <tr>
            <td class="textomenu">C&oacute;digo asignado: </td>
            <td><label>
             <?	echo $_SESSION[proyecto][siglas]." - ";	?> 	
		<input name="codigo" type="text" class="parrafo" size="6" maxlength="4" value="<?=$_SESSION[proyecto][codigo_nuevo]?>" />
             	<input type="hidden" name="siglas" value="<?=$_SESSION[proyecto][siglas]?>"/>
            </label></td>
          </tr>
          <tr>
            <td><strong class="textomenu">Evaluador:</strong></td>
            <td><? 
//		echo "$_SESSION[nombre] $_SESSION[apellido] ";
		echo "CCTDS";
		 ?></td>
          </tr>
          <tr>
            <td><strong class="textomenu">Fecha:</strong></td>
            <td><?=date('d-m-Y')?></td>
          </tr>

          <tr>
            <td colspan="2" valign="top"><div align="center">
            
<a href='javascript: verificar()'><?=mostrarImagen('enviar');?></a>

            </div></td>
          </tr>
        </table>
      </div></td>
	</tr>	
</table>
</form>
<script type="text/javascript">
function verificar(){
	d=document.datos;
	var error=false;
	var aviso="";
	var texto="";

	if(d.final.value=="CON_MODIFICACIONES" && d.modificaciones.value==""){
		error=true;
		texto=texto+"- Si el Proyecto fue Aprobado con Modificaciones, debe especificar dichas modificaciones.<br/>";
	}
	if(d.final.value!="CON_MODIFICACIONES" && d.modificaciones.value!=""){
		error=true;
		texto=texto+"- Si el Proyecto no fue Aprobado con Modificaciones, no es necesario llenar el campo 'Modificaciones'.<br/>";
	}

	if(d.codigo.value==""){
		error=true;
		texto=texto+"- Debe especificar un codigo para el proyecto.<br/>";
	}
	if(isNaN(d.codigo.value)){
		error=true;
		texto=texto+"- El codigo debe contener solamente numeros.<br/>";
	}
	if(d.codigo.value.length<4){
		error=true;
		texto=texto+"- El codigo debe contener exactamente 4 numeros.<br/>";
	}

	if(!error){
     	d.submit();
	}else{
	   	aviso="<br/>Se detectaron los siguientes errores:<br/>"+texto;
		$.prompt(aviso,{show:'slideDown'});
	}
}
</script>
<?php  cerrarConexion($conexion); ?>

<?php include_once('vFooter.php'); ?>
