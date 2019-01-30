<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Equipamentos.
    Ultima Atualização: 19/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM fabricante WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $nome = $_POST['nome'];


    
    $crud = new crud('fabricante');  // tabela como parametro
    $crud->inserir("empresa,nome", "'$empresa','$nome'");
       
    header("Location: index.php?app=ListaFabricante&reg=1");
    }
    
    if(isset ($_POST['editar'])){
    
    $nome = $_POST['nome'];

    
    $crud = new crud('fabricante'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome'", "id='$getId'");
    
    header("Location: index.php?app=ListaFabricante&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('fabricante'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=ListaFabricante&reg=3");
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
            <li><a href="?app=Equipamentos">Fabricante</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['e2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Fabricante</small></h1>
        </div>
        
        <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Fabricante</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-6">
                      <label class="label">Fabricante</label>
                      <label class="input">
                        <input type="text" name="nome" value="<?php echo @$campo['nome']; ?>" required>
                      </label>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="fabricanteid" value="<?php echo @$campo['id']; ?>">
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
            