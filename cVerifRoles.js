function verificar(){
    var error=false;
    var aviso="";
    var texto="";
    var texto2="";

    d=document.datos;

    

    //Se verifican que los campos no esten vacios
     if(d.usbid_coor.value==""){
        error=true;     
        texto=texto+"-Usbid Coordinador<br/>";
    }

    if(d.nombre_coor.value==""){
        error=true;     
        texto=texto+"-Nombre Coordinador<br/>";
    }

    if(d.apellido_coor.value==""){
        error=true;     
        texto=texto+"-Apellido Coordinador<br/>";
    }

    if(d.usbid_asistente.value==""){
        error=true;     
        texto=texto+"-Usbid Asistente<br/>";
    }

    if(d.nombre_asistente.value==""){
        error=true;     
        texto=texto+"-Nombre Asistente<br/>";
    }
    
    if(d.apellido_asistente.value==""){
        error=true;     
        texto=texto+"-Apellido Asistente<br/>";
    }

    if(d.usbid_secretaria.value==""){
        error=true;
        texto=texto+"-Usbid Secretaria Programa Atencion al Profesor<br/>";
    }

    if(d.nombre_secretaria.value==""){
        error=true;
        texto=texto+"-Nombre Secretaria Programa Atencion al Profesor<br/>";
    }

    if(d.apellido_secretaria.value==""){
        error=true;
        texto=texto+"-Apellido Secretaria Programa Atencion al Profesor<br/>";
    }
    
     if(d.usbid_coor_lit.value==""){
        error=true;     
        texto=texto+"-Usbid Coordinador Litoral<br/>";
    }

    if(d.nombre_coor_lit.value==""){
        error=true;     
        texto=texto+"-Nombre Coordinador Litoral<br/>";
    }

    if(d.apellido_coor_lit.value==""){
        error=true;     
        texto=texto+"-Apellido Coordinador Litoral<br/>";
    }

    if(d.usbid_asistente_lit.value==""){
        error=true;     
        texto=texto+"-Usbid Asistente Litoral<br/>";
    }

    if(d.nombre_asistente_lit.value==""){
        error=true;     
        texto=texto+"-Nombre Asistente Litoral<br/>";
    }
    
    if(d.apellido_asistente_lit.value==""){
        error=true;     
        texto=texto+"-Apellido Asistente Litoral<br/>";
    }

    if(d.usbid_secretaria_lit.value==""){
        error=true;
        texto=texto+"-Usbid Secretaria Litoral<br/>";
    }

    if(d.nombre_secretaria_lit.value==""){
        error=true;
        texto=texto+"-Nombre Secretaria Litoral<br/>";
    }

    if(d.apellido_secretaria_lit.value==""){
        error=true;
        texto=texto+"-Apellido Secretaria Litoral<br/>";
    }


  /******************* Se muestran los errores *****************/
    if(!error){
        $.prompt('Esta seguro de enviar esta información?.', 
        { buttons: { Si: true, No: false}, show:'slideDown' , submit: function (e,v,m,f){  
                if (v) d.submit(); else $.prompt.close(); }  });
        //}
    }else{

        if(texto!=""){
            aviso=aviso+"<br/>Debe completar los siguientes campos:<br/>"+texto;
        }
        $.prompt(aviso, {show:'slideDown'});
    }

}