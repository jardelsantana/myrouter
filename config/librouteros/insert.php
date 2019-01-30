<?php

// Define
$router   = '192.168.0.189';
$username = 'admin';
$password = '';

$id = "257605";

require_once '../mikrotik.class.php';

echo "<br><br>";


echo "<BR><BR>";

// Comando 

$command = '/log/print';
$args    = array('name'=> 'backup-mikrotik.backup');


// API

require_once 'RouterOS.php';

$mikrotik = new Lib_RouterOS();
$mikrotik->setDebug(false);

try {
    // Estabelecer conexão com roteador; lança exceção se a conexão falha
    $mikrotik->connect($router);

    // Enviar seqüência de login; lança exceção no inválido nome de usuário / senha
    $mikrotik->login($username, $password);

    // Codifica e envia comando para router; lança exceção se a conexão perdida
    $mikrotik->send($command, $args);

    
    // Resposta do MK
    $response = $mikrotik->read();

    // Exibi Resposta
    print_r($response);
    
    
    
    echo $first['.ret'];

} catch (Exception $ex) {
    echo "Debug: " . $ex->getMessage() . "\n";
}
