<?php
	if(isset($_GET['fecha']))
	{
		$fecha = $_GET['fecha']."%";
		$general = new StdClass();	

		$general->consumo=0;
		$general->ventilador=0;
		$general->ventana=0;
		require('../config.php');
			$conn = new mysqli($host, $user, $passwd, $db);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
			$sql = "SELECT * from consumo WHERE fecha like '$fecha'";
			$result = $conn->query($sql) or die($conn->error);
			$conn->close();
			if($row = $result->fetch_assoc())
			{
				$consumo=$row['valor'];
			}

			require('../config.php');
			$conn = new mysqli($host, $user, $passwd, $db);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
			$sql = "SELECT * from ventilacion WHERE id=1";
			$result = $conn->query($sql) or die($conn->error);
			$conn->close();
			if($row = $result->fetch_assoc())
			{
				$general->ventilador=$row['ventilador'];
				$general->ventana=$row['ventana'];
			}

			$general->consumo = $consumo;
			print_r(json_encode($general));

	}
?>