<?
include "cLimpiarInscripciones.php";

$TITLE = 'Limpiar Inscripciones - SERVICIO COMUNITARIO';
include_once("vHeader.php");
?>
        <script>
			function openprompt(){
			
				var temp = {
					state0: {
						html:'Desea realmente eliminar la(s) inscripcion(es)?',
						buttons: { Aceptar: true, Cancelar: false },
						submit:function(e,v,m,f){ 
							if(!v)
                                                            $.prompt.close()
							else window.location="cEliminarInscripciones.php?tok=<?=$_SESSION[csrf]?>"
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
echo "INSCRIPCIONES REGISTRADAS";
?>
</span><br />
        <br /><br />
        <?

        if ($_SESSION[max_vacia]==0 and $_SESSION[max_inscripciones]==0){
                echo "<br><br>Hasta el momento no hay inscripciones registradas en el sistema.<br><br>";
        } else{
                ?>
                <table width="100%" border="0" cellpadding="5" class="parrafo">
                <?
                if ($_SESSION[max_vacia]>0) {
                        echo " <a href='javascript:openprompt()'>[Eliminar todas las inscripciones que no tienen proyectos asociados]</a><br><br>";
                        ?>
                        <tr>
                                <td valign="top" colspan=2><B>Inscripciones SIN proyectos asociados</td>
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
                  ?></td>
        </tr>

<?
        $j++;
        }//cierra el for
?>
                <tr>
                        <td valign="top" colspan=2><HR><B>Total de inscripciones CON proyectos asociados: <?php echo $_SESSION[inscripciones][num][0];?><HR></td>
                </tr>

      </table>
 <?
  }//cierra el else
unset($_SESSION[inscripciones]);
unset($_SESSION[vacia]);
unset($_SESSION[max_inscripciones]);
unset($_SESSION[max_vacia]);

 ?>    </td>
  </tr>
</table>
<?php include_once('vFooter.php'); ?>
