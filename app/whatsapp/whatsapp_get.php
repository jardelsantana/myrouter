<?php
$fone = $_GET['fone'];
$mensagem = $_GET['mensagem'];

$telefone = $fone = $_GET['fone'];
$mensagens = $mensagem = $_GET['mensagem'];

if($fone !='' && $mensagem !=''){
    shell_exec("yowsup-cli demos -s 55{$telefone} \"{$mensagens}\" -c /etc/whatsapp/whatsapp.conf");
    echo "MENSAGEM ENVIADA";
}else{
    echo "NAO FOI ENVIADO";
}

//$content = file_get_contents("http://whatsapp.myrouter.com.br/api.php?fone=$telefone&mensagem=$mensagens");
//echo $content;

?>

