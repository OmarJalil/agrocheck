<?php
header("application/json");
	if(isset($_GET['id']) && isset($_GET['temperatura']) && isset($_GET['humedad']) && isset($_GET['tipo']))
	{
		$id = $_GET['id'];
		$temperatura = $_GET['temperatura'];
		$humedad = $_GET['humedad'];
		$tipo = $_GET['tipo'];		

		require('config.php');
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "UPDATE contenedores SET temperatura=$temperatura, humedad=$humedad, tipo='$tipo' 
		WHERE id=$id";
		$result = $conn->query($sql) or die($conn->error);
		$conn->close();
	}
?>