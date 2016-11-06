<?php
	if(isset($_GET['rfid']) && isset($_GET['temperatura']) && isset($_GET['humedad']) && isset($_GET['estado']))
	{
		$rfid = $_GET['rfid'];
		$temperatura = $_GET['temperatura'];
		$humedad = $_GET['humedad'];
		$estado = $_GET['estado'];


		require('../config.php');
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "UPDATE contenedores SET estado = $estado WHERE rfid = '$rfid'";
		$result = $conn->query($sql) or die($conn->error);
		$conn->close();


		require('../config.php');
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "INSERT INTO dataContenedores (id,fecha,temperatura,humedad,contenedor) 
		VALUES (0,now(),$temperatura,$humedad,(SELECT id FROM contenedores WHERE rfid = '$rfid'))";
		$result = $conn->query($sql) or die($conn->error);
		$conn->close();
	}
?>