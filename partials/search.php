<?php
include('../Modelo/Conexion.php');

$c=conectar();

if($_POST)
{
$q=$_POST['palabra'];//se recibe la cadena que queremos buscar
$Tipo=$_POST['Tipo'];
$ID=(int)$_POST['ID'];

$sql="select * from Partes where Tipo='".$Tipo."' AND (nombre LIKE '%".$q."%' or CI LIKE '%".$q."%')";
$sql_res=mysql_query($sql,$c);
$fil=mysql_num_rows($sql_res);
while($row=mysql_fetch_array($sql_res))
{
$CI=$row['CI'];
$ID_P=$row['ID_Parte'];
$Nombre=$row['Nombre'];
$Domicilio=$row['Domicilio'];
$Telefono=$row['Telefono'];

?>
<a href="../Controlador/CD_Partes.php?ID_P=<?php echo $ID_P; ?>&ID_C=<?php echo "$ID"; ?>&Nombre=<?php echo "$Nombre"; ?>&Domicilio=<?php echo "$Domicilio"; ?>&Telefono=<?php echo "$Telefono"; ?>&Tipo=<?php echo "$Tipo"; ?>&CI=<?php echo "$CI"; ?>&Accion=Insertar" style="text-decoration:none;" >
<div class="display_box" align="left">
<div style="margin-right:6px;"><b><?php echo $Nombre; ?></b></div>

</a>

<?php
}

}
else
{

}


?>
