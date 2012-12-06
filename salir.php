<?

include_once('scriptcas.php');	
   $_SESSION=array();			
	session_unset();
	session_destroy();

	$parametros_cookies = session_get_cookie_params();
	setcookie(session_name(),0,1,$parametros_cookies["path"]);
	header("Location: index.php");
	phpCAS::logout();

//      session_unset();    //Comentar
//	session_destroy();  //Comentar
?>
<!--<script>window.location="index3.php" </script>   Comentar-->