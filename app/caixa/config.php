<?php
include("../../config/conexao.class.php");
//Configuração do Banco de dados
$host = $host;
$user = $login_db;
$pass = $senha_db;
$d_b = $database;

//Título do seu livro Caixa, geralmente seu nome
$lc_titulo="ERPMK";

//Autenticação simples
$usuario="admin";
$senha="123";

//////////////////////////////////////
//Não altere a partir daqui!
//////////////////////////////////////

$conn = mysql_connect($host, $user, $pass) or die("Erro na conexao com a base de dados");
$db = mysql_select_db($d_b, $conn) or die("Erro na seleÐ·Ð³o da base de dados");

if (isset($_SESSION['logado']))
    $logado = $_SESSION['logado'];
else
    $logado = "";

$senha_ = md5($senha);

if (isset($_POST['login']) && $_POST['login'] != '') {

    if ($_POST['login'] == $usuario && $_POST['senha'] == $senha) {
        $logado = $_SESSION['logado'] = md5($_POST['senha']);
        header("Location: ./");
        exit();
    }
}


?>
