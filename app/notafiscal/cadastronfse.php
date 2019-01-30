<?php 

			
    if(isset ($_POST['cadastrar'])){ 
    
    function converteData($data){
    (!strstr($data,'/')) ? sscanf($data,'%d-%d-%d',$y,$m,$d) : sscanf($data,'%d/%d/%d',$d,$m,$y);
    return (!strstr($data,'/')) ? sprintf('%d/%d/%d',$d,$m,$y) : sprintf('%d-%d-%d',$y,$m,$d);
    }
    $dataemissao = date('d/m/Y');
    $formdata = date('Y-m-d', strtotime(converteData($dataemissao)));
    $emissao = $formdata;
    $lote = "LOT".date('m'.'Y');
    $nlote = $_POST['nlote'];
    $inscricaomunicipal = $chavekey['im'];
    $codservico = $chavekey['codservico'];
    $codtributo = $chavekey['codtributo'];
    $numero = $nlote;
    $serie = $chavekey['serie'];
    $tipo = $chavekey['tipo'];
    $emissao = $emissao;
    $naturezaop = $chavekey['naturezaop'];
    $opsimples = $chavekey['opsimples'];
    $ic = $chavekey['ic']; 
    $status = '1';
    $valordeducoes = '0';
    $valorpis = $_POST['ValorPis'];
    $valorcofins = $_POST['ValorCofins'];
    $valorinss = $_POST['ValorInss'];
    $valorir = $_POST['ValorIr'];
    $valoresisentos = $_POST['valoresisentos'];
    $outrosvalores = $_POST['outrosvalores'];
    $valorcsll = '0.00';
    $issretido = $_POST['IssRetido'];
    $valoriss = $_POST['ValorIss'];
    $valoroutros = $_POST['OutrasRetencoes'];
    $icms = $_POST['icms'];
    $aliquota = $_POST['Aliquota'];
    $descontoi = '0';
    $descontoc = '0';
    $vscom = '104';
    $codmunicipio = $chavekey['codmunicipio'];
    $cnpj1 = str_replace("-", "", $chavekey['cnpj']); 
    $cnpj2 = str_replace(".", "", $cnpj1);
    $geracnpj = str_replace("/", "", $cnpj2);
    $cnpj = $geracnpj;
    $anorps = date('Y');
    $mesrps = date('m');
    $quantidadecontratada = '1';
    $quantidadefornecida = '1';
    $grupotensao = '00';
    $situacao = 'N';
    $nome_arquivo = $chavekey['estado']."00".$tipo.date('y').date('m')."N"."M"."."."001";

    $notaNFe = 1;
    $i = 0;
    $consultas = $mysqli->query("SELECT * FROM clientes WHERE nf = 'S'");
    while($campo = mysqli_fetch_array($consultas)){
    $i++;

    $numeronfe = str_pad($notaNFe, 9, 0, STR_PAD_LEFT);// tamanho 9
    $notaNFe++;

    //gerar numero  da Nota
   // $qr_numero = mysql_query("SELECT * FROM notafiscal ORDER BY id DESC");
   // $row_numero = mysql_fetch_array($qr_numero);
   // $numeronfe = str_pad($row_numero['id']+1, 9, 0, STR_PAD_LEFT);// tamanho 9

    $n_nfe =$numeronfe;

    $nnota = $n_nfe;

    $assinaturadigital = md5($formdata."T".$nnota);
    $cod_digital_registro = md5($formdata.$nnota.$vscom);

    $clienteid = $campo['id'];
    $assinaturas = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '$clienteid'");
    $assinatura = mysqli_fetch_array($assinaturas);
    
    $planoid = $assinatura['plano'];
    $planos = $mysqli->query("SELECT * FROM planos WHERE id = '$planoid'");
    $plano = mysqli_fetch_array($planos);
    
    $clientecpf = $campo['cpf'];
    $clienterg = $campo['rg'];
    $clientenome = $campo['nome'];
    $clienteendereco = $campo['endereco'];
    $clientenumero = $campo['numero'];
    $clientecomplemento = $campo['complemento'];
    $clientebairro = $campo['bairro']; 
    $clientecidade = $campo['cidade'];
    $clienteuf = $campo['estado']; 
    $clientecep = $campo['cep'];
    $codigoibge = $chavekey['codmunicipio'];
    $clienteemail = $campo['email'];
    $idcliente = $campo['id'];
    $clientecfop = $campo['cfop'];
    $tipoassinante = $campo['tipoassinante'];
    $tipoutilizacao = $campo['tipoutilizacao'];
    $clientetelefone = $campo['tel'];
    
    $qtdrps = $i;
    $infrps = "RPS".$qtdrps;
    $descricao = $plano['nome'];
    
    $desconto = $assinatura['desconto'];
    $acrescimo = $assinatura['acrescimo'];
    $diavenc = $assinatura['vencimento'];
    
    if ($desconto <> '') {
    $valorservicos = ($plano['preco'] - $desconto);
    } elseif ($acrescimo <> '') {
    $valorservicos = ($plano['preco'] + $acrescimo);
    } else {
    $valorservicos = $plano['preco']; 
    }    

    
    $crud = new crud('notafiscal');  // tabela como parametro
    $crud->inserir("lote,nlote,nnota,assinaturadigital,inscricaomunicipal,qtdrps,infrps,numero,serie,tipo,emissao,naturezaop,opsimples,ic,status,valorservicos,valordeducoes,valorpis,valorcofins,valorinss,valorir,valoresisentos,outrosvalores,valorcsll,issretido,valoriss,valoroutros,icms,aliquota,descontoi,descontoc,vscom,descricao,codmunicipio,cnpj,cliente,clientecpf,clienterg,clientenome,clientetelefone,clienteendereco,clientenumero,clientecomplemento,clientebairro,clientecidade,clienteuf,clientecep,clienteemail,anorps,mesrps,codtributo,codservico,diavencimento,cfop,tipoassinante,tipoutilizacao,quantidadecontratada,quantidadefornecida,grupotensao,nome_arquivo,cod_digital_registro,situacao", "'$lote','$nlote','$nnota','$assinaturadigital','$inscricaomunicipal','$qtdrps','$infrps','$numero','$serie','$tipo','$emissao','$naturezaop','$opsimples','$ic','$status','$valorservicos','$valordeducoes','$valorpis','$valorcofins','$valorinss','$valorir','$valoresisentos','$outrosvalores','$valorcsll','$issretido','$valoriss','$valoroutros','$icms','$aliquota','$descontoi','$descontoc','$vscom','$descricao','$codmunicipio','$cnpj','$idcliente','$clientecpf','$clienterg','$clientenome','$clientetelefone','$clienteendereco','$clientenumero','$clientecomplemento','$clientebairro','$clientecidade','$clienteuf','$clientecep','$clienteemail','$anorps','$mesrps','$codtributo','$codservico','$diavenc','$clientecfop','$tipoassinante','$tipoutilizacao','$quantidadecontratada','$quantidadefornecida','$grupotensao','$nome_arquivo','$cod_digital_registro','$situacao'");
    
    }
    
    
    header("Location: index.php?app=NFSe&reg=1");					
    }
    

    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['nlote']); // pega id para exclusao caso exista
    $crud = new crud('notafiscal'); // tabela como parametro
    $crud->excluir("nlote = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=NFSe&reg=3");
    }

