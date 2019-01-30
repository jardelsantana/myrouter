<?php
////////////////////////////////////////////////////////////////////////////////////////
//$conexao = connect("192.168.1.1", "ubnt", "ubnt", '22', "true");
//$retorno = executa("wstalist -i ath0", $conexao, "true");
//print_r($retorno);
////////////////////////////////////////////////////////////////////////////////////////
function conecta_ubnt($server, $login, $password, $porta, $debug) {
	if($porta==""){
		$porta = 22;	
	}
	if (!function_exists("ssh2_connect")) die("ERRO: Biblioteca PHP SSH2 nao esta funcionando corretamente!");
	if(!($con = ssh2_connect($server, $porta))){
		if($debug=="true"){echo "ERRO: Nao foi possivel se conectar\n";}
	} else {
		if(!ssh2_auth_password($con, $login, $password)) {
			if($debug=="true"){echo "ERRO: usuario e senhas invalidos\n";}
		}
	return $con;
	}
}
	
function executa_ubnt($cmd, $con, $debug){
	if (!($stream = ssh2_exec($con, $cmd ))) {
		if($debug=="true"){echo "ERRO: Nao foi possivel executar o comando\n";}
	} else {
		$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
		stream_set_blocking($stream, true);
		$stream = stream_get_contents($stream);
		return json_decode($stream, true);
	}
}
?>
	
	
