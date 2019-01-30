<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Técnicos.
    Ultima Atualização: 17/11/2014
     <?php if( @$getId  == ''){ echo  'cadastra';}else{ echo 'edita';}?>
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']);
    @$codigoEdit = base64_decode($_GET['codigo']);
if(@$getId){
        
        $alterar = $mysqli->query("SELECT * FROM tecnicos WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $codigo = rand(9,999999);
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $admissao = $_POST['admissao'];
    $horario = $_POST['horario'];
    $ctps = $_POST['ctps'];
    $serie = $_POST['serie'];
    $salario = $_POST['salario'];
    $pis = $_POST['pis'];
    $cnh = $_POST['cnh'];
    $acessolog = $_POST['acessolog'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];
    $grupomk = $_POST['grupomk'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $status = $_POST['status'];
    
    $crud = new crud('tecnicos');  // tabela como parametro
    $crud->inserir("empresa,codigo,nome,cargo,admissao,horario,ctps,serie,salario,pis,cnh,login,senha,nivel,grupomk,cpf,rg,tel,cel,email,nascimento,endereco,numero,complemento,bairro,cidade,estado,cep,status", "'$empresa','$codigo','$nome','$cargo','$admissao','$horario','$ctps','$serie','$salario','$pis','$cnh','$acessolog','$senha','$nivel','$grupomk','$cpf','$rg','$tel','$cel','$email','$nascimento','$endereco','$numero','$complemento','$bairro','$cidade','$estado','$cep','$status'");
    
    $sergkey = md5($senha);
    $salt = base64_encode($senha);
    
    $crud = new crud('usuarios');  // tabela como parametro
    $crud->inserir("empresa,codigo,nome,login,senha,nivel,salt,email,status", "'1','$codigo','$nome','$acessolog','$sergkey','$nivel','$salt','$email','$status'");
    
    $query1 = $mysqli->query("SELECT MAX(ID) as id FROM usuarios");
    $dados1 = mysqli_fetch_assoc($query1);
    $ultimoid = $dados1['id'];
       
    $crud = new crud('permissoes');  // tabela como parametro
    $crud->inserir("codigo", "'$ultimoid'");

    // login administrador do mikrotik via radius - GRUPO
    $crud = new crud('radreply');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$acessolog','Mikrotik-Group',':=','$grupomk','$codigo'");

    // login administrador do mikrotik via radius - LOGIN
    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$acessolog','User-Password',':=','$senha','$codigo'");

    header("Location: index.php?app=Tecnicos&reg=1");
    }
    
    if(isset ($_POST['editar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $admissao = $_POST['admissao'];
    $horario = $_POST['horario'];
    $ctps = $_POST['ctps'];
    $serie = $_POST['serie'];
    $salario = $_POST['salario'];
    $pis = $_POST['pis'];
    $cnh = $_POST['cnh'];
    $acessolog = $_POST['acessolog'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];
    $grupomk = $_POST['grupomk'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $status = $_POST['status'];
    $tecnicoid = $_POST['tecnicoid'];
    
    $crud = new crud('tecnicos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',cargo='$cargo',admissao='$admissao',horario='$horario',ctps='$ctps',serie='$serie',salario='$salario',pis='$pis',cnh='$cnh',login='$acessolog',senha='$senha',nivel='$nivel',grupomk='$grupomk',cpf='$cpf',rg='$rg',tel='$tel',cel='$cel',email='$email',nascimento='$nascimento',endereco='$endereco',numero='$numero',complemento='$complemento',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep',status='$status'", "id='$tecnicoid'");
    
    $sergkey = md5($senha);
    $salt = base64_encode($senha);
    
    $crud = new crud('usuarios'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',login='$acessolog',senha='$sergkey',salt='$salt',email='$email',nivel='$nivel',status='$status'", "codigo='$codigo'");

    $crud = new crud('radreply'); // tabela como parametro
    $crud->atualizar("username='$acessolog',value='$grupomk'", "pedido='$codigoEdit' AND attribute = 'Mikrotik-Group'"); // exclui o registro com o id que foi passado

    $crud = new crud('radcheck'); // tabela como parametro
    $crud->atualizar("username='$acessolog',value='$senha'", "pedido='$codigoEdit' AND attribute = 'User-Password'"); // exclui o registro com o id que foi passado


        header("Location: index.php?app=Tecnicos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista

    // pesquisa na tabela usuario para apagar permissão
    $codigo = $_GET['codigo'];
    $deletar = $mysqli->query("SELECT * FROM usuarios WHERE codigo = '$codigo'");
    $campo = mysqli_fetch_array($deletar);
    $campoDel = $campo['id'];

    $crud = new crud('permissoes'); // tabela como parametro
    $crud->excluir("codigo = $campoDel"); // exclui o registro com o id que foi passado

    $crud = new crud('tecnicos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    $codigo = $_GET['codigo'];

    $crud = new crud('usuarios'); // tabela como parametro
    $crud->excluir("codigo = $codigo"); // exclui o registro com o id que foi passado

    $crud = new crud('radreply'); // tabela como parametro
    $crud->excluir("pedido = $codigo AND attribute = 'Mikrotik-Group'"); // exclui o registro com o id que foi passado

    $crud = new crud('radcheck'); // tabela como parametro
    $crud->excluir("pedido = $codigo AND attribute = 'User-Password'"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=Tecnicos&reg=3");
    }
										
?>
<script src="assets/js/jquery.maskedinput.min.js" xmlns="http://www.w3.org/1999/html"></script>
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

$(function() {
    $('.maskcel').focusout(function() {
        var maskcelular, element;
        element = $(this);
        element.unmask();
        maskcelular = element.val().replace(/\D/g, '');
        if (maskcelular.length > 11) {
            element.mask("(99)99999-9999");
        } else {
            element.mask("(99)9999?9-9999");
        }

    }).trigger('focusout');


});

jQuery(function($){
   $(".nascimento").mask("99/99/9999");
   $(".cel").mask("(99) 99999-9999");
   $(".tel").mask("(99) 9999-9999");
   $(".cep").mask("99999-999");
   $(".admissao").mask("99/99/9999");
});
</script>
<script type="text/javascript" src="assets/js/cidades-estados-1.0.js"></script>
<script type="text/javascript">
window.onload = function() {
  new dgCidadesEstados({
    estado: document.getElementById('estado'),
    cidade: document.getElementById('cidade')
  });
}
</script>
<script type="text/javascript" src="ajax/funcslogintecnicos.js"></script>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Tecnicos">Técnicos</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['t2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Técnico</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Funcionário</small></h2>
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
                      <label class="label">RG</label>
                      <label class="input">
                        <input type="text" name="rg" value="<?php echo @$campo['rg']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Data de Nascimento</label>
                      <label class="input">
                        <input type="text" name="nascimento" class="nascimento" value="<?php echo @$campo['nascimento']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Telefone</label>
                      <label class="input">
                        <input type="text" name="tel" class="tel" value="<?php echo @$campo['tel']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Celular</label>
                      <label class="input">
                        <input type="text" name="cel" class="maskcel" value="<?php echo @$campo['cel']; ?>">
                      </label>
                    </section>

                      <section class="col col-3">
                          <label class="label">Email</label>
                          <label class="input">
                              <input type="text" name="email"  value="<?php echo @$campo['email']; ?>">
                          </label>
                      </section>

                    <section class="col col-3">
                      <label class="label">CNH</label>
                      <label class="input">
             <input type="text" name="cnh" value="<?php echo @$campo['cnh']; ?>" placeholder="Nº CNH, Tipo e Validade">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Admissão</label>
                      <label class="input">
             <input type="text" name="admissao" value="<?php echo @$campo['admissao']; ?>" class="admissao">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Horário de Trabalho</label>
                      <label class="input">
             <input type="text" name="horario" value="<?php echo @$campo['horario']; ?>" placeholder="Horário Comercial">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Cargo</label>
                      <label class="input">
             <input type="text" name="cargo" value="<?php echo @$campo['cargo']; ?>" placeholder="Técnico Wireless">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">CTPS</label>
                      <label class="input">
             	      <input type="text" name="ctps" value="<?php echo @$campo['ctps']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Série</label>
                      <label class="input">
             	      <input type="text" name="serie" value="<?php echo @$campo['serie']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Salário</label>
                      <label class="input">
             	      <input type="text" name="salario" onKeyUp="moeda(this);" value="<?php echo @$campo['salario']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">PIS</label>
                      <label class="input">
             	      <input type="text" name="pis" value="<?php echo @$campo['pis']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-6">
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
                    
                   <section class="col col-4">
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
                    
                    <section class="col col-2">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Login</label>
                      <label class="input">
                        <input type="text" onblur="validarLogin('login', document.getElementById('login').value);" name="acessolog" id="login" value="<?php echo @$campo['login']; ?>" required>
                        <div id="campo_login"></div>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Senha</label>
                      <label class="input">
                        <input type="password" name="senha" value="<?php echo @$campo['senha']; ?>" required>
                      </label>
                    </section>


                      <section class="col col-2">
                          <label class="label">Nível</label>
                          <label class="select">
                           <select name="nivel">
                               <option <?php if(@$campo['nivel'] == 1 ){echo 'selected';}  ?> value="1">Administrador</option>
                               <option <?php if(@$campo['nivel'] == 2 ){echo 'selected';}  ?> value="2">Operador</option>
                               <option <?php if(@$campo['nivel'] == 3 ){echo 'selected';}  ?> value="3">Tecnico</option>
                           </select>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Grupo MikroTik</label>
                          <label class="select">
                              <select name="grupomk">
                                  <option <?php if(@$campo['grupomk'] == "bloqueado" ){echo 'selected';}  ?> value="bloqueado">BLOQUEADO</option>
                                  <option <?php if(@$campo['grupomk'] == "full" ){echo 'selected';}  ?> value="full">FULL</option>
                                  <option <?php if(@$campo['grupomk'] == "write" ){echo 'selected';}  ?> value="write">ESCRITA</option>
                                  <option <?php if(@$campo['grupomk'] == "read" ){echo 'selected';}  ?> value="read">LEITURA</option>
                              </select>
                          </label>
                      </section>

                    
                    <section class="col col-3">
                      <label class="label">Situação do Técnico</label>
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
		  <input type="hidden" name="tecnicoid" value="<?php echo @$campo['id']; ?>">
		  <input type="hidden" name="codigo" value="<?php echo @$campo['codigo']; ?>">
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
            