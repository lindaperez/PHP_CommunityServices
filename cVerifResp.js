function verificar(){
	var error=false;
	var aviso="";
	var texto="";
	var texto2="";	
    d=document.datos;

if (	
	d.frecuencia.value=="" || 
	d.email_to.value=="" 
	)
	{			
		if(d.frecuencia.value==""){ 
			error=true; 	
			texto=texto+"-Frecuencia<br/>";
		}
		if(d.email_to.value==""){ 
			error=true; 	
			texto=texto+"-Correo<br/>";
		}
	}	

if(!error){
     	d.submit();
}else{
	   if(texto2!=""){
		   	aviso="<br/>Se detectaron los siguientes errores:<br/>"+texto2;	
	   }
	   if(texto!=""){
		   aviso=aviso+"<br/>Debe completar los siguientes campos:<br/>"+texto;
	   }
        $.prompt(aviso,{show:'slideDown'});
	}
}
