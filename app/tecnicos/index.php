<?php 
require '../resource/alert.php';
 ?>
<div class="breadcrumb clearfix">
    <ul>
      <li><a href="index.php?app=Dashboard">Dashboard</a></li>
      <li class="active">Técnicos</li>
    </ul>
</div>
        
<!-- Exibe um alert de acordo com o parâmetro 'reg' enviado após uma manipulação no banco de dados melhoria realizada visando diminuir a repetição de código, replicarei em outros módulos, essa funcionalidade não foi testada, estou com um problema de configuração no ambiente de testes -->

<?php 
    if($permissao['t1'] == S) { 
      if (isset($_GET['reg'])) {
        conditionalAlert($_GET['reg']);
      }

?>
        
  <div class="page-header">
    <h1>Técnicos</h1>
  </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Técnicos</small></h2>
              </header>
              <div class="inner-spacer">
              
<?php require 'resource/exportTableData.php'; ?>

<br>
<br>              
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>CPF/CNPJ</th>
                      <th>Cargo</th>
                      <th>Telefone</th>
                      <th>Cidade</th>
                      <th>Status</th>
                      <th width="80">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM tecnicos WHERE empresa = '$idempresa'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  ?>
        <tr>
          <td><?php echo $campo['codigo']; ?></td>
          <td><?php echo $campo['nome']; ?></td>
          <td><?php echo $campo['cpf']; ?></td>
          <td><?php echo $campo['cargo']; ?></td>
          <td><?php echo $campo['tel']; ?></td>
 		      <td><?php echo $campo['cidade']; ?> <?php echo $campo['estado']; ?></td>
		      <td><?php if ($campo['status'] == 'S') { ?>Ativo<?php } else { ?>Bloqueado<?php } ?> </td>
          <td>
            <a href="?app=CadastroTecnico&id=<?php echo base64_encode($campo['id']); ?>&codigo=<?php echo base64_encode($campo['codigo']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      
            <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroTecnico&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&codigo=<?php echo $campo['codigo']; ?>' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
          </td>
        </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>CPF/CNPJ</th>
                      <th>Cargo</th>
                      <th>Telefone</th>
                      <th>Cidade</th>
                      <th>Status</th>
                      <th width="80">Ações</th>
                    </tr>
                  </tfoot>
                </table>

                
              </div>
            </div>
        	
          </div>
        </div> 
      </div>
      
      <?php } else {
      	    require '../resource/noPermission.php';
 } ?>
      