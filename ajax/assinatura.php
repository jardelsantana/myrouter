<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);
include("../config/conexao.class.php");

$campo = $_GET['campo'];
$valor = $_GET['valor'];

$ok=''; // imagem de confirmação
$erro='<font color=red>ERRO</font>'; // imagem de negação

// Verificando o campo codigo
if ($campo == "login") {

    $sql = $mysqli->query("SELECT * FROM assinaturas WHERE login = '$valor'");
    $job = mysqli_fetch_array($sql);


    if ($job['login'] == $valor) {
        echo $erro;
        echo " Login já utilizado.";
    } else {
        echo $ok;
    }

}
?>