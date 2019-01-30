<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de HotSpot PrePago.
    Ultima Atualização: 18/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM hotspots WHERE id = + $getId");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    function geralogin($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
    $lmin = '';
    $lmai = '';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
    }
    
    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
    }

    $plano = $_POST['plano'];
    $comentario = $_POST['comentario'];
    $uptime = $_POST['uptime'];
    $bytesin = $_POST['bytesin'];
    $bytesout = $_POST['bytesout'];
    $valor = $_POST['valor'];
    $status = $_POST['status'];


    $consultas = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $campo = mysqli_fetch_array($consultas);
    $servidors = $campo['servidor'];
    $planoger = $campo['nome'];
    $srvs = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidors'");
    $srv = mysqli_fetch_array($srvs);
    $ip = $srv['ip'];
    $login = $srv['login'];
    $senha = $srv['senha'];
    
   // $API = new routeros_api();
   // $API->debug = false;
   // if ($API->connect("$ip", "$login", "$senha"))
    //{
    
    $total = $_POST['total'];
    for ($nr=1; $nr<=$total; $nr++){
    
    $login = geralogin(8, false, true);
    $senha = geraSenha(6, true, true);
    
    $crud = new crud('hotspots');  // tabela como parametro
    $crud->inserir("servidor,plano,login,senha,comentario,uptime,bytesin,bytesout,valor,status", "'$servidors','$plano','$login','$senha','$comentario','$uptime','$bytesin','$bytesout','$valor','S'");

    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Password',':=','$senha','$pedido'");

    $crud = new crud('radcheck');  // tabela como parametro
    $crud->inserir("username,attribute,op,value,pedido", "'$login','Max-All-Session',':=','$uptime','$pedido'");

    $crud = new crud('radusergroup');  // tabela como parametro
    $crud->inserir("username,groupname,priority,pedido", "'$login','$planoger','1','$pedido'");



    //$API->write('/ip/hotspot/user/add',false);
    //$API->write('=name='.$login.'',false );
    //$API->write('=password='.$senha.'',false );
    //$API->write('=profile='.$planoger.'',false );
    //$API->write('=limit-uptime='.$uptime.'',false );
    //$API->write('=limit-bytes-in='.$bytesin.'',false );
    //$API->write('=limit-bytes-out='.$bytesout.'',false );
    //$API->write('=comment='.$comentario.'' );
    //$ARRAY = $API->read();
    
    }
    //$API->disconnect();
   // }
    
    
    header("Location: index.php?app=Hotspots&reg=1");					
    }
    
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $login = base64_decode($_GET['login']); // pega id para exclusao caso exista


    $crud = new crud('hotspots'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    $crud = new crud('radcheck'); // tabela como parametro
    $crud->excluir("username = $login"); // exclui o registro com o id que foi passado

    $crud = new crud('radusergroup'); // tabela como parametro
    $crud->excluir("username = $login"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=Hotspots&reg=3");
    }
										
?>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=Clientes">Clientes</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['cu2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Cupons Hotspots</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Hotspots</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-2">
                      <label class="label">QTD de Cupons</label>
                      <label class="input">
                        <input type="text" name="total" value="10" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor do Cupom</label>
                      <label class="input">
                        <input type="text" name="valor" onKeyUp="moeda(this);" value="<?php echo @$campo['valorimp']; ?>" required>
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Plano de Conexão</label>
                      <label class="select">
                      <select id="servidor" name="plano" class="form-control" required>

		      <option value="">Selecione</option>
		      <?php
 		      $bservidor = $mysqli->query("SELECT * FROM planos WHERE hotspot = 'S'");
 		      while($srv = mysqli_fetch_array($bservidor)){
		      ?>
		      <option value="<?php echo $srv['id']; ?>"><?php echo $srv['nome']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Tempo</label>
                      <label class="select">
                      <select name="uptime">
                        <option value="0">Selecione</option>
			<option value="1800">30 Minutos</option>
			<option value="3600">60 Minutos</option>
			<option value="5400">1 Hora / 30 Minutos</option>	
			<option value="7200">2 Horas</option>	
			<option value="14400">4 Horas</option>
			<option value="28800">8 Horas</option>
			<option value="43200">12 Horas</option>
			<option value="86400">24 Horas</option>
			<option value="259200">3 Dias</option>
			<option value="518400">6 Dias</option>
			</select>       
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Upload Máximo</label>
                      <label class="select">
                      <select name="bytesin">
                        	<option value="1073741824">1 GB</option>
				<option value="5368709120">5 GB</option>
				<option value="10737418240">10 GB</option>
				<option value="0">Ilimitado</option>
			</select>       
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Download Máximo</label>
                      <label class="select">
                      <select name="bytesout">
                        	<option value="1073741824">1 GB</option>
				<option value="5368709120">5 GB</option>
				<option value="10737418240">10 GB</option>
				<option value="0">Ilimitado</option>
			</select>       
                      </label>
                    </section>
                    
                    <section class="col col-9">
                      <label class="label">Descrição dos Cupons</label>
                      <label class="input">
                        <input type="text" name="comentario" required>
                      </label>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="hotspotid" value="<?php echo @$campo['id']; ?>"> 
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