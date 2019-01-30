
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


$empresa1 = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
$Cempresa = mysqli_fetch_array($empresa1);
$dias_bloc = $Cempresa['dias_bloc'];


$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco


$sxd = $mysqli->query("select * from financeiro  where  date_add(vencimento, interval '$dias_bloc' day) < now() and   situacao = 'N'");
while($daa = mysqli_fetch_array($sxd)){

//echo '<pre>';
//print_r($daa);

$verificazeros = mysqli_num_rows($sxd);

if($verificazeros > 0) {

$idprd = $daa['id'];
$crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
$crud->atualizar("situacao='B'", "id='$idprd'");


$codass = $daa['pedido'];
$ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
$cliente = mysqli_fetch_array($ccss);

$ccvbv = $cliente['cliente'];
$ccsscv = $mysqli->query("SELECT * FROM clientes WHERE id = '$ccvbv'");
$vcsms = mysqli_fetch_array($ccsscv);


$plano = $cliente['plano'];
$ppss = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
$plano = mysqli_fetch_array($ppss);

$servidor = $plano['servidor'];
$ssrv = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
$servidor = mysqli_fetch_array($ssrv);


  //  echo '<pre>';
  //  echo 'entro no while';

if($cliente['autobloqueio'] == 'S') {

    echo 'block  ';
    echo $cliente['login'];

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

    }
    /* --------------------------------------------------------------------------------------------------- */
}
} 

?>