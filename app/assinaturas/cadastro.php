<?php

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


    $idpuser = $logado['nome']; // pegar nome do login da sess?o
    $idempresa = $_SESSION['empresa'];

    //gerar numero  de pedido
    $qr_numero = $mysqli->query("SELECT * FROM assinaturas ORDER BY id DESC");
    $row_numero = mysqli_fetch_array($qr_numero);
    $numero = str_pad($row_numero['id']+1, 9, 0, STR_PAD_LEFT);// tamanho 9
    $pedido =$numero;


    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM assinaturas WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $cliente = $_POST['cliente'];
    $plano = $_POST['plano'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $servidor = $_POST['servidor'];
    $tipo = $_POST['tipo'];
    $ip = $_POST['ip'];
    $routeip = $_POST['routeip'];
	$ipv6 = $_POST['ipv6'];
    $mac = $_POST['mac'];
    $vencimento = $_POST['vencimento'];
    $bloqueio = "10";
    $macwireless = $_POST['macwireless'];
    $chavewpa = $_POST['chavewpa'];
    $observacao = $_POST['observacao'];
    $insento = $_POST['insento'];
    $autobloqueio = $_POST['autobloqueio'];
    $alterarsenha = $_POST['alterarsenha'];
    $desconto = $_POST['desconto'];
    $acrescimo = $_POST['acrescimo'];
    $ippool = $_POST['ippool'];
    $ip_ubnt = $_POST['ip_ubnt'];
    $porta_ubnt = $_POST['porta_ubnt'];
    $login_ubnt = $_POST['login_ubnt'];
    $senha_ubnt = $_POST['senha_ubnt'];
    $situacao = "S";


    $hjs = date('d/m/Y', strtotime("+30 days")); // 30 Dias P?s Pago
    $data_nova = explode("/",$hjs);
    $datavencimento = $data_nova[2].$data_nova[1].$data_nova[0];
    
    $status = $_POST['status'];
    
    $crud = new crud('assinaturas');  // tabela como parametro
    $crud->inserir("empresa,pedido,cliente,plano,login,senha,servidor,endereco,numero,bairro,complemento,cidade,estado,cep,tipo,ip,routeip,ipv6,mac,vencimento,bloqueio,macwireless,chavewpa,observacao,insento,autobloqueio,alterarsenha,desconto,acrescimo,ippool,ip_ubnt,porta_ubnt,login_ubnt,senha_ubnt,situacao,datavencimento,status", "'$empresa','$pedido','$cliente','$plano','$login','$senha','$servidor','$endereco','$numero','$bairro','$complemento','$cidade','$estado','$cep','$tipo','$ip','$routeip','$ipv6','$mac','$vencimento','$bloqueio','$macwireless','$chavewpa','$observacao','$insento','$autobloqueio','$alterarsenha','$desconto','$acrescimo','$ippool','$ip_ubnt','$porta_ubnt','$login_ubnt','$senha_ubnt','$situacao','$datavencimento','$status'");

     // FUNCAO DE LOG INICIO
     $ipremoto = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
     $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
     $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ipremoto."', '".$hora."','INSERT','CRIOU O ASSINANTE ".$login."', NULL)");
     // FUNCAO DE LOG FIM

    $query1 = $mysqli->query("SELECT MAX(ID) as id FROM assinaturas");
    $dados1 = mysqli_fetch_assoc($query1);
    $ultimoid = $dados1['id'];
        
    $problema = "Nova Instalação de Internet";
    $servico = "Nova Instalação de Internet";
    $serie = "INSTALAÇÃO NOVA";
    $empresa = $_SESSION['empresa'];
    $emissao = date('d/m/Y H:i:s');
    $horaemissao = date("H:i:s");
    
    $crud = new crud('ordemservicos');  // tabela como parametro
    $crud->inserir("codigo,assinatura,cliente,plano,tecnico,emissao,servico,problema,atendente,situacao,status,serie,empresa", "'$pedido','$ultimoid','$cliente','$plano','1','$emissao','$servico','$problema','$idpuser','NI','S','$serie','$empresa'");
     
    $pplano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $pp = mysqli_fetch_array($pplano);
    $nomeplano = $pp['nome'];
    $idservidor = $pp['servidor'];
    $upload = $pp['upload'];
    $download = $pp['download'];  
    $interface = $pp['interface']; 
    $tiposervidor = $pp['tiposervidor'];
    $policein = $pp['policein'];
    $policeout = $pp['policeout'];

        $clliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
    $cc = mysqli_fetch_array($clliente);
    $nome = $cc['nome'] . " | " . $cc['cpf'] . " Endereço: " . $cc['endereco'] . " " . $cc['numero'] . " " . $cc['cidade'] . " " . $cc['estado'];
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$idservidor'");
    $mk = mysqli_fetch_array($servidor);
    $nasip = $mk['ip'];
    
    // Radius 

    $mdsenha = md5($senha);
   
    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','MD5-Password',':=','$mdsenha','$pedido'");
    //if($idservidor <> '') {
    //$crud = new crud('radcheck');  // tabela como parametro
    //$crud->inserir("username,attribute,op,value,pedido", "'$login','NAS-IP-Address','==','$nasip','$pedido'");
    //}
    if($mac <> '') {
    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Calling-Station-Id','==','$mac','$pedido'");
    }

    if($ip <> '') {
    $crud = new crud('radreply');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-IP-Address',':=','$ip','$pedido'");
    }

    if($routeip <> '') {
    $crud = new crud('radreply');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-Route','+=','$routeip','$pedido'");
    }

	if($ipv6 <> '') {
    $crud = new crud('radreply');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-IPv6-Prefix',':=','$ipv6','$pedido'");
    }

    if ($tiposervidor == "JUNIPER") {

        $crud = new crud('radreply');  // tabela como parametro
        $crud->inserir("username,attribute,op,value,pedido", "'$login','ERX-Ingress-Policy-Name','==','$policein','$pedido'");
        $crud->inserir("username,attribute,op,value,pedido", "'$login','ERX-Egress-Policy-Name','==','$policeout','$pedido'");

    }else {
        $crud = new crud('radusergroup');  // tabela como parametro
        $crud->inserir("username,groupname,priority,pedido", "'$login','$nomeplano','1','$pedido'");
    }


     if($macwireless <> '') {
     $crud = new crud('radcheck');  // tabela como parametro
     $crud->inserir("username,attribute,op,value,pedido", "'$macwireless','Password','==','$macwireless','$pedido'");
     }
     if($chavewpa <> '') {
     $crud = new crud('radreply');  // tabela como parametro
     $crud->inserir("username,attribute,op,value,pedido", "'$macwireless','Mikrotik-Wireless-PSK',':=','$chavewpa','$pedido'");
        }

     if($ippool <> '') {
     $crud = new crud('radcheck');  // tabela como parametro
     $crud->inserir("username,attribute,op,value,pedido", "'$login','Pool-Name',':=','$ippool','$pedido'");
     }

    // FIm Radius 

    // INI LOGIN UBNT
    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Cleartext-Password',':=','$senha','$pedido'");

    // FIM LOGIN UBNT
    
    if($insento == 'S') { } else { 
    
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
 
 	for($x = 1; $x <= $nParcelas; $x++){
  	$parcela = date("Y-m-d",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano)));

    //INICIO - nosso numero sequencial
    $qr_numero = mysql_query("SELECT * FROM financeiro ORDER BY id DESC");
    $row_numero = mysql_fetch_array($qr_numero);
    $numero = str_pad($row_numero['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
    // FIM - nosso numero sequencial

 	$prd = explode( "-",$parcela);
 	$diafn = $prd[2];
 	$mesfn = $prd[1];
 	$anofn = $prd[0];
 	//$nossonumero = $pedido."".$x."".$cliente;
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
	
	$selbanco = mysql_query("SELECT * FROM empresa") or die(mysql_error());
	 $confere = mysql_fetch_array($selbanco);
	
	 if($confere['banco'] == "10"){
	 $url = "https://integracao.gerencianet.com.br/xml/boleto/emite/xml";
	 
	// SELECIONA A TABELA "empresa" E PEGA O TOKEM
	 $sql = mysql_query("SELECT token_gnet FROM empresa") or die(mysql_error());
	 $t = mysql_fetch_array($sql);
	 		$token = $t['token_gnet'];
	 
	 // PEGA OS DADOS DO CLIENTE PARA O GERENCIANET
	 $cliente = $_POST['cliente'];
	 $cli = mysql_query("SELECT * FROM clientes WHERE id='$cliente'") or die(mysql_error);
	 $verCliente = mysql_fetch_array($cli);
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
		$valorG = limpavariavel($precofn);
		//$dataG = $_POST['vencimento'];
		$retorno = intval($nossonumero);
		
/* 		$vencimento = explode("-",$parcela);
	 		$diap = $vencimento[2];
			$mesp = $vencimento[1];
			$anop?= $vencimento[0]; */
			
			
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
	 
	$chave = $objXml->resposta->cobrancasGeradas->cliente->cobranca->chave;
	// pega o link
	$linkGerencia = $objXml->resposta->cobrancasGeradas->cliente->cobranca->link; 
	 
	} // fim da verificação do banco

        if($chave != "" && $linkGerencia != "" && $confere['banco'] == "10") {
            $crud = new crud('financeiro');  // tabela como parametro
            $crud->inserir("descricao,nfatura,cadastro,mesparcela,cliente,pedido,vencimento,dia,mes,ano,plano,login,ip,mac,valor,boleto,situacao,status,avulso,chave,linkGerencia",
                "'Mensalidade de Internet','$x','$data_inicial','$mescorre','$cliente','$pedido','$parcela','$diafn','$mesfn','$anofn','$plano','$login','$ip','$mac','$precofn','$nossonumero','N','A','0','$chave','$linkGerencia'");

        }
     ////
        if($confere['banco'] != "10") {
            $crud = new crud('financeiro');  // tabela como parametro
            $crud->inserir("descricao,nfatura,cadastro,mesparcela,cliente,pedido,vencimento,dia,mes,ano,plano,login,ip,mac,valor,boleto,situacao,status,avulso,chave,linkGerencia",
                "'Mensalidade de Internet','$x','$data_inicial','$mescorre','$cliente','$pedido','$parcela','$diafn','$mesfn','$anofn','$plano','$login','$ip','$mac','$precofn','$nossonumero','N','A','0','$chave','$linkGerencia'");

        }

//        else {
//           // die("Erro ao inserir a parcela ".$x.": ".mysql_error());
//
//            print "
//				<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?app=Assinaturas'>
//				<script type=\"text/javascript\">
//				alert(\"ERRO! Ocorreu um erro ao gerar as fatura para o Assinante.\");
//				</script>";
//            exit;
//        }
     /////

	}//for
	}//function
	$cliente = $_POST['cliente'];
	$plano = $_POST['plano'];
	
	if ($desconto <> '') {
  	$precofn = ($pp['preco'] - $desconto);
	} elseif ($acrescimo <> '') {
  	$precofn = ($pp['preco'] + $acrescimo);
	} else {
	$precofn = $pp['preco'];  
	}    	
	$mmj = date('m');
	$aaj = date('Y');
	calcularParcelas($cliente,$pedido,$plano,$login,$ip,$mac,$precofn,3,"$vencimento/$mmj/$aaj");
	
	} // FIM INSENTO
    $plano = $_POST['plano'];
    $pplano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $pp = mysqli_fetch_array($pplano);
    $nomeplano = $pp['nome'];
    $idservidor = $pp['servidor'];
    $idplano = $pp['id'];
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$idservidor'");
    $mk = mysqli_fetch_array($servidor);
    
    $rede = $mk['interface'];

        /*
       $router   = $mk['ip'];
       $username = $mk['login'];
       $password = $mk['senha'];
       $mikrotik = new Lib_RouterOS();
       $mikrotik->setDebug(false);



       if ($_POST['tipo'] == 'HOTSPOT') {

       $API = new routeros_api();
       $API->debug = false;
       if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].'')) {
       $API->write('/ip/hotspot/user/add',false);
       $API->write('=name='.$login.'',false );
       $API->write('=password='.$senha.'',false );
       if($ip <> '') {
       $API->write('=address='.$ip.'',false );
       }
       if($mac <> '') {
       $API->write('=mac-address='.$mac.'',false );
       }
       $API->write('=profile='.$nomeplano.'',false );
       $API->write('=comment='.$nome.'' );
       $ARRAY = $API->read();
       }
       }

       if ($_POST['tipo'] == 'PPPoE') {

       // Comando
       $command = '/ppp/secret/add';
       $args    = array('name'=> "$login", 'password'=> "$senha", 'service'=> 'pppoe', 'caller-id'=> "$mac", 'profile'=> "$nomeplano", 'comment'=> "$nome");

       try {
       $mikrotik->connect($router);
       $mikrotik->login($username, $password);
       $mikrotik->send($command, $args);
       $response = $mikrotik->read();
       } catch (Exception $ex) {
       // "Debug: " . $ex->getMessage() . "\n";
       }
       // Fim Comando


       }

       if ($_POST['tipo'] == 'IPARP') {

       $ip = $_POST['ip'];
       $mac = $_POST['mac'];
       $descricao = "Controle de Banda IP/ARP Cliente: $nome";

       $crud = new crud('controlebanda');  // tabela como parametro
       $crud->inserir("cliente,plano,pedido,ip,download,upload", "'$cliente','$idplano','$pedido','$ip','$download','$upload'");

       // Comando
       $command = '/ip/arp/add';
       $args    = array('address'=> "$ip", 'mac-address'=> "$mac", 'interface'=> "$rede", 'comment'=> "$nome");
       $command2 = '/queue/simple/add';
       $args2    = array('target-addresses'=> "$ip", 'name'=> "$pedido", 'max-limit'=> ''.$upload.'k/'.$download.'k', 'comment'=> "$nome");

       try {
       $mikrotik->connect($router);
       $mikrotik->login($username, $password);
       $mikrotik->send($command, $args);
       $mikrotik->send($command2, $args2);
       $response = $mikrotik->read();
       } catch (Exception $ex) {
       // "Debug: " . $ex->getMessage() . "\n";
       }
       // Fim Comando

       }
       */
    
        $eqps = $_POST['equipamento'];
	for ($i=0; $i<count($eqps); $i++) {

	$qtds = $_POST['qtd'];
	for ($i=0; $i<count($qtds); $i++) {

	$obss = $_POST['obs'];
	for ($i=0; $i<count($obss); $i++) {
        
        $crud = new crud('instalacao_equipamentos');  
        $crud->inserir("assinatura,equipamento,qtd,obs", "'$pedido','$eqps[$i]','$qtds[$i]','$obss[$i]'");
        
        }}}
  
       
    header("Location: index.php?app=Assinaturas&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $cliente = $_POST['cliente'];
    $plano = $_POST['plano'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $servidor = $_POST['servidor'];
    $tipo = $_POST['tipo'];
    $ip = $_POST['ip'];
    $routeip = $_POST['routeip'];
    $ipv6 = $_POST['ipv6'];
    $mac = $_POST['mac'];
    $vencimento = $_POST['vencimento'];
    $bloqueio = $_POST['bloqueio'];
    $macwireless = $_POST['macwireless'];
    $chavewpa = $_POST['chavewpa'];
    $observacao = $_POST['observacao'];
    $insento = $_POST['insento'];
    $autobloqueio = $_POST['autobloqueio'];
    $alterarsenha = $_POST['alterarsenha'];
    $desconto = $_POST['desconto'];
    $acrescimo = $_POST['acrescimo'];
    $ippool = $_POST['ippool'];
    $ip_ubnt = $_POST['ip_ubnt'];
    $porta_ubnt = $_POST['porta_ubnt'];
    $login_ubnt = $_POST['login_ubnt'];
    $senha_ubnt = $_POST['senha_ubnt'];
    $assinaturaid = $_POST['assinaturaid'];
    $status = $_POST['status'];

        //CONSULTANDO NO BANCO DE DADOS
        $pedido = $_POST['pedido'];
        $assinaturas = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$pedido'");
        $ass = mysqli_fetch_array($assinaturas);
        $ppp = $ass['pedido'];
        $campoIP = $ass['ip'];
        $campoRouterIP = $ass['routeip'];
        $campoIPv6 = $ass['ipv6'];
        $campoMac = $ass['mac'];
        $campoMacWireless = $ass['macwireless'];
        $campoChaveWpa = $ass['chavewpa'];
        $campoIppool = $ass['ippool'];
        $campoStatus = $ass['status'];

        // INICIO DA FUN??O DESATIVAR LOGIN
        if($status == 'S') {

        }else {
            $crud = new crud('radcheck');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Auth-Type',':=','Reject','$pedido'");
        }
        if($status == 'S'){
            $crud = new crud('radcheck'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Auth-Type'"); // exclui o registro com o id que foi passado
        }
       // var_dump($_POST);

        // FIM DA FUN??O DESATIVAR LOGIN

        if($campoIP == '') {
            $crud = new crud('radreply');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-IP-Address',':=','$ip','$pedido'");

        }else {
            $crud = new crud('radreply'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',value='$ip'", "pedido='$pedido' AND attribute = 'Framed-IP-Address'");

        }
        if($ip == ''){
            $crud = new crud('radreply'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Framed-IP-Address'"); // exclui o registro com o id que foi passado
        }


        if($campoRouterIP == '') {
            $crud = new crud('radreply');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-Route','+=','$routeip','$pedido'");

        }else {
            $crud = new crud('radreply'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',value='$routeip'", "pedido='$pedido' AND attribute = 'Framed-Route'");

        }
        if($routeip == ''){
            $crud = new crud('radreply'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Framed-Route'"); // exclui o registro com o id que foi passado
        }


        if($campoIPv6 == '') {
            $crud = new crud('radreply');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Framed-IPv6-Prefix',':=','$ipv6','$pedido'");

        }else {
            $crud = new crud('radreply'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',value='$ipv6'", "pedido='$pedido' AND attribute = 'Framed-IPv6-Prefix'");

        }
        if($ipv6 == ''){
            $crud = new crud('radreply'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Framed-IPv6-Prefix'"); // exclui o registro com o id que foi passado
        }

        if($campoMac == '') {
            $crud = new crud('radcheck');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Calling-Station-Id','==','$mac','$pedido'");

        }else {
            $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',value='$mac'", "pedido='$pedido' AND attribute = 'Calling-Station-Id'");

        }
        if($mac == ''){
            $crud = new crud('radcheck'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Calling-Station-Id'"); // exclui o registro com o id que foi passado
        }

        if($campoMacWireless == '') {
            $crud = new crud('radcheck');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$macwireless','Password','==','$macwireless','$pedido'");

        }else {
            $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$macwireless',value='$macwireless'", "pedido='$pedido' AND attribute = 'Password'");

        }
        if($macwireless == ''){
            $crud = new crud('radcheck'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Password'"); // exclui o registro com o id que foi passado
        }

        if($campoChaveWpa == '') {
            $crud = new crud('radreply');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$macwireless','Mikrotik-Wireless-PSK',':=','$chavewpa','$pedido'");

        }else {
            $crud = new crud('radreply'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$macwireless',value='$chavewpa'", "pedido='$pedido' AND attribute = 'Mikrotik-Wireless-PSK'");

        }
        if($chavewpa == ''){
            $crud = new crud('radreply'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Mikrotik-Wireless-PSK'"); // exclui o registro com o id que foi passado
        }

        if($campoIppool == '') {
            $crud = new crud('radcheck');  // tabela como parametro
            $crud->inserir("username,attribute,op,value,pedido", "'$login','Pool-Name',':=','$ippool','$pedido'");

        }else {
            $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',value='$ippool'", "pedido='$pedido' AND attribute = 'Pool-Name'");

        }
        if($ippool == ''){
            $crud = new crud('radcheck'); // tabela como parametro
            $crud->excluir("pedido = $pedido AND attribute = 'Pool-Name'"); // exclui o registro com o id que foi passado
        }


    $crud = new crud('assinaturas'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    $crud->atualizar("plano='$plano',login='$login',senha='$senha',servidor='$servidor',endereco='$endereco',numero='$numero',bairro='$bairro',complemento='$complemento',cidade='$cidade',estado='$estado',cep='$cep',tipo='$tipo',ip='$ip',routeip='$routeip',ipv6='$ipv6',mac='$mac',vencimento='$vencimento',macwireless='$macwireless',chavewpa='$chavewpa',observacao='$observacao',insento='$insento',autobloqueio='$autobloqueio',alterarsenha='$alterarsenha',desconto='$desconto',acrescimo='$acrescimo',ippool='$ippool',ip_ubnt='$ip_ubnt',porta_ubnt='$porta_ubnt',login_ubnt='$login_ubnt',senha_ubnt='$senha_ubnt',status='$status'", "id='$assinaturaid'");
    
    $pplano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $pp = mysqli_fetch_array($pplano);
    $nomeplano = $pp['nome'];
    $idservidor = $pp['servidor'];
    $upload = $pp['upload'];
    $download = $pp['download'];  
    $interface = $pp['interface'];
    $tiposervidor = $pp['tiposervidor'];
    $policein = $pp['policein'];
    $policeout = $pp['policeout'];
    
    if ($desconto <> '') {
  	$precoplano = ($pp['preco'] - $desconto);
	} elseif ($acrescimo <> '') {
  	$precoplano = ($pp['preco'] + $acrescimo);
	} else {
	$precoplano = $pp['preco'];  
	}    
    
    
    $pedido = $_POST['pedido'];
    $financeiroatz = $mysqli->query("SELECT * FROM financeiro WHERE pedido = '$pedido'");

    while($financeiro = mysqli_fetch_array($financeiroatz)){

    $anomodificar = $financeiro['ano'];
    $mesmodificar = $financeiro['mes'];
    $idmodificar = $financeiro['id'];

    $datamodificada = "$anomodificar-$mesmodificar-$vencimento";

    $crud = new crud('financeiro'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    //$crud->atualizar("valor='$precoplano',dia='$vencimento'", "pedido='$pedido'");
    $crud->atualizar("plano='$plano',valor='$precoplano',dia='$vencimento',vencimento='$datamodificada'", "pedido='$pedido' AND situacao = 'N' AND avulso = '0' AND id = '$idmodificar'");
    }


    $clliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
    $cc = mysqli_fetch_array($clliente);
    $nome = $cc['nome'] . " | " . $cc['cpf'] . " Endereço: " . $cc['endereco'] . " " . $cc['numero'] . " " . $cc['cidade'] . " " . $cc['estado'];

    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$idservidor'");
    $mk = mysqli_fetch_array($servidor);
    $rede = $mk['interface'];
    $nasip = $mk['ip'];


    // Radius

    $mdsenha = md5($senha);
    $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    $crud->atualizar("username='$login',value='$mdsenha'", "pedido='$pedido' AND attribute = 'MD5-Password'");

    // Radius Edge Router
    $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    $crud->atualizar("username='$login',value='$senha'", "pedido='$pedido' AND attribute = 'Cleartext-Password'");

    //$crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    //$crud->atualizar("username='$login',value='$nasip'", "pedido='$pedido' AND attribute = 'NAS-IP-Address'");
   
    if($mac <> '') {
    $crud = new crud('radcheck'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
    $crud->atualizar("username='$login',value='$mac'", "pedido='$pedido' AND attribute = 'Calling-Station-Id'"); 
    }

        if ($tiposervidor == "JUNIPER") {

            $crud = new crud('radreply');  // tabela como parametro
            $crud->atualizar("username='$login',value='$policein'", "pedido='$pedido' AND attribute = 'ERX-Ingress-Policy-Name'");
            $crud->atualizar("username='$login',value='$policeout'", "pedido='$pedido' AND attribute = 'ERX-Egress-Policy-Name'");

        }else {
            $crud = new crud('radusergroup'); // instancia classe com as opera??es crud, passando o nome da tabela como parametro
            $crud->atualizar("username='$login',groupname='$nomeplano'", "pedido='$pedido'");
        }


    // FIm Radius 

        /*
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].''))
    {

    // CASO O PLANO SEJAO MESMO J? ELE ATUALIZA O MK
    if ($_POST['tipo'] == 'HOTSPOT') {

    $API->write('/ip/hotspot/user/set',false);
    $API->write('=.id='.$login.'',false );
    $API->write('=name='.$login.'',false );
    $API->write('=password='.$senha.'',false );
    if($ip <> '') {
    $API->write('=address='.$ip.'',false );
    }
    if($mac <> '') {
    $API->write('=mac-address='.$mac.'',false );
    }
    $API->write('=profile='.$nomeplano.'',false );
    $API->write('=comment='.$nome.'' );
    $ARRAY = $API->read();

    } else {

    $API->write('/ppp/secret/add',false);
    $API->write('=name='.$login.'',false );
    $API->write('=password='.$senha.'',false );
    $API->write('=service=pppoe',false );
    $API->write('=caller-id='.$mac.'',false );
    $API->write('=profile='.$nomeplano.'',false );
    $API->write('=comment='.$nome.'' );
    $ARRAY = $API->read();

    $API->write('/ip/hotspot/user/remove',false);
    $API->write('=.id='.$login.'' );
    $ARRAY = $API->read();

    }
    // FIM COM ALTERA??O DE PLANO NO MK E DEL


    // CASO O PLANO SEJAO MESMO J? ELE ATUALIZA O MK
    if ($_POST['tipo'] == 'PPPoE') {

    $API->write('/ppp/profile/set',false);
    $API->write('=.id='.$login.'',false );
    $API->write('=name='.$login.'',false );
    $API->write('=password='.$senha.'',false );
    $API->write('=service=pppoe',false );
    $API->write('=caller-id='.$mac.'',false );
    $API->write('=profile='.$nomeplano.'',false );
    $API->write('=comment='.$nome.'' );
    $ARRAY = $API->read();

    } else {

    $API->write('/ip/hotspot/user/add',false);
    $API->write('=name='.$login.'',false );
    $API->write('=password='.$senha.'',false );
    if($ip <> '') {
    $API->write('=address='.$ip.'',false );
    }
    if($mac <> '') {
    $API->write('=mac-address='.$mac.'',false );
    }
    $API->write('=profile='.$nomeplano.'',false );
    $API->write('=comment='.$nome.'' );
    $ARRAY = $API->read();

    $API->write('/ppp/secret/remove',false);
    $API->write('=.id='.$login.'' );
    $ARRAY = $API->read();

    }
    // FIM COM ALTERA??O DE PLANO NO MK E DEL


    $API->disconnect();
    } // end MK

    */

    header("Location: index.php?app=Assinaturas&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    
    $rrm = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$id'");
    $ppr = mysqli_fetch_array($rrm);
    $idplano = $ppr['plano'];
    $tipomk = $ppr['tipo'];
    $idcliente = $ppr['cliente'];
    $iparp = $ppr['ip'];
    $pedido = $ppr['pedido'];
    
    $rrp = $mysqli->query("SELECT * FROM planos WHERE id = '$idplano'");
    $ppp = mysqli_fetch_array($rrp);
    $nomeplano = $ppp['nome'];
    $idservidor = $ppp['servidor'];
    
    $ccr = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
    $clp = mysqli_fetch_array($ccr);
    $login = $clp['login'];

    $rrs = $mysqli->query("SELECT * FROM servidores WHERE id = '$idservidor'");
    $pps = mysqli_fetch_array($rrs);
    $sip = $pps['ip'];
    $slogin = $pps['login'];
    $ssenha = $pps['senha'];

        /*
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect(''.$sip.'', ''.$slogin.'', ''.$ssenha.''))
	{

	if ($tipomk == 'HOTSPOT') {
	$API->write('/ip/hotspot/user/remove',false);
	$API->write('=.id='.$login.'' );
	$ARRAY = $API->read();
	}

	if ($tipomk == 'PPPoE') {
	$API->write('/ppp/secret/remove',false);
	$API->write('=.id='.$login.'' );
	$ARRAY = $API->read();
	}

	if ($tipomk == 'IPARP') {
	
	 $INFO = $API->comm('/ip/arp/print', array(
                ".proplist" => ".id",
                "?address" => "$iparp"
    		));
    		$API->comm('/ip/arp/remove', array(".id"=>$INFO[0]['.id'])); 

	}
	
	$API->write('/queue/simple/remove',false);
    	$API->write('=.id='.$pedido.'' );
    	$ARRAY = $API->read();

	$API->disconnect();
	}
    */

    $crud = new crud('assinaturas'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
		$selbanco = $mysqli->query("SELECT banco FROM empresa") or die(mysql_error());
	 	$confere = mysqli_fetch_array($selbanco);
		
		$sql = $mysqli->query("SELECT token_gnet FROM empresa") or die(mysql_error());
	 		$t = mysqli_fetch_array($sql);
	 		$token = $t['token_gnet'];
		
	 if($confere['banco'] == "10"){
		 
			$sql= $mysqli->query("SELECT * FROM financeiro WHERE pedido='$pedido' AND situacao='N'");
			while($ver = mysqli_fetch_array($sql)){
			
			
		$url = 'https://fortunus.gerencianet.com.br/webservice/cancelarCobranca';

		$token = $token;
 
		$chave = $ver['chave'];

		$xml = "<?xml version='1.0' encoding='utf-8'?>
		<CancelarCobranca>
		 <Token>{$token}</Token>
		 <Chave>{$chave}</Chave>
		</CancelarCobranca>";

			$xml = str_replace("\n", '', $xml);
			$xml = str_replace("\r",'',$xml);
			$xml = str_replace("\t",'',$xml);
 
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url);
			 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 
			curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
			 
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			 
			$data = array('xml' => $xml);
			 
			curl_setopt($ch, CURLOPT_POST, true);
			 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			 
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			 
			curl_setopt($ch, CURLOPT_USERAGENT, 'seu agente');
			 
			$resposta = curl_exec($ch);
			 
			curl_close($ch);
	 }
	 
	 }
	 
    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("pedido = '$pedido' AND situacao = 'N'"); // exclui o registro com o id que foi passado
	
    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("pedido = '$pedido' AND situacao = 'C'"); // exclui o registro com o id que foi passado

    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("pedido = '$pedido' AND situacao = 'B'"); // exclui o registro com o id que foi passado

    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("pedido = '$pedido' AND situacao = 'A'"); // exclui o registro com o id que foi passado
    
    $crud = new crud('controlebanda'); // tabela como parametro
    $crud->excluir("pedido = $pedido"); // exclui o registro com o id que foi passado
    
    $crud = new crud('radcheck'); // tabela como parametro
    $crud->excluir("pedido = $pedido"); // exclui o registro com o id que foi passado
    
    $crud = new crud('radusergroup'); // tabela como parametro
    $crud->excluir("pedido = $pedido"); // exclui o registro com o id que foi passado
    
	$crud = new crud('radreply'); // tabela como parametro
    $crud->excluir("pedido = $pedido"); // exclui o registro com o id que foi passado
	
    header("Location: index.php?app=Assinaturas&reg=3");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "DelReg")) {
    $registra = $_GET['regedit'];
    $crud = new crud('instalacao_equipamentos'); // tabela como parametro
    $crud->excluir("id = $registra"); // exclui o registro com o id que foi passado
    $idcs = $_GET['id'];
    header("Location: index.php?app=CadastroAssinatura&id=$idcs");
    }
    
										
?>
<script type="text/javascript">
    $(document).ready(function(){
    $("select[name='cliente']").change(function(){
    var endereco = $("input[name='endereco']");
    var numero = $("input[name='numero']");
    var bairro = $("input[name='bairro']");
    var complemento = $("input[name='complemento']");
    var cidade = $("input[name='cidade']");
    var estado = $("input[name='estado']");
    var cep = $("input[name='cep']");
    var login = $("input[name='login']");
    var senha = $("input[name='senha']");
     
    $( endereco ).val('Carregando...');
    $( numero ).val('Carregando...');
    $( bairro ).val('Carregando...');
    $( complemento ).val('Carregando...');
    $( cidade ).val('Carregando...');
    $( estado ).val('Carregando...');
    $( cep ).val('Carregando...');
    $( login ).val('Carregando...');
    $( senha ).val('Carregando...');
     
    $.getJSON(
    'ajax/dadoscliente.php',
    { id: $( this ).val() },
    function( json )
    {
    $( endereco ).val( json.endereco );
    $( numero ).val( json.numero );
    $( bairro ).val( json.bairro );
    $( complemento ).val( json.complemento );
    $( bairro ).val( json.bairro );
    $( cidade ).val( json.cidade );
    $( estado ).val( json.estado );
    $( cep ).val( json.cep );
    $( login ).val( json.login );
    $( senha ).val( json.senha );
    }
    );
    });
    });
    </script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script language="javascript">
jQuery(function($){
   $(".cel").mask("(999) 99999-9999");
   $(".tel").mask("(999) 9999-9999");
   $(".cep").mask("99999-999");
});
/*----------------------------------------------------------------------------
Formatação para MAC
-----------------------------------------------------------------------------*/
function formatar(src, mask){
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i)
if (texto.substring(0,1) != saida)
  {
    src.value += texto.substring(0,1);
  }
}
</script>

<script type="text/javascript" src="ajax/funcsip.js"></script>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Assinaturas">Assinaturas</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
 	<?php if($permissao['a1'] == S) { ?>
        
        <div class="page-header">
          <h1>Assinatura<small> Clientes</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Assinatura<small>Plano de Acesso</small></h2>
              </header>
              <div class="inner-spacer">
              
        
              <?php 
	      $tr6675443edrd98987tffddedtfret565   = KEY; 
	      $uyt766776554eree444343435erererew = base64_decode($tr6675443edrd98987tffddedtfret565);
	      $fn1 = explode("erpmklimite",$uyt766776554eree444343435erererew); 
	      $validar = base64_decode($fn1[1]);
         // if($limitecadastro == $validar) {
          if($limitecadastro == 10000) {
              ?>

              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	      <i class="fa fa-times-circle"></i></button>
              <strong>Atenção!</strong> Você atingiu seu limite de plano.<br> Para criar mais assinaturas você precisa migrar seu plano.<br> Entre em contato com contato@myrouter.com.br para mais informações. </div>
              
              <?php if (@$campo['id'] <> '') { ?>
              
              <!-- Permite editar se plano esgotar -->
              
              <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-6">
                      <label class="label">Cliente</label>
                      <label class="select">
                        
                      <select id="cliente" name="cliente" class="selectpicker form-control" data-live-search="true" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $ccv = $mysqli->query("SELECT * FROM clientes WHERE empresa = '$idempresa'");
 		      while($cliente = mysqli_fetch_array($ccv)){
		      ?>
		      <option value="<?php echo $cliente['id']; ?>" <?php if ($campo['cliente'] == $cliente['id']) { echo "selected"; } ?>><?php echo $cliente['nome']; ?> | <?php echo $cliente['cpf']; ?> | <?php echo $cliente['endereco']; ?> <?php echo $cliente['cidade']; ?> <?php echo $cliente['estado']; ?></option>
		      <?php } ?> 
 		      </select>
                      
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Plano de Acesso</label>
                      <label class="select">
                        
                      <select id="plano" name="plano" class="form-control" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $ccp = $mysqli->query("SELECT * FROM planos WHERE empresa = '$idempresa'");
 		      while($plano = mysqli_fetch_array($ccp)){
		      ?>
		      <option value="<?php echo $plano['id']; ?>" <?php if ($campo['plano'] == $plano['id']) { echo "selected"; } ?>><?php echo $plano['nome']; ?> | R$ <?php echo number_format($plano['preco'],2,',','.'); ?> | <?php echo $plano['download']; ?>/<?php echo $plano['upload']; ?>kbps </option>
		      <?php } ?> 
 		      </select>
                        
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Tipo de Autenticação</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="tipo" value="HOTSPOT" <?php if ($campo['tipo'] == 'HOTSPOT') { echo "checked"; } ?> required>
                          <i></i>HotSpot</label>
                        
                        <label class="radio">
                          <input type="radio" name="tipo" value="PPPoE" <?php if ($campo['tipo'] == 'PPPoE') { echo "checked"; } ?>>
                          <i></i>PPPoE</label>
                          <label class="radio">
                          <input type="radio" name="tipo" value="IPARP" <?php if ($campo['tipo'] == 'IPARP') { echo "checked"; } ?>>
                          <i></i>IP / ARP</label>
                          <label class="radio">
                          <input type="radio" name="tipo" value="DHCP" <?php if ($campo['tipo'] == 'DHCP') { echo "checked"; } ?>>
                          <i></i>DHCP</label>
                      </div>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">IPv4</label>
                      <label class="input">
                        <input type="text" name="ip" id="ip" onblur="validarIP('ip', document.getElementById('ip').value);" value="<?php echo @$campo['ip']; ?>">
                        <div id="campo_ip"></div>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">MAC</label>
                      <label class="input">
                        <input type="text" maxlength="17" OnKeyPress="formatar(this, '##:##:##:##:##:##')" name="mac" value="<?php echo @$campo['mac']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Login (HotSpot/PPPoE)</label>
                      <label class="input">
                        <input type="text" name="login"  value="<?php echo @$campo['login']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Senha (HotSpot/PPPoE)</label>
                      <label class="input">
                        <input type="text" name="senha" value="<?php echo @$campo['senha']; ?>">
                      </label>
                    </section>

                    
                     <?php if (@$campo['id'] <> '') { ?>
		     
		   <section class="col col-12"  style="width:100%">
                      <label class="label">Equipamentos Utilizados</label>  
                      <hr>
		 <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>Equipamento</th>
                      <th>Modelo</th>
                      <th>Fabricante</th>
                      <th>Qtd</th>
                      <th>Observa??es</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $assinatura = $campo['pedido'];
 		  $codsx = $mysqli->query("SELECT * FROM instalacao_equipamentos WHERE assinatura = '$assinatura'");
 		  while($cvb = mysqli_fetch_array($codsx)){
 		  $idequipe = $cvb['equipamento'];
 		  $newe = $mysqli->query("SELECT * FROM equipamentos WHERE id = '$idequipe'");
 		  $equip = mysqli_fetch_array($newe);
 		  ?>
                    <tr>
                      <td><?php echo $equip['equipamento']; ?></td>
                      <td><?php echo $equip['modelo']; ?></td>
                      <td><?php echo $equip['fabricante']; ?></td>
                      <td><?php echo $cvb['qtd']; ?></td>
                      <td><?php echo $cvb['obs']; ?></td>
                      <td>
                  <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente alterar esse equipamento ?')) { window.location.href='?app=EqpAssinatura&regedit=<?php echo base64_encode($cvb['id']); ?>&id=<?php echo base64_encode($campo['id']); ?>' } else { void('') };"><img src="assets/images/edit.png"></a> &nbsp;
		          <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse equipamento ?')) { window.location.href='?app=CadastroAssinatura&id=<?php echo base64_encode($campo['id']); ?>&Ex=DelReg&regedit=<?php echo $cvb['id']; ?>' } else { void('') };" class=" tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><img src="assets/images/del.png"></a>

		      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <hr>
                </label>
                    </section>
		     
		     
		     <?php } else { ?>
<table border="0" cellpadding="2" cellspacing="4" width="100%">

  <tr><td class="bd_titulo"></td><td class="bd_titulo" style="width:40px;"></td><td class="bd_titulo" style="width:40px;"></td></tr>
  <tr class="linhas">
    <td>
    
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding-bottom: 5px; padding-left: 10px">
			
			<tr>
                        <td>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>
			  
			  <section class="col col-12">
                      <label class="label">Equipamento</label>
                      <label class="select">
                        
                      <select id="equipamento" name="equipamento[]" class="form-control">

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $eqp = $mysqli->query("SELECT * FROM equipamentos WHERE empresa = '$idempresa'");
 		      while($equipamento = mysqli_fetch_array($eqp)){
		      ?>
		      <option value="<?php echo $equipamento['id']; ?>"><?php echo $equipamento['equipamento']; ?> | Modelo: <?php echo $equipamento['modelo']; ?> | <?php echo $equipamento['fabricante']; ?></option>
		      <?php } ?> 
 		      </select>
                        
                      </label>
                    </section>
			  
			</td>
			<td>
			
			<section class="col col-12">
                      <label class="label">Qtd Utilizado</label>
                      <label class="input">
                        <input type="text" onKeyUp="kbps(this);" placeholder="Ex: 1 Unid, e/ou 100 Mts" name="qtd[]">
                      </label>
                    </section>
			
			</td>
			
			<td>
	   		<section class="col col-12">
                      <label class="label">Observações</label>
                      <label class="input">
                        <input type="text" name="obs[]" placeholder="Marca??es se necess?rio">
                      </label>
                    </section>
			</td>
			</tr>
			</table>
			<div id="newprescriptions">
			</div>
			<td colspan="4">
	<a href="javascript:void(0)" class="removerCampo" title="Remover Equipamento"><img src="assets/images/minus.png" border="0" /></a></td>
	</tr>
			</td>
			</tr>
                </table>
    
    </td>
    
  </tr>
  
  <tr><td colspan="4">
        <a href="javascript:void(0)" class="adicionarCampo" title="Adicionar Equipamento"><img src="assets/images/plus.png" border="0" /></a>
	</td>
	
  <tr>
        <td align="right" colspan="4"></td>
  </tr> 
</table>
                      <?php } ?>
                      
                    <section class="col col-10">
                      <label class="label">Endereço de Instalação</label>
                      <label class="input">
                        <input type="text" name="endereco" value="<?php echo @$campo['endereco']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Numero</label>
                      <label class="input">
                        <input type="text" name="numero" value="<?php echo @$campo['numero']; ?>" required>
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
                      <label class="input">
                      <input type="text" name="estado" value="<?php echo @$campo['estado']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Cidade</label>
                      <label class="input">
                      <input type="text" name="cidade" value="<?php echo @$campo['cidade']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Dia Vencimento</label>
                      <label class="select">
                        <select name="vencimento" required>
                        <option value="">Selecione</option>
                        <option value="01" <?php if ($campo['vencimento'] == '01') { echo "selected"; } ?>>Dia 1 de cada mês</option>
                        <option value="02" <?php if ($campo['vencimento'] == '02') { echo "selected"; } ?>>Dia 2 de cada mês</option>
                        <option value="03" <?php if ($campo['vencimento'] == '03') { echo "selected"; } ?>>Dia 3 de cada mês</option>
                        <option value="04" <?php if ($campo['vencimento'] == '04') { echo "selected"; } ?>>Dia 4 de cada mês</option>
                        <option value="05" <?php if ($campo['vencimento'] == '05') { echo "selected"; } ?>>Dia 5 de cada mês</option>
                        <option value="10" <?php if ($campo['vencimento'] == '10') { echo "selected"; } ?>>Dia 10 de cada mês</option>
                        <option value="15" <?php if ($campo['vencimento'] == '15') { echo "selected"; } ?>>Dia 15 de cada mês</option>
                        <option value="20" <?php if ($campo['vencimento'] == '20') { echo "selected"; } ?>>Dia 20 de cada mês</option>
                        <option value="25" <?php if ($campo['vencimento'] == '25') { echo "selected"; } ?>>Dia 25 de cada mês</option>
                        </select>
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Desconto na Mensalidade(R$)</label>
                      <label class="input">
                      <input type="text" name="desconto" onKeyUp="moeda(this);" value="<?php echo @$campo['desconto']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Acréscimo (R$)</label>
                      <label class="input">
                      <input type="text" name="acrescimo" onKeyUp="moeda(this);" value="<?php echo @$campo['acrescimo']; ?>">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Isento Mensalidade</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="insento" value="S" <?php if ($campo['insento'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="insento" value="N" <?php if ($campo['insento'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Bloqueio Automático</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="autobloqueio" value="S" <?php if ($campo['autobloqueio'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="autobloqueio" value="N" <?php if ($campo['autobloqueio'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Permitir Alteração de Senha</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="alterarsenha" value="S" <?php if ($campo['alterarsenha'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="alterarsenha" value="N" <?php if ($campo['alterarsenha'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Status</label>
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
		  <input type="hidden" name="assinaturaid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="pedido" value="<?php echo @$campo['pedido']; ?>">
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
              <!-- Fim Permite Editar -->
              
              <?php } ?>
              
              <?php } else { ?>

              <script type="text/javascript" src="ajax/funcsassinatura.js"></script>


              <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-6">
                      <label class="label">Cliente</label>
                      <label class="select" >
                        
                      <select id="cliente" name="cliente" class="selectpicker form-control" data-live-search="true" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $ccv = $mysqli->query("SELECT * FROM clientes WHERE empresa = '$idempresa'");
 		      while($cliente = mysqli_fetch_array($ccv)){
		      ?>
		      <option value="<?php echo $cliente['id']; ?>" <?php if ($campo['cliente'] == $cliente['id']) { echo "selected"; } ?>><?php echo $cliente['nome']; ?> | <?php echo $cliente['cpf']; ?> | <?php echo $cliente['endereco']; ?> <?php echo $cliente['cidade']; ?> <?php echo $cliente['estado']; ?></option>
		      <?php } ?> 
 		      </select>
                      
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Plano de Acesso</label>
                      <label class="select">
                        
                      <select id="plano" name="plano" class="selectpicker form-control" data-live-search="true" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $ccp = $mysqli->query("SELECT * FROM planos WHERE empresa = '$idempresa'");
 		      while($plano = mysqli_fetch_array($ccp)){
		      ?>
		      <option value="<?php echo $plano['id']; ?>" <?php if ($campo['plano'] == $plano['id']) { echo "selected"; } ?>><?php echo $plano['nome']; ?> | R$ <?php echo number_format($plano['preco'],2,',','.'); ?> | <?php echo $plano['download']; ?>/<?php echo $plano['upload']; ?>kbps </option>
		      <?php } ?> 
 		      </select>
                        
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Tipo de Autenticação</label>
                      <div class="inline-group">
                                              
                        <label class="radio">
                          <input type="radio" name="tipo" value="HOTSPOT" <?php if ($campo['tipo'] == 'HOTSPOT') { echo "checked"; } ?> required>
                          <i></i>HotSpot</label>
                        
                        <label class="radio">
                          <input type="radio" name="tipo" value="PPPoE" <?php if ($campo['tipo'] == 'PPPoE') { echo "checked"; } ?>>
                          <i></i>PPPoE</label>
                          <label class="radio">
                          <input type="radio" name="tipo" value="IPARP" <?php if ($campo['tipo'] == 'IPARP') { echo "checked"; } ?>>
                          <i></i>IP / ARP</label>
                          <label class="radio">
                          <input type="radio" name="tipo" value="DHCP" <?php if ($campo['tipo'] == 'DHCP') { echo "checked"; } ?>>
                          <i></i>DHCP</label>
                      </div>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">IPv4</label>
                      <label class="input">
                        <input type="text" name="ip" id="ip" onblur="validarIP('ip', document.getElementById('ip').value);" value="<?php echo @$campo['ip']; ?>"placeholder="192.168.0.1">
                          <div id="campo_ip"></div>
                      </label>
                    </section>

                      <section class="col col-4">
                          <label class="label">Router IPv4</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="routeip" id="routeip"  value="<?php echo @$campo['routeip']; ?>"placeholder="192.168.0.0/24">
                              <b class="tooltip tooltip-top-right">Ex: "192.168.0.0/24" ou "192.168.0.0/24,192.168.1.0/24" ou "0.0.0/0 192.168.69.1 1" </b> </label>
                          </label>
                      </section>

                   <section class="col col-4">
                      <label class="label">IPv6 Prefix Route</label>
                      <label class="input">
                        <input type="text" name="ipv6" id="ipv6" value="<?php echo @$campo['ipv6']; ?>"placeholder="aaaa:aaaa:a102:0::/64">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">MAC</label>
                      <label class="input">
                        <input type="text" maxlength="17" OnKeyPress="formatar(this, '##:##:##:##:##:##')" name="mac" value="<?php echo @$campo['mac']; ?>"placeholder="00:00:00:00:00:00">
                      </label>
                    </section>

                   <?php if (@$campo['id'] <> '') { ?>

                    <section class="col col-3">
                      <label class="label">Login</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" id="login" name="login" onblur="validarLoginAssinaturas('login', document.getElementById('login').value);" value="<?php echo @$campo['login']; ?>" readonly="yes">
                        <b class="tooltip tooltip-top-right">Campo Login para uso em autenticação PPPoE/HotSpot</b> </label>
                        <div id="campo_login"></div>
                        </label>
                    </section>

                   <?php } else { ?>

                      <section class="col col-3">
                          <label class="label">Login</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" id="login" name="login" onblur="validarLoginAssinaturas('login', document.getElementById('login').value);" value="<?php echo @$campo['login']; ?>">
                              <b class="tooltip tooltip-top-right">Campo Login para uso em autenticação PPPoE/HotSpot</b> </label>
                          <div id="campo_login"></div>
                          </label>
                      </section>

                   <?php } ?>


                      <section class="col col-3">
                      <label class="label">Senha</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="senha" value="<?php echo @$campo['senha']; ?>">
                        <b class="tooltip tooltip-top-right">Campo Senha para uso em autenticação PPPoE/HotSpot</b> </label>
                      </label>
                    </section>


                      <section class="col col-4">
                          <label class="label">Servidor</label>
                          <label class="select">
                              <select id="servidor" name="servidor" class="selectpicker form-control" data-live-search="true">

                                  <option value="">Selecione</option>
                                  <?php
                                  $idempresa = $_SESSION['empresa'];
                                  $bservidor = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
                                  while($srv = mysqli_fetch_array($bservidor)){
                                      ?>
                                      <option value="<?php echo $srv['id']; ?>" <?php if ($campo['servidor'] == $srv['id']) { echo "selected"; } ?>><?php echo $srv['servidor']; ?> | <?php echo $srv['ip']; ?></option>
                                  <?php } ?>
                              </select>
                          </label>
                      </section>



                      <?php if (@$campo['id'] <> '') { ?>
		     
		   <section class="col col-12"  style="width:100%">
                      <label class="label">Equipamentos Utilizados</label>  
                      <hr>
		 <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>Equipamento</th>
                      <th>Modelo</th>
                      <th>Fabricante</th>
                      <th>Qtd</th>
                      <th>Observações</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $assinatura = $campo['pedido'];
 		  $codsx = $mysqli->query("SELECT * FROM instalacao_equipamentos WHERE assinatura = '$assinatura'");
 		  while($cvb = mysqli_fetch_array($codsx)){
 		  $idequipe = $cvb['equipamento'];
 		  $newe = $mysqli->query("SELECT * FROM equipamentos WHERE id = '$idequipe'");
 		  $equip = mysqli_fetch_array($newe);
 		  ?>
                    <tr>
                      <td><?php echo $equip['equipamento']; ?></td>
                      <td><?php echo $equip['modelo']; ?></td>
                      <td><?php echo $equip['fabricante']; ?></td>
                      <td><?php echo $cvb['qtd']; ?></td>
                      <td><?php echo $cvb['obs']; ?></td>
                      <td>

              <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente alterar esse equipamento ?')) { window.location.href='?app=EqpAssinatura&regedit=<?php echo base64_encode($cvb['id']); ?>&id=<?php echo base64_encode($campo['id']); ?>' } else { void('') };"><img src="assets/images/edit.png"></a> &nbsp;
		      <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse equipamento ?')) { window.location.href='?app=CadastroAssinatura&id=<?php echo base64_encode($campo['id']); ?>&Ex=DelReg&regedit=<?php echo $cvb['id']; ?>' } else { void('') };" class=" tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><img src="assets/images/del.png"></a>
		      
		      
		      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <hr>
                </label>
                    </section>
		     
		     
		     <?php } else { ?>
<table border="0" cellpadding="2" cellspacing="4" width="100%">

  <tr><td class="bd_titulo"></td><td class="bd_titulo" style="width:40px;"></td><td class="bd_titulo" style="width:40px;"></td></tr>
  <tr class="linhas">
    <td>
    
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding-bottom: 5px; padding-left: 10px">
			
			<tr>
                        <td>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>
			  
			  <section class="col col-12">
                      <label class="label">Equipamento</label>
                      <label class="select">
                        
                      <select id="equipamento" name="equipamento[]" class="form-control">

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $eqp = $mysqli->query("SELECT * FROM equipamentos WHERE empresa = '$idempresa'");
 		      while($equipamento = mysqli_fetch_array($eqp)){
		      ?>
		      <option value="<?php echo $equipamento['id']; ?>"><?php echo $equipamento['equipamento']; ?> | Modelo: <?php echo $equipamento['modelo']; ?> | <?php echo $equipamento['fabricante']; ?></option>
		      <?php } ?> 
 		      </select>
                        
                      </label>
                    </section>
			  
			</td>
			<td>
			
			<section class="col col-12">
                      <label class="label">Qtd Utilizado</label>
                      <label class="input">
                        <input type="text" onKeyUp="kbps(this);" placeholder="Ex: 1 Unid, e/ou 100 Mts" name="qtd[]">
                      </label>
                    </section>
			
			</td>
			
			<td>
	   		<section class="col col-12">
                      <label class="label">Observações</label>
                      <label class="input">
                        <input type="text" name="obs[]" placeholder="Informações se necessário">
                      </label>
                    </section>
			</td>
			</tr>
			</table>
			<div id="newprescriptions">
			</div>
			<td colspan="4">
	<a href="javascript:void(0)" class="removerCampo" title="Remover Equipamento"><img src="assets/images/minus.png" border="0" /></a></td>
	</tr>
			</td>
			</tr>
                </table>
    
    </td>
    
  </tr>
  
  <tr><td colspan="4">
        <a href="javascript:void(0)" class="adicionarCampo" title="Adicionar Equipamento"><img src="assets/images/plus.png" border="0" /></a>
	</td>
	
  <tr>
        <td align="right" colspan="4"></td>
  </tr> 
</table>
                      <?php } ?>
                      
                    <section class="col col-10">
                      <label class="label">Endereço de Instalação</label>
                      <label class="input">
                        <input type="text" name="endereco" value="<?php echo @$campo['endereco']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Numero</label>
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
                      <label class="input">
                      <input type="text" name="estado" value="<?php echo @$campo['estado']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Cidade</label>
                      <label class="input">
                      <input type="text" name="cidade" value="<?php echo @$campo['cidade']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">CEP</label>
                      <label class="input">
                        <input type="text" name="cep" class="cep" value="<?php echo @$campo['cep']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Dia Vencimento</label>
                      <label class="select">
                        <select name="vencimento" required>
                        <option value="">Selecione</option>
                            <option value="01" <?php if ($campo['vencimento'] == '01') { echo "selected"; } ?>>Dia 1 de cada mês</option>
                            <option value="02" <?php if ($campo['vencimento'] == '02') { echo "selected"; } ?>>Dia 2 de cada mês</option>
                            <option value="03" <?php if ($campo['vencimento'] == '03') { echo "selected"; } ?>>Dia 3 de cada mês</option>
                            <option value="04" <?php if ($campo['vencimento'] == '04') { echo "selected"; } ?>>Dia 4 de cada mês</option>
                            <option value="05" <?php if ($campo['vencimento'] == '05') { echo "selected"; } ?>>Dia 5 de cada mês</option>
                            <option value="10" <?php if ($campo['vencimento'] == '10') { echo "selected"; } ?>>Dia 10 de cada mês</option>
                            <option value="15" <?php if ($campo['vencimento'] == '15') { echo "selected"; } ?>>Dia 15 de cada mês</option>
                            <option value="20" <?php if ($campo['vencimento'] == '20') { echo "selected"; } ?>>Dia 20 de cada mês</option>
                            <option value="25" <?php if ($campo['vencimento'] == '25') { echo "selected"; } ?>>Dia 25 de cada mês</option>
                        </select>
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Desconto(R$)</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                      <input type="text" name="desconto" onKeyUp="moeda(this);" value="<?php echo @$campo['desconto']; ?>">
                            <b class="tooltip tooltip-top-right">Desconto na Mensalidade(R$)</b> </label>

                        </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Acréscimo (R$)</label>
                      <label class="input">
                      <input type="text" name="acrescimo" onKeyUp="moeda(this);" value="<?php echo @$campo['acrescimo']; ?>">
                      </label>
                    </section>


                      <section class="col col-3">
                          <label class="label">MAC ADDRESS Wireless</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" maxlength="17" OnKeyPress="formatar(this, '##:##:##:##:##:##')" name="macwireless" value="<?php echo @$campo['macwireless']; ?>" placeholder="MAC ADDRESS" >
                              <b class="tooltip tooltip-top-right">Configure o mac na autenticação o cliente no Wireless</b> </label>
                      </section>

                      <section class="col col-3">
                          <label class="label">Chave WPA/WPA2</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="chavewpa" value="<?php echo @$campo['chavewpa']; ?>" placeholder="Senha WPA/WPA2" >
                              <b class="tooltip tooltip-top-right">Chave wpa/wpa2 para autenticação wireless - No mínimo senha com 8 dígitos</b> </label>
                      </section>

                      <section class="col col-6">
                          <label class="label">IP POOL VIA RADIUS</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="ippool" value="<?php echo @$campo['ippool']; ?>" placeholder="Insira o nome do Pool" >
                              <b class="tooltip tooltip-top-right">Este campo só será usado caso seu  ip pool for atribuido via Radius, Função usada em rede Roteada com PPPoE</b> </label>
                      </section>



                      <section class="col col-2">
                          <label class="label">IP Equip. UBNT</label>
                          <label class="input">
                              <input type="text" name="ip_ubnt" value="<?php echo @$campo['ip_ubnt']; ?>" placeholder="IP do Equipamento" >
                      </section>

                      <section class="col col-2">
                          <label class="label">LOGIN Equip. UBNT</label>
                          <label class="input">
                              <input type="text" name="login_ubnt" value="<?php echo @$campo['login_ubnt']; ?>" placeholder="LOGIN do Equipamento" >
                      </section>

                      <section class="col col-2">
                          <label class="label">SENHA Equip. UBNT</label>
                          <label class="input">
                              <input type="text" name="senha_ubnt" value="<?php echo @$campo['senha_ubnt']; ?>" placeholder="SENHA do Equipamento" >
                      </section>


                      <section class="col col-2">
                          <label class="label">PORTA Equip. UBNT</label>
                          <label class="input">
                              <input type="text" name="porta_ubnt" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['porta_ubnt']; ?><?php } else { ?><?php echo "22"; ?><?php } ?>" placeholder="PORTA do Equipamento" >

                      </section>


                          <section class="col col-11">
                          <label class="label">Observação</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="observacao" value="<?php echo @$campo['observacao']; ?>" placeholder="Observação" >
                              <b class="tooltip tooltip-top-right">Campo para informações adicionais</b> </label>
                      </section>

                      <section class="col col-3">
                      <label class="label">Isento Mensalidade</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="insento" value="S" <?php if ($campo['insento'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="insento" value="N" <?php if ($campo['insento'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Bloqueio Automático</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="autobloqueio" value="S" <?php if ($campo['autobloqueio'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="autobloqueio" value="N" <?php if ($campo['autobloqueio'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Permitir Alteração de Senha</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="alterarsenha" value="S" <?php if ($campo['alterarsenha'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="alterarsenha" value="N" <?php if ($campo['alterarsenha'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Status</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" <?php if ($campo['status'] == 'S') { echo "checked"; } ?>  required>
                          <i></i>Ativo</label>
                        
                        <label class="radio">
                          <input type="radio" name="status" value="N" <?php if ($campo['status'] == 'N') {echo "checked"; } ?>>
                          <i></i>Bloqueado</label>
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="assinaturaid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="pedido" value="<?php echo @$campo['pedido']; ?>">
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
                <?php } /* FIM LIMITE USO */ ?>
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