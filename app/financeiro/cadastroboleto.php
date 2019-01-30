<?php

    $idpuser = $logado['nome']; // pegar nome do login da sessão

	
	/////////////////////////// FUNÇÕES GRIFF SISTEMAS /////////////////

		function limpavariavel($valor){
		 $valor = trim($valor);
		 $valor = str_replace(".", "", $valor);
		 $valor = str_replace(",", "", $valor);
		 $valor = str_replace("-", "", $valor);
		 $valor = str_replace("/", "", $valor);
		 $valor = str_replace("(", "", $valor);
		 $valor = str_replace(")", "", $valor);
		 return $valor;
		}

	//////////////// fim da função griff ///////////////
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM financeiro WHERE id = + $getId");
        $campo = mysqli_fetch_array($alterar);
    }

    if(isset ($_POST['cadastrar'])){
     $nfatura = $_POST['nfatura'];
     $cliente = $_POST['cliente'];

     //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
     $data   = $_POST['vencimento'];
     $data_conv = substr($data,6,7).'-'.substr($data,3,2).'-'.substr($data,0,2);
     $vencimento = $data_conv;
     $cadastro = date('Y-m-d');
     //FIM DA CONVERSÃO

     //INICIO - nosso numero sequencial
     $qr_numero = $mysqli->query("SELECT * FROM financeiro ORDER BY id DESC");
     $row_numero = mysqli_fetch_array($qr_numero);
     $numero = str_pad($row_numero['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
     // FIM - nosso numero sequencial
     $nossonumero = $numero;


     $dia = date('d',strtotime($vencimento));
     $mes = date('m',strtotime($vencimento));
     $ano = date('Y',strtotime($vencimento));
     $mes1 = date('n',strtotime($vencimento));

     $bservidor = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$cliente'");
     $linhas = mysqli_fetch_array($bservidor);
     $cliente = $linhas['cliente'];
     $plano = $linhas['plano'];
     $pedido = $linhas['pedido'];
     $login = $linhas['login'];
     $valor = $_POST['valor'];
     $descricao = $_POST['descricao'];
     $mesparcela = $_POST['mesparcela'];
	 
	 ////////////////////////////////////////////////////////////////////////////////////////////////////
	 //
	 /*		                    CODIGOS ELSON - CODIGO PARA EMISSAO PELO GERENCIA NET                   /                           /*
	 /							                                                                        */
	 ////////////////////////////////// /////////////////////////////////////////////////////////////////
	 
	  // -> verificar se o banco é o gerencianet => Banco 10
	 
	 $selbanco = $mysqli->query("SELECT banco FROM empresa") or die(mysqli_error());
	 	$confere = mysqli_fetch_array($selbanco);
		
	 if($confere['banco'] == "10"){
	 $url = "https://integracao.gerencianet.com.br/xml/boleto/emite/xml";
	 
	 // SELECIONA A TABELA "empresa" E PEGA O TOKEM
	 $sql = $mysqli->query("SELECT token_gnet FROM empresa") or die(mysqli_error());
	 $t = mysqli_fetch_array($sql);
	 		$token = $t['token_gnet'];
	 
	 // PEGA OS DADOS DO CLIENTE PARA O GERENCIANET
	 $cli = $mysqli->query("SELECT * FROM clientes WHERE id='$cliente'") or die(mysqli_error());
	 $verCliente = mysqli_fetch_array($cli);
	 	$NomeCliente = $verCliente['nome'];
		$CpfCnpj = limpavariavel($verCliente['cpf']);
		$cel = limpavariavel($verCliente['cel']);
		$email = $verCliente['email'];
		$cep = limpavariavel($verCliente['cep']);
		$EnderecoCliente = $verCliente['endereco'];
        $NumeroCliente = $verCliente['numero'];
        $ComplementoCliente = $verCliente['complemento'];
		$BairroCliente = $verCliente['bairro'];
		$Uf = $verCliente['estado'];
		$CidadeCliente = $verCliente['cidade'];
		$valorG = limpavariavel($_POST['valor']);
		$dataG = $_POST['vencimento'];
		$retorno = intval($nossonumero);
	 
	 
	 // GERANDO O XML PARA O GERENCIA NET
	 $xml = "<?xml version='1.0' encoding='utf-8'?>
    <boleto>
    	<token>$token</token>
    	<clientes>
    		<cliente>
    			<nomeRazaoSocial>$NomeCliente</nomeRazaoSocial>
    			<cpfcnpj>$CpfCnpj</cpfcnpj>
    			<cel>$cel</cel>
    			<opcionais>
    				<email>$email</email>
    				<cep>$cep</cep>
    				<rua>$EnderecoCliente</rua>
    				<numero>$NumeroCliente</numero>
    				<bairro>$BairroCliente</bairro>
    				<complemento>$ComplementoCliente</complemento>
    				<estado>$Uf</estado>
    				<cidade>$CidadeCliente</cidade>
    			</opcionais>
    		</cliente>
    	</clientes>
    	<itens>
    		<item>
    			<descricao>$descricao</descricao>
    			<valor>$valorG</valor>
    			<qtde>1</qtde>
    			<desconto>0</desconto>
    		</item>
    	</itens>
    	<vencimento>$dataG</vencimento>
    	<opcionais>
    		<contra>n</contra>
    		<btaxa>n</btaxa>
    		<enviarParaMim>s</enviarParaMim>
            <continuarCobrando>0</continuarCobrando>
            <correios>n</correios>
    	</opcionais>
    </boleto>";
	
	//// VALIDANDO O XML NO GERENCIA NET
	$xml = str_replace("\n", '', $xml);
    $xml = str_replace("\r",'',$xml);
    $xml = str_replace("\t",'',$xml); 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    $data = array('entrada' => $xml);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, 'seu agente');
    $resposta = curl_exec($ch);
    curl_close($ch); 
	$resposta;
	
	 $objXml = simplexml_load_string($resposta);
	// confere se deu erro;	
	if($objXml->statusCod == 1){ // 1 para erro e 2 sem erro
			print "
				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?app=CadastroBoleto'>
				<script type=\"text/javascript\">
				alert(\"ERRO! Ocorreu um erro ao gerar a fatura. Por favor tente novamente.\");
				</script>";
				exit;
	}
	//pega a chave
	$chave = $objXml->resposta->cobrancasGeradas->cliente->cobranca->chave;
	// pega o link
	$linkGerencia = $objXml->resposta->cobrancasGeradas->cliente->cobranca->link;

	} // fim da verificação do banco


        // FUNCAO DE LOG INICIO
        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
        $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','INSERT','CRIOU UM  BOLETO ".$login."', NULL)");
        // FUNCAO DE LOG FIM


    if($chave != "" && $linkGerencia != "" && $confere['banco'] == "10"){

     $crud = new crud('financeiro');  // tabela como parametro
     $crud->inserir("descricao,cliente,pedido,vencimento,cadastro,dia,mes,ano,plano,login,valor,mesparcela,boleto,situacao,status, avulso,admin,chave,linkGerencia",
            "'$descricao','$cliente','$pedido','$vencimento','$cadastro','$dia','$mes','$ano','$plano','$login','$valor','$mes1','$nossonumero','N','A','1','$idpuser','$chave','$linkGerencia'");

        }
    if($confere['banco'] != "10") {
     $crud = new crud('financeiro');  // tabela como parametro
     $crud->inserir("descricao,cliente,pedido,vencimento,cadastro,dia,mes,ano,plano,login,valor,mesparcela,boleto,situacao,status, avulso,admin,chave,linkGerencia",
	 "'$descricao','$cliente','$pedido','$vencimento','$cadastro','$dia','$mes','$ano','$plano','$login','$valor','$mes1','$nossonumero','N','A','1','$idpuser','$chave','$linkGerencia'");

    }
     header("Location: index.php?app=Financeiro");

    }

    if(isset ($_POST['editar'])){
    


    header("Location: index.php?app=Boletos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('boletos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    $codigo = base64_decode($_GET['codigo']);
    
    header("Location: index.php?app=Boletos&reg=3");
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
            <li><a href="?app=Boletos">Boletos</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['ft2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Boleto</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Boletos</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>

                    <section class="col col-4">
                      <label class="label">Login da Assinatura</label>
                      <label class="select">
                      <select id="cliente" name="cliente" class="selectpicker form-control" data-live-search="true" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $bservidor = mysql_query("SELECT * FROM assinaturas order by login ASC");
 		      while($srv = mysql_fetch_array($bservidor)){

		      ?>
		      <option value="<?php echo $srv['id']; ?>" <?php if ($campo['cliente'] == $srv['id']) { echo "selected"; } ?>><?php echo $srv['login']; ?> | <?php echo'Dia Venc. ';echo $srv['vencimento']; ?></option>

		      <?php } ?> 
 		      </select>
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Vencimento</label>
                          <label class="input">
                              <input type="text" name="vencimento" class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vencimento'])); ?><?php } ?>" required>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Valor</label>
                          <label class="input">
                              <input type="text" name="valor" onKeyUp="moeda(this);" value="<?php echo @$campo['valor']; ?>" required>
                          </label>
                      </section>

                      <section class="col col-4">
                          <label class="label">Descrição</label>
                          <label class="input">
                              <input type="text" name="descricao"  value="<?php echo @$campo['descricao']; ?>" required>
                          </label>
                      </section>


                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="boletoid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="pedido" value="<?php echo @$campo['boleto']; ?>"> 
		  <input type="hidden" name="tipo" value="<?php echo @$campo['tipo']; ?>"> 
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
            