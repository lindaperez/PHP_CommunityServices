<?php
require "cAutorizacion.php";
require_once("lib/excel.php");  
require_once("lib/excel-ext.php"); 

// DEBUG $_SESSION[data][] = array(100, 123, 132, 1, 3, 12, 312, 312, 3, 123, 123);
createExcel($_GET[nombre].".xls", $_SESSION[data]);
exit;
?>
<pre>
	<?php print_r($_SESSION[data]); ?>
</pre>