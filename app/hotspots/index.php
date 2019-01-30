
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Hotspots</li>
          </ul>
        </div>
        
        <?php if($permissao['cu1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Hotspots cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Hotspots alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Hotspots excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Hotspots</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget blue" id="" data-widget-editbutton="false">
            
              <header>
                <h2>Gerenciar<small>Hotspots</small></h2>
              </header>
              
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Cupom</th>
                      <th>UP</th>
                      <th>DOWN</th>
                      <th>Periodo</th>
                      <th width="50">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $consultas = $mysqli->query("SELECT * FROM hotspots WHERE status = 'S'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $row = mysql_num_rows($consultas);  
		  
		  ?>
		  <tr>
                      <td><?php echo $campo['login']; ?></td>
                      <td><?php echo $campo['senha']; ?></td>
                      <td><?php echo $campo['comentario']; ?></td>
                      <td><?php if ($campo['bytesin'] == "0") { ?>
		ILIMITADO
		<?php } else { ?><?php echo $campo['bytesin']/1024/1024/1024; ?><?php } ?> GB</td>
		<td><?php if ($campo['bytesout'] == "0") { ?>
		ILIMITADO
		<?php } else { ?><?php echo $campo['bytesout']/1024/1024/1024; ?><?php } ?> GB</td>
                      <td><?php 
                      $segundos = $campo['uptime'];
		      echo $uptimdata = gmdate("H:i:s", $segundos);
		  
		  ?></td>
                      <td> 
		      <a href="imprimir-cupom.php" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Imprimir" target=_blank><i class="fa fa-print"></i></a>&nbsp;
              <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroHotspot&id=<?php echo base64_encode($campo['id'])?>&login=<?php echo base64_encode($campo['login']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Cupom</th>
                      <th>UP</th>
                      <th>DOWN</th>
		      <th>Periodo</th>
		      <th width="50">Ação</th>
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