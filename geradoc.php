<?php

    
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
    $idass = base64_decode($_GET['id']); 
    $imp = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$idass'");
    $assinatura = mysqli_fetch_array($imp);
    
    $idcliente = $assinatura['cliente'];
    $clientes = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
    $cliente = mysqli_fetch_array($clientes);
    
    $idplano = $assinatura['plano'];
    $planos = $mysqli->query("SELECT * FROM planos WHERE id = '$idplano'");
    $planoCli = mysqli_fetch_array($planos);
    
    $ers = $mysqli->query("SELECT * FROM empresa");
    $er = mysqli_fetch_array($ers);

    header( "Content-type: application/msword" );
    header( "Content-Disposition: inline, filename=contrato.rtf");
    
    $enome = $er['empresa'];
    $ecnpj = $er['cnpj'];
    $eend = $er['endereco'];
    $contratocliente = $er['contratocliente'];
    $ecidade = $er['cidade'];
    $euf = $er['estado'];
    $ecep = $er['cep'];
    $etel = $er['tel1'];
    $ecel = $er['tel2'];
    
    $cnome = $cliente['nome'];
    $ccpf = $cliente['cpf'];
    $crg = $cliente['rg'];
    $cestadocivil = $cliente['estadocivil'];
    $cdatanascimento = $cliente['nascimento'];
    $cend = $cliente['endereco'];
    $cnumero = $cliente['numero'];
    $ccomplemento = $cliente['complemento'];
    $cbairro = $cliente['bairro'];
    $ccidade =$cliente['cidade'];
    $cuf = $cliente['estado'];
    $ccep = $cliente['cep'];
    $ctel = $cliente['tel'];
    $ccel = $cliente['cel'];
    $cemail = $cliente['email'];

    $plano = $planoCli['nome'];
    $preco = $planoCli['preco'];
    $data_hoje = date('d-m-Y');


// Abre seu template do contrato
    $arquivo = "assets/$contratocliente";
    $fp = fopen ($arquivo, "r");

    //Le o template na variavel
    $output = fread($fp, filesize($arquivo));
  
    fclose ($fp);
  
    //Substitui as tags pelas variáveis
    $output = str_replace( "<<r_nome>>", $enome, $output );
    $output = str_replace( "<<r_cnpj>>", $ecnpj, $output );
    $output = str_replace( "<<r_end>>", $eend, $output );
    $output = str_replace( "<<r_cidade>>", $ecidade, $output );
    $output = str_replace( "<<r_estado>>", $euf, $output );
    $output = str_replace( "<<r_cep>>", $ecep, $output );
    $output = str_replace( "<<cliente_nome>>", $cnome, $output );
    $output = str_replace( "<<cliente_cpf>>", $ccpf, $output );
    $output = str_replace( "<<cliente_rg>>", $crg, $output );
    $output = str_replace( "<<cliente_estadocivil>>", $cestadocivil, $output );
    $output = str_replace( "<<cliente_end>>", $cend, $output );
    $output = str_replace( "<<cliente_numero>>", $cnumero, $output );
    $output = str_replace( "<<cliente_complemento>>", $ccomplemento, $output );
    $output = str_replace( "<<cliente_bairro>>", $cbairro, $output );
    $output = str_replace( "<<cliente_cidade>>", $ccidade, $output );
    $output = str_replace( "<<cliente_estado>>", $cuf, $output );
    $output = str_replace( "<<cliente_cep>>", $ccep, $output );
    $output = str_replace( "<<cliente_tel>>", $ctel, $output );
    $output = str_replace( "<<cliente_cel>>", $ccel, $output );
    $output = str_replace( "<<cliente_email>>", $cemail, $output );
    $output = str_replace( "<<cliente_datanascimento>>", $cdatanascimento, $output );
    $output = str_replace( "<<plano_nome>>", $plano, $output );
    $output = str_replace( "<<valor>>", $preco, $output );
    $output = str_replace( "<<data_hoje>>", $data_hoje, $output );




//Envia documento para o browser
    echo $output;
	

?>