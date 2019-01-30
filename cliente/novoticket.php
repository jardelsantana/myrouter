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
    
    if(isset ($_POST['cadastrar'])){
    
    $situacao = "O";
    $status = "S";
    $codigo = rand(9,999999);
    $empresa = '1';
    $problema = $_POST['problema'];
    $cliente = $_POST['clienteid'];
    $emissao = date('d/m/Y H:i:s');
    $serie = 'CLI';
    $bcliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
    $client = mysqli_fetch_array($bcliente);
    $nome = $client['nome'];
    
    $asscliente = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$cliente'");
    $assinaturas = mysqli_fetch_array($asscliente);
    $plano = $assinaturas['plano'];
    $assinatura = $assinaturas['id'];
    
    $servico = "Ordem de Serviço Avulsa";
    
    $crud = new crud('ordemservicos');  // tabela como parametro
    $crud->inserir("situacao,status,codigo,empresa,problema,cliente,servico,emissao,plano,assinatura,serie", "'$situacao','$status','$codigo','$empresa','$problema','$cliente','$servico','$emissao','$plano','$assinatura','$serie'");
    
    header("Location: novoticket.php?op=atz");
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
            <li class="active"><a href="os.php">Ordem de Serviço <span class="sr-only">(current)</span></a></li>
            <li><a href="dados.php">Meus Dados</a></li>
            <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Nova Chamada Técnica</h1>
	  <?php if($_GET['op'] == "atz") { ?>
	  <div class="alert alert-info" role="alert">
        <strong>Atenção!</strong> Seu ticket foi enviado com sucesso aguarde nosso técnico.
      	</div><?php } ?>
	  
	  <form action="?" method="post">
			    
		      <label>Informe seu problema ou dúvida.</label>
                      <textarea rows="12" class="form-control" name="problema"></textarea>
                      </label>
            
          <br>
          <input type="submit" name="cadastrar" class="btn btn-lg btn-success" value="Enviar">
          <input type="hidden" name="clienteid" value="<?php echo $logado['id']; ?>">
          </form>
                
          <br><br><br>
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
   $("#cel").mask("(999) 99999-9999");
   $("#tel").mask("(999) 9999-9999");
   $("#cep").mask("99999-999");
});
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
  </body>
</html>
<?php } ?>
