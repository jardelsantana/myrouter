<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );

require_once("../../config/conexao.class.php");

$conlote = base64_decode($_GET['id']);

$nlote =  $_GET['nlote'];

$alterar =$mysqli->query("SELECT * FROM notafiscal");
$campo = mysqli_fetch_array($alterar);


$data_emissao = date('d/m/Y',strtotime($campo['emissao']));

$telefone = preg_replace("/\D+/", "", $campo['clientetelefone']); // remove qualquer caracter não numérico


$selEmpresa = $mysqli->query("SELECT * FROM empresa");
$campoEmpresa = mysqli_fetch_array($selEmpresa);

$ModeloNotaCampo = $campoEmpresa['modelonota'];

// Fetch Record from Database

$output = "";
$sql = $mysqli->query("SELECT cliente,cliente,clientenome,clienteendereco,clientenumero,clientecomplemento,clientebairro,clientecidade,clienteuf,clientecep,'','',clientecpf,clienterg,diavencimento,'$ModeloNotaCampo',cfop,'$telefone',clienteemail,'$telefone',tipoassinante,tipoutilizacao,'$data_emissao','$data_emissao',nnota,'',codmunicipio FROM notafiscal WHERE nlote ='$conlote'");
$columns_total = mysqli_num_fields($sql);

// Get Records from the table

while ($row = mysqli_fetch_array($sql)) {
    for ($i = 0; $i < $columns_total; $i++) {
        $output .=''.$row["$i"].'|';
    }
    $output .="\n";
}


// Download the file

$filename = "clie_nf.txt";
header('Content-type: application/text');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>