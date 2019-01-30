<?php

// Define
$router   = '192.168.43.180:8728';
$username = 'admin';
$password = '';

// Comando
$command = '/system/resource/print';
$args    = array('.proplist' => 'version,cpu,cpu-frequency,cpu-load,uptime');

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
    
    $first = $response['0'];
    
    echo $first['version'];

} catch (Exception $ex) {
    echo "Debug: " . $ex->getMessage() . "\n";
}
