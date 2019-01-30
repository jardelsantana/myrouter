<?php
session_start();
ob_start();
header("Content-Type: text/html; charset=ISO-8859-1", true);
include("../config/conexao.class.php");

$emp = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
$empresa = mysqli_fetch_array($emp);
$empresa['foto'];


if ($_POST['operacao'] == 'login') {
    $login = $_POST['login'];
    $ssl = $_POST['ssl'];
    $senha = $_POST['senha'];

    $confirmacao = $mysqli->query("SELECT * FROM clientes WHERE login = '$login' AND senha = '$senha'");
    $contagem = mysqli_num_rows($confirmacao);
    $linha = mysqli_fetch_array($confirmacao);

    if ( $contagem == 1 ) {
        $_SESSION['login'] = $linha['login']; // Login do Usuário
        $_SESSION['id'] = $linha['id']; // ID do Usuário
        $_SESSION['nivel'] = "0"; // Nível de Permissão
        echo "<script>location.href='index.php'</script>"; //Acessa o Painel
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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Central do Assinante | Login</title>
    <link href="../assets/css/styles.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script type="text/javascript" src="../assets/js/vendors/horisontal/modernizr.custom.html"></script>
</head>

<body>
<div class="colorful-page-wrapper">
    <div class="center-block">
        <div class="login-block">
                <form action="?" method="POST" id="login-form" class="orb-form">
                    <input type="hidden" value="login" name="operacao">
                <header>
                    <div class="image-block"><img src="../assets/images/<?php echo $empresa['foto'];?>" alt="User" /></div>
                    Central do Assinante </header>
                <fieldset>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Login</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="inputEmail" name="login"  placeholder="Login" required autofocus>
                                </label>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Senha</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="senha" id="inputPassword"  placeholder="Senha" required>

                                </label>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <div class="col col-4"></div>
                            <div class="col col-8">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" checked>
                                    <i></i>Mantenha-me conectado</label>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="btn btn-default">Login</button>
                </footer>
            </form>
        </div>
        <div class="copyrights"> <?php echo $empresa['empresa']; ?> - <?php echo $empresa['tel1'];?><br>
            MyRouter ERP &copy; <?php echo date("Y"); ?></div>
    </div>
</div>

<!--Scripts-->
<!--JQuery-->
<script type="text/javascript" src="../assets/js/vendors/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/vendors/jquery/jquery-ui.min.js"></script>

<!--Forms-->
<script type="text/javascript" src="../assets/js/vendors/forms/jquery.form.min.js"></script>
<script type="text/javascript" src="../assets/js/vendors/forms/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/vendors/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="../assets/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<!--NanoScroller-->
<script type="text/javascript" src="../assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script>

<!--Sparkline-->
<script type="text/javascript" src="../assets/js/vendors/sparkline/jquery.sparkline.min.js"></script>

<!--Main App-->
<script type="text/javascript" src="../assets/js/scripts.js"></script>



<!--/Scripts-->

</body>
</html>