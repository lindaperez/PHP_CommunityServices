function agregarAct(){
	tabla=document.getElementById("tabla_actividades");
	numFilas=tabla.rows.length;
	fila=tabla.insertRow(numFilas);
        
	fila.insertCell(0).innerHTML="<span class='rojo'>*</span><input type='text' name='actividad"+numFilas+"' id='actividad' maxlength=254>";
	fila.insertCell(1).innerHTML="<span class='rojo'>*</span><input type='text' name='fecha"+numFilas+"'>";
	fila.insertCell(2).innerHTML="<span class='rojo'>*</span><input type='text' name='horas"+numFilas+"'  size='3'>";
	fila.insertCell(3).innerHTML="<a href='javascript: eliminarAct("+numFilas+")'><img src='imagenes/iconos/remove4.png' width='20' height='20'  alt='Eliminar' title='Eliminar' border=0 /></a>";
}

function eliminarAct(fila){
    tabla=document.getElementById("tabla_actividades");
    if(tabla.rows.length!=1){
        tabla.deleteRow(fila);
        for(i=1;i<tabla.rows.length;i++){
            tabla.rows[i].cells[3].innerHTML="<a href='javascript: eliminarAct("+i+")'><img src='imagenes/iconos/remove4.png' width='20' height='20'  alt='Eliminar' title='Eliminar' border=0 /></a>";
        }
    }else{
        $.prompt('El proyecto debe tener al menos una actividad.', {show:'slideDown'});
    }
}
//Util para decir cual es la actividad con el problema
num_act;
function datos_plan_vacios(){
    	d=document.datos;
	//se verifica que los grupos (actividad, fecha y horas) esten siempre llenos 
	
	var campos = document.getElementById("datos").elements;
	var n=campos.length; //numero de elementos del formulario

	//el elemento n es el boton de enviar 
	//el elemento n-1 es el boton de imprimir
	//el elemento n-2 es el boton de agregar mas actividades

	var pos=12; //posicion de la primera celda a verificar
	var grupos=(n-2-pos)/3; // cantidad de grupos (actividad, fecha y hora)
	var i=0; //contador
	var error=false;

	while(grupos>0){
		if  ( 	(campos[pos+i].value=="") ||
			(campos[pos+i+1].value=="") ||
			(campos[pos+i+2].value=="" || isNaN(campos[pos+i+2].value) )      )
		{
			error=true;
                        num_act=i/3+1;
		}
		i=i+3;
		grupos=grupos-1;
	}
	return error;
}

function actividad_plan_repetida(){
    	d=document.datos;
	//se verifica que los grupos (actividad, fecha y horas) esten siempre llenos 
	
	var campos = document.getElementById("datos").elements;
	var n=campos.length; //numero de elementos del formulario

	//el elemento n es el boton de enviar 
	//el elemento n-1 es el boton de imprimir
	//el elemento n-2 es el boton de agregar mas actividades

	var pos=12; //posicion de la primera celda a verificar
	var grupos=(n-2-pos)/3; // cantidad de grupos (actividad, fecha y hora)
	var grupos2=((n-2-pos)/3)-1;
        var i=0; //contador
        var j=0;
	var error=false;

	while(grupos>0){
            j=i+3;
            grupos2=grupos-1;
            while(grupos2>0){
                if  ( 	
			(campos[pos+i].value!="" && campos[pos+i].value==campos[pos+j].value) )
		{
			error=true;
		}
            j=j+3;
            grupos2=grupos2-1;   
            }
            i=i+3;
            grupos=grupos-1;
	}
	return error;
}

