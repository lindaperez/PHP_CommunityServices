<?php
//require "cAutorizacion.php";
session_start();
?>
<script>location.href="http://www.cctds.dex.usb.ve/Gsc/web?username=<?php echo $_SESSION[USBID];?>&tok=cctds*2012*tallerdedesarrollo&cod=<?php echo $_GET["cod"]; ?>&tipo=<?php echo $_SESSION[tipo];?>";</script>
