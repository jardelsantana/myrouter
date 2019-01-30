

<?php

require_once '../config/conexao.php';
// Create connection
$conn = new mysqli($host, $usuario, $senha, $banco);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cpf = $_GET["cpf"];

$sql = "SELECT *  FROM myrouter.clientes, myrouter.radacct WHERE myrouter.clientes.login = myrouter.radacct.username AND myrouter.clientes.cpf = '$cpf'";
$result = $conn->query($sql);

$mk = mysqli_fetch_array($result);


$conn->close();
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Trafico en vivo!</title>
       <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 


<script> 
	var chart;
	function requestDatta(interface) {
		$.ajax({
			url: 'data.php?interface=<?php echo $mk["login"] ?>&nasipaddress=<?php echo  $mk["nasipaddress"]; ?>',
			datatype: "json",
			success: function(data) {
				var midata = JSON.parse(data);
				if( midata.length > 0 ) {
					var TX=parseInt(midata[0].data);
					var RX=parseInt(midata[1].data);
					var x = (new Date()).getTime(); 
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);
					document.getElementById("trafico").innerHTML=TX + " / " + RX;
				}else{
					document.getElementById("trafico").innerHTML="- / -";
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
	}	

	$(document).ready(function() {
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'container',
				animation: Highcharts.svg,
				type: 'spline',
				events: {
					load: function () {
						setInterval(function () {
							requestDatta(document.getElementById("interface").value);
						}, 1000);
					}				
			}
		 },
		 title: {
			text: 'Monitoring'
		 },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Trafico',
					margin: 80
				}
		 },
            series: [{
                name: 'Download',
                data: []
            }, {
                name: 'Upload',
                data: []
            }]
	  });
  });
</script>

</head>
<body>
	<script type="text/javascript" src="assets/highchart/js/highcharts.js"></script>
    <script type="text/javascript" src="assets/highchart/js/themes/gray.js"></script>

	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	<input name="interface" id="interface" hidden type="text" value="rb_inalambricos" />

    <div hidden id="trafico"></div>
</body>
</html>


