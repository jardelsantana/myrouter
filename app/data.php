<?php 
require_once('../config/api_mt_include.php');

$ip = base64_decode($_GET['ip']);
$user = base64_decode($_GET['login']);
$password  = base64_decode($_GET['senha']);
$interface = base64_decode($_GET['interface']);
$api_porta = 8728;

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $password, $api_porta )) {
		$rows = array(); $rows2 = array();
		   $API->write("/interface/monitor-traffic",false);
		   $API->write("=interface=$interface",false);
		   $API->write("=once=",true);
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);
			if(count($ARRAY)>0){
				$rx = $ARRAY[0]["rx-bits-per-second"];
				$tx = $ARRAY[0]["tx-bits-per-second"];
				$rows['name'] = 'Tx';
				$rows['data'][] = $tx;
				$rows2['name'] = 'Rx';
				$rows2['data'][] = $rx;
			}else{  
				echo $ARRAY['!trap'][0]['message'];	 
			} 
	}else{
		echo "<font color='#ff0000'>Falha com a conexão de dados do Mikrotik</font>";
	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
