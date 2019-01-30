
      <div class="breadcrumb clearfix">
        <ul>
          <li><a href="">Dashboard</a></li>
          <li class="active">Bem Vindo  - <?php echo $idpuser = $logado['nome']; ?></li>
        </ul>
      </div>

	  <?php if($permissao['home'] == S) { ?>

      <div class="jumbotron jumbotron2">
        <h1 style="text-align: center;"> Bem vindo ao <strong>MyRouter ERP</strong></h1>
          <!--
          <p class="lead">O MyRouter ERP é o melhor erp para gestão de provedores de internet. Com ele você controla sua carteira de clientes, seu financeiro, suas vendas, seu estoque e emite NF-e 55 e 21 de maneira simples e intuitiva.
        <small>Não perca mais fins de semana dentro da empresa trabalhando. O MyRouter ERP ' 100% web, isso significa que você tem acesso às informações da sua empresa a qualquer dia de semana, 24 horas por dia e o mais importante: o software é multiplataforma, ou seja, é compatível com windows, linux, mac, tablets, smartphones, ou qualquer outro dispositivo que tenha um browser e conexão com a internet. </small>
        -->

      </div>

      <?php

      $resultClientTotal = $mysqli->query("SELECT id FROM clientes");
      $numCliente_rows = mysqli_num_rows($resultClientTotal);

      $resultSuporteAberto = $mysqli->query("SELECT id FROM ordemservicos WHERE encerrado ='N'");
      $numSuporteAberto_rows = mysqli_num_rows($resultSuporteAberto);

      $dataAno = date('Y');
      $dataMes = date('m');
      $resultFinanceiro = $mysqli->query("SELECT id FROM financeiro WHERE situacao ='N' AND ano = '$dataAno' AND mes = '$dataMes'");
      $numFinanceiro_rows = mysqli_num_rows($resultFinanceiro);

      $sql = "SELECT SUM(valor) as SOMA FROM financeiro WHERE situacao ='N' AND ano = '$dataAno' AND mes = '$dataMes'";
      $exec = $mysqli->query($sql);

      while ($rows = mysqli_fetch_assoc($exec)) {

          $rowsvalor = $rows["SOMA"];
      }

      //Clientes Bloqueador por Vencimento
      $empresa1 = $mysqli->query("SELECT dias_bloc FROM empresa WHERE id = '1'");
      $Cempresa = mysqli_fetch_array($empresa1);
      $dias_bloc = $Cempresa['dias_bloc'];

      $sxd = $mysqli->query("SELECT id FROM  financeiro WHERE situacao = 'B'");
      while($daa = mysqli_fetch_array($sxd)) {

          $verificaBloqueios = mysqli_num_rows($sxd);
      }
      //Clientes Bloqueador por Vencimento

      ?>
      <!-- LocalWeb BootStrap -->
    <link rel="stylesheet" type="text/css" href="assets/localweb/stylesheets/locastyle.css">
   <!--  <script src="assets/localweb/javascripts/locastyle.js"></script>-->

     <div class="ls-box ls-board-box">
         <header class="ls-info-header">
             <h2 class="ls-title-3">Resumo</h2>
             <!--    <p class="ls-float-right ls-float-none-xs ls-small-info">Quantidade válida até <strong>22/07/2014</strong></p> -->
              </header>
              <div id="sending-stats" class="row">
                  <div class="col-sm-6 col-md-3">
                      <div class="ls-box">
                          <h6 class="ls-title-4">Total de Clientes Cadastrados</h6>
                          <strong><?php echo "$numCliente_rows";?></strong>
                          <!--   <small>envios por mês</small>-->
                          <a href="index.php?app=Clientes" aria-label="Listar Clientes" class="ls-btn ls-btn-sm" title="Listar Clientes">Listar Clientes</a>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                      <div class="ls-box">
                          <h6 class="ls-title-4">Ordem de Serviço Abertas</h6>
                          <strong><?php echo "$numSuporteAberto_rows";?></strong>
                          <a href="index.php?app=OrdemServicos"  aria-label="Listar OS" class="ls-btn ls-btn-sm" title="Listar OS">Listar OS</a>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                      <div class="ls-box">
                          <h6 class="ls-title-4">Faturas Abertas Mês Atual</h6>
                          <strong><?php echo "$numFinanceiro_rows";?></strong>
                          <small>Valor à Receber - Sem Juros</small>
                          <small>R$<?php echo number_format($rowsvalor,2,',','.');?></small>

                      </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                      <div class="ls-box">
                          <h6 class="ls-title-4 ls-color-danger">Boletos Vencidos</h6>
                          <strong class="ls-color-theme"><?php
                              if($verificaBloqueios == ''){
                                  echo "0";
                              }else{
                              echo "$verificaBloqueios"; }
                              ?></strong>
                          <small>Superior à <?php echo "$dias_bloc" ?> dias de atrazo</small>
                      </div>
                  </div>
              </div>
          </div>


          <!-- LocalWeb BootStrap -->



          <!--  -->


       <div class="row" id="powerwidgets">

 <!--             <div class="col-md-4 bootstrap-grid">

                <div class="powerwidget blue" id="" data-widget-editbutton="false">
                  <header>
                    <h2>Atualizações<small> MyRouter ERP</small></h2>
                  </header>
                  <div class="inner-spacer">

                    <b>Nenhum Atualização Disponível</b>


                    </div></div></div>  -->

      <div class="row" id="powerwidgets">
        <div class="col-md-12 bootstrap-grid">

            <div class="powerwidget green" id="" >
              <header>
                <h2>Faturas do Mês<small> MyRouter ERP</small></h2>
              </header>
              <div class="inner-spacer">


      	       <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                      <th width="150">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

 		  $mes = date('m');
 		  $ano = date('Y');
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE mes = '$mes' AND ano = '$ano'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $link = $campo['linkGerencia'];
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);

 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <?php if($campo['situacao'] == "P") { echo ""; }

			  elseif($campo['situacao'] == "C") { echo ""; }

			  else { ?>
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
		      R$ <?php echo number_format($campo['valorparcela'],2,',','.'); ?>
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
		      $exibeprazosboleto2 = "<br><span class='label label-danger'>$dat_novo_venc </span>";

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

<?php
if($campo['linkGerencia']!= ""){
?>
<!-- Se estiver ativo - by Griff sistemas-->
<a href="<?php echo $link ?>"
class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir pelo Gerencianet" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
<?php }else{ ?>
<!-- Se não for pelo gerancia net, mostra o boleto normal - by Griff sistemas-->
<a href="boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;


<a href="?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	 <?php } ?>
	      <!--	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=FaturaEDT&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a> -->

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


      	      </div></div></div></div>
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