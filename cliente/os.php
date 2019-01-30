<?php
session_start();
ob_start();
header("Content-Type: text/html; charset=ISO-8859-1", true);

        require_once '../config/conexao.class.php';
    require_once '../config/crud.class.php';
    require_once '../config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
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
    
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

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
          <a class="navbar-brand" href="#">MyRouter ERP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="os.php">Ordem de Serviço</a></li>
            <li><a href="dados.php">Meus Dados</a></li>
            <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="index.php">Faturas </a></li>
            <li class="active"><a href="#">Ordem de Serviço <span class="sr-only">(current)</span></a></li>
            <li><a href="dados.php">Meus Dados</a></li>
            <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Ordem de Serviço</h1>
	  Bem vindo <?php echo $logado['nome']; ?> <?php echo $logado['cpf']; ?>

          <a href="novoticket.php" style="float:right;" class="btn btn-info">ABRIR CHAMADO</a><br>
          
          
                <div class="row">
        	<div class="col-md-12">
          	
                  <?php
                  
 		  $mes = date('m');
 		  $cliente = $logado['id'];
 		  
 		  $ano = date('Y');
 		  $consultas = $mysqli->query("SELECT * FROM ordemservicos WHERE cliente = '$cliente'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  $cliente = $campo['cliente'];
		  $ccs = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($ccs);
 		  
 		  $plano = $campo['plano'];
		  $pps = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
 		  $plano = mysqli_fetch_array($pps);
		  ?>
		  <table class="table">
                  <thead>
                    <tr>
                      <th>Nº O.S</th>
                      <th>Nome do Cliente</th>
                      <th>Plano</th>
                      <th>Emitido</th>
                      <th>Problema</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
		  <tr>
                      <td><?php echo $campo['codigo']; ?></td>
                      <td><?php echo $cliente['nome']; ?></td>
                      <td><?php echo $plano['nome']; ?></td>
                      <td><?php echo $campo['emissao']; ?></td>
                      <td><?php echo $campo['problema']; ?></td>
		      <td>
		      <?php if ($campo['situacao'] == 'O') { ?> Orçamento <?php } ?>
		      <?php if ($campo['situacao'] == 'I') { ?> Instalado <?php } ?>
		      <?php if ($campo['situacao'] == 'NI') { ?> Instalação <?php } ?>
		      <?php if ($campo['situacao'] == 'M') { ?> Manutenção <?php } ?>
		      <?php if ($campo['situacao'] == 'R') { ?> Recuperação <?php } ?>
		      <?php if ($campo['situacao'] == 'A') { ?> Aprovado <?php } ?>
		      <?php if ($campo['situacao'] == 'C') { ?> Cancelada <?php } ?>
		      </td>
		      
                    </tr>
                    <?php if ($campo['solucao'] <> '') { ?>
                    <table width="100%"><tr>
                    <th>Solução</th>
                    <th></th>
                    <th>Atendente</th>
                    <th>Valor</th>
                    </tr>
                    <tr>
                    <td><small><?php echo $campo['solucao']; ?></td>
                    <td width="50"></td>
                    <td width="190"><?php echo $campo['atendente']; ?></td>
                    <td width="110">R$ <?php echo number_format($campo['preco'],2,',','.'); ?></td>
                    </tr></table>
                    <?php } ?>
                     </tbody>
                  
                </table><hr>
		  <?php  } ?>

                 
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
