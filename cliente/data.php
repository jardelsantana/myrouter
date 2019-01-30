<?php

require_once('../config/api_mt_include.php');

$ipRouteros = $_GET["nasipaddress"];
$Username="edielson";
$Pass="33#@myrouter@#33";
$api_puerto=8728;
$interface = $_GET["interface"]; //"<pppoe-nombreusuario>";

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
		$rows = array(); $rows2 = array();	
		   $API->write("/interface/monitor-traffic",false);
		   $API->write("=interface=".'<pppoe-'.$interface.">",false);
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
		echo "<font color='#ff0000'>La conexion ha fallado. Verifique si el Api esta activo.</font>";
	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
