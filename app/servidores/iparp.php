<?php
$idmk = base64_decode($_GET['id']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);


?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li class="active">IP/ARP</li>
          </ul>
        </div>
        <?php if($permissao['mk7'] == S) { ?>
        
        <div class="page-header">
          <h1>IP/ARP<small><?php echo $mk['servidor']; ?></small></h1>
        </div>
               
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Tabela ARP </h2>
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
                      <th>Comentário</th>
                      <th>IP</th>
                      <th>MAC</th>
                      <th>Interface</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$mk['ip'].'', ''.$mk['login'].'', ''.$mk['senha'].'')) {
$ARRAY = $API->comm("/ip/arp/print");


for ($i = 0; $i < count($ARRAY); ++$i)
{
$first = $ARRAY[$i];
?>
		     <tr>
                     <td><?php echo $first['.id']; ?></td>
                      <td><?php echo $first['comment']; ?></td>
                      <td><?php echo $first['address']; ?></td>
                      <td><?php echo $first['mac-address']; ?></td>
                      <td><?php echo $first['interface']; ?></td>
                    </tr>
<?php 
}
   $API->disconnect();
}

?>     
                    
                  </tbody>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Comentário</th>
                      <th>IP</th>
                      <th>MAC</th>
                      <th>Interface</th>
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