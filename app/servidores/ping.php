<?php
require('../../config/mikrotik.class.php');
require('../../config/conexao.class.php');

$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$_GET['ip'].'', ''.$_GET['login'].'', ''.$_GET['senha'].'')) {

$ipping = "1.1.1.1";

$API->write('/ping',false);
$API->write("=address=$ipping",false);
$API->write('=count=3',false);
$API->write('=interval=1');

$ARRAY= $API->read();
print_r($ARRAY);
$API->disconnect();

}

?>
