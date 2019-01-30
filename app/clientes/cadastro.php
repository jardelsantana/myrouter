<?php

    $idempresa = $_SESSION['empresa'];
    $idpuser = $logado['nome']; // pegar nome do login da sessão

    //gerar numero  de pedido
    //$qr_numero = mysql_query("SELECT * FROM clientes ORDER BY id DESC");
    //$row_numero = mysql_fetch_array($qr_numero);
    //$numero = str_pad($row_numero['id']+1, 9, 0, STR_PAD_LEFT);// tamanho 9
    //$pedido =$numero;

    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM clientes WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }


					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $codigo = rand(9,999999);
    $nome = $_POST['nome'];
    $acessolog = $_POST['acessolog'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $nascimento = $_POST['nascimento'];
	$estadocivil = $_POST['estadocivil'];
	$naturalidade = $_POST['naturalidade'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
	$referencia = $_POST['referencia'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
	$pai = $_POST['pai'];
	$mae = $_POST['mae'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $status = $_POST['status'];
    $nf = $_POST['nf'];
    $cfop = $_POST['cfop'];
    $tipoassinante = $_POST['tipoassinante'];
    $tipoutilizacao = $_POST['tipoutilizacao'];
    $grupo = $_POST['grupo'];


        //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $data   = $_POST['dataentrada'];
    $data_conv = substr($data,6,7).'-'.substr($data,3,2).'-'.substr($data,0,2);
    $dataentrada = $data_conv;
    //FIM DA CONVERSÃO

    //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $dataV   = $_POST['vctocontrato'];
    $dataV_conv = substr($dataV,6,7).'-'.substr($dataV,3,2).'-'.substr($dataV,0,2);
    $vctocontrato = $dataV_conv;
    //FIM DA CONVERSÃO
    
    $crud = new crud('clientes');  // tabela como parametro
    $crud->inserir("email,pai,mae,empresa,codigo,nome,login,senha,cpf,rg,tel,cel,nascimento,estadocivil,naturalidade,dataentrada,vctocontrato,endereco,numero,referencia,complemento,bairro,cidade,estado,cep,status,nf,cfop,tipoassinante,tipoutilizacao,grupo", "'$email','$pai','$mae','$empresa','$codigo','$nome','$acessolog','$senha','$cpf','$rg','$tel','$cel','$nascimento','$estadocivil','$naturalidade','$dataentrada','$vctocontrato','$endereco','$numero','$referencia','$complemento','$bairro','$cidade','$estado','$cep','$status','$nf','$cfop','$tipoassinante','$tipoutilizacao','$grupo'");

        // FUNCAO DE LOG INICIO
        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
        $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','INSERT','CRIOU O CLIENTE ".$nome."', NULL)");
        // FUNCAO DE LOG FIM

    header("Location: index.php?app=Clientes&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $nome = $_POST['nome'];
    $acessolog = $_POST['acessolog'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $nascimento = $_POST['nascimento'];
	$estadocivil = $_POST['estadocivil'];
	$naturalidade = $_POST['naturalidade'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
	$referencia = $_POST['referencia'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
	$pai = $_POST['pai'];
	$mae = $_POST['mae'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $status = $_POST['status'];
    $clienteid = $_POST['clienteid'];
    $nf = $_POST['nf'];
    $cfop = $_POST['cfop'];
    $tipoassinante = $_POST['tipoassinante'];
    $tipoutilizacao = $_POST['tipoutilizacao'];
    $grupo = $_POST['grupo'];


        //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $data   = $_POST['dataentrada'];
    $data_conv = substr($data,6,7).'-'.substr($data,3,2).'-'.substr($data,0,2);
    $dataentrada = $data_conv;
    //FIM DA CONVERSÃO

    //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $dataV   = $_POST['vctocontrato'];
    $dataV_conv = substr($dataV,6,7).'-'.substr($dataV,3,2).'-'.substr($dataV,0,2);
    $vctocontrato = $dataV_conv;
    //FIM DA CONVERSÃO

    $crud = new crud('clientes'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("email='$email',pai='$pai',mae='$mae',nome='$nome',login='$acessolog',senha='$senha',cpf='$cpf',rg='$rg',tel='$tel',cel='$cel',nascimento='$nascimento',estadocivil='$estadocivil',naturalidade='$naturalidade',dataentrada='$dataentrada',vctocontrato='$vctocontrato',endereco='$endereco',numero='$numero',referencia='$referencia',complemento='$complemento',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep',status='$status',nf='$nf',cfop='$cfop',tipoassinante='$tipoassinante',tipoutilizacao='$tipoutilizacao',grupo='$grupo'", "id='$clienteid'");

        // FUNCAO DE LOG INICIO
        $alterar1 = $mysqli->query("SELECT * FROM clientes WHERE id = + $getId ");
        $campo1 = mysqli_fetch_array($alterar1);

        $showCLI = $campo1['nome'];

        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
        $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','UPDATE','ATUALIZOU O CLIENTE ".$showCLI."', NULL)");
        // FUNCAO DE LOG FIM

    header("Location: index.php?app=Clientes&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista

        // FUNCAO DE LOG INICIO
        $alterar1 = $mysqli->query("SELECT * FROM clientes WHERE id = + $getId ");
        $campo1 = mysqli_fetch_array($alterar1);

        $showCLI = $campo1['nome'];

        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
        $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','DELETE','DELETOU O CLIENTE ".$showCLI."', NULL)");
        // FUNCAO DE LOG FIM

    $assvalida = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$id'");
    $assvld = mysqli_fetch_array($assvalida);
    $row = mysqli_num_rows($assvalida);
    
    if($row > 0) {
    header("Location: index.php?app=Clientes&reg=4");
    } else {
    
    $crud = new crud('clientes'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    header("Location: index.php?app=Clientes&reg=3");
    }
    }
										
?>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script>
jQuery(function($){
   $(".data").mask("99/99/9999");
});
</script>

<script src="assets/js/jquery.maskedinput.min.js"></script>
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
            element.mask("(99)9999-9999?9");
        }
    }).trigger('focusout');


});

$('.cep_auto').blur(function(){
    var busca_cep = $('#cep').val();
    $.ajax({
        url : 'cep.php', /* URL que será chamada */
        type : 'GET', /* Tipo da requisição */
        data: { cep: busca_cep }, /* dado que será enviado via POST */
        dataType: 'json', /* Tipo de transmissão */
        success: function(data){
            if(data.sucesso == 1){
                $('#endereco').val(data.rua);
                $('#bairro').val(data.bairro);
                $('#cidade').val(data.cidade);
                $('#estado').val(data.estado);
            }
        }
    });
    return false;
});

jQuery(function($){
   $(".nascimento").mask("99/99/9999");
   $(".cel").mask("(99)99999-9999");
   $(".tel").mask("(99)9999-9999");
   $(".cep").mask("99999-999");
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
<script type="text/javascript" src="ajax/funcslogin.js"></script>
<script type="text/javascript" src="ajax/funcscpf.js"></script>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=Clientes">Clientes</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['c2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Cliente</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Cliente</small></h2>
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
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="cpf" id="cpf" onblur="validarLogin('cpf', document.getElementById('cpf').value);" class="cpf" value="<?php echo @$campo['cpf']; ?>" required>
                        <div id="campo_cpf"></div>
                            <b class="tooltip tooltip-top-right">CAMPO OBRIGATÓRIO, CASO NÃO FOR PREENCHIDO NÃO SERÁ GERADA A COMBRAÇA.</b> </label>

                        </label>
                    </section>
                    
                     <section class="col col-2">
                        <label class="label">RG ou IE</label>
                         <label class="input"> <i class="icon-append fa fa-question"></i>
                             <input type="text" name="rg" value="<?php echo @$campo['rg']; ?>" required>
                            <b class="tooltip tooltip-top-right">Caso não tenha o número do RG/IE, por favor preencher com a palavra ISENTO</b> </label>
                         </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Data de Nascimento</label>
                      <label class="input">
                        <input type="text" name="nascimento" class="nascimento" value="<?php echo @$campo['nascimento']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Estado Civil</label>
                      <label class="input">
                        <input type="text"  name="estadocivil" value="<?php echo @$campo['estadocivil']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-2">
                      <label class="label">Naturalidade</label>
                      <label class="input">
                        <input type="text"  name="naturalidade" value="<?php echo @$campo['naturalidade']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-2">
                      <label class="label">Data da Entrada</label>
                      <label class="input">
                        <input type="text" name="dataentrada" class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['dataentrada'])); ?><?php } else { ?><?php echo date('d/m/Y'); ?><?php } ?>" required>
                      </label>
                    </section>
                    
                      <section class="col col-2">
                      <label class="label">Vcto. Contrato</label>
                      <label class="input">
                        <input type="text" name="vctocontrato"  class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vctocontrato'])); ?><?php } else { ?><?php echo date('d/m/Y',strtotime($date.'+1years')); ?><?php } ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Telefone</label>
                      <label class="input">
                        <input type="text" name="tel" class="tel" value="<?php echo @$campo['tel']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Celular</label>
                      <label class="input">
                        <input type="text" name="cel" class="maskcel" value="<?php echo @$campo['cel']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">E-mail</label>
                      <label class="input">
                        <input type="email" name="email" value="<?php echo @$campo['email']; ?>" required>
                      </label>
                    </section>
                    
                      <section class="col col-4">
                      <label class="label">Nome do Pai</label>
                      <label class="input">
                        <input type="text"  name="pai" value="<?php echo @$campo['pai']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Nome da Mãe</label>
                      <label class="input">
                        <input type="text"   name="mae" value="<?php echo @$campo['mae']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-8">
                      <label class="label">Endereço</label>
                      <label class="input">
                        <input type="text"   name="endereco" value="<?php echo @$campo['endereco']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Nº</label>
                      <label class="input">
                        <input type="text" name="numero" value="<?php echo @$campo['numero']; ?>" required>
                      </label>
                    </section>
                    
                   <section class="col col-6">
                      <label class="label">Referencia</label>
                      <label class="input">
                        <input type="text" name="referencia" value="<?php echo @$campo['referencia']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Bairro</label>
                      <label class="input">
                        <input type="text"  name="bairro" value="<?php echo @$campo['bairro']; ?>" required>
                      </label>
                    </section>
                    
                   <section class="col col-5">
                      <label class="label">Complemento</label>
                      <label class="input">
                        <input type="text" name="complemento" value="<?php echo @$campo['complemento']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-2">
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
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?> required">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Login</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" onblur="validarLogin('login', document.getElementById('login').value);" name="acessolog" id="login" value="<?php echo @$campo['login']; ?>" required>
                          <b class="tooltip tooltip-top-right">Login para Acesso a Central do Assinante</b> </label>
                          <div id="campo_login"></div>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Senha</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="password" name="senha" value="<?php echo @$campo['senha']; ?>" required>
                        <b class="tooltip tooltip-top-right">Senha para Acesso a Central do Assinante</b> </label>
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">CFOP</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="cfop" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['cfop']; ?><?php } else { ?><?php echo "5307"; ?><?php } ?>" required>
                              <b class="tooltip tooltip-top-right">Pessoa Física inserir 5307 e Pessoa Jurídica Inserir 5303</b> </label>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Grupo</label>
                          <label class="select">
                              <select name="grupo" required>
                                  <option value="">Selecione</option>
                                  <option <?php if(@$campo['grupo'] == 'N' ){echo 'selected';}  ?> value="N">NORMAL</option>
                                  <option <?php if(@$campo['grupo'] == 'V' ){echo 'selected';}  ?> value="V">VIP</option>
                                  <option <?php if(@$campo['grupo'] == 'L' ){echo 'selected';}  ?> value="L">LOCAÇÃO</option>
                                  <option <?php if(@$campo['grupo'] == 'C' ){echo 'selected';}  ?> value="C">COMODATO</option>
                                  <option <?php if(@$campo['grupo'] == 'FC' ){echo 'selected';}  ?> value="FC">FIDELIDADE COMODATO</option>
                                  <option <?php if(@$campo['grupo'] == 'F' ){echo 'selected';}  ?> value="F">FUNCIONÁRIO</option>
                                  <option <?php if(@$campo['grupo'] == 'CT' ){echo 'selected';}  ?> value="CT">CORTESIA</option>
                                  <option <?php if(@$campo['grupo'] == 'I' ){echo 'selected';}  ?> value="I">INADIMPLENTE</option>
                                  <option <?php if(@$campo['grupo'] == 'NE' ){echo 'selected';}  ?> value="NE">NEGATIVADO</option>
                                  <option <?php if(@$campo['grupo'] == 'O' ){echo 'selected';}  ?> value="O">OUTROS</option>

                              </select>
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Tipo Assinante</label>
                          <label class="select">
                              <select name="tipoassinante" required>
                                  <option value="">Selecione</option>
                                  <option <?php if(@$campo['tipoassinante'] == 1 ){echo 'selected';}  ?> value="1">Comercial/Industrial</option>
                                  <option <?php if(@$campo['tipoassinante'] == 2 ){echo 'selected';}  ?> value="2">Poder Público</option>
                                  <option <?php if(@$campo['tipoassinante'] == 3 ){echo 'selected';}  ?> value="3">Residencial/Pessoa Física</option>
                                  <option <?php if(@$campo['tipoassinante'] == 4 ){echo 'selected';}  ?> value="4">Telefone Público</option>
                                  <option <?php if(@$campo['tipoassinante'] == 5 ){echo 'selected';}  ?> value="5">Telefone Semi-público</option>
                                  <option <?php if(@$campo['tipoassinante'] == 6 ){echo 'selected';}  ?> value="6">Grandes Clientes/Serviço de Telecom</option>
                                  <option <?php if(@$campo['tipoassinante'] == 7 ){echo 'selected';}  ?> value="7">Missões Diplomatas/Consulado</option>
                                  <option <?php if(@$campo['tipoassinante'] == 8 ){echo 'selected';}  ?> value="8">Igrejas e Templos</option>
                                  <option <?php if(@$campo['tipoassinante'] == 99 ){echo 'selected';}  ?> value="99">Outros Não Espefificado</option>


                              </select>
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Tipo de Utilização</label>
                          <label class="select">
                              <select name="tipoutilizacao" required>
                                  <option value="">Selecione</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 1 ){echo 'selected';}  ?> value="1">Telefonia</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 2 ){echo 'selected';}  ?> value="2">Comunicação de Dados</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 3 ){echo 'selected';}  ?> value="3">TV por Assinatura</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 4 ){echo 'selected';}  ?> value="4">Provimento de acesso à Internet</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 5 ){echo 'selected';}  ?> value="5">Multimídia</option>
                                  <option <?php if(@$campo['tipoutilizacao'] == 6 ){echo 'selected';}  ?> value="6">Outros</option>
                              </select>
                          </label>
                      </section>


                    <section class="col col-2">
                      <label class="label">Emitir NFSe</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="nf" value="S"  checked="yes" <?php if ($campo['nf'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="nf" value="N" <?php if ($campo['nf'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Situação do Cliente</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" checked="yes" <?php if ($campo['status'] == 'S') { echo "checked"; } ?> required>
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
		  <input type="hidden" name="clienteid" value="<?php echo @$campo['id']; ?>"> 
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
            