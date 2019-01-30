
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Ordem de Serviços</li>
          </ul>
        </div>
        
        <?php if($permissao['os1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Ordem de Serviço cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Ordem de Serviço alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Ordem de Serviço excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Ordem de Serviços</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Ordem de Serviços</small></h2>
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
                      <th>Ordem</th>
                      <th>Série</th>
                      <th>Técnico</th>
                      <th>Cliente</th>
                      <th>Situação</th>
                      <th>Emissão</th>
                      <th>Status</th>
                      <th>OS</th>
                      <th width="130">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM ordemservicos WHERE empresa = '$idempresa' AND encerrado = 'N' order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){

		  ?>
		  <tr>
                      <td>#<?php echo $campo['codigo']; ?></td>
                      <td><?php echo $campo['serie']; ?></td>
                      <td>
		      <?php
		      $idtec = $campo['tecnico']; 
		      $tec = $mysqli->query("SELECT * FROM tecnicos WHERE id = '$idtec'");
 		      $tecnicos = mysqli_fetch_array($tec);
 		      ?>
		      <?php echo $tecnicos['nome']; ?></td>
                      <td>
		      <?php
		      $idcli = $campo['cliente']; 
		      $cli = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcli'");
 		      $clientes = mysqli_fetch_array($cli);
 		      ?>
		      <?php echo $clientes['nome']; ?></td>
                      <td>
		      <?php if ($campo['situacao'] == 'O') { ?> Orçamento <?php } ?>
		      <?php if ($campo['situacao'] == 'I') { ?> Instalado <?php } ?>
		      <?php if ($campo['situacao'] == 'NI') { ?> Instalação <?php } ?>
		      <?php if ($campo['situacao'] == 'M') { ?> Manutenção <?php } ?>
		      <?php if ($campo['situacao'] == 'R') { ?> Recuperação <?php } ?>
		      <?php if ($campo['situacao'] == 'A') { ?> Aprovado <?php } ?>
		      <?php if ($campo['situacao'] == 'C') { ?> Cancelada <?php } ?>
		      </td>
                      <td><?php echo $campo['emissao']; ?></td>
                      
		      <td><?php if ($campo['status'] == 'S') { ?>Ativo<?php } else { ?>Bloqueado<?php } ?> </td>
              <td><?php if ($campo['encerrado'] == 'S') { ?>Encerrada<?php } else { ?>Aberta<?php } ?> </td>

              <td>
          <!--    <?php /*if ($campo['situacao'] == 'I' or $campo['situacao'] == 'O' or $campo['situacao'] == 'M' ) { */?>  -->
              <a href="imprimir-ordem.php?id=<?php echo base64_encode($campo['codigo']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Ordem de Serviço" target=_blank><i class="entypo-print"></i></a>&nbsp;        
              
          <!--    --><?php /*} */?>
	              
	      <a href="?app=CadastroOS&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      <?php if($logado['nivel'] == '1') { ?> 
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroOS&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&pedido=<?php echo $campo['codigo']; ?>' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      <?php } ?>
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Código</th>
                      <th>Série</th>
                      <th>Técnico</th>
                      <th>Cliente</th>
                      <th>Situação</th>
                      <th>Emissão</th>
                      <th>Status</th>
                      <th>OS</th>
                      <th width="130">Ações</th>
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
      
      