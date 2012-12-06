<?php
require "../cAutorizacion.php";
$modo_depuracion=TRUE;
$_GET[id]=$id; //id inscripción

include('class.ezpdf.php');
$pdf =& new Cezpdf('letter');
$pdf->selectFont('fonts/Helvetica.afm');
$datacreator = array (
					'Title'=>'Planilla de Inscripcion',
					'Author'=>'CCTDS-DEX',
					'Subject'=>'Planilla de Inscripcion Servicio Comunitario',
					'Creator'=>'Universidad Simon Bolivar',
					'Producer'=>'http://www.usb.ve'
					);
$pdf->addInfo($datacreator);
$letra_parrafo=10;
$letra_peq=8;
$vacio="                                     ";
//para que se impriman bien los acentos y las ñ se debe hacer lo siguiente:
//en Quanta, ir a Tools / Encoding seleccionar: ISO-8859-15.
//No hace falta colocarlos en formato HTML, es decir, funcionan así: áéí... no así: &aacute; &eacute; &iacute;...


//imagen con el logo
$pdf->addJpegFromFile("../imagenes/planilla/logo_dex.jpg",30,720,90);
//imagen con el pie de pagina
$pdf->addJpegFromFile("../imagenes/planilla/pie_de_pagina.jpg",16,0,570);

//rectangulo para la foto
$pdf->setLineStyle(4);
$pdf->rectangle(460,560,120,120);
//rectangulo para los datos del estudiante
$pdf->setLineStyle(1);
$pdf->rectangle(30,500,550,180);
//rectangulo para los datos del proyecto
$pdf->rectangle(30,70,550,420);



//DATOS DEL ESTUDIANTE
$sql=	"SELECT e.*, i.*, c.nombre carrera, u.nombre nombre_est, u.apellido apellido_est, u.ci ci".
	"FROM inscripcion i, usuario_estudiante e, carrera c, usuario u ".
	"WHERE i.id=$id and i.usbid_estudiante=e.usbid_usuario and e.carrera=c.codigo and e.usbid_usuario=u.usbid";
if ($modo_depuracion) echo "$sql_temp<br>";
else $resultado=ejecutarConsulta($sql_temp, $conexion);
$fila=obtenerResultados($resultado);

function asignar_valor($campo, $fila, $vacio){
	if ($fila[$campo]==""){
		return $vacio;
	}else{
		return $fila[$campo];
	}
};

$ci=asignar_valor("ci", $fila, $vacio);
echo "ci=$ci";
exit();

$carne=$fila[carnet];
$carrera=$fila[carrera];
$nombre="$fila[nombre_est] $fila[apellido_est]";
$cedula=$fila[ci];
$tlf_hab=$fila[telf_hab];
$tlf_cel=$fila[telf_cel];
$email=$fila[usbid];
$dir=$fila[direccion];
/* //datos de ejemplo
$carne="01-11111";
$carrera="Ingeniería de la Computación";
$nombre="Kenyer Dominguez";
$cedula="12345678";
$tlf_hab="0212-5555555";
$tlf_cel="04121231212";
$email="kdoming@usb.ve";
$dir=" Este es un texto de ejemplo relativamente largo para ver cómo se comporta el agregar texto, no se si colocar baja la linea automaticamente o hay que truncar el texto despues de tantos caracteres";
*/


//DATOS DEL PROYECTO
$periodo=$fila[periodo];
$periodo="Enero-Marzo 2009";
$proy_nombre="Este es otro posible nombre largo para un nombre de proyecto, creo que si todas las lineas dependen de ellas mismas va a haber problemas";
$codigo="AT-0708";
$comunidad="Este es el nombre de la comunidad, también puede tener un nombre relativamente largo y esto puede descuadrar la plantilla en algún momento";

//DATOS DEL REP
$representante="Lisset Vera";
$cedula_rep="12345678";
$tlf_ofic_rep="0212-5555555";
$email_rep="lvera@cnti.gob.ve";
$dir_rep=" Este es un texto de ejemplo relativamente largo para ver cómo se comporta el agregar texto, no se si colocar baja la linea automaticamente o hay que truncar el texto despues de tantos caracteres";
$tlf_cel_rep="04121231212";

