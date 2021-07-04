<?php
session_start();
include("FunConsulta.php");


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
		
		
		<!--<ul class="MenuPri">!-->
		

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
						    echo "<a href='AutenticacionAdmi.php'>Aña</a>";
						    echo "<a href='EliminacionAdmi.php'>Eli</a>";
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
			<li class="itemBN"><a href="#">HOME</a></li>
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




<div class="contenedor">
		<a href="#"><div class="izquierda" onclick="izquierda()"> «  </div></a>
		<a href="#"><div class="derecha" onclick="derecha()"> » </div></a>
		<div id="numerosNave"></div>
		<div id="sliders" class="mascara">
			
				
					
			<div id= "img1">
				<h1 style="color:white">Plystation4</h1>
				<p style="color:white">
				
				</p>
				<!--<a href="#">Enlace 1</a>!-->
			</div>
			<div id= "img2">
				<h1 style="color:green">Xbox one</h1>
				<p style="color:green">
				</p>
				<!--<a href="#">Enlace 2</a>!-->
			</div>
			<div id= "img3">
				<h1 style="color:#1279BB">Switch</h1>
				<p style="color:#1279BB">
				</p>
				<!--<a href="#">Enlace 2</a>!-->
			</div>
			<div id= "img4">
				<h1 style="color:#1279BB">Videojuegos</h1>
				<p style="color:#1279BB">
				</p>
				<!--<a href="#">Enlace 2</a>!-->
			</div>			
						
		</div>	
		
	
	</div>


	
<div class="layout" >
	<h1>Mas populares</h1>
	
	<?php
	$conPro = ConectarBD();
			
		if(!$conPro)
		{
			echo "No fue posible conectarse a la BD";
		}
			
			
		$consulta = "Select * from Producto ORDER BY Popularidad DESC LIMIT 4";
						 	
	 	$resultado = mysqli_query($conPro, $consulta);
	 	
			if(mysqli_num_rows($resultado)>0)
			{
			  //publicar los datos encontrado
			  $i=1;
			  //<span>".$registro["Producto"]."</span> ".$registro["Precio"]."
			  while($registro = mysqli_fetch_array($resultado))
			  {
			 			  echo "<div><img src='imagen.php?idI=". $registro["idProducto"] ."'>
			 			  <p class='nomPro'>". $registro["Producto"] ."</p>
			 			  <a  href='producto.php?idP=".$registro["idProducto"]."'>COMPRAR</a>

						 	  </div>";			  
			  }
			}
	?>
		
</div>

<div class="noticias">
	
	
	<?php
		if(isset($_SESSION['idUsuario']) && $_SESSION['isAdmi'] == 1)
		{
			echo "<a style='text-decoration:none; font-size:20px;'href='AgregaNoti.php'>AgregaNoticia</a>";
			echo "<a style='text-decoration:none; font-size:20px; margin-left:20px;'href='EliminaNoticia.php'>EliminaNoticia</a>";
		}
	?>
	<h1>
	Noticias
	</h1>
	
	<?php
	$conPro = ConectarBD();
			
		if(!$conPro)
		{
			echo "No fue posible conectarse a la BD";
		}
							 	
	 	$consulta2 = "SELECT *FROM noticias";	 	
	 	
	 	$resultado = mysqli_query($conPro, $consulta2);
	 	
			if(mysqli_num_rows($resultado)>0)
			{
			  //publicar los datos encontrado
			  $i=1;
			  //<span>".$registro["Producto"]."</span> ".$registro["Precio"]."
			  while($registro = mysqli_fetch_array($resultado))
			  {
			 			  echo "<div><img src='imagenNoticia.php?idI=". $registro["idNoticia"] ."'>
						  <p class='nomPro'>". $registro["Noticia"] ."</p>
					 	  </div>";			  
					 	  //echo "<a href='eliminaProd.php?idI=".$registro["idPord"]."'>Eliminar</a>";
			  
	
			  }
			}
	?>
		
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
