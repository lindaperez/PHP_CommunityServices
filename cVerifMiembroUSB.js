function verificar(){
	var error=false;
	var aviso="";
	var texto="";
	var texto2="";	
     d=document.datos;

if (	
	d.nombre.value=="" || 
	d.apellido.value=="" ||
	d.usbid.value=="" || 
	d.ci.value=="" ||
	d.tipo.value==""
	)
	{			
		if(d.nombre.value==""){ 
			error=true; 	
			texto=texto+"-Nombre del Miembro USB<br/>";
		}
		if(d.apellido.value==""){ 
			error=true; 	
			texto=texto+"-Apellido del Miembro USB<br/>";
		}
		if(d.usbid.value==""){ 
			error=true; 	
			texto=texto+"-USBID del Miembro USB<br/>";
		}	
		if(d.ci.value==""){ 
			error=true; 	
			texto=texto+"-Cédula del Miembro USB<br/>";
		}		
		if (d.tipo.value==""){
			error=true; 	
			texto=texto+"-Tipo de Miembro USB<br/>";	
		}
	}
if (d.tipo.value=="administrativos" || d.tipo.value=="profesores") {

	if (d.dep.value==""){
		error=true; 	
		texto2=texto2+"-Si es profesor o empleado, debe especificar la dependencia<br/>";	
	}
	if (d.email_sec.value==""){
		error=true; 	
		texto2=texto2+"-Si es profesor o empleado, debe especificar el email secundario<br/>";	
	}
	if (d.tlf_ofic.value==""){
		error=true; 	
		texto2=texto2+"-Si es profesor o empleado, debe especificar el telf de ofic<br/>";	
	}
	if (d.cel.value==""){
		error=true; 	
		texto2=texto2+"-Si es profesor o empleado, debe especificar el telf celular<br/>";	
	}
}	
if (d.tipo.value=="pregrado") {
	if (d.carrera.value==""){
		error=true; 	
		texto2=texto2+"-Si es estudiante, debe especificar la carrera<br/>";	
	}	
	if (d.email_sec_est.value==""){
		error=true; 	
		texto2=texto2+"-Si es estudiante, debe especificar el email secundario<br/>";	
	}
	if (d.sexo.value==""){
		error=true; 	
		texto2=texto2+"-Si es estudiante, debe especificar el sexo<br/>";	
	}
	if (d.tlf_hab.value==""){
		error=true; 	
		texto2=texto2+"-Si es estudiante, debe especificar el telf habitacion<br/>";	
	}
	if (d.cel_est.value==""){
		error=true; 	
		texto2=texto2+"-Si es estudiante, debe especificar el telf celular<br/>";	
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
