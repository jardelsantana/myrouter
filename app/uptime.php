<?php


$router = base64_decode($_GET["ip"]);
$username = base64_decode($_GET["login"]);
$password = base64_decode($_GET["senha"]);

require_once '../config/librouteros/RouterOS.php';

$mikrotik = new Lib_RouterOS();
$mikrotik->setDebug(false);
    
    		  // NOVA API
    		  $comando = '/system/resource/print';
    		  $args    = array('.proplist' => 'cpu,cpu-frequency,cpu-load,uptime,cpu-count');
    
    		  $mikrotik = new Lib_RouterOS();
    		  $mikrotik->setDebug(false);
    		  try {
    		  $mikrotik->connect($router);
    		  $mikrotik->login($username, $password);
    		  $mikrotik->send($comando, $args);
    		  $response = $mikrotik->read();
    		  
    		  $first = $response['0'];
    		  
    		  } catch (Exception $ex) {
    		  // echo "Debug: " . $ex->getMessage() . "\n";
    		  }
    		  // FIM API

		  ?>

		  <?php echo $first['uptime']; ?>
		  <br>
CPU: <?php echo $first['cpu-load'] . "%"; ?>
<?php if($first['cpu-load'] >= '50') { echo '<span class="label label-danger">DANGER</span>'; } else { echo '<span class="label label-success">BAIXO</span>'; } ?>
<br>
<?php echo $first['cpu-frequency'] . " Mhz " . $first['cpu-count'] . " core(s) "; ?>



