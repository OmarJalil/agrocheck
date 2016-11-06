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
        <div class="container col-sm-4">
              <div class="panel panel-primary">
                <div class="panel-heading">Contenedor <?php echo $row['id']; ?></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tablaDisponibilidad" class="table">
                            <tbody>
                                <tr>
                                    <td>Tipo</td>
                                    <td><a href="#" id="tipo<?php echo $row['id'];?>" data-type="text" data-title="Escribir tipo" class="editable"><?php echo $row['tipo'];?></a></td>
                                </tr>
                                <tr>
                                    <td>Temperatura</td>
                                    <td><a href="#" id="temp<?php echo $row['id'];?>" data-type="text" data-title="Escribir temperatura" class="editable"><?php echo $row['temperatura'];?></a></td>
                                </tr>
                                <tr>
                                    <td>Humedad</td>
                                    <td><a href="#" id="hum<?php echo $row['id'];?>" data-type="text" data-title="Escribir humedad" class="editable"><?php echo $row['humedad'];?></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn btn-primary" onClick="modificarContenedor(<?php echo $row['id'];?>)">Modificar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
<?php
        }
?>
<script>
    $(document).ready(function()
    {
        $('.editable').editable();
    });


    function modificarContenedor(id)
    {
        var tipo = $('#tipo'+id).text(),
        temperatura = $('#temp'+id).text(),
        humedad = $('#hum'+id).text();
        

        $.get('confContenedor.php?tipo='+tipo+'&temperatura='+
            temperatura+'&humedad='+humedad+'&id='+id,
            function()
            {
                configuracion();
            });
        
    }
</script>