if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "DelNota")) {
    $id = base64_decode($_GET['idnota']); // pega id para exclusao caso exista
    $crud = new crud('notafiscal'); // tabela como parametro
    $crud->excluir("nnota = $id"); // exclui o registro com o id que foi passado

    header("Location: index.php?app=NFSe&reg=4");
}

										
?>

        <div class="breadcrumb clearfix">
          <ul>
              <li><a href="index.php?app=Dashboard">Dashboard</a></li>
              <li><a href="index.php?app=NFSe">Nota Fiscal</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['fr2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Lote RPSNFSe</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>RPS Para Nota Fiscal</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-2">
                      <label class="label">Valor do Pis</label>
                      <label class="input">
                        <input type="text" name="ValorPis" value="0.00" onKeyUp="moeda(this);">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor do Cofins</label>
                      <label class="input">
                        <input type="text" name="ValorCofins" value="0.00" onKeyUp="moeda(this);">
                        <div id="campo_cpf"></div>
                      </label>
                    </section>
                    
                     <section class="col col-2">
                      <label class="label">Valor do Inss</label>
                      <label class="input">
                        <input type="text" name="ValorInss" value="0.00" onKeyUp="moeda(this);">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor do Iss</label>
                      <label class="input">
                        <input type="text" name="ValorIss" value="0.00" onKeyUp="moeda(this);">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Rentenções</label>
                      <label class="input">
                        <input type="text" name="OutrasRetencoes" value="0.00" placeholder="Outros" onKeyUp="moeda(this);">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">ICMS</label>
                          <label class="input">
                              <input type="text" name="icms" value="0" onKeyUp="kbps(this);">
                          </label>
                      </section>


                    <section class="col col-2">
                      <label class="label">Aliquota ICMS</label>
                      <label class="input">
                        <input type="text" name="Aliquota" value="0" onKeyUp="kbps(this);">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor IR</label>
                      <label class="input">
                        <input type="text" name="ValorIr" value="0.00" placeholder="Valor Retido" onKeyUp="moeda(this);">
                      </label>
                    </section>

                      <section class="col col-2">
                          <label class="label">Valores Isentos</label>
                          <label class="input">
                              <input type="text" name="valoresisentos" value="0"  onKeyUp="kbps(this);">
                          </label>
                      </section>


                      <section class="col col-2">
                          <label class="label">Outros Valores</label>
                          <label class="input">
                              <input type="text" name="outrosvalores" value="0"  onKeyUp="kbps(this);">
                          </label>
                      </section>

                    
                    <section class="col col-2">
                      <label class="label">Iss Retido</label>
                      <label class="select">
                      <select name="IssRetido">
		      <option value="2">Não</option>
        	      <option value="1">Sim</option>
		      </select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Número do Lote</label>
                      <label class="input">
                      <input type="text" name="nlote" onKeyUp="kbps(this);" value="<?php echo date('m'.'Y') .rand(9,9999); ?>" required>
                      </label>
                    </section>
                    
                  </fieldset>
                  <footer>
                  
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">

		
                  </footer>
                </form>
              </div>
            </div>
            
            <?php } else { ?>
      	    
      	    <div class="page-header">
            <h1>Permissão <small>Negada!</small></h1>  
            </div>
        
            <div class="row" id="powerwidgets">
            <div class="col-md-12 bootstrap-grid">
            
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	    <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Você não possui permissão para esse modulo. </div>
            
            </div></div>
          <?php } ?>
            