function verificar(){

	var error=false;
	var aviso="";
	var texto="";
	d=document.datos;

	 if (d.ci.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su numero de cédula\n<br/>";
	}else{
		if (isNaN(d.ci.value)){
			error=true; 	
			texto=texto+"-El número de cédula no puede contener puntos, letras ni guiones, sólo números\n<br/>";
		}		
	}
	if (d.email_sec.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su email secundario\n<br/>";		
	}else{
		if (d.email_sec.value.indexOf("@")=="-1") {
			error=true;
			texto=texto+"-Debe especificar una dirección de email válida.\n<br/>";

		}else{
			if (d.email_sec.value.indexOf(".")=="-1"){
				error=true;
				texto=texto+"-Debe especificar una dirección de email válida.\n<br/>";
			}	
		}
	}
	if (d.tutor.value=="ninguno") {
		error=true; 	
		texto=texto+"-Debe elegir uno de los tutores de la lista\n<br/>";		
	}

	if (d.tlf_hab.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar el número de teléfono de habitación\n<br/>";
	}
	if (d.tlf_cel.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar el número de teléfono celular\n<br/>";
	}
	if (d.dir.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su dirección\n<br/>";
	}
	if (d.objetivos.value=="") {
		error=true; 	
		texto=texto+"-Debe indicar los objetivos específicos\n<br/>";
	}					
	if (datos_plan_vacios()){
		error=true; 	
		texto=texto+"-Debe especificar completamente la actividad # "+num_act+". Incluyendo fecha y horas acreditables, verifique formato.\n<br/>";				
	}
	if (actividad_plan_repetida()){
		error=true; 	
		texto=texto+"-Disculpe, pero ha repetido una actividad.\n<br/>";				
	}


	if(!error){
		//if (confirm("Una vez enviados los datos, no se podrán modificar.\nRevise cuidadosamente cada uno de los datos.\nRecuerde que debe imprimir y entregar la planilla para completar su inscripción.\nEstá seguro que desea continuar?")){
		$.prompt('Una vez enviados los datos, no se podrán modificar.\n<br/>Revise cuidadosamente cada uno de los datos.\n<br/>Recuerde que debe imprimir y entregar la planilla para completar su inscripción.\n<br/><br/>Está seguro que desea continuar?',
                { buttons: { Aceptar: true, Cancelar: false }, show:'slideDown' , submit: function (e,v,m,f){  if (v) d.submit() }  })
			//d.submit();
		
	}else{
	   if(texto!=""){
		   	aviso="\nSe detectaron los siguientes errores:\n\n<br/><br/>"+texto;	
	   }

        $.prompt(aviso, {show:'slideDown'});
	}
  
}

function verificar2(){

	var error=false;
	var aviso="";
	var texto="";
	d=document.datos;

	 if (d.ci.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su numero de cédula\n<br/>";
	}else{
		if (isNaN(d.ci.value)){
			error=true; 	
			texto=texto+"-El número de cédula no puede contener puntos, letras ni guiones, sólo números\n<br/>";
		}		
	}
	if (d.email_sec.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su email secundario\n<br/>";		
	}else{
		if (d.email_sec.value.indexOf("@")=="-1") {
			error=true;
			texto=texto+"-Debe especificar una dirección de email válida.\n<br/>";

		}else{
			if (d.email_sec.value.indexOf(".")=="-1"){
				error=true;
				texto=texto+"-Debe especificar una dirección de email válida.\n<br/>";
			}	
		}
	}
	if (d.tutor.value=="ninguno") {
		error=true; 	
		texto=texto+"-Debe elegir uno de los tutores de la lista\n<br/>";		
	}

	if (d.tlf_hab.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar el número de teléfono de habitación\n<br/>";
	}
	if (d.tlf_cel.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar el número de teléfono celular\n<br/>";
	}
	if (d.dir.value=="") {
		error=true; 	
		texto=texto+"-Debe especificar su dirección\n<br/>";
	}
	if (d.objetivos.value=="") {
		error=true; 	
		texto=texto+"-Debe indicar los objetivos específicos\n<br/>";
	}					
	if (datos_plan_vacios()){
		error=true; 	
		texto=texto+"-Debe especificar completamente la actividad # "+num_act+". Incluyendo fecha y horas acreditables, verifique formato.\n<br/>";				
	}
	if (actividad_plan_repetida()){
		error=true; 	
		texto=texto+"-Disculpe, pero ha repetido una actividad.\n<br/>";				
	}


	if(!error){
		//if (confirm("Una vez enviados los datos, no se podrán modificar.\nRevise cuidadosamente cada uno de los datos.\nRecuerde que debe imprimir y entregar la planilla para completar su inscripción.\nEstá seguro que desea continuar?")){
		$.prompt('¿Está seguro que desea modificar la inscripcion?.\n<br/>',
                { buttons: { Aceptar: true, Cancelar: false }, show:'slideDown' , submit: function (e,v,m,f){  if (v) d.submit() }  })
			//d.submit();
		
	}else{
	   if(texto!=""){
		   	aviso="\nSe detectaron los siguientes errores:\n\n<br/><br/>"+texto;	
	   }

        $.prompt(aviso, {show:'slideDown'});
	}
  
}
