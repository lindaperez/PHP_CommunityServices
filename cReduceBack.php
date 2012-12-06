<?php
require "cAutorizacion.php";

function buscar_back($linea){
    $reg = "\\";
    $rep = '';
        return str_replace($reg, $rep, $linea);
}

function buscar_back_nr($linea){
    $reg = "\r";
    $rep = '<br/r>';
    $linea1 = str_replace($reg, $rep, $linea);
    $reg2 = "\n";
    $rep2 = '<br/n>';
        return str_replace($reg2, $rep2, $linea1);
}

function buscar_back_br($linea){
    $reg = "<br/r>";
    $rep = '\r';
    $linea1 = str_replace($reg, $rep, $linea);
    $reg2 = "<br/n>";
    $rep2 = '\n';
        return str_replace($reg2, $rep2, $linea1);
}

function replace_form2($expre){
    $id=$_GET[id];
    
    $sql1="SELECT * FROM proyecto WHERE id='$id' ";
    if ($modo_depuracion) echo "$sql1<br>";
        $resultado=ejecutarConsulta($sql1, $conexion);
        $fila=  obtenerResultados($resultado);
    
    $sql="UPDATE proyecto SET ".
    "titulo=trim('".$expre($fila[titulo])."'), ".
    "impacto_social=trim('".$expre($fila[impacto])."'), ".
    "resumen=trim('".$expre($fila[resumen])."'), ".
    "area_de_trabajo=trim('".$expre($fila[area_trabajo])."'), ".
    "antecedentes=trim('".$expre($fila[antecedentes])."'), ".
    "obj_general=trim('".$expre($fila[obj_general])."'), ".
    "obj_especificos=trim('".$expre($fila[obj_especificos])."'), ".
    "descripcion=trim('".$expre($fila[descripcion])."'), ".
    "actividades=trim('".$expre($fila[actividades])."'), ".
    "perfil=trim('".$expre($fila[perfil])."'), ".
    "recursos=trim('".$expre($fila[recursos])."'), ".
    "logros=trim('".$expre($fila[logros])."'), ".
    "directrices=trim('".$expre($fila[directrices])."'), ".
    "magnitud=trim('".$expre($fila[magnitud])."'), ".
    "participacion=trim('".$expre($fila[participacion])."'), ".
    "formacion=trim('".$expre($fila[formacion_req])."'), ".
    "formacion_desc=trim('".$expre($fila[formacion_desc])."'), ".
    "horas=trim('".$expre($fila[horas])."') ".
    "WHERE id='$id'";
if ($modo_depuracion) echo "$sql<br>";
$resultado=ejecutarConsulta($sql, $conexion);
}

replace_form2("buscar_back_nr");
replace_form2("buscar_back");
replace_form2("buscar_back_br");
echo Done;

cerrarConexion($conexion);
?>
