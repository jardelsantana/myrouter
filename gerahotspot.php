<?php

 	require('../routeros_api.class.php');
 	$API = new routeros_api();
    $API->debug = true;

 	$name = $_POST['nome']; 	
 	$cpf = $_POST['cpf'];   
 	$telefone = $_POST['ddd'].$_POST['fone']; 
 	$senha= rand (1000, 9999);     
 

 	$url =  "http://torpedus.com.br/sms/index.php?app=webservices&u=#user&p=#password&ta=pv&to=55".$telefone."&msg=ola+".$name."+seu+usuario+".$cpf."+sua+senha+".$senha;
 	
 	$curl = curl_init();
 	
 	curl_setopt($curl, CURLOPT_URL, $url);
 	curl_exec($curl);
 	curl_close($curl);
 

 	$ip = 'Ip from server where API is located';
 	$usuario = 'User';
 	$senharb = 'password';

        if ($API>connect($ip, $usuario, $senharb)){
 	$API>comm("/ip/hotspot/user/add", array(
          "name"     => $cpf,
          "password" => $senha,
          "server" => "server",
          "profile"  => "default",
 		));
 		$API>disconnect();
 	}
 	
 ?>
