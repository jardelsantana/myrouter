
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Financeiro</li>
          </ul>
        </div>
        
        <?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Fatura alterada com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Fatura excluída com sucesso. </div>
	<?php } ?>

        <?php if ($_GET['reg'] == '5') { ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i></button>
                <strong>Atenção!</strong> Fatura Enviada com Sucesso. </div>
        <?php } ?>

        <?php if ($_GET['reg'] == '6') { ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i></button>
                <strong>Atenção!</strong> Ocorreu algum erro na configuração do seu email, Mensagem não foi enviada. </div>
        <?php } ?>

        
        <?php if($permissao['f1'] == S) { ?>
        
        <div class="page-header">
          <h1>Faturas <small>Ano de <?php echo date('Y'); ?></small></h1>  
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
      	  
            <div class="powerwidget green" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Faturas</small></h2>
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
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'pdf',pdfFontSize:'9',escape:'false',ignoreColumn:'[6]'});"> <img src='assets/images/pdf.png' width='24px'> PDF</a></li>
		</ul>
		</div>	<br>
	      <br>
              
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                      <th width="160">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
        ///////////////////////////////////////////////////////////////
		                   /*   CANCELANDO FATURAS GERENCIANET */
		//////////////////////////////////////////////////////////////				   
		
		if(isset($_GET['acao']) == "cancelar"){
			$id = $_GET['id'];	
			
			$sql= $mysqli->query("SELECT * FROM financeiro WHERE id='$id'");
			$ver = mysqli_fetch_array($sql);
			
			$sql = $mysqli->query("SELECT token_gnet FROM empresa") or die(mysqli_error());
	 		$t = mysqli_fetch_array($sql);
	 		$token = $t['token_gnet'];
		
		
		
		$url = 'https://fortunus.gerencianet.com.br/webservice/cancelarCobranca';

		$token = $token;
 
		$chave = $ver['chave'];

		$xml = "<?xml version='1.0' encoding='utf-8'?>
		<CancelarCobranca>
		 <Token>{$token}</Token>
		 <Chave>{$chave}</Chave>
		</CancelarCobranca>";

			$xml = str_replace("\n", '', $xml);
			$xml = str_replace("\r",'',$xml);
			$xml = str_replace("\t",'',$xml);
 
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url);
			 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 
			curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
			 
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			 
			$data = array('xml' => $xml);
			 
			curl_setopt($ch, CURLOPT_POST, true);
			 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			 
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			 
			curl_setopt($ch, CURLOPT_USERAGENT, 'seu agente');
			 
			$resposta = curl_exec($ch);
			 
			curl_close($ch);
			 
			//$resposta;
			
			$objXml = simplexml_load_string($resposta);
			
				$chave = $objXml->Mensagem;
			
			if($objXml->StatusCod == 1){
				$resp = "Ocorreu um erro ao cancelar a fatura";	
			}else{
				$resp = utf8_decode($chave);					
				$up = $mysqli->query("UPDATE financeiro SET situacao = 'C' WHERE id='$id'");
			
				print "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?app=Financeiro&reg=2'>
				<script type=\"text/javascript\">
				alert(\"'".$resp."'\");
				</script>";
				exit;	
			
			}	
		}
		
	/////////////////////////////// FIM CANCELAMENTO GERENCIA NET /////////////////////////////////	          
 		  $mes = date('m');
 		  $ano = date('Y');

        $empresaC = $mysqli->query("SELECT * FROM empresa");
        $EmpresaCAMPO = mysqli_fetch_array($empresaC);


 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE ano = '$ano'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $link = $campo['linkGerencia'];
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <?php if($campo['situacao'] == "P" || $campo['situacao'] == "C") { echo ""; } else { ?>
		  <tr>
                      <td><?php echo $campo['id']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                    
		      <?php
 		      $data_inicial = $campo['cadastro'];
 		      $data_final = $campo['vencimento'];
 		      $diferenca = strtotime($data_final) - strtotime($data_inicial);
 		      $dias = floor($diferenca / (60 * 60 * 24));
	       	
                      ?>
                      <?php if($dias >= 30) { ?>
                      <?php
                      $ffdn = $campo['dia'];
    		      $ffmm = $campo['mes'];
    		      $ffaa = $campo['ano'];
                      
                      $dat_venc = $ffdn."/".$ffmm."/".$ffaa;
		      $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
		      $valor_doc = $campo['valor'];
 		      $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));
 
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
 		      
    		      $ffdn = $campo['dia'];
    		      $ffmm = $campo['mes'];
    		      $ffaa = $campo['ano'];
 		      
 		      $datavencido = $ffaa."-".$ffmm."-".$ffdn;
		      if($datavencido < date('Y-m-d')) { 
		      $valordoboletofn = number_format($valoratual,2,',','.');
		      
		      $exibevaloresboleto = "<br>Juros: R$ $juros <br>Multa: R$ $multa ";
		      $exibeprazosboleto = "<br><span class='label label-info'> $dat_novo_venc </span>";
		      
		      } else {
		      $valordoboletofn = number_format($campo['valor'],2,',','.');
		      $exibeprazosboleto = "";
		      }
		      ?>
		      <td>
                      <?php if ($campo['situacao'] == 'P') { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } else { ?>
		      R$ <?php echo $valordoboletofn; ?>
		      <?php } ?>
		      </td>
		      <?php if ($campo['situacao'] == 'P') { ?>
		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>
		      <?php } else { ?>
		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?><?php echo $exibeprazosboleto; ?></td>
		      <?php } ?>
		      <?php } else { ?>
		      
		      <?php
                  $ffdn = $campo['dia'];
    		      $ffmm = $campo['mes'];
    		      $ffaa = $campo['ano'];
                      
                      $dat_venc = $ffdn."/".$ffmm."/".$ffaa;
		      $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
		      $valor_doc = $campo['valor'];
 		      $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));
 
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
 		      
    		      $ffdn = $campo['dia'];
    		      $ffmm = $campo['mes'];
    		      $ffaa = $campo['ano'];
 		      
 		      $datavencido = $ffaa."-".$ffmm."-".$ffdn;
		      if($datavencido < date('Y-m-d')) { 
		      $valordoboletofn2 = number_format($valoratual,2,',','.');
		      
		      $exibevaloresboleto2 = "<br>Juros: R$ $juros <br>Multa: R$ $multa ";
		      $exibeprazosboleto2 = "<br><span class='label label-info'>$dat_novo_venc </span>";
		      
		      } else {
		      $valordoboletofn2 = number_format($campo['valor'],2,',','.');
		      $exibeprazosboleto2 = "";
		      $exibevaloresboleto2 = "";
		      }
		      ?>
		      <td>
		      <?php if ($campo['situacao'] == 'P') { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } else { ?>
		      R$ <?php echo $valordoboletofn2; ?>
		      <?php } ?>
		      </td>
		      <?php if ($campo['situacao'] == 'P') { ?>
		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>
		      <?php } else { ?>
		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?><?php echo $exibeprazosboleto2; ?></td>
		      <?php } ?>
		      <?php } ?>
		      </td>
 		      
 		      
		      <td>
                  <?php if ($campo['situacao'] == 'A') { ?><span class="label label-warning">ABERTO</span><?php } ?>
                  <?php if ($campo['situacao'] == 'C') { ?><span class="label label-danger">CANCELADO</span><?php } ?>
                  <?php if ($campo['situacao'] == 'P') { ?><span class="label label-success">PAGO</span><?php } ?>
                  <?php if ($campo['situacao'] == 'B') { ?><span class="label label-danger">BLOQUEADO</span><?php } ?>
                  <?php if ($campo['situacao'] == 'N') { ?><span class="label label-info">A PAGAR</span><?php } ?>
		      </td>
		      
                      <td>
                                         
 <a href="app/email/enviar_email.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="Enviar por Email"><i class="fa fa-envelope"></i></a>&nbsp;
<!-- verificar se a fatura foi gerada pelo gerancia net - by Griff sistemas-->
<?php 
if($campo['linkGerencia']!= ""){
?>
<!-- Se estiver ativo - by Griff sistemas-->
<a href="<?php echo $link ?>" 
class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir pelo Gerencianet" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
<?php }else{ ?>
<!-- Se não for pelo gerancia net, mostra o boleto normal - by Griff sistemas-->
<a href="boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;
    <?php } ?>                  
<?php 
if($campo['linkGerencia']!= ""){
?>
<a href="index.php?app=Financeiro&acao=cancelar&id=<?php echo $campo['id'];?>" onClick="return confirm('Deseja realmente cancelar o boleto?.')"
class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Cancelar Fatura"><i class="fa fa-trash"></i></a>
<a href="?app=FaturaEDTGerenciaNet&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;

<?php }else{?>
<a href="?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
<?php } ?>



	    <!--  	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a> -->
	      
		      </td>
                    </tr>
                    <?php } ?>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Plano</th>
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
      