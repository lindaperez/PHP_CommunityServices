<?php
require_once "cAutorizacion.php";
include_once ('lib/class.ezpdf.php');

$modo_depuracion=false;

$id=$_GET[id]; //id inscripcion


$pdf =& new Cezpdf('letter');
$pdf->ezSetMargins(72,70,50,35);
$pdf->selectFont('pdf/fonts/Helvetica.afm');
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
//para que se impriman bien los acentos y las � se debe hacer lo siguiente:
//en Quanta, ir a Tools / Encoding seleccionar: ISO-8859-15.
//No hace falta colocarlos en formato HTML, es decir, funcionan as�: ���... no as? &aacute; &eacute; &iacute;...


//imagen con el logo
$pdf->addJpegFromFile("imagenes/planilla/logo_dex.jpg",30,720,90);
//imagen con el pie de pagina
$pdf->addJpegFromFile("imagenes/planilla/pie_de_pagina.jpg",16,0,570);

//rectangulo para la foto
$pdf->setLineStyle(4);
$pdf->rectangle(460,560,120,120);
//rectangulo para los datos del estudiante
$pdf->setLineStyle(1);
$pdf->rectangle(30,500,550,180);
//rectangulo para los datos del proyecto
$pdf->rectangle(30,70,550,420);


//Se consultan los datos de la inscripcion
//
//$sql= "
//SELECT 
//e.usbid_usuario AS est_carnet, 
//u.ci AS est_ci, 
//c.nombre AS est_carrera, 
//u.nombre AS est_nombre, 
//u.apellido AS est_apellido, 
//e.telf_hab AS est_telf_hab, 
//e.telf_cel AS est_telf_cel, 
//e.email_sec AS est_email, 
//e.direccion AS	est_dir, 
//i.periodo AS periodo, 
//p.titulo AS proy_nombre, 
//p.codigo AS proy_codigo, 
//com.nombre AS com_nombre, 
//p.obj_especificos AS proy_objetivos, 
//i.objetivos AS insc_objs, 
//r.nombres AS rep_nombre, 
//r.apellidos AS rep_apellido, 
//r.ci AS rep_ci, 
//r.telefono AS rep_tlf, 
//r.email AS rep_email, 
//r.direccion AS rep_dir, 
//r.celular AS rep_cel, 
//tutor.nombre AS tut_nombre, 
//tutor.apellido AS tut_apellido, 
//tutor.ci AS tut_ci, 
//t.dependencia AS dependencia, 
//t.telf AS tut_tlf_ofic, 
//t.celular AS tut_cel, 
//tutor.usbid AS tut_email, 
//o.nombre AS org_nombre, 
//o.direccion AS org_dir, 
//o.telefono AS org_tlf, 
//o.fax AS org_fax, 
//o.email AS org_email 
//	
//FROM 
//inscripcion i, 
//usuario_estudiante e, 
//carrera c, 
//usuario u, 
//proyecto p, 
//comunidad com, 
//representante r, 
//usuario_miembro_usb t, 
//usuario tutor, 
//organizacion o 
//	
//WHERE 
//i.id=$id 
//AND i.usbid_estudiante=e.usbid_usuario 
//AND e.carrera=c.codigo 
//AND e.usbid_usuario=u.usbid 
//AND i.id_proyecto=p.id 
//AND p.id_comunidad=com.id 
//AND p.id_representante=r.id 
//AND i.tutor=t.usbid_usuario 
//AND t.usbid_usuario=tutor.usbid 
//AND p.id_organizacion=o.id ;
//
//" ;

