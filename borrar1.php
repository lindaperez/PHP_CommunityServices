<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
function remove(t)
{
              var td = t.parentNode;
              var tr = td.parentNode;
              var table = tr.parentNode;
              table.removeChild(tr);
}
function agrega_celda(id){
	var tbody = document.getElementById
	(id).getElementsByTagName("TBODY")[0];
	var row = document.createElement("TR")
	var td1 = document.createElement("TD")
	td1.appendChild(document.createTextNode("<input type=\"button\" onclick=\"remove(this)\" value=\"Eliminar\" />"))
	var td2 = document.createElement("TD")
	td2.appendChild (document.createTextNode("columna 2"))
	row.appendChild(td1);
	row.appendChild(td2);
	tbody.appendChild(row);
}
</script>

<script>
function cambiar()
{
	var index=document.forms.formulario.trimestres.selectedIndex;
	
	formulario.mes1.length=0;
	formulario.mes2.length=0;
	formulario.mes3.length=0;
	
	if(index==0) trimestre1();
	if(index==1) trimestre2();
	if(index==2) trimestre3();
	if(index==3) trimestre4();
}
function trimestre1(){
	document.forms.formulario.mes1.value="Enero";
	document.forms.formulario.mes2.value="Febrero";
	document.forms.formulario.mes3.value="Marzo";
}
function trimestre2(){
	document.forms.formulario.mes1.value="Abril";
	document.forms.formulario.mes2.value="Mayo";
	document.forms.formulario.mes3.value="Junio";

}
function trimestre3(){
	document.forms.formulario.mes1.value="Julio";
	document.forms.formulario.mes2.value="Agosto";
	document.forms.formulario.mes3.value="Septiembre";

}
function trimestre4(){
	document.forms.formulario.mes1.value="Octubre";
	document.forms.formulario.mes2.value="Noviembre";
	document.forms.formulario.mes3.value="Diciembre";

}
</script>
</head>

<body>
<a href="javascript:agrega_celda('mi_tabla')">Agrega nueva</a>
<table id="mi_tabla" cellspacing="0" border="1">
<tbody>
<tr>
<td>Celda1_columna1</td>
<td>Celda1_columna2</td>
</tr>
</tbody>
</table>

<form name="formulario" method="post" action="">
<div align="center">Trimestre
<select name="trimestres" OnChange="cambiar()">
	<option value="1er. Trimestre" selected>1er. Trimestre</option>
	<option value="2do. Trimestre">2er. Trimestre</option>
	<option value="3er. Trimestre">3er. Trimestre</option>
	<option value="4to. Trimestre">4to. Trimestre</option>
</select>
Meses
<INPUT type="text" name="mes1" value="Enero" disabled="true" >
<INPUT type="text" name="mes2" value="Febrero" disabled="true">
<INPUT type="text" name="mes3" value="Marzo" disabled="true">


</div>
</form>

</body>
</html>