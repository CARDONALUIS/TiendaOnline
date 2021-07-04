<?php
session_start();
include("FunConsulta.php");

if(isset($_GET['idP']) && $_GET['idP']!="")
{
	$conn = ConectarBD();
	$qry = "delete from venta where idProducto =". $_GET['idP'];
	$rs = mysqli_query($conn, $qry);

	
	$qry2 = "delete from comentarios where idProducto =". $_GET['idP'];
	$rs = mysqli_query($conn, $qry2);

	
	$qry3 = "delete from producto where idProducto =". $_GET['idP'];
	$rs = mysqli_query($conn, $qry3);



	header("Location:http://localhost/Proyecto/portada.php");

}

?>