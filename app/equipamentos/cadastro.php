<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Equipamentos.
    Ultima Atualização: 19/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM equipamentos WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $equipamento = $_POST['equipamento'];
    $notafiscal = $_POST['notafiscal'];
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $fornecedor = $_POST['fornecedor'];
    $aquisicao = $_POST['aquisicao'];
    $barcode = $_POST['barcode'];
    $garantia = $_POST['garantia'];
    $custo = $_POST['custo'];
    $venda = $_POST['venda'];
    $nserie = $_POST['nserie'];
    $qtd = $_POST['qtd'];
    $disponivel = $_POST['qtd'];
    $status = $_POST['status'];

    
    $crud = new crud('equipamentos');  // tabela como parametro
    $crud->inserir("empresa,equipamento,notafiscal,modelo,fabricante,fornecedor,aquisicao,barcode,garantia,custo,venda,nserie,qtd,disponivel,status", "'$empresa','$equipamento','$notafiscal','$modelo','$fabricante','$fornecedor','$aquisicao','$barcode','$garantia','$custo','$venda','$nserie','$qtd','$disponivel','$status'");
       
    header("Location: index.php?app=Equipamentos&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $equipamento = $_POST['equipamento'];
    $notafiscal = $_POST['notafiscal'];
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $fornecedor = $_POST['fornecedor'];
    $aquisicao = $_POST['aquisicao'];
    $barcode = $_POST['barcode'];
    $garantia = $_POST['garantia'];
    $custo = $_POST['custo'];
    $venda = $_POST['venda'];
    $nserie = $_POST['nserie'];
    $qtd = $_POST['qtd'];
    $disponivel = $_POST['qtd'];
    $status = $_POST['status'];
    $equipamentoid = $_POST['equipamentoid'];
    
    $crud = new crud('equipamentos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("equipamento='$equipamento',notafiscal='$notafiscal',modelo='$modelo',fabricante='$fabricante',fornecedor='$fornecedor',aquisicao='$aquisicao',barcode='$barcode',garantia='$garantia',custo='$custo',venda='$venda',nserie='$nserie',status='$status'", "id='$equipamentoid'");
    
    header("Location: index.php?app=Equipamentos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('equipamentos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=Equipamentos&reg=3");
    }
										
?>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script>
jQuery(function($){
   $(".data").mask("99/99/9999");
});
</script>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Equipamentos">Equipamentos</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['e2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Equipamento</small></h1>
        </div>
        
        <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Equipamento</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-8">
                      <label class="label">Equipamento</label>
                      <label class="input">
                        <input type="text" name="equipamento" value="<?php echo @$campo['equipamento']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Nº Nota Fiscal</label>
                      <label class="input">
                        <input type="text" name="notafiscal" value="<?php echo @$campo['notafiscal']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Modelo</label>
                      <label class="input">
                        <input type="text" name="modelo" value="<?php echo @$campo['modelo']; ?>" required>
                      </label>
                    </section>


                      <section class="col col-4">
                          <label class="label">Fabricante</label>
                          <label class="select">
                              <select id="fabricante" name="fabricante" class="selectpicker form-control" data-live-search="true" required">

                                  <option value="">Selecione</option>
                                  <?php
                                  $idempresa = $_SESSION['empresa'];
                                  $bfab = $mysqli->query("SELECT * FROM fabricante WHERE empresa = '$idempresa'");
                                  while($efabricante = mysqli_fetch_array($bfab)){
                                      ?>
                                      <option value="<?php echo $efabricante['id']; ?>" <?php if ($campo['fabricante'] == $efabricante['id']) { echo "selected"; } ?>><?php echo $efabricante['nome']; ?> </option>
                                  <?php } ?>
                              </select>
                          </label>
                      </section>

                      <section class="col col-4">
                          <label class="label">Fornecedor</label>
                          <label class="select">
                              <select id="fornecedor" name="fornecedor" class="selectpicker form-control" data-live-search="true" required">

                                  <option value="">Selecione</option>
                                  <?php
                                  $idempresa = $_SESSION['empresa'];
                                  $bforc = $mysqli->query("SELECT * FROM fornecedores WHERE empresa = '$idempresa'");
                                  while($eforncedor = mysqli_fetch_array($bforc)){
                                      ?>
                                      <option value="<?php echo $eforncedor['id']; ?>" <?php if ($campo['fornecedor'] == $eforncedor['id']) { echo "selected"; } ?>><?php echo $eforncedor['nome']; ?> </option>
                                  <?php } ?>
                              </select>
                          </label>
                      </section>

                    <section class="col col-4">
                      <label class="label">Data de Aquisição</label>
                      <label class="input">
                        <input type="text" name="aquisicao" class="data" value="<?php echo @$campo['aquisicao']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Etiqueta</label>
                      <label class="input">
                        <input type="text" name="barcode" onKeyUp="kbps(this);" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['barcode']; ?><?php } else { ?><?php echo rand(9,99999999); ?><?php } ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Nº Série</label>
                      <label class="input">
                        <input type="text" name="nserie" value="<?php echo @$campo['nserie']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Preço de Custo</label>
                      <label class="input">
                        <input type="text" name="custo" onKeyUp="moeda(this);" value="<?php echo @$campo['custo']; ?>">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Preço de Venda</label>
                          <label class="input">
                              <input type="text" name="venda" onKeyUp="moeda(this);" value="<?php echo @$campo['venda']; ?>">
                          </label>
                      </section>

                    <section class="col col-3">
                      <label class="label">Garantia</label>
                      <label class="select">
                      <select name="garantia">
                      <option value="">Selecione</option>
                      <option value="3" <?php if ($campo['garantia'] == '3') { echo "selected"; } ?>>3 Meses</option>
                      <option value="6" <?php if ($campo['garantia'] == '6') { echo "selected"; } ?>>6 Meses</option>
                      <option value="12" <?php if ($campo['garantia'] == '12') { echo "selected"; } ?>>12 Meses</option>
                      <option value="18" <?php if ($campo['garantia'] == '18') { echo "selected"; } ?>>18 Meses</option>
                      <option value="24" <?php if ($campo['garantia'] == '24') { echo "selected"; } ?>>24 Meses</option>
                      <option value="30" <?php if ($campo['garantia'] == '30') { echo "selected"; } ?>>30 Meses</option>
                      <option value="36" <?php if ($campo['garantia'] == '36') { echo "selected"; } ?>>36 Meses</option>
                      </select>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Quantidade</label>
                      <label class="input">
                        <input type="text" name="qtd" onKeyUp="kbps(this);" value="<?php echo @$campo['qtd']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Situação do Equipamento</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" <?php if ($campo['status'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Disponível</label>
                        
                        <label class="radio">
                          <input type="radio" name="status" value="N" <?php if ($campo['status'] == 'N') { echo "checked"; } ?>>
                          <i></i>Indisponível</label>
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="equipamentoid" value="<?php echo @$campo['id']; ?>"> 
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
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
            