<?php
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1");

include "../../config/conexao.php";

$sql2 = $dbremessa->query("SELECT * FROM empresa")or die("Não é Possivel Conecta ao Banco de Dados");;
$banco = mysqli_fetch_array($sql2);

//var_dump($banco);

include 'vendor/CnabPHP/autoloader.php';
use CnabPHP\Remessa;

$sql3 = $dbremessa->query("SELECT max(boletos_arquivos_codigo) as remessa_id FROM boletos_arquivos WHERE bancos_codigo = ".$banco['bancos_codigo']);
$remessa = mysqli_fetch_array($sql3);

$remessa['remessa_id'] = $remessa['remessa_id'] +1;


$arquivo = new Remessa($banco['bancos_codigo'],$banco['bancos_layout'],array(
    'nome_empresa' =>$banco['empresa'], // seu nome de empresa
    'tipo_inscricao'  => 2, // 1 para cpf, 2 cnpj
    'numero_inscricao' => $banco['cnpj'], // seu cpf ou cnpj completo
    'agencia'       => $banco['agencia'], // agencia sem o digito verificador
    'agencia_dv'    => $banco['digito_ag'], // somente o digito verificador da agencia
    'conta'         => $banco['conta'], // n?mero da conta
    'conta_dv'     => $banco['digito_co'], // digito da conta
    'codigo_beneficiario'     => $banco['convenio'], // codigo fornecido pelo banco
    'codigo_beneficiario_dv'     => $banco['convenio_dv'], // codigo fornecido pelo banco
    'numero_sequencial_arquivo'     => $remessa['remessa_id'],
    'situacao_arquivo' =>'P' // use T para teste e P para produção
));
$lote  = $arquivo->addLote(array('tipo_servico'=> 1)); // tipo_servico  = 1 para cobrança registrada, 2 para sem registro

//echo 'nmero '.preg_replace( '#[^0-9]#', '', $banco['cnpj']); break;

foreach($_POST['id_venda'] as $key => $id_cliente){
    $id_venda = isset($_POST['id_venda'][$key])? $_POST['id_venda'][$key] :null;

    $seleciona  = $dbremessa->query("SELECT * FROM financeiro WHERE id = '$id_venda'");
    $fatura = mysqli_fetch_array($seleciona);

    $IdCliente = $fatura['cliente'];
    $sq = $dbremessa->query("SELECT * FROM clientes WHERE id='$IdCliente'");
    $cliente = mysqli_fetch_array($sq);
    if(strlen($cliente['cpf']) > 14){
        $documento = 2;
    }else{
        $documento = 1;

    }

    $cod_carteira = ($banco['bancos_codigo'] == 341) ? 'I' : 01 ;

    $lote->inserirDetalhe(array(
        'codigo_ocorrencia' => 1, //1 = Entrada de título, para outras opções ver nota explicativa C004 manual Cnab_SIGCB na pasta docs
        'nosso_numero'      => $fatura['id'], // numero sequencial de boleto
        'seu_numero'        => $fatura['id'],// se nao informado usarei o nosso numero
        'numero_documento'  => $fatura['id'],// se nao informado usarei o nosso numero

        /* campos necessarios somente para itau,  n?o precisa comentar se for outro layout    */
        'carteira_banco'    => $banco['carteira'], // codigo da carteira ex: 109,RG esse vai o nome da carteira no banco
        'cod_carteira'      => $cod_carteira, // I para a maioria ddas carteiras do itau
        'carteira'      => $banco['carteira'], // I para a maioria ddas carteiras do itau
        /* campos necessarios somente para itau,  n?o precisa comentar se for outro layout    */

        'especie_titulo'    => $banco['especie'], // informar dm e sera convertido para codigo em qualquer laytou conferir em especie.php
        'valor'             => trim($fatura['valor']), // Valor do boleto como float valido em php
        'emissao_boleto'    => 2, // tipo de emissao do boleto informar 2 para emissao pelo beneficiario e 1 para emissao pelo banco
        'protestar'         => 3, // 1 = Protestar com (Prazo) dias, 3 = Devolver após (Prazo) dias
        'prazo_protesto'    => 15, // Informar o numero de dias apos o vencimento para iniciar o protesto
        'nome_pagador'      => $cliente['nome'], // O Pagador ? o cliente, preste aten??o nos campos abaixo
        'tipo_inscricao'    => $documento, //campo fixo, escreva '1' se for pessoa fisica, 2 se for pessoa juridica
        'numero_inscricao'  => $cliente['cpf'],//cpf ou ncpj do pagador
        'endereco_pagador'  => $cliente['endereco'],
        'bairro_pagador'    => $cliente['bairro'],
        'cep_pagador'       => $cliente['cep'], // com hífem
        'cidade_pagador'    => $cliente['cidade'],
        'uf_pagador'        => $cliente['estado'],
        'data_vencimento'   => $fatura['vencimento'], // informar a data neste formato
        'data_emissao'      => $fatura['cadastro'], // informar a data neste formato
        'vlr_juros'         => 0.07, // Valor do juros de 1 dia'
       // 'data_desconto'     => $fatura['vencimento'], // informar a data neste formato
        'data_desconto'     => '0', // informar a data neste formato
        'vlr_desconto'      => '0', // Valor do desconto
        'baixar'            => 2, // codigo para indicar o tipo de baixa '1' (Baixar/ Devolver) ou '2' (Não Baixar / Não Devolver)
        'prazo_baixa'       => 90, // prazo de dias para o cliente pagar após o vencimento nao pode ser maior que 2 digitos
        'data_multa'        => $fatura['vencimento'], // informar a data neste formato, // data da multa
        'vlr_multa'         => 4.0, // valor da multa
        'taxa_juros'         => 2.2, // porcentagem %
        'taxa_multa'         => 2.0, // porcentagem %
    ));


}


$arrnome = 'REM'.str_pad($remessa['remessa_id'],5,'0',STR_PAD_LEFT).'.REM';
$remFile = fopen(getcwd().DIRECTORY_SEPARATOR.$arrnome, "w");
fwrite($remFile,utf8_decode($arquivo->getText()));
//fwrite($remFile,$arquivo->getText());
fclose($remFile);

$sql4 = $dbremessa->query("INSERT INTO boletos_arquivos (boletos_arquivos_codigo, bancos_codigo, situacao)VALUE (".$remessa['remessa_id'].",".$banco['bancos_codigo'].",'NOR')");

// para salvar

if($arquivo){
    foreach($_POST['id_venda'] as $key => $id_cliente){
        $id_venda = isset($_POST['id_venda'][$key])? $_POST['id_venda'][$key] :null;
        $up = $dbremessa->query("UPDATE financeiro SET remessa = '1', boletos_arquivos_codigo = ".$remessa['remessa_id']."  WHERE id = '$id_venda'");
    }

    if($up == 1){

        print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../../index.php?app=ListarRemessa'>
        <script type=\"text/javascript\">
        alert(\"ARQUIVO DE REMESSA GERADO COM SUCESSO!\");
        </script>";

    }

}
?>