$sql =
"SELECT e.usbid_usuario AS est_carnet, u.ci AS est_ci, c.nombre AS est_carrera,
	u.nombre AS est_nombre, u.apellido AS est_apellido, e.telf_hab AS est_telf_hab,
	e.telf_cel AS est_telf_cel, e.email_sec AS est_email, e.direccion AS	est_dir,
	i.periodo AS periodo, i.anio AS anio, p.titulo AS proy_nombre, p.codigo AS proy_codigo,
	com.nombre AS com_nombre, p.obj_especificos AS proy_objetivos, i.objetivos AS insc_objs,
	r.nombres AS rep_nombre, r.apellidos AS rep_apellido, r.ci AS rep_ci, r.telefono AS rep_tlf,
	r.email AS rep_email, r.direccion AS rep_dir, r.celular AS rep_cel, tutor.nombre AS tut_nombre,
	tutor.apellido AS tut_apellido, tutor.ci AS tut_ci, t.dependencia AS dependencia,
	t.telf AS tut_tlf_ofic, t.celular AS tut_cel, tutor.usbid AS tut_email, o.nombre AS org_nombre,
	o.direccion AS org_dir, o.telefono AS org_tlf, o.fax AS org_fax, o.email AS org_email"
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_estudiante e ON (i.usbid_estudiante = e.usbid_usuario) "
		. " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " LEFT JOIN carrera c ON (c.codigo = e.carrera) "
		. " LEFT JOIN comunidad com ON (com.id = p.id_comunidad) "
		. " LEFT JOIN representante r ON (r.id = p.id_representante) "
		. " LEFT JOIN organizacion o ON (o.id = p.id_organizacion) "
		. " LEFT JOIN usuario_miembro_usb t ON (i.tutor = t.usbid_usuario) "
		. " LEFT JOIN usuario tutor ON (i.tutor = tutor.usbid) "
		. " WHERE i.id=$id  ";

if ($modo_depuracion){
	echo "$sql<br>"; exit(0);
} 
else {
	$resultado=ejecutarConsulta($sql, $conexion);
	$fila=obtenerResultados($resultado);
      
}

// DEBUG

/*
echo '<pre>';
print_r($fila);
echo '</pre>';
exit;
*/

function asignar_valor($campo, $fila, $vacio){
	if (!$fila[$campo]){
		return $vacio;
	}else{
		return $fila[$campo];
	}
};

//DATOS DEL ESTUDIANTE
$carne=asignar_valor("est_carnet", $fila, $vacio);
$cedula=asignar_valor("est_ci", $fila, $vacio);
$carrera=asignar_valor("est_carrera", $fila, $vacio);
$nombre=asignar_valor("est_nombre", $fila, $vacio);
$apellido=asignar_valor("est_apellido", $fila, $vacio);
$tlf_hab=asignar_valor("est_telf_hab", $fila, $vacio);
$tlf_cel=asignar_valor("est_telf_cel", $fila, $vacio);
$email=asignar_valor("est_email", $fila, $vacio);
$dir=asignar_valor("est_dir", $fila, $vacio);

//DATOS DEL ESTUDIANTE: Se le hace trim y UTF-8
$carne=trim(utf8_decode($carne));
$cedula=trim(utf8_decode($cedula));
$carrera=trim(utf8_decode($carrera));
$nombre=trim(utf8_decode($nombre));
$apellido=trim(utf8_decode($apellido));
$tlf_hab=trim(utf8_decode($tlf_hab));
$tlf_cel=trim(utf8_decode($tlf_cel));
$email=trim(utf8_decode($email));
$dir=trim(utf8_decode($dir));
$nombre=$nombre." ".$apellido;//Se asigna el Apellido a la var nombre

//DATOS DEL PROYECTO
$periodo=asignar_valor("periodo", $fila, $vacio);
$anio=asignar_valor("anio", $fila, $vacio);
$proy_nombre=asignar_valor("proy_nombre", $fila, $vacio);
$codigo=asignar_valor("proy_codigo", $fila, $vacio);
$comunidad=asignar_valor("com_nombre", $fila, $vacio);
$objetivos1=asignar_valor("proy_objetivos", $fila, $vacio);
$objetivos2=asignar_valor("insc_objs", $fila, $vacio);

//DATOS DEL PROYECTO: Se le hace trim y UTF-8
$periodo=trim(utf8_decode($periodo));
$anio=trim(utf8_decode($anio));
$proy_nombre=trim(utf8_decode($proy_nombre));
$codigo=trim(utf8_decode($codigo));
$comunidad=trim(utf8_decode($comunidad));
$objetivos1=trim(utf8_decode($objetivos1));
$objetivos2=trim(utf8_decode($objetivos2));

