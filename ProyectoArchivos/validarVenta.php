<?php
session_start();
include("FunConsulta.php");

if(isset($_SESSION['idUsuario']))
{
	$conPro = ConectarBD();
	
	if(!$conPro)
	{
		echo "No fue posible conectarse a la BD";
	}
	
	//echo "<a style='text-decoration:none;  font-size:50px; color:#1279BB;' href='#'>Validar venta click!!</a>";
	//$consulta = "select * from venta where idUsuario=".$_SESSION['idUsuario']."";
	$consulta = "update venta set validar ='1' where idUsuario='".$_SESSION['idUsuario']."'";
	mysqli_query($conPro , $consulta );
	header("Location:http://localhost/Proyecto/portada.php");


}
else
header("Location:http://localhost/Proyecto/portada.php");


?>
