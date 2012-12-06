<?php
include('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
					'Title'=>'Ejemplo PDF',
					'Author'=>'unijimpe',
					'Subject'=>'PDF con Tablas',
					'Creator'=>'unijimpe@hotmail.com',
					'Producer'=>'http://blog.unijimpe.net'
					);
$pdf->addInfo($datacreator);

$data[] = array('num'=>1, 'mes'=>'Enero');
$data[] = array('num'=>2, 'mes'=>'Febrero');
$data[] = array('num'=>3, 'mes'=>'Marzo');
$data[] = array('num'=>4, 'mes'=>'Abril');
$data[] = array('num'=>5, 'mes'=>'Mayo');
$data[] = array('num'=>6, 'mes'=>'Junio');
$data[] = array('num'=>7, 'mes'=>'Julio');
$data[] = array('num'=>8, 'mes'=>'Agosto');
$data[] = array('num'=>9, 'mes'=>'Septiembre');
$data[] = array('num'=>10, 'mes'=>'Octubre');
$data[] = array('num'=>11, 'mes'=>'Noviembre');
$data[] = array('num'=>12, 'mes'=>'Diciembre');
//para que se impriman bien los acentos y las ï¿½ se debe hacer lo siguiente:
//en Quanta, ir a Tools / Encoding seleccionar: ISO-8859-15.
//No hace falta colocarlos en formato HTML, es decir, funcionan asï¿½: ï¿½ï¿½ï¿½... no asï¿½ &aacute; &eacute; &iacute;...
$titles = array('num'=>'<b>Número ñ</b>', 'mes'=>'<b>Mes</b>');
$pdf->addJpegFromFile("ros.jpg",0,500,346);


$pdf->ezText("<b>Meses en PHP</b>\n",16);
$pdf->ezText("Listado de Meses\n",12);
$pdf->ezTable($data,$titles,'',$options );
$pdf->ezText("\n\n\n",10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
$pdf->ezStream();
?>

