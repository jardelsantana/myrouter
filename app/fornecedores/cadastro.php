<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Fornecedores.
    Ultima Atualização: 18/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM fornecedores WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $codigo = rand(9,999999);
    $nome = $_POST['nome'];
    $razao = $_POST['razao'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $contato = $_POST['contato'];
    $referencia = $_POST['referencia'];
    $status = $_POST['status'];
    
    $crud = new crud('fornecedores');  // tabela como parametro
    $crud->inserir("empresa,codigo,nome,razao,cpf,rg,tel,cel,endereco,numero,complemento,bairro,cidade,estado,cep,email,site,contato,referencia,status", "'$empresa','$codigo','$nome','$razao','$cpf','$rg','$tel','$cel','$endereco','$numero','$complemento','$bairro','$cidade','$estado','$cep','$email','$site','$contato','$referencia','$status'");
       
    header("Location: index.php?app=Fornecedores&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $nome = $_POST['nome'];
    $razao = $_POST['razao'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $contato = $_POST['contato'];
    $referencia = $_POST['referencia'];
    $status = $_POST['status'];
    $fornecedorid = $_POST['fornecedorid'];
    
    $crud = new crud('fornecedores'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',razao='$razao',cpf='$cpf',rg='$rg',tel='$tel',cel='$cel',endereco='$endereco',numero='$numero',complemento='$complemento',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep',email='$email',site='$site',contato='$contato',referencia='$referencia',status='$status'", "id='$fornecedorid'");
    
    header("Location: index.php?app=Fornecedores&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('fornecedores'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=Fornecedores&reg=3");
    }
										
?>
<script src="https://raw.githubusercontent.com/digitalBush/jquery.maskedinput/1.4.0/dist/jquery.maskedinput.min.js"></script>
<script>
$(function() {
 $('.cpf').focusout(function() {
        var cpfcnpj, element;
        element = $(this);
        element.unmask();
        cpfcnpj = element.val().replace(/\D/g, '');
        if (cpfcnpj.length > 11) {
            element.mask("99.999.999/999?9-99");
        } else {
            element.mask("999.999.999-99?9-99");
        }
    }).trigger('focusout');
    

});
jQuery(function($){
   $(".nascimento").mask("99/99/9999");
   $(".cel").mask("(999) 99999-9999");
   $(".tel").mask("(999) 9999-9999");
   $(".cep").mask("99999-999");
});
</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.0.js"></script>
<script type="text/javascript">
window.onload = function() {
  new dgCidadesEstados({
    estado: document.getElementById('estado'),
    cidade: document.getElementById('cidade')
  });
}
</script>
<script type="text/javascript" src="ajax/funcslogin.js"></script>
<script type="text/javascript" src="ajax/funcscpf.js"></script>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Fornecedores">Fornecedores</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['fo2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Fornecedor</small></h1>
        </div>
        
        <div class="powerwidget yellow" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Fornecedor</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-8">
                      <label class="label">Nome Completo</label>
                      <label class="input">
                        <input type="text" name="nome" value="<?php echo @$campo['nome']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">CPF ou CNPJ</label>
                      <label class="input">
                        <input type="text" name="cpf" id="cpf" onblur="validarLogin('cpf', document.getElementById('cpf').value);" class="cpf" value="<?php echo @$campo['cpf']; ?>">
                        <div id="campo_cpf"></div>
                      </label>
                    </section>
                    
                     <section class="col col-3">
                      <label class="label">RG ou Inscrição Estadual</label>
                      <label class="input">
                        <input type="text" name="rg" value="<?php echo @$campo['rg']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Razão Social (P.J)</label>
                      <label class="input">
                        <input type="text" name="razao" class="razao" value="<?php echo @$campo['razao']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Telefone</label>
                      <label class="input">
                        <input type="text" name="tel" class="tel" value="<?php echo @$campo['tel']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Celular</label>
                      <label class="input">
                        <input type="text" name="cel" class="cel" value="<?php echo @$campo['cel']; ?>">
                      </label>
                    </section>

                      <section class="col col-3">
                          <label class="label">Email</label>
                          <label class="input">
                              <input type="text" name="email" class="email" value="<?php echo @$campo['email']; ?>">
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Site</label>
                          <label class="input">
                              <input type="text" name="site" class="site" value="<?php echo @$campo['site']; ?>">
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Nome do Contato</label>
                          <label class="input">
                              <input type="text" name="contato" class="contato" value="<?php echo @$campo['contato']; ?>">
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Referência</label>
                          <label class="input">
                              <input type="text" name="referencia" class="referencia" value="<?php echo @$campo['referencia']; ?>">
                          </label>
                      </section>

                    <section class="col col-10">
                      <label class="label">Endereço</label>
                      <label class="input">
                        <input type="text" name="endereco" value="<?php echo @$campo['endereco']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Nº</label>
                      <label class="input">
                        <input type="text" name="numero" onKeyUp="kbps(this);" value="<?php echo @$campo['numero']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Bairro</label>
                      <label class="input">
                        <input type="text" name="bairro" value="<?php echo @$campo['bairro']; ?>" required>
                      </label>
                    </section>
                    
                   <section class="col col-3">
                      <label class="label">Complemento</label>
                      <label class="input">
                        <input type="text" name="complemento" value="<?php echo @$campo['complemento']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-3">
                      <label class="label">Estado</label>
                      <label class="select">
                      <select name="estado" id="estado" value="<?php echo @$campo['estado']; ?>"></select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Cidade</label>
                      <label class="select">
                      <select name="cidade" id="cidade" value="<?php echo @$campo['cidade']; ?>" required></select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?>">
                      </label>
                    </section>
                    
              
                    
                    <section class="col col-3">
                      <label class="label">Situação do Fornecedor</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" <?php if ($campo['status'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Ativo</label>
                        
                        <label class="radio">
                          <input type="radio" name="status" value="N" <?php if ($campo['status'] == 'N') { echo "checked"; } ?>>
                          <i></i>Bloqueado</label>
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="fornecedorid" value="<?php echo @$campo['id']; ?>"> 
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