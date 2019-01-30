<?php
    header("Content-Type: text/html; charset=ISO-8859-1", true);
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    require_once 'config/librouteros/RouterOS.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco


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
    
    $idass = base64_decode($_GET['id']);
    $asse = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$idass'");
    $assinatura = mysqli_fetch_array($asse);
    
    $plano = $assinatura['plano'];
    $cliente = $assinatura['cliente'];
    $pedido = $assinatura['pedido'];
    $vencimento = $assinatura['vencimento'];
    $ip = $assinatura['ip'];
    $mac = $assinatura['mac'];
    
    $pplano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $pp = mysqli_fetch_array($pplano);
    $nomeplano = $pp['nome'];
    $idservidor = $pp['servidor'];
    $upload = $pp['upload'];
    $download = $pp['download'];  
    $interface = $pp['interface']; 
    
    $clliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
    $cc = mysqli_fetch_array($clliente);
    $nome = $cc['nome'] . " | " . $cc['cpf'] . " Endereço: " . $cc['endereco'] . " " . $cc['numero'] . " " . $cc['cidade'] . " " . $cc['estado'];
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$idservidor'");
    $mk = mysqli_fetch_array($servidor);
    $nasip = $mk['ip'];


    function calcularParcelas($cliente, $pedido, $plano, $login, $ip, $mac, $precofn, $nParcelas, $dataPrimeiraParcela = null){
    if($dataPrimeiraParcela != null){
	$dataPrimeiraParcela = explode( "/",$dataPrimeiraParcela);
	$dia = $dataPrimeiraParcela[0];
	$mes = $dataPrimeiraParcela[1];
	$ano = $dataPrimeiraParcela[2];
  	} else {
	$dia = date("d");
	$mes = date("m");
	$ano = date("Y");
  	}

	$mysqli = new mysqli(HOST,LOGIN,SENHA,BANCO) or die("Não é Possivel Conecta ao Banco de Dados");

 	for($x = 1; $x <= $nParcelas; $x++){
  	$parcela = date("Y-m-d",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano)));

    //INICIO - nosso numero sequencial
    $qr_numero = $mysqli->query("SELECT * FROM financeiro ORDER BY id DESC");
    $row_numero = mysqli_fetch_array($qr_numero);
    $numero = str_pad($row_numero['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
    // FIM - nosso numero sequencial

 	$prd = explode( "-",$parcela);
 	$diafn = $prd[2];
 	$mesfn = $prd[1];
 	$anofn = $prd[0];
    $nossonumero = $numero;
 	
 	$cmm = ($mesfn - 01);
 	if($cmm == 0) {
 	$mescorre = '01';
 	} else { 
 	$mescorre = $cmm;
 	}
 	
 	 $data_inicial = date('Y-m-d');
 	 $data_final = $anofn."-".$mesfn."-".$diafn;
 	 $diferenca = strtotime($data_final) - strtotime($data_inicial);
 	 $dias = floor($diferenca / (60 * 60 * 24));
 	 
 	 $valorparcela = $precofn / 30;

		//////////// alteracoes gerencia net aqui //////

		$selbanco = $mysqli->query("SELECT * FROM empresa") or die(mysqli_error());
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
			$BairroCliente = $verCliente['baiiro'];
			$Uf = $verCliente['estado'];
			$CidadeCliente = $verCliente['cidade'];
			$valorG = limpavariavel($precofn);
			//$dataG = $_POST['vencimento'];
			$retorno = intval($nossonumero);

			$parcel = $diafn."/".$mesfn."/".$anofn;

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
    				<numero></numero>
    				<bairro>$BairroCliente</bairro>
    				<complemento></complemento>
    				<estado>$Uf</estado>
    				<cidade>$CidadeCliente</cidade>
    			</opcionais>
    		</cliente>
    	</clientes>
    	<itens>
    		<item>
    			<descricao>Mensalidade de Internet</descricao>
    			<valor>$valorG</valor>
    			<qtde>1</qtde>
    			<desconto>0</desconto>
    		</item>
    	</itens>
    	<vencimento>$parcel</vencimento>
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

			$statusCod = $objXml->statusCod;

			$chave = $objXml->resposta->cobrancasGeradas->cliente->cobranca->chave;
			// pega o link
			$linkGerencia = $objXml->resposta->cobrancasGeradas->cliente->cobranca->link;
		}

		// fim gerencia net


		if(isset($statusCod ) && $statusCod == 1 ){
			exit("Fatura já lançada pelo GerenciaNet");
		}else {

			if($chave != "" && $linkGerencia != "" && $confere['banco'] == "10") {
				$crud = new crud('financeiro');  // tabela como parametro
				$crud->inserir("nfatura,cadastro,mesparcela,cliente,pedido,vencimento,dia,mes,ano,plano,login,ip,mac,valor,boleto,situacao,status,avulso,chave,linkGerencia",
					"'$x','$data_inicial','$mescorre','$cliente','$pedido','$parcela','$diafn','$mesfn','$anofn','$plano','$login','$ip','$mac','$precofn','$nossonumero','N','A', '0','$chave','$linkGerencia'");
			}

		}

		if($confere['banco'] != "10") {
			$crud = new crud('financeiro');  // tabela como parametro
			$crud->inserir("nfatura,cadastro,mesparcela,cliente,pedido,vencimento,dia,mes,ano,plano,login,ip,mac,valor,boleto,situacao,status,avulso",
				"'$x','$data_inicial','$mescorre','$cliente','$pedido','$parcela','$diafn','$mesfn','$anofn','$plano','$login','$ip','$mac','$precofn','$nossonumero','N','A','0'");
		}

/*  	if(mysql_query("INSERT INTO financeiro (nfatura,cadastro,mesparcela,cliente,pedido,vencimento,dia,mes,ano,plano,login,ip,mac,valor,boleto,situacao,status,avulso) VALUES ('$x','$data_inicial','$mescorre','$cliente','$pedido','$parcela','$diafn','$mesfn','$anofn','$plano','$login','$ip','$mac','$precofn','$nossonumero','N','A','0')"))
  	{
  	} else {
	die("Erro ao inserir a parcela ".$x.": ".mysql_error());
  	}*/
	}//for
	}//function

	if ($desconto <> '') {
  	$precofn = ($pp['preco'] - $desconto);
	} elseif ($acrescimo <> '') {
  	$precofn = ($pp['preco'] + $acrescimo);
	} else {
	$precofn = $pp['preco'];  
	}    	
	$mmj = date('m');
	$aaj = date('Y');

	$selempresa = $mysqli->query("SELECT * FROM empresa") or die(mysqli_error());
	$empresa_selec =  mysqli_fetch_array($selempresa);
	$qtddiasrenovacaoboleto = $empresa_selec ['qtddiasrenovacaoboleto'];


	calcularParcelas($cliente,$pedido,$plano,$login,$ip,$mac,$precofn,$qtddiasrenovacaoboleto,"$vencimento/$mmj/$aaj");

	header("Location: index.php?app=Assinaturas&reg=4");
?>