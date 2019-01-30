<?php

if(!empty($_POST['post'])){
    $nome = $_POST['nome'];
    $fone = $_POST['fone'];
    $msg  = $_POST['msg'];

    $num = "55$fone";

    $s = shell_exec("yowsup-cli demos -s {$num} \"Mensagen de: {$nome} :: MSG: {$msg}\" -c /etc/yowsup/config.conf");
    echo $s;
    echo 'Menagen enviada';
}


?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <form action="" method="post">
        <input type="hidden" name="post" value="1">
        <label for="">Nome:
            <input type="text" required class="form-control" name="nome" id="nome">
        </label>
        <br>
        <label for="">Fone:
            <input type="text" required title="Insira um numero de telefone valido" placeholder="Ex. ddd+fone" class="form-control" name="fone" id="fone">
        </label>
        <br>
        <label for="">Mensagem:
            <textarea name="msg" required class="form-control"  id="msg" cols="30" rows="3"></textarea>
        </label>
        <hr>
        <label for="">
            <input type="submit" class="btn btn-default" value="Enviar">
        </label>
    </form>
</div>
</body>
</html>
