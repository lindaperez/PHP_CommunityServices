
function verificar(){
	var error=false;
	var texto="";
	
     	d=document.datos;

	if(d.informe.value==""){ 
		error=true; 	
		texto=texto+"- Archivo de Informe Final<br/>";
	}	


	if(!error){
		d.submit();
	}else{
		texto="Debe completar los siguientes campos:<br/>"+texto;
		$.prompt(texto,{show:'slideDown'});
	}
}
