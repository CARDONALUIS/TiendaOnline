<?php
//El uso de las sessiones

session_start();
include("FunConsulta.php");

if(!isset($_SESSION['idUsuario']))//Si no te has autenticado te lleva a la portada
{
		header("Location:http://localhost/Proyecto/portada.php");
}

$conn =ConectarBD();

//echo "hola";
	
	//Validar qu el archivo ya este del lado del servidor 
	if(isset($_POST['txtProducto']) && $_POST['txtProducto'] != "" && isset($_POST['txtPrecio']) && $_POST['txtPrecio'] != "" && isset($_REQUEST['idC']) && $_REQUEST['idC']!= "" && isset($_POST['txtDescripcion']) && $_POST['txtDescripcion'] != "" )
	{

		if(!empty($_FILES['imagen']['tmp_name']))
		{
			$nombre = $_FILES['imagen']['name'];
			$tipo = $_FILES['imagen']['type'];	
			$nombreTemporal = $_FILES['imagen']['tmp_name'];
			$tamanio = $_FILES['imagen']['size'];
			$producto = $_POST['txtProducto'];
			$precio = $_POST['txtPrecio'];
			$idUsuario = $_SESSION['idUsuario'];
			$idCategoria = $_REQUEST['idC'];
			$descripcion = $_POST['txtDescripcion'];

			
			//recuperar el contenido del archivo
			$fp = fopen($nombreTemporal, "r");
			$contenido = fread($fp,$tamanio);
			fclose($fp);
			
			$contenido = addslashes($contenido);
			
			
			
			$qry = "insert into producto (Nombre, Tipo, Imagen, idUsuario, Producto, Precio, idCategoria, Descripcion) values 
			('$nombre','$tipo','$contenido',$idUsuario,'$producto','$precio',$idCategoria, '$descripcion')";
			
			
			mysqli_query($conn,$qry);
			header("Location:http://localhost/Proyecto/portada.php");

		}
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
function VerificarFRMProd()
{
	if(document.getElementById("txtProducto").value == "" && document.getElementById("txtPrecio").value == "" && document.getElementById("txtDescripcion").value =="")
	{
		alert("Producto denegado");
		return false;
	}
	
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
		<a style="text-decoration:none; color:white; font-size:15px;  width:50px; float:left;"href="A??adeCatego.php">A??aCate</a>
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
						    echo "<a href='AutenticacionAdmi.php'>A??a</a>";
						    echo "<a href='EliminacionAdmi.php'>Eli</a>";
						}
						else
								echo "<span style='font-size:20px'>".$_SESSION['Nombre']." </span>". "<a href='cerrarSesion.php'>Salir</a>";
						
													
					}
					?>

		</div>
		
		<div class="compra">
			<a href="Micarrito.php"><i class="fas fa-shopping-cart " title="Ver tu carrito de compras"></i>???Mi carrito |</a>
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
				echo "<li class='itemBN'><a href='cambiaContra.php'>CAMBIAR CONTRASE??A</a></li>";
				}
			?>

		</ul>
		<div class="numero">
		<i class="fas fa-phone-alt"></i><a href="#" >800-2345-6789</a>	
		</div>
			
	</div>
</div>





	
<div class="layoutPlan" >
	<h1>Agrega Prodcuto</h1>
	<!--Post para archivos!-->
	<form method="post" action="AgregaProd.php" enctype="multipart/form-data" onsubmit="return VerificarFRMProd();" >
	Producto <input type="text" name="txtProducto" id="txtProducto" placeholder="Producto"><br>
	Archivo: <input type="file" name="imagen"><br>
	Precio: <input type="number" name="txtPrecio" id="txtPrecio" placeholder="Precio"><br>
	Descripcion: <textarea name="txtDescripcion"></textarea><br>
	<input type="hidden" name="idC" value="<?php echo $_REQUEST['idC'];?>">
	<input type="submit" value="Subir producto">
	<input type="reset" value="Cancelar">
	<a href="portada.php">Regresar</a> a portada
	
	</form>

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
			 	
			 <p>?? 2019 TecnologiasWeb. All Rights Reserved. Design by Luis Cardona</p>
		</div>		
	</div>
</div>


<script>iniDatos()</script>
<script>iniNave()</script>
<script>inicializa(0)</script>




</body>

</html>
