<?php
require('../config/mikrotik.class.php');
$API = new routeros_api();
$API->debug = false;

$ip =  base64_decode($_GET['ip']);
$login = base64_decode($_GET['login']);
$senha = base64_decode($_GET['senha']);
$ping = base64_decode($_GET['ping']);

if ($API->connect(''.$ip.'', ''.$login.'', ''.$senha.'')) {

$ipping = $ping;

$API->write('/ping',false);
$API->write("=address=$ipping",false);
$API->write('=count=3',false);
$API->write('=interval=1');
$ARRAY= $API->read();

$first = $ARRAY['0'];
?>
<span style="font-size:12px;font-family:verdana;">
<b>HOST:</b> <?php echo $first['host']; ?> | <b>REPLAY SIZE:</b> <?php echo $first['size']; ?> <br>
<b>TTL:</b> <?php echo $first['ttl']; ?> <br>
<b>TIME:</b> <?php echo $first['time']; ?> <br>
<b>ENVIADO:</b> <?php echo $first['sent']; ?> <br>
<b>RECEBIDO:</b> <?php echo $first['received']; ?> <br>
<b>PACOTES PERDIDOS:</b> <?php echo $first['packet-loss']; ?><br>
</span>
<?php 
//print_r($ARRAY);
$API->disconnect();

}

?>
