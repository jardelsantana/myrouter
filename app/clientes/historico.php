<script type="text/javascript" class="init">

$(document).ready(function() {
	$('table.display').dataTable();
} );
</script>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Clientes</li>
          </ul>
        </div>
        
        <?php if($permissao['c1'] == S) { ?>
        
        <?php
        $idcliente = base64_decode($_GET['cliente']);
	$ccvc = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
 	$cvb = mysqli_fetch_array($ccvc);
        ?>
       
        <div class="page-header">
          <h1>Cliente <small><?php echo $cvb['nome']; ?> CPF: <?php echo $cvb['cpf']; ?></small></h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget blue" id="" data-widget-editbutton="false">
            
              <header>
                <h2>Histório & Informações do Cliente</h2>
              </header>
              
              <ul class="nav nav-tabs">
                      <li class="active"><a href="#one-normal" data-toggle="tab"><i class="fa fa-globe"></i> Assinaturas</a></li>
                      <li><a href="#two-normal" data-toggle="tab"><i class="fa fa-money"></i> Faturas</a></li>
                      <li><a href="#three-normal" data-toggle="tab"><i class="fa fa-file"></i> OS</a></li>
                      <li><a href="#notafiscal-normal" data-toggle="tab"><i class="fa fa-dollar"></i> Nota Fiscal</a></li>
                      <li><a href="#five-normal" data-toggle="tab"><i class="fa fa-file-pdf-o"></i> Recibos</a></li>
                      <li><a href="#conexoes-normal" data-toggle="tab"><i class="fa fa-bar-chart"></i> Histórico Conexões</a></li>
                      <li><a href="#four-normal" data-toggle="tab"><i class="fa fa-user"></i> Dados do Cliente</a></li>

                    </ul>
              
              <div class="tab-content">
                      <div class="tab-pane active" id="one-normal">
		      
		      <div class="inner-spacer">
                 <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Pedido</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Servidor</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Status</th>
                      <th width="155">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idcliente = base64_decode($_GET['cliente']);
 		  $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$idcliente'");
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
		  
		  
		  ?>
		  <tr>
                     <td style="background:#<?php echo $cor; ?>">#<?php echo $campo['pedido']; ?></td>
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
		      $ssid = $vplano['servidor'];
 		      $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$ssid'");
 		      $vservidor = mysqli_fetch_array($servidor)
 		      ?>
		      <?php echo $vservidor['servidor']; ?>
		      
		      </td>
                   <td style="background:#<?php echo $cor; ?>">R$ <?php echo number_format($vplano['preco'],2,',','.'); ?></td>
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
                      
                      <?php if ($campo['situacao'] == 'S' || $campo['situacao'] == 'D') { ?>
               <a href="imprimir-ordem.php?id=<?php echo base64_encode($campo['pedido']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Pedido de Instalação" target=_blank><i class="entypo-print"></i></a>&nbsp;<?php } ?>
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
                     <th>Pedido</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Servidor</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Status</th>
                      <th width="155">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
		      
		      
		      </div>
                      <div class="tab-pane" id="two-normal">
		      
		      
		      <div class="inner-spacer">
                <table class="display table table-striped table-hover" id="">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th width="200">Cliente</th>
                      <th>Plano</th>
                      <th width="70">Valor</th>
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
				  
				  
                  
 		  $idcliente = base64_decode($_GET['cliente']);
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE cliente = '$idcliente' order by ano,mes ASC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $link = $campo['linkGerencia'];
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);

          $empresaHistorico = $mysqli->query("SELECT * FROM empresa");
          $CampoEmpresa = mysqli_fetch_array($empresaHistorico);

		  ?>
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
		    //  $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
		      $dat_novo_venc = date('d/m/Y');
		      $valor_doc = $campo['valor'];
 		      $juros = ((0.07 * (diasEntreData($dat_venc,$dat_novo_venc ))));
 
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

