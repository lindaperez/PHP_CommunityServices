<?

require "cAutorizacion.php";
//Se verifica si el usuario ya tiene alguna formulacion de un proyecto
include "cModificarFormulacion.php";

extract($_GET);
extract($_POST);

// Modificamos los datos del proyecto
$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();


$modo_depuracion=FALSE;
    

    //Para los casos de guardar y enviar proyecto se debe hacer la misma validacion
    //Se verifica como prueba de seguridad, que la persona no este intentando colocar tutores iguales
    //Primero con el tutor 1
    if (((($_POST[tutor1_usbid] == $_POST[tutor2_usbid]        ||
           $_POST[tutor1_usbid] == $_POST[tutor2_usbid_nuevo]  ||
           $_POST[tutor1_usbid] == $_POST[tutor3_usbid]        ||
           $_POST[tutor1_usbid] == $_POST[tutor3_usbid_nuevo]) &&
           (!empty($_POST[tutor1_usbid])))       ||
           ($_POST[tutor1_usbid_nuevo] == $_POST[tutor2_usbid]        ||
           $_POST[tutor1_usbid_nuevo]  == $_POST[tutor2_usbid_nuevo]  ||
           $_POST[tutor1_usbid_nuevo]  == $_POST[tutor3_usbid]        ||
           $_POST[tutor1_usbid_nuevo]  == $_POST[tutor3_usbid_nuevo]) &&
           (!empty($_POST[tutor1_usbid_nuevo]))) ||
    //Luego se verifica el tutor 2
           ((($_POST[tutor2_usbid] == $_POST[tutor1_usbid]        ||
           $_POST[tutor2_usbid]    == $_POST[tutor1_usbid_nuevo]  ||
           $_POST[tutor2_usbid]    == $_POST[tutor3_usbid]        ||
           $_POST[tutor2_usbid]    == $_POST[tutor3_usbid_nuevo]) &&
           (!empty($_POST[tutor2_usbid])))       ||
           ($_POST[tutor2_usbid_nuevo] == $_POST[tutor1_usbid]        ||
           $_POST[tutor2_usbid_nuevo]  == $_POST[tutor1_usbid_nuevo]  ||
           $_POST[tutor2_usbid_nuevo]  == $_POST[tutor3_usbid]        ||
           $_POST[tutor2_usbid_nuevo]  == $_POST[tutor3_usbid_nuevo]) &&
           (!empty($_POST[tutor2_usbid_nuevo]))) ||
    //Luego se verifica el tutor 3
           ((($_POST[tutor3_usbid] == $_POST[tutor1_usbid]        ||
           $_POST[tutor3_usbid]    == $_POST[tutor1_usbid_nuevo]  ||
           $_POST[tutor3_usbid]    == $_POST[tutor2_usbid]        ||
           $_POST[tutor3_usbid]    == $_POST[tutor2_usbid_nuevo]) &&
           (!empty($_POST[tutor3_usbid])))       ||
           ($_POST[tutor3_usbid_nuevo] == $_POST[tutor1_usbid]        ||
           $_POST[tutor3_usbid_nuevo] == $_POST[tutor1_usbid_nuevo]  ||
           $_POST[tutor3_usbid_nuevo] == $_POST[tutor2_usbid]        ||
           $_POST[tutor3_usbid_nuevo] == $_POST[tutor2_usbid_nuevo]) &&
           (!empty($_POST[tutor3_usbid_nuevo])))
            

       ){
           
        $_ERRORES[]='Disculpe, usted a colocado mas de una vez al mismo tutor';
        
    }
    
    
    
//---------------------Funciones----------------------------------//
function guardar_comunidad(){    
    
    //si el usuario no elige una comunidad se debe insertar primero y luego obtener el id
    if ($_POST[comuni_id]<>""){
            $id_comunidad=$_POST[comuni_id];
    }else{ 
        //Se tiene que verificar que no este vacio si se va a insertar
        if (!empty($_POST[comuni_nombre])){
            $sql_temp="INSERT INTO comunidad VALUES (".
            "0, ".//id
            "trim('$_POST[comuni_nombre]'), ".//nombre
            "trim('$_POST[comuni_ubic]'), ".//ubicacion
            "trim('$_POST[comuni_desc]') ".//descripcion		
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";

            $resultado=ejecutarConsulta($sql_temp, $conexion);

            $sql_temp="SELECT max(id) as id FROM comunidad";
            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $fila=obtenerResultados($resultado);
            $id_comunidad=$fila[id];
        }
        
    }
    return $id_comunidad;
    if ($modo_depuracion) echo "id_comunidad=$id_comunidad<br>";
    
}
    
function guardar_representante(){    
    
    //si el usuario no elige un representante se debe insertar primero y luego obtener el id
    if ($_POST[rep_id]<>""){
            $id_rep=$_POST[rep_id];
    }else{
        //Se tiene que verificar que no este vacio si se va a insertar
        if (!empty($_POST[rep_email])){
            //Se Verifica que el representante nuevo no se encuentre en la tabla de representante
            $sql_hey="SELECT * FROM representante WHERE email LIKE '%".$_POST[rep_email]."%'";
            $resultado=ejecutarConsulta($sql_hey, $conexion);
            $fila=obtenerResultados($resultado);
            if (!empty($fila)){
                $rep_email=$_POST[rep_email];

                $_WARNING[] = 'El representante "'.$_POST[rep_nombres]. " ".$_POST[rep_apellidos].'" ya se encontraba registrado
                            con el correo "'.$_POST[rep_email].'@usb.ve" <br/> De todas formas, su Proyecto se ha
                            agregado satisfactoriamente.';
            } else {
            //Se debe insertar primero el representante y luego obtener el id
            $sql_temp="INSERT INTO representante VALUES (".
            "0, ".//id
            "trim('$_POST[rep_apellidos]'), ".//apellidos
            "trim('$_POST[rep_nombres]'), ".//nombres
            "trim('$_POST[rep_inst]'), ".//institucion
            "trim('$_POST[rep_cargo]'), ".//cargo	
            "trim('$_POST[rep_dir]'), ".//direccion
            "trim('$_POST[rep_email]'), ".//email	
            "trim('$_POST[rep_tlf]'), ".//telefono
            "trim('$_POST[rep_ci]'), ".//cedula	
            "trim('$_POST[rep_cel]') ".//celular		
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);

            $sql_temp="SELECT max(id) as id FROM representante";
            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $fila=obtenerResultados($resultado);
            $id_rep=$fila[id];

            }
        }
    }
    return $id_rep;
    
}    

function guardar_organizacion(){    
    //Se debe insertar primero la organizacion y luego obtener el id
    if ($_POST[org_nombre]==""){
            $id_org="";
    }else{
        //Se tiene que verificar que no este vacio si se va a insertar
        if (!empty($_POST[org_nombre])){
            $sql_temp="INSERT INTO organizacion VALUES (".
            "0, ".//id
            "trim('$_POST[org_nombre]'), ".//nombre
            "trim('$_POST[org_dir]'), ".//direccion
            "trim('$_POST[org_email]'), ".//email
            "trim('$_POST[org_tlf]'), ".//tlf
            "trim('$_POST[org_fax]') ".//tlf
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);

            $sql_temp="SELECT max(id) as id FROM organizacion";
            if ($modo_depuracion) echo "$sql_temp<br>";

            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $fila=obtenerResultados($resultado);
            $id_org=$fila[id];
        }
    }
    return $id_org;
}

