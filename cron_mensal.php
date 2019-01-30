<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	require_once 'config/conexao.class.php';
	require_once 'config/crud.class.php';
	require_once 'config/mikrotik.class.php';
	require_once 'config/librouteros/RouterOS.php';
	$con = new conexao(); // instancia classe de conxao
	$con->connect(); // abre conexao com o banco


    $sql5 = mysql_query("SELECT * FROM empresa WHERE id = '1'");
    $emp = mysql_fetch_array($sql5);
    $CampoLancarFaturas  = $emp['lancarfaturas'];

	function dias($dtInicial, $dtFinal){
		$data_inicial = $dtInicial;
		$data_final = $dtFinal;
		
		$diferenca = strtotime($data_final) - strtotime($data_inicial);
		
		$dias = floor($diferenca / (60 * 60 * 24));
		
		return $dias;
	}
	
	$dataHoje = date('Y-m-d');
	$qtdDias = $CampoLancarFaturas;

	//$diaVerificar = date("Y-m-d", strtotime("-".$qtdDias."day"));
	$queryAssinatura = mysql_query("SELECT * FROM assinaturas WHERE insento = 'N' AND status = 'S'");
	$countAssinatura = mysql_num_rows($queryAssinatura);
	if($countAssinatura > 0){
		while($resAssinatura = mysql_fetch_assoc($queryAssinatura)){
			$diaVencimento = $resAssinatura['vencimento'];
			$queryFinanceiro = mysql_query("SELECT * FROM financeiro WHERE pedido = '".$resAssinatura['pedido']."' AND avulso = '0' ORDER BY vencimento DESC LIMIT 1");
			$countFinanceiro = mysql_num_rows($queryFinanceiro);
			if($countFinanceiro == 0){
				$dtVencimentoNd = date('Y').'-'.date('m').'-'.$diaVencimento;
				if($dtVencimentoNd < $dataHoje){
					$dtVenc = date('Y-m-d', strtotime('+1month', strtotime($dtVencimentoNd)));
					if(dias($dataHoje, $dtVenc) == $qtdDias){
						$FinanceiroCreate['nfatura'] 		= substr($dtVenc, 5,2);
						$FinanceiroCreate['cliente'] 		= $resAssinatura['cliente'];
						$FinanceiroCreate['pedido']			= $resAssinatura['pedido'];
						$FinanceiroCreate['vencimento']		= $dtVenc;
						$FinanceiroCreate['cadastro']		= date('Y-m-d');
						$FinanceiroCreate['dia']			= substr($dtVenc, -2);
						$FinanceiroCreate['mes']			= substr($dtVenc, 5,2);
						$FinanceiroCreate['ano']			= substr($dtVenc, 0,4);
						$FinanceiroCreate['plano']			= $resAssinatura['plano'];
						$FinanceiroCreate['login']			= $resAssinatura['login'];
						$FinanceiroCreate['ip']				= $resAssinatura['ip'];
						$FinanceiroCreate['mac']			= $resAssinatura['mac'];
						$FinanceiroCreate['avulso']			= '0';
                        $FinanceiroCreate['mesparcela']		= substr($dtVenc, 5,2);
						$queryPlano = mysql_query("SELECT * FROM planos WHERE id = '".$resAssinatura['plano']."'");
						$countPlano = mysql_num_rows($queryPlano);
                        if($countPlano > 0){
                        	$resPlano = mysql_fetch_assoc($queryPlano);
                       	 	$FinanceiroCreate['valor']			= $resPlano['preco'];
						}
						//NOSSO NUMERO
						$qr_numero = mysql_query("SELECT * FROM financeiro ORDER BY id DESC LIMIT 1");
						$row_numero = mysql_fetch_array($qr_numero);
						$numero = str_pad($row_numero['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
						//FIM NOSSO NUMERO
						$FinanceiroCreate['boleto']			= $numero;
						$FinanceiroCreate['situacao']		= 'N';
						$FinanceiroCreate['status']			= 'A';

						//	echo '<pre>';
						//		print_r($FinanceiroCreate);
						//	echo '</pre>';

						$tabela = 'financeiro';
						$fields = implode(", ",array_keys($FinanceiroCreate));
						$values = "'".implode("', '",array_values($FinanceiroCreate))."'";
						$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
						$stCreate = mysql_query($qrCreate) or die ('Erro ao cadastrar em '.$tabela.' '.mysql_error());
					}else{
						echo 'SEM VENCIMENTO';
						echo '<hr />';
					}
				}else{
					echo 'DATA DE VENCIMENTO  MENOR QUE A DATA DE HOJE';
					echo '<hr />';
				}
			}else{
				while($resFinanceiro = mysql_fetch_assoc($queryFinanceiro)){
					$dtUltVencimento = $resFinanceiro['vencimento'];
					$dtVenc1 = date('Y-m-d', strtotime('+1month', strtotime($dtUltVencimento)));
					if(dias($dataHoje, $dtVenc1) == $qtdDias){
						$FinanceiroCreate1['nfatura'] 		= substr($dtVenc1, 5,2);
						$FinanceiroCreate1['cliente'] 		= $resAssinatura['cliente'];
						$FinanceiroCreate1['pedido']		= $resAssinatura['pedido'];
						$FinanceiroCreate1['vencimento']	= $dtVenc1;
						$FinanceiroCreate1['cadastro']		= date('Y-m-d');
						$FinanceiroCreate1['dia']			= substr($dtVenc1, -2);
						$FinanceiroCreate1['mes']			= substr($dtVenc1, 5,2);
						$FinanceiroCreate1['ano']			= substr($dtVenc1, 0,4);
						$FinanceiroCreate1['plano']			= $resAssinatura['plano'];
						$FinanceiroCreate1['login']			= $resAssinatura['login'];
						$FinanceiroCreate1['ip']			= $resAssinatura['ip'];
						$FinanceiroCreate1['mac']			= $resAssinatura['mac'];
                        $FinanceiroCreate1['mesparcela']	= substr($dtVenc1, 5,2);
						$FinanceiroCreate1['avulso']			= '0';
						$queryPlano = mysql_query("SELECT * FROM planos WHERE id = '".$resAssinatura['plano']."'");
						$countPlano = mysql_num_rows($queryPlano);
						if($countPlano > 0){
                        	$resPlano = mysql_fetch_assoc($queryPlano);
						}
						$FinanceiroCreate1['valor']			= $resPlano['preco'];
						//NOSSO NUMERO
						$qr_numero1 = mysql_query("SELECT * FROM financeiro ORDER BY id DESC LIMIT 1");
						$row_numero1 = mysql_fetch_array($qr_numero1);
						$numero1 = str_pad($row_numero1['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
						//FIM NOSSO NUMERO
						$FinanceiroCreate1['boleto']			= $numero1;
						$FinanceiroCreate1['situacao']			= 'N';
						$FinanceiroCreate1['status']			= 'A';
						
						$tabela1 = 'financeiro';
						$fields1 = implode(", ",array_keys($FinanceiroCreate1));
						$values1 = "'".implode("', '",array_values($FinanceiroCreate1))."'";
						$qrCreate1 = "INSERT INTO {$tabela1} ($fields1) VALUES ($values1)";
						$stCreate1 = mysql_query($qrCreate1) or die ('Erro ao cadastrar em '.$tabela1.' '.mysql_error());
						
						/*echo '<pre>';
						print_r($FinanceiroCreate1);
						echo '</pre>';*/
					}else{
						echo 'SEM VENCIMENTO';
						echo '<hr />';
					}
				}
				echo '';
			}
		}
	}
?>