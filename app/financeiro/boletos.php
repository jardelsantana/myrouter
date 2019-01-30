
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Financeiro</li>
          </ul>
        </div>
        
       <?php if($permissao['ft1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Boleto alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Boleto excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Boletos <small>Boletos Avulsos</small></h1>  
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
      
            <div class="powerwidget green" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Boletos Avulsos</small></h2>
              </header>
              <div class="inner-spacer">
              
                    <div class="btn-group">
	<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false',ignoreColumn:'[6]'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
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
                      <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Serviço</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $mes = date('m');
 		  $ano = date('Y');
 		  $consultas = $mysqli->query("SELECT * FROM boletos order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
		
		      $dat_venc = date('d/m/Y',strtotime($campo['vencimento']));
		      $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
		      $valor_doc = $campo['valor'];
 		      $juros = ((0.25 * (diasEntreData($dat_venc,$dat_novo_venc ))));
 
 		      if(diasEntreData($dat_venc,$dat_novo_venc)==0)
		      {$multa = 0;}
		      else
		      {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);
 
 		      $valorDocComJuros = $valor_doc + ($juros + $multa);
		      $atrasodias = diasEntreData($dat_venc,$dat_novo_venc);
		      $jurosdias = Moeda($juros);
		      $multadias = Moeda($multa);
		      $valoratual = $valorDocComJuros;
 
 		      $valor_doc = $valor_doc + ($juros + $multa);
		      $juros = Moeda($juros);
		      $multa = Moeda($multa);
 		      
 		       $cda = explode("/",date('d/m/Y',strtotime($campo['vencimento'])));
    	          $ffdn = $cda[0];
    	          $ffmm = $cda[1];
                  $ffaa = $cda[2];

   //           $datavencido = $campo['vencimento'];
              $datavencido = $ffaa."-".$ffmm."-".$ffdn;
		      if($datavencido < date('Y-m-d')) { 
		      $valordoboletofn = number_format($valoratual,2,',','.');
		      
		      $exibevaloresboleto = "<br>Juros: R$ $juros <br>Multa: R$ $multa ";
		      $exibeprazosboleto = "<br><span class='label label-info'>Novo Vencimento: $dat_novo_venc ";
		      
		      } else {
		      $valordoboletofn = number_format($campo['valor'],2,',','.');
		      }
	              ?>
		  
		  <tr>
                      <td><?php echo $campo['id']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $campo['servico']; ?></td>
                      <?php if ($campo['status'] == 'P') { ?>
                      <td>R$ <?php echo $campo['valor']; ?></td>
 		      <td><?php echo date('d/m/Y',strtotime($campo['vencimento'])); ?></td>
                      <?php } else { ?>
                      <td>R$ <?php echo $valordoboletofn; ?><?php echo $exibevaloresboleto; ?></td>
 		      <td><?php echo date('d/m/Y',strtotime($campo['vencimento'])); ?><?php echo $exibeprazosboleto; ?></td>
 		      <?php } ?>
		      <td>
		      <?php if ($campo['status'] == 'A') { ?>ABERTO<?php } ?>
		      <?php if ($campo['status'] == 'C') { ?>CANCELADO<?php } ?>
		      <?php if ($campo['status'] == 'P') { ?>PAGO<?php } ?>
		      <?php if ($campo['status'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['status'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
		      
                      <td>
                      <?php if ($campo['status'] == 'P') { ?>
		      <span class="label label-success">CONFIRMADO</span>
		      <?php } else { ?>
              <a href="boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=2" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;
                      
	      <a href="?app=CadastroBoleto&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroBoleto&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&codigo=<?php echo base64_encode($campo['boleto']); ?>' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      <?php } ?>
		      </td>
                    </tr>

                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Serviço</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
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
      
      