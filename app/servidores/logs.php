<?php
$idmk = base64_decode($_GET['id']);
$conexaomk = $mysqli->query("SELECT * FROM servidores WHERE id = '$idmk'");
$mk = mysqli_fetch_array($conexaomk);


?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li class="active">Logs do Mikrotik</li>
          </ul>
        </div>
        
        <?php if($permissao['mk6'] == S) { ?>
        
        <div class="page-header">
          <h1>Logs Servidor<small><?php echo $mk['servidor']; ?></small></h1>
        </div>
               
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Tabela de Logs </h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Timer</th>
                      <th>Ação</th>
                      <th>Política</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$API = new routeros_api();
$API->debug = false;
if ($API->connect(''.$mk['ip'].'', ''.$mk['login'].'', ''.$mk['senha'].'')) {
$ARRAY = $API->comm("/system/history/print");


for ($i = 0; $i < count($ARRAY); ++$i)
{
$first = $ARRAY[$i];
?>
		     <tr>
                     <td><?php echo $first['by']; ?></td>
                      <td><?php echo $first['time']; ?></td>
                      <td><?php echo $first['action']; ?></td>
                      <td><?php echo $first['policy']; ?></td>
                    </tr>
<?php 
//print_r($ARRAY);
}
   $API->disconnect();
}

?>     
                    
                  </tbody>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Timer</th>
                      <th>Ação</th>
                      <th>Política</th>
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