<?php
require_once("conexao.class.php");
$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco

$empresas = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
$empresa = mysqli_fetch_array($empresas);

$eqcendereco = $empresa['endereco'];
$eqccnpj = $empresa['cnpj'];
$eqcestado = $empresa['cidade']." ".$empresa['estado'];
$eqccedente = $empresa['empresa'];
$eqcid = $empresa['empresa'];

$eqcb1 = $empresa['receberate'];
$eqcb2 = $empresa['instrucoes1'];
$eqcb3 = $empresa['instrucoes2'];
$eqcb4 = $empresa['instrucoes3'];
$eqcb5 = $empresa['carteira'];
$eqcb6 = $empresa['agencia'];
$eqcb7 = $empresa['digito_ag'];
$eqcb8 = $empresa['conta'];
$eqcb9 = $empresa['digito_co'];
$eqcb10 = $empresa['tipo_carteira'];
$eqcb11 = $empresa['convenio'];
$eqcb12 = $empresa['contrato'];
$eqcb13 = $empresa['convenio_dv'];

define('ENDERECO', "$eqcendereco");
define('CNPJ', "$eqccnpj");
define('CIDADE', "$eqcestado");
define('CEDENTE', "$eqccedente");
define('IDENTIFICADOR', "$eqcid");
define('RECEBER', "$eqcb1");
define('INSTRUCOES1', "$eqcb2");
define('INSTRUCOES2', "$eqcb3");
define('INSTRUCOES3', "$eqcb4");
define('CARTEIRA', "$eqcb5");
define('AG', "$eqcb6");
define('AGDG', "$eqcb7");
define('CONTA', "$eqcb8");
define('CONTADG', "$eqcb9");
define('TIPO', "$eqcb10");
define('CONVENIO', "$eqcb11");
define('CONTRATO', "$eqcb12");
define('CONVENIO_DV', "$eqcb13");

class Boleto{
    private $prazo_vencimento = 5;
    private $taxa_boleto = 0.00;

    public function emitir_bb($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO


        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            function Moeda($value){
                return number_format($value, 2, ",", ".");
            };

            function convdata($dataform, $tipo){
                if ($tipo == 0) {
                    $datatrans = explode ("/", $dataform);
                    $data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
                } elseif ($tipo == 1) {
                    $datatrans = explode ("-", $dataform);
                    $data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
                }elseif ($tipo == 2) {
                    $datatrans = explode ("-", $dataform);
                    $data = "$datatrans[1]/$datatrans[2]/$datatrans[0]";
                } elseif ($tipo == 3) {
                    $datatrans = explode ("/", $dataform);
                    $data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
                }

                return $data;
            };

            function diasEntreData($date_ini, $date_end){
                $data_ini = strtotime( convdata(convdata($date_ini,3),2) ); //data inicial '29 de julho de 2003'
                $hoje = convdata($date_end,3);//date("m/d/Y"); // data atual
                $foo = strtotime($hoje); // transforma data atual em segundos (eu acho)
                $dias = ($foo - $data_ini)/86400; //calcula intervalo
                return $dias;
            };

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

        $dadosboleto["nosso_numero"] = $assinatura['id'];
        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "1";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "S";
        $dadosboleto["uso_banco"] = "";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DM";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - BANCO DO BRASIL
        $dadosboleto["agencia"] = AG; // Num da agencia, sem digito
        $dadosboleto["conta"] = AGDG; 	// Num da conta, sem digito

        // DADOS PERSONALIZADOS - BANCO DO BRASIL
        $dadosboleto["convenio"] = CONVENIO;  // Num do conv?nio - REGRA: 6 ou 7 ou 8 d?gitos
        $dadosboleto["contrato"] = CONTRATO; // Num do seu contrato
        $dadosboleto["carteira"] = CARTEIRA;
        $dadosboleto["variacao_carteira"] = "";  // Varia??o da Carteira, com tra?o (opcional)

        $fconvenio = CONVENIO;
        $cnosso = $assinatura['id'];

        // TIPO DO BOLETO
        $dadosboleto["formatacao_convenio"] = "8";
        $dadosboleto["formatacao_nosso_numero"] = "2";

        if(strlen($fconvenio) == 6){
            if(strlen($cnosso) <= 5){
                $cont = 1;
            }elseif(strlen($cnosso) > 5 && strlen($cnosso) < 17){
                $cont = 2;
            }

            $dadosboleto["formatacao_nosso_numero"] = $cont;
        }


        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_bb.php");
        include("boletophp/include/layout_bb.php");
    }


