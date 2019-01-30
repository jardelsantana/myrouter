
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Permissões</li>
          </ul>
        </div>
       
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Permissões atribuidas com sucesso. </div>
	<?php } ?>
	
        
        <div class="page-header">
          <h1>Técnicos</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Permissões</small></h2>
              </header>
              <div class="inner-spacer">
              
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>Login</th>
                      <th>Chave</th>
                      <th>Nível</th>
                      <th width="80">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM usuarios WHERE empresa = '1'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  ?>
		  <tr>
                     <td><?php echo $campo['codigo']; ?></td>
                      <td><?php echo $campo['nome']; ?></td>
                      <td><?php echo $campo['login']; ?></td>
 		      <td><?php echo md5($campo['id']); ?></td>
		      <td>
              <?php if ($campo['nivel'] == '1') { ?>Administrador<?php } ?>
		      <?php if ($campo['nivel'] == '2') { ?>Operador<?php } ?>
		      <?php if ($campo['nivel'] == '3') { ?>Técnico<?php } ?>
              </td>
                      <td>
	      <a href="?app=AtribuirPermissoes&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="fa fa-lock"></i></a>&nbsp;
    
		      </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Código</th>
                      <th>Nome</th>
                      <th>Login</th>
                      <th>Chave</th>
                      <th>Nível</th>
                      <th width="80">Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        	
          </div>
        </div> 
      </div>