function guardar_organizacion_viejo($aux_id_organizacion){    
    //Se debe insertar primero la organizacion y luego obtener el id
    if ($_POST[org_nombre]==""){
            $id_org="";
    }else{
        //Se tiene que verificar que no este vacio si se va a insertar
        if (!empty($_POST[org_nombre])){
            $sql_temp="UPDATE organizacion SET ".
            "nombre=trim('$_POST[org_nombre]'), ".//nombre
            "direccion=trim('$_POST[org_dir]'), ".//direccion
            "email=trim('$_POST[org_email]'), ".//email
            "telefono=trim('$_POST[org_tlf]'), ".//tlf
            "fax=trim('$_POST[org_fax]') ".//tlf
            "WHERE id='$aux_id_organizacion'";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $id_org=$aux_id_organizacion; 
        }
    }
    return $aux_id_organizacion;
}

function guardar_proyecto_nuevo($id_comunidad,$id_rep,$id_org,$status){    
    
    //--------------Se ingresa el proyecto--------------------//
    $sql="INSERT INTO proyecto VALUES(".
    "0, ".//id
    "'$_SESSION[USBID]', ".//usbid_postula
    "'$status', ".//status del proyecto
    "'', ".//codigo
    "now() , ".//fecha ingreso
    "trim('$id_comunidad'), ".// id comunidad
    "trim('$_POST[titulo]'), ".
    "trim('$_POST[area_proy]'), ".//id area proy
    "trim('$_POST[impacto]'), ".
    "trim('$_POST[resumen]'), ".
    "trim('$_POST[area_trabajo]'), ".
    "trim('$id_rep'),". //id representante
    "trim('$id_org'),". //id organizacion
    "trim('$_POST[antecedentes]'), ".
    "trim('$_POST[obj_gral]'), ".
    "trim('$_POST[obj_esp]'), ".
    "trim('$_POST[desc]'), ".
    "trim('$_POST[act_esp]'), ".
    "trim('$_POST[perfil]'), ".
    "trim('$_POST[recursos]'), ".
    "trim('$_POST[logros]'), ".
    "trim('$_POST[directrices]'), ".
    "trim('$_POST[magnitud]'), ".
    "trim('$_POST[participacion]'), ".
    "trim('$_POST[formacion_req]'), ".
    "trim('$_POST[formacion_esp]'), ".
    "trim('$_POST[horas]'), ".
    "'',".//firmado
    "'NO',".//aprobado
    "'',".//fecha firma
    "'',".//fecha aprob
    "'NO'".//CULMINADO
    ")";

    $resultado=ejecutarConsulta($sql, $conexion);

    $sql_temp="SELECT max(id) as id FROM proyecto";
    if ($modo_depuracion) echo "$sql_temp<br>";

    $resultado=ejecutarConsulta($sql_temp, $conexion);
    $fila=obtenerResultados($resultado);
    $id_proy=$fila[id];
    
    //Se insertan los datos en la tabla beneficiados
    $sql="INSERT INTO beneficiados VALUES(".
    "$id_proy, ".//id del proyecto
    "trim('$_POST[cant_fem]'), ".//cantidad de mujeres
    "trim('$_POST[cant_masc]'), ".//cantidad de hombres
    "trim('$_POST[min_edad]'), ".//edad minima
    "trim('$_POST[max_edad]'), ".//edad maxima
    "trim('$_POST[cant_disc]') ".//cantidad de discapacitados
    ")";

    if ($modo_depuracion) echo "$sql<br>";
        else $resultado=ejecutarConsulta($sql, $conexion);   
        
return $id_proy;
}

function guardar_proyecto_viejo($id_proy,$id_comunidad,$id_rep,$id_org,$status){    
    
    //--------------Se guarda el proyecto--------------------//
    $sql="UPDATE proyecto SET ".
    //"0, ".//id
    //"'$_SESSION[USBID]', ".//usbid_postula
    "status_proy='$status', ".//status del proyecto
    //"'', ".//codigo
    "fecha_ingreso=now() , ".//fecha ingreso
    "id_comunidad=trim('$id_comunidad'), ".// id comunidad
    "titulo=trim('$_POST[titulo]'), ".
    "id_area_proy=trim('$_POST[area_proy]'), ".//id area proy
    "impacto_social=trim('$_POST[impacto]'), ".
    "resumen=trim('$_POST[resumen]'), ".
    "area_de_trabajo=trim('$_POST[area_trabajo]'), ".
    "id_representante=trim('$id_rep'),". //id representante
    "id_organizacion=trim('$id_org'),". //id organizacion
    "antecedentes=trim('$_POST[antecedentes]'), ".
    "obj_general=trim('$_POST[obj_gral]'), ".
    "obj_especificos=trim('$_POST[obj_esp]'), ".
    "descripcion=trim('$_POST[desc]'), ".
    "actividades=trim('$_POST[act_esp]'), ".
    "perfil=trim('$_POST[perfil]'), ".
    "recursos=trim('$_POST[recursos]'), ".
    "logros=trim('$_POST[logros]'), ".
    "directrices=trim('$_POST[directrices]'), ".
    "magnitud=trim('$_POST[magnitud]'), ".
    "participacion=trim('$_POST[participacion]'), ".
    "formacion=trim('$_POST[formacion_req]'), ".
    "formacion_desc=trim('$_POST[formacion_esp]'), ".
    "horas=trim('$_POST[horas]') ".
    "WHERE id='$id_proy'";

    $resultado=ejecutarConsulta($sql, $conexion);
    if ($modo_depuracion) echo "$sql_temp<br>";

    //Se insertan los datos en la tabla beneficiados
    $sql="UPDATE beneficiados SET ".
    "sexo_fem=trim('$_POST[cant_fem]'), ".//cantidad de mujeres
    "sexo_masc=trim('$_POST[cant_masc]'), ".//cantidad de hombres
    "edad_min=trim('$_POST[min_edad]'), ".//edad minima
    "edad_max=trim('$_POST[max_edad]'), ".//edad maxima
    "discapacidad=trim('$_POST[cant_disc]') ".//cantidad de discapacitados
    "WHERE id_proyecto=$id_proy";

    if ($modo_depuracion) echo "$sql<br>";
        else $resultado=ejecutarConsulta($sql, $conexion);   
}

function guardar_proponente($id_proy){
    
    //si el usuario no elige un proponente de la lista, se debe insertar primero y luego insertarlo en la tabla proponente
    if ($_POST[prop_usbid]<>""){

            $sql_temp="INSERT INTO proponente VALUES (";
            $sql_temp.="'$_POST[prop_usbid]','$id_proy')";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);			

    }else{
        if (!empty($_POST[prop_usbid_nuevo])){
        //Se Verifica que el proponente nuevo no se encuentre en la tabla de proponente
            if (!existe_en_bd($_POST[prop_usbid_nuevo],'proponente','usbid_usuario')){



                    //Aqui se debe colocar el codigo nuevo para verificar
                    $sql_temp="INSERT INTO proponente VALUES (";
                    $sql_temp.="'$_POST[prop_usbid_nuevo]','$id_proy')";
                    if ($modo_depuracion) echo "$sql_temp<br>";
                    $resultado=ejecutarConsulta($sql_temp, $conexion);			            

                    $_WARNING[] = 'El proponente "'.$_POST[prop_nombre]. " ".$_POST[prop_apellido].'" ya se encontraba registrado
                        con el correo "'.$_POST[prop_usbid_nuevo].'@usb.ve" <br/> De todas formas, su Proyecto se ha 
                        agregado satisfactoriamente.';

                } else {
                        //Se Verifica que el proponente nuevo no se encuentre en la tabla de usuario
                        if (!existe_en_bd($_POST[prop_usbid_nuevo],'usuario','usbid')){
                            $sql_temp="INSERT INTO usuario (usbid, nombre, apellido, password, ci) VALUES (".
                            "trim('$_POST[prop_usbid_nuevo]'), ".//usbid
                            "trim('$_POST[prop_nombre]'), ".//nombre
                            "trim('$_POST[prop_apellido]'), ".//apellido
                            "'1234', ".//password. Esto es temporal dado que se va a utilizar el usbid verdadero para el acceso prop_ci
                            "trim('$_POST[prop_ci]'))"; //cedula
                            $resultado=ejecutarConsulta($sql_temp, $conexion);
                            if ($modo_depuracion) echo "$sql_temp<br>";
                        }
                        //Se Verifica que el proponente nuevo no se encuentre en la tabla de usuario_estudiante
                        if (!existe_en_bd($_POST[prop_usbid_nuevo],'usuario_estudiante','usbid_usuario')){
                            if ($_POST[prop_carnet]<>""){
                                    $sql_temp="INSERT INTO usuario_estudiante (usbid_usuario, carnet) VALUES (";
                                    $sql_temp.="'$_POST[prop_usbid_nuevo]','$_POST[prop_carnet]')";
                                    if ($modo_depuracion) echo "$sql_temp<br>";
                                    $resultado=ejecutarConsulta($sql_temp, $conexion);			
                            }
                        }
                        //Se Verifica que el proponente nuevo no se encuentre en la tabla de usuario_miembro_usb
                        if (!existe_en_bd($_POST[prop_usbid_nuevo],'usuario_miembro_usb','usbid_usuario')){
                            if ($_POST[prop_dependencia]<>""){
                                    $sql_temp="INSERT INTO usuario_miembro_usb (usbid_usuario, dependencia) VALUES (".
                                    "trim('$_POST[prop_usbid_nuevo]'),". //USBID_USUARIO
                                    "trim('$_POST[prop_dependencia]')". //DEPENDENCIA
                                    ")";
                                    if ($modo_depuracion) echo "$sql_temp<br>";
                                    $resultado=ejecutarConsulta($sql_temp, $conexion);
                            }
                        }

                            $sql_temp="INSERT INTO proponente VALUES (";
                            $sql_temp.="trim('$_POST[prop_usbid_nuevo]'),'$id_proy')";
                            if ($modo_depuracion) echo "$sql_temp<br>";
                            $resultado=ejecutarConsulta($sql_temp, $conexion);	
                    }
            }
        }    
}
    
