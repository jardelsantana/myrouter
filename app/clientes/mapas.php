
<div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Mapas">Ferramentas</a></li>
            <li class="active">Mapa dos Clientes</li>
          </ul>
        </div>
        
        <?php if($permissao['fr4'] == S) { ?>

<div class="page-header">
          <h1>Mapa dos Clientes</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            
            <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Servidor MK Reiniciado com sucesso. </div>
	<?php } ?>
            
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
             
              <div class="inner-spacer">

<style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 100%; height: 550px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 //Sample code written by August Li
 
 var icon = new google.maps.MarkerImage("assets/images/mapa.png",
 new google.maps.Size(74, 83), new google.maps.Point(0, 0),
 new google.maps.Point(10, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 
 var ictorre = new google.maps.MarkerImage("assets/images/torre.png",
 new google.maps.Size(74, 83), new google.maps.Point(0, 0),
 new google.maps.Point(10, 32));
 
 function addMarkerTorre(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: ictorre,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 500
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 
 
 function addMarker(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 500
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 
 
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 12,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 mapTypeControl: true,
 mapTypeControlOptions: {
 style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
 },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });
 
 
 <?php
 
 $query = $mysqli->query("SELECT * FROM clientes");
 while ($row = mysqli_fetch_array($query)){
 $nome = $row['nome'];
 $endereco = $row['endereco'];
 $bairro = $row['bairro'];
 $numero = $row['numero'];
 $complemento = $row['complemento'];
 $cidade = $row['cidade'];
 $tel = $row['tel'];
 $cel = $row['cel'];
 
$address = ''.acento($endereco).','.$numero.','.acento($cidade).',brasil';
$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
$output= json_decode($geocode);
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
 
 if($lat <> '') {
 echo ("addMarker($lat, $long,'<b>$nome</b><br/>Endereço: $endereco, $numero, $complemento $bairro $cidade <br>Telefones: $tel - $cel<br>');\n");
 }
 
 }
 ?>
 
 <?php
 $servs = $mysqli->query("SELECT * FROM servidores");
 while ($serv = mysqli_fetch_array($servs)){
 $lat = $serv['lat'];
 $lng = $serv['lng'];
 $servidor = $serv['servidor'];
 $ip = $serv['ip'];
 $id = $serv['id'];
  
 $acessos = $mysqli->query("SELECT * FROM planos WHERE servidor = '$id'");
 $daa = mysqli_fetch_array($acessos);
 $derp = $daa['id'];
 $sxd = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$derp'");
 $registros = mysqli_num_rows($sxd);
 
 if($serv['tipo'] == '1') {  $tipoimg = "assets/images/antenas/rb.png"; } 
 if($serv['tipo'] == '2') {  $tipoimg = "assets/images/antenas/2.png"; } 
 if($serv['tipo'] == '3') {  $tipoimg = "assets/images/antenas/3.png"; } 
 if($serv['tipo'] == '4') {  $tipoimg = "assets/images/antenas/4.png"; } 
 if($serv['tipo'] == '5') {  $tipoimg = "assets/images/antenas/5.png"; } 
 if($serv['tipo'] == '6') {  $tipoimg = "assets/images/antenas/6.png"; } 
 if($serv['tipo'] == '7') {  $tipoimg = "assets/images/antenas/7.png"; } 
 if($serv['tipo'] == '8') {  $tipoimg = "assets/images/antenas/8.png"; } 
 if($serv['tipo'] == '9') {  $tipoimg = "assets/images/antenas/9.png"; } 
 if($serv['tipo'] == '10') {  $tipoimg = "assets/images/antenas/10.png"; } 
 if($serv['tipo'] == '11') {  $tipoimg = "assets/images/antenas/11.png"; } 
 if($serv['tipo'] == '12') {  $tipoimg = "assets/images/antenas/12.png"; } 
 if($serv['tipo'] == '13') {  $tipoimg = "assets/images/antenas/13.png"; } 
 if($serv['tipo'] == '14') {  $tipoimg = "assets/images/antenas/14.png"; } 
 if($serv['tipo'] == '15') {  $tipoimg = "assets/images/antenas/15.png"; } 
 if($serv['tipo'] == '16') {  $tipoimg = "assets/images/antenas/16.png"; } 
 if($serv['tipo'] == '17') {  $tipoimg = "assets/images/antenas/17.png"; } 
 if($serv['tipo'] == '18') {  $tipoimg = "assets/images/antenas/18.png"; } 
 if($serv['tipo'] == '19') {  $tipoimg = "assets/images/antenas/19.png"; } 
 if($serv['tipo'] == '20') {  $tipoimg = "assets/images/antenas/20.png"; } 
 if($serv['tipo'] == '21') {  $tipoimg = "assets/images/antenas/21.png"; } 
 if($serv['tipo'] == '22') {  $tipoimg = "assets/images/antenas/22.png"; } 
 if($serv['tipo'] == '23') {  $tipoimg = "assets/images/antenas/23.png"; } 
 if($serv['tipo'] == '24') {  $tipoimg = "assets/images/antenas/24.png"; } 
 
 
 
 if($lat <> '') {
 echo ("addMarkerTorre($lat, $lng,'<div style=\"width:440px;\"><img height=\"68px\" src=$tipoimg><br><b>SERVIDOR</b><br/>$servidor | <b>IP:</b> $ip | <b>Conexões:</b> $registros <br>  </div>');\n");
 } 
 

 
 
 
 }
 ?>
 
 center = bounds.getCenter();
 map.fitBounds(bounds);

 }
 </script>
 
 <div id="map"></div>
 
 </div></div></div>
 
 
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