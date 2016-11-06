<?php
header("application/json");
	if(isset($_GET['fecha']) && isset($_GET['id']))
	{
		$fechaInicio = $_GET['fecha']." 00:00:00";
		$fechaFinal  = $_GET['fecha']." 23:59:59";
		$id = $_GET['id'];

		$fechas = array();
		$temps = array();
		$hums = array();

		require('config.php');
    	$conn = new mysqli($host, $user, $passwd, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT * FROM dataContenedores WHERE contenedor=$id AND fecha BETWEEN '$fechaInicio' AND '$fechaFinal'";
        $result = $conn->query($sql) or die($conn->error);
        $conn->close();
        $i=0;
        while($row = $result->fetch_assoc())
        {
        	$fechas[$i] = $row['fecha'];
        	$temps[$i] = (int)$row['temperatura'];
        	$hums[$i] = (int)$row['humedad'];
        	$i++;
        }

        $resultado = array($fechas,$temps,$hums);
        print_r(json_encode($resultado));

	}

?>