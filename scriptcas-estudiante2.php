<?php
	session_start();

// ********** Script para Autenticar con el CAS y validar usuario en LDAP **********
// ********** Adaptado por Joan Zamora, Departamento SOS DST **********

/*********** Modificado por Yenny Villalba ***********\
* Para integración con el Sistema de Servicio Comunitario *
 ********** */


/*** Aqui comienza la autenticacion con el CAS  ***/
// import phpCAS lib
// include_once('CAS.php');

// phpCAS::setDebug();

// inicializa sesion phpCAS
// phpCAS::client(CAS_VERSION_2_0,'secure.dst.usb.ve',443,'');

// phpCAS::setNoCasServerValidation();

// Forza la autenticacion CAS
// phpCAS::forceAuthentication();

// Para cerrar la cesion
// if (isset($_REQUEST['logout'])) {
//         phpCAS::logout();
// }
/*** Aqui termina la autenticación con el CAS ***/

/*** Comienzo de Validacion con LDAP ***/

// Se obtiene el login del usuario invocando phpCAS::getUser();
// ***** ojo quiza haga falta setear esta variable $usuario=phpCAS::getUser();
// $_SESSION[usuario_validado]=0;

// Se establece una conexion anónima al servidor LDAP
// $ds=ldap_connect("ldap-master.usb.ve, ldap1.usb.ve, ldap2.usb.ve");


// if ($ds) {
           //busqueda con el filtro a la base de datos LDAP
//            $r=ldap_bind($ds);
//            $sr=ldap_search($ds,"ou=People,dc=usb,dc=ve", "(&(uid=".$usuario.")(objectclass=inetOrgPerson))");
//            $info = ldap_get_entries($ds, $sr);
//            if ($info['count'] > 0)
//            {
//              if ($r)
//                {
               //Campo Nombre de usuario "cn"
//                $nombre_completo=$info[0]["cn"][0];
               //Campo cedula del usuario "personalid"
//                $cedula=$info[0]["personalid"][0];
               //Campo Tipo de usuario "homedirectory"
//                $tipo_per=$info[0]["homedirectory"][0];
//                $carrera=$info[0]["career"][0];
//                $carnet=$info[0]["studentid"][0];
			   
// 			   $nombre_separado = explode(" ", $nombre_completo);
// 			   $nombre1 = $nombre_separado[0];
// 			   $nombre2 = $nombre_separado[1];
// 			   $nombres = $nombre1." ".$nombre2;
// 			   $apellido1 = $nombre_separado[2];
// 			   $apellido2 = $nombre_separado[3];
// 			   $apellidos = $apellido1." ".$apellido2;
			   
			   $_SESSION[usuario_validado]=1;
			   $_SESSION[USBID]="06-39553";
            $_SESSION[nombres]="Martin";
			   $_SESSION[apellidos]="Freytes"; 
			   $_SESSION[cedula]="18588698";
			   $_SESSION[carrera]="Ingenieria de Computacion";
			   $_SESSION[carnet]="0639553";
			   
// 			   $tipo=explode("/",$tipo_per);
			   $_SESSION[tipo]="pregrado";
// 			   }
//                else
//                {
               //	"Error en el bind\n";
// 			   $_SESSION[usuario_validado]=-1;
//                }
//            }
//            else
//            {
           //	"No se encontro datos del usuario\n";
// 		   $_SESSION[usuario_validado]=0;
//            }
//          }
//          else
//          {
        //	"Error en la conexion del servidor\n";
// 		$_SESSION[usuario_validado]=-1;
//          }

// ldap_close($ds);
/*** Aqui termina la validacion LDAP ***/

/* Se elige a donde redireccionar al usuario,
 * Dependiendo del resultado obtenido en la autenticación.
*/
/*
if ($_SESSION[usuario_validado]==0){
	?>
	<script>
	alert("USBID o password incorrecto, por favor verifique sus datos y vuelva a intentarlo.");
	window.location="index.php";
	</script>	
	<?
}
if ($_SESSION[usuario_validado]==-1){
	?>
	<script>
	alert("Ocurrio un error al autenticar, por favor intente mas tarde.");
	window.location="index.php";
	</script>	
	<?
}
*/
if ($_SESSION[usuario_validado]==1){
	header("Location: cVerificarUsuario.php");
}
	
?>
