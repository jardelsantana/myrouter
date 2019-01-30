
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );

    require_once 'config/conexao.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
$mes = date('m');
$ano = date('Y');
$conlote = base64_decode($_GET['id']);
$sql = $mysqli->query("SELECT * FROM notafiscal WHERE nlote = '$conlote'");
$nfse = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);

$nomelote = $nfse['nlote'];
function acentoNFE($string)
{
  $string = str_replace('á','a',$string);
  $string = str_replace('Á','A',$string);
  $string = str_replace('à','a',$string);
  $string = str_replace('À','A',$string);
  $string = str_replace('â','a',$string);
  $string = str_replace('Â','A',$string);
  $string = str_replace('ã','a',$string);
  $string = str_replace('Ã','A',$string);
  $string = str_replace('ç','c',$string);
  $string = str_replace('Ç','C',$string);
  $string = str_replace('é','e',$string);
  $string = str_replace('É','E',$string);
  $string = str_replace('ê','e',$string);
  $string = str_replace('Ê','E',$string);
  $string = str_replace('è','e',$string);
  $string = str_replace('È','E',$string);
  $string = str_replace('í','i',$string);
  $string = str_replace('Í','I',$string);
  $string = str_replace('ó','o',$string);
  $string = str_replace('Ó','O',$string);
  $string = str_replace('ô','o',$string);
  $string = str_replace('Ô','O',$string);
  $string = str_replace('õ','o',$string);
  $string = str_replace('Õ','O',$string);
  $string = str_replace('ú','u',$string);
  $string = str_replace('Ú','U',$string);
  $string = str_replace('~','',$string);
  $string = str_replace('&','e',$string);
  $string = str_replace('-','',$string);
  
  return $string;
  
  }
