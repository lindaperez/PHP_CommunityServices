
function verificar(){
	var error=false;
	var texto="";
	
     	d=document.datos;

	if(d.ci.value==""){ 
		error=true; 	
		texto=texto+"- C�dula de Identidad\n";
	}	
	if(d.dependencia.value==""){ 
		error=true; 	
		texto=texto+"- Dependencia dentro de la USB\n";
	}
	if(d.email_sec.value==""){ 
		error=true; 	
		texto=texto+"- Email Secundario\n";
	}
	if(d.telf.value==""){ 
		error=true; 	
		texto=texto+"- Tel�fono de Oficina\n";
	}
	if(d.cel.value==""){ 
		error=true; 	
		texto=texto+"- Tel�fono Celular\n";
	}
	if(!error){
		d.submit();
	}else{
		texto="Debe completar los siguientes campos:\n"+texto;
		alert(texto);
	}
}
