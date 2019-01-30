<?php
session_start();
ob_start();
header("Content-Type: text/html; charset=ISO-8859-1", true);
include("config/conexao.class.php");

$empresaversao = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
$empresav = mysqli_fetch_array($empresaversao);

$versao = $empresav['versao'];

if ($_POST['operacao'] == 'login') { 
$login = $_POST['login'];
$ssl = $_POST['ssl'];
$senha = md5($_POST['senha']);

$confirmacao = $mysqli->query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha' AND status = 'S'");
$contagem = mysqli_num_rows($confirmacao);
$linha = mysqli_fetch_array($confirmacao);

  if ( $contagem == 1 ) {
$_SESSION['login'] = $linha['login']; // Login do Usuário
$_SESSION['id'] = $linha['id']; // ID do Usuário
$_SESSION['nivel'] = $linha['nivel']; // Nível de Permissão
//echo "<script>location.href='dashboard'</script>"; //Acessa o Painel
echo "<script>location.href='index.php'</script>"; //Acessa o Painel


  // FUNCAO DE LOG INICIO
  $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
  $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
  $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$login', '".$ip."', '".$hora."','ACESSOU O SISTEMA','ACESSOU O SISTEMA', NULL)");

  // FUNCAO DE LOG FIM


} else {
echo '<script>
        alert ("LOGIN OU SENHA ESTÃO INVALIDOS!");
        document.location.href = ("login.php");
</script>';
}
} // Função POST OK


?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MyRouter ERP | Login</title>
<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>

<body>
<div class="colorful-page-wrapper">
  <div class="center-block">
    <div class="login-block">
      <form action="?" method="POST" id="orb-form" class="orb-form">
      <input type="hidden" value="login" name="operacao">
        <header>
          <div class="image-block"><img src="assets/images/logo.png" alt="" /></div>
         MyRouter ERP Login </header>
        <fieldset>
          <section>
            <div class="row">
              <label class="label col col-4">Usuário</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="login">
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <label class="label col col-4">Senha</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input type="password" name="senha">
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <div class="col col-4"></div>
              <div class="col col-8">
                <label class="checkbox">
                  <input type="checkbox" name="ssl" value="SIM">
                  <i></i>Conexão Segura</label>
              </div>
            </div>
          </section>
        </fieldset>
        <footer>
          <button type="submit" class="btn btn-info">ACESSAR</button>
        </footer>
      </form>
    </div>
    
    <div class="copyrights"> MyRouter ERP Para Provedores &copy; <?php echo date('Y'); ?> / <?php echo'Versão '?><?php echo @$empresav['versao']; ?> <br>
      </div>
  </div>
</div>

<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery-ui.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/jquery-steps/jquery.steps.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/sparkline/jquery.sparkline.min.js"></script> 
<script type="text/javascript" src="assets/js/scripts.js"></script>

</body>
</html>