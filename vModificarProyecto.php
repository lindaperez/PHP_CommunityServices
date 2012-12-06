<?
require "cAutorizacion.php";

if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

// Controlador de esta vista
require_once("cModificarProyecto.php");

$TITLE = 'Modificar un proyecto - Servicio Comunitario';
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

<h2 class="h2">Modificar proyecto</h2>
<h4 class="h4">
	<?php echo $PROYECTO['titulo']; ?>
	<br />
	<span class="info">(<span class="required">*</span>) campos obligatorios</span>
</h4>

<div class="box"></div>
<form action="" method="post" >
<table class="editar_proyecto">
	<tr>
		<td class="title" colspan="2">
			Detalles del proyecto
			<br />
		<span class="info">Incluye propuesta, antecedentes, justificación, objetivos, metodología, estrategia, viabilidad.</span>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Comunidad:</td>
		<td class="left">
			<select name="comunidad">
				<?php foreach($LISTA_COMUNIDAD as $value): ?>
				<option value="<?php echo $value['id'] ?>" <?php 
                                    if (isset($_POST['comunidad'])) 
                                        echo ($_POST['comunidad']==$value['id'])?'selected="selected"':''; 
                                    else if ($PROYECTO['id_comunidad']==$value['id']) 
                                        echo 'selected="selected"'.':'.''; ?> >
                                <?php 
                                    $max=45;
                                    if (strlen($value['nombre'])>$max)
                                        echo substr($value[nombre], 0, $max)."...";
                                    else
                                        echo $value['nombre'] ?> 
                                </option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Area del proyecto:
			<br />
			<span class="info">Educativa, técnica, deportiva, cultural, etc.</span>
		</td>
		<td class="left">
			<select name="area_proyecto">
				<?php foreach($LISTA_AREA_PROYECTO as $value): ?>
				<option value="<?php echo $value['id'] ?>" 
                                    <?php 
                                    if (isset($_POST['area_proyecto'])) 
                                        echo ($_POST['area_proyecto']==$value['id'])?'selected="selected"':''; 
                                    else if ($PROYECTO['area_id']==$value['id']) 
                                        echo 'selected="selected"'.':'.''; ?> >
                                <?php echo $value['nombre'] ?> (<?php echo $value['siglas'] ?>)
                                </option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Titulo:</td>
		<td class="left">
			<textarea name="title" id="title"><?php if (isset($_POST['title'])) echo break_line($_POST['title']); else echo break_line($PROYECTO['titulo']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Impacto Social:
			<br />
			<span class="info">Número de beneficiarios y descripción. Ejemplo: pacientes renales, adolescentes fuera de la educación formal.</span>
		</td>
		<td class="left">
			<textarea name="impacto_social" id="title"><?php if (isset($_POST['impacto_social'])) echo break_line($_POST['impacto_social']); else echo break_line($PROYECTO['impacto_social']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Cantidad de beneficiados:
			<br />
			<span class="info">Número de beneficiarios por edad, sexo y discapacidad.</span>
		</td>
		<td class="left">
                        <table width="100%" border="0" cellpadding="0">
                            <tr>
                                <td width="31%"><div align="right">
                                    Mujeres</div></td><td><input name="cant_fem" type="int" class="parrafo" id="cant_fem" size="6" maxlength="5" value="<?php if (isset($_POST['cant_fem'])) echo $_POST['cant_fem']; else echo $PROYECTO[sexo_fem]  ;?>" />
                                    </td>
                            </tr>
                            <tr>
                                <td width="31%"><div align="right">
                                    Hombres</div></td><td><input name="cant_masc" type="int" class="parrafo" id="cant_masc" size="6" maxlength="5" value="<?php if (isset($_POST['cant_masc'])) echo $_POST['cant_masc']; else echo $PROYECTO[sexo_masc]  ;?>" />
                                    </td>
                            </tr>
                            <tr>
                                <td width="31%"><div align="right">
                                    Discapacitados</div></td><td><input name="cant_disc" type="int" class="parrafo" id="cant_disc" size="6" maxlength="5" value="<?php if (isset($_POST['cant_disc'])) echo $_POST['cant_disc']; else echo $PROYECTO[discapacidad]  ;?>" />
                                    </td>
                            </tr>
                            <tr>
                                <td width="31%"><div align="right">
                                    Edades entre</div></td>
                                    <td>
                                        <select name="min_edad" class="parrafo">
                                            <option value="1">menos de 10 a&ntilde;os</option>
                                            <?php
                                            for ($i=10;$i<90;$i=$i+10){?>
                                                <option value="<?php echo $i ?>" 
                                                        <?php 
                                                            if (isset($_POST['min_edad'])) 
                                                                echo ($_POST['min_edad']==$i)?'selected="selected"':''; 
                                                            else if ($PROYECTO['edad_min']==$i) 
                                                                echo 'selected="selected"'.':'.''; ?> >
                                                <?php echo $i ?> a&ntilde;os
                                                </option>";
                                            <?php
                                            }
                                            ?>
                                        </select> - 
                                        <select name="max_edad" class="parrafo">
                                            <?php
                                            for ($i=10;$i<90;$i=$i+10){?>
                                                <option value="<?php echo $i ?>" 
                                                    <?php 
                                                        if (isset($_POST['max_edad'])) 
                                                            echo ($_POST['max_edad']==$i)?'selected="selected"':''; 
                                                        else if ($PROYECTO['edad_max']==$i) 
                                                            echo 'selected="selected"'.':'.''; ?> >
                                                <?php echo $i ?> a&ntilde;os
                                                </option>";
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
		<td class="right"><span class="required">*</span>Resumen del proyecto:</td>
		<td class="left">
			<textarea name="resumen" id="title"><?php if (isset($_POST['resumen'])) echo break_line($_POST['resumen']); else echo break_line($PROYECTO['resumen']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Area de trabajo:
			<br />
			<span class="info">Como se articula el proyecto con actividades de Docencia, Investigación y Extensión.</span>
		</td>
		<td class="left">
			<textarea name="area_de_trabajo" id="title"><?php if (isset($_POST['area_de_trabajo'])) echo break_line($_POST['area_de_trabajo']); else echo break_line($PROYECTO['area_de_trabajo']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Antecedentes:
			<br />
			<span class="info">Motivo por el cual esta realizando el proyecto</span>
		</td>
		<td class="left">
			<textarea name="antecedentes" id="title"><?php if (isset($_POST['antecedentes'])) echo break_line($_POST['antecedentes']); else echo break_line($PROYECTO['antecedentes']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Objetivo General:</td>
		<td class="left">
			<textarea name="obj_general" id="title"><?php if (isset($_POST['obj_general'])) echo break_line($_POST['obj_general']); else echo break_line($PROYECTO['obj_general']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Objetivos Espef&iacute;ficos:</td>
		<td class="left">
			<textarea name="obj_especificos" id="title"><?php if (isset($_POST['obj_especificos'])) echo break_line($_POST['obj_especificos']); else echo break_line($PROYECTO['obj_especificos']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Descripcion:</td>
		<td class="left">
			<textarea name="descripcion" id="title"><?php if (isset($_POST['descripcion'])) echo break_line($_POST['descripcion']); else echo break_line($PROYECTO['descripcion']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Actividades espec&iacute;ficas del estudiante:
			<br />
			<span class="info">Colocar ac&aacute; el trabajo espec&iacute;fico que realizar&aacute; el estudiante, horas que debe dedicar semanalmente</span>
		</td>
		<td class="left">
			<textarea name="actividades" id="title"><?php if (isset($_POST['actividades'])) echo break_line($_POST['actividades']); else echo break_line($PROYECTO['actividades']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Perfil Curricular:
			<br />
			<span class="info">Describa si es necesario que los estudiantes a trabajar en el proyecto tengan un perfil determinado</span>
		</td>
		<td class="left">
			<textarea name="perfil" id="title"><?php if (isset($_POST['perfil'])) echo break_line($_POST['perfil']); else echo break_line($PROYECTO['perfil']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Recursos requeridos y fuentes de financiamiento:
			<br />
			<span class="info">Describa  la factibilidad del proyecto en términos económicos</span>
		</td>
		<td class="left">
			<textarea name="recursos" id="title"><?php if (isset($_POST['recursos'])) echo break_line($_POST['recursos']); else echo break_line($PROYECTO['recursos']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Describa los logros sociales:
			<br />
			<span class="info">Describa los resultados y el beneficio a ser aportado a la comunidad y cuantas personas serán beneficiadas</span>
		</td>
		<td class="left">
			<textarea name="logros" id="title"><?php if (isset($_POST['logros'])) echo break_line($_POST['logros']); else echo break_line($PROYECTO['logros']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Describa c&oacute;mo se aplican las directrices y valores expuestos en la Ley:
			<br />
			<span class="info">Describa como el estudiante se vincula con la comunidad. &iquest;Se genera sensibilizaci&oacute;n en el estudiante?, &iquest;C&oacute;mo se logra aprendizaje de servicio?</span>
		</td>
		<td class="left">
			<textarea name="directrices" id="title"><?php if (isset($_POST['directrices'])) echo break_line($_POST['directrices']); else echo break_line($PROYECTO['directrices']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Magnitud del Proyecto:
			<br />
			<span class="info">En que medida se logra resolver el problema propuesto, ¿Se puede establecer continuidad del proyecto?</span>
		</td>
		<td class="left">
			<textarea name="magnitud" id="title"><?php if (isset($_POST['magnitud'])) echo break_line($_POST['magnitud']); else echo break_line($PROYECTO['magnitud']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			<span class="required">*</span>Participación de miembros de la comunidad:
			<br />
			<span class="info">Describa en que medida la comunidad es protagonista.</span>
		</td>
		<td class="left">
			<textarea name="participacion" id="title"><?php if (isset($_POST['participacion'])) echo break_line($_POST['participacion']); else echo break_line($PROYECTO['participacion']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>&iquest;Requiere formaci&oacute;n?:</td>
		<td class="left">
			<select name="formacion">
				<option value="SI" <?php 
                                    if (isset($_POST['formacion']))
                                        echo ($_POST['formacion']=='SI')?'selected="selected"':''; 
                                    else if ($PROYECTO['formacion']=='SI')  echo 'selected="selected"'.':'.''; ?> >
                                    Si
                                </option>
				<option value="NO" <?php 
                                    if (isset($_POST['formacion']))
                                        echo ($_POST['formacion']=='NO')?'selected="selected"':''; 
                                    else if ($PROYECTO['formacion']=='NO')  echo 'selected="selected"'.':'.''; ?> >
                                    No
                                </option>
			</select>
		</td>
	</tr>                         
	<tr>
		<td class="right">
			Especifique la formaci&oacute;n requerida:
			<br />
			<span class="info">Detalles de la formación específica que puede requerir para un proyecto. Por ejemplo: formación docente para atender adolescentes.</span>
			<br />
			<span class="info"><b>Nota</b>: Debe coordinar con su tutor de Servicio Comunitario la realización de los talleres descritos.</span>

		</td>
		<td class="left">
			<textarea name="formacion_desc" id="title"><?php if (isset($_POST['formacion_desc'])) echo break_line($_POST['formacion_desc']); else echo break_line($PROYECTO['formacion_desc']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="right">
			Nro.  de horas acreditables:
			<br />
			<span class="info">Horas que pueden reconocerse de la formación específica (max 24 horas)</span>
		</td>
		<td class="left">
			<select name="horas">
				<?php for($i=0; $i<25; $i++): ?>
				<option value="<?php echo $i ?>"
                                        <?php 
                                            if (isset($_POST['horas'])) 
                                                echo ($_POST['horas']==$i)?'selected="selected"':''; 
                                            else if ($PROYECTO['horas']==$i) 
                                                echo 'selected="selected"'.':'.''; ?> >
                                    <?php echo $i ?>
                                </option>
				<?php endfor; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="title" colspan="2">Proponente del proyecto</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>USBID:</td>
		<td class="left">
			<select name="proponente">
				<?php foreach($LISTA_USBID as $value): ?>
				<option value="<?php echo $value['usbid'] ?>" 
                                    <?php 
                                        if (isset($_POST['proponente']))
                                                echo ($_POST['proponente']==$value['usbid'])?'selected="selected"':'';
                                            else if ($PROYECTO['usbid_usuario']==$value['usbid']) 
                                                echo 'selected="selected"'.':'.''; ?> >
                                    <?php echo $value['apellido'] ?>, <?php echo $value['nombre'] ?> (<?php echo $value['usbid'] ?>)
                                </option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="title" colspan="2">Representante de la Comunidad</td>
	</tr>
	<tr>
		<td class="right"><span class="required">*</span>Representante:</td>
		<td class="left">
			<select name="representante">
				<option value=''>-- seleccione --</option>
                                <?php foreach($LISTA_REPRESENTANTE as $value): ?>
                                <option value="<?php echo $value['id'] ?>" 
                                    <?php 
                                    if (isset($_POST['representante'])) 
                                                echo ($_POST['representante']==$value['id'])?'selected="selected"':''; 
                                            else if ($PROYECTO['id_representante']==$value['id']) 
                                                echo 'selected="selected"'.':'.''; ?> >
                                    <?php echo $value['apellidos'] ?>,<?php echo $value['nombres'] ?>
                                </option>
				<?php endforeach; ?>
			</select><br>

		Si el nuevo representante no se encuentra en la lista anterior, <br>haga click <a href="vAgregarRepresentante.php">aqu&iacute;</a>
		</td>
	</tr>
	<tr>
		<td class="title" colspan="2">Tutores</td>
	</tr>
	<tr>
		<td class="right"></td>
		<td class="left">

				<? 
				$i=0;
				foreach($LISTA_TUTOR as $value): 
					$nombre_campo="tutor".$i;
					if ($i==0) echo "<span class='required'>*</span>";
					?>
					<select name="<?=$nombre_campo?>" class="parrafo" id="<?=$nombre_campo?>">
						<option value=''>-- seleccione --</option>
						<?
						$texto=armar_tutores($conexion,$value['usbid_miembro']);
						echo $texto;
					?>
					</select><br>
				<?
				$i++;
				endforeach; 
				//se agregan dos espacios para agregar tutores

					$nombre_campo="tutor".$i;
					?>
					<select name="<?=$nombre_campo?>" class="parrafo" id="<?=$nombre_campo?>">
						<option value=''>-- seleccione --</option>
						<?
						$texto=armar_tutores($conexion,"");
						echo $texto;
					?>
					</select><br>
				

					<?	
					$i++;
					$nombre_campo="tutor".$i;
					?>
					<select name="<?=$nombre_campo?>" class="parrafo" id="<?=$nombre_campo?>">
						<option value=''>-- seleccione --</option>
						<?
						$texto=armar_tutores($conexion,"");
						echo $texto;
					?>
					</select><br>

		Si el nuevo tutor no se encuentra en la(s) lista(s) anterior(es), <br>haga click <a href="vAgregarMiembroUSB.php">aqu&iacute;</a>
		</td>
	</tr>
	<tr>
		<td class="submit" colspan="2">
			<input type="hidden" name="modificar_proyecto" value="1" />
			<input type="hidden" name="id" value="<?php echo $id ?>" />
			<input type="hidden" name="old_proponente" value="<?php echo $PROYECTO['usbid_usuario'] ?>" />
			<input type="image" name="_modificar_" src="imagenes/iconos/apply2.jpg" />
			<br />
			Modificar el proyecto
		</td>
	</tr>
</table>
</form>

<?php include_once('vFooter.php'); ?>
