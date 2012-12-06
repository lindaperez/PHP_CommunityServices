//function datos_tutor1_vacios(){
//    d=document.datos;
//	if(	d.tutor1_nombre.value=="" &&
//		d.tutor1_apellido.value=="" &&
//		d.tutor1_usbid_nuevo.value=="" &&
//		d.tutor1_ci.value=="" &&
//		d.tutor1_dependencia.value=="" &&
//		d.tutor1_tlf.value=="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
//function datos_tutor2_vacios(){
//    d=document.datos;
//	if(	d.tutor2_nombre.value=="" &&
//		d.tutor2_apellido.value=="" &&
//		d.tutor2_usbid_nuevo.value=="" &&
//		d.tutor2_ci.value=="" &&
//		d.tutor2_dependencia.value=="" &&
//		d.tutor2_tlf.value=="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
//function datos_tutor3_vacios(){
//    d=document.datos;
//	if(	d.tutor3_nombre.value=="" &&
//		d.tutor3_apellido.value=="" &&
//		d.tutor3_usbid_nuevo.value=="" &&
//		d.tutor3_ci.value=="" &&
//		d.tutor3_dependencia.value=="" &&
//		d.tutor3_tlf.value=="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
//function datos_tutor1_llenos(){
//    d=document.datos;
//	if(	d.tutor1_nombre.value!="" &&
//		d.tutor1_apellido.value!="" &&
//		d.tutor1_usbid_nuevo.value!="" &&
//		d.tutor1_ci.value!="" &&
//		d.tutor1_dependencia.value!="" &&
//		d.tutor1_tlf.value!="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
//function datos_tutor2_llenos(){
//    d=document.datos;
//	if(	d.tutor2_nombre.value!="" &&
//		d.tutor2_apellido.value!="" &&
//		d.tutor2_usbid_nuevo.value!="" &&
//		d.tutor2_ci.value!="" &&
//		d.tutor2_dependencia.value!="" &&
//		d.tutor2_tlf.value!="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
//function datos_tutor3_llenos(){
//    d=document.datos;
//	if(	d.tutor3_nombre.value!="" &&
//		d.tutor3_apellido.value!="" &&
//		d.tutor3_usbid_nuevo.value!="" &&
//		d.tutor3_ci.value!="" &&
//		d.tutor3_dependencia.value!="" &&
//		d.tutor3_tlf.value!="" 
//	){ 
//		return true; 	
//	}else{
//		return false; 	
//	}
//}
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
							texto=texto+"-Cedula del Proponente<br/>";
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
							texto=texto+"-Ubicacion de la Comunidad<br/>";
						}
						if(d.comuni_desc.value==""){ 
							error=true; 	
							texto=texto+"-Descripcion de la Comunidad<br/>";
						}												
					}			
				}
		}//fin de verificacion de los campos de la comunidad
	if(d.titulo.value==""){ 
		error=true; 	
		texto=texto+"-Titulo del Proyecto<br/>";
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
		texto2=texto2+"-Debe especificar los datos de los tutores. Al menos uno.<br/>";		
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
										texto=texto+"-Cedula del tutor 1<br/>";
									}
									if(d.tutor1_dependencia.value==""){ 
										error=true; 	
										texto=texto+"-Dependencia del tutor 1<br/>";
									}
									if(d.tutor1_tlf.value==""){ 
										error=true; 	
										texto=texto+"-Telefono del tutor 1<br/>";
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
							texto=texto+"-Nombre del tutor 2<br/>";
						}
						if(d.tutor2_apellido.value==""){ 
							error=true; 	
							texto=texto+"-Apellido del tutor 2<br/>";
						}
						if(d.tutor2_usbid_nuevo.value==""){ 
							error=true; 	
							texto=texto+"-Email del tutor 2<br/>";
						}
						if(d.tutor2_ci.value==""){ 
							error=true; 	
							texto=texto+"-Cedula del tutor 2<br/>";
						}
						if(d.tutor2_dependencia.value==""){ 
							error=true; 	
							texto=texto+"-Dependencia del tutor 2<br/>";
						}
						if(d.tutor2_tlf.value==""){ 
							error=true; 	
							texto=texto+"-Telefono del tutor 2<br/>";
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
										texto=texto+"-Nombre del tutor 3<br/>";
									}
									if(d.tutor3_apellido.value==""){ 
										error=true; 	
										texto=texto+"-Apellido del tutor 3<br/>";
									}
									if(d.tutor3_usbid_nuevo.value==""){ 
										error=true; 	
										texto=texto+"-Email del tutor 3<br/>";
									}
									if(d.tutor3_ci.value==""){ 
										error=true; 	
										texto=texto+"-Cedula del tutor 3<br/>";
									}
									if(d.tutor3_dependencia.value==""){ 
										error=true; 	
										texto=texto+"-Dependencia del tutor 3<br/>";
									}
									if(d.tutor3_tlf.value==""){ 
										error=true; 	
										texto=texto+"-Telefono del tutor 3<br/>";
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

	if(d.area_trabajo.value==""){ 
		error=true; 	
		texto=texto+"-Area de Trabajo<br/>";
	}	
	if(d.rep_nombres.value==""){ 
		error=true; 	
		texto=texto+"-Nombre del Representante de la comunidad<br/>";
	}
	if(d.rep_apellidos.value==""){ 
		error=true; 	
		texto=texto+"-Apellido del Representante de la comunidad<br/>";
	}	
	if(d.rep_inst.value==""){ 
		error=true; 	
		texto=texto+"-Instituci�n del Representante de la comunidad<br/>";
	}	
	if(d.rep_dir.value==""){ 
		error=true; 	
		texto=texto+"-Direccion del Representante de la comunidad<br/>";
	}	
	if(d.rep_cargo.value==""){ 
		error=true; 	
		texto=texto+"-Cargo del Representante de la comunidad<br/>";
	}
	if(d.rep_email.value==""){ 
		error=true; 	
		texto=texto+"-Email del Representante de la comunidad<br/>";
	}	
	if(d.rep_tlf.value==""){ 
		error=true; 	
		texto=texto+"-Telefono del Representante de la comunidad<br/>";
	}	
	
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
		texto=texto+"-Objetivos Especificos<br/>";
	}
	if(d.desc.value==""){ 
		error=true; 	
		texto=texto+"-Descripcion<br/>";
	}	
	if(d.act_esp.value==""){ 
		error=true; 	
		texto=texto+"-Actividades Especificas del estudiante<br/>";
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
		texto=texto+"-Participaci�n de miembros de la comunidad<br/>";
	}	
	if(d.plan.value==""){ 
		error=true; 	
		texto=texto+"-Plan de aplicacion<br/>";
	}		
	if(d.formacion_req.value==""){ 
		error=true; 	
		texto=texto+"-�Requiere Formacion especifica?<br/>";
	}	
	if(d.formacion_req.value=="si" && d.formacion_esp.value==""){ 
		error=true; 	
		texto2=texto2+"-Si Requiere formacion especifica debe especificar los detalles de dicha formacion<br/>";
	}else{
		if(d.formacion_req.value=="no" && d.formacion_esp.value!=""){ 
			error=true; 	
			texto2=texto2+"-Si NO Requiere formacion especifica, NO debe especificar los detalles de dicha formacion<br/>";
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
        $.prompt(aviso,{show:'slideDown'});
	}
}