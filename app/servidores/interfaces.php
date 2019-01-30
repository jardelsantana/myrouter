<?php
$idmk = base64_decode($_GET['id']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);


?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li class="active">Interface</li>
          </ul>
        </div>
        
        <?php if($permissao['mk5'] == S) { ?>
        
        <div class="page-header">
          <h1>Interfaces<small><?php echo $mk['servidor']; ?></small></h1>
        </div>
               
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Tabela de Interfaces </h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th width="130">Interface</th>
                      <th>Tipo</th>
                      <th width="80">Monitor</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$mk['ip'].'', ''.$mk['login'].'', ''.$mk['senha'].'')) {
$ARRAY = $API->comm("/interface/print");
$ii = 0;
for ($i = 0; $i < count($ARRAY); ++$i)
{
$first = $ARRAY[$i];
?>
		     <tr>
              <td><?php

                  if ($first['type'] == 'pppoe-in') {

                      $ARRAY2 = $API->comm("/interface/pppoe-server/print");
                      echo $ARRAY2[$ii]['user'];

                       $ii++;
                  }else{

                      echo $first['name'];
                  }


                  ?></td>
              <td>
              <?php if ($first['type'] == 'ether') { ?> <span class="label label-info">Ethernet </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'eoip-tunnel') { ?> <span class="label label-info">EoIP Tunnel </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ipip') { ?> <span class="label label-info">IP Tunnel </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'gre-tunnel') { ?> <span class="label label-info">GRE </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'vlan') { ?> <span class="label label-info">Rede Local Virtual </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'vrrp') { ?> <span class="label label-info">VRRP </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'bonding') { ?> <span class="label label-success">Bonding </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'bridge') { ?> <span class="label label-success">Bridge </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'mesh') { ?> <span class="label label-success">AP Mesh Router </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'sit') { ?> <span class="label label-warning">IPv6 Tunnel via 6to4 </span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ipipv6-tunnel') { ?> <span class="label label-warning">IPIPv6 Tunnel</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'eoipv6-tunnel') { ?> <span class="label label-warning">EoIPv6 Tunnel</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'gre6-tunnel') { ?> <span class="label label-warning">GRE6 Tunnel</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'tap') { ?> <span class="label label-danger">Virtual Ethernet</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'vpls') { ?> <span class="label label-danger">VPLS</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'traffic-eng') { ?> <span class="label label-danger">Traffic Eng Interface</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ppp-in') { ?> <span class="label label-info">PPP Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ppp-out') { ?> <span class="label label-info">PPP Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'pptp-in') { ?> <span class="label label-primary">PPTP Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'pptp-out') { ?> <span class="label label-primary">PPTP Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'sstp-in') { ?> <span class="label label-primary">SSTP Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'sstp-out') { ?> <span class="label label-primary">SSTP Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'l2tp-in') { ?> <span class="label label-primary">L2TP Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'l2tp-out') { ?> <span class="label label-primary">L2TP Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ovpn-in') { ?> <span class="label label-primary">OVPN Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'ovpn-out') { ?> <span class="label label-primary">OVPN Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'pppoe-in') { ?> <span class="label label-info">PPPoE Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'pppoe-out') { ?> <span class="label label-info">PPPoE Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'isdn-in') { ?> <span class="label label-info">ISDN Server</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'isdn-out') { ?> <span class="label label-info">ISDN Client</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'wlan') { ?> <span class="label label-success">Virtual AP</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'wds') { ?> <span class="label label-info">WDS</span>
		      <?php } ?>
		      <?php if ($first['type'] == 'nstreme') { ?> <span class="label label-info">Nstreme Dual</span>
		      <?php } ?>

		      
		      
		      </td>
                      <td><a href="index.php?app=Monitor&irf=<?php echo base64_encode($first['name']); ?>&id=<?php echo base64_encode($mk['id']); ?>" class="btn btn-primary">Monitor</a></td>
                    </tr>
<?php 
}
   $API->disconnect();
}

?>     
                    
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Interface</th>
                      <th>Tipo</th>
                      <th>Monitor</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        	
          </div>
        </div> 
      </div>
      
      <?php } else { ?>
      	    
      	    <div class="page-header">
            <h1>Permissão <small>Negada!</small></h1>  
            </div>
        
            <div class="row" id="powerwidgets">
            <div class="col-md-12 bootstrap-grid">
            
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	    <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Você não possui permissão para esse modulo. </div>
            
            </div></div>
          <?php } ?>