<?php
	if(isset($_GET['consumo']) && isset($_GET['ventilador']) && isset($_GET['ventana']) && isset($_GET['fecha']))
	{
		$fecha = $_GET['fecha']."%";

		//Actualizacion de consumo
		require('../config.php');
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "SELECT id,valor FROM consumo WHERE DATE(fecha) = '$fecha' LIMIT 1";
		$result = $conn->query($sql);
		$conn->close();
		if ($result->num_rows > 0) 
		{
			 if($fila = $result->fetch_assoc()) 
		     {
		     	$valor=$fila['valor']+$_GET['consumo'];
		     	echo $valor;
		     	$id=$fila['id'];
		     	require('../config.php');
				$conn = new mysqli($host, $user, $passwd, $db);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					}
				$sql = "UPDATE consumo SET valor=$valor WHERE id=$id";
				$result = $conn->query($sql) or die($conn->error);
				$conn->close();
			}
		}

		else
		{
			$valor = $_GET['consumo'];
			require('../config.php');
				$conn = new mysqli($host, $user, $passwd, $db);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					}
				$sql = "INSERT INTO consumo (id,fecha,valor) VALUES (0,now(),$valor)";
				$result = $conn->query($sql) or die($conn->error);
				$conn->close();
		}		  
		  //Fin actualizacion de consumo



		  //Actualizacion de ventilacion
		  $ventilador = $_GET['ventilador'];
		  $ventana = $_GET['ventana'];
		  require('../config.php');
			$conn = new mysqli($host, $user, $passwd, $db);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
			$sql = "UPDATE ventilacion SET ventilador=$ventilador, ventana=$ventana WHERE id = 1";
			$result = $conn->query($sql) or die($conn->error);
			$conn->close();
			 
		//Fin actualizacion de ventilacion
	}
	
?>
