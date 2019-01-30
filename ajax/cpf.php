<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);
include("../config/conexao.class.php");

$campo = $_GET['campo'];
$valor = $_GET['valor'];

$ok=''; // imagem de confirmação
$erro='<font color=red>ERRO</font>'; // imagem de negação

// Verificando o campo codigo
if ($campo == "cpf") {
   
   $sql = $mysqli->query("SELECT * FROM clientes WHERE cpf = '$valor'");
   $job = mysqli_fetch_array($sql);
   

    if ($job['cpf'] == $valor) {
    echo $erro;
    echo " CPF/CNPJ Já Cadastrado";
    } else {
    echo $ok;
        }

}
?>