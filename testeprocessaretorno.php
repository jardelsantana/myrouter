<?php

// prepara o ambiente para testar o processo
$_FILES['arquivo'] = array(
    'type' => 'ret',
    'name' => 'CN01075A.RET',
    'tmp_name' => __DIR__.'/CN01075A.RET',
);

include 'processa.retorno.php';