// Verifica
if($row >0) {

$arquivo = "XML/RPSNFSe-$nomelote.xml";

// Abre se não cria
$ponteiro = fopen($arquivo, "w");

// Escrevendo XML
	
$lote = $nfse['lote'];
$nlote = $nfse['nlote'];
$cnpj = $nfse['cnpj'];
$id = $nfse['id'];
$inscricaomunicipal = $nfse['inscricaomunicipal'];
$qtdrps = $nfse['qtdrps'];
for($i=0; $i<$row; $i++) {

}

fwrite($ponteiro, "<?xml version='1.0' encoding='utf-8'?> ");
fwrite($ponteiro, '<EnviarLoteRpsEnvio xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://www.abrasf.org.br/nfse">');
fwrite($ponteiro, "<LoteRps Id='RPS$nlote'>");
fwrite($ponteiro, "<NumeroLote>$nlote</NumeroLote>");
fwrite($ponteiro, "<Cnpj>$cnpj</Cnpj>");
fwrite($ponteiro, "<InscricaoMunicipal>$inscricaomunicipal</InscricaoMunicipal>");
fwrite($ponteiro, "<QuantidadeRps>$qtdrps</QuantidadeRps>");
fwrite($ponteiro, "<ListaRps>");

for($i=0; $i<$row; $i++) {

// Pega os dados 

$infrps = mysql_result($sql,$i,"infrps");
$numero = mysql_result($sql,$i,"numero");
$serie = mysql_result($sql,$i,"serie");
$tipo = mysql_result($sql,$i,"tipo");
$emissao = mysql_result($sql,$i,"emissao");
$naturezaop = mysql_result($sql,$i,"naturezaop");
$opsimples = mysql_result($sql,$i,"opsimples");
$ic = mysql_result($sql,$i,"ic");
$status = mysql_result($sql,$i,"status");
$valorservicos = number_format(mysql_result($sql,$i,"valorservicos"),2,'.','');
$valordeducoes = mysql_result($sql,$i,"valordeducoes");
$valorpis = mysql_result($sql,$i,"valorpis");
$valorcofins = mysql_result($sql,$i,"valorcofins");
$valorinss = mysql_result($sql,$i,"valorinss");
$valorir = mysql_result($sql,$i,"valorir");
$valorcsll = mysql_result($sql,$i,"valorcsll");
$issretido = mysql_result($sql,$i,"issretido");
$valoriss =  mysql_result($sql,$i,"valoriss");
$valoroutros =  mysql_result($sql,$i,"valoroutros");
$aliquota =  mysql_result($sql,$i,"aliquota");
$descontoi =  mysql_result($sql,$i,"descontoi");
$descontoc =  mysql_result($sql,$i,"descontoc");
$descricao =  mysql_result($sql,$i,"descricao");
$codmunicipio = mysql_result($sql,$i,"codmunicipio");
$cnpj =  mysql_result($sql,$i,"cnpj");
$clientecpf =  mysql_result($sql,$i,"clientecpf");
$clientenome = acento(mysql_result($sql,$i,"clientenome"));
$clienteendereco = acento(mysql_result($sql,$i,"clienteendereco"));
$clientenumero = acento(mysql_result($sql,$i,"clientenumero"));
$clientecomplemento = acento(mysql_result($sql,$i,"clientecomplemento"));
$clientebairro = acento(mysql_result($sql,$i,"clientebairro"));
$clientecidade = acento(mysql_result($sql,$i,"clientecidade"));
$clienteuf = acento(mysql_result($sql,$i,"clienteuf"));
$clientecep = acento(mysql_result($sql,$i,"clientecep"));
$clienteemail = acento(mysql_result($sql,$i,"clienteemail"));
$anorps = mysql_result($sql,$i,"anorps");
$mesrps = mysql_result($sql,$i,"mesrps");

// Monta XML
$conteudo = "<Rps>";
$conteudo .= "<InfRps Id='$infrps'>";
$conteudo .= "<IdentificacaoRps>";
$conteudo .= "<Numero>$idnf</Numero>";
$conteudo .= "<Serie>$serie</Serie>";
$conteudo .= "<Tipo>$tipo</Tipo>";
$conteudo .= "</IdentificacaoRps>";
$conteudo .= "<DataEmissao>$emissao</DataEmissao>";
$conteudo .= "<NaturezaOperacao>$naturezaop</NaturezaOperacao>";
$conteudo .= "<OptanteSimplesNacional>$opsimples</OptanteSimplesNacional>";
$conteudo .= "<IncentivadorCultural>$ic</IncentivadorCultural>";
$conteudo .= "<Status>$status</Status>";
$conteudo .= "<Servico>";
$conteudo .= "<Valores>";
$conteudo .= "<ValorServicos>$valorservicos</ValorServicos>";
$conteudo .= "<ValorDeducoes>$valordeducoes</ValorDeducoes>";
$conteudo .= "<ValorPis>$valorpis</ValorPis>";
$conteudo .= "<ValorCofins>$valorcofins</ValorCofins>";
$conteudo .= "<ValorInss>$valorinss</ValorInss>";
$conteudo .= "<ValorIr>$valorir</ValorIr>";
$conteudo .= "<ValorCsll>0.00</ValorCsll>";
$conteudo .= "<IssRetido>$issretido</IssRetido>";
$conteudo .= "<ValorIss>$valoriss</ValorIss>";
$conteudo .= "<OutrasRetencoes>$valoroutros</OutrasRetencoes>";
$conteudo .= "<Aliquota>$aliquota</Aliquota>";
$conteudo .= "<DescontoIncondicionado>$descontoi</DescontoIncondicionado>";
$conteudo .= "<DescontoCondicionado>$descontoc</DescontoCondicionado>";
$conteudo .= "</Valores>";
$conteudo .= "<ItemListaServico>$codservico</ItemListaServico>";
$conteudo .= "<CodigoTributacaoMunicipio>$codtributo</CodigoTributacaoMunicipio>";
$conteudo .= "<Discriminacao>$descricao</Discriminacao>";
$conteudo .= "<CodigoMunicipio>$codmunicipio</CodigoMunicipio>";
$conteudo .= "</Servico>";
$conteudo .= "<Prestador>";
$conteudo .= "<Cnpj>$cnpj</Cnpj>";
$conteudo .= "<InscricaoMunicipal>$IE1</InscricaoMunicipal>";
$conteudo .= "</Prestador>";
$conteudo .= "<Tomador>";
$conteudo .= "<IdentificacaoTomador>";
$conteudo .= "<CpfCnpj>";
$conteudo .= "<Cpf>$clientecpf</Cpf>";
$conteudo .= "</CpfCnpj>";
$conteudo .= "</IdentificacaoTomador>";
$conteudo .= "<RazaoSocial>$clientenome</RazaoSocial>";
$conteudo .= "<Endereco>";
$conteudo .= "<Endereco>$clienteendereco</Endereco>";
$conteudo .= "<Numero>$clientenumero</Numero>";
$conteudo .= "<Complemento>$clientecomplemento</Complemento>";
$conteudo .= "<Bairro>$clientebairro</Bairro>";
$conteudo .= "<CodigoMunicipio>$codmunicipio</CodigoMunicipio>";
$conteudo .= "<Uf>$clienteuf</Uf>";
$conteudo .= "<Cep>$clientecep</Cep>";
$conteudo .= "</Endereco>";
$conteudo .= "<Contato>";
$conteudo .= "<Email>$clienteemail</Email>";
$conteudo .= "</Contato>";
$conteudo .= "</Tomador>";
$conteudo .= "</InfRps>";
$conteudo .= "</Rps>";

// Escreve
fwrite($ponteiro, $conteudo);
} // Fecha FOR

fwrite($ponteiro, "</ListaRps>");
fwrite($ponteiro, "</LoteRps>");
fwrite($ponteiro, "</EnviarLoteRpsEnvio>");

// Fecha XML
fclose($ponteiro);

// Mensagem

} // Fecha IF($row)
?>
	<script>
alert('RPS Gerado e Atualizado');
document.location.href = ("XML/RPSNFSe-<?php echo $nfse['nlote']; ?>.xml");
    </script>
