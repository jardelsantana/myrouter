<?php	
	ini_set("allow_url_fopen", 1);
	ini_set("display_errors", 1);
	error_reporting(1);
	ini_set("track_errors","1");

	require_once 'config/conexao.class.php';
	$con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
	
	$cskey = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
    $chavekey = mysqli_fetch_array($cskey);

	require_once 'config/sws_extensao.php';
	require_once 'config/sws_serasa_pefin.php';
	
	$credenciais        = new Credenciais();
	$credenciais->Email = $chavekey['emailspc'];
	$credenciais->Senha = $chavekey['senhaspc'];
	
	$pefin                = new Pefin();
	$pefin->Credenciais   = $credenciais;
	$pefin->Documento     = base64_decode($_GET['id']);
	
	$serasa = new SERASA();
	$pefin = $serasa->getSerasaPefin($pefin);
	echo "<html><title>Consulta Serasa</title>";
	echo "<pre>";
	echo "-----------------------   INFORMACOES GERAIS   -----------------------\n";
	echo 'Documento:         ' . $pefin->Documento . "\n";
	echo 'Nome:              ' . $pefin->Nome . "\n";
	echo 'Nome da Mae:           ' . $pefin->NomeMae . "\n";
    echo 'Nome Fantasia:           ' . $pefin->NomeFantasia . "\n";
	echo 'Data Nascimento:   ' . $pefin->DataNascimento . "\n";
    echo 'DataFundacao:   ' . $pefin->DataFundacao . "\n";
    echo 'SituacaoRFB:   ' . $pefin->SituacaoRFB . "\n";
    echo 'SituacaoDescricaoRFB:   ' . $pefin->SituacaoDescricaoRFB . "\n";
    echo 'DataSituacaoRFB:   ' . $pefin->DataSituacaoRFB . "\n";
	echo 'Total Ocorrencias: ' . $pefin->TotalOcorrencias . "\n";
	echo 'Mensagem:          ' . $pefin->Mensagem . "\n";
	echo 'Status:            ' . $pefin->Status . "\n";
	
	echo "\n\n\n";
	echo "----------------------------------------------------------------------\n";
	echo "Alerta Documentos\n";
	echo "----------------------------------------------------------------------\n";
	foreach ($pefin->AlertaDocumentos as $AlertaDocumentos)
	{
		echo 'Mensagem  : ' . $AlertaDocumentos->Mensagem . "\n";
		echo 'DDD/Fone 1: ' . $AlertaDocumentos->DDD1 . "-" . $AlertaDocumentos->Fone1 . "\n";
		echo 'DDD/Fone 2: ' . $AlertaDocumentos->DDD2 . "-" . $AlertaDocumentos->Fone2 . "\n";
		echo 'DDD/Fone 3: ' . $AlertaDocumentos->DDD3 . "-" . $AlertaDocumentos->Fone3 . "\n";
	}
	
	echo "\n\n\n";
	echo "----------------------------------------------------------------------\n";
	echo "Pendencias Financeiras\n";
	echo "----------------------------------------------------------------------\n";
	echo "<table border='0' width='100%'>";
	echo "<tr bgcolor='#eeeeee' cellspacing='0' height='30'>";
	echo "<td>Data Ocorrencia</td>";
	echo "<td>Modalidade</td>";
	echo "<td>Avalista</td>";
	echo "<td>Valor</td>";
	echo "<td>Contrato</td>";
	echo "<td>Sigla</td>";
	echo "</tr>";
	foreach ($pefin->PendenciasFinanceiras as $PendenciasFinanceiras)
	{
		echo '<tr>';
		echo '<td>' . $PendenciasFinanceiras->DataOcorrencia . '</td>';
		echo '<td>' . $PendenciasFinanceiras->Modalidade . '</td>';
		echo '<td>' . $PendenciasFinanceiras->Avalista . '</td>';
		echo '<td>' . $PendenciasFinanceiras->Valor . '</td>';
		echo '<td>' . $PendenciasFinanceiras->Contrato . '</td>';
		echo '<td>' . $PendenciasFinanceiras->Sigla . '</td>';
		echo '</tr>';
	}
	echo "</table>";

	echo "\n\n\n";
	echo "----------------------------------------------------------------------\n";
	echo "Pendencias Varejo\n";
	echo "----------------------------------------------------------------------\n";
	echo "<table border='0' width='100%'>";
	echo "<tr bgcolor='#eeeeee' cellspacing='0' height='30'>";
	echo "<td>Codigo Compensacao Banco</td>";
	echo "<td>Numero Agencia</td>";
	echo "<td>Origem Ocorrencia</td>";
	echo "<td>Sigla</td>";
	echo "<td>Numero Loja Filial</td>";
	echo "</tr>";
	foreach ($pefin->PendenciasVarejo as $PendenciasVarejo)
	{
		echo '<tr>';
		echo '<td>' . $PendenciasVarejo->CodigoCompensacaoBanco . '</td>';
		echo '<td>' . $PendenciasVarejo->NumeroAgencia . '</td>';
		echo '<td>' . $PendenciasVarejo->OrigemOcorrencia . '</td>';
		echo '<td>' . $PendenciasVarejo->Sigla . '</td>';
		echo '<td>' . $PendenciasVarejo->NumeroLojaFilial . '</td>';
		echo '</tr>';
	}
	echo "</table>";

	echo "\n\n\n";
	echo "----------------------------------------------------------------------\n";
	echo "Pendencias Bacen/CCF\n";
	echo "----------------------------------------------------------------------\n";
	echo "<table border='0' width='100%'>";
	echo "<tr bgcolor='#eeeeee' cellspacing='0' height='30'>";
	echo "<td>Total Cheques Sem Fundo</td>";
	echo "<td>Data Ocorrencia Antiga</td>";
	echo "<td>Data Ocorrencia Recente</td>";
	echo "<td>Codigo Compensacao</td>";
	echo "<td>Numero Agencia</td>";
	echo "<td>Nome Fantasia Banco</td>";
	echo "</tr>";
	foreach ($pefin->PendenciasBacen as $PendenciasBacen)
	{
		echo '<tr>';
		echo '<td>' . $PendenciasBacen->TotalChequesSemFundo . '</td>';
		echo '<td>' . $PendenciasBacen->DataOcorrenciaAntiga . '</td>';
		echo '<td>' . $PendenciasBacen->DataOcorrenciaRecente . '</td>';
		echo '<td>' . $PendenciasBacen->CodigoCompensacao . '</td>';
		echo '<td>' . $PendenciasBacen->NumeroAgencia . '</td>';
		echo '<td>' . $PendenciasBacen->NomeFantasiaBanco . '</td>';
		echo '</tr>';
	}
	echo "</table>";


	echo "</pre></html>";


	# PRINT TODOS ELEMENTOS (TESTE)
	//print_r($pefin);
?>
