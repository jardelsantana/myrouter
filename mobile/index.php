<?php
session_start();
ob_start();
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 0);
error_reporting(0);
ini_set("track_errors","0"); 
header("Content-Type: text/html; charset=ISO-8859-1", true);
    require_once '../config/conexao.class.php';
    require_once '../config/crud.class.php';
    require_once '../config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco

if ( !isset($_SESSION['login']) ){ // Verifica Login do Usuário

    echo "
<script>
   	window.location = 'login.php';
    </script>
";
} else {
    $idbase = $_SESSION['id'];
    if($idbase){ 
        $cslogin = $mysqli->query("SELECT * FROM tecnicos WHERE id = + $idbase");
        $logado = mysqli_fetch_array($cslogin);



    }
?>
<!DOCTYPE html>

<html manifest="manifest.webapp">
<head>
  <meta charset="ISO-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyRouter ERP</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="css/jquery.mobile-1.3.2.min.css" />
  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.mobile-1.3.2.min.js"></script>
  <script src="fuiprafinal.js"></script>
  <link rel="stylesheet" href="jqm-icon-pack-2.0-original.css" />
  <link rel="apple-touch-icon" href="images/iphone.png" />
  <link rel="shortcut icon" href="images/favicon.ico" >
</head>

<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">

  <div data-role="page" id="home" data-url="home" data-theme="a" data-title="MyRouter ERP">

    <div data-role="header" data-theme="b">
      <h1>MyRouter ERP</h1>
    </div>

    <div data-role="content">
      
        <a href="#atendimentos" data-role="button" data-icon="calendar" data-inline="false" data-theme="b">Atendimentos</a>
        <a href="#clientes" data-role="button" data-icon="grid" data-inline="false" data-theme="b">Clientes</a>
        <a href="#torres" data-role="button" data-icon="bullets" data-inline="false" data-theme="b">Torres</a>
        <a href="#" data-role="button" data-icon="gear" data-inline="false" data-theme="b">Recursos do Sistema</a>
        <a href="#" data-role="button" data-icon="file" data-inline="false" data-theme="d">Tarefas</a>
      
    </div>

    <div data-role="footer" data-position="fixed" data-theme="b">
      <div id="navgroup">
        <div data-role="controlgroup" data-type="horizontal">
          <a href="#about" data-role="button" data-icon="info2">Sobre</a>
         <!-- <a href="#instale" data-role="button" data-icon="wrench">Instale</a> -->
          <a href="sair.php" data-role="button" data-icon="wrench">Sair</a>
        
        </div>
      </div>
    </div>

  </div>





  <div data-role="page" id="about" data-url="about" data-theme="b" data-title="MyRouter ERP">

    <div data-role="header" data-theme="b">
      <h1>MyRouter ERP</h1>
    </div>

    <div data-role="content">
      <p><strong>MyRouter ERP Mobile</strong> é um Módulo adicional ao sistema principal que oferece ferramentas de gestão para os técnicos de seu provedor.</p>
      <p>De forma simplificada o MyRouter ERP Mobile pode ser conectar com as torres, fazer a gestão de ordem de serviços, atendimentos aos clientes, além de outros recursos integrados ao Mikrotik</p>
      <p>Para funcionamento é necessário apontar seu IP de comunicação no menu INSTALAR.</p>
      <a href="#home" data-role="button" data-icon="back" data-inline="false" data-theme="b">Voltar</a>
    </div>

    <div data-role="footer" data-position="fixed" data-theme="b">
      <h5>MyRouter ERP</h5>
    </div>

  </div>
  
  
  <div data-role="page" id="clientes" data-url="clientes" data-theme="a" data-title="MyRouter ERP">

    <div data-role="header" data-theme="b">
      <h1>MyRouter ERP</h1>
    </div>

    <div data-role="content">
      <h3>Clientes</h3>
      
      
      <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Exibir Colunas" data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th data-priority="2">Código</th>
             <th>Nome</th>
             <th data-priority="3">Tel</th>
             <th data-priority="1">CPF</th>
             <th data-priority="5">Assinaturas</th>
           </tr>
         </thead>
         <tbody>
         <?php
	 $consultas = $mysqli->query("SELECT * FROM clientes order by nome ASC");
	 while($campo = mysqli_fetch_array($consultas)){
	 $cliente = $campo['id'];
	 $ass = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$cliente'");
	 $assinaturas = mysqli_num_rows($ass)
	 ?>
           <tr>
             <th><?php echo $campo['codigo']; ?></th>
             <td><?php echo $campo['nome']; ?><br>
	     <small><?php echo $campo['endereco']; ?> <?php echo $campo['numero']; ?> <?php echo $campo['bairro']; ?><br> <?php echo $campo['cidade']; ?> <?php echo $campo['estado']; ?></small></td>
             <td><?php echo $campo['tel']; ?></td>
             <td><?php echo $campo['cpf']; ?></td>
             <td><?php echo $assinaturas; ?></td>
           </tr>
           <?php } ?>
         </tbody>
       </table>
      
      <a href="#home" data-role="button" data-icon="back" data-inline="false" data-theme="b">Voltar</a>
    </div> 

    <div data-role="footer" data-position="fixed" data-theme="b">
      <h5>MyRouter ERP</h5>
    </div>

  </div>
  
  
  
  <div data-role="page" id="atendimentos" data-url="atendimentos" data-theme="a" data-title="MyRouter ERP">

    <div data-role="header" data-theme="b">
      <h1>MyRouter ERP</h1>
    </div>

    <div data-role="content">
      <h3>Atendimentos</h3>
      
      
      <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Exibir Colunas" data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th data-priority="4">Código</th>
             <th>Problema</th>
             <th data-priority="3">Diagnostico</th>
             <th data-priority="1">Cliente</th>
             <th data-priority="2">Ação</th>
           </tr>
         </thead>
         <tbody>
      <?php
         $consultas = $mysqli->query("SELECT * FROM ordemservicos WHERE tecnico = '$idbase' AND  encerrado = 'N'  ORDER BY id DESC");
         while($campo = mysqli_fetch_array($consultas)){
	    $cliente = $campo['cliente'];
	    $ass = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
	    $assinaturas = mysqli_fetch_array($ass)
      ?>
           <tr>
             <th><?php echo $campo['id']; ?></th>
             <td><?php echo $campo['problema']; ?></td>
             <td><?php echo $campo['diagnostico']; ?></td>
             <td><?php echo $assinaturas['nome']; ?><br>
	     <small><?php echo $assinaturas['endereco']; ?> <?php echo $assinaturas['numero']; ?> <?php echo $assinaturas['bairro']; ?><br> <?php echo $assinaturas['cidade']; ?> <?php echo $assinaturas['estado']; ?></small></td>

             <td><a href="../../myrouter/index.php?app=CadastroOS&id=<?php echo ($campo['id']); ?>" onclick="javascript: if (confirm('Deseja realmente baixar esta OS ?')) { window.location.href='../../myrouter/index.php?app=CadastroOS&id=<?php echo base64_encode($campo['id']); ?>&Ex=Baixar' } else { void('') };">BAIXAR</a></td>
            
           </tr>
           <?php } ?>
         </tbody>
       </table>
      
      <a href="#home" data-role="button" data-icon="back" data-inline="false" data-theme="b">Voltar</a>
    </div> 

    <div data-role="footer" data-position="fixed" data-theme="b">
      <h5>MYROUTER ERP</h5>
    </div>

  </div>
  
  
  <div data-role="page" id="torres" data-position="fixed" data-url="torres" data-theme="a" data-title="MyRouter ERP">

    <div data-role="header" data-theme="b">
      <h1>MYROUTER ERP</h1>
    </div>

    <div data-role="content">
      <h3>Torres</h3>
      
      <style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 100%; height: 550px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 //Sample code written by August Li
 
 var icon = new google.maps.MarkerImage("../assets/images/mapa.png",
 new google.maps.Size(74, 83), new google.maps.Point(0, 0),
 new google.maps.Point(10, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 
 var ictorre = new google.maps.MarkerImage("../assets/images/torre.png",
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
 
 if($serv['tipo'] == '1') {  $tipoimg = "../assets/images/antenas/rb.png"; }
 if($serv['tipo'] == '2') {  $tipoimg = "../assets/images/antenas/2.png"; }
 if($serv['tipo'] == '3') {  $tipoimg = "../assets/images/antenas/3.png"; }
 if($serv['tipo'] == '4') {  $tipoimg = "../assets/images/antenas/4.png"; }
 if($serv['tipo'] == '5') {  $tipoimg = "../assets/images/antenas/5.png"; }
 if($serv['tipo'] == '6') {  $tipoimg = "../assets/images/antenas/6.png"; }
 if($serv['tipo'] == '7') {  $tipoimg = "../assets/images/antenas/7.png"; }
 if($serv['tipo'] == '8') {  $tipoimg = "../assets/images/antenas/8.png"; }
 if($serv['tipo'] == '9') {  $tipoimg = "../assets/images/antenas/9.png"; }
 if($serv['tipo'] == '10') {  $tipoimg = "../assets/images/antenas/10.png"; }
 if($serv['tipo'] == '11') {  $tipoimg = "../assets/images/antenas/11.png"; }
 if($serv['tipo'] == '12') {  $tipoimg = "../assets/images/antenas/12.png"; }
 if($serv['tipo'] == '13') {  $tipoimg = "../assets/images/antenas/13.png"; }
 if($serv['tipo'] == '14') {  $tipoimg = "../assets/images/antenas/14.png"; }
 if($serv['tipo'] == '15') {  $tipoimg = "../assets/images/antenas/15.png"; }
 if($serv['tipo'] == '16') {  $tipoimg = "../assets/images/antenas/16.png"; }
 if($serv['tipo'] == '17') {  $tipoimg = "../assets/images/antenas/17.png"; }
 if($serv['tipo'] == '18') {  $tipoimg = "../assets/images/antenas/18.png"; }
 if($serv['tipo'] == '19') {  $tipoimg = "../assets/images/antenas/19.png"; }
 if($serv['tipo'] == '20') {  $tipoimg = "../assets/images/antenas/20.png"; }
 if($serv['tipo'] == '21') {  $tipoimg = "../assets/images/antenas/21.png"; }
 if($serv['tipo'] == '22') {  $tipoimg = "../assets/images/antenas/22.png"; }
 if($serv['tipo'] == '23') {  $tipoimg = "../assets/images/antenas/23.png"; }
 if($serv['tipo'] == '24') {  $tipoimg = "../assets/images/antenas/24.png"; }
 
 
 
 if($lat <> '') {
 echo ("addMarkerTorre($lat, $lng,'<div style=\"width:300px;\"><img height=\"68px\" src=$tipoimg><br><b>SERVIDOR</b><br/>$servidor | <b>IP:</b> $ip | <b>Conexões:</b> $registros <br>  </div>');\n");
 } 
 

 
 
 
 }
 ?>
 
 center = bounds.getCenter();
 map.fitBounds(bounds);

 }
 </script>
 
 <div id="map"></div>
     
      
      <a href="#home" data-role="button" data-icon="back" data-inline="false" data-theme="b">Voltar</a>
    </div> 

    <div data-role="footer" data-position="fixed" data-theme="b">
      <h5>MyRouter ERP</h5>
    </div>

  </div>
  
  


</body>
</html>
<?php } ?>