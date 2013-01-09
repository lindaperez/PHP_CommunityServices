<?php header('X-Content-Type-Options: nosniff'); 
header("X-Frame-Options: SAMEORIGIN");
header("Content-Type: text/html; charset=utf8");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
	<title><?php echo (isset($TITLE)?$TITLE:'SERVICIO COMUNITARIO'); ?></title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
        
	<script language="javascript" src="zapatec/utils/zapatec.js" type="text/javascript"></script>
	<script language="javascript" src="zapatec/utils/zpdate.js" type="text/javascript"></script>
	<script language="javascript" src="zapatec/zpcal/src/calendar.js" type="text/javascript"></script>
	<script language="javascript" src="zapatec/zpcal/lang/calendar-es.js" type="text/javascript"></script>

	<script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="scripts/jquery.tools.min.js"></script>
	<script language="javascript" type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
        
        <script type="text/javascript" language="javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
        
        <script src="scripts/jqueryui/ui/jquery.ui.core.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.widget.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.accordion.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.tabs.js"></script>
        <script src="scripts/jqueryui/ui/jquery.ui.progressbar.js"></script>
        <script src="scripts/jqueryui/ui/jquery.ui.datepicker.js"></script>
        <script src="scripts/jqueryui/ui/jquery.ui.dialog.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.draggable.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.position.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.resizable.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.explode.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.message.js"></script>
	<script src="scripts/jqueryui/ui/jquery.ui.autocomplete.js"></script>
	<script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
	<script src="scripts/jquery.alerts.js" type="text/javascript"></script> 
        <link href="scripts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            <?php $i = 1;?>
            $(document).ready(function() {
                <?php foreach($messages_error as $messg):
                        echo "$(\"#message$i\").message({type:'error'});"; 
                        $i++;
                    endforeach;?>
                <?php foreach($messages as $messg):
                        echo "$(\"#message$i\").message();"; 
                        $i++;
                    endforeach;?>
                <?php foreach($messages_fijo as $messg):
                        echo "$(\"#message$i\").message({dismiss: false});"; 
                        $i++;
                    endforeach;?>				
				<?php foreach($messages_alerta as $messg):
                        echo "$(\"#message$i\").message({type:'error', dismiss: false});"; 
                        $i++;
                    endforeach;?>
            });
        </script>
        <link rel="stylesheet" href="scripts/jqueryui/themes/redmond/jquery.ui.all.css">
        <link rel="stylesheet" href="scripts/jqueryui/demos.css">
        
</head>

<body>
<div class="layout">
	<table class="header" width="502" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><?php //echo $_SESSION[sede]?>
			<?php if($_SESSION[sede]=='Sartenejas'){ ?>
				<td height="184" valign="bottom" style ="background-image:url(imagenes/top.jpg); background-repeat:no-repeat;">
			<?php } elseif ($_SESSION[sede]=='Litoral') {?>
				<td height="234" valign="bottom" style ="background-image:url(imagenes/top_lit.png); background-repeat:no-repeat;">
			<?php } else {?>
				<td height="184" valign="bottom" style ="background-image:url(imagenes/top_ini.jpg); background-repeat:no-repeat;">
			<?php } ?>
				<div align="right">
					<span class="parrafo"><?php mostrarDatosUsuario();?></span>
				</div>
			</td>
		</tr>
	</table>
	<?php if ($_SESSION['db_error']!=""): ?>
		<div id="message_db_error"><?php echo $_SESSION['db_error'];?></div>
	<?php $_SESSION['db_error']=""; endif; ?>



	<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>


	<script type="text/javascript">
	tinyMCE.init({
	tinyMCE.init({
		mode : "exact",
		elements : "direccion_ind",
		theme : "simple"
		});
	</script>	

	<!-- END Header -->
