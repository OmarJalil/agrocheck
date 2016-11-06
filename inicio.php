<div class="row">
    <h4>Parametros generales</h4>
    <div class="container col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Consumo</div>
        <div class="panel-body">
            <i class="fa fa-tint fa-fw" aria-hidden="true"></i><span id="consumo"></span>
        </div>
      </div>
    </div>
    <div class="container col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Ventilador</div>
        <div class="panel-body">
            <i class="fa fa-asterisk fa-fw" aria-hidden="true"></i><span id="ventilador"></span>
        </div>
      </div>
    </div>
    <div class="container col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Ventanas</div>
        <div class="panel-body">
            <i class="fa fa-columns fa-fw" aria-hidden="true"></i><span id="ventana"></span>
        </div>
      </div>
    </div>
</div>
<div class="row">
<h4>Contenedores</h4>
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
                                    <td><?php echo $row['tipo']; ?></td>
                                </tr>
                                <tr>
                                    <td>Temperatura</td>
                                    <td id="temperatura<?php echo $row['id']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Humedad</td>
                                    <td id="humedad<?php echo $row['id']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td id="estado<?php echo $row['id']; ?>"></td>
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
</div>
<script>
$(document).ready(function()
    {
        paneles();
        general();
    });

function paneles()
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
            $id=$row['id'];
?>
    $.getJSON('rt.php?id=<?php echo $row['id']; ?>',function(datos)
    {
        var clase = "green";
        if(datos.estado == "Conectado")
            clase = "green";
        else
            clase ="red";

        $('#temperatura<?php echo $row['id']; ?>').text(Math.floor(datos.temperatura)+"°C");
        $('#humedad<?php echo $row['id']; ?>').text(Math.floor(datos.humedad)+"%");
        $('#estado<?php echo $row['id']; ?>').html('<span id="con<?php echo $id; ?>">__</span> '+datos.estado);
        $('#con<?php echo $id; ?>').addClass(clase);
    }); 



<?php
    }
?>

setTimeout("paneles()",3000);

}

    function general()
    {
        $.getJSON('api/general.php?fecha='+obtenerFecha(),function(data)
        {   var mensaje = "Abierta";
            if(data.ventana == 0)
                mensaje = "Cerrada";
            $('#consumo').text(Math.floor(data.consumo)+" litros");
            $('#ventilador').text(data.ventilador+"%");
            $('#ventana').text(mensaje);
        });
        setTimeout("general()",3000);
    }
</script>