//DATOS DEL TUTOR
$nombre_tut="Kenyer Dominguez";
$cedula_tut="12345678";
$dependencia="Departamento de Procesos y Sistemas";
$tlf_ofic_tut="0212-5555555";
$tlf_cel_tut="04121231212";
$email_tut="lvera@cnti.gob.ve";

//DATOS DE LA ORGANIZACION DE DESARROLLO SOCIAL
$dir_org="Aqui va la direccion de la organizacion, puede ser suficientemente larga, cuando no aplique se debe dejar el espacio en blanco";
$tlf_ofic_org="0212-5555555";
$fax="04121231212";
$email_org="direccion@algo.com";

//objetivos especificos
$objetivos="Estos son los objetivos especificos que se colocaron en la definición del proyecto. Estos son los objetivos especificos que se colocaron en la definición del proyecto. Estos son los objetivos especificos que se colocaron en la definición del proyecto. ";

//CREACION DEL PDF
$options=array('justification' => 'center');
$pdf->ezText("\n\n\n\n\n\n", 5);
$pdf->ezText("<b>PLANILLA DE INSCRIPCIÓN ESTUDIANTIL DEL PROYECTO DE SERVICIO COMUNITARIO</b>\n", 11,$options);
$pdf->ezText(" Período:     <c:uline>".$periodo."</c:uline>\n", $letra_parrafo);

$pdf->ezText(" <c:uline><b>DATOS DEL ESTUDIANTE:</b></c:uline>\n", $letra_parrafo);
$pdf->ezText(" <b>Carné</b>:  ".$carne."   <b>Carrera</b>: ".$carrera."\n", $letra_parrafo);
$pdf->ezText(" <b>Nombre y Apellido</b>:  ".$nombre."\n", $letra_parrafo);
$pdf->ezText(" <b>Cédula de Identidad</b>:  ".$cedula."\n", $letra_parrafo);
$pdf->ezText(" <b>Teléfonos hab.</b>:  ".$nombre."   <b>Cel</b>: ".$tlf_cel."\n", $letra_parrafo);
$pdf->ezText(" <b>Correo Electrónico</b>:  ".$email."\n", $letra_parrafo);
$pdf->ezText(" <b>Dirección</b>:  ".$dir."\n", $letra_parrafo);

$pdf->ezText("\n <c:uline><b>DATOS DEL PROYECTO:</b></c:uline>\n", $letra_parrafo);
$pdf->ezText(" <b>Código</b>:  ".$codigo." <b>Título:</b> ".$proy_nombre."\n", $letra_parrafo);
$pdf->ezText(" <b>Comunidad Beneficiaria</b>:  ".$comunidad."\n", $letra_parrafo);

$pdf->ezText("\n <c:uline><b>REPRESENTANTE DE LA COMUNIDAD:</b></c:uline>\n", $letra_parrafo);
$pdf->ezText(" <b>Nombre</b>:  ".$representante."   <b>Cédula de Identidad</b>: ".$cedula_rep."\n", $letra_parrafo);
$pdf->ezText(" <b>Direccion</b>:  ".$dir_rep."\n", $letra_parrafo);
$pdf->ezText(" <b>Tlf. Ofic.</b>:  ".$tlf_ofic_rep."   <b>Cel.</b>: ".$tlf_cel_rep."   <b>Correo Electrónico</b>: ".$email_rep."\n", $letra_parrafo);

$pdf->ezText("\n <c:uline><b>TUTOR(A) ACADÉMICO:</b></c:uline>\n", $letra_parrafo);
$pdf->ezText(" <b>Nombre</b>:  ".$nombre_tut."   <b>Cédula de Identidad</b>: ".$cedula_tut."\n", $letra_parrafo);
$pdf->ezText(" <b>Dependencia de la USB</b>:  ".$dependencia."\n", $letra_parrafo);
$pdf->ezText(" <b>Tlf. Ofic.</b>:  ".$tlf_ofic_tut."   <b>Cel.</b>: ".$tlf_cel_tut."   <b>Correo Electrónico</b>: ".$email_tut."\n", $letra_parrafo);

