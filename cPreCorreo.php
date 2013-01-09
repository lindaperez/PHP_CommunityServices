<?php 

extract($_POST);

$path='/home/coordpsc/frecuencia.txt';

$fp = fopen($path,'w');

$cont=$frecuencia.PHP_EOL."2 years ago".PHP_EOL.$email_to.PHP_EOL;

fwrite($fp, $cont);
fclose($fp);
?>
<script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('La solicitud ha sido procesada exitosamente.', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
        </script>	
    </body>
	

