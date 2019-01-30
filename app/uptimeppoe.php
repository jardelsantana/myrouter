<?php
require('../config/mikrotik.class.php');

$ip  = base64_decode($_GET['ip']);
$login  = base64_decode($_GET['login']);
$senha  = base64_decode($_GET['senha']);

$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$ip.'', ''.$login.'', ''.$senha.'')) {

$ARRAY = $API->comm("/ppp/active/print");

$first = $ARRAY['0'];
?>
<?php echo $first['uptime']; ?>

<?php } ?>