//DATOS DEL REPRESENTANTE
$representante=asignar_valor("rep_nombre", $fila, $vacio);
$representante_apellido=asignar_valor("rep_apellido", $fila, $vacio);
$cedula_rep=asignar_valor("rep_ci", $fila, $vacio);
$tlf_ofic_rep=asignar_valor("rep_tlf", $fila, $vacio);
$email_rep=asignar_valor("rep_email", $fila, $vacio);
$dir_rep=asignar_valor("rep_dir", $fila, $vacio);
$tlf_cel_rep=asignar_valor("rep_cel", $fila, $vacio);
$representante=$representante." ".$representante_apellido;

//DATOS DEL REPRESENTANTE: Se le hace trim y UTF-8
$representante=trim(utf8_decode($representante));
$cedula_rep=trim(utf8_decode($cedula_rep));
$tlf_ofic_rep=trim(utf8_decode($tel_ofic_rep));
$email_rep=trim(utf8_decode($email_rep));
$dir_rep=trim(utf8_decode($dir_rep));
$tlf_cel_rep=trim(utf8_decode($tlf_cel_rep));

//DATOS DEL TUTOR
$nombre_tut=asignar_valor("tut_nombre", $fila, $vacio);
$apellido_tut=asignar_valor("tut_apellido", $fila, $vacio);
$cedula_tut=asignar_valor("tut_ci", $fila, $vacio);
$dependencia=asignar_valor("dependencia", $fila, $vacio);
$tlf_ofic_tut=asignar_valor("tut_tlf_ofic", $fila, $vacio);
$tlf_cel_tut=asignar_valor("tut_cel", $fila, $vacio);
$email_tut=asignar_valor("tut_email", $fila, $vacio)."@usb.ve";
$nombre_tut= $nombre_tut. " " . $apellido_tut;

//DATOS DEL TUTOR: Se le hace trim y UTF-8
$nombre_tut=trim(utf8_decode($nombre_tut));
$cedula_tut=trim(utf8_decode($cedula_tut));
$dependencia=trim(utf8_decode($dependencia));
$tlf_ofic_tut=trim(utf8_decode($tlf_ofic_tut));
$tlf_cel_tut=trim(utf8_decode($tlf_cel_tut));
$email_tut=trim(utf8_decode($email_tut));

//DATOS DE LA ORGANIZACION DE DESARROLLO SOCIAL
$nombre_org=asignar_valor("org_nombre", $fila, $vacio);
$dir_org=asignar_valor("org_dir", $fila, $vacio);
$tlf_ofic_org=asignar_valor("org_tlf", $fila, $vacio);
$fax=asignar_valor("org_fax", $fila, $vacio);
$email_org=asignar_valor("org_email", $fila, $vacio);

//DATOS DE LA ORGANIZACION: Se le hace trim y UTF-8
$nombre_org=trim(utf8_decode($nombre_org));
$dir_org=trim(utf8_decode($dir_org));
$tlf_ofic_org=trim(utf8_decode($tlf_ofic_org));
$fax=trim(utf8_decode($fax));
$email_org=trim(utf8_decode($email_org));

