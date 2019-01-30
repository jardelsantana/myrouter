<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Boletos.
    Ultima Atualização: 15/01/2015
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM boletos WHERE id = + $getId");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $cliente = $_POST['cliente'];
    $servico = $_POST['servico'];
    $valor = $_POST['valor'];
    $boleto = rand(9,999999);
    $juros = $_POST['juros'];
    $taxa = $_POST['taxa'];
    $status = $_POST['status'];
    //$vencimento = $_POST['vencimento'];

    //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $data   = $_POST['vencimento'];
    $data_conv = substr($data,6,7).'-'.substr($data,3,2).'-'.substr($data,0,2);
    $vencimento = $data_conv;
    //FIM DA CONVERSÃO

    $prazo = "10";
    
    $crud = new crud('boletos');  // tabela como parametro
    $crud->inserir("tipo,cliente,servico,valor,valorimp,juros,taxa,vencimento,prazo,boleto,status", "'FT','$cliente','$servico','$valor','$valor','$juros','$taxa','$vencimento','$prazo','$boleto','N'");
    
    header("Location: index.php?app=Boletos&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $cliente = $_POST['cliente'];
    $servico = $_POST['servico'];
    $juros = $_POST['juros'];
    $taxa = $_POST['taxa'];
    $status = $_POST['status'];
    //$vencimento = $_POST['vencimento'];

    //AQUI AGENTE CONVERTE A DATA PARA O FORMATO 0000-00-00
    $data   = $_POST['vencimento'];
    $data_conv = substr($data,6,7).'-'.substr($data,3,2).'-'.substr($data,0,2);
    $vencimento = $data_conv;
    //FIM DA CONVERSÃO

    $boletoid = $_POST['boletoid'];
    $pedido = $_POST['pedido'];
    $tipo = $_POST['tipo'];
    
    if ($taxa <> '') {
    $efevalor = ($_POST['valor'] + $_POST['taxa']);
    } elseif ($juros <> '') {
    $efevalor = ($_POST['valor'] + $_POST['juros']);
    } else {
    $efevalor = $_POST['valor']; 
    }  
    $valor = number_format($efevalor,2,'.','');
    
    $crud = new crud('boletos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("status='$status',valor='$valor',vencimento='$vencimento',juros='$juros',taxa='$taxa',servico='$servico'", "id='$boletoid'"); 
    
    if($tipo == "OS") {
    $crud = new crud('ordemservicos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("preco='$valor',servico='$servico'", "codigo='$pedido'"); 
    }
    
    if($status == 'P') { 
    
    function fndata($string)
    {
    $string = str_replace('01','1',$string);
    $string = str_replace('02','2',$string);
    $string = str_replace('03','3',$string);
    $string = str_replace('04','4',$string);
    $string = str_replace('05','5',$string);
    $string = str_replace('06','6',$string);
    $string = str_replace('07','7',$string);
    $string = str_replace('08','8',$string);
    $string = str_replace('09','9',$string);
  	  return $string;
  
  	  } 
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
    $fndia = fndata($dia);
    $fnmes = fndata($mes);

    $crud = new crud('lc_movimento');  // tabela como parametro
    $crud->inserir("tipo,dia,mes,ano,cat,descricao,valor,pedido", "'1','$fndia','$fnmes','$ano','1','Pagamento de Fatura Boleto #$pedido','$valor','$pedido'");
    
    }
    
    header("Location: index.php?app=Boletos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('boletos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    $codigo = base64_decode($_GET['codigo']);
    
    $crud = new crud('ordemservicos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("preco=''", "codigo='$codigo'"); 
    
    header("Location: index.php?app=Boletos&reg=3");
    }
										
?>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script>
jQuery(function($){
   $(".data").mask("99/99/9999");
});
</script>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Boletos">Boletos</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['ft2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Boleto</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Boletos</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                   <section class="col col-11">
                      <label class="label">Descrição dos Serviços</label>
                      <label class="input">
                        <input type="text" name="servico" value="<?php echo @$campo['servico']; ?>" required>
                      </label>
                    </section>
                    
                   <section class="col col-2">
                      <label class="label">Valor do Boleto</label>
                      <label class="input">
                        <input type="text" name="valor" onKeyUp="moeda(this);" value="<?php echo @$campo['valorimp']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Taxa Adicional</label>
                      <label class="input">
                        <input type="text" name="taxa" onKeyUp="moeda(this);" value="<?php echo @$campo['taxa']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Juros</label>
                      <label class="input">
                        <input type="text" name="juros" onKeyUp="moeda(this);" value="<?php echo @$campo['juros']; ?>">
                      </label>
                    </section>
                   
                    <section class="col col-2">
                      <label class="label">Vencimento</label>
                      <label class="input">
                        <input type="text" name="vencimento" class="data" value="<?php if (@$campo['id'] <> '') { ?><?php echo date('d/m/Y',strtotime(@$campo['vencimento'])); ?><?php } else { ?><?php echo date('d/m/Y', strtotime("+10 days")); ?><?php } ?>" required>
                      </label>
                    </section>
                    
                    

                    <section class="col col-4">
                      <label class="label">Cliente</label>
                      <label class="select">
                      <select id="cliente" name="cliente" class="selectpicker form-control" data-live-search="true" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $bservidor = mysql_query("SELECT * FROM clientes order by nome ASC");
 		      while($srv = mysql_fetch_array($bservidor)){ 
		      ?>
		      <option value="<?php echo $srv['id']; ?>" <?php if ($campo['cliente'] == $srv['id']) { echo "selected"; } ?>><?php echo $srv['nome']; ?> | <?php echo $srv['cpf']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                    
                   <section class="col col-6">
                      <label class="label">Status do Boleto</label>
                      <div class="inline-group">
                        <label class="checkbox">
                          <input type="radio" name="status" value="P" <?php if ($campo['status'] == 'P') { echo "checked"; } ?> required>
                          <i></i>PAGO</label>
                        <label class="checkbox">
                          <input type="radio" name="status" value="N" <?php if ($campo['status'] == 'N') { echo "checked"; } ?>>
                          <i></i>A PAGAR</label>
                        <label class="checkbox">
                          <input type="radio" name="status" value="C" <?php if ($campo['status'] == 'C') { echo "checked"; } ?>>
                          <i></i>CANCELADO</label>
                        <label class="checkbox">
                          <input type="radio" name="status" value="V" <?php if ($campo['status'] == 'V') { echo "checked"; } ?>>
                          <i></i>VENCIDO</label>
                      </div>
                    </section>
                    
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="boletoid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="pedido" value="<?php echo @$campo['boleto']; ?>"> 
		  <input type="hidden" name="tipo" value="<?php echo @$campo['tipo']; ?>"> 
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
            