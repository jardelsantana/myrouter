<?php
if($_GET['ftmes'] == '') { ?>
<?php if(date('m') == '01') { $mesatual = "Janeiro"; } ?>
<?php if(date('m') == '02') { $mesatual = "Fevereiro"; } ?>
<?php if(date('m') == '03') { $mesatual = "Março"; } ?>
<?php if(date('m') == '04') { $mesatual = "Abril"; } ?>
<?php if(date('m') == '05') { $mesatual = "Maio"; } ?>
<?php if(date('m') == '06') { $mesatual = "Junho"; } ?>
<?php if(date('m') == '07') { $mesatual = "Julho"; } ?>
<?php if(date('m') == '08') { $mesatual = "Agosto"; } ?>
<?php if(date('m') == '09') { $mesatual = "Setembro"; } ?>
<?php if(date('m') == '10') { $mesatual = "Outubro"; } ?>
<?php if(date('m') == '11') { $mesatual = "Novembro"; } ?>
<?php if(date('m') == '12') { $mesatual = "Dezembro"; } ?>
<?php } else { ?>
<?php if($_GET['ftmes'] == '01') { $mesatual = "Janeiro"; } ?>
<?php if($_GET['ftmes'] == '02') { $mesatual = "Fevereiro"; } ?>
<?php if($_GET['ftmes'] == '03') { $mesatual = "Março"; } ?>
<?php if($_GET['ftmes'] == '04') { $mesatual = "Abril"; } ?>
<?php if($_GET['ftmes'] == '05') { $mesatual = "Maio"; } ?>
<?php if($_GET['ftmes'] == '06') { $mesatual = "Junho"; } ?>
<?php if($_GET['ftmes'] == '07') { $mesatual = "Julho"; } ?>
<?php if($_GET['ftmes'] == '08') { $mesatual = "Agosto"; } ?>
<?php if($_GET['ftmes'] == '09') { $mesatual = "Setembro"; } ?>
<?php if($_GET['ftmes'] == '10') { $mesatual = "Outubro"; } ?>
<?php if($_GET['ftmes'] == '11') { $mesatual = "Novembro"; } ?>
<?php if($_GET['ftmes'] == '12') { $mesatual = "Dezembro"; } ?>

<?php } ?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Relatórios</li>
          </ul>
        </div>
     
        
        <div class="page-header">
          <h1>Relatórios        <?php if($_GET['relatorio'] == "relatorio_ativos") { ?>
         <small>Faturas Abertas Mês <?php echo $mesatual; ?></small>
	<?php } ?>  
	<?php if($_GET['relatorio'] == "relatorio_pagos") { ?>
         <small>Faturas Pagas Mês <?php echo $mesatual; ?></small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_bloqueios") { ?>
         <small>Faturas Bloqueadas Mês <?php echo $mesatual; ?></small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_clientesassinantes") { ?>
        <small>Clientes Assinantes</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_financeiromes") { ?>
        <small>Movimento Financeiro Mês <?php echo $mesatual; ?></small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_retornos") { ?>
        <small>Retorno Bancário</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_planosvclientes") { ?>
        <small>Planos x Assinaturas</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "clientexplanos") { ?>
        <small>Clientes x Planos</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "atvxplanos") { ?>
        <small>Clientes Ativos x Planos</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "blockxplanos") { ?>
        <small>Clientes Bloqueados x Planos</small>
	<?php } ?>
    <?php if($_GET['relatorio'] == "relatorio_fatura_data") { ?>
        <small>Fatura por Data e Situação</small>
    <?php } ?>

    <?php if($_GET['relatorio'] == "relatorio_por_data") { ?>
       <small>Fatura por Data</small>
    <?php } ?>

    <?php if($_GET['relatorio'] == "log_conexao") { ?>
        <small>Log de Conexão</small>
    <?php } ?>
	<?php if($_GET['relatorio'] == "") { ?>
          <small>MyRouter ERP</small>
	<?php } ?>
	<?php if($_GET['relatorio'] == "relatorio_clientesassinantesbloqueio") { ?>
	  <small>Clientes Assinantes Bloqueados</small>
	 <?php } ?>
		  </h1>
        </div>
        <script src="assets/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
