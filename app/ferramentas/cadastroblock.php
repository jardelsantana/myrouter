<?php 
    /*
    Função CRUD
    Fltro de Sites
    Ultima Atualização: 09/01/2015
    */
			
    if(isset ($_POST['cadastrar'])){ 
    
    $ip = $_POST['ip'];
    $conteudo = $_POST['conteudo'];
    $comentario = $_POST['comentario'];
    $servidor = $_POST['servidor'];
    $cliente = $_POST['cliente'];
    
    $crud = new crud('firewall');  // tabela como parametro
    $crud->inserir("ip,cliente,conteudo,comentario,servidor", "'$ip','$cliente','$conteudo','$comentario','$servidor'");
    
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($servidor);
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].''))
    {
    
    $API->write('/ip/firewall/filter/add',false);
    $API->write('=chain=input',false );
    $API->write('=action=drop',false );
    $API->write('=comment='.$comentario.'',false );
    $API->write('=content='.$conteudo.'',false );
    $API->write('=src-address='.$ip.'',false );
    $API->write('=disabled=no' );
    $ARRAY = $API->read();
  
    }
    
    header("Location: index.php?app=BLOCK&reg=1");					
    }
    
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('firewall'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    $servidor = base64_decode($_GET['srv']);
    $rmv = base64_decode($_GET['rmv']);
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($servidor);
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].''))
    {
    
    $API->write('/ip/firewall/filter/remove',false);
    $API->write('=.id='.$rmv.'' );
    $ARRAY = $API->read();
  
    }
    
    
    header("Location: index.php?app=BLOCK&reg=3");
    }
										
?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=BLOCK">Ferramentas</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['fr3'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Filtro do Firewall</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Filtro do Firewall</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                  <section class="col col-4">
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
                    
                    <section class="col col-4">
                      <label class="label">Cliente</label>
                      <label class="select">
                      <select id="cliente" name="cliente" class="form-control" required>
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
                  
                  
                    <section class="col col-4">
                      <label class="label">IP</label>
                      <label class="input">
                        <input type="text" name="ip" placeholder="IP do Cliente" required>
                      </label>
                    </section>
                    
                    <section class="col col-6">
                      <label class="label">Conteúdo</label>
                      <label class="input">
                        <input type="text" name="conteudo" placeholder="IP ou URL Para Bloqueio" required>
                      </label>
                    </section>
                    
                     <section class="col col-6">
                      <label class="label">Comentário</label>
                      <label class="input">
                        <input type="text" name="comentario" required>
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