<?php
$idmk = base64_decode($_GET['id']);
$interface = base64_decode($_GET['irf']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);

?>
<script> 
	var chart;
	function requestDatta(interface) {
		$.ajax({
            url: 'app/data.php?ip=<?php echo base64_encode($mk['ip']); ?>&login=<?php echo  base64_encode($mk['login']); ?>&senha=<?php echo base64_encode($mk['senha']); ?>&interface=<?php echo base64_encode($interface); ?>',
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
			text: 'Monitor de Tráfego'
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
					text: 'Tráfego',
					margin: 80
				}
		 },
            series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }]
	  });
  });
</script>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li><a href="index.php?app=Interface&id=<?php echo $_GET['id']; ?>">Interfaces</a></li>
            <li class="active">Monitor</li>
          </ul>
        </div>
        
        
        <div class="page-header">
          <h1>Monitor <small><?php echo $mk['servidor']; ?> - <?php echo $interface; ?></small></h1>
        </div>

        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
          <body>
	<script type="text/javascript" src="app/highchart/js/highcharts.js"></script>
        <script type="text/javascript" src="app/highchart/js/themes/gray.js"></script>

	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	
    	</body>
               
               
              
        	
          </div>
        </div> 
      </div>