<?php
require_once "cAutorizacion.php";
include_once ('lib/class.ezpdf.php');

$modo_depuracion=false;

$id=$_GET[id]; //id inscripcion


$pdf =& new Cezpdf('letter');
$pdf->ezSetMargins(100,40,50,35);
$pdf->selectFont('pdf/fonts/Helvetica.afm');
$datacreator = array (
					'Title'=>'Constancia de Inscripcion',
					'Author'=>'CCTDS-DEX',
					'Subject'=>'Planilla de Constancia de Inscripcion del Servicio Comunitario',
					'Creator'=>'Universidad Simon Bolivar',
					'Producer'=>'http://www.usb.ve'
					);
$pdf->addInfo($datacreator);
$letra_parrafo=10;
$letra_peq=8;
$rellenar="_______________________";
$vacio="                                     ";
//para que se impriman bien los acentos y las � se debe hacer lo siguiente:
//en Quanta, ir a Tools / Encoding seleccionar: ISO-8859-15.
//No hace falta colocarlos en formato HTML, es decir, funcionan as�: ���... no as? &aacute; &eacute; &iacute;...


//imagen con el logo
$pdf->addJpegFromFile("imagenes/planilla/logo_dex.jpg",30,720,90);
//imagen con el pie de pagina
$pdf->addJpegFromFile("imagenes/planilla/pie_de_pagina.jpg",16,0,570);

//linea que demarca comienzo del proyecto
$pdf->setLineStyle(1);
$pdf->line(30,710,580,710);


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
"SELECT e.usbid_usuario AS est_carnet, c.nombre AS est_carrera,	u.nombre AS est_nombre, u.apellido AS est_apellido, 
        e.email_sec AS est_email, p.titulo AS proy_nombre, p.codigo AS proy_codigo, tutor.nombre AS tut_nombre, 
        tutor.apellido AS tut_apellido, tutor.ci AS tut_ci, t.dependencia AS dependencia, com.nombre AS com_nombre,
	tutor.usbid AS tut_email, i.fecha_inscip AS fecha_ins "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
		. " LEFT JOIN evaluacion eva ON (eva.id_proyecto = p.id) "
		. " LEFT JOIN area_proyecto a ON (a.id = p.id_area_proy) "
		. " LEFT JOIN usuario_estudiante e ON (i.usbid_estudiante = e.usbid_usuario) "
		. " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " LEFT JOIN carrera c ON (c.codigo = e.carrera) "
		. " LEFT JOIN comunidad com ON (com.id = p.id_comunidad) "
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
$email=asignar_valor("est_email", $fila, $vacio);

//DATOS DEL ESTUDIANTE: Se le hace trim y UTF-8
$carne=trim(utf8_decode($carne));
$cedula=trim(utf8_decode($cedula));
$carrera=trim(utf8_decode($carrera));
$nombre=trim(utf8_decode($nombre));
$apellido=trim(utf8_decode($apellido));
$email=trim(utf8_decode($email));
$nombre=$nombre." ".$apellido;//Se asigna el Apellido a la var nombre

//DATOS DEL PROYECTO
$periodo=asignar_valor("periodo", $fila, $vacio);
$proy_nombre=asignar_valor("proy_nombre", $fila, $vacio);
$codigo=asignar_valor("proy_codigo", $fila, $vacio);
$comunidad=asignar_valor("com_nombre", $fila, $vacio);
$objetivos1=asignar_valor("proy_objetivos", $fila, $vacio);
$objetivos2=asignar_valor("insc_objs", $fila, $vacio);

//DATOS DEL PROYECTO: Se le hace trim y UTF-8
$periodo=trim(utf8_decode($periodo));
$proy_nombre=trim(utf8_decode($proy_nombre));
$codigo=trim(utf8_decode($codigo));
$comunidad=trim(utf8_decode($comunidad));
$objetivos1=trim(utf8_decode($objetivos1));
$objetivos2=trim(utf8_decode($objetivos2));