function guardar_tutor1($id_proy,$Comparaciones_Con_tutor1){    
    //si el usuario no elige al TUTOR 1 de la lista, se debe insertar primero 
    //en la tabla usuario, luego en usuario_miembro_usb y finalmente en la tabla tutor_proy
    if( empty($_POST[tutor1_usbid]) ){
        //Se tiene que verificar que no este vacio el nuevo a insertar
        if (!empty($_POST[tutor1_usbid_nuevo])){
        
            if( empty($_POST[tutor1_usbid]) && ($Comparaciones_Con_tutor1)){

                //Se Verifica que el tutor nuevo no se encuentre en la tabla de proponente
                if (existe_en_bd($_POST[tutor1_usbid_nuevo],'tutor_proy','usbid_miembro')){

                    $usbid_tutor=$_POST[tutor1_usbid_nuevo];

                    $_WARNING[] = 'El tutor "'.$_POST[tutor1_nombre]. " ".$_POST[tutor1_apellido].'" ya se encontraba registrado
                                con el correo "'.$_POST[tutor1_usbid_nuevo].'@usb.ve" <br/> De todas formas, su Proyecto se ha
                                agregado satisfactoriamente.';

                    } else {
                    //Se Verifica que el tutor1 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor1_usbid_nuevo],'usuario','usbid')){
                        $sql_temp="INSERT INTO usuario (usbid, nombre, apellido, password, ci) VALUES (".
                        "trim('$_POST[tutor1_usbid_nuevo]'), ".//usbid
                        "trim('$_POST[tutor1_nombre]'), ".//nombre
                        "trim('$_POST[tutor1_apellido]'), ".//apellido	
                        "'1234', ".//password		
                        "trim('$_POST[tutor1_ci]' )".//ci
                        ")";
                        if ($modo_depuracion) echo "$sql_temp<br>";	
                        $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
                    //Se Verifica que el tutor1 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor1_usbid_nuevo],'usuario_miembro_usb','usbid_usuario')){
                        $sql_temp="INSERT INTO usuario_miembro_usb VALUES (".
                        "trim('$_POST[tutor1_usbid_nuevo]'), ".//usbid_usuario
                        "trim('$_POST[tutor1_dependencia]'), ".//dependencia	
                        "'', ".//email secundario	
                        "trim('$_POST[tutor1_tlf]'), ".//tlf	
                        "'' ".//celular
                        ")";
                        if ($modo_depuracion) echo "$sql_temp<br>";
                        $resultado=ejecutarConsulta($sql_temp, $conexion);	
                    }

                        $usbid_tutor=$_POST[tutor1_usbid_nuevo];
                    }

            } else {
                    $usbid_tutor=$_POST[tutor1_usbid_nuevo];
            }
        }
    } else {
            $usbid_tutor=$_POST[tutor1_usbid];
    }
    // Introducimos tutor en el proyecto. 
    if ( !empty($usbid_tutor) ){
        $sql_temp="INSERT INTO tutor_proy VALUES (".
        "'$usbid_tutor', ".//usbid_usuario
        "'$id_proy' ".//id_proyecto	
        ")";
        if ($modo_depuracion) echo "$sql_temp<br>";
        $resultado=ejecutarConsulta($sql_temp, $conexion);	
    }
}

function guardar_tutor2($id_proy,$Comparaciones_Con_tutor2){    
    //si el usuario no elige al TUTOR 2 de la lista, se debe insertar primero 
    //en la tabla usuario, luego en usuario_miembro_usb y finalmente en la tabla tutor_proy
    if ( empty($_POST[tutor2_usbid])){
        if (!empty($_POST[tutor2_usbid_nuevo])){
            if( empty($_POST[tutor2_usbid]) && $Comparaciones_Con_tutor2 ){
                    if($_POST[tutor2_usbid_nuevo]<>""){
                //Se Verifica que el tutor nuevo no se encuentre en la tabla de proponente
                if (existe_en_bd($_POST[tutor2_usbid_nuevo],'tutor_proy','usbid_miembro')){

                    $usbid_tutor=$_POST[tutor2_usbid_nuevo];

                    $_WARNING[] = 'El tutor "'.$_POST[tutor2_nombre]. " ".$_POST[tutor2_apellido].'" ya se encontraba registrado
                                con el correo "'.$_POST[tutor2_usbid_nuevo].'@usb.ve" <br/> De todas formas, su Proyecto se ha
                                agregado satisfactoriamente.';

                } else {

                    //Se Verifica que el tutor2 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor2_usbid_nuevo],'usuario','usbid')){
                        $sql_temp="INSERT INTO usuario (usbid, nombre, apellido, password, ci) VALUES (".
                        "trim('$_POST[tutor2_usbid_nuevo]'), ".//usbid
                        "trim('$_POST[tutor2_nombre]'), ".//nombre
                        "trim('$_POST[tutor2_apellido]'), ".//apellido
                        "'1234', ".//password
                        "trim('$_POST[tutor2_ci]') ".//ci
                        ")";
                    }
                    //Se Verifica que el tutor2 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor2_usbid_nuevo],'usuario_miembro_usb','usbid_usuario')){
                        if ($modo_depuracion) echo "$sql_temp<br>";
                        $resultado=ejecutarConsulta($sql_temp, $conexion);

                        $sql_temp="INSERT INTO usuario_miembro_usb VALUES (".
                        "trim('$_POST[tutor2_usbid_nuevo]'), ".//usbid_usuario
                        "trim('$_POST[tutor2_dependencia]'), ".//dependencia
                        "'', ".//email secundario
                        "trim('$_POST[tutor2_tlf]'), ".//tlf
                        "trim('$_POST[tutor2_ci]')".//ci
                        ")";
                        if ($modo_depuracion) echo "$sql_temp<br>";
                        $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
                        $usbid_tutor2=$_POST[tutor2_usbid_nuevo];

                    }

                }

            } else {
                $usbid_tutor2=$_POST[tutor2_usbid_nuevo];
            }
        }
    }else {
        $usbid_tutor2=$_POST[tutor2_usbid];
    }
    if ( !empty($usbid_tutor2) ){
            $sql_temp="INSERT INTO tutor_proy VALUES (".
            "'$usbid_tutor2', ".//usbid_usuario
            "'$id_proy' ".//id_proyecto	
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);	
    }
}