jQuery(function($){
   $("#data").mask("99/99/9999");
});
</script>
<script type="text/javascript" src="assets/js/jquery.print.js"></script>
<script type="text/javascript">
// When the document is ready, initialize the link so
// that when it is clicked, the printable area of the
// page will print.
$(
function(){
// Hook up the print link.
$( "orb" )
.attr( "href", "javascript:void( 0 )" )
.click(
function(){
// Print the DIV.
$( ".printable" ).print();
// Cancel click event.
return( false );
}
)
;
}
);
</script>
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Filtro<small>Relatórios</small></h2>
              </header>
              <div class="inner-spacer">
               
               
               <?php if($_GET['relatorio'] == "") { ?>
        	<p>Utilize os menus de relatório, você pode filtrar algumas informações por Mês, Ano ou Data.</p>
        	
        	<?php } ?>
        	
        	
        	<?php if($_GET['relatorio'] == "relatorio_ativos") { ?>
        	<orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
        	<select name="grau" style="width:300px;" class="form-control" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_ativos&ftmes=' + this.value;">
                <option value="">Selecione um Mês</option>
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro </option>
		<option value="03">Março </option>
		<option value="04">Abril </option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>
		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
                </select>
        	<br>
        	<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Nome do Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($_GET['ftmes'] == '') {
                  $mes = date('m'); 		  
 		  $ano = date('Y');
           	  } else {
 		  $mes = $_GET['ftmes']; 		  
 		  $ano = date('Y');
 		  }
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE ano = '$ano' AND mes = '$mes' AND situacao = 'N' group by boleto");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <tr>
                      <td><?php echo $campo['id']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                      <td>
		      <?php
 		      $data_inicial = $campo['cadastro'];
 		      $data_final = $campo['vencimento'];
 		      $diferenca = strtotime($data_final) - strtotime($data_inicial);
 		      $dias = floor($diferenca / (60 * 60 * 24));
		       
                      ?>
                      <?php if($dias >= 30) { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } else { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } ?>
		      </td>
 		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>
 		      
		      <td>
		      <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
		      <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
		      <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
		      <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
                    </tr>
		  <?php  } ?>
                  </tbody>
                </table>
    		</div>
                <?php } /* Relatório de Assinaturas Ativas */ ?>
                
                
                <?php if($_GET['relatorio'] == "relatorio_pagos") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                <select name="grau" style="width:300px;" class="form-control" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_pagos&ftmes=' + this.value;">
                <option value="">Selecione um Mês</option>
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro </option>
		<option value="03">Março </option>
		<option value="04">Abril </option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>
		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
                </select>
                <br>
                <div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Nome do Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  if($_GET['ftmes'] == '') {
                  $mes = date('m'); 		  
 		  $ano = date('Y');
           	  } else {
 		  $mes = $_GET['ftmes']; 		  
 		  $ano = date('Y');
 		  }
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE ano = '$ano' AND mes = '$mes' AND situacao = 'P' group by boleto");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <tr>
                      <td><?php echo $campo['id']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                      <td>
		      <?php
 		      $data_inicial = $campo['cadastro'];
 		      $data_final = $campo['vencimento'];
 		      $diferenca = strtotime($data_final) - strtotime($data_inicial);
 		      $dias = floor($diferenca / (60 * 60 * 24));
		       
                      ?>
                      <?php if($dias >= 30) { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } else { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } ?>
		      </td>
 		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>
 		      
		      <td>
		      <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
		      <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
		      <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
		      <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
                    </tr>
		  <?php  } ?>
                  </tbody>
                </table>
                </div>
                <?php } /* Relatório de Assinaturas Pagas */ ?>
                
                <?php if($_GET['relatorio'] == "relatorio_bloqueios") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                <select name="grau" style="width:300px;" class="form-control" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_bloqueios&ftmes=' + this.value;">
                <option value="">Selecione um Mês</option>
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro </option>
		<option value="03">Março </option>
		<option value="04">Abril </option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>
		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
                </select>
                <br>
                <div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Nome do Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($_GET['ftmes'] == '') {
                  $mes = date('m'); 		  
 		  $ano = date('Y');
           	  } else {
 		  $mes = $_GET['ftmes']; 		  
 		  $ano = date('Y');
 		  }
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE ano = '$ano' AND mes = '$mes' AND situacao = 'B' group by boleto");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <tr>
                      <td><?php echo $campo['id']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                      <td>
		      <?php
 		      $data_inicial = $campo['cadastro'];
 		      $data_final = $campo['vencimento'];
 		      $diferenca = strtotime($data_final) - strtotime($data_inicial);
 		      $dias = floor($diferenca / (60 * 60 * 24));
		       
                      ?>
                      <?php if($dias >= 30) { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } else { ?>
		      R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
		      <?php } ?>
		      </td>
 		      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>
 		      
		      <td>
		      <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
		      <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
		      <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
		      <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
                    </tr>
		  <?php  } ?>
                  </tbody>
                </table>
                </div>
                <?php } /* Relatório de Assinaturas Bloqueadas */ ?>
                
                <?php if($_GET['relatorio'] == "relatorio_clientesassinantes") { ?>
          	<orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
          	<br><br><br>
		  <div class="printable">
		  <table class="table">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>UF</th>
                      <th>Telefone(s)</th>
                      <th>Assinaturas</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
 		  $consultas = $mysqli->query("SELECT * FROM clientes order by nome ASC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['id'];
		  $ccs = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$cliente'");
 		  $assinatura = mysqli_fetch_array($ccs);
 		  $row = mysqli_num_rows($ccs);
		  ?>
		  <tr>
                      <td><?php echo $campo['nome']; ?><br><?php echo $campo['cpf']; ?></td>
                      <td><small><?php echo $campo['endereco']; ?>, <?php echo $campo['numero']; ?><br>
		      <?php echo $campo['complemento']; ?> <?php echo $campo['bairro']; ?></small></td>
                      <td><?php echo $campo['cidade']; ?></td>
                      <td><?php echo $campo['estado']; ?></td>
 		      <td><small><?php echo $campo['tel']; ?> <br> <?php echo $campo['cel']; ?></small></td>
 		      
		      <td><?php echo $row; ?><br>
		      <?php if($assinatura['status'] == "S") { ?><span class="label label-success">ATIVO</span>
		      <?php } else { ?><span class="label label-danger">BLOQUEADO</span><?php } ?>
		      
		      </td>
                    </tr>
		  <?php  } ?>
                  </tbody>
                </table>
                </div>
                <?php } /* Relatório de Clientes Assinantes */ ?>
                
                
                
                <?php if($_GET['relatorio'] == "relatorio_financeiromes") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                <select name="grau" style="width:300px;" class="form-control" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_financeiromes&ftmes=' + this.value;">
                <option value="">Selecione um Mês</option>
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro </option>
		<option value="03">Março </option>
		<option value="04">Abril </option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>
		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
                </select> 
                <br> 
                
        	<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Movimento</th>
                      <th>Valor</th>
                      <th>Dia</th>
                      <th>Pedido</th>
					  <th>Adm</th>
                      <th>Tipo</th>
                      <th>Categoria</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  function fndata($string)
    		  {
    		  $string = str_replace('01','1',$string);
    		  $string = str_replace('02','2',$string);
    		  $string = str_replace('03','3',$string);
    		  $string = str_replace('04','4',$string);
    		  $string = str_replace('05','5',$string);
    		  $string = str_replace('06','6',$string);
    		  $string = str_replace('07','7',$string);
    		  $string = str_replace('08','8',$string);
    		  $string = str_replace('09','9',$string);
  	  	  return $string;
  
  	  	  } 
  	  	  
  	  	  if($_GET['ftmes'] == '') {
                  $ers = date('m'); 		  
 		  $ano = date('Y');
           	  } else {
 		  $ers = $_GET['ftmes']; 		  
 		  $ano = date('Y');
 		  }
                  $mesbuscas = fndata($ers);
                  
 		  $consultas = $mysqli->query("SELECT * FROM lc_movimento WHERE mes = '$mesbuscas' AND ano = '$ano'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $lcid = $campo['cat'];
		  $cattd = $mysqli->query("SELECT * FROM lc_cat WHERE id = '$lcid'");
 		  $cat = mysqli_fetch_array($cattd);
		  ?>
		  <tr>
                      <td><?php echo $campo['descricao']; ?></td>
                      <td>R$ <?php echo number_format($campo['valor'],2,',','.'); ?></td>
                      <td><?php echo $campo['dia']; ?></td>
                      <td><?php echo $campo['pedido']; ?></td>
			          <td><?php echo $campo['admin']; ?></td>
 		      <td><?php if($campo['tipo'] == 1) { ?><span class="label label-success">RECEITA</span><?php } else { ?>
		       <span class="label label-danger">DESPESA</span><?php } ?></td>
 		      
		      <td><?php echo $cat['nome']; ?></td>
                    </tr>
		  <?php  } ?>
                  </tbody>
                  
                  <?php
