<?php 
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM lc_fixas WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $descricao_fixa = $_POST['descricao_fixa'];
    $dia_vencimento = $_POST['dia_vencimento'];
    $valor_fixa = $_POST['valor_fixa'];
    $cat = $_POST['cat'];
    
    $crud = new crud('lc_fixas');  // tabela como parametro
    $crud->inserir("empresa,descricao_fixa,dia_vencimento,valor_fixa,cat", "'$empresa','$descricao_fixa','$dia_vencimento','$valor_fixa','$cat'");


    header("Location: index.php?app=ContasFixas&reg=1");
    }
    
    if(isset ($_POST['editar'])){

        $descricao_fixa = $_POST['descricao_fixa'];
        $dia_vencimento = $_POST['dia_vencimento'];
        $valor_fixa = $_POST['valor_fixa'];
        $cat = $_POST['cat'];

    $crud = new crud('lc_fixas'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("descricao_fixa='$descricao_fixa',dia_vencimento='$dia_vencimento',valor_fixa='$valor_fixa',cat='$cat'", "id='$getId'");

    
    header("Location: index.php?app=ContasFixas&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista

        $crud = new crud('lc_fixas'); // tabela como parametro
        $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    header("Location: index.php?app=ContasFixas&reg=3");

    }
										
?>
    <script type="text/javaScript">
        function Trim(str){
            return str.replace(/^\s+|\s+$/g,"");
        }
    </script>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Planos">Contas Fixas</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
         <?php if($permissao['p2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Contas Fixas</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Contas Fixas</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                   <section class="col col-4">
                      <label class="label">Descrição</label>
                      <label class="input">
                        <input type="text" name="descricao_fixa"  value="<?php echo @$campo['descricao_fixa']; ?>" required>
                      </label>
                    </section>


                      <section class="col col-3">
                          <label class="label">Categorias</label>
                          <label class="select">
                              <select id="cat" name="cat" class="form-control">

                                  <option value="">Selecione</option>
                                  <?php
                                //  $idempresa = $_SESSION['empresa'];
                                 // $bservidor = mysql_query("SELECT * FROM lc_cat WHERE empresa = '$idempresa'");
                                  $bcat = $mysqli->query("SELECT * FROM lc_cat ");
                                  while($ccategoria = mysqli_fetch_array($bcat)){
                                      ?>
                                      <option value="<?php echo $ccategoria['id']; ?>" <?php if ($campo['cat'] == $ccategoria['id']) { echo "selected"; } ?>><?php echo $ccategoria['nome']; ?> </option>
                                  <?php } ?>
                              </select>
                          </label>
                      </section>



                   <section class="col col-2">
                      <label class="label">Dia do Vencimento</label>
                      <label class="input">
                        <input type="text" name="dia_vencimento"  value="<?php echo @$campo['dia_vencimento']; ?>" required>
                      </label>
                    </section>


                      <section class="col col-2">
                          <label class="label">Valor</label>
                          <label class="input">
                              <input type="text" name="valor_fixa" onKeyUp="moeda(this);" value="<?php echo @$campo['valor_fixa']; ?>" required>
                          </label>
                      </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="contafixaid" value="<?php echo @$campo['id']; ?>">
		  <input type="hidden" name="idprl" value="<?php echo @$campo['nome']; ?>">
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