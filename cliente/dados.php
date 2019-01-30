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
    
    if(isset ($_POST['editar'])){
    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $referencia = $_POST['referencia'];
    $complemento = $_POST['complemento'];
    $pai = $_POST['pai'];
    $mae = $_POST['mae'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $clienteid = $_POST['clienteid'];
    
    $crud = new crud('clientes'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',email='$email',senha='$senha',tel='$tel',cel='$cel',cpf='$cpf',rg='$rg',nascimento='$nascimento',endereco='$endereco',numero='$numero',referencia='$referencia',complemento='$complemento',pai='$pai',mae='$mae',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep'", "id='$clienteid'");
    
    header("Location: dados.php?op=atz");
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
            <li><a href="os.php">Ordem de Serviço</a></li>
            <li class="active"><a href="dados.php">Meus Dados <span class="sr-only">(current)</span></a></li>
            <li><a href="sair.php">Sair</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Meus Dados</h1>
	  <?php if($_GET['op'] == "atz") { ?>
	  <div class="alert alert-info" role="alert">
        <strong>Atenção!</strong> Seus dados foram atualizados com sucesso.
      	</div><?php } ?>
	  
	  <form action="?" method="post">
	  
	  <label>Nome Completo</label>
         <input type="text" name="nome" class="form-control" value="<?php echo $logado['nome']; ?>" placeholder="Nome Completo" required>
          
          <label>Telefone</label>
         <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $logado['tel']; ?>" placeholder="Telefone" required>
         
         <label>Celular</label>
         <input type="text" name="cel" id="cel" class="maskcel form-control" value="<?php echo $logado['cel']; ?>" placeholder="Celular" required>

          <label>CPF/CNPJ</label>
          <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo $logado['cpf']; ?>" placeholder="CPF" required>

          <label>RG/IE</label>
          <input type="text" name="rg" id="rg" class="form-control" value="<?php echo $logado['rg']; ?>" placeholder="RG" required>

          <label>Data de Nascimento</label>
          <input type="date" name="nascimento" id="nascimento" class="form-control" value="<?php echo $logado['nascimento']; ?>" placeholder="Data de Nascimento" required>

          <label>Endereço</label>
         <input type="text" name="endereco" class="form-control" value="<?php echo $logado['endereco']; ?>" placeholder="Endereço" required>
         
         <label>Número</label>
         <input type="text" name="numero" class="form-control" value="<?php echo $logado['numero']; ?>" placeholder="Nº" required>

          <label>Referência</label>
          <input type="text" name="referencia" class="form-control" value="<?php echo $logado['referencia']; ?>" placeholder="Referência" required>

          <label>Complemento</label>
         <input type="text" name="complemento" class="form-control" value="<?php echo $logado['complemento']; ?>" placeholder="Complemento">

          <label>Pai</label>
          <input type="text" name="pai" class="form-control" value="<?php echo $logado['pai']; ?>" placeholder="Nome do Pai">

          <label>Mãe</label>
          <input type="text" name="mae" class="form-control" value="<?php echo $logado['mae']; ?>" placeholder="Nome da Mãe">


          <label>Bairro</label>
         <input type="text" name="bairro" class="form-control" value="<?php echo $logado['bairro']; ?>" placeholder="Bairro" required>
         
         <label>Estado (UF)</label>
         <select name="estado" class="form-control" id="estado" value="<?php echo $logado['estado']; ?>"></select>
         
         <label>Cidade</label>
         <select name="cidade" class="form-control" id="cidade" value="<?php echo $logado['cidade']; ?>" required></select>
         
         <label>CEP</label>
         <input type="text" id="cep" name="cep" class="form-control" value="<?php echo $logado['cep']; ?>" placeholder="CEP" required>
          
         <label>E-mail</label>
         <input type="text" name="email" class="form-control" value="<?php echo $logado['email']; ?>" placeholder="Email">
	 
	 <label>Login</label>
         <input type="text" name="login" class="form-control" value="<?php echo $logado['login']; ?>" placeholder="Login" readonly>
	 
	 <label>Senha</label>
         <input type="password" name="senha" class="form-control" value="<?php echo $logado['senha']; ?>" placeholder="Senha" required> 
          <br><br>
          <input type="submit" name="editar" class="btn btn-lg btn-primary" value="Atualizar">
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


});

jQuery(function($){
   $(".nascimento").mask("99/99/9999");
   $("#celular").mask("(99)99999-9999");
   $("#tel").mask("(99)9999-9999");
   $("#cep").mask("99999-999");
});


</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.2-utf8.js"></script>
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