function guardar_tutor3($id_proy,$Comparaciones_Con_tutor3){    
    //si el usuario no elige al TUTOR 3 de la lista, se debe insertar primero 
    //en la tabla usuario, luego en usuario_miembro_usb y finalmente en la tabla tutor_proy
    if ( empty($_POST[tutor3_usbid]) ){
        if (!empty($_POST[tutor3_usbid_nuevo])){
            if( empty($_POST[tutor3_usbid]) && $Comparaciones_Con_tutor3 ){
                    if($_POST[tutor3_usbid_nuevo]<>""){

                        //Se Verifica que el tutor nuevo no se encuentre en la tabla de proponente
                        if (existe_en_bd($_POST[tutor3_usbid_nuevo],'tutor_proy','usbid_miembro')){

                        $usbid_tutor=$_POST[tutor3_usbid_nuevo];

                        $_WARNING[] = 'El tutor "'.$_POST[tutor3_nombre]. " ".$_POST[tutor3_apellido].'" ya se encontraba registrado
                                con el correo "'.$_POST[tutor3_usbid_nuevo].'@usb.ve" <br/> De todas formas, su Proyecto se ha
                                agregado satisfactoriamente.';

                } else {

                    //Se Verifica que el tutor3 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor3_usbid_nuevo],'usuario','usbid')){
                        $sql_temp="INSERT INTO usuario (usbid, nombre, apellido, password, ci) VALUES (".
                        "trim('$_POST[tutor3_usbid_nuevo]'), ".//usbid
                        "trim('$_POST[tutor3_nombre]'), ".//nombre
                        "trim('$_POST[tutor3_apellido]'), ".//apellido
                        "'1234', ".//password
                        "trim('$_POST[tutor3_ci]') ".//ci
                        ")";
                        if ($modo_depuracion) echo "$sql_temp<br>";
                        $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
                    //Se Verifica que el tutor3 nuevo no se encuentre en la tabla de usuario
                    if (!existe_en_bd($_POST[tutor3_usbid_nuevo],'usuario_miembro_usb','usbid_usuario')){
                        $sql_temp="INSERT INTO usuario_miembro_usb VALUES (".
                        "trim('$_POST[tutor3_usbid_nuevo]'), ".//usbid_usuario
                        "trim('$_POST[tutor3_dependencia]'), ".//dependencia
                        "'', ".//email secundario
                        "trim('$_POST[tutor3_tlf]'), ".//tlf
                        "trim('$_POST[tutor3_ci]')".//ci
                        ")";
                        if ($modo_depuracion) echo "$sql_temp<br>";
                        $resultado=ejecutarConsulta($sql_temp, $conexion);
                    }
                        $usbid_tutor3=$_POST[tutor3_usbid_nuevo];

                    }

                }
            } else {
                    $usbid_tutor3=$_POST[tutor3_usbid];
            }
        }
    } else {
                $usbid_tutor3=$_POST[tutor3_usbid];
        }	

    if ( !empty($usbid_tutor3) ){
            $sql_temp="INSERT INTO tutor_proy VALUES (".
            "'$usbid_tutor3', ".//usbid_usuario
            "'$id_proy' ".//id_proyecto	
            ")";
            if ($modo_depuracion) echo "$sql_temp<br>";
            $resultado=ejecutarConsulta($sql_temp, $conexion);	
    }
}

function eliminar_prop_tut($id_proy){    
    
    //Eliminamos primero el proponente
    $sql = "DELETE FROM proponente ";
    $sql.= " WHERE id_proyecto=".$id_proy;
    if ($modo_depuracion) echo "$sql<br>";
    ejecutarConsulta($sql, $conexion);	
    
    //Eliminamos los tutores
    $sql = "DELETE FROM tutor_proy ";
    $sql.= " WHERE id_proyecto=".$id_proy;
    if ($modo_depuracion) echo "$sql<br>";
    ejecutarConsulta($sql, $conexion);	
}




