<?php
session_start();
ob_start();
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1"); 
header("Content-Type: text/html; charset=ISO-8859-1", true);
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    // Homologado Para CEF 
    // Para Modificações Consulte a documentação do banco
    // Padrão 240
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco

$_UP['extensoes'] = array('ret', 'RET');

$tiporet = $_FILES['arquivo']['type'];

$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
 header("Location: index.php?app=Retorno&reg=2");
} else { 


$upfile = $_FILES['arquivo']['tmp_name'];
$file_handle = fopen("$upfile", "r");

function fndata($string)
    {
    $string = str_replace('01','1',$string);
    $string = str_replace('02','2',$string);
    $string = str_replace('03','3',$string);
    $string = str_replace('04','4',$string);
    $string = str_replace('05','5',$string);
    $string = str_replace('06','6',$string);
    $string = str_replace('07','7',$string);
    $string = str_replace('08','8',$string);
    $string = str_replace('09','9',$string);
  	  return $string;
  
  	  } 

$i = 0;
while (!feof($file_handle)) {
$i++;
$linha = fgets($file_handle);

$t_u_segmento = substr($linha,13,1);   //  Segmento T ou U
$t_tipo_reg = substr($linha,7,1);   //  Tipo de Registro
if($t_u_segmento == 'T'){
$t_cod_banco = substr($linha,0,3);   //  Código do banco na compensação
$t_lote = substr($linha,3,4);   //  Lote de serviço - Número seqüencial para identificar um lote de serviço.
$t_n_sequencial = substr($linha,8,5);   //  Nº Sequencial do registro no lote
$t_cod_seg = substr($linha,15,2);   //  Cód. Segmento do registro detalhe
$t_cod_conv_banco = substr($linha,23,6);   //  Código do convênio no banco - Código fornecido pela CAIXA.
$t_n_banco_sac = substr($linha,32,3);   //  Numero do banco de sacados
$t_mod_nosso_n = substr($linha,39,2);   //  Modalidade nosso número
$t_id_titulo_banco = substr($linha,41,15);   //  Identificação do titulo no banco - Número adotado pelo Banco Cedente
$t_cod_carteira = substr($linha,57,1);   //  Código da carteira - Código adotado pela FEBRABAN
$t_num_doc_cob = substr($linha,58,11);   //  Número do documento de cobrança - Número utilizado e controlado pelo Cliente.

$t_dt_vencimento = substr(substr($linha,73,8),4,4).'-'.substr(substr($linha,73,8),2,2).'-'.substr(substr($linha,73,8),0,2);  

$t_v_nominal = substr($linha,81,13);   //  Valor nominal do titulo - Valor original do Título. 
$t_cod_banco2 = substr($linha,96,3);   //  Código do banco
$t_cod_ag_receb = substr($linha,99,5);   //  Codigo da agencia cobr/receb
$t_dv_ag_receb = substr($linha,104,1);   //  Dígito verificador da agencia cobr/receb
$t_id_titulo_empresa = substr($linha,105,25);   //  identificação do título na empresa 
$t_cod_moeda = substr($linha,130,2);   //  Código da moeda
$t_tip_inscricao = substr($linha,132,1);   //  0=Não informado, 1=CPF, 2=CGC / CNPJ, 9=Outros.
$t_num_inscricao = substr($linha,133,15);   //  Número de inscrição CPF ou CNPJ
$t_nome = substr($linha,148,40);   //  Nome - Nome que identifica a entidade, pessoa física ou jurídica.
$t_v_tarifa_custas = substr($linha,198,13);   //  Valor da tarifa/custas
$t_id_rejeicoes = substr($linha,213,10);   //  Identificação para rejeições, tarifas, custas, liquidação e baixas.

}
if($t_u_segmento == 'U'){
$t_id_titulo_banco;
$u_cod_banco = substr($linha,0,3);   //  Código do banco na compensação
$u_lote = substr($linha,3,4);   //  Lote de serviço - Número seqüencial para identificar um lote de serviço.
$u_tipo_reg = substr($linha,7,1);   //  0=Header de Arquivo, 1=Header de Lote, 3=Detalhe, 5=Trailer de Lote, 9=Trailer
$u_n_sequencial = substr($linha,8,5);   //  Nº Sequencial do registro no lote
$u_cod_seg = substr($linha,15,2);   //  Cód. Segmento do registro detalhe
$u_juros_multa = substr($linha,17,15);   //  Jurus / Multa / Encargos - Valor dos acréscimos efetuados no título de cobrança
$u_desconto = substr($linha,32,15);   //  Valor do desconto concedido - Valor dos descontos efetuados no título de cobrança
$u_abatimento = substr($linha,47,15);   //  Valor do abat. concedido/cancel. - Valor dos abatimentos efetuados ou cancelados
$u_iof = substr($linha,62,15);   //  Valor do IOF recolhido - Valor do IOF - Imposto sobre Operações Financeiras - recolhido
$u_v_pago = substr($linha,77,15);   //  Valor pago pelo sacado - Valor do pagamento efetuado pelo Sacado referente ao título
$u_v_liquido = substr($linha,92,15);   //  Valor liquido a ser creditado - Valor efetivo a ser creditado referente ao Título
$u_v_despesas = substr($linha,107,15);   //  Valor de outras despesas - Valor de despesas referente a Custas Cartorárias
$u_v_creditos = substr($linha,122,15);   //  Valor de outros creditos - Valor efetivo de créditos referente ao título
$u_dt_ocorencia = substr(substr($linha,137,8),4,4).'-'.substr(substr($linha,137,8),2,2).'-'.substr(substr($linha,137,8),0,2);
$u_dt_efetivacao = substr(substr($linha,145,8),4,4).'-'.substr(substr($linha,145,8),2,2).'-'.substr(substr($linha,145,8),0,2);   //  Data da efetivação do credito - Data de efetivação do crédito
$u_dt_debito = substr($linha,157,8);   //  Data do débito da tarifa
$u_cod_sacado = substr($linha,167,15);   //  Código do sacado no banco
$u_cod_banco_comp = substr($linha,210,3);   //  Cód. Banco Correspondente compens - Código fornecido pelo Banco Central
$u_nn_banco = substr($linha,213,20);   //  Nosso Nº banco correspondente - Código fornecido pelo Banco Correspondente
 
$u_juros_multa = substr($u_juros_multa,0,13).'.'.substr($u_juros_multa,13,2);
$u_desconto = substr($u_desconto,0,13).'.'.substr($u_desconto,13,2);
$u_abatimento = substr($u_abatimento,0,13).'.'.substr($u_abatimento,13,2);
$u_iof = substr($u_iof,0,13).'.'.substr($u_iof,13,2);
$u_v_pago = substr($u_v_pago,0,13).'.'.substr($u_v_pago,13,2);
$u_v_liquido = substr($u_v_liquido,0,13).'.'.substr($u_v_liquido,13,2);
$u_v_despesas = substr($u_v_despesas,0,13).'.'.substr($u_v_despesas,13,2);
$u_v_creditos = substr($u_v_creditos,0,13).'.'.substr($u_v_creditos,13,2);
 
$data_agora = date('Y-m-d');
$hora_agora = date('H:i:s');

$juros = number_format($u_juros_multa,2,'.','');
$codigo = $t_id_titulo_banco;
$vpago = number_format($u_v_pago,2,'.','');

$consultas = $mysqli->query("SELECT * FROM retornos WHERE codigo = '$codigo'");
$campo = mysqli_fetch_array($consultas);
$inteiro = (int)$codigo;
if($inteiro == $campo['codigo']) {


} else {

    $crud = new crud('retornos');
    $crud->inserir("juros,codigo,valor,dataefetivacao,dataocorrencia,dataprocessado,horaprocessado,datavencimento", "'$juros','$inteiro','$vpago','$u_dt_efetivacao','$u_dt_ocorencia','$data_agora','$hora_agora','$t_dt_vencimento'");

    $query1 = $mysqli->query("SELECT MAX(ID) as id FROM retornos");
    $dados1 = mysqli_fetch_assoc($query1);
    $ultimoid = $dados1['id'];

    $crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("situacao='P',vencimento_fn='$t_dt_vencimento',pagamento_fn='$u_dt_efetivacao',retorno_fn='$ultimoid'", "id='$inteiro'");

    $crud = new crud('boletos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("status='P'", "boleto='$inteiro'");


    $diannc = date('d');
    $mesnnc = date('m');
    $fndia = fndata($diannc);
    $fnmes = fndata($mesnnc);
    $fnano = date('Y');
    $pedboleto = $inteiro;


    $lcm = $mysqli->query("SELECT * FROM financeiro WHERE id = '$pedboleto'");
    $row = mysqli_num_rows($lcm);
    if ($row > 0) {
        $crud = new crud('lc_movimento');  // tabela como parametro
        $crud->inserir("tipo,dia,mes,ano,cat,descricao,valor,pedido", "'1','$fndia','$fnmes','$fnano','1','Recebimento de Mensalidade - Fatura:# $pedboleto','$vpago','$inteiro'");
    }


        $derf = $mysqli->query("SELECT * FROM financeiro WHERE id = '$inteiro'");
        $erts = mysqli_fetch_array($derf);

        $erts = $erts['pedido'];
        $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$erts'");
        $cliente = mysqli_fetch_array($ccss);

        $idassn = $cliente['id'];
        $crud = new crud('assinaturas');
        $crud->atualizar("status='S'", "id='$idassn'");


        $plano = $cliente['plano'];
        $ppss = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
        $plano = mysqli_fetch_array($ppss);

        $servidor = $plano['servidor'];
        $ssrv = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
        $servidor = mysqli_fetch_array($ssrv);

        if ($cliente['tipo'] == 'HOTSPOT') {
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect('' . $servidor['ip'] . '', '' . $servidor['login'] . '', '' . $servidor['senha'] . '')) {

                $username = $cliente['login'];

                $API->write('/ip/hotspot/active/print', false);
                $API->write('?=user=' . $username . '');
                $res = $API->read($res);


                echo $user_login = $res['1'];

                if (empty($user_login)) {

                } else {
                    $API->write('/ip/hotspot/active/remove', false);
                    $API->write($user_login);
                    $res = $API->read($res);
                }

                $API->disconnect();
            } // FIM
        }

        if ($cliente['tipo'] == 'PPPoE') {
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect('' . $servidor['ip'] . '', '' . $servidor['login'] . '', '' . $servidor['senha'] . '')) {

                $username = $cliente['login'];
                $API->write('/ppp/active/print', false);
                $API->write('?=name=' . $username . '');
                $res = $API->read($res);


                echo $user_login = $res['1'];

                if (empty($user_login)) {

                } else {
                    $API->write('/ppp/active/remove', false);
                    $API->write($user_login);
                    $res = $API->read($res);
                }

                $API->disconnect();
            } // FIM
        }

        if ($cliente['tipo'] == 'IPARP') {
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect('' . $servidor['ip'] . '', '' . $servidor['login'] . '', '' . $servidor['senha'] . '')) {
                $API->write('/ip/arp/enable', false);
                $API->write('=.id=' . $cliente['ip'] . '');
                $ARRAY = $API->read();
                $API->disconnect();
            } // FIM
        }


    }
}
}


fclose($file_handle);

 header("Location: index.php?app=Retorno&reg=1");
 
 }
?>