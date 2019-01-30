<?php
session_start();
ob_start();

require_once 'vendor/autoload.php';
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';
require_once 'config/mikrotik.class.php';

$idpuser = $logado['nome']; // pegar nome do login da sessão

ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set("track_errors", "1");
header("Content-Type: text/html; charset=ISO-8859-1", true);

$cnabFactory = new Cnab\Factory();

// Homologado Para CEF
// Para Modificações Consulte a documentação do banco
// Padrão 240
$con = new conexao();
 // instancia classe de conxao
$con->connect();
 // abre conexao com o banco

$_UP['extensoes'] = array('ret', 'RET');

$tiporet = $_FILES['arquivo']['type'];

$extensao = strtolower(@end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
    header("Location: index.php?app=Retorno&reg=2");
} 
else {
    
    $upfile = $_FILES['arquivo']['tmp_name'];

    $arquivo = $cnabFactory->createRetorno($upfile);

    function fndata($string) {
        $string = str_replace('01', '1', $string);
        $string = str_replace('02', '2', $string);
        $string = str_replace('03', '3', $string);
        $string = str_replace('04', '4', $string);
        $string = str_replace('05', '5', $string);
        $string = str_replace('06', '6', $string);
        $string = str_replace('07', '7', $string);
        $string = str_replace('08', '8', $string);
        $string = str_replace('09', '9', $string);
        return $string;
    }
    
    foreach($arquivo->listDetalhes() as $detalhe) {
        $t_cod_banco = $arquivo->getCodigoBanco();
        $t_id_titulo_banco = $detalhe->getNossoNumero();
        $t_cod_carteira = $detalhe->getCarteira();
        $t_num_doc_cob = $detalhe->getNumeroDocumento();
        $t_v_nominal = $detalhe->getValorTitulo();
        $t_cod_ag_receb = $detalhe->getAgenciaCobradora();
        $t_dv_ag_receb = $detalhe->getAgenciaCobradoraDac();
        $t_id_titulo_empresa = $detalhe->getNumeroDocumento();
        $u_n_sequencial = $detalhe->getNumeroSequencial();
        $u_juros_multa = $detalhe->getValorMoraMulta();
        $u_desconto = $detalhe->getValorDesconto();
        $u_abatimento = $detalhe->getValorAbatimento();
        $u_iof = $detalhe->getValorIOF();
        $u_v_pago = $detalhe->getValorRecebido();
        $u_v_creditos = $detalhe->getValorOutrosCreditos();
        $t_dt_vencimento = $detalhe->getDataVencimento() ? $detalhe->getDataVencimento()->format('Y-m-d') : '';
        $u_dt_efetivacao = $detalhe->getDataOcorrencia() ? $detalhe->getDataOcorrencia()->format('Y-m-d') : '';
        $u_dt_ocorencia = $detalhe->getDataOcorrencia() ? $detalhe->getDataOcorrencia()->format('Y-m-d') : '';

        echo "<br />\n<br />\n<br />\n";
        echo "Código: ".$detalhe->getCodigo()." - ".$detalhe->getCodigoNome()."<br />\n";
        echo "Número Documento: ".$t_id_titulo_empresa."<br />\n";
        echo "Nosso Número: ".$t_id_titulo_banco."<br />\n";
        echo "Carteira: ".$t_cod_carteira."<br />\n";
        echo "Valor Nominal: ".$t_v_nominal."<br />\n";
        echo "Valor Recebido: ".$u_v_pago."<br />\n";
        echo "Data de vencimento: ". ($detalhe->getDataVencimento() ? $detalhe->getDataVencimento()->format('Y-m-d') : '(sem data)')."<br />\n";

     //if ($u_v_pago > 0) {
         if ($detalhe->getCodigo() == 6) {
            $data_agora = date('Y-m-d');
            $hora_agora = date('H:i:s');
            
            $juros = number_format($u_juros_multa, 2, '.', '');
            $codigo = $t_id_titulo_banco ?: $t_id_titulo_banco;
            $codigo = $t_id_titulo_empresa ?: $t_id_titulo_banco;
            $vpago = number_format($u_v_pago, 2, '.', '');
           
            $consultas = $mysqli->query("SELECT * FROM retornos WHERE codigo = '$codigo'");
            $campo = mysqli_fetch_array($consultas);
            $inteiro = (int)$codigo;

            $q = $mysqli->query("SELECT * FROM financeiro WHERE id ='$inteiro'");
            $financeiroboleto = mysqli_fetch_array($q);
            //var_dump($financeiroboleto);

            if($financeiroboleto && !$t_dt_vencimento)
                $t_dt_vencimento = $financeiroboleto['vencimento'];


            if ($inteiro == $campo['codigo']) {
            } 
            else {
                $crud = new crud('retornos');
                $crud->inserir("juros,codigo,valor,dataefetivacao,dataocorrencia,dataprocessado,horaprocessado,datavencimento,admin", "'$juros','$inteiro','$vpago','$u_dt_efetivacao','$u_dt_ocorencia','$data_agora','$hora_agora','$t_dt_vencimento','$idpuser'");
                
                $query1 = $mysqli->query("SELECT MAX(ID) as id FROM retornos");
                $dados1 = mysqli_fetch_assoc($query1);
                $ultimoid = $dados1['id'];
                
                $crud = new crud('financeiro');
                 // instancia classe com as operações crud, passando o nome da tabela como parametro
                $crud->atualizar("situacao='P',vencimento_fn='$t_dt_vencimento',pagamento_fn='$u_dt_efetivacao',retorno_fn='$ultimoid',admin='$idpuser'", "id='$inteiro'");
                
                $crud = new crud('boletos');
                 // instancia classe com as operações crud, passando o nome da tabela como parametro
                $crud->atualizar("status='P'", "boleto='$inteiro'");
                
                $diannc = date('d');
                $mesnnc = date('m');
                $fndia = fndata($diannc);
                $fnmes = fndata($mesnnc);
                $fnano = date('Y');
                $pedboleto = $inteiro;
                
                $lcm = $mysqli->query("SELECT * FROM financeiro WHERE id = '$pedboleto'");

                $lanc01 = mysqli_fetch_assoc($lcm);
                $login_lan = $lanc01['login'];

                $row = mysqli_num_rows($lcm);
                if ($row > 0) {
                    $crud = new crud('lc_movimento');
                     // tabela como parametro
                    $crud->inserir("tipo,dia,mes,ano,cat,descricao,valor,pedido,admin", "'1','$fndia','$fnmes','$fnano','1','Retorno de Mensalidade - Fatura:# $pedboleto','$vpago','$inteiro','$idpuser'");
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
                    if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {
                        
                        $username = $cliente['login'];
                        
                        $API->write('/ip/hotspot/active/print', false);
                        $API->write('?=user='.$username.'');
                        $res = $API->read($res);
                        
                        echo $user_login = $res['1'];
                        
                        if (empty($user_login)) {
                        } 
                        else {
                            $API->write('/ip/hotspot/active/remove', false);
                            $API->write($user_login);
                            $res = $API->read($res);
                        }
                        
                        $API->disconnect();
                    }
                     // FIM
                    
                }
                
                if ($cliente['tipo'] == 'PPPoE') {
                    $API = new routeros_api();
                    $API->debug = false;
                    if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {
                        
                        $username = $cliente['login'];
                        $API->write('/ppp/active/print', false);
                        $API->write('?=name='.$username.'');
                        $res = $API->read($res);
                        
                        echo $user_login = $res['1'];
                        
                        if (empty($user_login)) {
                        } 
                        else {
                            $API->write('/ppp/active/remove', false);
                            $API->write($user_login);
                            $res = $API->read($res);
                        }
                        
                        $API->disconnect();
                    }
                     // FIM
                    
                }
                
                if ($cliente['tipo'] == 'IPARP') {
                    $API = new routeros_api();
                    $API->debug = false;
                    if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {
                        $API->write('/ip/arp/enable', false);
                        $API->write('=.id='.$cliente['ip'].'');
                        $ARRAY = $API->read();
                        $API->disconnect();
                    }
                     // FIM
                    
                }
            }
        }
    }

    header("Location: index.php?app=Retorno&reg=1");
}
?>