//----------------------------------------------------------------------------//
//---------------------------GUARDAR PROYECTO---------------------------------//
if( isset($accion) AND $accion == 'guardar_proyecto')
{
    //--------------------Validacion de los datos-----------------------------//
    
    //Validacion de proponentes    
    $datos_prop_vacio=true;
    $datos_prop_completo=true;
    $DATOS_PROPONENTE = array('prop_nombre','prop_apellido','prop_usbid_nuevo',
                               'prop_ci');
    
    foreach($DATOS_PROPONENTE as $value){
		if( !empty( $$value ) )
                    $datos_prop_vacio=false;
    }
    if (!empty($prop_carnet) OR !empty($prop_dependencia))
        $datos_prop_vacio=false;
    if (!empty($prop_usbid) AND !$datos_prop_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona un proponete de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_prop_vacio){
            foreach($DATOS_PROPONENTE as $value){
		if( empty( $$value ) )
                    $datos_prop_completo=false;
            }
            if (!$datos_prop_completo AND (empty($prop_carnet) OR empty($prop_dependencia)))
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del proponete en caso de no encontrarlo en la lista.';
            else
                if (!is_numeric($prop_ci)) 
                    $_ERRORES[] = 'Disculpe, error de formato de C&eacute;dula del proponente.';
                if (!$datos_prop_completo OR (!empty($prop_carnet) AND !empty($prop_dependencia)))
                    $_ERRORES[] = 'Disculpe, de los datos del proponete debe seleccionar Carnet o Dependencia.';
                else
                    if (!empty($prop_carnet) AND !comprobar_carnet($prop_carnet))
                        $_ERRORES[] = 'Disculpe, debe ingresar el carnet del tutor en el formato correcto.';
        }
            
    
    //Validacion de comunidad
    $datos_comuni_vacio=true;
    $datos_comuni_completo=true;
    $DATOS_COMUNIDAD = array('comuni_nombre','comuni_ubic','comuni_desc');
    
    foreach($DATOS_COMUNIDAD as $value){
		if( !empty( $$value ) )
                    $datos_comuni_vacio=false;
    }
    if (!empty($comuni_id) AND !$datos_comuni_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona una comunidad de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_comuni_vacio){
            foreach($DATOS_COMUNIDAD as $value){
		if( empty( $$value ) )
                    $datos_comuni_completo=false;
            }
            if (!$datos_comuni_completo)
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos de la comunidad en caso de no encontrarla en la lista.';
        }
    
    //Validacion de tutor1
    $datos_tutor1_vacio=true;
    $datos_tutor1_completo=true;
    $DATOS_TUTOR1 = array('tutor1_nombre','tutor1_apellido','tutor1_usbid_nuevo',
                          'tutor1_ci','tutor1_dependencia','tutor1_tlf');
    
    foreach($DATOS_TUTOR1 as $value){
		if( !empty( $$value ) )
                    $datos_tutor1_vacio=false;
    }
    if (!empty($tutor1_usbid) AND !$datos_tutor1_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona al tutor #1 de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_tutor1_vacio){
            foreach($DATOS_TUTOR1 as $value){
		if( empty( $$value ) )
                    $datos_tutor1_completo=false;
            }
            if (!$datos_tutor1_completo)
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del tutor #1 en caso de no encontrarlo en la lista.';
            else {
                if (!is_numeric($tutor1_ci))
                    $_ERRORES[] = 'Error de formato con la c&eacute;dula del tutor #1.';
                if (!comprobar_telefono($tutor1_tlf))
                    $_ERRORES[] = 'Error de formato con el tel&eacute;fono del tutor #1.';
                }
        }
    
    //Validacion de tutor2
    $datos_tutor2_vacio=true;
    $datos_tutor2_completo=true;
    $DATOS_TUTOR2 = array('tutor2_nombre','tutor2_apellido','tutor2_usbid_nuevo',
                          'tutor2_ci','tutor2_dependencia','tutor2_tlf');
    
    foreach($DATOS_TUTOR2 as $value){
		if( !empty( $$value ) )
                    $datos_tutor2_vacio=false;
    }
    if (!empty($tutor2_usbid) AND !$datos_tutor2_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona al tutor #2 de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_tutor2_vacio){
            foreach($DATOS_TUTOR2 as $value){
		if( empty( $$value ) )
                    $datos_tutor2_completo=false;
            }
            if (!$datos_tutor2_completo)
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del tutor #2 en caso de no encontrarlo en la lista.';
            else {
                if (!is_numeric($tutor2_ci))
                    $_ERRORES[] = 'Error de formato con la c&eacute;dula del tutor #2.';
                if (!comprobar_telefono($tutor2_tlf))
                    $_ERRORES[] = 'Error de formato con el tel&eacute;fono del tutor #2.';
                }
        }
    
    //Validacion de tutor3
    $datos_tutor3_vacio=true;
    $datos_tutor3_completo=true;
    $DATOS_TUTOR3 = array('tutor3_nombre','tutor3_apellido','tutor3_usbid_nuevo',
                          'tutor3_ci','tutor3_dependencia','tutor3_tlf');
    
    foreach($DATOS_TUTOR3 as $value){
		if( !empty( $$value ) )
                    $datos_tutor3_vacio=false;
    }
    if (!empty($tutor3_usbid) AND !$datos_tutor3_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona al tutor #3 de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_tutor3_vacio){
            foreach($DATOS_TUTOR3 as $value){
		if( empty( $$value ) )
                    $datos_tutor3_completo=false;
            }
            if (!$datos_tutor3_completo)
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del tutor #3 en caso de no encontrarlo en la lista.';
            else {
                if (!is_numeric($tutor3_ci))
                    $_ERRORES[] = 'Error de formato con la c&eacute;dula del tutor #3.';
                if (!comprobar_telefono($tutor3_tlf))
                    $_ERRORES[] = 'Error de formato con el tel&eacute;fono del tutor #3.';
                }
        }
    
    //Validacion de representante
    $datos_representante_vacio=true;
    $datos_representante_completo=true;
    $DATOS_REPRESENTANTE = array('rep_apellidos','rep_nombres','rep_ci',
                                 'rep_cel','rep_tlf','rep_inst','rep_dir',
                                 'rep_cargo','rep_email');
    
    foreach($DATOS_REPRESENTANTE as $value){
		if( !empty( $$value ) )
                    $datos_representante_vacio=false;
    }
    if (!empty($rep_id) AND !$datos_representante_vacio)
        $_ERRORES[] = 'Disculpe, si selecciona al representante de la lista, no debe especificar sus datos.';
    else 
        if (!$datos_representante_vacio){
            foreach($DATOS_REPRESENTANTE as $value){
		if( empty( $$value ) )
                    $datos_representante_completo=false;
            }
            if (!$datos_representante_completo)
                $_ERRORES[] = 'Disculpe, debe de ingresar todos los datos del representante en caso de no encontrarlo en la lista.';
            else {
                if (!is_numeric($rep_ci))
                    $_ERRORES[] = 'Error de formato con la c&eacute;dula del representante.';
                if (!comprobar_telefono($rep_tlf))
                    $_ERRORES[] = 'Error de formato con el tel&eacute;fono del representante.';
                if (!comprobar_telefono($rep_cel))
                    $_ERRORES[] = 'Error de formato con el celular del representante.';
                if (!comprobar_email($rep_email))
                    $_ERRORES[] = 'Error de formato con el email del representante.';
                }
        }
        
    if (!empty($_FILES['plan']['type']))
        $_WARNING[]="Dado que va a guardar el proyecto y a&uacute;n no ser&aacute; enviado, todav&iacute;a no se subir&aacute; el plan de aplicaci&oacute;n.";

    
    //----------------------------------------------------------------------------------------------//
    //---------------------SE AGREGA EL PROYECTO A GUARDAR EN LA BD---------------------------------//
    //----------------------------------------------------------------------------------------------//
    if(empty($_ERRORES)){

        
        if (isset($_SESSION[saved_proy][id_proyecto])) 
            $aux_id_proy=$_SESSION[saved_proy][id_proyecto];
        
        $id_comunidad=guardar_comunidad();
        $id_rep=guardar_representante();
        
        if (!isset($_SESSION[saved_proy][organizacion]) OR $_SESSION[saved_proy][organizacion]=='0')
            $id_org=guardar_organizacion();
        else
            $id_org=guardar_organizacion_viejo($_SESSION[saved_proy][organizacion]);
            
        if (!isset($_SESSION[saved_proy][usbid_postula])) 
            $aux_id_proy=guardar_proyecto_nuevo($id_comunidad,$id_rep,$id_org,'PENDIENTE');
        else
            guardar_proyecto_viejo($aux_id_proy,$id_comunidad,$id_rep,$id_org,'PENDIENTE');
        
        if (isset($_SESSION[saved_proy][id_proyecto])) 
            eliminar_prop_tut($aux_id_proy);
        guardar_proponente($aux_id_proy);   
        
        //Comparaciones entre tutores y proponente
        $Comparaciones_Con_tutor1= true;
        $Comparaciones_Con_tutor2= true;
        $Comparaciones_Con_tutor3= true;
        $Comparaciones_Con_tutor1=(($_POST[tutor1_usbid_nuevo]!==$_POST[tutor2_usbid_nuevo]) && 
                                ($_POST[tutor1_usbid_nuevo]!==$_POST[tutor3_usbid_nuevo]) && 
                                ($_POST[tutor1_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        $Comparaciones_Con_tutor2=(($_POST[tutor2_usbid_nuevo]!==$_POST[tutor1_usbid_nuevo]) && 
                                ($_POST[tutor2_usbid_nuevo]!==$_POST[tutor3_usbid_nuevo]) && 
                                ($_POST[tutor2_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        $Comparaciones_Con_tutor3=(($_POST[tutor3_usbid_nuevo]!==$_POST[tutor1_usbid_nuevo]) && 
                                ($_POST[tutor3_usbid_nuevo]!==$_POST[tutor2_usbid_nuevo]) && 
                                ($_POST[tutor3_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        
        guardar_tutor1($aux_id_proy,$Comparaciones_Con_tutor1);   
        guardar_tutor2($aux_id_proy,$Comparaciones_Con_tutor2);   
        guardar_tutor3($aux_id_proy,$Comparaciones_Con_tutor3);   
            

            
    $_SUCCESS[] = 'Se ha guardado el proyecto satisfactoriamente para una pr&oacute;xima modificaci&oacute;n.';



    } else {
        $_WARNING[] = 'No se logr&oacute; guardar el proyecto';
    }
}



//-----------------------------------------------------------------------------------//
//------------------------EL USUARIO DECIDE ENVIAR EL PROYECTO-----------------------//
//-----------------------------------------------------------------------------------//
if( isset($accion) AND $accion == 'agregar_proyecto')
{
    $DATOS_PROPONENTE = array();
    
    if (($prop_usbid=="") && 
           ($prop_nombre=="" && 
            $prop_apellido=="" &&
            $prop_usbid_nuevo=="" && 
            $prop_ci=="" )){ $_ERRORES[] = 'Debe especificar los datos del Proponente';}
        else {if (	($prop_usbid!="") &&
				( 
				$prop_nombre!="" || 
				$prop_apellido!="" ||
				$prop_usbid_nuevo!="" || 
				$prop_ci!="" || 
				$prop_carnet!="" ||
				$prop_dependencia!=""
				)
			){	
				 $_ERRORES[] ="Si selecciona un USBID de la lista, no debe especificar el resto de los campos del proponente";
			}else{
				 if (	($prop_usbid=="") &&
						( 
						$prop_nombre!="" || 
						$prop_apellido!="" ||
						$prop_usbid_nuevo!="" || 
						$prop_ci!="" ||
						$prop_carnet!="" ||
						$prop_dependencia!=""
						)
					){			
						if($prop_nombre==""){ 
							 $_ERRORES[] ="Debe especificar el nombre del Proponente";
						}
						if($prop_apellido==""){ 
							$_ERRORES[] ="Debe especificar el apellido del Proponente";
						}
						if($prop_usbid_nuevo==""){ 
							$_ERRORES[] ="Debe especificar el USBID del Proponente nuevo";
						}
                                                if($prop_ci=="" || !is_numeric($prop_ci)){ 
							$_ERRORES[] ="Debe especificar la cedula del Proponente en el formato correcto";
						}		
						if ($prop_carnet=="" && $prop_dependencia==""){
							$_ERRORES[] ="Debe especificar el Carnet o Dependencia del Proponente";	
						}else{
							if ($prop_carnet!="" && $prop_dependencia!=""){
							$_ERRORES[] ="No puede especificar carnet y dependencia del proponente a la vez";	
							}	
						}
                                                if ($prop_carnet==!"" && !comprobar_carnet($prop_carnet)) 
                                                        $_ERRORES[] ="Error al ingresar carnet del Proponente, verifique formato";
					}
			}
            
       }//fin de verificacion de los campos del proponente
       
       
       
       //Se verifica que los campos de la comunidad se llenen correctamente	
	 if (	($comuni_id=="") &&
	 		( 
			$comuni_nombre=="" && 
			$comuni_ubic=="" &&
			$comuni_desc==""
			)
	 	){	
		$_ERRORES[] ="Debe especificar los datos de la Comunidad Beneficiaria";
		}else{
			 if (	($comuni_id!="") &&
					( 
					$comuni_nombre!="" ||
					$comuni_ubic!="" ||
					$comuni_desc!=""
					)
				){		
				$_ERRORES[] ="Si selecciona una comunidad de la lista, no debe especificar el resto de los campos";
				}else{
					if (	($comuni_id=="") &&
							( 
							$comuni_nombre!="" || 
							$comuni_ubic!="" ||
							$comuni_desc!="" 
							)
					){	
						if($comuni_nombre==""){ 
							$_ERRORES[] ="Debe especificar el nombre de la Comunidad";
						}
						if($comuni_ubic==""){ 
							$_ERRORES[] ="Debe especificar la ubicacion de la Comunidad.";
						}
						if($comuni_desc==""){ 
							$_ERRORES[] ="Debe especificar la descripcion de la Comunidad.";
						}												
					}			
				}
        }//fin de verificacion de los campos de la comunidad
        
        
        //Se verifica que los campos del area del proyecto se llenen correctamente	
	if($area_proy=="" ){ 
		$_ERRORES[] ="Debe especificar el area del proyecto.";
	}	//fin de verificacion del area del proyecto	
	
	if($impacto==""){ 
		$_ERRORES[] ="Debe especificar el impacto Social del Proyecto.";
	}	
	if($cant_fem<1){ 
		$_ERRORES[] ="Debe especificar la cantidad de mujeres que beneficiar&aacute; el proyecto.";
	}  if (!is_numeric($cant_fem))
            $_ERRORES[] ="Error de formato en la cantidad de discapacitados que beneficiar&aacute; el proyecto.";	
	if($cant_masc<1){ 
		$_ERRORES[] ="Debe especificar la cantidad de hombres que beneficiar&aacute; el proyecto.";
	} if (!is_numeric($cant_masc))
            $_ERRORES[] ="Error de formato en la cantidad de discapacitados que beneficiar&aacute; el proyecto.";
	if($cant_disc<1){ 
		$_ERRORES[] ="Debe especificar la cantidad de discapacitados que beneficiar&aacute; el proyecto.";
	} if (!is_numeric($cant_disc))
            $_ERRORES[] ="Error de formato en la cantidad de discapacitados que beneficiar&aacute; el proyecto.";
        if($min_edad==""){ 
		$_ERRORES[] ="Debe especificar la edad m&iacute;nima de beneficiados por el proyecto.";
	}
        if($max_edad==""){ 
		$_ERRORES[] ="Debe especificar la edad m&aacute;xima de beneficiados por el proyecto.";
	}
        //Se verifica en Cantidad de Beneficiarios, que la edad maxima sea mayor que la minima
        if($min_edad!="" && $max_edad!=""){
            if ($min_edad>=$max_edad)
                $_ERRORES[] ="La edad m&aacute;xima de los beneficiados del proyecto, debe ser mayor que la m&iacute;nima.";
        }
	if($resumen==""){ 
		$_ERRORES[] ="Debe especificar el resumen del Proyecto";
	}	
        
        
        
        
//Se verifica que los campos de los tutores se llenen correctamente		
	 
        if (	($tutor1_usbid=="") && //todos estan vacios
			($tutor2_usbid=="") &&
			($tutor3_usbid=="") &&
			datos_vacios($tutor1_nombre,$tutor1_apellido,
                                     $tutor1_usbid_nuevo,$tutor1_ci,$tutor1_tlf,$tutor1_dependencia) &&
			datos_vacios($tutor2_nombre,$tutor2_apellido,
                                     $tutor2_usbid_nuevo,$tutor2_ci,$tutor2_tlf,$tutor2_dependencia) &&
			datos_vacios($tutor3_nombre,$tutor3_apellido,
                                     $tutor3_usbid_nuevo,$tutor3_ci,$tutor3_tlf,$tutor3_dependencia)
                ){
		$_ERRORES[] ="Debe especificar los datos de los tutores. Al menos uno.";		
		} else {
			if (	($tutor1_usbid=="") && //esta vacio el primero y alguno de los otros dos no.
					datos_vacios($tutor1_nombre,$tutor1_apellido, $tutor1_usbid_nuevo,
                                                     $tutor1_ci,$tutor1_tlf,$tutor1_dependencia) &&
					(
						($tutor2_usbid!="") ||
						!datos_vacios($tutor2_nombre,$tutor2_apellido,$tutor2_usbid_nuevo,
                                                              $tutor2_ci,$tutor2_tlf,$tutor2_dependencia) ||
						($tutor3_usbid!="") ||
						!datos_vacios($tutor3_nombre,$tutor3_apellido,$tutor3_usbid_nuevo,
                                                              $tutor3_ci,$tutor3_tlf,$tutor3_dependencia) 
					)
				){
				$_ERRORES[] ="Debe especificar los datos del primer tutor para llenar los datos de los siguientes tutores.";		
				}else{
					if (	($tutor1_usbid!="") && //el primero tiene el usbid seleccionado y alguno de los dem�s llenos
							!datos_vacios($tutor1_nombre,$tutor1_apellido, $tutor1_usbid_nuevo,
                                                                      $tutor1_ci,$tutor1_tlf,$tutor1_dependencia) 
						){
						$_ERRORES[] ="Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.";		
						}else{
							if (	($tutor1_usbid=="") && //el primero tiene el usbid vacio y no todos los dem�s llenos
									!datos_llenos($tutor1_nombre,$tutor1_apellido, $tutor1_usbid_nuevo,
                                                                                      $tutor1_ci,$tutor1_tlf,$tutor1_dependencia) 
								){ //Preguntar por cada uno de los campos nuevos
									if($tutor1_nombre==""){ 
										$_ERRORES[] ="Debe especificar el nombre del tutor 1.";
									}
									if($tutor1_apellido==""){ 
										$_ERRORES[] ="Debe especificar el apellido del tutor 1.";
									}
									if($tutor1_usbid_nuevo==""){ 
										$_ERRORES[] ="Debe especificar el email del tutor 1.";
									}
									if($tutor1_ci=="" || !is_numeric($tutor1_ci)){ 
										$_ERRORES[] ="Debe especificar la cedula del tutor 1, verifique el formato.";
									}
									if($tutor1_dependencia==""){ 
										$_ERRORES[] ="Debe especificar la dependencia del tutor 1.";
									}
									if($tutor1_tlf=="" || !comprobar_telefono($tutor1_tlf)){ 
										$_ERRORES[] ="Debe especificar el telefono del tutor 1, verifique el formato.";
									}
								}else{
								
								}
						}
				}
			if (	$tutor1_usbid!="" || datos_llenos($tutor1_nombre,$tutor1_apellido, $tutor1_usbid_nuevo,
                                                     $tutor1_ci,$tutor1_tlf,$tutor1_dependencia) ){ //los datos del tutor1 estan correctos
				
				//los datos del tutor2 no estan correctos
				if(
					$tutor2_usbid=="" && 
					!datos_llenos($tutor2_nombre,$tutor2_apellido, $tutor2_usbid_nuevo,
                                                     $tutor2_ci,$tutor2_tlf,$tutor2_dependencia)   && 
					!datos_vacios($tutor2_nombre,$tutor2_apellido, $tutor2_usbid_nuevo,
                                                     $tutor2_ci,$tutor2_tlf,$tutor2_dependencia) 
				){  // Preguntar por cada uno de los campos nuevos del tutor 2
						if($tutor2_nombre==""){ 
							$_ERRORES[] ="Debe especificar el nombre del tutor 2.";
						}
						if($tutor2_apellido==""){ 
							$_ERRORES[] ="Debe especificar el apellido del tutor 2.";
						}
						if($tutor2_usbid_nuevo==""){ 
							$_ERRORES[] ="Debe especificar el email del tutor 2.";
						}
						if($tutor2_ci=="" || !is_numeric($tutor2_ci)){ 
							$_ERRORES[] ="Debe especificar la cedula del tutor 2, verifique formato.";
						}
						if($tutor2_dependencia==""){ 
							$_ERRORES[] ="Debe especificar la dependencia del tutor 2.";
						}
						if($tutor2_tlf=="" || !comprobar_telefono($tutor2_tlf)){ 
							$_ERRORES[] ="Debe especificar el telefono del tutor 2, verifique formato.";
						}				
				}else{
					if(
						$tutor2_usbid!="" && !datos_vacios($tutor2_nombre,$tutor2_apellido, $tutor2_usbid_nuevo,
                                                                $tutor2_ci,$tutor2_tlf,$tutor2_dependencia)   //los datos del tutor2 no estan correctos
					){
						$_ERRORES[] ="Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.";							
					}else{
						//los datos del tutor3 no estan correctos
							if(
								$tutor3_usbid=="" && 
								!datos_llenos($tutor3_nombre,$tutor3_apellido, $tutor3_usbid_nuevo,
                                                                $tutor3_ci,$tutor3_tlf,$tutor3_dependencia)   &&
								!datos_vacios($tutor3_nombre,$tutor3_apellido, $tutor3_usbid_nuevo,
                                                                $tutor3_ci,$tutor3_tlf,$tutor3_dependencia) 
								//los datos del tutor3 no estan correctos
							){  // Preguntar por cada uno de los campos nuevos del tutor 3
									if($tutor3_nombre==""){ 
										$_ERRORES[] ="Debe especificar el nombre del tutor 3";
									}
									if($tutor3_apellido==""){ 
										$_ERRORES[] ="Debe especificar el apellido del tutor 3";
									}
									if($tutor3_usbid_nuevo==""){ 
										$_ERRORES[] ="Debe especificar el email del tutor 3";
									}
									if($tutor3_ci=="" || !is_numeric($tutor3_ci)){ 
										$_ERRORES[] ="Debe especificar la cedula del tutor 3";
									}
									if($tutor3_dependencia==""){ 
										$_ERRORES[] ="Debe especificar la dependencia del tutor 3";
									}
									if($tutor3_tlf=="" || !comprobar_telefono($tutor3_tlf)){ 
										$_ERRORES[] ="Debe especificar el telefono del tutor 3";
									}				
							}else{ 
								if(
									$tutor3_usbid!="" && !datos_vacios($tutor3_nombre,$tutor3_apellido, $tutor3_usbid_nuevo,
                                                                                              $tutor3_ci,$tutor3_tlf,$tutor3_dependencia)   //los datos del tutor3 no estan correctos
								){
									$_ERRORES[] ="Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.";							
								}
							}
						}
				}
			}		
        }//fin de verificacion de los campos de los tutores        
        
        
    //Area de trabajo
    if($area_trabajo==""){ 
		$_ERRORES[] ="Debe especificar el area de Trabajo";
	}	


    //Se verifica que los campos del representante se llenen correctamente
	 if (	($rep_id=="") &&
	 		( 
                        $rep_nombres=="" && 
                        $rep_apellidos=="" && 
                        $rep_inst=="" && 
                        $rep_dir=="" && 
                        $rep_cargo=="" && 
                        $rep_email=="" && 
                        $rep_tlf=="" && 
                        $rep_cel=="" && 
                        $rep_ci==""
                        )
	 	){
		$_ERRORES[] ="Debe especificar los datos del Representante";
		}else{
		 if (	($rep_id!="") &&
				( 
                                 $rep_nombres!=="" ||
                                 $rep_apellidos!=="" ||
                                 $rep_inst!=="" || 
                                 $rep_dir!=="" ||
                                 $rep_cargo!=="" || 
                                 $rep_email!=="" ||
                                 $rep_tlf!=="" || 
                                 $rep_cel!=="" ||
                                 $rep_ci!==""
				)
			){	
				$_ERRORES[] ="Si selecciona un Representante de la lista, no debe especificar el resto de los campos del representante";
			}else{
				 if (	($rep_id=="") &&
						( 
                                                $rep_nombres=="" ||
                                                $rep_apellidos=="" ||
                                                $rep_inst=="" || 
                                                $rep_dir=="" ||
                                                $rep_cargo=="" || 
                                                $rep_email=="" ||
                                                $rep_tlf=="" || 
                                                $rep_cel=="" ||
                                                $rep_ci==""
						)
					){			
						if($rep_nombres==""){ 
							$_ERRORES[] ="Debe especificar el nombre del Representante.";
						}
						if($rep_apellidos==""){ 
							$_ERRORES[] ="Debe especificar el apellido del Representante.";
						}
						if($rep_inst==""){ 
							$_ERRORES[] ="Debe especificar la institucion del Representante.";
						}	
						if($rep_dir==""){ 
							$_ERRORES[] ="Debe especificar la direccion del Representante.";
						}		
						if ($rep_cargo==""){
							$_ERRORES[] ="Debe especificar el cargo del Representante.";	
						}
						if ($rep_email==""){
                                                        $_ERRORES[] ="Debe especificar el email del Representante.";	
						}else if (!comprobar_email($rep_email)) 
                                                        $_ERRORES[] ="Error al ingresar email del Representante, verifique formato.";				
						if($rep_tlf=="" ){ 
							$_ERRORES[] ="Debe especificar el telefono del Representante, verifique formato.";
						}else if (!comprobar_telefono($rep_tlf)) 
                                                        $_ERRORES[] ="Error al ingresar telefono del Representante, verifique formato.";			
						if ($rep_cel==""){
                                                        $_ERRORES[] ="Debe especificar el celular del Representante.";	
						} else if (!comprobar_telefono($rep_cel)) 
                                                        $_ERRORES[] ="Error al ingresar celular del Representante, verifique formato.";	
						if ($rep_ci==""){
                                                        $_ERRORES[] ="Cedula de identidad del Representante.";	
						} else if (!is_numeric($rep_ci)) 
                                                        $_ERRORES[] ="Error al ingresar la cedula del Representante, verifique formato.";	
					}
			}
		}//fin de verificacion de los campos del representante
        if($org_email!="" && !comprobar_email($org_email)){ 
		$_ERRORES[] ="Error de formato al ingresar el correo de la organizaci&oacute;n";
	}
        if($org_tlf!="" && !comprobar_telefono($org_tlf)){ 
		$_ERRORES[] ="Error de formato al ingresar el tel&eacute;fono de la organizaci&oacute;n";
	}
        if($org_fax!="" && !comprobar_telefono($org_fax)){ 
		$_ERRORES[] ="Error de formato al ingresar el fax de la organizaci&oacute;n";
	}
        if($antecedentes==""){ 
		$_ERRORES[] ="Debe especificar los antecedentes del proyecto";
	}	
	if($obj_gral==""){ 
		$_ERRORES[] ="Debe especificar el Objetivo General del proyecto";
	}	
	if($obj_esp==""){ 
		$_ERRORES[] ="Debe especificar los Objetivos Especif&iacute;cos del proyecto";
	}
	if($desc==""){ 
		$_ERRORES[] ="Debe especificar la descripci&oacute;n del proyecto";
	}	
	if($act_esp==""){ 
		$_ERRORES[] ="Debe especificar las actividades especif&iacute;cas del estudiante";
	}
	if($perfil==""){ 
		$_ERRORES[] ="Debe especificar el Perfil Curricular";
	}	
	if($recursos==""){ 
		$_ERRORES[] ="Debe especificar los recursos requeridos";
	}
	if($logros==""){ 
		$_ERRORES[] ="Debe especificar los logros sociales";
	}	
	if($directrices==""){ 
		$_ERRORES[] ="Debe especificar las directrices y valores ";
	}	
	if($magnitud==""){ 
		$_ERRORES[] ="Debe especificar la magnitud del proyecto";
	}	
	if($participacion==""){ 
		$_ERRORES[] ="Debe especificar la participaci&oacute;n de miembros de la comunidad";
	}	
        if(empty($_FILES['plan']['type'])){ 
		$_ERRORES[] ="Debe especificar el plan de aplicacion";
	} else {if ($_FILES['plan']['type']<>"application/pdf" ){
                $_ERRORES[] ="El plan de aplicacion no estaba en formato PDF, por favor vuelva a intentarlo.";
            }
        }
	if($formacion_req==""){ 
		$_ERRORES[] ="Debe especificar si se requiere Formaci&oacute;n especif&iacute;ca";
	}
        if($formacion_req=="si" && $horas=="0"){ 
		$_ERRORES[] ="Si Requiere formacion especifica debe especificar el numero de horas acreditables";
	}
        if($formacion_req=="no" && $horas>"0"){ 
            $_ERRORES[] ="Si NO Requiere formacion especifica especificar, NO debe especificar el numero de horas acreditables";
        }
            
        
        

//----------------------------------------------------------------------------------------------//
//-------------------------SE AGREGA EL PROYECTO EN LA BD---------------------------------------//
//----------------------------------------------------------------------------------------------//
    if(empty($_ERRORES)){
        $modo_depuracion=false;
        
        
        if (isset($_SESSION[saved_proy][id_proyecto])) 
            $aux_id_proy=$_SESSION[saved_proy][id_proyecto];
        
        $id_comunidad=guardar_comunidad();
        $id_rep=guardar_representante();
        
        if (!isset($_SESSION[saved_proy][organizacion]) OR $_SESSION[saved_proy][organizacion]=='0')
            $id_org=guardar_organizacion();
        else
            $id_org=guardar_organizacion_viejo($_SESSION[saved_proy][organizacion]);
            
        if (!isset($_SESSION[saved_proy][usbid_postula])) 
            $aux_id_proy=guardar_proyecto_nuevo($id_comunidad,$id_rep,$id_org,'POSTULADO');
        else
            guardar_proyecto_viejo($aux_id_proy,$id_comunidad,$id_rep,$id_org,'POSTULADO');
        
        if (isset($_SESSION[saved_proy][id_proyecto])) 
            eliminar_prop_tut($aux_id_proy);
        
        guardar_proponente($aux_id_proy);   

        //Comparaciones entre tutores y proponente
        $Comparaciones_Con_tutor1= true;
        $Comparaciones_Con_tutor2= true;
        $Comparaciones_Con_tutor3= true;
        $Comparaciones_Con_tutor1=(($_POST[tutor1_usbid_nuevo]!==$_POST[tutor2_usbid_nuevo]) && 
                                ($_POST[tutor1_usbid_nuevo]!==$_POST[tutor3_usbid_nuevo]) && 
                                ($_POST[tutor1_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        $Comparaciones_Con_tutor2=(($_POST[tutor2_usbid_nuevo]!==$_POST[tutor1_usbid_nuevo]) && 
                                ($_POST[tutor2_usbid_nuevo]!==$_POST[tutor3_usbid_nuevo]) && 
                                ($_POST[tutor2_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        $Comparaciones_Con_tutor3=(($_POST[tutor3_usbid_nuevo]!==$_POST[tutor1_usbid_nuevo]) && 
                                ($_POST[tutor3_usbid_nuevo]!==$_POST[tutor2_usbid_nuevo]) && 
                                ($_POST[tutor3_usbid_nuevo]!==$_POST[prop_usbid_nuevo]));
        
        guardar_tutor1($aux_id_proy,$Comparaciones_Con_tutor1);   
        guardar_tutor2($aux_id_proy,$Comparaciones_Con_tutor2);   
        guardar_tutor3($aux_id_proy,$Comparaciones_Con_tutor3);
        
        //Se inserta el archivo en la tabla plan_proy
        $nombreDirectorio = "upload/plan_aplicacion/";
        $nombreFichero = $aux_id_proy . ".pdf";
        if ($modo_depuracion) echo $nombreFichero;
        move_uploaded_file ($_FILES['plan']['tmp_name'], $nombreDirectorio . $nombreFichero);
        
        $DATOS_PROYECTO= array('prop_usbid','prop_nombre','prop_apellido','prop_usbid_nuevo','prop_ci','prop_carnet','prop_dependencia',
            'comuni_id','comuni_nombre','comuni_ubic','comuni_desc','titulo','area_proy','impacto','cant_fem','cant_masc','cant_disc',
            'min_edad','max_edad','resumen','tutor1_usbid','tutor1_nombre','tutor1_apellido','tutor1_usbid_nuevo','tutor1_ci',
            'tutor1_dependencia','tutor1_tlf','tutor2_usbid','tutor2_nombre','tutor2_apellido','tutor2_usbid_nuevo','tutor2_ci',
            'tutor2_dependencia','tutor2_tlf','tutor3_usbid','tutor3_nombre','tutor3_apellido','tutor3_usbid_nuevo','tutor3_ci',
            'tutor3_dependencia','tutor3_tlf','area_trabajo','rep_id','rep_apellidos','rep_nombres','rep_ci','rep_cel','rep_tlf',
            'rep_inst','rep_dir','rep_cargo','rep_email','org_nombre','org_dir','org_email','org_tlf','org_fax','antecedentes',
            'obj_gral','obj_esp','desc','act_esp','perfil','recursos','logros','directrices','magnitud','participacion','formacion_req',
            'formacion_esp','horas');
    
        foreach($DATOS_PROYECTO as $value){
		$_POST[$value]="";
        }
        
        unset($_SESSION[saved_proy]);
        
        $_SUCCESS[] = 'Se ha agregado el proyecto satisfactoriamente';
    } else {
        $_WARNING[] = 'No se logr&oacute; agregar el proyecto';
    }
}
include('vAgregarProyecto2.php');

cerrarConexion($conexion);

?>