<?php  
	include_once('config/Boleto.class.php');
	
	
	$cliente = base64_decode($_GET['cliente']);
	$assinatura = base64_decode($_GET['fatura']);
	$tipo = $_GET['tipo'];
	$boleto = new Boleto;
	
	$empresas = mysql_query("SELECT * FROM empresa WHERE id = '1'");
	$empresa = mysql_fetch_array($empresas);

/*	/////MIGRACAO PARA DE BANCO /////
	$financeiro2 = mysql_query("SELECT * FROM financeiro WHERE id = $assinatura");
	$financeiro_migracao = mysql_fetch_array($financeiro2);

	if($financeiro_migracao['migracaodebanco'] == "CAIXA")  {

	if($tipo == 1) {
		$boleto->emitir_cef($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) {
		$boleto->emitir_cef($cliente,$assinatura,$tipo);
	}

	}
	/////MIGRACAO PARA DE BANCO /////*/



	if($empresa['banco'] == 1) { 
	
	if($tipo == 1) { 
	$boleto->emitir_bb($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_bb($cliente,$assinatura,$tipo);
	}
	
	} // BANCO DO BRASIL 
	
	
	if($empresa['banco'] == 2) { 
	
	if($tipo == 1) { 
	$boleto->emitir_bradesco($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_bradesco($cliente,$assinatura,$tipo);
	}
	
	} // BRADESCO
	
	if($empresa['banco'] == 3) { 
	
	if($tipo == 1) { 
	$boleto->emitir_cef($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_cef($cliente,$assinatura,$tipo);
	}
	
	} // CEF
	
	if($empresa['banco'] == 4) { 
	
	if($tipo == 1) { 
	$boleto->emitir_itau($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_itau($cliente,$assinatura,$tipo);
	}
	
	} // ITAÚ
	
	if($empresa['banco'] == 5) { 
	
	if($tipo == 1) { 
	$boleto->emitir_santander($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_santander($cliente,$assinatura,$tipo);
	}
	
	} // SANTANDER
	
	
	if($empresa['banco'] == 6) { 
	
	if($tipo == 1) { 
	$boleto->emitir_sicoob($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_sicoob($cliente,$assinatura,$tipo);
	}
	
	} // SICOOB
	
	
	if($empresa['banco'] == 7) { 
	
	if($tipo == 1) { 
	$boleto->emitir_sicredi($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_sicredi($cliente,$assinatura,$tipo);
	}
	
	} // SICREDI
	
	
	if($empresa['banco'] == 8) { 
	
	if($tipo == 1) { 
	$boleto->emitir_hsbc($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_hsbc($cliente,$assinatura,$tipo);
	}
	
	} // HSBC
	
	if($empresa['banco'] == 9) { 
	
	if($tipo == 1) { 
	$boleto->emitir_real($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) { 
	$boleto->emitir_real($cliente,$assinatura,$tipo);
	}
	
	} // BANCO REAL



 /////MIGRACAO PARA GERENCIANET /////

/*
	if($empresa['banco'] == 10) {

	if($tipo == 1) {
		$boleto->emitir_itau($cliente,$assinatura,$tipo);
	}
	if($tipo == 2) {
		$boleto->emitir_itau($cliente,$assinatura,$tipo);
	}

}

*/

/////MIGRACAO PARA GERENCIANET /////



    if($empresa['banco'] == 99) {

    if($tipo == 1) {
        $boleto->emitir_carne($cliente,$assinatura,$tipo);
    }
    if($tipo == 2) {
        $boleto->emitir_carne($cliente,$assinatura,$tipo);
    }

} // CARNÊ



?>