$qr=$mysqli->query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 && mes='$mesbuscas' && ano='$ano'");
$row=mysqli_fetch_array($qr);
$entradas=$row['total'];

$qr=$mysqli->query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 && mes='$mesbuscas' && ano='$ano'");
$row=mysqli_fetch_array($qr);
$saidas=$row['total'];

$resultado_mes=$entradas-$saidas;
?>
                  
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
					  <th></th>
                      <th>Total Receitas <br>R$ <?php echo number_format($entradas,2,',','.'); ?></th>
                      <th>Total Despesas <br>R$ <?php echo number_format($saidas,2,',','.'); ?></th>
                      <th>Saldo Caixa <br>R$ <?php echo number_format($entradas - $saidas,2,',','.'); ?></th>
                    </tr>
                  </tfoot>
                  
                  
                </table>
                </div>
                <?php } /* Relatório Financeiro Mes Atual */ ?>
                
                
                <?php if($_GET['relatorio'] == "relatorio_retornos") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                <input type="text" placeholder="Data de Consulta" id="data" class="form-control" style="width:300px;" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_retornos&data=' + this.value;">
                <br>
                 <div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Boleto</th>
                      <th>Valor</th>
                      <th>Data Efetivação</th>
                      <th>Data Vencimento</th>
                      <th>Cliente</th>
                      <th>Plano</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  if($_GET['data'] == '') {
                  $dataprocesso = date('Y-d-m');
                  } else {
           	  $processa = $_GET['data'];
    		  $prd = explode("/",$processa);
    		  $dia = $prd[0];
    		  $mes = $prd[1];
    		  $ano = $prd[2];
    		  $dataprocesso = $ano."-".$mes."-".$dia;
                  }
                  
 		  $consultas = $mysqli->query("SELECT * FROM retornos WHERE dataprocessado = '$dataprocesso'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $bblo = $campo['codigo'];
		  $rota = $mysqli->query("SELECT * FROM financeiro WHERE boleto = '$bblo'");
 		  $aser = mysqli_fetch_array($rota);
		  $idcliente = $aser['cliente'];
		  $rotacl = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
 		  $cliente = mysqli_fetch_array($rotacl);
 		  $idplano = $aser['cliente'];
		  $rotapl = $mysqli->query("SELECT * FROM planos WHERE id = '$idplano'");
 		  $plano = mysqli_fetch_array($rotapl);
		  ?>
		  <?php if($aser['situacao'] == "P") { ?>
		  <tr>
                      <td><?php echo $campo['codigo']; ?></td>
                      <td>R$ <?php echo number_format($campo['valor'],2,',','.'); ?></td>
                      <td><?php
		      $var = $campo['dataefetivacao'];
		      $date = str_replace('-', '/', $var);
		      echo date('d/m/Y', strtotime($date));
		      ?></td>
                      <td><?php
		      $var = $campo['datavencimento'];
		      $date = str_replace('-', '/', $var);
		      echo date('d/m/Y', strtotime($date));
		      ?></td>
 		      <td><?php echo $cliente['nome']; ?></td>
 		      <td><?php echo $plano['nome']; ?></td>
 		      
                    </tr>
                    <?php } ?>
		  <?php  } ?>
                  </tbody>
                </table>
                </div>
                <?php } /* Relatório Retornos Boletos Dia Atual */ ?>
                
                
                <?php if($_GET['relatorio'] == "relatorio_planosvclientes") { ?>
                
		<orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
		<br><br><br>
		<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Plano</th>
                      <th>Servidor</th>
                      <th>Valor</th>
                      <th>Upload</th>
                      <th>Download</th>
                      <th>Assinaturas</th>
                      <th>Ativas</th>
                      <th>Bloquedas</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                
 		  $consultas = $mysqli->query("SELECT * FROM planos");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $bblo = $campo['id'];
		  
		  $rota = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$bblo'");
 		  $aser = mysqli_fetch_array($rota);
		  $row = mysqli_num_rows($rota);
		  $ssrv = $campo['servidor'];
		  $srv = $mysqli->query("SELECT * FROM servidores WHERE id = '$ssrv'");
 		  $servidor = mysqli_fetch_array($srv);
		  
		  $rotaat = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$bblo' AND status = 'S'");
		  $ativos = mysqli_num_rows($rotaat);
		  
		  $rotabq = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$bblo' AND status = 'N'");
		  $bloqueados = mysqli_num_rows($rotabq);
		  ?>
		  <tr>
                      <td><?php echo $campo['nome']; ?></td>
                      <td><?php echo $servidor['servidor']; ?></td>
                      <td>R$ <?php echo number_format($campo['preco'],2,',','.'); ?></td>
                      <td><?php echo $campo['upload']; ?>kbps</td>
		      <td><?php echo $campo['download']; ?>kbps</td>
		      <td><span class="label label-info"><?php echo $row; ?></span> <a href="index.php?app=Relatorios&relatorio=clientexplanos&plano=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning btn-small">Filtrar</a></td>
		      <td><span class="label label-success"><?php echo $ativos; ?></span> <a href="index.php?app=Relatorios&relatorio=atvxplanos&plano=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning btn-small">Filtrar</a></td>
		      <td><span class="label label-danger"><?php echo $bloqueados; ?></span> <a href="index.php?app=Relatorios&relatorio=blockxplanos&plano=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning btn-small">Filtrar</a></td>
 		      
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
                </div>
                <?php } /* Relatório Planos */ ?>
                
                <?php if($_GET['relatorio'] == "clientexplanos") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                
                <br><br><br>
		<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Telefones</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Plano</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $plano = base64_decode($_GET['plano']);
 		  $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$plano'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $bblo = $campo['cliente'];
		  $rota = $mysqli->query("SELECT * FROM clientes WHERE id = '$bblo'");
 		  $cliente = mysqli_fetch_array($rota);
		  $row = mysql_num_rows($rota);
		  $ssrv = $campo['plano'];
		  $srv = $mysqli->query("SELECT * FROM planos WHERE id = '$ssrv'");
 		  $plano = mysqli_fetch_array($srv);
		  ?>
		  <tr>
                      <td><?php echo $cliente['nome']; ?><br><?php echo $cliente['cpf']; ?></td>
                      <td><?php echo $cliente['tel']; ?><br><?php echo $cliente['cel']; ?></td>
                      <td><?php echo $cliente['endereco']; ?> <?php echo $cliente['numero']; ?><br>
		      <?php echo $cliente['complemento']; ?> <?php echo $cliente['bairro']; ?></td>
                      <td><?php echo $cliente['cidade']; ?> <?php echo $cliente['estado']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
		      <td><?php if($campo['status'] == "S") { ?>Ativo<?php } else { ?>Bloqueado<?php } ?></td>
 		      
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
                </div>
                <?php } /* Relatório Planos */ ?>
                
                
                <?php if($_GET['relatorio'] == "atvxplanos") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
		<br><br><br>
		<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Telefones</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Plano</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $plano = base64_decode($_GET['plano']);
 		  $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$plano' AND status = 'S'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $bblo = $campo['cliente'];
		  $rota = $mysqli->query("SELECT * FROM clientes WHERE id = '$bblo'");
 		  $cliente = mysqli_fetch_array($rota);
		  $row = mysql_num_rows($rota);
		  $ssrv = $campo['plano'];
		  $srv = $mysqli->query("SELECT * FROM planos WHERE id = '$ssrv'");
 		  $plano = mysqli_fetch_array($srv);
		  ?>
		  <tr>
                      <td><?php echo $cliente['nome']; ?><br><?php echo $cliente['cpf']; ?></td>
                      <td><?php echo $cliente['tel']; ?><br><?php echo $cliente['cel']; ?></td>
                      <td><?php echo $cliente['endereco']; ?> <?php echo $cliente['numero']; ?><br>
		      <?php echo $cliente['complemento']; ?> <?php echo $cliente['bairro']; ?></td>
                      <td><?php echo $cliente['cidade']; ?> <?php echo $cliente['estado']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
		      <td><?php if($campo['status'] == "S") { ?>Ativo<?php } else { ?>Bloqueado<?php } ?></td>
 		      
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
                </div>
                <?php } /* Relatório Planos */ ?>
                
                
                <?php if($_GET['relatorio'] == "blockxplanos") { ?>
                <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
		<br><br><br>
		<div class="printable">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Telefones</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Plano</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $plano = base64_decode($_GET['plano']);
 		  $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$plano' AND status = 'N'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $bblo = $campo['cliente'];
		  $rota = $mysqli->query("SELECT * FROM clientes WHERE id = '$bblo'");
 		  $cliente = mysqli_fetch_array($rota);
		  $row = mysql_num_rows($rota);
		  $ssrv = $campo['plano'];
		  $srv = $mysqli->query("SELECT * FROM planos WHERE id = '$ssrv'");
 		  $plano = mysqli_fetch_array($srv);
		  ?>
		  <tr>
                      <td><?php echo $cliente['nome']; ?><br><?php echo $cliente['cpf']; ?></td>
                      <td><?php echo $cliente['tel']; ?><br><?php echo $cliente['cel']; ?></td>
                      <td><?php echo $cliente['endereco']; ?> <?php echo $cliente['numero']; ?><br>
		      <?php echo $cliente['complemento']; ?> <?php echo $cliente['bairro']; ?></td>
                      <td><?php echo $cliente['cidade']; ?> <?php echo $cliente['estado']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
		      <td><?php if($campo['status'] == "S") { ?>Ativo<?php } else { ?>Bloqueado<?php } ?></td>
 		      
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
                </div>

                <?php } /* Relatório Planos */ ?>

                  <script>

                      jQuery(function($){
                          $(".data").mask("99/99/9999");
                          $(".cel").mask("(999) 99999-9999");
                          $(".tel").mask("(999) 9999-9999");
                          $(".cep").mask("99999-999");
                      });
                  </script>


                  <?php if($_GET['relatorio'] == "relatorio_fatura_data") { ?>

                      <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>


                      <form action="" method="post">
                            <!-- O SEGREDO DA PARADA -->
                          <input type="hidden" name="post" id="post" value="1"/>
                            <!-- FIM SEGREDO DA PARADA -->


                      <section class="col-md-4">
                          <label style="color: red" class="label ">Vencimento</label>
                          <label class="input">
                              <input type="text" name="campo[]" class="data"  value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vencimento'])); ?><?php } ?>"  required>
                          </label>
                      </section>
                          <section  class="col-md-2">
                              <label style="color: black"class="label">Bloqueados</label>
                              <label class="input">
                                    <input type="radio" name="campo[]" id="campo" value="B"/>
                              </label>
                          </section>
                          <section class="col-md-2">
                              <label style="color: black" class="label">A Pagar</label>
                              <label class="input">
                                  <input type="radio" name="campo[]" id="campo" value="N"/>
                              </label>
                          </section>
                          <section class="col-md-2">
                              <label style="color: black" class="label">Pago</label>
                              <label class="input">
                                  <input type="radio" name="campo[]" id="campo" value="P"/>
                              </label>
                            </section>
                          </section>

                          <input type="submit" value="Buscar" class="btn btn-success"/>
                      </form>


                      <br>
                      <div class="printable">
                          <table class="table ">
                              <thead>
                              <tr>
                                  <th>Fatura</th>
                                  <th>Nome do Cliente</th>
                                  <th>Plano</th>
                                  <th>Valor</th>
                                  <th>Vencimento</th>
                                  <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($_POST['post'] == 1){
                                  $campo = $_POST['campo'];

                                  $total = count($campo);

                                  if($total == 1){
                                      $datainicial  = $campo[0];
                                      $datainicial  = substr($datainicial,6,4)."-".substr($datainicial,3,2)."-".substr($datainicial,0,2);

                                      $status  = $_POST['bloquado'];

                                      $consultas = $mysqli->query("SELECT * FROM financeiro WHERE vencimento = '$datainicial' group by id");
                                  }else{
                                  $datainicial  = $campo[0];
                                  $datainicial  = substr($datainicial,6,4)."-".substr($datainicial,3,2)."-".substr($datainicial,0,2);

                                  $status  = $_POST['bloquado'];

                                  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE vencimento = '$datainicial'  AND situacao = '$campo[1]$campo[2]$campo[3]' group by id");
                                  }

                              }else{
                               //   $consultas = mysql_query("SELECT * FROM financeiro group by boleto");
                              }




                              while($campo = mysqli_fetch_array($consultas)){

                                  $cliente = $campo['cliente'];
                                  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
                                  $cliente = mysqli_fetch_array($ccs);

                                  $plano = $campo['plano'];
                                  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
                                  $plano = mysqli_fetch_array($pps);
                                  ?>
                                  <tr>
                                      <td><?php echo $campo['id']; ?></td>
                                      <td><?php echo $cliente['nome']; ?></td>
                                      <td><?php echo $plano['nome']; ?></td>
                                      <td>
                                          <?php
                                          $data_inicial = $campo['cadastro'];
                                          $data_final = $campo['vencimento'];
                                          $diferenca = strtotime($data_final) - strtotime($data_inicial);
                                          $dias = floor($diferenca / (60 * 60 * 24));

                                          ?>
                                          <?php if($dias >= 30) { ?>
                                              R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
                                          <?php } else { ?>
                                              R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
                                          <?php } ?>
                                      </td>
                                      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>

                                      <td>
                                          <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
                                          <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
                                          <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
                                          <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
                                          <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
                                      </td>
                                  </tr>
                              <?php  } ?>
                              </tbody>
                          </table>
                      </div>
                  <?php } /* Relatório de Faturas por Data */ ?>



                  <?php if($_GET['relatorio'] == "relatorio_por_data") { ?>

                      <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>


                      <form action="" method="post">
                          <!-- O SEGREDO DA PARADA -->
                          <input type="hidden" name="post" id="post" value="1"/>
                          <!-- FIM SEGREDO DA PARADA -->


                          <section class="col-md-3">
                              <label style="color: red" class="label">Data Inicial</label>
                              <label class="input">
                                  <input type="text" name="dataini" class="data"  value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vencimento'])); ?><?php } ?>"  required>
                              </label>
                          </section>


                          <section class="col-md-3">
                              <label style="color: red" class="label ">Data Final</label>
                              <label class="input">
                                  <input type="text" name="datafim" class="data"  value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vencimento'])); ?><?php } ?>"  required>
                              </label>
                          </section>



                          <input type="submit" value="Buscar" class="btn btn-success"/>
                      </form>


                      <br>
                      <div class="printable">
                          <table class="table ">
                              <thead>
                              <tr>
                                  <th>Fatura</th>
                                  <th>Nome do Cliente</th>
                                  <th>Plano</th>
                                  <th>Valor</th>
                                  <th>Vencimento</th>
                                  <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if(isset($_POST['dataini'])  && empty( $_POST['dataini']) == false) {

                                  if (isset($_POST['datafim']) && empty($_POST['datafim']) == false) {

                                       $dataini = $_POST['dataini'];
                                       $datafim = $_POST['datafim'];

                                       $datainicial  = substr($dataini,6,4)."-".substr($dataini,3,2)."-".substr($dataini,0,2);
                                       $datafinal  = substr($datafim,6,4)."-".substr($datafim,3,2)."-".substr($datafim,0,2);



                                      $consultas = $mysqli->query("SELECT * FROM financeiro WHERE vencimento BETWEEN '$datainicial'  AND '$datafinal' group by id");

                                  }
                              }



                              while($campo = mysqli_fetch_array($consultas)){

                                  $cliente = $campo['cliente'];
                                  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
                                  $cliente = mysqli_fetch_array($ccs);

                                  $plano = $campo['plano'];
                                  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
                                  $plano = mysqli_fetch_array($pps);
                                  ?>
                                  <tr>
                                      <td><?php echo $campo['id']; ?></td>
                                      <td><?php echo $cliente['nome']; ?></td>
                                      <td><?php echo $plano['nome']; ?></td>
                                      <td>
                                          <?php
                                          $data_inicial = $campo['cadastro'];
                                          $data_final = $campo['vencimento'];
                                          $diferenca = strtotime($data_final) - strtotime($data_inicial);
                                          $dias = floor($diferenca / (60 * 60 * 24));

                                          ?>
                                          <?php if($dias >= 30) { ?>
                                              R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
                                          <?php } else { ?>
                                              R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
                                          <?php } ?>
                                      </td>
                                      <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>

                                      <td>
                                          <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
                                          <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
                                          <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
                                          <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
                                          <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
                                      </td>
                                  </tr>
                              <?php  } ?>
                              </tbody>
                          </table>
                      </div>
                  <?php } /* Relatório de Faturas por Data */ ?>





                  <?php if($_GET['relatorio'] == "log_conexao") { ?>
                      <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
                  <!--    <input type="text" placeholder="Consultar por Login" id="login" class="form-control" style="width:300px;" onchange="window.location='index.php?app=Relatorios&relatorio=log_conexao&login=' + this.value;"> -->

                      <br><br><br>
                      <div class="printable">
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Login</th>
                                  <th>Senha</th>
                                  <th>Data</th>
                                  <th>Mensagem</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                            //  $login = $_GET['login'];
                            //$consultas = mysql_query("SELECT * FROM radpostauth WHERE username = '$login' ORDER BY id DESC LIMIT 100");
                            $consultas = $mysqli->query("SELECT * FROM radpostauth ORDER BY id DESC LIMIT 100");
                              while($campo = mysqli_fetch_array($consultas)){
                                  if ($campo['reply'] == 'Access-Accept') {
                                      $cor = "197D19;color:#ffffff;";
                                  }
                                  if ($campo['reply'] == 'Access-Reject') {
                                      $cor = "E82700;color:#ffffff;";
                                  }
                                  ?>

                                  <tr style="background:#<?php echo $cor; ?>">
                                      <td><?php echo $campo['id']; ?></td>
                                      <td><?php echo $campo['username']; ?></td>
                                      <td><?php echo $campo['pass']; ?> </td>
                                      <td><?php echo $campo['authdate']; ?></td>
                                      <td><?php if($campo['reply'] == "Access-Accept") { ?>Login OK<?php } else { ?>Falha<?php } ?></td>
                                      <td>

                                  </tr>
                              <?php } ?>

                              </tbody>
                          </table>
                      </div>

                  <?php } /* Relatório Log Conexão */ ?>


				  <?php if($_GET['relatorio'] == "relatorio_comodato") { ?>
					  <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
<!--					  <select name="grau" style="width:300px;" class="form-control" onchange="window.location='index.php?app=Relatorios&relatorio=relatorio_comodato&ftmes=' + this.value;">
						  <option value="">Selecione um Mês</option>
						  <option value="01">Janeiro</option>
						  <option value="02">Fevereiro </option>
						  <option value="03">Março </option>
						  <option value="04">Abril </option>
						  <option value="05">Maio</option>
						  <option value="06">Junho</option>
						  <option value="07">Julho</option>
						  <option value="08">Agosto</option>
						  <option value="09">Setembro</option>
						  <option value="10">Outubro</option>
						  <option value="11">Novembro</option>
						  <option value="12">Dezembro</option>
					  </select>
-->

					  <style type="text/css">
						  @import url("../../assets/css/vendors/x-editable/address.css");
						  @import url("../../assets/css/vendors/x-editable/select2.css");
						  @import url("../../assets/css/vendors/x-editable/typeahead.js-bootstrap.css");
						  @import url("../../assets/css/vendors/x-editable/demo-bs3.css");
						  @import url("../../assets/css/vendors/x-editable/select2-bootstrap.css");
						  @import url("../../assets/css/vendors/x-editable/bootstrap-editable.css");
					  </style>

					  <link href="../../assets/css/styles.css" rel="stylesheet" type="text/css">

					  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
					  <script type="text/javascript" src="../../assets/js/vendors/modernizr/modernizr.custom.js"></script>

					  <!--Forms -->
					  <script type="text/javascript" src="../../assets/js/vendors/forms/jquery.form.min.js"></script>
					  <script type="text/javascript" src="../../assets/js/vendors/forms/jquery.validate.min.js"></script>
					  <script type="text/javascript" src="../../assets/js/vendors/forms/jquery.maskedinput.min.js"></script>
					  <script type="text/javascript" src="../../assets/js/vendors/jquery-steps/jquery.steps.min.js"></script>
				  <?php

				  	$datai            = $_POST['start'];
				  	$datai_conv = substr($datai,6,7).'-'.substr($datai,3,2).'-'.substr($datai,0,2);

				  	  $dataf            = $_POST['finish'];
				  	  $dataf_conv = substr($dataf,6,7).'-'.substr($dataf,3,2).'-'.substr($dataf,0,2);

					?>
					  <form action=""  method="post" id="data-pickers" class="orb-form">
						  <fieldset>
							  <label class="label">Selecione as Opções</label>
							  <div class="row">
								  <section class="col col-4">
									  <label class="input"> <i class="icon-append fa fa-calendar"></i>
										  <input type="text" name="start" id="start" placeholder="Data Inicial">
									  </label>
								  </section>
								  <section class="col col-4">
									  <label class="input"> <i class="icon-append fa fa-calendar"></i>
										  <input type="text" name="finish" id="finish" placeholder="Data Final">
									  </label>
								  </section>
							  </div>
						  </fieldset>
						  <footer>
							  <button type="submit" class="btn btn-default">Consultar</button>
						  </footer>
						  </form>

					  <br>
					  <div class="printable">
						  <table class="table">
							  <thead>
							  <tr>
								  <th>Fatura</th>
								  <th>Nome do Cliente</th>
								  <th>Plano</th>
								  <th>Valor</th>
								  <th>Vencimento</th>
								  <th>Status</th>
							  </tr>
							  </thead>
							  <tbody>
							  <?php
							/*  if($_GET['ftmes'] == '') {
								  $mes = date('m');
								  $ano = date('Y');
							  } else {
								  $mes = $_GET['ftmes'];
								  $ano = date('Y');
							  }*/


							//  $consultas = $mysqli->query("SELECT * FROM financeiro,clientes WHERE clientes.id = financeiro.cliente AND clientes.grupo = 'C'  AND ano = '$ano' AND mes = '$mes' AND situacao = 'B' group by boleto");
							  $consultas = $mysqli->query("SELECT * FROM financeiro,clientes WHERE vencimento  BETWEEN '$datai_conv' AND '$dataf_conv'  AND clientes.id = financeiro.cliente AND clientes.grupo = 'C' AND situacao = 'B' group by boleto");
							  while($campo = mysqli_fetch_array($consultas)){

								  $cliente = $campo['cliente'];
								  $ccs = $mysqli->query("SELECT * FROM clientes WHERE grupo = 'C' AND id = '$cliente'");
								  $cliente = mysqli_fetch_array($ccs);

								  $plano = $campo['plano'];
								  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
								  $plano = mysqli_fetch_array($pps);
								  ?>
								  <tr>
									  <td><?php echo $campo['boleto']; ?></td>
									  <td><?php echo $cliente['nome']; ?></td>
									  <td><?php echo $plano['nome']; ?></td>
									  <td>
										  <?php
										  $data_inicial = $campo['cadastro'];
										  $data_final = $campo['vencimento'];
										  $diferenca = strtotime($data_final) - strtotime($data_inicial);
										  $dias = floor($diferenca / (60 * 60 * 24));

										  ?>
										  <?php if($dias >= 30) { ?>
											  R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
										  <?php } else { ?>
											  R$ <?php echo number_format($campo['valor'],2,',','.'); ?>
										  <?php } ?>
									  </td>
									  <td><?php echo $campo['dia']; ?>/<?php echo $campo['mes']; ?>/<?php echo $campo['ano']; ?></td>

									  <td>
										  <?php if ($campo['situacao'] == 'A') { ?>ABERTO<?php } ?>
										  <?php if ($campo['situacao'] == 'C') { ?>CANCELADO<?php } ?>
										  <?php if ($campo['situacao'] == 'P') { ?>PAGO<?php } ?>
										  <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
										  <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
									  </td>
								  </tr>
							  <?php  } ?>
							  </tbody>
						  </table>
					  </div>
				  <?php } /* Relatório de Clientes Comodato */ ?>


				  <?php if($_GET['relatorio'] == "relatorio_clientesassinantesbloqueio") { ?>
					  <orb id="print" style="float:right;" class="btn btn-info"><i class="fa fa-print"></i></orb>
					  <br><br><br>
					  <div class="printable">
						  <table class="table">
							  <thead>
							  <tr>
								  <th>Cliente</th>
								  <th>Endereço</th>
								  <th>Cidade</th>
								  <th>UF</th>
								  <th>Telefone(s)</th>
								  <th>Assinaturas</th>
							  </tr>
							  </thead>
							  <tbody>
							  <?php
							  $consultas = $mysqli->query("SELECT * FROM clientes,assinaturas WHERE clientes.id = assinaturas.cliente AND assinaturas.status = 'N' order by nome ASC");
							  while($campo = mysqli_fetch_array($consultas)){

								  //$cliente = $campo['id'];
								  //$ccs = mysql_query("SELECT * FROM assinaturas WHERE  cliente = '$cliente'");
								  //$assinatura = mysql_fetch_array($ccs);
								  //$row = mysql_num_rows($ccs);
								  ?>
								  <tr>
									  <td><?php echo $campo['nome']; ?><br><?php echo $campo['cpf']; ?></td>
									  <td><small><?php echo $campo['endereco']; ?>, <?php echo $campo['numero']; ?><br>
											  <?php echo $campo['complemento']; ?> <?php echo $campo['bairro']; ?></small></td>
									  <td><?php echo $campo['cidade']; ?></td>
									  <td><?php echo $campo['estado']; ?></td>
									  <td><small><?php echo $campo['tel']; ?> <br> <?php echo $campo['cel']; ?></small></td>

									  <td><?php echo $row; ?><br>
										  <?php if($assinatura['status'] == "S") { ?><span class="label label-success">ATIVO</span>
										  <?php } else { ?><span class="label label-danger">BLOQUEADO</span><?php } ?>

									  </td>
								  </tr>
							  <?php  } ?>
							  </tbody>
						  </table>
					  </div>
				  <?php } /* Relatório de Clientes Assinantes */ ?>


			  </div>
            </div>
        	
          </div>
        </div> 
      </div>