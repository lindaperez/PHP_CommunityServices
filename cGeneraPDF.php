<? 
include_once ('html2fpdf/html2fpdf.php');
session_start();
	$titulo = $_GET[titulo];
	$html = $_SESSION[html];
	
	$pdf = new HTML2FPDF(); 
	$pdf->AddPage();
	$pdf->WriteHTML($html);
	$pdf->Output("".$titulo."", 'D');
	
unset($_SESSION[html]);
?>