<?php

function ConectarBD()
{
	$c = mysqli_connect("localhost", "root", "", "proyecto2");
	return $c;
	alert("hola");
}

?>