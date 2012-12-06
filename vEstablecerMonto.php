<?
require "cAutorizacion.php";
if (!isAdmin()){
	echo "<center> Usted no esta autorizado para ver esta pagina</center>";
	exit();
}

$TITLE = 'Establece Monto Bono - SERVICIO COMUNITARIO';
include_once("vHeader.php");

?>
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="parrafo" align="center">
	<span class="titular_negro"><br />
	ESTABLECER MONTO PARA EL BONO DE TUTORES</span><br />
	<br />
	<?
	include "cEstablecerMonto.php";
	?> 
	<form action="cAgregarMonto.php?tok=<?=$_SESSION[csrf]?>" method="post" >
	<table width="100%" border="0" cellpadding="5" class="parrafo">
	<tr>
    		<td valign="top" class="parrafo" align="center"> Monto Actual (BsF):</td>
		<td valign="top" class="parrafo" align="center">
        <input type="text" name="monto" value="<?=$_SESSION[bono][monto]?>"></td>
	</tr>
	<tr>
    		<td valign="top" class="parrafo" align="center" colspan="2">
            <input value="Modificar" type="submit" ></td>
	</tr>
	</table>
	</form>
    </td>
  </tr>
</table>
<?php include_once('vFooter.php'); ?>