<html>
<head>
<script>
function agregarAct(){
	tabla=document.getElementById("tabla_actividades");
	numFilas=tabla.rows.length;
	fila=tabla.insertRow(numFilas);
	fila.insertCell(0).innerHTML="<input type='text' name='actividad[]'>";
	fila.insertCell(1).innerHTML="<input type='text' name='fecha[]'>";
	fila.insertCell(2).innerHTML="<input type='text' name='horas[]'>";
	fila.insertCell(3).innerHTML="<a href='javascript: eliminarAct("+numFilas+")'>Eliminar</a>";
}

function eliminarAct(fila){
    tabla=document.getElementById("tabla_actividades");
    if(tabla.rows.length!=1){
        tabla.deleteRow(fila);
        for(i=1;i<tabla.rows.length;i++){
            tabla.rows[i].cells[3].innerHTML="<a href='javascript: eliminarAct("+i+")'>Eliminar</a>";
        }
    }else{
        alert("El proyecto debe tener al menos una actividad");
    }
}

</script>
</head>
<body>
<table id="tabla_actividades" border=0>
<tr>
	<TD><input type='text' name='actividad[]'></TD>
	<TD><input type='text' name='fecha[]'></TD>
	<TD><input type='text' name='horas[]'> </TD>
	<TD><a href='javascript: eliminarAct(1)'>Eliminar</a></TD>
</tr>

</table>
<input type="button" value="Agregar M&aacute;s Actividades" onClick="agregarAct();">
</body>
</html>