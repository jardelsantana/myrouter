<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );

require_once("config/conexao.php");

$conecta = mysql_connect("$host", "$usuario", "$senha") or print (mysql_error());
mysql_select_db("$banco", $conecta) or print(mysql_error());

$query = "SELECT * FROM fib_conf WHERE id = '1'";
$res = mysql_query($query, $conecta);
$linha =  mysql_fetch_array($res);

 $linha['partida']."<br/>";
 $linha['lat']."<br/>";
 $linha['longitude']."<br/>";
 $linha['zoom']."<br/>";
 $linha['maxzoom']."<br/>";
 $linha['minzoom']."<br/>";

?>
<!DOCTYPE html>
<html>
<head>

    <div class="breadcrumb clearfix">
    <ul>
        <li><a href="index.php?app=Dashboard">Dashboard</a></li>
        <li><a href="index.php?app=Fibra">Ferramentas</a></li>
        <li class="active">Mapa de Fibra</li>
    </ul>
    </div>

    <?php if($permissao['fr4'] == S) { ?>

    <div class="page-header">
        <h1>Mapa de Fibra</h1>
    </div>

    <div class="row" id="powerwidgets">
        <div class="col-md-12 bootstrap-grid">
            <a href="index.php?app=ListaAreaFibra" class="btn btn-info">Area de Atuação</a>
            <a href="index.php?app=CadastroFibra" class="btn btn-info">Cadastrar Fibras</a>
            <a href="index.php?app=ListaNo" class="btn btn-info">Listar No</a>
            <a href="index.php?app=ListaMarcadores" class="btn btn-info">Gerenciar Marcadores</a><br><br>


            <?php if ($_GET['reg'] == '1') { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times-circle"></i></button>
                    <strong>Atenção!</strong> Servidor MK Reiniciado com sucesso. </div>
            <?php } ?>


            <div class="powerwidget" id="" data-widget-editbutton="false">

                <div class="inner-spacer">

                    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>Google Map</title>

<script type="text/javascript" src="app/fibra/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDF4nG0q9Cl8YkCxdD2qCywYw5kxHZ-m1w&sensor=false&libraries=geometry"></script>
<script type="text/javascript">
$(document).ready(function() {

	var mapCenter = new google.maps.LatLng(<?php echo $linha['lat']?>, <?php echo $linha['longitude']?>); //Google map Coordinates
	var map;
	
	map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
			var googleMapOptions = 
			{ 
				center: mapCenter, // map center
				zoom: <?php echo $linha['zoom']?>, //zoom level, 0 = earth view to higher value
				maxZoom: <?php echo $linha['maxzoom']?>,
				minZoom: <?php echo $linha['minzoom']?>,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL //zoom control size
			},
				scaleControl: true, // enable scale control
				mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
			};

		   	map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);

			//Load Markers from the XML File, Check (map_process.php)
			$.get("app/fibra/map_process.php", function (data) {
				$(data).find("marker").each(function () {
					  var name 		= $(this).attr('name');
					  var address 	= '<p>'+ $(this).attr('address') +'</p>';
					  var type 		= $(this).attr('type');
					  var point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));

                    if (type == 'c_atendimento') {
                        create_marker(point, name, address, false, false, false, src = "app/fibra/icons/ca001.png");
                    }

                    if (type == 'c_distribuicao') {
                        create_marker(point, name, address, false, false, false, src = "app/fibra/icons/c_distribuicao.png");
                    }

                    if (type == 'cliente') {
                        create_marker(point, name, address, false, false, false, src = "app/fibra/icons/cliente.png");
                    }

                    if (type == 'torre') {
                        create_marker(point, name, address, false, false, false, src = "app/fibra/icons/wireless.png");
                    }
				});
			});	
			
			//Right Click to Drop a New Marker
			google.maps.event.addListener(map, 'rightclick', function(event) {
				//Edit form to be displayed with new marker
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Título :</span><input type="text" name="pName" class="save-name" placeholder="Título" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Descrição :</span><textarea name="pDesc" class="save-desc" placeholder="Descrição" maxlength="150"></textarea></label>'+
				'<label for="pType"><span>Tipo :</span> <select name="pType" class="save-type"><option value="c_distribuicao">Caixa de Distribuição</option><option value="c_atendimento">Caixa de Atendimento</option><option value="cliente">Cliente</option><option value="torre">Torre</option>'+
				'<option value="padrao">Padrão</option></select></label>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">SALVAR</button>';


				//Drop a new Marker with our Edit Form
				create_marker(event.latLng, 'NOVO', EditForm, true, true, true, src="app/fibra/icons/pin_blue.png");
			});


        ///=================
        <?php
        $query1 = "SELECT * FROM fib_no";
         $res1 = mysql_query($query1, $conecta);

      while($linha1 = mysql_fetch_array($res1)){
      ?>

        var  <?php echo $linha1['desc_ponto']; ?> = [

        <?php
            $idno = $linha1['id'];
            $query2 = "SELECT * FROM fib_elementos WHERE id_no = '$idno'";
            $res2 = mysql_query($query2, $conecta);
            while($elements = mysql_fetch_array($res2)){
            ?>

        new google.maps.LatLng(<?php echo $elements['lat']?>, <?php echo $elements['lon']?>),

        <?php
        }
     ?>
    ];


        // Construct the Linhas.
        <?php echo $linha1['desc_ponto'] ?> = new google.maps.Polyline({
        path: <?php echo $linha1['desc_ponto'] ?>,
        geodesic: true,
        strokeColor: '<?php echo $linha1['cor'] ?>',
        strokeOpacity: 1.0,
        strokeWeight: <?php echo $linha1['esplinha'] ?>
    });


        <?php echo $linha1['desc_ponto'] ?>.setMap(map);

        <?php
        }
        ?>
        // Construct the polygon.
             bermudaTriangle2 = new google.maps.Polyline({
            path: triangleCoords2,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
		
		bermudaTriangle2.setMap(map);
        ///=================
										
	}
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Figura!",
			icon: iconPath
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span> <button name="remove-marker" class="remove-marker" title="Remove"></button>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType = contentString.find('select.save-type')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker)
	{
		
		/* determine whether marker is draggable 
		new markers are draggable and saved markers are fixed */
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); //just remove new marker
		}
		else
		{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang}; //post variables
			$.ajax({
			  type: "POST",
			  url: "app/fibra/map_process.php",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mName, mAddress, mType, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {name : mName, address : mAddress, latlang : mLatLang, type : mType }; //post variables
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "app/fibra/map_process.php",
		  data: myData,
		  success:function(data){
				replaceWin.html(data); //replace info window with new html
				Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon(src="app/fibra/icons/pin_blue.png"); //replace icon
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}

});
</script>

