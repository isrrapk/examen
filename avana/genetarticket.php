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