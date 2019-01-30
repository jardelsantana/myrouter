
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Controle de Banda</li>
          </ul>
        </div>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> QUEUE cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> QUEUE alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> QUEUE excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Controle<small>Banda</small></h1>
        </div>
        
        <a href="?app=CadastroBanda" class="btn btn-info">CRIAR REGRA</a>
        <br><br>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Controle de Banda</small></h2>
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
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>IP</th>
                      <th>Upload</th>
                      <th>Download</th>
                      <th width="220">Horários</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
 		  $consultas = $mysqli->query("SELECT * FROM controlebanda order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $conscliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($conscliente);
		  
		  $plano = $campo['plano'];
		  $consplano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($consplano);
		  ?>
		  <tr>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                      <td><?php echo $campo['ip']; ?></td>
                      <td><?php echo $campo['upload']; ?>kbps</td>
                      <td><?php echo $campo['download']; ?>kbps</td>
                      <td>
                      <?php 
                      $segundos = $campo['inicio'];
		      echo $uptimdata = gmdate("H:i:s", $segundos); ?> às <?php 
                      $segundos = $campo['fim'];
		      echo $uptimdata = gmdate("H:i:s", $segundos); ?>
                      <br>
                      
                      <?php if ($campo['dom'] == 'sun,') { ?><span class="label label-success">Domingo</span><?php } else { ?><span class="label label-danger">Domingo</span><?php } ?>
                      <?php if ($campo['seg'] == 'mon,') { ?><span class="label label-success">Segunda</span><?php } else { ?><span class="label label-danger">Segunda</span><?php } ?>
                      <?php if ($campo['ter'] == 'tue,') { ?><span class="label label-success">Terça</span><?php } else { ?><span class="label label-danger">Terça</span><?php } ?>
                      <?php if ($campo['qua'] == 'wed,') { ?><span class="label label-success">Quarta</span><?php } else { ?><span class="label label-danger">Quarta</span><?php } ?>
                      
                      <?php if ($campo['qui'] == 'thu,') { ?><span class="label label-success">Quinta</span><?php } else { ?><span class="label label-danger">Quinta</span><?php } ?>
                      <?php if ($campo['sex'] == 'fri,') { ?><span class="label label-success">Sexta</span><?php } else { ?><span class="label label-danger">Sexta</span><?php } ?>
                      <?php if ($campo['sab'] == 'sat,') { ?><span class="label label-success">Sábado</span><?php } else { ?><span class="label label-danger">Sábado</span><?php } ?>
                      
                      
                      </td>
                      
                      <td>
	      <a href="?app=CadastroBanda&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Configurar"><i class="entypo-tools"></i></a>&nbsp;
	      
	      <a href="?app=CadastroBanda&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>&nbsp;
	      
		      </td>
                    </tr>
                   <?php }  ?>
		  
		
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Cliente</th>
                      <th>Servidor</th>
                      <th>IP</th>
                      <th>Upload</th>
                      <th>Download</th>
                      <th>Horários</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        	
          </div>
        </div> 
      </div>