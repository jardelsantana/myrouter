
<?php

// Otimizado.
// Trava.

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );


require_once 'conexao.class.php';
require_once 'conexao.php';
require_once 'crud.class.php';
require_once 'mikrotik.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco

$diavc = date('d');
$mesvc = date('m');
$anovc = date('Y');

$prddata = mysql_query("SELECT * FROM financeiro WHERE situacao = 'N' AND mes = '$mesvc' AND ano = '$anovc'");
$opdata = mysql_fetch_array($prddata);

//echo '<pre>';
//print_r($opdata);

//$prddata = mysql_query("update financeiro set  situacao = 'B' where  date_add(vencimento, interval 5 day) < now() and   situacao = 'N'");
//$opdata = mysql_fetch_array($prddata);

$datas = $opdata['vencimento']; 
$credata = date('Y-m-d');
$vendata = date("Y-m-d", strtotime("+5 days", strtotime($datas)));  // 10 dias corte

if($vendata < $credata) {
 //   echo 'entro no if';
$sxd = mysql_query("SELECT * FROM financeiro WHERE situacao = 'N' AND (vencimento < '$diavc') AND mes = '$mesvc' AND ano = '$anovc'");
while($daa = mysql_fetch_array($sxd)){ 

$verificazeros = mysql_num_rows($sxd);

if($verificazeros > 0) {
$data = date("Y-m-d");

$idprd = $daa['id'];
$crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
$crud->atualizar("situacao='B'", "id='$idprd'"); 

$codass = $daa['pedido'];
$ccss = mysql_query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
$cliente = mysql_fetch_array($ccss);

$ccvbv = $cliente['cliente'];
$ccsscv = mysql_query("SELECT * FROM clientes WHERE id = '$ccvbv'");
$vcsms = mysql_fetch_array($ccsscv);

$plano = $cliente['plano'];
$ppss = mysql_query("SELECT * FROM planos WHERE id = '$plano'");
$plano = mysql_fetch_array($ppss);

$servidor = $plano['servidor'];
$ssrv = mysql_query("SELECT * FROM servidores WHERE id = '$servidor'");
$servidor = mysql_fetch_array($ssrv);




/* --------------------------------------------------------------------------------------------------- */



if($cliente['autobloqueio'] == 'S') {

if($cliente['tipo'] == 'HOTSPOT') { 
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
{

    $username = $cliente['login'];

    $API->write('/ip/hotspot/active/print', false);
    $API->write('?=user='.$username.'');
    $res = $API->read($res);


    echo $user_login = $res['1'];

    if(empty($user_login)){

    }else{
        $API->write('/ip/hotspot/active/remove', false);
        $API->write($user_login);
        $res = $API->read($res);
    }

//$API->write('/ip/hotspot/user/disable',false);
//$API->write('=.id='.$cliente['login'].'' );
//$ARRAY = $API->read();
$API->disconnect();
} // FIM
}

if($cliente['tipo'] == 'PPPoE') { 
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
{
    $username = $cliente['login'];
    $API->write('/ppp/active/print',false);
    $API->write('?=name='.$username.'');
    $res = $API->read($res);


    echo $user_login = $res['1'];

    if(empty($user_login)){

    }else{
        $API->write('/ppp/active/remove',false);
        $API->write($user_login);
        $res = $API->read($res);
    }

//$API->write('/ppp/secret/disable',false);
//$API->write('=.id='.$cliente['login'].'' );
//$ARRAY = $API->read();
$API->disconnect();
} // FIM
}

if($cliente['tipo'] == 'IPARP') { 
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
{
$API->write('/ip/arp/disable',false);
$API->write('=.id='.$cliente['ip'].'' );
$ARRAY = $API->read();
$API->disconnect();
} // FIM
}

} // FIM AUTO BLOQUEIO
/* --------------------------------------------------------------------------------------------------- */
} // Verifica 0 Registros
} 
}
?>