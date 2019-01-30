<?php 

    $idempresa = $_SESSION['empresa'];

//gerar numero  de pedido
$qr_numero = $mysqli->query("SELECT * FROM ippool ORDER BY id DESC");
$row_numero = mysqli_fetch_array($qr_numero);
$numero = str_pad($row_numero['id']+1,5,0, STR_PAD_LEFT);
$pedido =$numero;

    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM ippool WHERE id = '$getId'");
        $campo = mysqli_fetch_array($alterar);
    }    
    					
    if(isset ($_POST['cadastrar'])){ 
    
    $nome = $_POST['nome'];
    $ranges = $_POST['ranges'];
    $servidor = $_POST['servidor'];

    $crud = new crud('ippool');  // tabela como parametro
    $crud->inserir("nome,ranges,servidor,pedido", "'$nome','$ranges','$servidor','$pedido'");
    
    $serbb = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($serbb);
    $interface = $mk['interface'];

   $crud = new crud('radippool');  // tabela como parametro
   $crud->inserir("pool_name,framedipaddress,pedido", "'$nome','$ranges','$pedido'");

    //$API = new routeros_api();
    //$API->debug = false;
   // if ($API->connect(''.$mk["ip"].'', ''.$mk["login"].'', ''.$mk["senha"].''))
  //  {

   // $API->write('/ip/pool/add',false);
   // $API->write('=name='.$nome.'',false );
   // $API->write('=ranges='.$ranges.'' );
    
    
    //$ARRAY = $API->read();
    
    //$API->disconnect();
    //}
    header("Location: index.php?app=Pool&reg=1");					
    }
    
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $pedido = ($_GET['pedido']); // pega id para exclusao caso exista

    $servb = $_GET['servidor'];
    $serbb = $mysqli->query("SELECT * FROM servidores WHERE id = '$servb'");
    $mk = mysqli_fetch_array($serbb);
    $nome = $_GET['pool'];

        // $API = new routeros_api();
   // $API->debug = false;
   // if ($API->connect(''.$mk["ip"].'', ''.$mk["login"].'', ''.$mk["senha"].''))
  //  {
    
   // $API->write('/ip/pool/remove',false);
   //$API->write('=.id='.$nome.'' );
  //  $ARRAY = $API->read();
    
  //  $API->disconnect();
  //  }

    $crud = new crud('radippool'); // tabela como parametro
    $crud->excluir("pedido = $pedido"); // exclui o registro com o id que foi passado

    $crud = new crud('ippool'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado



    header("Location: index.php?app=Pool&reg=3");


    }
										
?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=ControleBanda">Mikrotik</a></li>
            <li class="active">Controle de IP</li>
          </ul>
        </div>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Pool</small></h1>
        </div>
        
        <div class="powerwidget red" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Controle de IPPool</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                     <section class="col col-6">
                      <label class="label">Servidor Mikrotik</label>
                      <label class="select">
                      <select id="servidor" name="servidor" class="form-control" required>

		      <option value="">Selecione</option>
		      <?php
 		      $idempresa = $_SESSION['empresa'];
 		      $bservidor = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		      while($srv = mysqli_fetch_array($bservidor)){
		      ?>
		      <option value="<?php echo $srv['id']; ?>" <?php if ($campo['servidor'] == $srv['id']) { echo "selected"; } ?>><?php echo $srv['servidor']; ?> | <?php echo $srv['ip']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                  
                  <section class="col col-3">
                      <label class="label">Nome da Pool IP</label>
                      <label class="input">
                        <input type="text" name="nome" required>
                      </label>
                    </section>
                    
                  <section class="col col-3">
                      <label class="label">IP do Seguimento</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                          <label class="input">
                        <input type="text" placeholder="10.50.30.1" name="ranges" required>
                        <b class="tooltip tooltip-top-right">Caso você esteja cadastrando POOL para uso Dinâmico em rede Roteada, você deverá cadastrar apenas um IP por vez.</b> </label>
                      </label>
                    </section>
                
                  </fieldset>
                  <footer>
                  
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
	

                  </footer>
                </form>
              </div>
            </div>
            