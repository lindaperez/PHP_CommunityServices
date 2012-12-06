<?
session_start();
if (!isset($_SESSION['USBID'])){
?>
<script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
<link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
<body>
    <script>
    $.prompt('Debe iniciar sesion para ver esta pagina.', 
    { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="index.php" }  })
    </script>	
</body>
<?
cerrarConexion($conexion);
}else  require_once "cConstantes.php";
?>
