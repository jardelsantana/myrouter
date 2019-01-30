<?php
session_start();
ob_start();
header("Content-Type: text/html; charset=ISO-8859-1", true);
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
    if(isset ($_POST['registro'])){
    
    $chave = $_POST['chave'];
    $cnpj   = $_POST['cnpj'];
        
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("chave='$chave',cnpj='$cnpj'", "id='1'");
    
    header("Location: index.php?app=Dashboard");
    }
    
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<meta name="keywords" content="">
<meta name="author" content="MyRouter ERP">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MyRouter ERP | Sistema Não Registrado</title>
<link href="assets/css/styles.css" rel="stylesheet" type="text/css">

<link id="demo-styles" href="assets/css/styles-defaults.css" rel="stylesheet" type="text/css">

<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<script type="text/javascript" src="assets/js/vendors/modernizr/modernizr.custom.js"></script>
</head>

<body>
<div class="standalone-page-wrapper"> 
  

  <div class="error-top-block">
    <div class="error-top-block-image"> <img src="assets/images/error-robot.png" alt="Ooops!" /> </div>
  </div>

  <div class="error-bottom-block">
    <div class="col-md-6 col-md-offset-3 error-description">
      <div class="error-code">BLOQUEADO</div>
      <div class="todo">
        <h4>Por que isso ?</h4>
        Desculpe o nosso sistema não reconheceu sua chave por varios motivos.<br>
        - Nova atualização ou instalação do programa.<br>
        - Copia sem autorização.<br>
        - Bloqueio da mensalidade. <br>
        * Entre em contato com nosso suporte; <b>contato@myrouter.com.br</b>
        
        <div class="input-group">
        <form action="" method="POST">
          <input placeholder="CHAVE" name="chave" type="text" class="form-control">
          <span class="input-group-btn"></span>

            <input placeholder="CNPJ" name="cnpj" type="text" class="form-control">
            <span class="input-group-btn"></span>

          <input type="submit" class="btn btn-default" name="registro" value="OK!">
           </div>
        </form>
        
      </div>
      <div class="copyrights"> MyRouter ERP &copy; <?php echo date('Y'); ?> </div>
    </div>
  </div>

</div>
</body>
</html>