<?php if ($campo['situacao'] == 'P') { ?>
<span class="label label-success">CONFIRMADO</span>

<?php }
else{ ?>
<?php
if($campo['linkGerencia']!= ""){
?>
<!-- Se estiver ativo - by Griff sistemas-->
<a href="<?php echo $link ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir pelo Gerencianet" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
<?php }else{ ?>
<!-- Se não for pelo gerancia net, mostra o boleto normal - by Griff sistemas-->
<a href="boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;
    <?php } ?>

<a href="app/email/enviar_email.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="Enviar por Email"><i class="fa fa-envelope"></i></a>&nbsp;

<!-- se o cliente nao tiver permissao financeiro nao aparece o botao remover boleto-->
<?php
if($permissao['f1'] == "S" && $campo['linkGerencia'] == "" ){
?>

<a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>

<?php }else{ ?>

<?php } ?>
<!-- se o cliente nao tiver permissao financeiro nao aparece o botao remover boleto-->

<?php 
if($campo['linkGerencia']!= ""){
?>
<a href="index.php?app=Financeiro&acao=cancelar&id=<?php echo $campo['id'];?>" onClick="return confirm('Deseja realmente cancelar o boleto?.')"
class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Cancelar Fatura"><i class="fa fa-trash"></i></a>
<a href="?app=FaturaEDTGerenciaNet&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;

<?php }else{?>
<a href="?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
<?php } ?>

 
<?php if($CampoEmpresa['banco'] == "99") { ?>
<a href="config/boletophp/carne.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&pedido=<?php echo base64_encode($campo['pedido']); ?>" class="btn btn-default tooltiped" data-toggle="tooltip" title="Gerar Carnê" target=_blank> <i class="entypo-print"></i></a>&nbsp;&nbsp;<?php } ?>
          <?php } ?>
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Fatura</th>
                      <th width="230">Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                     <th width="160">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
		      
		      
		      
		      </div>
                      <div class="tab-pane" id="three-normal">
		      
		      
		      <div class="inner-spacer">
            <table class="display table table-striped table-hover" id="">
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
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
            $idcliente = base64_decode($_GET['cliente']);
            $idempresa = $_SESSION['empresa'];
            $consultas = $mysqli->query("SELECT * FROM ordemservicos WHERE cliente = '$idcliente' AND encerrado = 'N' order by id DESC");
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
                        <?php if ($campo['situacao'] == 'I' or $campo['situacao'] == 'O' or $campo['situacao'] == 'M' ) { ?>
                            <a href="imprimir-ordem.php?id=<?php echo base64_encode($campo['codigo']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Ordem de Serviço" target=_blank><i class="entypo-print"></i></a>&nbsp;

                        <?php } ?>

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
                      <th>Nome</th>
                      <th>CPF/CNPJ</th>
                      <th>Telefone</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Status</th>
                      <th>OS</th>
                      <th width="110">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
		      
		      </div>
		      
		      <div class="tab-pane" id="conexoes-normal">
		      
		      <?php
		      $idcliente = base64_decode($_GET['cliente']);
        	      $seraact = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$idcliente'");
        	      $cclacct = mysqli_fetch_array($seraact);
        	      ?>
		      
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
                      <th style="width:50px;">Usuário</th>
                      <th style="width:50px;">Entrada</th>
                      <th style="width:50px;">Saída</th>
                      <th style="width:50px;">Tempo</th>
                      <th style="width:50px;">Enviado</th>
                      <th style="width:50px;">Recebido</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  function bytes($bytes)
    		  {
        	  if ($bytes >= 1073741824)
        	  {
            	  $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        	  }
        	  elseif ($bytes >= 1048576)
        	  {
            	  $bytes = number_format($bytes / 1048576, 2) . ' MB';
        	  }
        	  elseif ($bytes >= 1024)
        	  {
            	  $bytes = number_format($bytes / 1024, 2) . ' KB';
        	  }
        	  elseif ($bytes > 1)
        	  {
            	  $bytes = $bytes . ' bytes';
        	  }
        	  elseif ($bytes == 1)
        	  {
            	  $bytes = $bytes . ' byte';
        	  }
        	  else
        	  {
            	  $bytes = '0 bytes';
        	  }

        	  return $bytes;
		  }
		  
 		  $username = $cclacct['login'];
 		  $consultas = $mysqli->query("SELECT * FROM radacct WHERE username = '$username' order by radacctid DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  ?>
		  <tr>
		  <td><?php echo $campo['username']; ?><br><?php echo $campo['framedipaddress']; ?></td>
                      <td><?php
                      $var = $campo['acctstarttime'];
		      $date = str_replace('-', '/', $var);
		      echo date('d/m/Y H:i:s', strtotime($date)); 
		      ?>
		      </td>
                      <td><?php
                      $var = $campo['acctstoptime'];
		      $date = str_replace('-', '/', $var);
		      echo date('d/m/Y H:i:s', strtotime($date)); 
		      ?></td>
                      <td><?php
		      $segundos = $campo['acctsessiontime'];
		      echo gmdate("H:i:s", $segundos);
		      ?></td>
                      <td><?php echo bytes($campo['acctinputoctets']); ?></td>
                     <td><?php echo bytes($campo['acctoutputoctets']); ?></td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
<?php
$qr=$mysqli->query("SELECT SUM(acctsessiontime) as total FROM radacct WHERE username = '$username'");
$row=mysqli_fetch_array($qr);
$uptimetotal=$row['total'];

$qr=$mysqli->query("SELECT SUM(acctinputoctets) as total FROM radacct WHERE username = '$username'");
$row=mysqli_fetch_array($qr);
$enviadototal=$row['total'];

$qr=$mysqli->query("SELECT SUM(acctoutputoctets) as total FROM radacct WHERE username = '$username'");
$row=mysqli_fetch_array($qr);
$recebidototal=$row['total'];

$resultado_mes=$entradas-$saidas;
?>
                  
                  
                    <tr>
                      <th style="width:50px;"></th>
                      <th></th>
                      <th></th>
                      <th style="width:50px;"><?php
		      $segundos = $uptimetotal;
		      echo gmdate("H:i:s", $segundos);
		      ?></th>
                      <th style="width:50px;"><?php echo bytes($enviadototal); ?></th>
                      <th style="width:50px;"><?php echo bytes($recebidototal); ?></th>
                    </tr>
                  </tfoot>
                </table>
		      
		      
		      </div>
		       

		           <!------------------------------- -->


		      <div class="tab-pane" id="notafiscal-normal">

		      <div class="inner-spacer">
                 <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Nome</th>
                      <th>CPF/CNPJ</th>
                      <th>Valor</th>
                      <th>Mês</th>
                      <th>Ano</th>
                      <th>Plano</th>
                      <th>Emissão</th>
                      <th width="155">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

            $idcliente = base64_decode($_GET['cliente']);
            $consultas = $mysqli->query("SELECT * FROM notafiscal WHERE cliente = '$idcliente'");
            while($campo = mysqli_fetch_array($consultas)){

                if ($campo['situacao'] == 'S') {
                    $cor = "C02942;color:#ffffff;";
                }
                if ($campo['situacao'] == 'N') {
                    $cor = "008000;color:#ffffff;";
                }

                $data_emissao = date('d/m/Y',strtotime($campo['emissao']));

                ?>
                <tr>
                    <td style="background:#<?php echo $cor; ?>">#<?php echo $campo['nnota']; ?></td>
                    <td style="background:#<?php echo $cor; ?>"><?php echo $campo['clientenome']; ?></td>
                    <td style="background:#<?php echo $cor; ?>"><?php echo $campo['clientecpf']; ?></td>
                    <td style="background:#<?php echo $cor; ?>">R$<?php echo number_format($campo['valorservicos'],2,',','.'); ?></td>
                    <td style="background:#<?php echo $cor; ?>"><?php  echo $campo['mesrps']; ?></td>
                    <td style="background:#<?php echo $cor; ?>"><?php  echo $campo['anorps']; ?></td>
                    <td style="background:#<?php echo $cor; ?>"><?php  echo $campo['descricao']; ?></td>

                    <td style="background:#<?php echo $cor; ?>"><?php  echo $data_emissao; ?></td>

                    <td style="background:#<?php echo $cor; ?>">

                    <a href="imprimir-nfse.php?id=<?php echo base64_encode($campo['nnota']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Nota Fiscal" target=_blank><i class="entypo-print"></i></a>&nbsp;
                    <a href="?app=EditarNFSe&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
                    <?php if($logado['nivel'] == '1') { ?>
                    <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroNFSe&idnota=<?php echo base64_encode($campo['nnota']); ?>&Ex=DelNota' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
                        <?php } ?>
                    </td>
                </tr>

            <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Numero</th>
                      <th>Nome</th>
                      <th>CPF/CNPJ</th>
                      <th>Valor</th>
                      <th>Mês</th>
                      <th>Ano</th>
                      <th>Plano</th>
                      <th>Emissão</th>
                      <th width="155">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>


		      </div>

		      <!--               -->
		      
		      <div class="tab-pane" id="four-normal">
		      
		      <?php
	$idcliente = base64_decode($_GET['cliente']);
        $alterar = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
        $campocliente = mysqli_fetch_array($alterar);
        ?>
		      
		      
		      <div class="inner-spacer">
                <form action="?app=CadastroCliente" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-8">
                      <label class="label">Nome Completo</label>
                      <label class="input">
                        <input type="text" name="nome" value="<?php echo @$campocliente['nome']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">CPF ou CNPJ</label>
                      <label class="input">
                        <input type="text" name="cpf" id="cpf" onblur="validarLogin('cpf', document.getElementById('cpf').value);" class="cpf" value="<?php echo @$campocliente['cpf']; ?>">
                        <div id="campocliente_cpf"></div>
                      </label>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">RG</label>
                      <label class="input">
                        <input type="text" name="rg" value="<?php echo @$campocliente['rg']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Data de Nascimento</label>
                      <label class="input">
                        <input type="text" name="nascimento" class="nascimento" value="<?php echo @$campocliente['nascimento']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Telefone</label>
                      <label class="input">
                        <input type="text" name="tel" class="tel" value="<?php echo @$campocliente['tel']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Celular</label>
                      <label class="input">
                        <input type="text" name="cel" class="maskcel" value="<?php echo @$campocliente['cel']; ?>">
                      </label>
                    </section>

					  <section class="col col-2">
						  <label class="label">Data da Entrada</label>
						  <label class="input">
							  <input type="text" name="dataentrada" class="data" value="<?php if (@$campocliente['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campocliente['dataentrada'])); ?><?php } else { ?><?php echo date('d/m/Y'); ?><?php } ?>" required>
						  </label>
					  </section>

					  <section class="col col-2">
						  <label class="label">Vcto. Contrato</label>
						  <label class="input">
							  <input type="text" name="vctocontrato"  class="data" value="<?php if (@$campocliente['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campocliente['vctocontrato'])); ?><?php } else { ?><?php echo date('d/m/Y',strtotime($date.'+1years')); ?><?php } ?>" required>
						  </label>
					  </section>

					  <section class="col col-2">
						  <label class="label">Estado Civil</label>
						  <label class="input">
							  <input type="text" name="estadocivil" value="<?php echo @$campocliente['estadocivil']; ?>">
						  </label>
					  </section>

					  <section class="col col-2">
						  <label class="label">Naturalidade</label>
						  <label class="input">
							  <input type="text" name="naturalidade" value="<?php echo @$campocliente['naturalidade']; ?>">
						  </label>
					  </section>
                    
                    <section class="col col-4">
                      <label class="label">E-mail</label>
                      <label class="input">
                        <input type="text" name="email" value="<?php echo @$campocliente['email']; ?>">
                      </label>
                    </section>

					  <section class="col col-4">
						  <label class="label">Nome do Pai</label>
						  <label class="input">
							  <input type="text" name="pai" value="<?php echo @$campocliente['pai']; ?>">
						  </label>
					  </section>

					  <section class="col col-4">
						  <label class="label">Nome da Mãe</label>
						  <label class="input">
							  <input type="text" name="mae" value="<?php echo @$campocliente['mae']; ?>">
						  </label>
					  </section>
                    
                    <section class="col col-8">
                      <label class="label">Endereço</label>
                      <label class="input">
                        <input type="text" name="endereco" value="<?php echo @$campocliente['endereco']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Nº</label>
                      <label class="input">
                        <input type="text" name="numero" onKeyUp="kbps(this);" value="<?php echo @$campocliente['numero']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Bairro</label>
                      <label class="input">
                        <input type="text" name="bairro" value="<?php echo @$campocliente['bairro'];?>" required >
                      </label>
                    </section>
                    
                   <section class="col col-6">
                      <label class="label">Complemento</label>
                      <label class="input">
                        <input type="text" name="complemento" value="<?php echo @$campocliente['complemento'];?>">
                      </label>
                    </section>

					  <section class="col col-6">
						  <label class="label">Referencia</label>
						  <label class="input">
							  <input type="text" name="referencia" value="<?php echo @$campocliente['referencia'];?>">
						  </label>
					  </section>

					  <section class="col col-2">
                      <label class="label">Estado</label>
                      <label class="input">
						  <input type="text"  name="estado" id="estado" value="<?php echo @$campocliente['estado'];?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Cidade</label>
                      <label class="input">
                      <input type="text" name="cidade" id="cidade" value="<?php echo @$campocliente['cidade'];?>" required >
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campocliente['cep'];?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Login</label>
                      <label class="input">
                        <input type="text" onblur="validarLogin('login', document.getElementById('login').value);" name="acessolog" id="login" value="<?php echo @$campocliente['login']; ?>" required>
                        <div id="campocliente_login"></div>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Senha</label>
                      <label class="input">
                        <input type="password" name="senha" value="<?php echo @$campocliente['senha']; ?>" required>
                      </label>
                    </section>

					  <section class="col col-2">
						  <label class="label">CFOP</label>
						  <label class="input"> <i class="icon-append fa fa-question"></i>
							  <input type="text" name="cfop" value="<?php if (@$campocliente['id'] <> '') { ?><?php echo @$campocliente['cfop']; ?><?php } else { ?><?php echo "5307"; ?><?php } ?>" required>
							  <b class="tooltip tooltip-top-right">Pessoa Física inserir 5307 e Pessoa Jurídica Inserir 5303</b> </label>
						  </label>
					  </section>

					  <section class="col col-2">
						  <label class="label">Grupo</label>
						  <label class="select">
							  <select name="grupo" required>
								  <option value="">Selecione</option>
								  <option <?php if(@$campocliente['grupo'] == 'N' ){echo 'selected';}  ?> value="N">NORMAL</option>
								  <option <?php if(@$campocliente['grupo'] == 'V' ){echo 'selected';}  ?> value="V">VIP</option>
								  <option <?php if(@$campocliente['grupo'] == 'L' ){echo 'selected';}  ?> value="L">LOCAÇÃO</option>
								  <option <?php if(@$campocliente['grupo'] == 'C' ){echo 'selected';}  ?> value="C">COMODATO</option>
								  <option <?php if(@$campocliente['grupo'] == 'FC' ){echo 'selected';}  ?> value="FC">FIDELIDADE COMODATO</option>
								  <option <?php if(@$campocliente['grupo'] == 'F' ){echo 'selected';}  ?> value="F">FUNCIONÁRIO</option>
								  <option <?php if(@$campocliente['grupo'] == 'CT' ){echo 'selected';}  ?> value="CT">CORTESIA</option>
								  <option <?php if(@$campocliente['grupo'] == 'I' ){echo 'selected';}  ?> value="I">INADIMPLENTE</option>
								  <option <?php if(@$campocliente['grupo'] == 'NE' ){echo 'selected';}  ?> value="NE">NEGATIVADO</option>
								  <option <?php if(@$campocliente['grupo'] == 'O' ){echo 'selected';}  ?> value="O">OUTROS</option>

							  </select>
						  </label>
					  </section>

					  <section class="col col-3">
						  <label class="label">Tipo Assinante</label>
						  <label class="select">
							  <select name="tipoassinante" required>
								  <option value="">Selecione</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 1 ){echo 'selected';}  ?> value="1">Comercial/Industrial</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 2 ){echo 'selected';}  ?> value="2">Poder Público</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 3 ){echo 'selected';}  ?> value="3">Residencial/Pessoa Física</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 4 ){echo 'selected';}  ?> value="4">Telefone Público</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 5 ){echo 'selected';}  ?> value="5">Telefone Semi-público</option>
								  <option <?php if(@$campocliente['tipoassinante'] == 6 ){echo 'selected';}  ?> value="6">Grandes Clientes</option>

							  </select>
						  </label>
					  </section>

					  <section class="col col-3">
						  <label class="label">Tipo de Utilização</label>
						  <label class="select">
							  <select name="tipoutilizacao" required>
								  <option value="">Selecione</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 1 ){echo 'selected';}  ?> value="1">Telefonia</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 2 ){echo 'selected';}  ?> value="2">Comunicação de Dados</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 3 ){echo 'selected';}  ?> value="3">TV por Assinatura</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 4 ){echo 'selected';}  ?> value="4">Provimento de acesso à Internet</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 5 ){echo 'selected';}  ?> value="5">Multimídia</option>
								  <option <?php if(@$campocliente['tipoutilizacao'] == 6 ){echo 'selected';}  ?> value="6">Outros</option>
							  </select>
						  </label>
					  </section>

                    
                    <section class="col col-3">
                      <label class="label">Emitir NFSe</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="nf" value="S" <?php if ($campocliente['nf'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="nf" value="N" <?php if ($campocliente['nf'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Situação do Cliente</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" <?php if ($campocliente['status'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Ativo</label>
                        
                        <label class="radio">
                          <input type="radio" name="status" value="N" <?php if ($campocliente['status'] == 'N') { echo "checked"; } ?>>
                          <i></i>Bloqueado</label>
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  
		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="clienteid" value="<?php echo @$campocliente['id']; ?>"> 
		  
                  </footer>
                </form>
              </div>
              <script src="https://raw.githubusercontent.com/digitalBush/jquery.maskedinput/1.4.0/dist/jquery.maskedinput.min.js"></script>
<script>
$(function() {
 $('.cpf').focusout(function() {
        var cpfcnpj, element;
        element = $(this);
        element.unmask();
        cpfcnpj = element.val().replace(/\D/g, '');
        if (cpfcnpj.length > 11) {
            element.mask("99.999.999/999?9-99");
        } else {
            element.mask("999.999.999-99?9-99");
        }
    }).trigger('focusout');
    

});
jQuery(function($){
   $(".nascimento").mask("99/99/9999");
   $(".cel").mask("(99)99999-9999");
   $(".tel").mask("(99)9999-9999");
   $(".cep").mask("99999-999");
});

$(function() {
    $('.maskcel').focusout(function() {
        var maskcelular, element;
        element = $(this);
        element.unmask();
        maskcelular = element.val().replace(/\D/g, '');
        if (maskcelular.length > 11) {
            element.mask("(99)99999-9999");
        } else {
            element.mask("(99)9999-9999?9");
        }
    }).trigger('focusout');

</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.0.js"></script>
<script type="text/javascript">
window.onload = function() {
  new dgCidadesEstados({
    estado: document.getElementById('estado'),
    cidade: document.getElementById('cidade')
  });
}
</script>
<script type="text/javascript" src="ajax/funcslogin.js"></script>
<script type="text/javascript" src="ajax/funcscpf.js"></script>
		      
		      
		      </div>
		      
		      
                      <div class="tab-pane" id="five-normal">
                    
                      
                      <div class="inner-spacer">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Tipo</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idcliente = base64_decode($_GET['cliente']);
 	
     		  $consultas = $mysqli->query("SELECT * FROM boletos WHERE cliente = '$idcliente' AND status = 'P' order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
		  ?>
		  <tr>
                      <td><?php echo $campo['boleto']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td>R$ <?php echo number_format($campo['valor'],2,',','.'); ?></td>
 		      <td><?php echo date('d/m/Y',strtotime($campo['vencimento'])); ?></td>
 		      
		      <td>Faturas Avulsas</td>
		      
                      <td>
              <a href="recibo.php?id=<?php echo base64_encode($campo['id']); ?>&tipo=2" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-print"></i></a>&nbsp;
                      
	      
		      </td>
                    </tr>
                   
		  <?php  } ?>
		  
		  <?php
                  
 		  $idcliente = base64_decode($_GET['cliente']);
 	
     		  $ccfv = $mysqli->query("SELECT * FROM financeiro WHERE cliente = '$idcliente' AND situacao = 'P' order by ano,mes ASC");
 		  while($campo = mysqli_fetch_array($ccfv)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
		  ?>
		  <tr>
                      <td><?php echo $campo['boleto']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td>R$ <?php echo number_format($campo['valor'],2,',','.'); ?></td>
 		      <td><?php echo date('d/m/Y',strtotime($campo['vencimento'])); ?></td>
 		      
		      <td>Mensalidades</td>
		      
                      <td>
              <a href="recibo.php?id=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Recibo" target=_blank><i class="fa fa-print"></i></a>&nbsp;
                      
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Tipo</th>
                      <th width="110">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
                      
                      
                    
		      </div>
		    
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
      