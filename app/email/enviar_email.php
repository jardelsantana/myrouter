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
$CampoLink = $fin['linkGerencia'];
$CampoVencimento = date('d/m/Y',strtotime($fin['vencimento']));
$Camponfatura = $fin['id'];

$sql5 = mysql_query("SELECT * FROM empresa WHERE id = '1'");
$emp = mysql_fetch_array($sql5);
$NomeEmpresa = $emp['empresa'];


require 'PHPMailerAutoload.php';

$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
$linha = mysql_fetch_array($sql);
$empresa        = $linha['empresa'];
$url            = $linha['url'];
$servidor       = $linha['servidor'];
$porta          = $linha['porta'];
$smtpsecure     = $linha['smtpsecure'];
$endereco       = $linha['endereco'];
$limitemail     = $linha['limitemail'];
$aviso          = $linha['aviso'];
$avisofataberto = $linha['avisofataberto'];
$email          = $linha['email'];
$senha          = $linha['senha'];
$text1          = $linha['text1'];
$text2          = $linha['text2'];
$text3          = $linha['text3'];
$text4          = $linha['text4'];

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

//email de teste
$mail_send =  $EmailCliente;



$cliente    = $_GET['cliente'];
$fatura     = $_GET['fatura'];


$selbanco = mysql_query("SELECT * FROM empresa") or die(mysql_error());
$confere = mysql_fetch_array($selbanco);

if($confere['banco'] == "10"){

    $link = $CampoLink;

    $dado = $text4;
    $search = array('[NomeCliente]', '[valor]','[vencimento]','[numeroFatura]','[Descricaodafatura]','[link]','[endereco]','[email]','[avisofataberto]','[NomeEmpresa]','[referencia]'); // pega oa variaveis do html vindo do banco;
    $replace = array($NomeCliente, number_format($CampoValor,2,',','.'),$CampoVencimento,$Camponfatura,$referente,$link,$endereco,$email,$avisofataberto,$NomeEmpresa,'Fatura de Mensalidade'); //  variavis que substiruem os valores
    $subject = $dado;

    $texto = str_replace($search, $replace, $subject);

}else{

$link = "$url/boleto.php?cliente=$cliente&fatura=$fatura&tipo=1";

$dado = $text2;
$search = array('[NomeCliente]', '[valor]','[vencimento]','[numeroFatura]','[Descricaodafatura]','[link]','[endereco]','[email]','[avisofataberto]','[NomeEmpresa]','[referencia]'); // pega oa variaveis do html vindo do banco;
$replace = array($NomeCliente, number_format($CampoValor,2,',','.'),$CampoVencimento,$Camponfatura,$referente,$link,$endereco,$email,$avisofataberto,$NomeEmpresa,'Fatura de Mensalidade'); //  variavis que substiruem os valores
$subject = $dado;

$texto = str_replace($search, $replace, $subject);
}


$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Habilita o Debug 1 habilita 0 desabilita

$mail->isSMTP();
$smtp_mail = $linha['servidor']; //Sql smtp do servidor de email
$mail->Host = $smtp_mail;  // Servidor SMTP SMTP servers
$mail->SMTPAuth = true;                               // Habilita autenticação SMTP
$user_mail = $linha['email']; //Sql Usuario do email
$mail->Username = $user_mail;                 //Usuario do SMTP
$senha_mail = $linha['senha']; //Sql Senha do email
$mail->Password = $senha_mail;                           //Senha do SMTP
$porta_smtpsecure = $linha['smtpsecure'];
$mail->SMTPSecure = $porta_smtpsecure;                            // Habilita TLS encriptação , ou `ssl` encriptado
$porta_mail = $linha['porta']; //Sql da porta do email
$mail->Port = $porta_mail;                                    // porta para a conexão TCP 587 ou 465
$mail->From = $user_mail;
$mail->FromName = $NomeEmpresa;
$mail->addAddress($EmailCliente, $NomeCliente);     // Nome do cabra que vai receber
$mail->addReplyTo($user_mail, $NomeEmpresa);



//$mail->addAttachment('/var/tmp/file.tar.gz');         // Adicionar anexos
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Anexo com o nome 'opcional'
$mail->isHTML(true);                                  // Seta email no formato HTML

$mail->Subject = "Financeiro ".$NomeEmpresa;
$mail->Body    = "
	<br>
	        $texto </br>
	";
$mail->AltBody = 'Texto alternativo sem HTML da pra usar como outro esquema assinatura ou coisa parecida';

if(!$mail->Send()) {
    echo "Erro: " . utf8_decode($mail->ErrorInfo);
    echo "<br />";
    echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Financeiro&reg=6" />';
} else {
    echo "<br />";
    echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Financeiro&reg=5" />';

}

?>