
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Controle de IP Pool</li>
          </ul>
        </div>
        
        <?php if($permissao['mk4'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Pool cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Pool alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Pool excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Controle<small>IP Pool</small></h1>
        </div>
        
        <a href="?app=CadastroPool" class="btn btn-info">CRIAR IPPool</a>
        <br><br>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Controle de IP</small></h2>
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
                      <th>Pool</th>
                      <th>Classe IP</th>
                      <th>Nº de Planos</th>
                      <th>Nº de Clientes</th>
                      <th>Servidor</th>
                      <th>IP</th>
                      <th width="60">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
 		  $consultas = $mysqli->query("SELECT * FROM ippool order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $pool = $campo['nome'];
		  $planos = $mysqli->query("SELECT * FROM planos WHERE pool = '$pool'");
 		  $rowplano = mysqli_num_rows($planos);
 		  $plano = mysqli_fetch_array($planos);
 		  
 		  $assinard = $plano['id'];
		  $cclientes = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$assinard'");
 		  $rowcliente = mysqli_num_rows($cclientes);
		  
		  $ssrv = $campo['servidor'];
		  $servd = $mysqli->query("SELECT * FROM servidores WHERE id = '$ssrv'");
 		  $servidor = mysqli_fetch_array($servd);
		  ?>
		  <tr>
                      <td><?php echo $campo['nome']; ?></td>
                      <td><?php echo $campo['ranges']; ?></td>
                      <td><span class="label label-info"><?php echo $rowplano; ?></span></td>
                      <td><span class="label label-success"><?php echo $rowcliente; ?></span></td>
                      <td><?php echo $servidor['servidor']; ?></td>
                      <td><?php echo $servidor['ip']; ?></td>
                   <td>
	    
	      <a href="?app=CadastroPool&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&pool=<?php echo $campo['nome']; ?> &pedido=<?php echo $campo['pedido']; ?>&servidor=<?php echo $campo['servidor']; ?>" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>&nbsp;
	      
		      </td>
                    </tr>
                   <?php }  ?>
		  
		
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Pool</th>
                      <th>Classe IP</th>
                      <th>Nº de Planos</th>
                      <th>Nº de Clientes</th>
                      <th>Servidor</th>
                      <th>IP</th>
                      <th width="60">Ações</th>
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