<?php
	header('application/json');
	if(isset($_GET['id']))
	{
	 $contenedor = $_GET['id'];
	 $dato = new StdClass();

	 require('config.php');
    	$conn = new mysqli($host, $user, $passwd, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT temperatura,humedad FROM dataContenedores WHERE contenedor = $contenedor order by id desc LIMIT 1";
        $result = $conn->query($sql) or die($conn->error);
        $conn->close();
        if($row = $result->fetch_assoc())
        {
        	$dato->temperatura = $row['temperatura'];
        	$dato->humedad = $row['humedad'];
        }

        require('config.php');
        $conn = new mysqli($host, $user, $passwd, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT estado FROM contenedores WHERE id = $contenedor";
        $result = $conn->query($sql) or die($conn->error);
        $conn->close();
        if($row = $result->fetch_assoc())
        {
            if($row['estado'] == 0)
                $mensaje = "Desconectado";
            else
                $mensaje = "Conectado";
            $dato->estado = $mensaje;

        }
        print_r(json_encode($dato));
     }
?>