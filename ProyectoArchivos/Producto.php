<?php
session_start();
include("FunConsulta.php");

$conn = ConectarBD();


$band = 0;


if(isset($_GET['idP']) && $_GET['idP'] != "" && isset($_GET['txtComentario']) && $_GET['txtComentario'] != "")
	{
				//Se inserta en la base de datos el registro
				//Crear la conexion a la base de datos
				
				$consu = "SELECT * FROM producto where idProducto='".$_GET['idP']."'";
				$resultado = mysqli_query($conn,$consu);

	
												
						
				if(mysqli_num_rows($resultado )>0 )//Si encontro conicidencia
				{
				while($registro = mysqli_fetch_array($resultado))
				  {
				  	$cont = $registro['Popularidad'];
			  
				  }
			
						
				}
	
	//if($band = 0)
				$cont = $cont-2;
	//else
	//$band = 0;
	
				$qry = "update producto set Popularidad ='".$cont."' where idProducto='".$_GET['idP']."'";
				$resultado = mysqli_query($conn,$qry);
			
				
				$conn = ConectarBD();
				
				
				//$band = 1;
				$qry = "insert into comentarios (Comentario, Fecha, idUsuario, idProducto) value ('".$_GET['txtComentario']."','".date("y") . "-" . date("m") . "-" . date("d")."','".$_SESSION['idUsuario']."','".$_GET['idP']."')";
				mysqli_query($conn,$qry);
				header("Location:http://localhost/Proyecto/Producto.php?idP=".$_GET['idP']."");
	}



			
if(isset($_GET['idP']) && $_GET['idP'] != "")
{
	$consu = "SELECT * FROM producto where idProducto='".$_GET['idP']."'";
	$resultado = mysqli_query($conn,$consu);

	
												
						
	if(mysqli_num_rows($resultado )>0 )//Si encontro conicidencia
	{
		while($registro = mysqli_fetch_array($resultado))
		  {
		  	$cont = $registro['Popularidad'];
		  
		  }
		
						
	}
	
	//if($band = 0)
	$cont++;
	//else
	//$band = 0;
	
	$qry = "update producto set Popularidad ='".$cont."' where idProducto='".$_GET['idP']."'";
	$resultado = mysqli_query($conn,$qry);


	

	
}


if(!isset($_SESSION['idUsuario']))
{
	header("Location:http://localhost/Proyecto/autenticacion.php");
}







?>


<!DOCTYPE html>
<html>
<!--
!-->
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

<link rel="stylesheet" href="estilos.css">
<script src="funciones.js"></script>

<!--<script src="7c00588ef0.js"></script>!-->
<script src="https://kit.fontawesome.com/7c00588ef0.js"></script>



<title>Untitled 1</title>

<script type="text/javascript">
function VerificarFRMCom()
{
	if(document.getElementById("txtComentario").value=="")
		return false;
	else
		return true;
	
}

</script>

</head>
<body>




<div class="bloqEstatico">
	<div class="BloquePri">
		<div class="logo">
		GameUniverse
		<?php
		
		if(isset($_SESSION['idUsuario']) && $_SESSION['isAdmi'] == 1)
		{
		?>
		<a style="text-decoration:none; color:white; font-size:15px;  width:50px; float:left;"href="AñadeCatego.php">AñaCate</a>
		<?php
		}
		?>

		</div>
		
		<ul class="MenuPri">
			<?php
			
			$con = ConectarBD();
			$consu = "SELECT * FROM clasificacion";
			$resultado = mysqli_query($con,$consu);
												
						
			if(mysqli_num_rows($resultado )>0 )//Si encontro conicidencia
			{
				
				while($registro = mysqli_fetch_array($resultado))
			  	{
			  		echo "<li class='itemMP'><a href='categoria.php?idC=".$registro['idClasificacion']."'>".$registro['clasificacion']."</a></li>";	
				}
				
			}

			
			?>

		</ul>
		
		
		<div class="usuario">
		<?php
					if(!isset($_SESSION['idUsuario']))
					{
					?>
					 <a href="Autenticacion.php"><i class="fas fa-user"></i></a>
										
					<?php
					}else
					{
						
						$con = ConectarBD();
						$consu = "SELECT * FROM usuarios where isAdmi=1 and Nombre='".$_SESSION['Nombre']."'";
						$resultado = mysqli_query($con,$consu);
												
						
						if(mysqli_num_rows($resultado )>0 )//Si encontro conicidencia
						{
							echo "<span style='font-size:20px'>".$_SESSION['Nombre']." </span>". "<a href='cerrarSesion.php'>Salir</a>";
						    echo "<a href='AutenticacionAdmi.php'>Add</a>";
						}
						else
								echo "<span style='font-size:20px'>".$_SESSION['Nombre']." </span>". "<a href='cerrarSesion.php'>Salir</a>";
						
													
					}
		?>

		</div>
		
		<div class="compra">
			<a href="Micarrito.php"><i class="fas fa-shopping-cart " title="Ver tu carrito de compras"></i>ᅠMi carrito |</a>
		</div>
		
		
		<!--
		<div class="usuario">hola2</div>
		!-->
		
	</div>
	
	<div class="barraNegra">
	
		<a href="#"><i class="fas fa-search iconoSearch"></i></a>
		<ul class="MenuBarraNeg">
			<li class="itemBN"><a href="portada.php">HOME</a></li>
			<li class="itemBN"><a href="#">CONTACT</a></li>
			<li class="itemBN"><a href="#">BLOG</a></li>
			<?php
				if(isset($_SESSION['idUsuario']) && $_SESSION['isAdmi'] == 1)
				{
				echo "<li class='itemBN'><a href='verVentas.php'>VENTAS</a></li>";
				}
				
				
				if(isset($_SESSION['idUsuario']))
				{
				echo "<li class='itemBN'><a href='cambiaContra.php'>CAMBIAR CONTRASEÑA</a></li>";
				}
				

			?>

		</ul>
		<div class="numero">
		<i class="fas fa-phone-alt"></i><a href="#" >800-2345-6789</a>	
		</div>
			
	</div>
