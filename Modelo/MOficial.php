<?php 

include_once('Conexion.php');

class Oficial{

	function Cargar_Oficiales()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Oficial WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Cargar_Oficiales_Inv()
	{
		$cx=conectar();
		$cmd="SELECT CI,Nombre,Cargo FROM Oficial WHERE Estado=1 AND Servicio=0 AND Tipo=2";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_O($id)
	{
		$cx=conectar();
		$cmd="SELECT Nombre,Direccion,Correo,Telefono,Cargo FROM Oficial WHERE CI='".$id."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Elegir_Oficial($id)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Oficial WHERE CI='".$id."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Oficial(CI,Nombre,Direccion,Telefono,Correo,Sexo,Estado_Civil,Procedencia,Cargo,Tipo,Pass,Servicio,Estado) values ('".$datos['CI']."','".$datos['Nombre']."','".$datos['Direccion']."','".$datos['Telefono']."','".$datos['Correo']."','".$datos['Sexo']."','".$datos['Estado_Civil']."','".$datos['Procedencia']."','".$datos['Cargo']."','".$datos['Tipo']."','".$datos['Pass']."','".$datos['Servicio']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Oficial SET Nombre='".$datos['Nombre']."',Direccion='".$datos['Direccion']."',Telefono='".$datos['Telefono']."',Correo='".$datos['Correo']."' WHERE CI='".$datos['CI']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Oficial SET Estado=0 WHERE CI='".$datos['CI']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Verificar_Login($datos)
	{
		$cx=conectar();
		$cmd="SELECT CI,Pass FROM Oficial WHERE Estado=1 AND CI='".$datos['CI']."' AND Pass='".$datos['Pass']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Verificar_CI($datos)
	{
		$cx=conectar();
		$cmd="SELECT Pass,Correo FROM Oficial WHERE Estado=1 AND CI='".$datos['CI']."'";
		$resultado=mysql_query($cmd,$cx);
		while($row = mysql_fetch_array($resultado)) 
		{
			$Pass=$row['Pass'];
			$Correo=$row['Correo'];
		}
		desconectar($cx);
		return array ($Pass, $Correo);
	}

	function Cargar_Oficiales_R()
	{
		$cx=conectar();
		$cmd="SELECT Cargo as Grado,COUNT(Cargo) as Cantidad FROM Oficial GROUP BY Cargo";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

}




 ?>