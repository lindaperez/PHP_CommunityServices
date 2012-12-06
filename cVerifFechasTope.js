
function verificar(){
    
    var error=false;
    var texto="";
    var aviso="";
    var texto2="";

    d=document.datos;

    if(d.evento.value=="seleccione"){
        error = true;
        texto=texto+"- Evento.<br/>";
    }
    
    if(d.desde1.value==""){
        error = true;
        texto=texto+"- Fecha Inicio.<br/>";
    }
        
    if(d.hasta1.value==""){
        error = true;
        texto=texto+"- Fecha Fin.<br/>";
    }
    
    /*if(d.desde1.value>d.hasta1.value && d.hasta1.value!="" && d.desde1.value!=""){
        error = true;
        texto2=texto2+"- Fecha Fin es mayor a Fecha Inicio<br/>";
    }*/
    
    if(!error){
        d.submit();
    }else{
        if(texto2!=""){
            aviso="<br/>Se detectaron los siguientes errores:<br/>"+texto2;	
        }
        if(texto!=""){
            aviso=aviso+"<br/>Debe completar los siguientes campos:<br/>"+texto;
        }
        $.prompt(aviso, {show:'slideDown'});
    }


}

