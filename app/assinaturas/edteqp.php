<?php 
    /*
    Função CRUD
    Edição Equipamento Assinado
    Ultima Atualização: 24/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['regedit']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM instalacao_equipamentos WHERE id = + $getId");
        $campo = mysqli_fetch_array($alterar);
    }
					
    
    if(isset ($_POST['editar'])){
    
    $equipamento = $_POST['equipamento'];
    $qtd = $_POST['qtd'];
    $obs = $_POST['obs'];
    
    $idde = $_POST['idde'];
    
    $crud = new crud('instalacao_equipamentos'); 
    $crud->atualizar("equipamento='$equipamento',qtd='$qtd',obs='$obs'", "id='$idde'"); 
    
    $idxer = $_POST['idop'];
    header("Location: index.php?app=CadastroAssinatura&id=$idxer");
    }
    
    						
?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Assinaturas">Assinaturas</a></li>
            <li class="active">Alterar Equipamento</li>
          </ul>
        </div>
 
        
        <div class="page-header">
          <h1>Assinatura<small> Alterar Equipamento</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Assinatura<small>Alterar Equipamento</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                   
                    
                     <section class="col col-4">
                      <label class="label">Equipamento</label>
                      <label class="select">
                        
                      <select id="equipamento" name="equipamento" class="form-control" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $eqp = $mysqli->query("SELECT * FROM equipamentos WHERE empresa = '$idempresa'");
 		      while($equipamento = mysqli_fetch_array($eqp)){
		      ?>
		      <option value="<?php echo $equipamento['id']; ?>" <?php if ($campo['equipamento'] == $equipamento['id']) { echo "selected"; } ?>><?php echo $equipamento['equipamento']; ?> | Modelo: <?php echo $equipamento['modelo']; ?> | <?php echo $equipamento['fabricante']; ?></option>
		      <?php } ?> 
 		      </select>
                        
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Qtd Utilizada</label>
                      <label class="input">
                        <input type="text" name="qtd" value="<?php echo @$campo['qtd']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Observações</label>
                      <label class="input">
                        <input type="text" name="obs" value="<?php echo @$campo['obs']; ?>">
                      </label>
                    </section>
                    
                    
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="idde" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="idop" value="<?php echo $_GET['id']; ?>"> 
		  
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
              </div>
            </div>
<script type="text/javascript">
$(function () {
  function removeCampo() {
	$(".removerCampo").unbind("click");
	$(".removerCampo").bind("click", function () {
	   if($("tr.linhas").length > 1){
		$(this).parent().parent().remove();
	   }
	});
  }
 
  $(".adicionarCampo").click(function () {
	novoCampo = $("tr.linhas:first").clone();
	novoCampo.find("input").val("");
	novoCampo.insertAfter("tr.linhas:last");
	removeCampo();
  });
});
</script>