<style type="text/css">
h1.heading{padding:0px;margin: 0px 0px 10px 0px;text-align:center;font: 18px Georgia, "Times New Roman", Times, serif;}

/* width and height of google map */
#google_map {width: 100%; height: 600px;margin-top:0px;margin-left:auto;margin-right:auto;}

/* Marker Edit form */
.marker-edit label{display:block;margin-bottom: 5px;}
.marker-edit label span {width: 100px;float: left;}
.marker-edit label input, .marker-edit label select{height: 24px;}
.marker-edit label textarea{height: 60px;}
.marker-edit label input, .marker-edit label select, .marker-edit label textarea {width: 60%;margin:0px;padding-left: 5px;border: 1px solid #DDD;border-radius: 3px;}

/* Marker Info Window */
h1.marker-heading{color: #585858;margin: 0px;padding: 0px;font: 18px "Trebuchet MS", Arial;border-bottom: 1px dotted #D8D8D8;}
div.marker-info-win {max-width: 300px;margin-right: -20px;}
div.marker-info-win p{padding: 0px;margin: 10px 0px 10px 0;}
div.marker-inner-win{padding: 5px;}
button.save-marker, button.remove-marker{border: none;background: rgba(0, 0, 0, 0);color: #00F;padding: 0px;text-decoration: underline;margin-right: 10px;cursor: pointer;
}
</style>
</div>
<body>             
<div id="google_map"></div>
</body>
</html>
 <?php } else { ?>

    <div class="page-header">
        <h1>Permissão <small>Negada!</small></h1>
    </div>

    <div class="row" id="powerwidgets">
        <div class="col-md-12 bootstrap-grid">

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i></button>
                <strong>Atenção!</strong> Você não possui permissão para esse modulo. </div>

        </div></div>
<?php } ?>