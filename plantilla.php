<?
require_once "cAutorizacion.php";
require_once "cFunciones.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema para el Servicio Comunitario - CCTDS</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
<td height="184" valign="bottom" style ="background-image:url(imagenes/top.jpg); background-repeat:no-repeat;">
 <div align="right"><span class="parrafo">
    <? mostrarDatosUsuario();?>
  </span></div></td>
  </tr>
  <tr>
    <td valign="top"><p>&nbsp;</p>    </td>
  </tr>
  <tr>
    <td valign="top"><? include_once "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
