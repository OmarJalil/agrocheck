<?php
    require('config.php');
    $conn = new mysqli($host, $user, $passwd, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT * FROM contenedores";
        $result = $conn->query($sql) or die($conn->error);
        $conn->close();
        while($row = $result->fetch_assoc())
        {

?>		
		<div class="row">
		<h4>Contenedor <?php echo $row['id']; ?></h4>
        <div class="container col-sm-6" id="graficaTemperatura<?php echo $row['id']; ?>"></div>
        <div class="container col-sm-6" id="graficaHumedad<?php echo $row['id']; ?>"></div>
        </div>
<?php
        }
?>
<script>

	$(document).ready(function()
	{

<?php
		require('config.php');
    	$conn = new mysqli($host, $user, $passwd, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT * FROM contenedores";
        $result = $conn->query($sql) or die($conn->error);
        $conn->close();
        while($row = $result->fetch_assoc())
        {

?>		
		$.getJSON('dataGraph.php?fecha='+obtenerFecha()+'&id=<?php echo $row['id']; ?>',
		function(data)
		{
			grafica(data[0],data[1],'#graficaTemperatura<?php echo $row['id']; ?>','Temperatura','(°C)');
			grafica(data[0],data[2],"#graficaHumedad<?php echo $row['id']; ?>",'Humedad','(%)');
			console.log(data[1]);
			console.log(data[2]);

		});


<?php
        }
?>


	});

function grafica(fechas, datos,target,titulo, unidad) 
{	
	var acumulador=0, promedio=0;
	for(var i=0;i<datos.length;i++)
	{
		acumulador+=datos[i];
	}

	if(datos.length > 0)
		promedio = Math.floor(acumulador/datos.length);

    $(target).highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: titulo
        },
        subtitle: {
            text: 'Promedio: '+promedio+unidad
        },
        xAxis: {
            categories: fechas
        },
        yAxis: {
            title: {
                text: 'Valor '+unidad
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        credits: {
            text: 'Hypertecnogranja 300'
        },
        series: [{
            name: 'Valor',
            data: datos,
            color:'#337AB7'
        }
        ]
    });
}
</script>