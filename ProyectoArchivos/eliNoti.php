<?php
session_start();
include("FunConsulta.php");

if(isset($_GET['idN']) && $_GET['idN']!="")
{
	$conn = ConectarBD();
	
	$qry = "delete from noticias where idNoticia =". $_GET['idN'];
	$rs = mysqli_query($conn, $qry);



	header("Location:http://localhost/Proyecto/portada.php");

}
else
	header("Location:http://localhost/Proyecto/portada.php");

?>