//CREACION DEL PDF
if (!$modo_depuracion){

	$options=array('justification' => 'center');
	$pdf->ezText("<b>PLANILLA DE INSCRIPCION ESTUDIANTIL DEL PROYECTO DE SERVICIO COMUNITARIO</b>\n", 11,$options);
	$pdf->ezText(" Periodo:     <c:uline>".$periodo." ".$anio."</c:uline>\n", $letra_parrafo);
	
	$pdf->ezText(" <c:uline><b>DATOS DEL ESTUDIANTE:</b></c:uline>\n", $letra_parrafo);
	$pdf->ezText(" <b>Carnet</b>:  ".$carne."   <b>Carrera</b>: ".$carrera."\n", $letra_parrafo);
	$pdf->ezText(" <b>Nombres y Apellidos</b>:  ".$nombre."\n", $letra_parrafo);
	$pdf->ezText(" <b>Cedula de Identidad</b>:  ".$cedula."\n", $letra_parrafo);
	$pdf->ezText(" <b>Tlf. Hab.</b>:  ".$tlf_hab."   <b>Cel</b>: ".$tlf_cel."\n", $letra_parrafo);
	$pdf->ezText(" <b>Correo Electronico</b>:  ".$email."\n", $letra_parrafo);
	$pdf->ezText(" <b>Direccion</b>:  ".$dir."\n", $letra_parrafo);
	
	$pdf->ezText("\n\n <c:uline><b>DATOS DEL PROYECTO:</b></c:uline>\n", $letra_parrafo);
	$pdf->ezText(" <b>Codigo</b>:  ".$codigo." <b>Titulo:</b> ".$proy_nombre."\n", $letra_parrafo);
	$pdf->ezText(" <b>Comunidad Beneficiaria</b>:  ".$comunidad."\n", $letra_parrafo);
	
	$pdf->ezText("\n <c:uline><b>REPRESENTANTE DE LA COMUNIDAD:</b></c:uline>\n", $letra_parrafo);
	$pdf->ezText(" <b>Nombre</b>:  ".$representante."   <b>Cedula de Identidad</b>: ".$cedula_rep."\n", $letra_parrafo);
	$pdf->ezText(" <b>Direccion</b>:  ".$dir_rep."\n", $letra_parrafo);
	$pdf->ezText(" <b>Tlf. Ofc.</b>:  ".$tlf_ofic_rep."   <b>Cel.</b>: ".$tlf_cel_rep."   <b>Correo Electronico</b>: ".$email_rep."\n", $letra_parrafo);
	
	$pdf->ezText("\n <c:uline><b>TUTOR ACADEMICO:</b></c:uline>\n", $letra_parrafo);
	$pdf->ezText(" <b>Nombre</b>:  ".$nombre_tut."   <b>Cedula de Identidad</b>: ".$cedula_tut."\n", $letra_parrafo);
	$pdf->ezText(" <b>Dependencia de la USB</b>:  ".$dependencia."\n", $letra_parrafo);
	$pdf->ezText(" <b>Tlf. Ofic.</b>:  ".$tlf_ofic_tut."   <b>Cel.</b>: ".$tlf_cel_tut."   <b>Correo Electronico</b>: ".$email_tut."\n", $letra_parrafo);
	
	$pdf->ezText("\n <c:uline><b>ORGANIZACION DE DESARROLLO SOCIAL QUE PROMUEVE EL PROYECTO</b></c:uline> (en caso de que aplique)\n", $letra_parrafo);
	$pdf->ezText(" <b>Nombre</b>:  ".$nombre_org."\n", $letra_parrafo);
	$pdf->ezText(" <b>Direccion</b>:  ".$dir_org."\n", $letra_parrafo);
	$pdf->ezText(" <b>Tlf. Ofic.</b>:  ".$tlf_ofic_org."   <b>FAX.</b>: ".$fax."   <b>Correo Electronico</b>: ".$email_org."\n", $letra_parrafo);
	
	//------------- PAGINA 2 ----------------------
	    
        $pdf->ezNewPage();
	//imagen con el logo
	$pdf->addJpegFromFile("imagenes/planilla/logo_dex.jpg",30,720,90);
	//imagen con el pie de pagina
	$pdf->addJpegFromFile("imagenes/planilla/pie_de_pagina.jpg",16,0,570);
	
	
	$pdf->ezText(" <c:uline><b>OBJETIVOS ESPECIFICOS</b>:</c:uline>", $letra_parrafo);
	$pdf->setColor(0.5,0.5,0.5);
	$pdf->ezText(" Enumere sus objetivos especificos dentro del proyecto aprobado. Describa cual es su aporte personal dentro del mencionado proyecto. Si el proyecto involucra varias comunidades, especifique en cual comunidad trabajara Ud. \n", $letra_peq);
	$pdf->setColor(0,0,0);
	$pdf->ezText($objetivos1."\n".$objetivos2."\n", $letra_parrafo);
	
	$pdf->ezText(" <c:uline><b>PLAN DE APLICACION</b>:</c:uline>", $letra_parrafo);
	$pdf->setColor(0.5,0.5,0.5);
	$pdf->ezText(" Calendario detallado (por semana) indicando la fecha exacta de inicio y de fin, asi como las semanas que efectivamente trabajara en el proyecto y las que no.  Llene la tabla modelo, use tantas lineas como sea necesario. \n", $letra_peq);
	$pdf->setColor(0,0,0);
}
//se consultan las actividades registradas para la inscripcion
$sql="SELECT * FROM plan_inscripcion WHERE id_inscripcion=$id";
if ($modo_depuracion){
	echo "$sql<br>"; 
} 
else $resultado=ejecutarConsulta($sql, $conexion);

