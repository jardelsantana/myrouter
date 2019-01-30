
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=BLOCK">Ferramentas</a></li>
            <li class="active">Controle de Acesso a Sites</li>
          </ul>
        </div>
        
        <?php if($permissao['fr3'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Filtro cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Filtro excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Firewall / Permissão de Acesso</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            <a href="index.php?app=CadastroBLOCK" class="btn btn-info">NOVO FILTRO</a><br><br>
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Filtros de Bloqueio</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Key</th>
                      <th>Cliente</th>
                      <th>IP</th>
                      <th>Conteúdo</th>
                      <th>Autenticação</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
              $servidor = $mysqli->query("SELECT * FROM servidores");
    		  $mk = mysqli_fetch_array($servidor);
                  
		  $API = new routeros_api();
		  $API->debug = false;
		  if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].'')) {
		  $ARRAY = $API->comm("/ip/firewall/filter/print");


		  for ($i = 0; $i < count($ARRAY); ++$i)
		  {
 		  $first = $ARRAY[$i];
		  ?>

                  <?php
                  $ipfl = $first['src-address'];
 		  $consultas = $mysqli->query("SELECT * FROM firewall WHERE ip = '$ipfl' group by cliente order by id DESC");
 		  $campo = mysqli_fetch_array($consultas);
		  $cliente = $campo['cliente'];
		  
		  $qtds = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
 		  $cliente = mysqli_fetch_array($qtds)
		  ?>
		  <?php if($campo['cliente'] <> '') { ?>
		  <tr>
		  <td><?php echo md5($first['.id']); ?></td>
		  <td><?php echo $cliente['nome']; ?></td>
		  <td><?php echo $campo['ip']; ?></td>
		  <td><?php echo $campo['conteudo']; ?></td>
                  <td>Proibir</td>
                  <td>
		 
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroBLOCK&id=<?php echo base64_encode($campo['id']); ?>&srv=<?php echo base64_encode($campo['servidor']); ?>&rmv=<?php echo base64_encode($first['.id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      	 </td>
		  </tr>
    		  <?php } ?>
    		  
    		  
		  <?php  
		    }
		     $API->disconnect();
		     } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                    <th>ID</th>
                      <th>Cliente</th>
                      <th>IP</th>
                      <th>Conteúdo</th>
                      <th>Autenticação</th>
                      <th>Ações</th>
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