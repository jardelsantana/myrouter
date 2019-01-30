<?php
define(IPADMIN,  '201.87.240.9');
define(IPTL1SRV, '10.10.6.146');

define(TL1USR, '1');
define(TL1PWD, '33#sysadmin#33');

include 'FiberHome.class.php';

echo "Conectando...\n";
$fh = new FiberHome(IPADMIN, IPTL1SRV, TL1USR, TL1PWD, false);

echo "Listando...\n";
$onus = $fh->ONUList();

//echo "Obtendo status...\n";
//$fh->ONUStates($onus);

echo "Obtendo informações extras...\n";
$fh->ONUInfos($onus);


echo '<pre>';
var_dump($onus);
echo '</pre>';