$titles = array('actividad'=>'<b>ACTIVIDAD</b>', 'cronograma'=>'<b>CRONOGRAMA (semana o fecha)</b>', 'horas'=>'<b>HORAS ACREDITABLES</b>');
$cols=array(	'actividad'=>array('justification'=>'center','width'=>250,'link'=>''),
		'cronograma'=>array('justification'=>'center','width'=>100,'link'=>''),
		'horas'=>array('justification'=>'center','width'=>100,'link'=>''));
$data=array();
$num_actividades=0;

while($fila=obtenerResultados($resultado)){
	$actividad=trim(utf8_decode($fila['actividad'])); 
	$cronograma=trim(utf8_decode($fila['cronograma'])); 
	$horas=trim($fila['horas']); 
	$data[] = array('actividad'=>$actividad, 'cronograma'=>$cronograma, 'horas'=>$horas);
        $num_actividades++;
}

/*
 // datos de ejemplo
$data[] = array('actividad'=>1, 'cronograma'=>'Enero', 'horas'=>'Enero');
$data[] = array('actividad'=>2, 'cronograma'=>'Febrero', 'horas'=>'Enero');
$data[] = array('actividad'=>3, 'cronograma'=>'Marzo', 'horas'=>'Enero');
$data[] = array('actividad'=>4, 'cronograma'=>'Abril', 'horas'=>'Enero');
$data[] = array('actividad'=>5, 'cronograma'=>'Mayo', 'horas'=>'Enero');
$data[] = array('actividad'=>6, 'cronograma'=>'Junio', 'horas'=>'Enero');
$data[] = array('actividad'=>7, 'cronograma'=>'Julio', 'horas'=>'Enero');
$data[] = array('actividad'=>8, 'cronograma'=>'Agosto', 'horas'=>'Enero');
$data[] = array('actividad'=>9, 'cronograma'=>'Septiembre', 'horas'=>'Enero');
$data[] = array('actividad'=>10, 'cronograma'=>'Octubre', 'horas'=>'Enero');
$data[] = array('actividad'=>11, 'cronograma'=>'Noviembre', 'horas'=>'Enero');
$data[] = array('actividad'=>12, 'cronograma'=>'Diciembre', 'horas'=>'Enero');

*/

$pdf->ezTable($data,$titles,'',array('shaded'=>0,  'maxWidth' =>450, 'cols'=>$cols) );

  if ($num_actividades > 24) {
	//imagen con el logo
	$pdf->addJpegFromFile("imagenes/planilla/logo_dex.jpg",30,720,90);
	//imagen con el pie de pagina
	$pdf->addJpegFromFile("imagenes/planilla/pie_de_pagina.jpg",16,0,570);
  }

$pdf->ezText("\n\n\n\n\n\n\n", $letra_parrafo);
$pdf->ezText(" <c:uline>".$vacio."</c:uline>"."                       ".
             "     <c:uline>     ".$vacio."       </c:uline>             ".
	     "          <c:uline>     ".$vacio." </c:uline>", $letra_parrafo);
$pdf->ezText("   Firma Estudiante".$vacio."Firma y Sello Tutor Academico                     ".
           "Firma y Sello CCTDS/PSC", $letra_parrafo);
$pdf->ezStream();
