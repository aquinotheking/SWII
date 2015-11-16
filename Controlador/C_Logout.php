<?php 
 
session_start();

if(isset($_SESSION))
{
	if ($_SESSION["autentificado"] != "SI") { 
	   
	    header("Location: ../index.html");
	}  
	else
	{
		session_destroy();
		header("Location: ../index.html");
	}
	 
} 
else
{
	header("Location: ../index.html");
}




 ?>