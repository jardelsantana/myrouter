<?php

//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
//error_reporting(E_ERROR | E_PARSE | E_WARNING );

require_once("../../config/conexao.php");



$cn=mysql_connect($host, $usuario, $senha);
mysql_select_db($banco);

$clienteemail    = base64_decode($_GET['cliente']);

$sql3 = mysql_query("SELECT * FROM clientes WHERE id='$clienteemail'")or die (mysql_error());
$cli = mysql_fetch_array($sql3);
$EmailCliente = $cli['email'];
$NomeCliente = $cli['nome'];

$fatura2     = base64_decode ($_GET['fatura']);

$sql4 = mysql_query("SELECT * FROM financeiro WHERE id ='$fatura2'")or die (mysql_error());
$fin = mysql_fetch_array($sql4);
$CampoValor = $fin['valor'];
$CampoVencimento = $fin['vencimento'];
$Camponfatura = $fin['nfatura'];

$sql5 = mysql_query("SELECT * FROM empresa WHERE id = '1'");
$emp = mysql_fetch_array($sql5);
$NomeEmpresa = $emp['empresa'];





require("class.phpmailer.php"); // Certifique-se de que o caminho está certo

$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
$linha = mysql_fetch_array($sql);
$empresa        = $linha['empresa'];
$url            = $linha['url'];
$servidor       = $linha['servidor'];
$porta          = $linha['porta'];
$endereco       = $linha['endereco'];
$limitemail     = $linha['limitemail'];
$aviso          = $linha['aviso'];
$avisofataberto = $linha['avisofataberto'];
$email          = $linha['email'];
$senha          = $linha['senha'];
$text1          = $linha['text1'];
$text2          = $linha['text2'];
$text3          = $linha['text3'];

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

//email de teste
$mail_send =  $EmailCliente;

$mail = new PHPMailer();
$mail->SetLanguage("br", "/haskdfhasd"); // Linguagem
$porta_mail = $linha['porta']; //Sql da porta do email
$mail->SMTP_PORT  = $porta_mail; // Porta do SMTP
$mail->SMTPSecure = "false"; // Tipo de comunicação segura
$mail->IsSMTP();
$smtp_mail = $linha['servidor']; //Sql smtp do servidor de email
$mail->Host     = $smtp_mail;  // Endereço do servidor SMTP
$mail->SMTPAuth = true; // Requer autenticação?
$user_mail = $linha['email']; //Sql Usuario do email
$mail->Username = $user_mail; // Usuário SMTP
$senha_mail = $linha['senha']; //Sql Senha do email
$mail->Password = $senha_mail; // Senha do usuário SMTP
$mail->From     = $user_mail; // E-mail do remetente
$mail->FromName = $NomeEmpresa; // Nome do remetente
$mail->AddAddress($mail_send); // E-mail do destinatário
$mail->IsHTML(true);
$mail->Subject = "Financeiro ".$NomeEmpresa;

$cliente    = $_GET['cliente'];
$fatura     = $_GET['fatura'];

$link = "$url/boleto.php?cliente=$cliente&fatura=$fatura&tipo=1";

$dado = $text2;
$search = array('[NomeCliente]', '[valor]','[vencimento]','[numeroFatura]','[Descricaodafatura]','[link]','[endereco]','[email]','[avisofataberto]','[NomeEmpresa]','[referencia]'); // pega oa variaveis do html vindo do banco;
$replace = array($NomeCliente, number_format($CampoValor,2,',','.'),$CampoVencimento,$Camponfatura,$referente,$link,$endereco,$email,$avisofataberto,$NomeEmpresa,'Fatura de Mensalidade'); //  variavis que substiruem os valores
$subject = $dado;

$texto = str_replace($search, $replace, $subject);

$mss = "
	<br>
	        $texto </br>
	";

	$mail->Body = "
	$mss";
	if(!$mail->Send()) {
		echo "Erro: " . utf8_decode($mail->ErrorInfo);
		echo "<br />";
		echo "Não foi possivel enviar cobrança para! : $mail_send"; 
	} else {
	    echo "<br />";
        echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Financeiro&reg=5" />';

	}								
?>