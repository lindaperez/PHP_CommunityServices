<?
include "cLimpiarComunidades.php";

$TITLE = 'Limpiar Comunidades - SERVICIO COMUNITARIO';
include_once("vHeader.php");
?>
        <script>
            
			function openprompt(id){
			
				var temp = {
					state0: {
						html:'Desea realmente eliminar la(s) comunidad(es)?',
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                                            $.prompt.close()
							else window.location="cEliminarComunidad.php?id="+id+"&tok=<?=$_SESSION[csrf]?>"
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
echo "COMUNIDADES REGISTRADAS";
?>
</span><br />
        <br /><br />
        <?

        if ($_SESSION[max_vacia]==0 and $_SESSION[max_comunidad]==0){
                echo "<br><br>Hasta el momento no hay comunidades registradas en el sistema.<br><br>";
        } else{
                ?>
                <table width="100%" border="0" cellpadding="5" class="parrafo">
                <?
                if ($_SESSION[max_vacia]>0) {
                        echo " <a href='javascript:openprompt(".'"all"'.")'>[Eliminar todas las comunidades que no tienen proyectos asociados]</a><br><br>";
                        ?>
                        <tr>
                                <td valign="top" colspan=2><B>Comunidades SIN proyectos asociados</td>
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
                        echo " <b>Nombre:</b> ".$_SESSION[vacia][nombre][$i];
                        echo " <br>N&uacute;mero de proyectos asociados: 0";
                        echo " <a href='javascript:openprompt(".$_SESSION[vacia][id][$i].")'>[Eliminar]</a>";
                  ?></td>
        </tr>

<?
        $j++;
        }//cierra el for
?>
                <tr>
                        <td valign="top" colspan=2><HR><B>Comunidades CON proyectos asociados<HR></td>
                </tr>

<?
        for ($i=0;$i<$_SESSION[max_comunidad];$i++){
?>

        <tr>
          <td valign="top"><? echo $j; ?></td>
          <td><?
                        echo "<b>Nombre:</b> ".$_SESSION[comunidad][nombre][$i];
                        $num=$_SESSION[comunidad][num][$i];
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
unset($_SESSION[comunidad]);
unset($_SESSION[vacia]);
unset($_SESSION[max_comunidad]);
unset($_SESSION[max_vacia]);

 ?>    </td>
  </tr>
</table>
<?php include_once('vFooter.php'); ?>
