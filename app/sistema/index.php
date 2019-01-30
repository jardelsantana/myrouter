<?php 
    /*
    Função CRUD
    Cadastro do Sistema.
    Ultima Atualização: 25/11/2014
    */
    
        $alterar = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
        $campo = mysqli_fetch_array($alterar);
    	
        $alter = $mysqli->query("SELECT * FROM usuarios WHERE id = '1'");
        $admin = mysqli_fetch_array($alter);

        $alteraremail = $mysqli->query("SELECT * FROM maile WHERE id = '1'");
        $camposemail = mysqli_fetch_array($alteraremail);
    
    if(isset ($_POST['editarsistema'])){

    $nome_temporario=$_FILES["foto"]["tmp_name"];
    $nome_real=$_FILES["foto"]["name"];
    copy($nome_temporario,"assets/images/$nome_real");

    if(!empty($nome_real)){
    $foto2  = $_POST['foto2'];
    unlink(assets/images/$foto2);

    $empresa = $_POST['empresa'];
    $cnpj = $_POST['cnpj'];
	$ie = $_POST['ie'];
	$im = $_POST['im'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
	$site = $_POST['site'];
	$skype = $_POST['skype'];
	$fistel = $_POST['fistel'];
    $email = $_POST['email'];
    $dias_bloc = $_POST['dias_bloc'];
    $foto   = $nome_real;
	$obs = $_POST['obs'];
    
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("empresa='$empresa',cnpj='$cnpj',ie='$ie',im='$im',endereco='$endereco',numero='$numero',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep',tel1='$tel1',tel2='$tel2',site='$site',skype='$skype',fistel='$fistel',email='$email',dias_bloc='$dias_bloc',foto='$foto',obs='$obs'", "id='1'");

    }else{
        $empresa = $_POST['empresa'];
        $cnpj = $_POST['cnpj'];
        $ie = $_POST['ie'];
        $im = $_POST['im'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['cep'];
        $tel1 = $_POST['tel1'];
        $tel2 = $_POST['tel2'];
        $site = $_POST['site'];
        $skype = $_POST['skype'];
        $fistel = $_POST['fistel'];
        $email = $_POST['email'];
        $dias_bloc = $_POST['dias_bloc'];
        $obs = $_POST['obs'];

        $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
        $crud->atualizar("empresa='$empresa',cnpj='$cnpj',ie='$ie',im='$im',endereco='$endereco',numero='$numero',bairro='$bairro',cidade='$cidade',estado='$estado',cep='$cep',tel1='$tel1',tel2='$tel2',site='$site',skype='$skype',fistel='$fistel',email='$email',dias_bloc='$dias_bloc', obs='$obs'", "id='1'");
    }
    header("Location: index.php?app=Sistema&reg=2");
    }
    
    
    if(isset ($_POST['editarbancos'])){
    
    $banco = $_POST['banco'];
    $bancos_codigo = $_POST['bancos_codigo'];
    $bancos_layout = $_POST['bancos_layout'];
    $receberate = $_POST['receberate'];
    $instrucoes1 = $_POST['instrucoes1'];
    $instrucoes2 = $_POST['instrucoes2'];
    $instrucoes3 = $_POST['instrucoes3'];
    $carteira = $_POST['carteira'];
    $agencia = $_POST['agencia'];
    $digito_ag = $_POST['digito_ag'];
    $conta = $_POST['conta'];  
    $digito_co = $_POST['digito_co'];  
    $tipo_carteira = $_POST['tipo_carteira'];  
    $convenio = $_POST['convenio'];
    $convenio_dv = $_POST['convenio_dv'];
    $contrato = $_POST['contrato'];
    $especie = $_POST['especie'];
    $lancarfaturas = $_POST['lancarfaturas'];
    $qtddiasrenovacaoboleto = $_POST['qtddiasrenovacaoboleto'];
	$token_gnet = $_POST['token_gnet'];    
	
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("banco='$banco',bancos_codigo='$bancos_codigo',bancos_layout='$bancos_layout',receberate='$receberate',instrucoes1='$instrucoes1',instrucoes2='$instrucoes2',instrucoes3='$instrucoes3', token_gnet = '$token_gnet', carteira='$carteira',agencia='$agencia',digito_ag='$digito_ag',conta='$conta',digito_co='$digito_co',tipo_carteira='$tipo_carteira',convenio='$convenio',convenio_dv='$convenio_dv',contrato='$contrato',especie='$especie',lancarfaturas='$lancarfaturas',qtddiasrenovacaoboleto='$qtddiasrenovacaoboleto'", "id='1'");
    
    header("Location: index.php?app=Sistema&reg=2");
    }
    
    if(isset ($_POST['editarapi'])){
    
    $smslogin = $_POST['smslogin'];
    $smssenha = $_POST['smssenha'];
    $emailspc = $_POST['emailspc'];
    $senhaspc = $_POST['senhaspc'];
    $apikey = $_POST['apikey'];
  
    
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("smslogin='$smslogin',smssenha='$smssenha',emailspc='$emailspc',senhaspc='$senhaspc',apikey='$apikey'", "id='1'"); 
    
    header("Location: index.php?app=Sistema&reg=2");
    }
    
    if(isset ($_POST['editarnfs'])){
    
    $fistel = $_POST['fistel'];
    $codtributo = $_POST['codtributo'];
    $codservico = $_POST['codservico'];
    $codmunicipio = $_POST['codmunicipio'];
    $naturezaop = $_POST['naturezaop'];
    $tipo = $_POST['tipo'];
    $serie = $_POST['serie'];
    $im = $_POST['im'];
    $opsimples = $_POST['opsimples'];
    $ic = $_POST['ic'];
    $modelonota = $_POST['modelonota'];
    
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("fistel='$fistel',codtributo='$codtributo',codservico='$codservico',codmunicipio='$codmunicipio',naturezaop='$naturezaop',tipo='$tipo',serie='$serie',im='$im',opsimples='$opsimples',ic='$ic',modelonota='$modelonota'", "id='1'");
    
    header("Location: index.php?app=Sistema&reg=2");
    }
    
    if(isset ($_POST['editarkey'])){
    
    $chave = $_POST['chave'];
    $regkey = $_POST['regkey'];
     
    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("chave='$chave',regkey='$regkey'", "id='1'"); 
    
    
    $nomeuser = $_POST['nomeuser'];
    $loginuser = $_POST['loginuser'];
    $senhauser = md5($_POST['senha']);
    $saltuser = base64_encode($_POST['senha']);
    $emailuser = $_POST['email'];
    
    $crud = new crud('usuarios'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nomeuser',login='$loginuser',senha='$senhauser',salt='$saltuser',email='$emailuser'", "id='1'");
    
    header("Location: index.php?app=Sistema&reg=2");
    }

if(isset ($_POST['edtaremail'])){

    $url        = $_POST['url'];
    $servidor   = $_POST['servidor'];
    $porta      = $_POST['porta'];
    $smtpsecure = $_POST['smtpsecure'];
    $endereco   = $_POST['endereco'];
    $limitemail = $_POST['limitemail'];
    $aviso      = $_POST['aviso'];
    $avisofataberto = $_POST['avisofataberto'];
    $email      = $_POST['email'];
    $senha      = $_POST['senha'];
    $text1      = $_POST['text1'];
    $text2      = $_POST['text2'];
    $text3      = $_POST['text3'];
    $text4      = $_POST['text4'];

    $crud = new crud('maile'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("url='$url',servidor='$servidor',porta='$porta',smtpsecure='$smtpsecure',endereco='$endereco',limitemail='$limitemail',aviso='$aviso',avisofataberto='$avisofataberto',email='$email',senha='$senha',text1='$text1',text2='$text2',text3='$text3',text4='$text4'", "id='1'");


    header("Location: index.php?app=Sistema&reg=2");
}

if(isset ($_POST['editarpesonalizacoes'])){

    $contrato_temporario=$_FILES["contratocliente"]["tmp_name"];
    $contrato_real=$_FILES["contratocliente"]["name"];
    copy($contrato_temporario,"assets/$contrato_real");

    if(!empty($contrato_real)){

        $contratocliente2  = $_POST['contratocliente2'];

        unlink(assets/$contratocliente2);


        $contratocliente   = $contrato_real;


        $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
        $crud->atualizar("contratocliente='$contratocliente'", "id='1'");

    }else{

    }

    header("Location: index.php?app=Sistema&reg=2");
}

if(isset ($_POST['tela_aviso'])){

    $avisotemporario = $_POST['avisotemporario'];
    $avisopermanente = $_POST['avisopermanente'];


    $crud = new crud('empresa'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("avisotemporario='$avisotemporario',avisopermanente='$avisopermanente'", "id='1'");

    header("Location: index.php?app=Sistema&reg=2");
}

    				
?>

<script type="text/javascript" src="assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        mode : "textareas",
        removed_menuitems: 'newdocument',
        selector: "textarea.mceEditor",
        relative_urls: false,
        convert_urls: false,
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });
</script>

<!--
<script src="assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({  mode : "textareas", editor_selector : "mceEditor",removed_menuitems: 'newdocument'});</script>
-->
<!--<script>tinymce.init({selector:'textarea'});</script> -->


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
    jQuery(function($){
        $(".nascimento").mask("99/99/9999");
        $(".cel").mask("(999)99999-9999");
        $(".tel").mask("(99)9999-9999");
        $(".cep").mask("99999-999");
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

</script>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li class="active">Sistema</li>
          </ul>
        </div>
        
        <?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> configurações alteradas com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Sistema MyRouter ERP<small> Configurações</small></h1>
        </div>
        
        <div class="powerwidget blue" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Ajustes do Sistema</h2>
              </header>
              
              <ul class="nav nav-tabs">
                      <li class="active"><a href="#one-normal" data-toggle="tab"><i class="fa fa-building"></i> Empresa</a></li>
                      <li><a href="#two-normal" data-toggle="tab"><i class="fa fa-money"></i> Boletos</a></li>
                      <li><a href="#three-normal" data-toggle="tab"><i class="fa fa-crosshairs"></i> API</a></li>
                      <li><a href="#five-normal" data-toggle="tab"><i class="fa fa-file-pdf-o"></i> Nota Fiscal</a></li>
                      <li><a href="#four-normal" data-toggle="tab"><i class="fa fa-lock"></i> Licença & Admin</a></li>
                      <li><a href="#six-normal" data-toggle="tab"><i class="fa fa-envelope"></i> Email</a></li>
                      <li><a href="#seven-normal" data-toggle="tab"><i class="fa fa-adjust"></i> Pesonalizações</a></li>
                      <li><a href="#eight-normal" data-toggle="tab"><i class="fa fa-pencil"></i> Telas/Aviso</a></li>


              </ul>
              
              
              <div class="tab-content">
                      <div class="tab-pane active" id="one-normal">
                      
                      <form action="" method="POST" enctype="multipart/form-data" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-4">
                      <label class="label">Nome da Empresa</label>
                      <label class="input">
                        <input type="text" name="empresa" value="<?php echo @$campo['empresa']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">CNPJ</label>
                      <label class="input">
                        <input type="text" name="cnpj" id="cpf" onblur="validarLogin('cpf', document.getElementById('cpf').value);" class="cpf" value="<?php echo @$campo['cnpj']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Inscrição Estadual</label>
                      <label class="input">
                        <input type="text" name="ie" value="<?php echo @$campo['ie']; ?>">
                      </label>
                    </section>
		    
                    <section class="col col-2">
                      <label class="label">Inscrição Municipal</label>
                      <label class="input">
                        <input type="text" name="im" value="<?php echo @$campo['im']; ?>">
                      </label>
                    </section>

                    <section class="col col-6">
                      <label class="label">Endereço</label>
                      <label class="input">
                        <input type="text" name="endereco" value="<?php echo @$campo['endereco']; ?>">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Número</label>
                          <label class="input">
                              <input type="text" name="numero" value="<?php echo @$campo['numero']; ?>" required>
                          </label>
                      </section>

                      <section class="col col-4">
                          <label class="label">Bairro</label>
                          <label class="input">
                              <input type="text" name="bairro" value="<?php echo @$campo['bairro']; ?>" required>
                          </label>
                      </section>
                    
                    <section class="col col-4">
                      <label class="label">Cidade</label>
                      <label class="input">
                        <input type="text" name="cidade" value="<?php echo @$campo['cidade']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Estado</label>
                      <label class="input">
                        <input type="text" name="estado" value="<?php echo @$campo['estado']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?>">
                      </label>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">Telefone</label>
                      <label class="input">
                        <input type="text" name="tel1"  class="tel" value="<?php echo @$campo['tel1']; ?>">
                      </label>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">Celular</label>
                      <label class="input">
                        <input type="text" name="tel2" class="maskcel" value="<?php echo @$campo['tel2']; ?>">
                      </label>
                    </section>
                       
                    <section class="col col-4">
                      <label class="label">Site</label>
                      <label class="input">
                        <input type="text" name="site" value="<?php echo @$campo['site']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-2">
                      <label class="label">Skype</label>
                      <label class="input">
                        <input type="text" name="skype" value="<?php echo @$campo['skype']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Fistel/Anatel</label>
                      <label class="input">
                        <input type="text" name="fistel" value="<?php echo @$campo['fistel']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">E-mail</label>
                      <label class="input">
                        <input type="text" name="email" value="<?php echo @$campo['email']; ?>">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Auto Bloqueio</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="dias_bloc" value="<?php echo @$campo['dias_bloc']; ?>">
                              <b class="tooltip tooltip-top-right">Insira a quantidade de dias que você queira, que o auto bloqueio execulte após o vencimento.</b> </label>
                          </label>
                      </section>


                      <section class="col col-4">
                          <label class="label">Logo Empresa</label>
                          <label class="input">
                              <input type="file" name="foto" id="foto">
                          </label>
                      </section>


                     <section class="col col-9">
                      <label class="label">Observação</label>
                      <label class="input">
                        <textarea class="form-control" name="obs" rows="3"><?php echo @$campo['obs']; ?></textarea>
                      </label>
                    </section>

                      <input type="hidden" name="foto2" id="foto2" value="<?= @$campo['foto']; ?>"/>
                      <section class="col col-3">
                          <label class="label">&nbsp;</label>
                          <label class="input">
                              <img src="<?php
                              if(empty($campo['foto'])){
                                  echo 'http://placehold.it/198x75images';
                              }else{
                                  echo 'assets/images/'.$campo['foto'].'';
                              }
                              ?>
                              " width="198" height="75" alt=""/>
                          </label>
                      </section>

                  </fieldset>
                  <footer>
 
		  <input type="submit" name="editarsistema" class="btn btn-primary" value="Atualizar">
	
                  </footer>
                </form>
                      
                      </div>
              
              	      
              	      <div class="tab-pane" id="two-normal">
              	      
              	      <form action="" method="POST" class="orb-form">
                  <fieldset>
              	      
              	      <section class="col col-3">
                      <label class="label">Banco Boleto</label>
                      <label class="select">
                      <select name="banco">
                      <option value="1" <?php if($campo[banco] == "1"){ echo  "selected";}?>>Banco do Brasil</option>
                      <option value="2" <?php if($campo[banco] == "2"){ echo  "selected";}?>>Bradesco</option>
                      <option value="3" <?php if($campo[banco] == "3"){ echo  "selected";}?>>Caixa Ecônomica Federal</option>
                      <option value="4" <?php if($campo[banco] == "4"){ echo  "selected";}?>>Itaú</option>
                      <option value="5" <?php if($campo[banco] == "5"){ echo  "selected";}?>>Santander</option>
                      <option value="6" <?php if($campo[banco] == "6"){ echo  "selected";}?>>Sicoob</option>
                      <option value="7" <?php if($campo[banco] == "7"){ echo  "selected";}?>>Sicredi</option>
                      <option value="8" <?php if($campo[banco] == "8"){ echo  "selected";}?>>HSBC</option>
                      <option value="9" <?php if($campo[banco] == "9"){ echo  "selected";}?>>Banco Real</option>
                      <!-- INSERCAO DE BANCO GRIFF SISTEMAS -->
                      <option value="10" <?php if($campo[banco] == "10"){ echo  "selected";}?>>GERENCIANET</option>
                      <!--  FIN INSERÇÃO DE BANCO -->
                      
                      <option value="99" <?php if($campo[banco] == "99"){ echo  "selected";}?>>Carnê</option>
                      </select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Receber Até</label>
                      <label class="input">
                        <input type="text" name="receberate" value="<?php echo @$campo['receberate']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Instruções 1</label>
                      <label class="input">
                        <input type="text" name="instrucoes1" value="<?php echo @$campo['instrucoes1']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Instruções 2</label>
                      <label class="input">
                        <input type="text" name="instrucoes2" value="<?php echo @$campo['instrucoes2']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Instruções 3</label>
                      <label class="input">
                        <input type="text" name="instrucoes3" value="<?php echo @$campo['instrucoes3']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Carteira</label>
                      <label class="input">
                        <input type="text" name="carteira" placeholder="Itau = 109 " value="<?php echo @$campo['carteira']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Agência</label>
                      <label class="input">
                        <input type="text" name="agencia" value="<?php echo @$campo['agencia']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Dig Agência</label>
                      <label class="input">
                        <input type="text" name="digito_ag" value="<?php echo @$campo['digito_ag']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Conta Cedente</label>
                      <label class="input">
                        <input type="text" name="conta" value="<?php echo @$campo['conta']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Dig Conta</label>
                      <label class="input">
                        <input type="text" name="digito_co" value="<?php echo @$campo['digito_co']; ?>">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Lançar faturas</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                          <label class="input">
                              <input type="text" name="lancarfaturas" value="<?php echo @$campo['lancarfaturas']; ?>" >
                              <b class="tooltip tooltip-top-right">Quantidade de dias antes do vencimento.</b> </label>
                          </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Qtd de Faturas à Gerar</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <label class="input">
                                  <input type="text" name="qtddiasrenovacaoboleto" value="<?php echo @$campo['qtddiasrenovacaoboleto']; ?>" >
                                  <b class="tooltip tooltip-top-right">Quantidade de fatura a ser gerado na renovação.</b> </label>
                          </label>
                      </section>


                      <section class="col col-3">
                          <label class="label">Especie de Recebimento</label>
                          <label class="select">
                              <select name="especie">
                                  <option value="DM" <?php if($campo[especie] == "DM"){ echo  "selected";}?>>DUPLICATA MERCANTIL</option>
                                  <option value="02" <?php if($campo[especie] == "02"){ echo  "selected";}?>>NOTA PROMISSÓRIO</option>
                                  <option value="03" <?php if($campo[especie] == "03"){ echo  "selected";}?>>NOTA DE SEGURO</option>
                                  <option value="04" <?php if($campo[especie] == "04"){ echo  "selected";}?>>MENSALIDADE ESCOLAR</option>
                                  <option value="05" <?php if($campo[especie] == "05"){ echo  "selected";}?>>RECIBO</option>
                                  <option value="06" <?php if($campo[especie] == "06"){ echo  "selected";}?>>CONTRATO</option>
                                  <option value="07" <?php if($campo[especie] == "07"){ echo  "selected";}?>>COSSEGUROS</option>
                                  <option value="08" <?php if($campo[especie] == "08"){ echo  "selected";}?>>DUPLICATA DE SERVIÇO</option>
                                  <option value="09" <?php if($campo[especie] == "09"){ echo  "selected";}?>>LETRA DE CÂMBIO</option>
                                  <option value="13" <?php if($campo[especie] == "13"){ echo  "selected";}?>>NOTA DE DÉBITO</option>
                                  <option value="15" <?php if($campo[especie] == "15"){ echo  "selected";}?>>DOCUMENTO DE DÍVIDA</option>
                                  <option value="16" <?php if($campo[especie] == "16"){ echo  "selected";}?>>ENCARGOS CONDOMINIAIS</option>
                                  <option value="17" <?php if($campo[especie] == "17"){ echo  "selected";}?>>CONTAS DE PRESTAÇÃO DE SERVIÇOS</option>
                                  <option value="99" <?php if($campo[especie] == "99"){ echo  "selected";}?>>DIVERSOS</option>
                              </select>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Código do Banco</label>
                          <label class="select">
                              <select name="bancos_codigo">
                                  <option value="104" <?php if($campo[bancos_codigo] == "104"){ echo  "selected";}?>>CAIXA</option>
                                  <option value="341" <?php if($campo[bancos_codigo] == "341"){ echo  "selected";}?>>ITAU</option>
                                  <option value="756" <?php if($campo[bancos_codigo] == "756"){ echo  "selected";}?>>SICOOB</option>
                              </select>
                          </label>
                      </section>


                      <section class="col col-3">
                          <label class="label">Layout do Banco</label>
                          <label class="select">
                              <select name="bancos_layout">
                                  <option value="cnab240_SIGCB" <?php if($campo[bancos_layout] == "cnab240_SIGCB"){ echo  "selected";}?>>CAIXA cnab240_SIGCB</option>
                                  <option value="cnab240" <?php if($campo[bancos_layout] == "cnab240"){ echo  "selected";}?>>ITAU cnab240</option>
                                  <option value="cnab400" <?php if($campo[bancos_layout] == "cnab400"){ echo  "selected";}?>>ITAU/SICOOB cnab400</option>
                              </select>
                          </label>
                      </section>

                      <!-- GRIFF SISTEMAS gerencianet otken -->
                      <section class="col col-6">
                          <!--  <strong>Obs: Preencher somente se escolher o gerencianet como opção</strong><br/>  -->
                      <label class="label">Token Gerêncianet</label>
                      <label class="input">
                        <input type="text" name="token_gnet" value="<?php echo @$campo['token_gnet']; ?>">
                      </label>
                    </section>
                      <!-- FIM DO TOKEM GERENCIANET -->
                      <br />
                      
                      <div class="col col-11">
                      <br><b>Obs: Alguns bancos não utilizam os campos abaixo. Caso o banco não utilize o campo, deixar em branco.</b><br><br>
                      </div>
                    
                    <section class="col col-3">
                      <label class="label">Tipo de Carteira</label>
                      <label class="input">
                        <input type="text" name="tipo_carteira" placeholder="SR / CR / RG (Com Registro Caixa)" value="<?php echo @$campo['tipo_carteira']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Convênio ou Código do Cedente</label>
                      <label class="input">
                        <input type="text" name="convenio" value="<?php echo @$campo['convenio']; ?>">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Dígito Convênio</label>
                          <label class="input">
                              <input type="text" name="convenio_dv" value="<?php echo @$campo['convenio_dv']; ?>">
                          </label>
                      </section>

                    <section class="col col-3">
                      <label class="label">Contrato</label>
                      <label class="input">
                        <input type="text" name="contrato" value="<?php echo @$campo['contrato']; ?>">
                      </label>
                    </section>

              	      </fieldset>
                  <footer>

		  <input type="submit" name="editarbancos" class="btn btn-primary" value="Atualizar">
	
                  </footer>
                </form>
              	      
              	      </div>
              	      
              	      
              	      <div class="tab-pane" id="three-normal">
              	      
              	      <form action="" method="POST" class="orb-form">
                      <fieldset>
                  
                   <section class="col col-2">
                      <label class="label">API Login SMS</label>
                      <label class="input">
                        <input type="text" name="smslogin" value="<?php echo @$campo['smslogin']; ?>">
                      </label>
                    </section> 
                    
                    <section class="col col-2">
                      <label class="label">API Senha SMS</label>
                      <label class="input">
                        <input type="text" name="smssenha" value="<?php echo @$campo['smssenha']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">API Login Serasa</label>
                      <label class="input">
                        <input type="text" name="emailspc" value="<?php echo @$campo['emailspc']; ?>">
                      </label>
                    </section> 
                    
                    <section class="col col-2">
                      <label class="label">API Senha Serasa</label>
                      <label class="input">
                        <input type="text" name="senhaspc" value="<?php echo @$campo['senhaspc']; ?>">
                      </label>
                    </section>
                  
                    
                    <section class="col col-3">
                      <label class="label">API Bling ERP</label>
                      <label class="input">
                        <input type="text" name="apikey" value="<?php echo @$campo['apikey']; ?>">
                      </label>
                    </section>
                    
                    
                  
                  </fieldset>
                  <footer>

		  <input type="submit" name="editarapi" class="btn btn-primary" value="Atualizar">
	
                  </footer>
                  </form>
                  </div>

              	      <div class="tab-pane" id="five-normal">
              	      
              	      <form action="" method="POST" class="orb-form">
                      <fieldset>
                  
                  
                      <section class="col col-4">
                      <label class="label">FISTEL (SICI ANATEL)</label>
                      <label class="input">
                        <input type="text" name="fistel" value="<?php echo @$campo['fistel']; ?>">
                      </label>
                    </section>


		   <section class="col col-2">
                      <label class="label">Cod Tributacao</label>
                      <label class="input">
                        <input type="text" name="codtributo" value="<?php echo @$campo['codtributo']; ?>">
                      </label>
                    </section>



		    <section class="col col-2">
                      <label class="label">Cod Serviço (RPS)</label>
                      <label class="input">
                        <input type="text" name="codservico" value="<?php echo @$campo['codservico']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Cod Municipio</label>
                      <label class="input">
                        <input type="text" name="codmunicipio" placeholder="IBGE" value="<?php echo @$campo['codmunicipio']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Nat Operação</label>
                      <label class="input">
                        <input type="text" name="naturezaop" placeholder="CFOP" value="<?php echo @$campo['naturezaop']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">NFSe Tipo</label>
                      <label class="input">
                        <input type="text" name="tipo" placeholder="1" value="<?php echo @$campo['tipo']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">NFSe Serie</label>
                      <label class="input">
                        <input type="text" name="serie" placeholder="A" value="<?php echo @$campo['serie']; ?>">
                      </label>
                    </section>

                          <section class="col col-2">
                              <label class="label">Modelo</label>
                              <label class="input">
                                  <input type="text" name="modelonota" placeholder="21" value="<?php echo @$campo['modelonota']; ?>">
                              </label>
                          </section>

                    
                    <section class="col col-2">
                      <label class="label">Inscrição Municipal</label>
                      <label class="input">
                        <input type="text" name="im" placeholder="Inscrição Municipal" value="<?php echo @$campo['im']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">O.P Simples</label>
                      <label class="input">
                        <input type="text" name="opsimples" placeholder="1 = SIM, 2 = NAO" value="<?php echo @$campo['opsimples']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Ins Cultural</label>
                      <label class="input">
                        <input type="text" name="ic" placeholder="1 = SIM, 2 = NAO" value="<?php echo @$campo['ic']; ?>">
                      </label>
                    </section>
                  
                  
                  </fieldset>
                  <footer>

		  <input type="submit" name="editarnfs" class="btn btn-primary" value="Atualizar">
	
                  </footer>
                  </form>
                  </div>
              	      
              	      <div class="tab-pane" id="four-normal">
              	      
              	      <form action="" method="POST" class="orb-form">
                      <fieldset>
                  
                  <section class="col col-6">
                      <label class="label">Chave de Registro</label>
                      <label class="input">
                        <input type="text" name="chave" value="<?php echo @$campo['chave']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-6">
                      <label class="label">Key de Registro</label>
                      <label class="input">
                        <input type="password" name="regkey" value="<?php echo @$campo['regkey']; ?>" required>
                      </label>
                    </section>
                    
                      <section class="col col-4">
                      <label class="label">Nome do Administrador</label>
                      <label class="input">
                        <input type="text" name="nomeuser" value="<?php echo @$admin['nome']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">E-mail do Administrador</label>
                      <label class="input">
                        <input type="text" name="email" value="<?php echo @$admin['email']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Login do Administrador</label>
                      <label class="input">
                        <input type="text" name="loginuser" value="<?php echo @$admin['login']; ?>" readonly required>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Senha do Administrador</label>
                      <label class="input">
                        <input type="password" name="senha" value="<?php echo base64_decode($admin['salt']); ?>" required>
                      </label>
                    </section>
                  
                  
                  
                  </fieldset>
                  <footer>

		  <input type="submit" name="editarkey" class="btn btn-primary" value="Atualizar">
	
                  </footer>
                  </form>
                  </div>


                  <div class="tab-pane" id="six-normal">

                      <form action="" method="POST" class="orb-form">
                          <fieldset>

                              <section class="col col-6">
                                  <label class="label">URL do Sistema</label>
                                  <label class="input">
                                      <input type="text" name="url" value="<?php echo @$camposemail['url']; ?>" required>
                                  </label>
                              </section>

                              <section class="col col-4">
                                  <label class="label">Servidor de Email</label>
                                  <label class="input">
                                      <input type="text" name="servidor" value="<?php echo @$camposemail['servidor']; ?>" required>
                                  </label>
                              </section>

                              <section class="col col-2">
                                  <label class="label">Portal SMTP</label>
                                  <label class="input">
                                      <input type="text" name="porta" value="<?php echo @$camposemail['porta']; ?>" required>
                                  </label>
                              </section>

                              <section class="col col-4">
                                  <label class="label">Email</label>
                                  <label class="input">
                                      <input type="text" name="email" value="<?php echo @$camposemail['email']; ?>" required>
                                  </label>
                              </section>

                              <section class="col col-2">
                                  <label class="label">Senha</label>
                                  <label class="input">
                                      <input type="password" name="senha" value="<?php echo @$camposemail['senha']; ?>" required>
                                  </label>
                              </section>


                              <section class="col col-4">
                                  <label class="label">Site</label>
                                  <label class="input">
                                      <input type="text" name="endereco" value="<?php echo @$camposemail['endereco']; ?>" required>
                                  </label>
                              </section>


                              <section class="col col-2">
                                  <label class="label">Limite de Email</label>
                                  <label class="input">
                                      <input type="text" name="limitemail" value="<?php echo @$camposemail['limitemail']; ?>">
                                  </label>
                              </section>

                              <section class="col col-2">
                                  <label class="label">SMTP Segurança</label>
                                  <label class="select">
                                      <select name="smtpsecure">
                                          <option <?php if(@$camposemail['smtpsecure'] == 'ssl' ){echo 'selected';}  ?> value="ssl">SSL</option>
                                          <option <?php if(@$camposemail['smtpsecure'] == 'tls' ){echo 'selected';}  ?> value="tls">TLS</option>
                                      </select>
                                  </label>
                              </section>


                              <section class="col col-4">
                                  <label class="label">Título do Aviso</label>
                                  <label class="input">
                                      <input type="text" name="aviso" value="<?php echo @$camposemail['aviso']; ?>">
                                  </label>
                              </section>

                              <section class="col col-4">
                                  <label class="label">Título do Reaviso</label>
                                  <label class="input">
                                      <input type="text" name="avisofataberto" value="<?php echo @$camposemail['avisofataberto']; ?>">
                                  </label>
                              </section>

                              <section class="col col-11">
                                  <label class="label">Modelo de Email Aviso de Fatura</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="text1" rows="25"><?php echo @$camposemail['text1']; ?></textarea>
                                  </label>
                              </section>

                              <section class="col col-11">
                                  <label class="label">Modelo de Email Reaviso de Fatura</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="text2" rows="20"><?php echo @$camposemail['text2']; ?></textarea>
                                  </label>
                              </section>

                              <section class="col col-11">
                                  <label class="label">Modelo de Email Cadastros</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="text3" rows="10"><?php echo @$camposemail['text3']; ?></textarea>
                                  </label>
                              </section>

                              <section class="col col-11">
                                  <label class="label">Modelo de Email Fatura GerenciaNet</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="text4" rows="10"><?php echo @$camposemail['text4']; ?></textarea>
                                  </label>
                              </section>


                  </fieldset>
                          <footer>

                              <input type="submit" name="edtaremail" class="btn btn-primary" value="Atualizar">

                          </footer>
                      </form>
                  </div>




                  <div class="tab-pane" id="seven-normal">

                      <form action="" method="POST" enctype="multipart/form-data" class="orb-form">
                          <fieldset>

                              <section class="col col-4">
                                  <label class="label">Contrato</label>
                                  <label class="input">
                                      <input type="file" name="contratocliente" id="contratocliente">
                                  </label>
                              </section>


                              <input type="hidden" name="contratocliente2" id="contratocliente2" value="<?= @$campo['contratocliente']; ?>"/>
                              <section class="col col-3">
                                  <label class="label">&nbsp;</label>
                                  <label class="input">

                                  </label>
                              </section>

                          </fieldset>
                          <footer>

                              <input type="submit" name="editarpesonalizacoes" class="btn btn-primary" value="Atualizar">

                          </footer>
                      </form>
                  </div>


                  <div class="tab-pane" id="eight-normal">

                      <form action="" method="POST" enctype="multipart/form-data" class="orb-form">
                          <fieldset>

                              <section class="col col-11">
                                  <label class="label">Tela De Aviso Temporário</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="avisotemporario" rows="10"><?php echo @$campo['avisotemporario']; ?></textarea>
                                  </label>
                              </section>

                              <section class="col col-11">
                                  <label class="label">Tela de Aviso Permanente</label>
                                  <label class="textarea">
                                      <textarea class="mceEditor" class="form-control" name="avisopermanente" rows="10"><?php echo @$campo['avisopermanente']; ?></textarea>
                                  </label>
                              </section>

                          </fieldset>
                          <footer>

                              <input type="submit" name="tela_aviso" class="btn btn-primary" value="Atualizar">

                          </footer>
                      </form>
                  </div>


              </div>
              
              
              
              <div class="inner-spacer">
                
              </div>
            </div>
            