
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Assinaturas</li>
          </ul>
        </div>
        
        <?php if($permissao['a2'] == S) { ?>
        
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Assinatura cadastrada com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Assinatura alterada com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Assinatura excluída com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Assinaturas</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Assinaturas</small></h2>
              </header>
              
              <div style="padding:10px;background:#4682B4;width:16.66%;color:#ffffff;">&nbsp;Aguardando&nbsp;</div>
              <div style="padding:10px;background:#008000;width:16.66%;color:#ffffff;">&nbsp;Instalado&nbsp;</div>
              <div style="padding:10px;background:#FF0000;width:16.66%;color:#ffffff;">&nbsp;Cancelado&nbsp;</div>
              <div style="padding:10px;background:#FF4500;width:16.66%;color:#ffffff;">&nbsp;Não Encontrado&nbsp;</div>
              <div style="padding:10px;background:#FF7F50;width:16.66%;color:#ffffff;">&nbsp;Sem Equipamento&nbsp;</div>
              <div style="padding:10px;background:#9400D3;width:16.66%;color:#ffffff;">&nbsp;Desinstalação&nbsp;</div>
             
	      <div class="inner-spacer">
	      
        <div class="btn-group">
	<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false',ignoreColumn:'[7]'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
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
                      <th>Login</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Servidor</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Status</th>
                      <th width="160">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE empresa = '$idempresa'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  if ($campo['situacao'] == 'S') {
		  $cor = "4682B4;color:#ffffff;";
		  }
		  if ($campo['situacao'] == 'I') {
		  $cor = "008000;color:#ffffff;";
		  }
		  if ($campo['situacao'] == 'C') {
		  $cor = "FF0000;color:#ffffff;";
		  }
		  if ($campo['situacao'] == 'N') {
		  $cor = "FF4500;color:#ffffff;";
		  }
		  if ($campo['situacao'] == 'F') {
		  $cor = "FF7F50;color:#ffffff;";
		  }
		  if ($campo['situacao'] == 'D') {
		  $cor = "9400D3;color:#ffffff;";
		  }
          if ($campo['status'] == 'N') {
          $cor = "FF0000;color:#ffffff;";
          }


              ?>
		  <tr>
              <td style="background:#<?php echo $cor; ?>"><?php echo $campo['login']; ?></td>

              <td style="background:#<?php echo $cor; ?>">
		      <?php
		      $ccid = $campo['cliente'];
 		      $cliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$ccid'");
 		      $vcliente = mysqli_fetch_array($cliente)
 		      ?>
		      <?php echo $vcliente['nome']; ?></td>
                      <td style="background:#<?php echo $cor; ?>">
		      <?php
		      $ppid = $campo['plano'];
 		      $plano = $mysqli->query("SELECT * FROM planos WHERE id = '$ppid'");
 		      $vplano = mysqli_fetch_array($plano)
 		      ?>
		      <?php echo $vplano['nome']; ?>
		      </td>
                      <td style="background:#<?php echo $cor; ?>">
		      <?php
		      //$ssid = $vplano['servidor'];
			  $ssid = $campo['servidor'];
 		      $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$ssid'");
 		      $vservidor = mysqli_fetch_array($servidor)
 		      ?>
		      <?php //echo $vservidor['servidor'];?>
			  <?php echo $vservidor['servidor'];?>


					  </td>
                   <td style="background:#<?php echo $cor; ?>">
                   <?php
                   

               $desconto = $campo['desconto'];
    		   $acrescimo = $campo['acrescimo'];
    
    		   if ($desconto <> '') {
    		   $valorservicos = ($vplano['preco'] - $desconto);
    		   } elseif ($acrescimo <> '') {
    		   $valorservicos = ($vplano['preco'] + $acrescimo);
    		   } else {
    		   $valorservicos = $vplano['preco']; 
    		   } 
    		   ?>
                   
		   R$ <?php echo number_format($valorservicos,2,',','.'); ?>
		   
		   
		   </td>
 		      <td style="background:#<?php echo $cor; ?>">
		       <?php if ($campo['situacao'] == 'S') { ?>Aguardando Instalação<?php } ?>
		       <?php if ($campo['situacao'] == 'O') { ?>Orçamento<?php } ?>
		       <?php if ($campo['situacao'] == 'I') { ?>Instalado<?php } ?>
		       <?php if ($campo['situacao'] == 'C') { ?>Instalação Cancelada<?php } ?>
		       <?php if ($campo['situacao'] == 'N') { ?>Não Encontrado<?php } ?>
		       <?php if ($campo['situacao'] == 'F') { ?>Falta de Equipamento<?php } ?>
		       <?php if ($campo['situacao'] == 'D') { ?>Desinstalação<?php } ?>
		       </td>
		      <td style="background:#<?php echo $cor; ?>"><?php if ($campo['status'] == 'S') { ?>Ativo<?php } else { ?>Bloqueado<?php } ?> </td>
                      <td style="background:#<?php echo $cor; ?>">
                      
                      <?php
                      $pedido = $campo['pedido'];
                      $ffnx = $mysqli->query("SELECT * FROM financeiro WHERE pedido = '$pedido' AND situacao = 'N'");
 		      $contar = mysqli_num_rows($ffnx);
 		      
 		      ?>
                      <?php if (@$contar == "0" && ($campo['status'] == 'S') && ($campo['insento'] == 'N'))  { ?>
                      <a href="renovar.php?id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Renovar Assinaturas" target=_blank><i class="fa fa-money"></i></a>&nbsp;
                      <?php } ?>

                      <?php if ($campo['situacao'] == 'S' || $campo['situacao'] == 'D') { ?>
                      <a href="imprimir-ordem.php?id=<?php echo base64_encode($campo['pedido']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Pedido de Instalação" target=_blank><i class="entypo-print"></i></a>&nbsp;<?php } ?>
                      
                       <a href="geradoc.php?id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Contrato" target=_blank><i class="fa fa-file-text-o"></i></a>&nbsp;
                      
	      <a href="?app=CadastroAssinatura&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      <?php if($logado['nivel'] == '1') { ?> 
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroAssinatura&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      <?php } ?>
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Login</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Servidor</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Status</th>
                      <th width="160">Ações</th>
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
      