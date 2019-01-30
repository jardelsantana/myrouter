<?php
$host = 'localhost';
$usuario = 'root';
$senha = '33#erp@myrouter#33';
$banco = 'myrouter';

$bd = new mysqli($host,$usuario,$senha,$banco) or die("Não é Possivel Conecta ao Banco de Dados");
$dbremessa = new mysqli($host,$usuario,$senha,$banco) or die("Não é Possivel Conecta ao Banco de Dados");


?>