<?php
include('class.ezpdf.php');
$pdf = new Cezpdf();
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezText('Parece que funciona!!! pero no se que significa el 30, tiene problemas con los acentos, hay que colocarlos en formato html &aacute;? &eacute;&ntilde; el 30 es el tama&ntilde;o de la letra? <br> pues parece que no imprime los acentos por nada, voy a ver los demás ejemplos\nNo se le puede colocar un nombre al archivo?', 8);
$pdf->ezStream();
?>
