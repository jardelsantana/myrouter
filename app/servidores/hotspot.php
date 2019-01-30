<?php
$idmk = base64_decode($_GET['id']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);

if($_GET['rmid'] == "Ok") { 

$idmk = base64_decode($_GET['id']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);

$user = base64_decode($_GET['user']);
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].'')) {
$API->write('/ip/hotspot/active/remove',false);
$API->write('=.id='.$user.'' );
$ARRAY = $API->read();
$ref = $_GET['id'];
}
header("Location: index.php?app=HOTSPOT&id=$ref&reg=1");	
}

?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li class="active">HotSpot</li>
          </ul>
        </div>
        
        <?php if($permissao['mk9'] == S) { ?>
        
         <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Usuário derrubado do HotSpot. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>HOTSPOT<small><?php echo $mk['servidor']; ?></small></h1>
        </div>
               
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Tabela Usuários Ativos HotSpot </h2>
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
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>IP</th>
                      <th>Tipo</th>
                      <th>UpTime</th>
                      <th>MAC</th>
                      <th>Servidor</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$mk['ip'].'', ''.$mk['login'].'', ''.$mk['senha'].'')) {
$ARRAY = $API->comm("/ip/hotspot/active/print");


for ($i = 0; $i < count($ARRAY); ++$i)
{
$first = $ARRAY[$i];
?>
		     <tr>
                      <td><?php echo $first['.id']; ?></td>
                      <td><?php echo $first['user']; ?></td>
                      <td><?php echo $first['address']; ?></td>
                      <td><?php echo $first['login-by']; ?></td>
                      <td><script type='text/javascript'>
		      $(document).ready(function() {
 	 	      $("#up<?php echo $i; ?>").load("app/uptimehotspot.php?ip=<?php echo $mk['ip']; ?>&login=<?php echo $mk['login']; ?>&senha=<?php echo $mk['senha']; ?>");
   		      var refreshId = setInterval(function() {
      		      $("#up<?php echo $i; ?>").load("app/uptimehotspot.php?ip=<?php echo $mk['ip']; ?>&login=<?php echo $mk['login']; ?>&senha=<?php echo $mk['senha']; ?>");
   		      }, 1000);
   		      $.ajaxSetup({ cache: false });
   		      });
   		      </script>
		      <div id="up<?php echo $i; ?>"></div></td>
                      <td><?php echo $first['mac-address']; ?></td>
                      <td><?php echo $first['server']; ?></td>
                      <td><a href="index.php?app=HOTSPOT&id=<?php echo $_GET['id']; ?>&user=<?php echo base64_encode($first['.id']); ?>&rmid=Ok" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Derrubar Usuário"><i class="fa fa-thumbs-down"></i></a>
		      
		      <button class="btn btn-info"  title="PING" data-toggle="modal" data-target="#myModal<?php echo $i+1; ?>"><i class="fa fa-gear"></i></button>
		      
		       <div class="modal" id="myModal<?php echo $i+1; ?>" tabindex="-1" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Ping <?php echo $first['address']; ?></h4>
                                          </div>
                                            <div class="modal-body">
                             <iframe src="ping.php?ip=<?php echo $mk['ip']; ?>&login=<?php echo $mk['login']; ?>&senha=<?php echo $mk['senha']; ?>&ping=<?php echo $first['address']; ?>" width="100%" frameborder="0" height="150"></iframe>
                             
                                            </div>
                                            <div class="modal-footer">
                                         <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
		      
		      
		      </td>
                    </tr>
<?php 
//print_r($ARRAY);
}
   $API->disconnect();
}

?>     
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>IP</th>
                      <th>Tipo</th>
                      <th>UpTime</th>
                      <th>Download</th>
                      <th>Upload</th>
                      <th>Ação</th>
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