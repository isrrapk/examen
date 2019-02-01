<!DOCTYPE HTML>

 <html>

    <head>

    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <meta charset="utf-8">

        <!-- Description, Keywords and Author -->

        <meta name="description" content="">

        <meta name="author" content="REYES" >

        

        <title>:: Super RFID | Venta::</title>

		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">



        <!-- style -->

        <link href="css/style.css" rel="stylesheet" type="text/css">

        <!-- style -->

        <!-- bootstrap -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- responsive -->

        <link href="css/responsive.css" rel="stylesheet" type="text/css">

        <!-- font-awesome -->

        <link href="css/fonts.css" rel="stylesheet" type="text/css">

        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- font-awesome -->

        

	</head>



    <body>

    

    	<!-- header -->

        	<header role="header">

            	<div class="container">

                	<!-- logo -->

                    	<h1>

                        	<a href="index.html" title="avana LLC"><img src="images/logo.png" title="avana LLC" alt="avana LLC"/></a>

                        </h1>

                    <!-- logo -->

                    <!-- nav -->

                    <nav role="header-nav" class="navy">

                        <ul>

                            <li class="nav-active"><a href="index.html" title="Inicio">Inicio</a></li>

                            <li><a href="about.html" title="About">Acerca de </a></li>

                            <li><a href="blog.html" title="Carrito">Carrito</a></li>

                            <li><a href="contact.html" title="Contacto">Contacto</a></li>

                        </ul>

                    </nav>

                    <!-- nav -->

                </div>

            </header>

        <!-- header -->

        <!-- main -->

        <main role="main-inner-wrapper" class="container">

        	

            <div class="row">

 

            	<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">

					




<?php echo '<p>Hola Mundo</p>'; ?>
	<?php

	// este funciona en linux  y windows 29/04/18
	
	// ya manda llamar al procedimeito almacenado , depliega productos con cantidad y precio 
	// y muestra total de la compra 

	//Sintaxis de conexión de la base de datos de muestra para PHP y MySQL.
	
	//Conectar a la base de datos
	
	$hostname="localhost:3306";
	$username="root";
	$password="root"; // para isra en la mia va vacio 
	$dbname="super";
	$usertable= "producto";
	//$yourfield = '10111';
	$venta = '2';
	$array_id = [ // o array (
						1 => 10111,
						2 => 10110,
				   ]; // 0 );
	$long_array = count($array_id);
	echo $long_array;
	
	$conexion=mysqli_connect($hostname,$username, $password) or die ( "Algo ha ido mal en la consulta a la base de datos");
	$db = mysqli_select_db( $conexion, $dbname );
	echo '<p>conectando</p>';
	
	//while se llamara al procedimiento almacenado cada que haya un id producto 
	$i=1;
	while ($i <= $long_array):
		//echo $i;
		$consulta = "CALL Procesar_Venta($array_id[$i], $venta)"; // se llama al procedimiento almacenado
		$resultado = mysqli_query( $conexion, $consulta );
		$i++;
	endwhile;
	
	// cosulta para enlistar productos y total de la compra 
	
    // consulta para saber productos cantidad y subtotal de cada producto 	 
	$consulta = "SELECT producto.nombre , venta_producto.cantidad, producto.precio, producto.precio * venta_producto.cantidad as preciot
				 FROM producto join venta_producto 
                 WHERE venta_producto.id_producto = producto.id_producto and venta_producto.folio = $venta";
	
		
	$resultado = mysqli_query( $conexion, $consulta );
	
	// Motrar el resultado DEL TICKET 
			// Encabezado de la tabla
			
			echo "<table borde='2'>";
			echo "<tr>";
			echo "<th>PRODUCTO</th>";
			echo "<th>CANTIDAD</th>";
			echo "<th>PRECIO</th>";
			echo "<th>PRECIOT</th>";
			echo "</tr>";
			
			// Bucle while que recorre cada registro y muestra cada campo en la tabla.
			while ($columna = mysqli_fetch_array( $resultado ))
			{
				echo "<tr>";
				echo " <td>" . $columna['nombre'] . "</td>
					  <td>" . $columna['cantidad'] . "</td>
					  <td>" . $columna['precio'] . "</td><td>" . $columna['preciot'] . "</td>";
		 		echo "</tr>";
	        }
			
			echo "</table>"; // Fin de la tabla
	
    // cosulta para sacar el total de la compra 
    $consulta = "SELECT total FROM venta WHERE folio =$venta";	 
	$resultado = mysqli_query( $conexion, $consulta );   
    
	 while ($columna = mysqli_fetch_array( $resultado )){
		 
		echo "<p>TOTAL = " . $columna['total'] .  "</p>";
	 }


    
	
	
			// cerrar conexión de base de datos
			mysqli_close( $conexion );
?>












					
                </section>

                

                

                      

            

                

                

            </div>

        </main>

    	<!-- main -->

        <!-- footer -->

        <footer role="footer">

            <!-- logo -->

                <h1>

                    <a href="index.html" title="avana LLC"><img src="images/logo.png" title="avana LLC" alt="avana LLC"/></a>

                </h1>

            <!-- logo -->

            <!-- nav -->

            <nav role="footer-nav">

            	<ul>

                	<li><a href="index.html" title="Inicio">Inicio</a></li>

                    <li><a href="about.html" title="About">Acerca de</a></li>

                    <li><a href="blog.html" title="Carrito">Carrito</a></li>

                    <li><a href="contact.html" title="Contacto">Contacto</a></li>

                </ul>

            </nav>

            <!-- nav -->

            <ul role="social-icons">

            	<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>

            </ul>

            <p class="copy-right">&copy; 2018  Super RFID | IPN | UPIITA </p>

        </footer>

        <!-- footer -->

    

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <script src="js/jquery.min.js" type="text/javascript"></script>

        <!-- custom -->

		<script src="js/nav.js" type="text/javascript"></script>

        <script src="js/custom.js" type="text/javascript"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->

        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <!-- jquery.countdown -->

        <script src="js/html5shiv.js" type="text/javascript"></script>

    </body>

</html>