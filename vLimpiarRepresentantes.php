<?
include "cLimpiarRepresentantes.php";

$TITLE = 'Limpiar Representantes - SERVICIO COMUNITARIO';
include_once("vHeader.php");
?>
        <script>
            
			function openprompt(id){
			
				var temp = {
					state0: {
						html:'Desea realmente eliminar el(los) representante(s)?',
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                                            $.prompt.close()
							else window.location="cEliminarRepresentante.php?id="+id+"&tok=<?=$_SESSION[csrf]?>"
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
echo "REPRESENTANTES DE COMUNIDADES REGISTRADOS";
?>
</span><br />
        <br /><br />
        <?

        if ($_SESSION[max_vacio]==0 and $_SESSION[max_repre]==0){
                echo "<br><br>Hasta el momento no hay representantes comunidades registrados en el sistema.<br><br>";
        } else{
                ?>
                <table width="100%" border="0" cellpadding="5" class="parrafo">
                <?
                if ($_SESSION[max_vacio]>0) {
                        echo " <a href='javascript:openprompt(".'"all"'.")'>[Eliminar todos los representantes que no tienen proyectos asociados]</a><br><br>";
                        ?>
                        <tr>
                                <td valign="top" colspan=2><B>Representantes SIN proyectos asociados</td>
                        </tr>
                        <?
                }
        $j=1;
        for ($i=0;$i<$_SESSION[max_vacio];$i++){
?>
        <tr>
          <td valign="top"><? echo $j; ?></td>
          <td><?
//                      echo " <b>id</b>= ".$_SESSION[vacio][id][$i];
                        echo "<b>Nombre:</b> ".$_SESSION[vacio][nombre][$i]." ".$_SESSION[vacio][apellido][$i];
                        echo " <br>N&uacute;mero de proyectos asociados: 0";
                        echo " <a href='javascript:openprompt(".$_SESSION[vacio][id][$i].")'>[Eliminar]</a>";
                  ?></td>
        </tr>

<?
        $j++;
        }//cierra el for
?>
                <tr>
                        <td valign="top" colspan=2><HR><B>Representantes CON proyectos asociados<HR></td>
                </tr>

<?
        for ($i=0;$i<$_SESSION[max_repre];$i++){
?>

        <tr>
          <td valign="top"><? echo $j; ?></td>
          <td><?
//                      echo "<b>id=</b> ".$_SESSION[repre][id][$i];
                        echo "<b>Nombre:</b> ".$_SESSION[repre][nombre][$i]." ".$_SESSION[repre][apellido][$i];
                        $num=$_SESSION[repre][num][$i];
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
unset($_SESSION[repre]);
unset($_SESSION[vacio]);
unset($_SESSION[max_repre]);
unset($_SESSION[max_vacio]);

 ?>    </td>
  </tr>
</table>
<?php include_once('vFooter.php'); ?>
