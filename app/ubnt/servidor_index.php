<?php
/*// Backup

if($_GET['bkp'] == "OK") {

$regbkp = $mysqli->query("SELECT * FROM servidores WHERE tiporouter = 'UBIQUITI' AND empresa = '$idempresa'");
$mk = mysqli_fetch_array($regbkp);
$ipmk = $mk["ip"];
$loginmk = $mk["login"];
$senhamk = $mk["senha"];
$idmk = $mk["id"];
$nomemk = $mk["servidor"];

$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$ipmk.'', ''.$loginmk.'', ''.$senhamk.''))
{

$API->write('/system/backup/save',false);
$API->write('=name=backup-mikrotik.backup' );  
$ARRAY = $API->read();
    
$API->disconnect();
}   

$data = date('dmY');
$databkp = date('d/m/Y');

$targetFile = "backup-mikrotik".$data.".backup";
$sourceFile = "ftp://$ipmk/backup-mikrotik.backup";
$ftpuser = "$loginmk";
$ftppassword = "$senhamk";
$regkey = base64_encode(md5($targetFile));

$crud = new crud('backups');  // tabela como parametro
$crud->inserir("idmk,servidor,arquivo,data,regkey", "'$idmk','$nomemk','$targetFile','$databkp','$regkey'");

function saveFtpFile( $targetFile = null, $sourceFile = null, $ftpuser = null, $ftppassword = null ){
 
// function settings
$timeout = 50;
$fileOpen = 'w';
 
$curl = curl_init();
$file = fopen ('backups/'.$targetFile, $fileOpen);
curl_setopt($curl, CURLOPT_URL, $sourceFile); 
curl_setopt($curl, CURLOPT_USERPWD, $ftpuser.':'.$ftppassword);
 
	// curl settings
	curl_setopt($curl, CURLOPT_FAILONERROR, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_FILE, $file); 
 
	$result = curl_exec($curl);
	$info = curl_getinfo($curl);
 
	curl_close($curl);
	fclose($file);
 
	return $result;
 
}
 
var_dump(saveFtpFile( $targetFile, $sourceFile, $ftpuser, $ftppassword ));

header("Location: index.php?app=ServidoresUBNT&reg=4");
}*/
?>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Servidores</li>
          </ul>
        </div>
        
        <?php if($permissao['mk1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Servidor cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Servidor alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Servidor excluído com sucesso. </div>
	<?php } ?>
        <?php if ($_GET['reg'] == '4') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Backup do UBNT realizado com sucesso. </div>
	<?php } ?>

	        <?php if ($_GET['reg'] == '5') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Auto Bloqueio realizado com sucesso. </div>
	<?php } ?>

        <div class="page-header">
          <h1>Servidores<small>UBNT</small></h1>
        </div>
        
        <a href="?app=CadastroUbiquiti" class="btn btn-info">NOVO SERVIDOR</a>
        <br><br>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>UBNT</small></h2>
              </header>
              <div class="inner-spacer">
              
                    <div class="btn-group">
	<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'sql'});"> <img src='assets/images/sql.png' width='24px'> SQL</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'csv',escape:'false'});"> <img src='assets/images/csv.png' width='24px'> CSV</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'txt',escape:'false'});"> <img src='assets/images/txt.png' width='24px'> TXT</a></li>
	<li class="divider"></li>				
								
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'excel',escape:'false'});"> <img src='assets/images/xls.png' width='24px'> XLS</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'doc',escape:'false'});"> <img src='assets/images/word.png' width='24px'> Word</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'powerpoint',escape:'false'});"> <img src='assets/images/ppt.png' width='24px'> PowerPoint</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'png',escape:'false'});"> <img src='assets/images/png.png' width='24px'> PNG</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src='assets/images/pdf.png' width='24px'> PDF</a></li>
		</ul>
		</div>	<br>
	      <br>
              
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>UBNT</th>
                      <th>Servidor</th>
                      <th>IP</th>
                      <th>Uptime</th>
                      <th>Interface</th>
                      <th width="126">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  ini_set("allow_url_fopen", 1);
                  ini_set("display_errors", 0);
		  error_reporting(0);
		  ini_set("track_errors","0");
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM servidores WHERE tiporouter = 'UBIQUITI' AND empresa = '$idempresa'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		 // $DB = @fsockopen($campo['ip'], 8728, $errno, $errstr, 10);
		  		  
		  if($DB)
		  {
	
		  $router = $campo["ip"];
    		  $username = $campo["login"];
    		  $password = $campo["senha"];
    
/*    		  // NOVA API
    		  $comando = '/system/resource/print';
    		  $args    = array('.proplist' => 'version,cpu,cpu-frequency,cpu-load,uptime,free-memory,free-hdd-space,total-hdd-space,total-memory');

    		  $mikrotik = new Lib_RouterOS();
    		  $mikrotik->setDebug(false);
    		  try {
    		  $mikrotik->connect($router);
    		  $mikrotik->login($username, $password);
    		  $mikrotik->send($comando, $args);
    		  $response = $mikrotik->read();

    		  $first = $response['0'];

    		  } catch (Exception $ex) {
    		  // echo "Debug: " . $ex->getMessage() . "\n";
    		  }
    		  // FIM API
		  
		  $memperc = ($first['free-memory']/$first['total-memory']);
		  $hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
		  $mem = ($memperc*100);
		  $hdd = ($hddperc*100);*/
		  ?>
		  <tr>
                     <td>
	<?php if($campo['tipo'] == '1') { ?><img style="height:60px;" src="assets/images/antenas/rb.png"><?php } ?>
	<?php if($campo['tipo'] == '2') { ?><img style="height:60px;" src="assets/images/antenas/2.png"><?php } ?>
	<?php if($campo['tipo'] == '3') { ?><img style="height:60px;" src="assets/images/antenas/3.png"><?php } ?>
	<?php if($campo['tipo'] == '4') { ?><img style="height:60px;" src="assets/images/antenas/4.png"><?php } ?>
	<?php if($campo['tipo'] == '5') { ?><img style="height:60px;" src="assets/images/antenas/5.png"><?php } ?>
	<?php if($campo['tipo'] == '6') { ?><img style="height:60px;" src="assets/images/antenas/6.png"><?php } ?>
	<?php if($campo['tipo'] == '7') { ?><img style="height:60px;" src="assets/images/antenas/7.png"><?php } ?>
	<?php if($campo['tipo'] == '8') { ?><img style="height:60px;" src="assets/images/antenas/8.png"><?php } ?>
	<?php if($campo['tipo'] == '9') { ?><img style="height:60px;" src="assets/images/antenas/9.png"><?php } ?>
	<?php if($campo['tipo'] == '10') { ?><img style="height:60px;" src="assets/images/antenas/10.png"><?php } ?>
	<?php if($campo['tipo'] == '11') { ?><img style="height:60px;" src="assets/images/antenas/11.png"><?php } ?>
	<?php if($campo['tipo'] == '12') { ?><img style="height:60px;" src="assets/images/antenas/12.png"><?php } ?>
	<?php if($campo['tipo'] == '13') { ?><img style="height:60px;" src="assets/images/antenas/13.png"><?php } ?>
	<?php if($campo['tipo'] == '14') { ?><img style="height:60px;" src="assets/images/antenas/14.png"><?php } ?>
	<?php if($campo['tipo'] == '15') { ?><img style="height:60px;" src="assets/images/antenas/15.png"><?php } ?>
	<?php if($campo['tipo'] == '16') { ?><img style="height:60px;" src="assets/images/antenas/16.png"><?php } ?>
	<?php if($campo['tipo'] == '17') { ?><img style="height:60px;" src="assets/images/antenas/17.png"><?php } ?>
	<?php if($campo['tipo'] == '18') { ?><img style="height:60px;" src="assets/images/antenas/18.png"><?php } ?>
	<?php if($campo['tipo'] == '19') { ?><img style="height:60px;" src="assets/images/antenas/19.png"><?php } ?>
	<?php if($campo['tipo'] == '20') { ?><img style="height:60px;" src="assets/images/antenas/20.png"><?php } ?>
	<?php if($campo['tipo'] == '21') { ?><img style="height:60px;" src="assets/images/antenas/21.png"><?php } ?>
	<?php if($campo['tipo'] == '22') { ?><img style="height:60px;" src="assets/images/antenas/22.png"><?php } ?>
	<?php if($campo['tipo'] == '23') { ?><img style="height:60px;" src="assets/images/antenas/23.png"><?php } ?>
	<?php if($campo['tipo'] == '24') { ?><img style="height:60px;" src="assets/images/antenas/24.png"><?php } ?>
	<?php if($campo['tipo'] == '25') { ?><img style="height:60px;" src="assets/images/antenas/edgerouterx.png"><?php } ?>
	<?php if($campo['tipo'] == '26') { ?><img style="height:60px;" src="assets/images/antenas/edgeroutelite.png"><?php } ?>
	<?php if($campo['tipo'] == '27') { ?><img style="height:60px;" src="assets/images/antenas/edgeroutepro.png"><?php } ?>
		     </td>
                      <td><?php echo $campo['servidor']; ?><br>
		      <?php echo $first['cpu']; ?> <?php echo $first['board-name']; ?> Versão: <?php echo $first['version']; ?> </td>
                      <td><?php echo $campo['ip']; ?></td>
                      <td>
		      <script type='text/javascript'>
		      $(document).ready(function() {
 	 	      $("#up<?php echo $campo['id']; ?>").load("app/uptime.php?ip=<?php echo $campo['ip']; ?>&login=<?php echo $campo['login']; ?>&senha=<?php echo $campo['senha']; ?>");
   		      var refreshId = setInterval(function() {
      		      $("#up<?php echo $campo['id']; ?>").load("app/uptime.php?ip=<?php echo $campo['ip']; ?>&login=<?php echo $campo['login']; ?>&senha=<?php echo $campo['senha']; ?>");
   		      }, 1000);
   		      $.ajaxSetup({ cache: false });
   		      });
   		      </script>
		      <div id="up<?php echo $campo['id']; ?>"></div>
		      
		      </td>
                      <td><?php echo $campo['interface']; ?><br>
		      HDD <?php echo number_format($first['total-hdd-space'], 1, '.', '.'); ?> Kb</td>
                      <td>
                      
           <a href="?app=Servidores&id=<?php echo base64_encode($campo['id']); ?>&bkp=OK" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="BACKUP"><i class="fa fa-hand-o-down"></i></a>&nbsp;
                      
	       <a href="?app=CadastroUbiquiti&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Configurar"><i class="entypo-tools"></i></a>&nbsp;

           <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroUbiquiti&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&nome=<?php echo $campo['nome']; ?>&srv=<?php echo $campo['servidor']; ?>' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>

	       <a href="../myrouter/app/autobloqueio.php" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="AUTO BLOQUEIO"><i class="fa fa-frown-o"></i></a>&nbsp;

                      </td>
                    </tr>
            		  
		  <?php } else { ?>

		  <tr>
                     <td>
	<?php if($campo['tipo'] == '1') { ?><img style="height:60px;" src="assets/images/antenas/rb.png"><?php } ?>
	<?php if($campo['tipo'] == '2') { ?><img style="height:60px;" src="assets/images/antenas/2.png"><?php } ?>
	<?php if($campo['tipo'] == '3') { ?><img style="height:60px;" src="assets/images/antenas/3.png"><?php } ?>
	<?php if($campo['tipo'] == '4') { ?><img style="height:60px;" src="assets/images/antenas/4.png"><?php } ?>
	<?php if($campo['tipo'] == '5') { ?><img style="height:60px;" src="assets/images/antenas/5.png"><?php } ?>
	<?php if($campo['tipo'] == '6') { ?><img style="height:60px;" src="assets/images/antenas/6.png"><?php } ?>
	<?php if($campo['tipo'] == '7') { ?><img style="height:60px;" src="assets/images/antenas/7.png"><?php } ?>
	<?php if($campo['tipo'] == '8') { ?><img style="height:60px;" src="assets/images/antenas/8.png"><?php } ?>
	<?php if($campo['tipo'] == '9') { ?><img style="height:60px;" src="assets/images/antenas/9.png"><?php } ?>
	<?php if($campo['tipo'] == '10') { ?><img style="height:60px;" src="assets/images/antenas/10.png"><?php } ?>
	<?php if($campo['tipo'] == '11') { ?><img style="height:60px;" src="assets/images/antenas/11.png"><?php } ?>
	<?php if($campo['tipo'] == '12') { ?><img style="height:60px;" src="assets/images/antenas/12.png"><?php } ?>
	<?php if($campo['tipo'] == '13') { ?><img style="height:60px;" src="assets/images/antenas/13.png"><?php } ?>
	<?php if($campo['tipo'] == '14') { ?><img style="height:60px;" src="assets/images/antenas/14.png"><?php } ?>
	<?php if($campo['tipo'] == '15') { ?><img style="height:60px;" src="assets/images/antenas/15.png"><?php } ?>
	<?php if($campo['tipo'] == '16') { ?><img style="height:60px;" src="assets/images/antenas/16.png"><?php } ?>
	<?php if($campo['tipo'] == '17') { ?><img style="height:60px;" src="assets/images/antenas/17.png"><?php } ?>
	<?php if($campo['tipo'] == '18') { ?><img style="height:60px;" src="assets/images/antenas/18.png"><?php } ?>
	<?php if($campo['tipo'] == '19') { ?><img style="height:60px;" src="assets/images/antenas/19.png"><?php } ?>
	<?php if($campo['tipo'] == '20') { ?><img style="height:60px;" src="assets/images/antenas/20.png"><?php } ?>
	<?php if($campo['tipo'] == '21') { ?><img style="height:60px;" src="assets/images/antenas/21.png"><?php } ?>
	<?php if($campo['tipo'] == '22') { ?><img style="height:60px;" src="assets/images/antenas/22.png"><?php } ?>
	<?php if($campo['tipo'] == '23') { ?><img style="height:60px;" src="assets/images/antenas/23.png"><?php } ?>
	<?php if($campo['tipo'] == '24') { ?><img style="height:60px;" src="assets/images/antenas/24.png"><?php } ?>
	<?php if($campo['tipo'] == '25') { ?><img style="height:60px;" src="assets/images/antenas/edgerouterx.png"><?php } ?>
	<?php if($campo['tipo'] == '26') { ?><img style="height:60px;" src="assets/images/antenas/edgeroutelite.png"><?php } ?>
	<?php if($campo['tipo'] == '27') { ?><img style="height:60px;" src="assets/images/antenas/edgeroutepro.png"><?php } ?>

		     </td>
                      <td><?php echo $campo['servidor']; ?></td>
                      <td><?php echo $campo['ip']; ?></td>
                      <td>OFFLINE </td>
                      <td><?php echo $campo['interface']; ?><br>
		      HDD Não Disponível</td>
                      <td>
                      <a href="?app=Sincronizar&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Sincronizar"><i class="fa fa-refresh"></i></a>&nbsp;
                      
	      <a href="?app=CadastroUbiquiti&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Configurar"><i class="entypo-tools"></i></a>&nbsp;
	      
	      <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroServidor&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
		  
		      </td>
                    </tr>
		  
		  <?php } } ?>


		  
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>UBNT</th>
                      <th>Servidor</th>
                      <th>IP</th>
                      <th>Uptime</th>
                      <th>Interface</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        	
          </div>
        </div> 
      </div>
      
      
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