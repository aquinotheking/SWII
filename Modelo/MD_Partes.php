<?php 

include_once('Conexion.php');

class Detalle_Partes{

	function Cargar_Detalle($Tipo,$Codigo)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Detalle_Partes WHERE Tipo='".$Tipo."' AND ID_Caso='".$Codigo."' ";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Detalle_Partes(ID_Caso,ID_Parte,Tipo,CI,Nombre,Domicilio,Telefono) values ('".$datos['ID_Caso']."','".$datos['ID_Parte']."','".$datos['Tipo']."','".$datos['CI']."','".$datos['Nombre']."','".$datos['Domicilio']."','".$datos['Telefono']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="Delete FROM Detalle_Partes WHERE ID_Caso='".$datos['ID_Caso']."' AND ID_Parte='".$datos['ID_Parte']."'";
		mysql_query($cmd);
		desconectar($cx);
	}


}




 ?>