<?
include "cLimpiarProponentes.php";

$TITLE = 'Limpiar Proponentes - SERVICIO COMUNITARIO';
include_once("vHeader.php");
?>
<script>
            
			function openprompt(id){
			
				var temp = {
					state0: {
						html:'Desea realmente eliminar el(los) proponente(s)?',
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                                            $.prompt.close()
							else window.location="cEliminarProponente.php?id="+id+"&tok=<?=$_SESSION[csrf]?>"
							return false; 
						}
					}
				}
				
				$.prompt(temp);
			}
        </script>	
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="parrafo" align="center">
        <span class="titular_negro"><br />
<?
echo "PROPONENTES REGISTRADOS";
?>
</span><br />
        <br /><br />
        <?

        if ($_SESSION[max_vacia]==0 and $_SESSION[max_proponente]==0){
                echo "<br><br>Hasta el momento no hay proponentes registradas en el sistema.<br><br>";
        } else{
                ?>
                <table width="100%" border="0" cellpadding="5" class="parrafo">
                <?
                if ($_SESSION[max_vacia]>0) {
                        echo " <a href='javascript:openprompt(".'"all"'.")'>[Eliminar todos los proponentes que no tienen proyectos asociados]</a><br><br>";
                        ?>
                        <tr>
                                <td valign="top" colspan=2><B>Proponentes SIN proyectos asociados</td>
                        </tr>
                        <?
                }
        $j=1;
        for ($i=0;$i<$_SESSION[max_vacia];$i++){
?>
        <tr>
          <td valign="top"><? echo $j; ?></td>
          <td><?
                 //     echo "<b>Id:</b> ".$_SESSION[vacia][id][$i];
                        echo " <b>Nombre:</b> ".$_SESSION[vacio][apellido][$i].", ".$_SESSION[vacio][nombre][$i];
                        echo " <br>N&uacute;mero de proyectos asociados: 0";
                        echo " <a href='javascript:openprompt(".$_SESSION[vacio][id_proyecto][$i].")'>[Eliminar]</a>";
                  ?></td>
        </tr>

<?
        $j++;
        }//cierra el for
?>
                <tr>
                        <td valign="top" colspan=2><HR><B>Proponentes CON proyectos asociados<HR></td>
                </tr>

<?
        for ($i=0;$i<$_SESSION[max_proponente];$i++){
?>

        <tr>
          <td valign="top"><? echo $j; ?></td>
          <td><?
                        echo "<b>Nombre:</b> ".$_SESSION[proponente][apellido][$i].", ".$_SESSION[proponente][nombre][$i];
                        $num=$_SESSION[proponente][num][$i];
                        echo "<br>N&uacute;mero de proyectos asociados: $num";
                        if ($num==0) echo " [Eliminar]";
                  ?></td>
        </tr>
<?
        $j++;
        }//cierra el for
?>

      </table>
 <?
  }//cierra el else
unset($_SESSION[proponente]);
unset($_SESSION[vacia]);
unset($_SESSION[max_proponente]);
unset($_SESSION[max_vacia]);

 ?>    </td>
  </tr>
</table>
<?php include_once('vFooter.php'); ?>
