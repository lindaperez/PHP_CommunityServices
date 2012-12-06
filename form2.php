<?

	$num=count($_POST[actividad]);
	echo "<br>count = $num <br>";

for ($i=0;$i<count($_POST[actividad]);$i++){
	$sql_temp="INSERT INTO plan_inscripcion VALUES(".
	"'99999', ".
	"'".$_POST[actividad][$i]."', ".
	"'".$_POST[fecha][$i]."', ".
	"'".$_POST[horas][$i]."' ) ";

	 echo "$sql_temp<br>";
	
}
?>
