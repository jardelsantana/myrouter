
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="">Ferramentas</a></li>
            <li class="active">SICI</li>
          </ul>
        </div>
        
        <?php if($permissao['fr1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> SICI cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> SICI alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> SICI excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Ferramentas <small>Coleta SICI</small></h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <a href="index.php?app=CadastroSICI" class="btn btn-info">NOVA COLETA SICI</a><br><br>
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Ferramentas<small>Gerenciar SICI</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Ano</th>
                      <th>Mês</th>
                      <th>Fistel</th>
                      <th>Número</th>
                      <th>Autorização</th>
                      <th width="150">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM sici WHERE empresa = '$idempresa'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  ?>
		  <tr>
                      <td><?php echo $campo['ano']; ?></td>
                      <td>
		      <?php if($campo['mes'] == 1) { ?> Janeiro <?php } ?>
		      <?php if($campo['mes'] == 2) { ?> Fevereiro <?php } ?>
		      <?php if($campo['mes'] == 3) { ?> Março <?php } ?>
		      <?php if($campo['mes'] == 4) { ?> Abril <?php } ?>
		      <?php if($campo['mes'] == 5) { ?> Maio <?php } ?>
		      <?php if($campo['mes'] == 6) { ?> Junho <?php } ?>
		      <?php if($campo['mes'] == 7) { ?> Julho <?php } ?>
		      <?php if($campo['mes'] == 8) { ?> Agosto <?php } ?>
		      <?php if($campo['mes'] == 9) { ?> Setembro <?php } ?>
		      <?php if($campo['mes'] == 10) { ?> Outubro <?php } ?>
		      <?php if($campo['mes'] == 11) { ?> Novembro <?php } ?>
		      <?php if($campo['mes'] == 12) { ?> Dezembro <?php } ?>
		      </td>
                      <td><?php echo $campo['outorga']; ?></td>
                      <td><?php echo $campo['num_cat']; ?></td>
 		      <td><?php echo md5($campo['outorga']); ?></td>
                      <td>
                      <a href="download-sici.php?sici=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Download XML SICI" target=_blank><i class=" entypo-download"></i></a>&nbsp;
                      
                      <a href="xml-sici.php?sici=<?php echo base64_encode($campo['id']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Visualizar XML SICI" target=_blank><i class=" entypo-network"></i></a>&nbsp;
                      
                      
	      <a href="?app=CadastroSICI&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroSICI&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Ano</th>
                      <th>Mês</th>
                      <th>Fistel</th>
                      <th>Número</th>
                      <th>Autorização</th>
                      <th width="110">Ações</th>
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