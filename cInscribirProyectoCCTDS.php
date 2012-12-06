<?php

require "cAutorizacion.php";

extract($_GET);
extract($_POST);

$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();

$modo_depuracion=false;


//-------------------------------------------------------------------------------------------//        
//---------------------------------MODALIDAD 1-----------------------------------------------//        
//-------------------SE VERIFICAN LOS DATOS PARA LA MODALIDAD 1-----.------------------------//        
if( isset($accion) && $accion == 'inscribir_proy_cctds')
{
	if(empty($_ERRORES)){
            $modo_depuracion=false;
            
            $_noempty_est = array('est_carnet', 'est_nombre', 'est_apellido',
		'est_carrera', 'est_sexo', 
		'est_email');
            
            $est_vacio=false;
            foreach($_noempty_est as $value){
                    if( empty($$value) )
                            $est_vacio=true;
            }
            
            $est_no_vacio=false;
            foreach($_noempty_est as $value){
                    if( !empty($$value) )
                            $est_no_vacio=true;
            }
            

            if (empty($est_carnet_lista) AND $est_vacio)
                $_ERRORES[] = 'Debe especificar los datos del estudiante';
            else {
                if (!empty($est_carnet_lista) AND $est_no_vacio)
                    $_ERRORES[] ="Si selecciona un USBID de la lista, no debe especificar el resto de los campos del estudiante";
                else {
                    if (!$est_vacio){
                        if (!comprobar_carnet($est_carnet)) {
                            $_ERRORES[] = 'Error de formato en el campo "Carnet" para '.$est_carnet.', por favor revise la linea'.$linea_actual;
                        }
                        if (!is_numeric($est_ci) && !empty($est_ci)) {
                        $_ERRORES[] = 'Error de formato en el campo "C&eacute;dula", por favor revise.';
                        }
                        if (!comprobar_telefono_2($est_tlf_hab) && !empty($est_tlf_hab)) {
                            $_ERRORES[] = 'Error de formato en el campo "Telefono Habitaci&oacute;n", por favor revise.';
                        }
                        if (!comprobar_telefono_2($est_tlf_cel) && !empty($est_tlf_cel)) {
                            $_ERRORES[] = 'Error de formato en el campo "Telefono Celular", por favor revise.';
                        }
                        if (!comprobar_email($est_email)) {
                            $_ERRORES[] = 'Error de formato en el campo "Email", por favor revise.';
                        }
                    }
                }
            }
            
            $_noempty = array('proyecto_lista', 'tutor','ins_trimestre','ins_anio');

            foreach($_noempty as $value){
                    if( empty($$value) )
                            $_ERRORES[] = 'El campo "'.$value.'" es obligatorio.';
            }
            
            if (!comprobar_fecha($ins_fecha)) {
                    $_ERRORES[] = 'Error de formato en el campo "Fecha de inscripci&oacute;n", por favor revise.';
                }
            
//------------------------------------------------------------------------------------------>
//-------------------SE VERIFICAN LOS DATOS A INSERTAR MOD-1-------------------------------->

            if(empty($_WARNING) AND empty($_ERRORES)){
                if (empty($_POST[est_carnet_lista])){
                    //Se verifica si el estudiante ya existe en la BD
                    $sql_temp="SELECT usbid FROM usuario WHERE usbid='$_POST[est_carnet]' ";
                    if ($modo_depuracion) echo "$sql_temp<br>"; 
                    $resultado=ejecutarConsulta($sql_temp, $conexion);
                    if (numResultados($resultado)>0)
                        $_ERRORES[] = 'Disculpe, el estudiante ya se encuentra registrado.';
                }    

                    //Se verifica que el proyecto se encuentre activo
                    $sql_temp="SELECT * FROM proyecto WHERE aprobado like 'SI' ".
                            "AND id='$proyecto_lista' ";
                    if ($modo_depuracion) echo "$sql_temp<br>"; 
                    $resultado=ejecutarConsulta($sql_temp, $conexion);
                    if (numResultados($resultado)==0)
                        $_ERRORES[] = 'Disculpe, el proyecto ya no se encuetra activo.';

                    //Se verifica que el tutor sea el del proyecto correspondiente
                    $sql_temp ="SELECT u.usbid ";
                    $sql_temp.="FROM usuario u, usuario_miembro_usb m, tutor_proy t ";
                    $sql_temp.="WHERE t.id_proyecto='$proyecto_lista' AND t.usbid_miembro=u.usbid AND t.usbid_miembro=m.usbid_usuario ";
                    $sql_temp.="AND t.usbid_miembro='$tutor' ";
                    if ($modo_depuracion) echo "$sql_temp<br>"; 
                    $resultado=ejecutarConsulta($sql_temp, $conexion);
                    if (numResultados($resultado)==0)
                        $_ERRORES[] = 'Disculpe, el tutor no corresponde con el del proyecto.';
            }
                
            
                
//------------------------------------------------------------------------------------------>
//-------------------SE INSERTAN LOS DATOS EN LA MODALIDAD 1-------------------------------->                
        if(empty($_WARNING) AND empty($_ERRORES)){
            
            //Se verifica si hay que insertar el estudiante
            if (empty($est_carnet_lista)){
                //se inserta un registro en la tabla usuario
                $sql_temp="INSERT INTO usuario VALUES (".
                "'$_POST[est_carnet]', ".//usbid
                "'$_POST[est_nombre]', ".//nombre
                "'$_POST[est_apellido]', ".//apellido
                "'', ".//password		
                "'$_POST[est_ci]', ". //ci
                "'pregrado' ".//tipo
                ")"; 

                if ($modo_depuracion) echo "$sql_temp<br>"; 
                else $resultado=ejecutarConsulta($sql_temp, $conexion);
                
                //se inserta un registro en la tabla estudiante
                $sql_temp="INSERT INTO usuario_estudiante VALUES (".
                    "'$_POST[est_carnet]', ".//usbid
                    "'$_POST[est_carnet]', ".//carnet
                    "'$_POST[est_carnet]', ".//cohorte
                    "'$_POST[est_carrera]', ".//carrera
                    "'', ".//estudiante sede
                    "'$_POST[est_email]', ".//email_sec
                    "'$_POST[est_tlf_hab]', ". //tlf_hab
                    "'$_POST[est_tlf_cel]', ". //celular
                    "'', ". //direccion
                    "'$_POST[est_sexo]' ".//sexo		
                    ")"; 
                    if ($modo_depuracion) echo "$sql_temp<br>"; 
                    else $resultado=ejecutarConsulta($sql_temp, $conexion);
            }
            
                    //Se le asigna el valor del carnet a la variable carnet_estudiante
                    if (empty($_POST[est_carnet_lista]))
                        $carnet_estudiante = $_POST[est_carnet];
                    else
                        $carnet_estudiante = $_POST[est_carnet_lista];
                    
                    $fch=explode("/",$_POST[ins_fecha]);
                    $fecha_ins = $fch[2]."-".$fch[1]."-".$fch[0];
                    
                //Se verifica si el estudiante ya inscribio ese proyecto
                $sql_temp="SELECT usbid_estudiante "
                            ."FROM inscripcion i "
                            ."WHERE usbid_estudiante='$carnet_estudiante' AND id_proyecto=$_POST[proyecto_lista] ";
                if ($modo_depuracion) echo "$sql_temp<br>"; 
                $resultado=ejecutarConsulta($sql_temp, $conexion);
                //Se hace UPDATE DEL ESTUDIANTE
                if (!(numResultados($resultado)>0)){
                    //Se verifica si el estudiante ya tiene todas las horas
                    $sql="SELECT horas_acumuladas "
                                ."FROM inscripcion i "
                                ."WHERE usbid_estudiante='$carnet_estudiante' ";
                    if ($modo_depuracion) echo "$sql<br>"; 
                    $resultado2=ejecutarConsulta($sql, $conexion);
                    $horas_acumuladas_est=0;
                    while ($fila2=obtenerResultados($resultado2)){
                        $horas_acumuladas_est=$horas_acumuladas_est+$fila2[horas_acumuladas];
                    }
                    if ($horas_acumuladas_est<120){
                        //se insertan los datos de la inscripcion
                        $sql_temp ="INSERT INTO inscripcion VALUES(".
                        "0, ".//id
                        "'$_POST[ins_trimestre]', ". //periodo
                        "'$_POST[ins_anio]', ". //anio
                        "'$carnet_estudiante', ".//usbid_estudiante
                        "'$_POST[proyecto_lista]', ".//id_proy
                        "'', ".//objetivos
                        "DATE('$fecha_ins'),".//fecha inscrip
                        "'$_POST[tutor]', ";//usbid del tutor
                        if ($_POST[ins_horas]!=0)//En caso de que el estudiante no 
                            {$sql_temp.="DATE_ADD('$fecha_ins', INTERVAL 91 DAY),";}//fecha_fin_real
                        else
                            {$sql_temp.="'',";}
                        $sql_temp.="'Automatizado',".//observaciones
                        "'SI',";//aprobado
                        if ($_POST[ins_horas]!=0){
                        $sql_temp.="'$_POST[ins_horas]',".//horas acumuladas
                                "'SI'";//culminacion validada
                        }
                        else {
                        $sql_temp.="'',".//horas acumuladas
                                "''";//culminacion validada
                        }
                        $sql_temp.=")";

                        if ($modo_depuracion) echo "$sql_temp<br>";
                        else $resultado=ejecutarConsulta($sql_temp, $conexion);

                    $_SUCCESS[] = 'Se ha inscrito al estudiante satisfactoriamente.';

                    }
                    else 
                        $_WARNING[] = 'No se agregó la inscripión, dado que la suma de horas daría más de 120. <br>Verifique cuántas tiene acumuladas.';
                }
                else 
                    $_WARNING[] = 'El estudiante ya se encontraba inscrito en ese proyecto.';
            }
            
        } else {
            $_WARNING[] = 'No se logr&oacute; inscribir al estudiante';
	}
        

}  