</div>





	
<div class="layoutPlan" >
<h1>Carrito de compras</h1>
<?php
	$conPro = ConectarBD();
	
	if(!$conPro)
	{
		echo "No fue posible conectarse a la BD";
	}
if(isset($_GET['idP']) && $_GET['idP']!="")
{
	
	
	$consulta = "select * from producto where idProducto=".$_GET['idP']."";
	$resultado = mysqli_query($conPro, $consulta);
	if(isset($_SESSION['idUsuario']))
	{
		if(mysqli_num_rows($resultado)>0)
		{
		  //publicar los datos encontrado
		  $i=1;
		  
		  while($registro = mysqli_fetch_array($resultado))
		  {
		  //echo "<div class='nomPro'>hola</div>";
		  echo "<div class='carrito'><img src='imagen.php?idI=". $registro["idProducto"] ."'>
		  <p class='nomPro'>". $registro["Producto"] ."</p>
		  <p class='precioPro'>". $registro["Precio"] ."</p>
		  <p class='nomPro'>". $registro["Descripcion"] ."</p>

		  <a href='Micarrito.php?idP=". $registro["idProducto"]."'>agregar</a>  
		  </div>";	
		 //echo "<a href='eliminaProd.php?idI=".$registro["idPord"]."'>Eliminar</a><br>";
		  
	
		  }
		}
	}
}
?>

<div class="comenProd">
<h1>Comentarios</h1>
	 <form method="get" action="Producto.php" onsubmit="return VerificarFRMCom();">
		<div class="camposRegis">
		<input type="text" name="txtComentario" id="txtComentario" placeholder="Comentario">
		<input type="hidden" name="idP" value="<?php echo $_REQUEST['idP'];?>">

		<br>
		</div>
		<br>
		<div class="botonReg">
		<input type="submit" value="Comentar">
		<input type="reset" value="Cancelar"> 
		</div>
		<br>
	</form>

<?php


$conn =  ConectarBD();


if(!$conn)
{
	echo "No fue posible conectarse a la BD";
}

//$consulta = "SELECT *FROM venta INNER JOIN producto ON venta.idProducto=producto.idProducto AND venta.idUsuario=".$_SESSION['idUsuario']."";

//$consulta = "select * from imagenes";


$consulta = "select i.idComentario, i.idProducto, i.Comentario as nombreComentario, u.idUsuario, 
				u.Nombre as nombreUsuario, i.Fecha
			from comentarios as i
			inner join usuarios as u ON i.idUsuario = u.idUsuario and i.idProducto = ".$_REQUEST['idP']." Order By i.Fecha Desc";


//$consulta = "select * from comentarios";





$resultado = mysqli_query($conn,$consulta);


if(mysqli_num_rows($resultado)>0)
{
	//Publicar resultados
	$i = 1;
	
	while(($registro = mysqli_fetch_array($resultado)))
	{
		echo $registro['nombreComentario']. "[".$registro['Fecha']."]" ;
		 echo ": ".$registro['nombreUsuario']. "<br>";
		
		if(isset($_SESSION['idUsuario']) && $_SESSION['idUsuario'] == $registro['idUsuario'])
		{
			echo "<a href='cambiarComen.php?idCom=".$registro["idComentario"]."'>Editar comentario</a><br>";
			
		}
			
		echo "<br>";
		$i++;
	}
	
}


?>


</div>

</div>


<div class="piePagina">
	<div class="layoutPP">
		<div class="infoYCate">
			<div class="info">
			<h3>Informacion</h3>
			<p><a href="#">Contactanos</a></p>
			<p><a href="#">Sobre nosotro</a></p>
			</div>
			<div class="Cate">
			<h3>Categorias</h3>
			<?php
			
			$con = ConectarBD();
			$consu = "SELECT * FROM clasificacion";
			$resultado = mysqli_query($con,$consu);
												
						
			if(mysqli_num_rows($resultado )>0 )//Si encontro conicidencia
			{
				
				while($registro = mysqli_fetch_array($resultado))
			  	{
			  		echo "<p><a href='categoria.php?idC=".$registro['idClasificacion']."'>".$registro['clasificacion']."</a></p>";	
				}
				
			}

			
			?>
			</div>
		</div>
		<div class="Ubica">
		<h2>Ubicanos en calle venustiano carranza Numero 110</h2>
		<p>Te esperamos para que disfrutes de lo mejor en videojuegos</p>
		</div>
		
		<div class="redesyCP">
			<a href=""><i class="fab fa-facebook-f"></i></a>
				<a href=""><i class="fab fa-twitter"></i></a>
				<a href=""><i class="fab fa-linkedin-in"></i></a>
			 	<a href=""><i class="fab fa-pinterest"></i></a>
			 	<a href=""><i class="fab fa-instagram"></i></a>
			 	
			 <p>© 2019 TecnologiasWeb. All Rights Reserved. Design by Luis Cardona</p>
		</div>		
	</div>
</div>


<script>iniDatos()</script>
<script>iniNave()</script>
<script>inicializa(0)</script>




</body>

</html>