    public function emitir_bradesco($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

        $dadosboleto["nosso_numero"] = $assinatura['id'];
        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "001";
        $dadosboleto["valor_unitario"] = $valor_boleto;
        $dadosboleto["aceite"] = "";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DS";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - Bradesco
        $dadosboleto["agencia"] = AG; // Num da agencia, sem digito
        $dadosboleto["agencia_dv"] = AGDG; // Digito do Num da agencia
        $dadosboleto["conta"] = CONTA; 	// Num da conta, sem digito
        $dadosboleto["conta_dv"] = CONTADG; 	// Digito do Num da conta

        // DADOS PERSONALIZADOS - Bradesco
        $dadosboleto["conta_cedente"] = CONTA; // ContaCedente do Cliente, sem digito (Somente N?meros)
        $dadosboleto["conta_cedente_dv"] = CONTADG; // Digito da ContaCedente do Cliente
        $dadosboleto["carteira"] = CARTEIRA;  // C?digo da Carteira: pode ser 06 ou 03

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_bradesco.php");
        include("boletophp/include/layout_bradesco.php");

    }


    public function emitir_cef($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');


        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        $dadosboleto["nosso_numero1"] = "000"; // tamanho 3
        $dadosboleto["nosso_numero_const1"] = "1"; //constanto 1 , 1=registrada , 2=sem registro
        $dadosboleto["nosso_numero2"] = "000"; // tamanho 3
        $dadosboleto["nosso_numero_const2"] = "4"; //constanto 2 , 4=emitido pelo proprio cliente

        $numero = str_pad($assinatura['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
        $dadosboleto["nosso_numero3"] = $numero;
        $dadosboleto["nosso_numero"] = $assinatura['id'];
        $dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "1";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "N?O";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DM";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //

        // DADOS DA SUA CONTA - CEF
        $dadosboleto["agencia"] = AG; // Num da agencia, sem digito
        $dadosboleto["conta"] = CONTA; 	// Num da conta, sem digito
        $dadosboleto["conta_dv"] = CONTADG; 	// Digito do Num da conta

        // DADOS PERSONALIZADOS - CEF
        $dadosboleto["conta_cedente"] = CONTA;
        $dadosboleto["carteira"] = CARTEIRA;

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_cef_sigcb.php");
        include("boletophp/include/layout_cef.php");
    }

    public function emitir_itau($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

        $dadosboleto["nosso_numero"] = $assinatura['id'];
        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "001";
        $dadosboleto["valor_unitario"] = $valor_boleto;
        $dadosboleto["aceite"] = "SEM";
        $dadosboleto["uso_banco"] = "";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DM";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - ITA?
        $dadosboleto["agencia"] = AG; // Num da agencia, sem digito
        $dadosboleto["conta"] = CONTA;	// Num da conta, sem digito
        $dadosboleto["conta_dv"] = CONTADG; 	// Digito do Num da conta

        // DADOS PERSONALIZADOS - ITA?
        $dadosboleto["carteira"] = CARTEIRA;  // C?digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_itau.php");
        include("boletophp/include/layout_itau.php");
    }

    public function emitir_santander($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

        $dadosboleto["nosso_numero"] = $assinatura['id'];
        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS PERSONALIZADOS - SANTANDER BANESPA
        $dadosboleto["codigo_cliente"] = AG; // C?digo do Cliente (PSK) (Somente 7 digitos)
        $dadosboleto["ponto_venda"] = CONTA; // Ponto de Venda = Agencia
        $dadosboleto["carteira"] = CARTEIRA;  // Cobran?a Simples - SEM Registro
        $dadosboleto["carteira_descricao"] = "COBRAN?A SIMPLES - CSR";  // Descri??o da Carteira

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_santander_banespa.php");
        include("boletophp/include/layout_santander_banespa.php");
    }




    public function emitir_sicoob($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y');
            //$dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.07 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "2ª Via Boleto Atualizado";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');


        if(!function_exists('formata_numdoc'))
        {
            function formata_numdoc($num,$tamanho)
            {
                while(strlen($num)<$tamanho)
                {
                    $num="0".$num;
                }
                return $num;
            }
        }

        $IdDoSeuSistemaAutoIncremento = $assinatura['id'];
        $agencia = AG; // Num da agencia, sem digito
        $conta = CONTA; // Num da conta, sem digito
        $convenio = CONVENIO;
        $convenio_dv = CONVENIO_DV;

        $NossoNumero = formata_numdoc($IdDoSeuSistemaAutoIncremento,7);
        $qtde_nosso_numero = strlen($NossoNumero);
        $sequencia = formata_numdoc($agencia,4).formata_numdoc(str_replace("-","",$convenio.$convenio_dv),10).formata_numdoc($NossoNumero,7);
        $cont=0;
        $calculoDv = '';
        //for($num=0;$num<=strlen($sequencia);$num++)
        for($num=0;$num<=21;$num++)
        {
            $cont++;
            if($cont == 1)
            {
                // constante fixa Sicoob » 3197
                $constante = 3;
            }
            if($cont == 2)
            {
                $constante = 1;
            }
            if($cont == 3)
            {
                $constante = 9;
            }
            if($cont == 4)
            {
                $constante = 7;
                $cont = 0;
            }
            $calculoDv = $calculoDv + (substr($sequencia,$num,1) * $constante);
        }
        $Resto = $calculoDv % 11;
        if($Resto == 0 || $Resto == 1){
            $Dv = 0;
        }else{
            $Dv = 11 - $Resto;
        }
        $dadosboleto["nosso_numero"] = $NossoNumero . $Dv;

        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "N";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DM";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS PERSONALIZADOS - SICOOB
        $dadosboleto["modalidade_cobranca"] = "01";
        $dadosboleto["numero_parcela"] = "001";


        // DADOS DA SUA CONTA - BANCO SICOOB
        $dadosboleto["agencia"] = $agencia; // Num da agencia, sem digito
        $dadosboleto["conta"] = $conta; // Num da conta, sem digito

        // DADOS PERSONALIZADOS - SICOOB
        $dadosboleto["convenio"] = $convenio.$convenio_dv; // 7 digitos
        $dadosboleto["carteira"] = "1";

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_bancoob.php");
        include("boletophp/include/layout_bancoob.php");

    }


    public function emitir_sicredi($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');



        $dadosboleto["nosso_numero"] = $assinatura['id'];

        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "N";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "A";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - SICREDI
        $dadosboleto["agencia"] = AG; 	// Num da agencia (4 digitos), sem Digito Verificador
        $dadosboleto["conta"] = CONTA; 	// Num da conta (5 digitos), sem Digito Verificador
        $dadosboleto["conta_dv"] = CONTADG; 	// Digito Verificador do Num da conta

        // DADOS PERSONALIZADOS - SICREDI
        $dadosboleto["posto"]= CARTEIRA;      // C?digo do posto da cooperativa de cr?dito
        $dadosboleto["byte_idt"]= "2";	  // Byte de identifica??o do cedente do bloqueto
        $dadosboleto["carteira"] = TIPO;   // C?digo da Carteira: A (Simples)

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_sicredi.php");
        include("boletophp/include/layout_sicredi.php");

    }


    public function emitir_hsbc($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');



        $dadosboleto["nosso_numero"] = $assinatura['id'];

        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS PERSONALIZADOS - HSBC
        $dadosboleto["codigo_cedente"] = CONVENIO; // C?digo do Cedente (Somente 7 digitos)
        $dadosboleto["carteira"] = TIPO;  // C?digo da Carteira

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_hsbc.php");
        include("boletophp/include/layout_hsbc.php");

    }



    public function emitir_real($cliente,$assinatura,$tipo){

        $cliente = $cliente;
        $cccs = mysql_query("SELECT * FROM clientes WHERE id = '$cliente'");
        $cliente = mysql_fetch_array($cccs);

        if($tipo == 2) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM boletos WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);
            $valorboleto = $assinatura['valor'];
            $prd = explode("/", date('d/m/Y',strtotime($assinatura['vencimento'])));
            $dia = $prd[0];
            $mes = $prd[1];
            $ano = $prd[2];

        }
        if($tipo == 1) {
            $assinatura = $assinatura;
            $aaas = mysql_query("SELECT * FROM financeiro WHERE id = '$assinatura'");
            $assinatura = mysql_fetch_array($aaas);

            $data_inicial = $assinatura['cadastro'];
            $data_final = $assinatura['vencimento'];
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            $dias = floor($diferenca / (60 * 60 * 24));
            if($dias >= 30) {
                $valorboleto = $assinatura['valor'];
            } else {
                $valorboleto = $assinatura['valor'];
            }

            $plano = $assinatura['plano'];
            $ppps = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
            $plano = mysql_fetch_array($ppps);

            $dia = $assinatura['dia'];
            $mes = $assinatura['mes'];
            $ano = $assinatura['ano'];
            $faturareferencia = $assinatura['nfatura'];
            $demofatura = "Internet $faturareferencia/12 Ano $ano";

        } // FIM TIPO

        $datavencido = $ano."-".$mes."-".$dia;
        if($datavencido < date('Y-m-d')) {

            $dat_venc = $dia."/".$mes."/".$ano;
            $dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
            $valor_doc = $valorboleto;
            $juros = ((0.10 * (diasEntreData($dat_venc,$dat_novo_venc ))));

            if(diasEntreData($dat_venc,$dat_novo_venc)==0)
            {$multa = 0;}
            else
            {$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);

            $valorDocComJuros = $valor_doc + ($juros + $multa);
            $diasatrasados =  diasEntreData($dat_venc,$dat_novo_venc);
            $calcjuros = Moeda($juros);
            $multa = Moeda($multa);
            $novovalor = Moeda($valorDocComJuros);

            $valor_doc = $valor_doc + ($juros + $multa);
            $juros = Moeda($juros);
            $multa = Moeda($multa);
            $datacertavencimento = $dat_novo_venc;
            $valorcorrigido = $novovalor;
            $vec = "- 2? Via Boleto Atualizado ";

        } else {
            $datacertavencimento = $dia."/".$mes."/".$ano;
            $valorcorrigido = $valorboleto;
        }

        $dias_de_prazo_para_pagamento = 5;
        $taxa_boleto = 0.00;
        $data_venc = $datacertavencimento;
        $valor_cobrado = $valorcorrigido;
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');



        $dadosboleto["nosso_numero"] = $assinatura['id'];

        $dadosboleto["numero_documento"] = $assinatura['id'];
        $dadosboleto["data_vencimento"] = $data_venc;
        $dadosboleto["data_documento"] = date("d/m/Y");
        $dadosboleto["data_processamento"] = date("d/m/Y");
        $dadosboleto["valor_boleto"] = $valor_boleto;

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $cliente['nome'];
        $dadosboleto["endereco1"] = $cliente['endereco'];
        $dadosboleto["endereco2"] = $cliente['cidade']." ".$cliente['estado']." CEP ".$cliente['cep'];

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = "$vec $demofatura";
        $dadosboleto["demonstrativo2"] = RECEBER;
        $dadosboleto["demonstrativo3"] = "";
        $dadosboleto["instrucoes1"] = INSTRUCOES1;
        $dadosboleto["instrucoes2"] = INSTRUCOES2;
        $dadosboleto["instrucoes3"] = INSTRUCOES3;
        $dadosboleto["instrucoes4"] = "Emitido pelo sistema MyRouter ERP";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "N";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "";


        // ---------------------- DADOS FIXOS DE CONFIGURA??O DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - REAL
        $dadosboleto["agencia"] = AG; // Num da agencia, sem digito
        $dadosboleto["conta"] = CONTA; 	// Num da conta, sem digito
        $dadosboleto["carteira"] = CARTEIRA;  // C?digo da Carteira

        // SEUS DADOS
        $dadosboleto["identificacao"] = IDENTIFICADOR;
        $dadosboleto["cpf_cnpj"] = CNPJ;
        $dadosboleto["endereco"] = ENDERECO;
        $dadosboleto["cidade_uf"] = CIDADE;
        $dadosboleto["cedente"] = CEDENTE;

        // N?O ALTERAR!
        include("boletophp/include/funcoes_real.php");
        include("boletophp/include/layout_real.php");

    }


}