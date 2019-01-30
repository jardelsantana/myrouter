<?php
    
    /* Solicita o parâmetro "key"  */
    if(isset($_GET['key']) and $_GET['key']) {
     
        /* Verifica */
        $numeros = isset($_GET['limite']) ? intval($_GET['limite']) : 10; //10 é o padrão
        $formato = (isset($_GET['formato']) and strtolower($_GET['formato']) == 'json') ? 'json' : 'xml'; //xml é o padrão
        $tipo = $_GET['tipo'];	
        /* Conexão */
        require_once("config/conexao.class.php");
        
        $conexao = mysql_connect("$host","$login_db","$senha_db") or die('Não foi possível conectar ao banco de dados');
        mysql_select_db("$database",$conexao) or die('Não foi possível selecionar o banco de dados');
        mysql_set_charset('utf8', $conexao); 
         
        /* Seleciona */
        
        if ($tipo == "1") {
      	$tabela = 'financeiro'; 
      	} elseif ($tipo == "2") {
 	$tabela = 'clientes';
        } elseif ($tipo == "3") {
	$tabela = 'planos'; 
	} elseif ($tipo == "4") {
	$tabela = 'ordemservicos'; 
	} elseif ($tipo == "5") {
	$tabela = 'notafiscal';
	} elseif ($tipo == "6") {
	$tabela = 'tecnicos';   
	} elseif ($tipo == "7") {
	$tabela = 'sici'; 
	} elseif ($tipo == "8") {
	$tabela = 'empresa'; 
      	} else {
      	$tabela = 'assinaturas';
      	}
	
	$pesquisa = $_GET['pesquisa'];
	$idbusca = $_GET['busca'];
	
	if ($pesquisa <> "") {
      	$where = "WHERE $pesquisa = '$idbusca'"; 
      	
      	} else {
      	$where = '';
      	}
      	
      	$ordem = $_GET['ordem'];
      	if ($ordem <> "") {
      	$ordem = "ASC"; 
      	} else {
      	$ordem = 'DESC';
      	}

	    $consulta = "SELECT * FROM $tabela $where ORDER BY id $ordem LIMIT $numeros";
	
        $resultado = mysql_query($consulta,$conexao) or die('Consulta com Problemas:  ');
         
        /* cria um array mestre com os registros */
        $artigos = array();
        if(mysql_num_rows($resultado)) {
            while($artigo = mysql_fetch_assoc($resultado)) {
            
            $artigos[] = array('myrouter'=>$artigo);
            
            }
        } 
        
        
         
        /* extrai os dados no formato expecificado */
        if($formato == 'json') {
            header('Content-type: application/json');
            echo json_encode(array('myrouter'=>$artigos));
        }
        else {
            header('Content-type: text/xml');
            echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            echo '<MYROUTER>'."\n";
            foreach($artigos as $indice => $artigo) {
                if(is_array($artigo)) {
                    foreach($artigo as $chave => $valor) {
                        echo "\t<",$chave,'>'."\n";
                        if(is_array($valor)) {
                            foreach($valor as $tag => $val) {
                                echo "\t\t".'<',str_replace('pedido', 'pedido', $tag) ,'><![CDATA[',$val,']]></',str_replace('pedido', 'pedido', $tag) ,'>'."\n";
                            }
                        }
                        echo "\t".'</',$chave,'>'."\n";
                    }
                }
            }  
            echo '</MYROUTER>'."\n";
        }
         
        /* desconecta do banco de dados */
        @mysql_close($conexao);
    }
 
?>