//DATOS DEL TUTOR
$nombre_tut=asignar_valor("tut_nombre", $fila, $vacio);
$apellido_tut=asignar_valor("tut_apellido", $fila, $vacio);
$cedula_tut=asignar_valor("tut_ci", $fila, $vacio);
$dependencia=asignar_valor("dependencia", $fila, $vacio);
$email_tut=asignar_valor("tut_email", $fila, $vacio)."@usb.ve";
$nombre_tut= $nombre_tut. " " . $apellido_tut;

//DATOS DEL TUTOR: Se le hace trim y UTF-8
$nombre_tut=trim(utf8_decode($nombre_tut));
$cedula_tut=trim(utf8_decode($cedula_tut));
$dependencia=trim(utf8_decode($dependencia));
$email_tut=trim(utf8_decode($email_tut));

//FECHAS
$fecha_ins=asignar_valor("fecha_ins", $fila, $vacio);

//FECHAS: Se le hace trim y UTF-8
$fecha_ins=trim(utf8_decode($fecha_ins));


//CREACION DEL PDF
if (!$modo_depuracion){

	$options=array('justification' => 'center');
        $pdf->addText(30,714,8,utf8_decode("Coordinación de Cooperación Técnica y Desarrollo Social"));
        $pdf->ezText("\n", 6);
        $pdf->ezText("<b><c:uline>CONSTANCIA DE INICIO DE SERVICIO COMUNITARIO</c:uline></b>", 11,$options);
        $pdf->ezText("\n<b>NOMBRES Y APELLIDOS DEL ESTUDIANTE: </b>".$nombre, $letra_parrafo);
        $pdf->ezText("<b>   CARNET: </b>".$carne,$letra_parrafo);
        $pdf->ezText("<b>   CARRERA: </b>".$carrera,$letra_parrafo);
        $pdf->ezText("<b>   CORREO: </b>".$email,$letra_parrafo);
	
        $pdf->ezText("\n",$letra_parrafo);
        $pdf->ezText("<b>TITULO DEL PROYECTO DE SERVICIO COMUNITARIO:</b>",$letra_parrafo);
        $pdf->ezText("   <b>".$codigo.":</b> ".$proy_nombre,$letra_parrafo);
        
        $pdf->ezText("\n",$letra_parrafo);
        $pdf->ezText("<b>COMUNIDAD BENEFICIADA:</b>",$letra_parrafo);
        $pdf->ezText($comunidad,$letra_parrafo);
        
        $pdf->ezText("\n",$letra_parrafo);
        $pdf->ezText("<b>NOMBRE Y APELLIDO DEL TUTOR INSTITUCIONAL: </b>".$nombre_tut,$letra_parrafo);
        $pdf->ezText("   <b>CEDULA: </b>".$cedula_tut,$letra_parrafo);
        $pdf->ezText("   <b>DEPENDENCIA: </b>".$dependencia,$letra_parrafo);
        $pdf->ezText("   <b>CORREO: </b>".$email_tut,$letra_parrafo);
        
        $pdf->ezText("\n",$letra_parrafo);
        $pdf->ezText("<b>FECHA DE INSCRIPCION: </b>".cambiaf_a_normal(date($fecha_ins)),$letra_parrafo);
        $pdf->ezText("\n<b>FECHA PROPUESTA PARA LA FINALIZACION: </b>".(date("d/m/Y",strtotime ('+6 month', strtotime ($fecha_ins)))),$letra_parrafo);
        
        $pdf->ezText("\n\n",$letra_parrafo);
        $pdf->ezText($rellenar,$letra_parrafo,$options);
        $pdf->ezText(utf8_decode("<b>Validación de CCTDS</b>"),$letra_parrafo,$options);
        $pdf->ezText(utf8_decode("(Firma y Sello)"),$letra_parrafo,$options);
        
        $pdf->ezText("\n\n",$letra_parrafo);
        $pdf->ezText("<b>OBSERVACIONES:</b>",$letra_parrafo);
        $pdf->ezText("\n".$rellenar.$rellenar.$rellenar.$rellenar,$letra_parrafo);
        $pdf->ezText("\n".$rellenar.$rellenar.$rellenar.$rellenar,$letra_parrafo);
        $pdf->ezText("\n".$rellenar.$rellenar.$rellenar.$rellenar,$letra_parrafo);
}
$pdf->ezStream();

?>