//-------------------------------------------------------------------------------------------//
//---------------------------------MODALIDAD 2-----------------------------------------------//
//-------------------SE VERIFICAN LOS DATOS PARA LA MODALIDAD 2------------------------------//
//if( !$dest OR !$asun OR !$cont ){
//	$_ERRORES[] = 'Todos los campos son obligatorios';
//}
//if ($modo_depuracion) echo "MODALIDAD 2<br>"; 
if( isset($accion) && $accion == 'inscribir_casc_cctds')
{

    //------------Se verifica el archivo csv--------//
//Se verifica que el archivo tenga el formato correcto y se inserta en la tabla plan_proy
    if (is_uploaded_file ($_FILES['xls']['tmp_name']))
    {
            if ($_FILES['xls']['type']<>"text/csv" ){
                    ?>
                    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
                    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
                    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
                    <body>
                        <script>
                        $.prompt('El plan de aplicacion no estaba en formato csv, por favor vuelva a intentarlo.', 
                        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vInscribirProyectoCCTDS.php" }  })
                        </script>	
                    </body>
                    <?
            }

    }
    else{
    ?>
            <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
            <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
            <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
            <body>
                <script>
                $.prompt('No se pudo subir el archivo. Por Favor vuelva a intentarlo.', 
                { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vInscribirProyectoCCTDS.php" }  })
                </script>	
            </body>
    <?
    }
     
            
            $fp = fopen ( $_FILES['xls']['tmp_name'] , "r" );
            $linea_actual=1;
            //Primero se verifican si todos los campos cumplen un formato valido

        while (( $data = fgetcsv ( $fp , 2048, ";","'" )) !== false ) { // Mientras hay líneas que leer...
            //Verificamos si algun campo esta vacio    
            for($k=0;$k<12;$k++) {
                if( !$data[$k] && ($k!=3 && $k!=6 && $k!=7 && $k!=12)){
                    $_ERRORES[]='Disculpe, la fila  "'.$linea_actual.'" tiene un campo vac&iacute;o, por favor verifique.';
		    $error_en_esta_linea=TRUE;
                    break;
                }
                $i++ ;

            }
                $carnet           =trim($data[0]);
                $apellido         =trim($data[1]);
                $nombre           =trim($data[2]);
                $ci               =trim($data[3]);
                $carrera          =trim($data[4]);
                $sexo             =trim($data[5]);
                $tlf_hab          =trim($data[6]);
                $tlf_cel          =trim($data[7]);
                $email            =trim($data[8]);
                $codigo_proy      =trim($data[9]);
						//esto se hacia cuando los proyectos tenian el codigo anterior
						//$codigo_proy=substr($codigo_proy,0,2).substr($codigo_proy,4,2).substr($codigo_proy,2,2);
                $tutor_proy       =trim($data[10]);
                $fecha_inicio     =trim($data[11]);
                $horas_cumplidas  =trim($data[12]);
                $cohorte          =substr($carnet,0,2); //Para que no se tenga que agregar manualmente la cohorte
                $anio             =substr($fecha_inicio,6,4);
                
                //Ahora se verifican los campos para que coincidan con el tipo
                if (!comprobar_carnet($carnet)) {
		    $_ERRORES[] = 'Error de formato en el campo "Carnet" para '.$carnet.', por favor revise la linea'.$linea_actual;
                }
                if (!is_numeric($ci) && !empty($ci)) {
                    $_ERRORES[] = 'Error de formato en el campo "C&eacute;dula", por favor revise la linea '.$linea_actual;
		    $error_en_esta_linea=TRUE;
                }
                if (!(strlen($carrera)<=4)) {
                    if (!(strlen($carrera)==3)) $carrera = "0".$carrera;
                    else {
			$_ERRORES[] = 'Error de formato en el campo "Carrera", por favor revise la linea '.$linea_actual;
			$error_en_esta_linea=TRUE;
		    }
                }
                if (0!=strcmp($sexo, "M") && 0!=strcmp($sexo, "F")) {
                    $_ERRORES[] = 'Error de formato en el campo "Sexo", por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                }
                if (!is_numeric($tlf_hab) && !empty($tlf_hab)) {
                    $_ERRORES[] = 'Error de formato en el campo "Telefono Habitaci&oacute;n", por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                }
                if (!is_numeric($tlf_cel) && !empty($tlf_cel)) {
                    $_ERRORES[] = 'Error de formato en el campo "Telefono Celular", por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                }
                if (!comprobar_email($email)) {
                    $_ERRORES[] = 'Error de formato en el campo "Email", por favor revise.';
   		    $error_en_esta_linea=TRUE;
                }
                if (!comprobar_codigo($codigo_proy)) {
                    $_ERRORES[] = 'Error de formato en el campo "C&oacute;digo del proyecto", por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                } else $codigo_proy=reemplazar_codigo($codigo_proy);
                if (!comprobar_fecha($fecha_inicio)) {
                    $_ERRORES[] = 'Error de formato en el campo "Fecha", por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                } else {
                    $fch=explode("/",$_POST[$fecha_inicio]);
                    $fecha_ins = $fch[2]."-".$fch[1]."-".$fch[0];
                    $ene_mar=strtotime($anio."-04-01");
                    $abr_jul=strtotime($anio."-07-15");
                    $sep_dic=strtotime($anio."-12-31");
                    $fecha_ins=strtotime($fecha_ins);
                    if ($fecha_ins<$ene_mar)
                        $trimestre="Enero-Marzo";
                    if ($fecha_ins>$ene_mar && $fecha_ins<$sep_dic)
                        $trimestre="Abril-Julio";
                    if ($fecha_ins>$sep_dic)
                        $trimestre="Septiembre-Diciembre";
                }
                if (!is_numeric($horas_cumplidas) && !empty($horas_cumplidas)) {
                    $_ERRORES[] = 'Error de formato en el campo horas, por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                }
                
                //Se verifica que el proyecto se encuentre activo
                $sql_temp="SELECT id FROM proyecto WHERE aprobado like 'SI' ".
                        "AND codigo='$codigo_proy' ";
                if ($modo_depuracion) echo "$sql_temp<br>"; 
                $resultado=ejecutarConsulta($sql_temp, $conexion);
                if (numResultados($resultado)==0){
                    $_ERRORES[] = 'Disculpe, el proyecto '.$codigo_proy.' no se encuentra registrado, por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
                }else {
                    $aux=obtenerResultados($resultado);
                    $proy=$aux[id];
                } 
                
                //Se verifica que el tutor sea el del proyecto correspondiente
                $sql_temp ="SELECT u.usbid ";
                $sql_temp.="FROM usuario u, usuario_miembro_usb m, tutor_proy t, proyecto p ";
                $sql_temp.="WHERE t.id_proyecto=p.id AND p.codigo='$codigo_proy' AND t.usbid_miembro=u.usbid AND t.usbid_miembro=m.usbid_usuario ";
                $sql_temp.="AND t.usbid_miembro='$tutor_proy' ";
                if ($modo_depuracion) echo "$sql_temp;<br>"; 
                $resultado=ejecutarConsulta($sql_temp, $conexion);
                if (numResultados($resultado)==0){
                    $_ERRORES[] = 'Disculpe, el tutor '.$tutor_proy.' no corresponde con el del proyecto '.$codigo_proy.'. Por favor revise la linea '.$linea_actual;
   		    $error_en_esta_linea=TRUE;
		}
                
               
                
//------------------------------------------------------------------------------------------>
//-------------------SE INSERTAN LOS DATOS EN LA MODALIDAD 2-------------------------------->                

                //Se verifica si el estudiante ya existe en la tabla usuario
		if ($modo_depuracion) echo "--Se verifica si el estudiante ya existe en la tabla usuario<br>"; 

                $sql_temp="SELECT usbid FROM usuario WHERE usbid='$carnet' ";
                if ($modo_depuracion) echo "$sql_temp;<br>"; 
                $resultado=ejecutarConsulta($sql_temp, $conexion);
                //Se hace UPDATE DEL ESTUDIANTE
                if (!numResultados($resultado)>0){ //si el estudiante existe en la tabla usuario... no hay que hacer nada
		if ($modo_depuracion) echo "--El estudiante no estaba en la tabla de usuarios <br>";
                    //SE HACE INSERT DEL ESTUDIANTE
                    
                    $sql_temp="INSERT INTO usuario VALUES (".
                    "'$carnet', ".//usbid
                    "'$nombre', ".//nombre
                    "'$apellido', ".//apellido
                    "'', ".//password		
                    "'$ci', ". //ci
                    "'pregrado' ".//tipo
                    ")"; 

                    if ($modo_depuracion) echo "$sql_temp;<br>"; 
                    else $resultado=ejecutarConsulta($sql_temp, $conexion);

                    //se inserta un registro en la tabla estudiante
                    $sql_temp="INSERT INTO usuario_estudiante VALUES (".
                        "'$carnet', ".//usbid
                        "'$carnet', ".//carnet
                        "'$carnet', ".//cohorte
                        "'$carrera', ".//carrera
                        "'Sartenejas', ".//estudiante sede
                        "'$email', ".//email_sec
                        "'$tlf_hab', ". //tlf_hab
                        "'$tlf_cel', ". //celular
                        "'', ". //direccion
                        "'$sexo' ".//sexo		
                        ")"; 
                        if ($modo_depuracion) echo "$sql_temp;<br>"; 
                        else $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
                    
                //Se verifica si el estudiante ya inscribio ese proyecto
		if ($modo_depuracion) echo "--Se verifica si el estudiante ya inscribio ese proyecto <br>";
                $sql_temp="SELECT usbid_estudiante "
                            ."FROM inscripcion i, proyecto p "
                            ."WHERE i.usbid_estudiante='$carnet' AND p.id=i.id_proyecto "
                            ."AND p.codigo='$codigo_proy' ";
                //if ($modo_depuracion) echo "$sql_temp<br>"; 
                $resultado=ejecutarConsulta($sql_temp, $conexion);

                if (!(numResultados($resultado)>0)){
			if ($modo_depuracion) echo "-- El estudiante no inscribio ese proyecto <br>";
                        $fch=explode("/",$fecha_inicio);
                        $fecha_ins = $fch[2]."-".$fch[1]."-".$fch[0];
                        //se insertan los datos de la inscripcion
                        $sql_temp="INSERT INTO inscripcion VALUES(".
                        "0, ".//id
                        "'$trimestre', ". //periodo
                        "'$anio', ". //anio
                        "'$carnet', ".//usbid_estudiante
                        "'$proy', ".//id_proy
                        "'', ".//objetivos
                        "DATE('$fecha_ins'),".//fecha inscrip
                        "'$tutor_proy', ".//usbid del tutor
			"'', ".//fecha_fin_real
                        "'Cascada',".//observaciones
                        "'SI',";//aprobado
                        if ($horas_cumplidas!=0){
                        $sql_temp.="'$horas_cumplidas',".//horas acumuladas
                                "'SI'";//culminacion validada
                        }
                        else {
                       		$sql_temp.="'0',".//horas acumuladas
                                "''";//culminacion validada
                        }
                        $sql_temp.=")";


                        if ($modo_depuracion) echo "$sql_temp;<br>";
                        else $resultado=ejecutarConsulta($sql_temp, $conexion);




        /*********************
                    //Se verifica si el estudiante ya tiene todas las horas
                    $sql="SELECT horas_acumuladas "
                                ."FROM inscripcion i "
                                ."WHERE usbid_estudiante='$carnet' ";
                    if ($modo_depuracion) echo "$sql<br>"; 
                    $resultado2=ejecutarConsulta($sql, $conexion);
                    $horas_acumuladas_est=0;
                    while ($fila2=obtenerResultados($resultado2)){
                        $horas_acumuladas_est=$horas_acumuladas_est+$fila2[horas_acumuladas];
                    }


                    if ($horas_acumuladas_est<120){
                        $fch=explode("/",$fecha_inicio);
                        $fecha_ins = $fch[2]."-".$fch[1]."-".$fch[0];
                        //se insertan los datos de la inscripcion
                        $sql_temp="INSERT INTO inscripcion VALUES(".
                        "0, ".//id
                        "'$trimestre', ". //periodo
                        "'$anio', ". //anio
                        "'$carnet', ".//usbid_estudiante
                        "'$proy', ".//id_proy
                        "'', ".//objetivos
                        "DATE('$fecha_ins'),".//fecha inscrip
                        "'$tutor_proy', ";//usbid del tutor
                        if ($horas_cumplidas!=0)//En caso de que el estudiante tenga 120 horas
                            {$sql_temp.="DATE_ADD('$fecha_ins', INTERVAL 91 DAY),";}//fecha_fin_real
                        else
                            {$sql_temp.="'',";}
                        $sql_temp.="'Cascada',".//observaciones
                        "'SI',";//aprobado
                        if ($horas_cumplidas!=0){
                        $sql_temp.="'$horas_cumplidas',".//horas acumuladas
                                "'SI'";//culminacion validada
                        }
                        else {
                       		$sql_temp.="'0',".//horas acumuladas
                                "''";//culminacion validada
                        }
                        $sql_temp.=")";


                        if ($modo_depuracion) echo "$sql_temp<br>";
                        else $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
		    **************/
                }else{
			if ($modo_depuracion) echo "-- El estudiante YA inscribio ese proyecto <br>";
			$_ERRORES[] = 'Disculpe, el estudiante '.$carnet.' ya habia inscrito el proyecto '.$codigo_proy.'. Por favor revise la linea '.$linea_actual;
    		        $error_en_esta_linea=TRUE;
		}

                          

		if($error_en_esta_linea)
			$_SUCCESS[] = 'Ejecutada con &eacute;xito la linea '.$linea_actual;
	        $linea_actual++;    
                //PARA VALIDACIONESSSSS $cedula=trim(str_replace('.','', $_POST[ci]));
	        if ($modo_depuracion) echo "<hr><hr>"; 
		$error_en_esta_linea=FALSE;
            } //cierra el while

	    if (count($_ERRORES)>0){
      		$_ERRORES[] = 'Se encontraron '.count($_ERRORES).' errores';
	    }


            fclose ( $fp ); 
            
            if(empty($_WARNING) && empty($_ERRORES))
                $_SUCCESS[] = 'Se han agregado los estudiantes satisfactoriamente.';
				else 
         	$_WARNING[] = 'No se han agregado los estudiantes.';
} //cierra modalidad 2

include('vInscribirProyectoCCTDS.php');
cerrarConexion($conexion);
?>
