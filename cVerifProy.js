function datos_tutor1_vacios(){
    d=document.datos;
	if(	d.tutor1_nombre.value=="" &&
		d.tutor1_apellido.value=="" &&
		d.tutor1_usbid_nuevo.value=="" &&
		d.tutor1_ci.value=="" &&
		d.tutor1_dependencia.value=="" &&
		d.tutor1_tlf.value=="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function datos_tutor2_vacios(){
    d=document.datos;
	if(	d.tutor2_nombre.value=="" &&
		d.tutor2_apellido.value=="" &&
		d.tutor2_usbid_nuevo.value=="" &&
		d.tutor2_ci.value=="" &&
		d.tutor2_dependencia.value=="" &&
		d.tutor2_tlf.value=="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function datos_tutor3_vacios(){
    d=document.datos;
	if(	d.tutor3_nombre.value=="" &&
		d.tutor3_apellido.value=="" &&
		d.tutor3_usbid_nuevo.value=="" &&
		d.tutor3_ci.value=="" &&
		d.tutor3_dependencia.value=="" &&
		d.tutor3_tlf.value=="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function datos_tutor1_llenos(){
    d=document.datos;
	if(	d.tutor1_nombre.value!="" &&
		d.tutor1_apellido.value!="" &&
		d.tutor1_usbid_nuevo.value!="" &&
		d.tutor1_ci.value!="" &&
		d.tutor1_dependencia.value!="" &&
		d.tutor1_tlf.value!="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function datos_tutor2_llenos(){
    d=document.datos;
	if(	d.tutor2_nombre.value!="" &&
		d.tutor2_apellido.value!="" &&
		d.tutor2_usbid_nuevo.value!="" &&
		d.tutor2_ci.value!="" &&
		d.tutor2_dependencia.value!="" &&
		d.tutor2_tlf.value!="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function datos_tutor3_llenos(){
    d=document.datos;
	if(	d.tutor3_nombre.value!="" &&
		d.tutor3_apellido.value!="" &&
		d.tutor3_usbid_nuevo.value!="" &&
		d.tutor3_ci.value!="" &&
		d.tutor3_dependencia.value!="" &&
		d.tutor3_tlf.value!="" 
	){ 
		return true; 	
	}else{
		return false; 	
	}
}
function verificar(){
	var error=false;
	var aviso="";
	var texto="";
	var texto2="";	
     d=document.datos;
//Se verifica que los campos del proponente se llenen correctamente
	 if (	(d.prop_usbid.value=="") &&
	 		( 
			d.prop_nombre.value=="" && 
			d.prop_apellido.value=="" &&
			d.prop_usbid_nuevo.value=="" && 
			d.prop_ci.value=="" 
			)
	 	){
		error=true; 	
		texto2=texto2+"-Debe especificar los datos del Proponente<br/>";		
		}else{
		 if (	(d.prop_usbid.value!="") &&
				( 
				d.prop_nombre.value!="" || 
				d.prop_apellido.value!="" ||
				d.prop_usbid_nuevo.value!="" || 
				d.prop_ci.value!="" || 
				d.prop_carnet.value!="" ||
				d.prop_dependencia.value!=""
				)
			){	
				error=true; 	
				texto2=texto2+"-Si selecciona un USBID de la lista, no debe especificar el resto de los campos del proponente<br/>";
			}else{
				 if (	(d.prop_usbid.value=="") &&
						( 
						d.prop_nombre.value!="" || 
						d.prop_apellido.value!="" ||
						d.prop_usbid_nuevo.value!="" || 
						d.prop_ci.value!="" ||
						d.prop_carnet.value!="" ||
						d.prop_dependencia.value!=""
						)
					){			
						if(d.prop_nombre.value==""){ 
							error=true; 	
							texto=texto+"-Nombre del Proponente<br/>";
						}
						if(d.prop_apellido.value==""){ 
							error=true; 	
							texto=texto+"-Apellido del Proponente<br/>";
						}
						if(d.prop_usbid_nuevo.value==""){ 
							error=true; 	
							texto=texto+"-USBID del Proponente nuevo<br/>";
						}	
						if(d.prop_ci.value==""){ 
							error=true; 	
							texto=texto+"-Cédula del Proponente<br/>";
						}		
						if (d.prop_carnet.value=="" && d.prop_dependencia .value==""){
							error=true; 	
							texto=texto+"-Carnet o Dependencia del Proponente<br/>";	
						}else{
							if (d.prop_carnet.value!="" && d.prop_dependencia .value!=""){
								error=true; 	
								texto2=texto2+"-No puede especificar carnet y dependencia del proponente a la vez<br/>";	
							}	
						}
					}
			}
		}//fin de verificacion de los campos del proponente

//Se verifica que los campos de la comunidad se llenen correctamente	
	 if (	(d.comuni_id.value=="") &&
	 		( 
			d.comuni_nombre.value=="" && 
			d.comuni_ubic.value=="" &&
			d.comuni_desc.value==""
			)
	 	){	
		error=true; 	
		texto2=texto2+"-Debe especificar los datos de la Comunidad Beneficiaria<br/>";				
		}else{
			 if (	(d.comuni_id.value!="") &&
					( 
					d.comuni_nombre.value!="" ||
					d.comuni_ubic.value!="" ||
					d.comuni_desc.value!=""
					)
				){		
				error=true; 	
				texto2=texto2+"-Si selecciona una comunidad de la lista, no debe especificar el resto de los campos<br/>";
				}else{
					if (	(d.comuni_id.value=="") &&
							( 
							d.comuni_nombre.value!="" || 
							d.comuni_ubic.value!="" ||
							d.comuni_desc.value!="" 
							)
					){	
						if(d.comuni_nombre.value==""){ 
							error=true; 	
							texto=texto+"-Nombre de la Comunidad<br/>";
						}
						if(d.comuni_ubic.value==""){ 
							error=true; 	
							texto=texto+"-Ubicación de la Comunidad<br/>";
						}
						if(d.comuni_desc.value==""){ 
							error=true; 	
							texto=texto+"-Descripción de la Comunidad<br/>";
						}												
					}			
				}
		}//fin de verificacion de los campos de la comunidad
	if(d.titulo.value==""){ 
		error=true; 	
		texto=texto+"-Título del Proyecto<br/>";
	}	
	
//Se verifica que los campos del area del proyecto se llenen correctamente	
	if(d.area_proy.value=="" ){ 
		error=true; 	
		texto2=texto2+"-Debe especificar el area del proyecto<br/>";
	}	//fin de verificacion del area del proyecto	
	
	if(d.impacto.value==""){ 
		error=true; 	
		texto=texto+"-Impacto Social del Proyecto<br/>";
	}	
	if(d.resumen.value==""){ 
		error=true; 	
		texto=texto+"-Resumen del Proyecto<br/>";
	}	
//Se verifica que los campos de los tutores se llenen correctamente		
	 if (	(d.tutor1_usbid.value=="") && //todos estan vacios
			(d.tutor2_usbid.value=="") &&
			(d.tutor3_usbid.value=="") &&
			datos_tutor1_vacios() &&
			datos_tutor2_vacios() &&
			datos_tutor3_vacios() 
	 	){
		error=true; 	
		texto2=texto2+"-Debe especificar los datos de los tutores (al menos uno).<br/>";		
		}else{
			if (	(d.tutor1_usbid.value=="") && //esta vacio el primero y alguno de los otros dos no.
					datos_tutor1_vacios() &&
					(
						(d.tutor2_usbid.value!="") ||
						!datos_tutor2_vacios() ||
						(d.tutor3_usbid.value!="") ||
						!datos_tutor3_vacios() 
					)
				){
				error=true; 	
				texto2=texto2+"-Debe especificar los datos del primer tutor para llenar los datos de los siguientes tutores.<br/>";		
				}else{
					if (	(d.tutor1_usbid.value!="") && //el primero tiene el usbid seleccionado y alguno de los dem�s llenos
							!datos_tutor1_vacios() 
						){
						error=true; 	
						texto2=texto2+"-Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.<br/>";		
						}else{
							if (	(d.tutor1_usbid.value=="") && //el primero tiene el usbid vacio y no todos los dem�s llenos
									!datos_tutor1_llenos() 
								){ //Preguntar por cada uno de los campos nuevos
									if(d.tutor1_nombre.value==""){ 
										error=true; 	
										texto=texto+"-Nombre del tutor 1<br/>";
									}
									if(d.tutor1_apellido.value==""){ 
										error=true; 	
										texto=texto+"-Apellido del tutor 1<br/>";
									}
									if(d.tutor1_usbid_nuevo.value==""){ 
										error=true; 	
										texto=texto+"-Email del tutor 1<br/>";
									}
									if(d.tutor1_ci.value==""){ 
										error=true; 	
										texto=texto+"-Cédula del tutor 1<br/>";
									}
									if(d.tutor1_dependencia.value==""){ 
										error=true; 	
										texto=texto+"-Dependencia del tutor 1<br/>";
									}
									if(d.tutor1_tlf.value==""){ 
										error=true; 	
										texto=texto+"-Teléfono del tutor 1<br/>";
									}
								}else{
								
								}	
						}			
				}
			if (	d.tutor1_usbid.value!="" || datos_tutor1_llenos() ){ //los datos del tutor1 estan correctos
				
				//los datos del tutor2 no estan correctos
				if(
					d.tutor2_usbid.value=="" && 
					!datos_tutor2_llenos()   && 
					!datos_tutor2_vacios() 
				){  // Preguntar por cada uno de los campos nuevos del tutor 2
						if(d.tutor2_nombre.value==""){ 
							error=true; 	
							texto=texto+"-Nombre del Tutor 2<br/>";
						}
						if(d.tutor2_apellido.value==""){ 
							error=true; 	
							texto=texto+"-Apellido del Tutor 2<br/>";
						}
						if(d.tutor2_usbid_nuevo.value==""){ 
							error=true; 	
							texto=texto+"-Email del Tutor 2<br/>";
						}
						if(d.tutor2_ci.value==""){ 
							error=true; 	
							texto=texto+"-Cédula del Tutor 2<br/>";
						}
						if(d.tutor2_dependencia.value==""){ 
							error=true; 	
							texto=texto+"-Dependencia del Tutor 2<br/>";
						}
						if(d.tutor2_tlf.value==""){ 
							error=true; 	
							texto=texto+"-Teléfono del Tutor 2<br/>";
						}				
				}else{
					if(
						d.tutor2_usbid.value!="" && !datos_tutor2_vacios()   //los datos del tutor2 no estan correctos
					){
						error=true; 	
						texto2=texto2+"-Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.<br/>";							
					}else{
						//los datos del tutor3 no estan correctos
							if(
								d.tutor3_usbid.value=="" && 
								!datos_tutor3_llenos()   &&
								!datos_tutor3_vacios() 
								//los datos del tutor3 no estan correctos
							){  // Preguntar por cada uno de los campos nuevos del tutor 3
									if(d.tutor3_nombre.value==""){ 
										error=true; 	
										texto=texto+"-Nombre del Tutor 3<br/>";
									}
									if(d.tutor3_apellido.value==""){ 
										error=true; 	
										texto=texto+"-Apellido del Tutor 3<br/>";
									}
									if(d.tutor3_usbid_nuevo.value==""){ 
										error=true; 	
										texto=texto+"-Email del Tutor 3<br/>";
									}
									if(d.tutor3_ci.value==""){ 
										error=true; 	
										texto=texto+"-Cédula del Tutor 3<br/>";
									}
									if(d.tutor3_dependencia.value==""){ 
										error=true; 	
										texto=texto+"-Dependencia del Tutor 3<br/>";
									}
									if(d.tutor3_tlf.value==""){ 
										error=true; 	
										texto=texto+"-Teléfono del Tutor 3<br/>";
									}				
							}else{ 
								if(
									d.tutor3_usbid.value!="" && !datos_tutor3_vacios()   //los datos del tutor3 no estan correctos
								){
									error=true; 	
									texto2=texto2+"-Si selecciona un USBID de la lista no debe llenar ninguno de los campos siguientes.<br/>";							
								}
							}
						}
				}
			}		
		}//fin de verificacion de los campos de los tutores	

        // verificacion de los campos representante
//	if(d.area_trabajo.value==""){ 
//		error=true; 	
//		texto=texto+"-Área de Trabajo<br/>";
//	}	
//	if(d.rep_nombres.value==""){ 
//		error=true; 	
//		texto=texto+"-Nombre del Representante de la comunidad<br/>";
//	}
//	if(d.rep_apellidos.value==""){ 
//		error=true; 	
//		texto=texto+"-Apellido del Representante de la comunidad<br/>";
//	}	
//	if(d.rep_ci.value==""){ 
//		error=true; 	
//		texto=texto+"-Cédula de Identidad del Representante de la comunidad<br/>";
//	}
//	if(d.rep_cel.value==""){ 
//		error=true; 	
//		texto=texto+"-Teléfono Celular del Representante de la comunidad<br/>";
//	}
//	if(d.rep_inst.value==""){ 
//		error=true; 	
//		texto=texto+"-Institución del Representante de la comunidad<br/>";
//	}	
//	if(d.rep_dir.value==""){ 
//		error=true; 	
//		texto=texto+"-Dirección del Representante de la comunidad<br/>";
//	}	
//	if(d.rep_cargo.value==""){ 
//		error=true; 	
//		texto=texto+"-Cargo del Representante de la comunidad<br/>";
//	}
//	if(d.rep_email.value==""){ 
//		error=true; 	
//		texto=texto+"-Email del Representante de la comunidad<br/>";
//	}else{
//		if (d.rep_email.value.indexOf("@")=="-1") {
//			error=true;
//			texto2=texto2+"-Debe especificar una direccion de email válida para el representante de la comunidad.<br/>";
//		}else{
//			if (d.rep_email.value.indexOf(".")=="-1"){
//				error=true;
//				texto2=texto2+"-Debe especificar una direccion de email válida para el representante de la comunidad.<br/>";
//			}	
//		}
//	}
//	if(d.rep_tlf.value==""){ 
//		error=true; 	
//		texto=texto+"-Teléfono del Representante de la comunidad<br/>";
//	}	
//	
	if(d.antecedentes.value==""){ 
		error=true; 	
		texto=texto+"-Antecedentes<br/>";
	}	
	if(d.obj_gral.value==""){ 
		error=true; 	
		texto=texto+"-Objetivo General<br/>";
	}	
	if(d.obj_esp.value==""){ 
		error=true; 	
		texto=texto+"-Objetivos Específicos<br/>";
	}
	if(d.desc.value==""){ 
		error=true; 	
		texto=texto+"-Descripción<br/>";
	}	
	if(d.act_esp.value==""){ 
		error=true; 	
		texto=texto+"-Actividades Específicas del estudiante<br/>";
	}
	if(d.perfil.value==""){ 
		error=true; 	
		texto=texto+"-Perfil Curricular<br/>";
	}	
	if(d.recursos.value==""){ 
		error=true; 	
		texto=texto+"-Recursos requeridos<br/>";
	}
	if(d.logros.value==""){ 
		error=true; 	
		texto=texto+"-Logros sociales<br/>";
	}	
	if(d.directrices.value==""){ 
		error=true; 	
		texto=texto+"-Directrices y valores <br/>";
	}	
	if(d.magnitud.value==""){ 
		error=true; 	
		texto=texto+"-Magnitud del proyecto<br/>";
	}	
	if(d.participacion.value==""){ 
		error=true; 	
		texto=texto+"-Participación de miembros de la comunidad<br/>";
	}	
	if(d.plan.value==""){ 
		error=true; 	
		texto=texto+"-Plan de aplicación<br/>";
	}		
	if(d.formacion_req.value==""){ 
		error=true; 	
		texto=texto+"-Formación específica<br/>";
	}	
	if(d.formacion_req.value=="si" && d.formacion_esp.value==""){ 
		error=true; 	
		texto2=texto2+"-Si requiere formación específica debe incluir los detalles de dicha formación<br/>";
	}else{
		if(d.formacion_req.value=="no" && d.formacion_esp.value!=0){ 
			error=true; 	
			texto2=texto2+"-Si no requiere formación específica, no debe incluir los detalles de dicha formación<br/>";
		}		
	}
	if(d.horas.value==""){ 
		error=true; 	
		texto=texto+"-Horas acreditables<br/>";
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
	$.prompt(aviso, {show:'slideDown'});
	}
}
