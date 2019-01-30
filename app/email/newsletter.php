<?PHP
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );

if(isset($_POST['submit'])) {
    $subject = $_POST['assunto'];
    $texto = $_POST['text'];

    if (empty($texto)) {
        echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Newsletter&reg=3" />';
    } else {
        require_once("../../config/conexao.class.php");

        $sql5 = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
        $emp = mysqli_fetch_array($sql5);
        $NomeEmpresa = $emp['empresa'];
        $EmailEmpresa = $emp['email'];

//configurações do e-mail 
        $subject = $subject;
        $nome_remetente = $NomeEmpresa;
        $email_remetente = $EmailEmpresa;

        $quant = 10; //número de mensagens enviadas de cada vez
        $sec = 10; //tempo entre o envio de um pacote e outro (em segundos)


        require 'PHPMailerAutoload.php';

        $sql = $mysqli->query("SELECT * FROM maile") or die (mysql_error());
        $linha = mysqli_fetch_array($sql);
        $empresa = $linha['empresa'];
        $url = $linha['url'];
        $servidor = $linha['servidor'];
        $porta = $linha['porta'];
        $smtpsecure = $linha['smtpsecure'];
        $endereco = $linha['endereco'];
        $limitemail = $linha['limitemail'];
        $aviso = $linha['aviso'];
        $avisofataberto = $linha['avisofataberto'];
        $email = $linha['email'];
        $senha = $linha['senha'];
        $text1 = $linha['text1'];
        $text2 = $linha['text2'];
        $text3 = $linha['text3'];

        function base64url_encode($data)
        {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }

//email de teste
        $mail_send = $EmailCliente;


        $ok = 0;
        $inicio = 0;
        $fim = $inicio + $quant;

        $campos = "id,email,nome,status"; //campos da tabela

        $sql = "select $campos from clientes where status = 'S' limit $inicio,$fim";
        $query = $mysqli->query($sql, $conexao);
        $registros = mysqli_num_rows($query);


        if ($registros == 'S') {
            printf("<font face=?tahoma?>todas as mensagens foram enviadas!</font>");
            $ok = 1;
        }


        while ($result = mysqli_fetch_array($query)) {
            $id = $result[0];
            $to = $result[1];
            $status = $result[2];

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
            $mail->addAddress($to, $subject, $body, $headers);     // Nome do cabra que vai receber
            $mail->addReplyTo("From: $nome_remetente <$email_remetente>");


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Adicionar anexos
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Anexo com o nome 'opcional'


            $mail->isHTML(true);                                  // Seta email no formato HTML

            $mail->Subject = "Informativo " . $subject;
            $mail->Body = "
	<br>
         $texto </br>
	";
            if (!$mail->Send()) {
                echo "Erro: " . utf8_decode($mail->ErrorInfo);
                echo "<br />";
                  echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Newsletter&reg=2" />';
            } else {
                echo "<br />";
                    echo '<meta http-equiv="refresh" content="0;URL=../../index.php?app=Newsletter&reg=1" />';

            }

        }


        mysqli_free_result($query);
        mysqli_close($conexao);

//if(!$ok)
//{
        //   echo("<meta http-equiv=\"refresh\" content=\"" . $sec . "\">");
//}
    }
}
?> 