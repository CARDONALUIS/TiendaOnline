<?php

include("FunConsulta.php");


//verificar que existe el idI
if(isset($_GET['idI']) && $_GET['idI'] != "")
{
	//echo "<p margin-top='100px;'>algo</p>"
	$conn = ConectarBD();
	$qry = "select Tipo, Imagen, Nombre from noticias where idNoticia =". $_GET['idI'];
	$rs = mysqli_query($conn, $qry);
	$imagen = mysqli_fetch_array($rs);
	//cambiar el tipo de contenido del archivo
	header("Content-Type:" .$imagen['Tipo']);
	echo $imagen["Imagen"];

}
?>