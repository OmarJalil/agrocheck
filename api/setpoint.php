<?php
if(isset($_GET['rfid']))
{
	$rfid = $_GET['rfid'];
	require('../config.php');
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT * FROM contenedores WHERE rfid = '$rfid'";
	$result = $conn->query($sql) or die($conn->error);
	$conn->close();
	if($row = $result->fetch_assoc())
	{
		echo "*".$row['temperatura'].",".$row['humedad']."#";
	}

}
?>