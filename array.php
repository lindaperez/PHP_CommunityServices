<?php
require_once("lib/excel.php");  
require_once("lib/excel-ext.php"); 
echo "aqui";
$data = array(  
			array("Nombre"=>"Mattias", "IQ"=>250),  
			array("Nombre"=>"Tony", "IQ"=>100),  
			array("Nombre"=>"Peter", "IQ"=>100),  
			array("Nombre"=>"Edvard", "IQ"=>100)
		 );  
   
createExcel("excel-mysql.xls", $data);
exit;
?>