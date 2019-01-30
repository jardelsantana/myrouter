<?php
session_start();
ob_start();
header("Content-Type: text/html; charset=ISO-8859-1", true);

    require_once '../config/conexao.class.php';
    require_once '../config/crud.class.php';
    require_once '../config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco


    $empresa = $mysqli->query("SELECT * FROM empresa");
    $campoEmpresa = mysqli_fetch_array($empresa);
    
if ( !isset($_SESSION['login']) ){ // Verifica Login do Usuário

echo "
<script>
   	window.location = 'login.php';
    </script>
";
} else { 
    
    $idbase = $_SESSION['id'];  
    if($idbase){ 
        $cslogin = $mysqli->query("SELECT * FROM clientes WHERE id = + $idbase");
        $logado = mysqli_fetch_array($cslogin);
    }
    
?>

    <?php

    $link_monitor = "monitor.php?cpf=".$logado['cpf'];

    ?>

    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Painel do Cliente, Bem vindo <?php echo $logado['nome']; ?></title>
    <link href="../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $campoEmpresa['empresa'];?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="os.php">Ordem de Serviço</a></li>
            <li><a href="dados.php">Meus Dados</a></li>
              <li><a href=<?php echo $link_monitor  ?> >Monitoramento</a></li>
              <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
      </div>
    </nav>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Faturas <span class="sr-only">(current)</span></a></li>
            <li><a href="os.php">Ordem de Serviço</a></li>
            <li><a href="dados.php">Meus Dados</a></li>
              <li><a href=<?php echo $link_monitor  ?>>Monitoramento</a></li>
            <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
	  Bem vindo <?php echo $logado['nome']; ?> <?php echo $logado['cpf']; ?>

        
                <div class="row">
        	<div class="col-md-12">
          	<table class="table">
                  <thead>
                    <tr>
                      <th>Fatura</th>
                      <th>Nome do Cliente</th>
                      <th>Plano</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  
                  <?php
                  $cliente = $logado['id'];
 		  $consultas = $mysqli->query("SELECT * FROM boletos WHERE cliente = '$cliente' order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
		  
		  $link = $campo['linkGerencia'];
		
		      $dat_venc = $campo['vencimento'];
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
 		      
 		      $cda = explode("/",$campo['vencimento']);
    		      $ffdn = $cda[0];
    		      $ffmm = $cda[1];
    		      $ffaa = $cda[2];
 		      
 		      $datavencido = $ffaa."-".$ffmm."-".$ffdn;
		      if($datavencido < date('Y-m-d')) { 
		      $valordoboletofn = number_format($valoratual,2,',','.');
		      
		      $exibevaloresboleto = "<br>Juros: R$ $juros <br>Multa: R$ $multa ";
		      $exibeprazosboleto = "<br><span class='label label-info'>$dat_novo_venc ";
		      
		      } else {
		      $valordoboletofn = number_format($campo['valor'],2,',','.');
		      }
	              ?>
		  
		  <tr bgcolor="#efefff">
                      <td><?php echo $campo['boleto']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $campo['servico']; ?></td>
                      <?php if ($campo['status'] == 'P') { ?>
                      <td>R$ <?php echo $campo['valor']; ?></td>
 		      <td><?php echo $campo['vencimento']; ?></td>
                      <?php } else { ?>
                      <td>R$ <?php echo $valordoboletofn; ?><?php echo $exibevaloresboleto; ?></td>
 		      <td><?php echo $campo['vencimento']; ?><?php echo $exibeprazosboleto; ?></td>
 		      <?php } ?>
		      <td>
		      <?php if ($campo['status'] == 'A') { ?>ABERTO<?php } ?>
		      <?php if ($campo['status'] == 'C') { ?>CANCELADO<?php } ?>
		      <?php if ($campo['status'] == 'P') { ?>PAGO<?php } ?>
		      <?php if ($campo['status'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['status'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
		      
                      <td>
                      <?php if ($campo['status'] == 'P' || $campo['status'] == 'C') { ?>
                      
		      <span class="label label-success">CONFIRMADO</span>
		      <?php } else { ?>
              
              <?php 
if($campo['linkGerencia']!= ""){ ?>
<a href="<?php echo $link ?>" 
class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir pelo Gerencianet" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
<?php }else{?>
<a href="../boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;
              
              
              
	      <?php  } }  ?>
		      </td>
                    </tr>

                   
		  <?php  } ?>
                  
                  
                  
                  
                  <?php
                  
 		  $mes = date('m');
 		  $cliente = $logado['id'];
 		  
 		  $ano = date('Y');
 		 // $consultas = mysql_query("SELECT * FROM financeiro WHERE ano = '$ano' AND cliente = '$cliente'");
 		  $consultas = $mysqli->query("SELECT * FROM financeiro WHERE cliente = '$cliente' AND situacao != 'C' order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $link = $campo['linkGerencia'];
		  
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
		      <?php if ($campo['situacao'] == 'P') { ?><?php if($cliente['nf'] == 'S') { ?>
                      <a href="../imprimir-nfse.php?id=<?php echo base64_encode($campo['cliente']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir NFSe" target=_blank><i class="fa fa-file"></i></a>&nbsp; <?php } else { ?> ---------- <?php } ?><?php } ?>
		      <?php if ($campo['situacao'] == 'B') { ?>BLOQUEADO<?php } ?>
		      <?php if ($campo['situacao'] == 'N') { ?>A PAGAR<?php } ?>
		      </td>
		      
                      <td>
                      <?php if ($campo['situacao'] == 'P') { ?>
		      
		      <span class="label label-success">CONFIRMADO<?php } else { ?>
                            <?php 
if($campo['linkGerencia']!= ""){ ?>
<a href="<?php echo $link ?>" 
class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir pelo Gerencianet" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
<?php }else{?>
<a href="../boleto.php?cliente=<?php echo base64_encode($campo['cliente']); ?>&fatura=<?php echo base64_encode($campo['id']); ?>&tipo=1" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir Boleto" target=_blank><i class="fa fa-money"></i></a>&nbsp;
	      <?php  } } ?>

		      </td>
                    </tr>
                   
		  <?php  } ?>
		  

                  </tbody>
                  
                </table>
              </div></div>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php } ?>