$pdf->ezText("\n <c:uline><b>Organización de Desarrollo Social que promueve el proyecto </b></c:uline>  ( en caso de que aplique)\n", $letra_parrafo);
$pdf->ezText(" <b>Dirección</b>:  ".$dir_org."\n", $letra_parrafo);
$pdf->ezText(" <b>Tlf. Ofic.</b>:  ".$tlf_ofic_org."   <b>FAX.</b>: ".$fax."   <b>Correo Electrónico</b>: ".$email_org."\n", $letra_parrafo);

//pagina 2 ----------------------
$pdf->ezNewPage();
//imagen con el logo
$pdf->addJpegFromFile("../imagenes/planilla/logo_dex.jpg",30,720,90);
//imagen con el pie de pagina
$pdf->addJpegFromFile("../imagenes/planilla/pie_de_pagina.jpg",16,0,570);
$pdf->ezText("\n\n\n\n\n\n\n", 5);


$pdf->ezText(" <c:uline><b>OBJETIVOS ESPECÍFICOS</b>:</c:uline>", $letra_parrafo);
$pdf->setColor(0.5,0.5,0.5);
$pdf->ezText(" Enumere sus objetivos específicos dentro del proyecto aprobado. Describa cual es su aporte personal dentro del mencionado proyecto. Si el proyecto involucra varias comunidades, especifique en cual comunidad trabajará Ud. \n", $letra_peq);
$pdf->setColor(0,0,0);
$pdf->ezText($objetivos."\n", $letra_parrafo);

$pdf->ezText(" <c:uline><b>PLAN DE APLICACION</b>:</c:uline>", $letra_parrafo);
$pdf->setColor(0.5,0.5,0.5);
$pdf->ezText(" Calendario detallado (por semana) indicando la fecha exacta de inicio y de fin, así como las semanas que efectivamente trabajará en el proyecto y las que no.  Llene la tabla modelo, use tantas líneas como sea necesario. \n", $letra_peq);
$pdf->setColor(0,0,0);

$titles = array('actividad'=>'<b>ACTIVIDAD</b>', 'semana'=>'<b>CRONOGRAMA (semana o fecha)</b>', 'horas'=>'<b>HORAS ACREDITABLES</b>');
$data[] = array('actividad'=>1, 'semana'=>'Enero', 'horas'=>'Enero');
$data[] = array('actividad'=>2, 'semana'=>'Febrero', 'horas'=>'Enero');
$data[] = array('actividad'=>3, 'semana'=>'Marzo', 'horas'=>'Enero');
$data[] = array('actividad'=>4, 'semana'=>'Abril', 'horas'=>'Enero');
$data[] = array('actividad'=>5, 'semana'=>'Mayo', 'horas'=>'Enero');
$data[] = array('actividad'=>6, 'semana'=>'Junio', 'horas'=>'Enero');
$data[] = array('actividad'=>7, 'semana'=>'Julio', 'horas'=>'Enero');
$data[] = array('actividad'=>8, 'semana'=>'Agosto', 'horas'=>'Enero');
$data[] = array('actividad'=>9, 'semana'=>'Septiembre', 'horas'=>'Enero');
$data[] = array('actividad'=>10, 'semana'=>'Octubre', 'horas'=>'Enero');
$data[] = array('actividad'=>11, 'semana'=>'Noviembre', 'horas'=>'Enero');
$data[] = array('actividad'=>12, 'semana'=>'Diciembre', 'horas'=>'Enero');

$pdf->ezTable($data,$titles,'',array('shaded'=>0,  'maxWidth' =>310) );

$pdf->ezText("\n\n\n\n\n\n\n", $letra_parrafo);
$pdf->ezText(" <c:uline>".$vacio."</c:uline>".$vacio." <c:uline>".$vacio."</c:uline>".$vacio." <c:uline>".$vacio."</c:uline>", $letra_parrafo);
$pdf->ezText("    Firma Estudiante".$vacio."          Firma del Tutor(a)".$vacio."         Firma CCTDS/PSC", $letra_parrafo);
$pdf->ezStream();
?>

