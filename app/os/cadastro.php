<?php
    $idpuser = $logado['nome']; // pegar nome do login da sessão

    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM ordemservicos WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $codigo = rand(9,999999);
    $situacao = $_POST['situacao'];
    $cliente = $_POST['cliente'];
    $login = $_POST['login'];
	$sql_plano = $mysqli->query("SELECT * FROM assinaturas WHERE id = '".$login."'");
	$res_plano = mysqli_fetch_assoc($sql_plano);
	$plano_id = $res_plano['plano'];
    $pedido_id = $res_plano['pedido'];
    $tecnico = $_POST['tecnico'];
    $tipo = $_POST['tipo'];
    $emissao = $_POST['emissao'];
    $horaabertura = $_POST['horaabertura'];
    $orcamento = $_POST['orcamento'];
    $aprovacao = $_POST['aprovacao'];
    $servico = $_POST['servico'];
    $saida = $_POST['saida'];
    $dataagendamento = $_POST['dataagendamento'];
    $horaagendamento = $_POST['horaagendamento'];
    $problema = $_POST['problema'];
    $diagnostico = $_POST['diagnostico'];
    $solucao = $_POST['solucao'];
    $atendente = $_POST['atendente'];
    $tiposervico = $_POST['tiposervico'];
    $preco = $_POST['preco'];
    $serie = $_POST['serie'];
    $encerrado = $_POST['encerrado'];
    $status = $_POST['status'];

    $crud = new crud('ordemservicos');  // tabela como parametro
    $crud->inserir("servico,empresa,codigo,situacao,cliente,assinatura,plano,tecnico,tipo,emissao,horaabertura,orcamento,aprovacao,saida,dataagendamento,horaagendamento,problema,diagnostico,solucao,atendente,tiposervico,preco,serie,encerrado,status", "'$servico','$empresa','$codigo','$situacao','$cliente', '$login','$plano_id','$tecnico','$tipo','$emissao','$horaabertura','$orcamento','$aprovacao','$saida','$dataagendamento','$horaagendamento','$problema','$diagnostico','$solucao','$atendente','$tiposervico','$preco','$serie','$encerrado','$status'");

    if($preco <> '') {
     $vencimento = date('Y-m-d', strtotime("+15 days")); // Dias Pagamento Boleto
     $cadastro = date('Y-m-d');
        //////////
        $cliente = $_POST['cliente'];

        //INICIO - nosso numero sequencial
        $qr_numero = $mysqli->query("SELECT * FROM financeiro ORDER BY id DESC");
        $row_numero = mysqli_fetch_array($qr_numero);
        $numero = str_pad($row_numero['id'], 9, 0, STR_PAD_LEFT);// tamanho 9
        // FIM - nosso numero sequencial
        $nossonumero = $numero;


        $dia = date('d',strtotime($vencimento));
        $mes = date('m',strtotime($vencimento));
        $ano = date('Y',strtotime($vencimento));
        $mes1 = date('n',strtotime($vencimento));

        $bservidor = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
        $linhas = mysqli_fetch_array($bservidor);
        $cliente = $linhas['id'];
        $pedido = $linhas['pedido'];
        $plano = $linhas['plano'];
        $pedido = $linhas['pedido'];
        $login = $linhas['login'];
        $descricao = $_POST['descricao'];
        $mesparcela = $_POST['mesparcela'];

        $crud = new crud('financeiro');  // tabela como parametro
        $crud->inserir("ref,descricao,cliente,pedido,vencimento,cadastro,dia,mes,ano,plano,login,valor,mesparcela,boleto,situacao,status,avulso", "'$codigo','Boleto gerado pela OS','$cliente','$pedido_id','$vencimento','$cadastro','$dia','$mes','$ano','$plano_id','$login','$preco','$mes1','$nossonumero','N','A','1'");

        ///////

    }

    header("Location: index.php?app=OrdemServicos&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $codigo = $_POST['codigo'];
    $situacao = $_POST['situacao'];
    $cliente = $_POST['cliente'];
    $assinatura = $_POST['login'];
    $sql_plano = $mysqli->query("SELECT * FROM assinaturas WHERE id = '".$login."'");
    $res_plano = mysqli_fetch_assoc($sql_plano);
    $plano_id = $res_plano['plano'];
    $tecnico = $_POST['tecnico'];
    $tipo = $_POST['tipo'];
    $emissao = $_POST['emissao'];
    $horaabertura = $_POST['horaabertura'];
    $orcamento = $_POST['orcamento'];
    $aprovacao = $_POST['aprovacao'];
    $saida = $_POST['saida'];
    $dataagendamento = $_POST['dataagendamento'];
    $horaagendamento = $_POST['horaagendamento'];
    $problema = $_POST['problema'];
    $diagnostico = $_POST['diagnostico'];
    $solucao = $_POST['solucao'];
    $atendente = $_POST['atendente'];
    $tiposervico = $_POST['tiposervico'];
    $preco = $_POST['preco'];
    $serie = $_POST['serie'];
    $encerrado = $_POST['encerrado'];
    $status = $_POST['status'];
    $servico = $_POST['servico'];
    $osid = $_POST['osid'];
    
    $crud = new crud('ordemservicos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("servico='$servico',situacao='$situacao',cliente='$cliente',assinatura='$assinatura',tecnico='$tecnico',tipo='$tipo',emissao='$emissao',horaabertura='$horaabertura',orcamento='$orcamento',aprovacao='$aprovacao',saida='$saida',dataagendamento='$dataagendamento',horaagendamento='$horaagendamento',problema='$problema',diagnostico='$diagnostico',solucao='$solucao',atendente='$atendente',tiposervico='$tiposervico',preco='$preco',serie='$serie',encerrado='$encerrado',status='$status'", "id='$osid'");
    
    $crud = new crud('assinaturas'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("situacao='$situacao'", "pedido='$codigo'"); 
    
    
    $qtds = $mysqli->query("SELECT * FROM financeiro WHERE ref = '$codigo'");
    $existe = mysqli_num_rows($qtds);
    if($existe > 0) { 
    
    $crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("valor='$preco'", "ref='$codigo'");
    
    } else {
       // $crud = new crud('financeiro');  // tabela como parametro
       // $crud->inserir("ref,descricao,cliente,pedido,vencimento,cadastro,dia,mes,ano,plano,login,valor,mesparcela,boleto,situacao,status,avulso", "'$codigo','Boleto gerado pela OS','$cliente','$pedido_id','$vencimento','$cadastro','$dia','$mes','$ano','$plano_id','$login','$preco','$mes1','$nossonumero','N','A','X'");
    }
    
    
    header("Location: index.php?app=OrdemServicos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('ordemservicos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    //$pedido = $_GET['pedido'];
    $codigo = $_POST['codigo'];
    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("ref = $codigo"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=OrdemServicos&reg=3");
    }

    //acao  para OS via MOBILE
if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Baixar")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('ordemservicos'); // tabela como parametro
    $crud->atualizar("encerrado = 'S',solucao='OS SOLUCIONADA'"); // exclui o registro com o id que foi passado


    header("Location: /myrouter/mobile/#atendimentos");
}
										
?>
<script src="https://raw.githubusercontent.com/digitalBush/jquery.maskedinput/1.4.0/dist/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
	function BuscarLogin(){
		var cliente = $('#cliente').val();
		if(cliente){
			var UrlSearch = 'app/os/busca_login_cliente.php?cliente='+cliente;
			$.get(UrlSearch, function(dataReturn){
				$('#load_login_cliente').html(dataReturn);
	        });
		}
	}
</script>
<script>
$(function() {
 $('.cpf').focusout(function() {
        var cpfcnpj, element;
        element = $(this);
        element.unmask();
        cpfcnpj = element.val().replace(/\D/g, '');
        if (cpfcnpj.length > 11) {
            element.mask("99.999.999/999?9-99");
        } else {
            element.mask("999.999.999-99?9-99");
        }
    }).trigger('focusout');
    

});
jQuery(function($){
   $(".data").mask("99/99/9999");
});

jQuery(function($){
    $(".hora").mask("99:99:99");
});

</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.0.js"></script>
<script type="text/javascript">
window.onload = function() {
  new dgCidadesEstados({
    estado: document.getElementById('estado'),
    cidade: document.getElementById('cidade')
  });
}
</script>
<script type="text/javascript" src="ajax/funcslogin.js"></script>
<script type="text/javascript" src="ajax/funcscpf.js"></script>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=OrdemServicos">Ordem de Serviços</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['os2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Nova O.S</small></h1>
        </div>
        
        <div class="powerwidget blue" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Ordem de Serviço</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-3">
                      <label class="label">Cliente</label>
                      <label class="select">
                          <select id="cliente" name="cliente" onchange="BuscarLogin()" class="selectpicker form-control" data-live-search="true" required>
                              <option value="">Selecione</option>
                              <?php
                              $idempresa = $_SESSION['empresa'];
                              $cls = $mysqli->query("SELECT * FROM clientes WHERE empresa = '$idempresa'");
                              while($cliente = mysqli_fetch_array($cls)){
                              ?>
                              <option value="<?php echo $cliente['id']; ?>" <?php if ($campo['cliente'] == $cliente['id']) { echo "selected"; } ?>><?php echo $cliente['codigo']; ?> | <?php echo $cliente['nome']; ?> | <?php echo $cliente['cpf']; ?></option>
                              <?php } ?> 
                          </select>
                      </label>
                    </section>
                      <div id="load_login_cliente">
                          <section class="col col-3">
                              <label class="label">login</label>
                              <label class="select">
                                  <select id="login" name="login" class="selectpicker form-control" data-live-search="true" required>
                                      <option value="">Selecione</option>
                                      <?php
                                      $sql_cliente = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '".$campo['cliente']."'");
                                      $count_cliente = mysqli_num_rows($sql_cliente);
                                      if($count_cliente > 0){
                                          ?>
                                          <?php
                                          while($res_cliente = mysqli_fetch_assoc($sql_cliente)){
                                              ?>
                                              <option value="<?php echo $res_cliente['id'];?>" <?php if($res_cliente['id'] == $campo['assinatura']){echo 'selected';}?>><?php echo $res_cliente['login'];?></option>
                                          <?php
                                          }
                                          ?>
                                      <?php
                                      }
                                      ?>
                                  </select>
                              </label>
                          </section>
                      </div>
                    <section class="col col-3">
                      <label class="label">Técnico Responsável</label>
                      <label class="select">
                      <select id="tecnico" name="tecnico" class="form-control selectpicker" data-live-search="true" required>
		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $tecs = $mysqli->query("SELECT * FROM tecnicos WHERE empresa = '$idempresa'");
 		      while($tecnico = mysqli_fetch_array($tecs)){
		      ?>
		      <option value="<?php echo $tecnico['id']; ?>" <?php if ($campo['tecnico'] == $tecnico['id']) { echo "selected"; } ?>><?php echo $tecnico['nome']; ?> | <?php echo $tecnico['cargo']; ?> |  <?php echo $tecnico['cidade']; ?>  <?php echo $tecnico['estado']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Situação da O.S</label>
                      <label class="select">
                      <select id="situacao" name="situacao" class="form-control" required>
		      <option value="">Selecione</option>
		      <option value="O" <?php if ($campo['situacao'] == 'O') { echo "selected"; } ?>>Orçamento</option>
		      <option value="I" <?php if ($campo['situacao'] == 'I') { echo "selected"; } ?>>Instalado</option>
		      <option value="M" <?php if ($campo['situacao'] == 'M') { echo "selected"; } ?>>Manutenção</option>
              <option value="CS" <?php if ($campo['situacao'] == 'CS') { echo "selected"; } ?>>Cancelamento de Serviço</option>
		      <option value="R" <?php if ($campo['situacao'] == 'R') { echo "selected"; } ?>>Recuperação</option>
		      <option value="A" <?php if ($campo['situacao'] == 'A') { echo "selected"; } ?>>Aprovado</option>
		      <option value="I" <?php if ($campo['situacao'] == 'NI') { echo "selected"; } ?>>Instalação</option>
		      <option value="C" <?php if ($campo['situacao'] == 'C') { echo "selected"; } ?>>Cancelada</option>
		      
 		      </select>
                      </label>
                    </section>
                    
                    
                    <section class="col col-8">
                      <label class="label">Tipo de Serviço</label>
                      <label class="input">
                      <input type="text" name="servico" placeholder="Descreva as informações do serviço a ser prestado." value="<?php echo @$campo['servico']; ?>" required>
                      </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Data de Abertura</label>
                      <label class="input">
                      <input type="text" name="emissao" class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['emissao']; ?><?php } else { ?><?php echo date('d/m/Y'); ?><?php } ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Hora de Abertura</label>
                      <label class="input">
                      <input type="text" name="horaabertura"  class="hora" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['horaabertura']; ?><?php } else { ?><?php echo date("H:i:s");; ?><?php } ?>" required>
                        </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Data do Orçamento</label>
                      <label class="input">
                      <input type="text" name="orcamento" class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['orcamento']; ?><?php } else { ?><?php echo date('d/m/Y'); ?><?php } ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Data de Aprovação</label>
                      <label class="input">
                      <input type="text" name="aprovacao" class="data" value="<?php echo @$campo['aprovacao']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Data de Saída</label>
                      <label class="input">
                      <input type="text" name="saida" class="data" value="<?php echo @$campo['saida']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Data de Agendamento</label>
                      <label class="input">
                      <input type="text" name="dataagendamento" class="data" value="<?php echo @$campo['dataagendamento']; ?>">
                      </label>
                    </section>
                    
                   <section class="col col-3">
                      <label class="label">Hora de Agendamento</label>
                      <label class="input">
                      <input type="text" name="horaagendamento" class="hora" value="<?php echo @$campo['horaagendamento']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Problema</label>
                      <label class="textarea">
                      <textarea rows="12" name="problema"><?php echo @$campo['problema']; ?></textarea>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Diagnostico</label>
                      <label class="textarea">
                      <textarea rows="12" name="diagnostico"><?php echo @$campo['diagnostico']; ?></textarea>
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label">Solução</label>
                      <label class="textarea">
                      <textarea rows="12" name="solucao"><?php echo @$campo['solucao']; ?></textarea>
                      </label>
                    </section>

                    <section class="col col-3">
                      <label class="label">Atendente</label>
                      <label class="input">
                      <input type="text" name="atendente" readonly value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['atendente']; ?><?php } else { ?><?php echo $idpuser; ?><?php } ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Nº Série O.S</label>
                      <label class="input">
                      <input type="text" name="serie" value="<?php echo @$campo['serie']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor</label>
                      <label class="input">
                      <input type="text" name="preco" onKeyUp="moeda(this);" value="<?php echo @$campo['preco']; ?>">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Status da O.S</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="status" value="S" <?php if ($campo['status'] == 'S') { echo "checked"; } ?> required>
                          <i></i>Ativo</label>
                        
                        <label class="radio">
                          <input type="radio" name="status" value="N" <?php if ($campo['status'] == 'N') { echo "checked"; } ?>>
                          <i></i>Bloqueado</label>
                      </div>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">O.S Encerrada</label>
                      <div class="inline-group">
                        <label class="radio">
                          <input type="radio" name="encerrado" value="S" <?php if ($campo['encerrado'] == 'S') { echo "checked"; } ?>>
                          <i></i>Sim</label>
                        
                        <label class="radio">
                          <input type="radio" name="encerrado" value="N" <?php if ($campo['encerrado'] == 'N') { echo "checked"; } ?>>
                          <i></i>Não</label>
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="osid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="codigo" value="<?php echo @$campo['codigo']; ?>">
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

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
            