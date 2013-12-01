<?php
require_once("bd.php");
$consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = ".$_POST["elegido"]." ORDER BY nombreMunicipio ASC";

$resultado_mun = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_mun);

$options="";
if ($_POST["elegido"]== !'') {
    
	
		while ($registro_mun= mysql_fetch_array($resultado_mun))
		{
			$options .='
			<option value="'.$registro_mun['idmunicipio'].'">'.$registro_mun['nombreMunicipio'].'</option>';
		}
	
     
}
else
{
	$options='<option value="0">[ Escoja ]</option>';
}
echo $options;    
?>