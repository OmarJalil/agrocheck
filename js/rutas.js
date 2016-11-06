function inicio()
{
	var link = "inicio.php",
		titulo ="Estado Actual";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#contenedor').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text(titulo);
	$('#titulo').text(titulo);
}

function estadisticas()
{
	var link = "estadisticas.php",
		titulo = "Estadisticas";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#contenedor').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text(titulo);
	$('#titulo').text(titulo);
}

function configuracion()
{
	var link = "configuracion.php",
		titulo ="Configuración";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#contenedor').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text(titulo);
	$('#titulo').text(titulo);
}





//Funciones para obtener hora y fecha

function addZero(i) 
{
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function obtenerHora()
{
    var d = new Date();
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    var s = addZero(d.getSeconds());
    
    return (h + ":" + m + ":" + s);
}

function obtenerFecha()
{
    var currentdate = new Date(); 
    var datetime = currentdate.getFullYear()+"-"+
                   addZero((currentdate.getMonth()+1))+"-"+
                   addZero(currentdate.getDate());
    return datetime;
}