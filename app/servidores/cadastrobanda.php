<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Controle de Banda.
    Ultima Atualização: 20/01/2015
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM controlebanda WHERE id = '$getId'");
        $campo = mysqli_fetch_array($alterar);
    }    
    					
    if(isset ($_POST['cadastrar'])){ 
    
    $burstupload = $_POST['burstupload'];
    $burstdownload = $_POST['burstdownload'];
    $burst1 = $_POST['burst1'];
    $burst2 = $_POST['burst2'];
    $upload = $_POST['upload'];
    $download = $_POST['download'];
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];
    $seg = $_POST['seg'];
    $ter = $_POST['ter'];
    $qua = $_POST['qua'];
    $qui = $_POST['qui'];
    $sex = $_POST['sex'];
    $sab = $_POST['sab'];
    $dom = $_POST['dom'];  
    
    $idvc = $_POST['cliente'];
    $asrevb = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$idvc'");
    $assinaturaqueue = mysqli_fetch_array($asrevb);
    
    $ip = $assinaturaqueue['ip'];
    $plano = $assinaturaqueue['plano'];
    $cliente = $assinaturaqueue['cliente'];
    $pedido = $assinaturaqueue['pedido'];
    
    $crud = new crud('controlebanda');  // tabela como parametro
    $crud->inserir("cliente,plano,pedido,ip,download,upload,burstdownload,burstupload,inicio,fim,seg,ter,qua,qui,sex,sab,dom,burst1,burst2", "'$cliente','$plano','$pedido','$ip','$download','$upload','$burstdownload','$burstupload','$inicio','$fim','$seg','$ter','$qua','$qui','$sex','$sab','$dom','$burst1','$burst2'");
    
    $cliens = $assinaturaqueue['cliente'];
    $cvb = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliens'");
    $ccliente = mysqli_fetch_array($cvb);
    $descricao = "Controle de Banda Cliente: ".$ccliente['nome'];
    
    $plano = $assinaturaqueue['plano'];
    $pploano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $planos = mysqli_fetch_array($pploano);
    
    $servb = $planos['servidor'];
    $serbb = $mysqli->query("SELECT * FROM servidores WHERE id = '$servb'");
    $mk = mysqli_fetch_array($serbb);
    $interface = $mk['interface'];
    
    $router = $mk["ip"];
    $username = $mk["login"];
    $password = $mk["senha"];
    
    // NOVA API
    $comando = '/queue/simple/add';
    $args    = array('name' => "$pedido", 'max-limit' => ''.$upload.'k/'.$download.'k', 'time' => ''.$inicio.'-'.$fim.','.$dom.','.$seg.','.$ter.','.$qua.','.$qui.','.$sex.','.$sab.'', 'comment' => "$descricao", 'burst-limit' => ''.$burstupload.'k/'.$burstdownload.'k','burst-time' => ''.$burst1.'m/'.$burst2.'m', 'target-addresses' => "$ip");
    
    $mikrotik = new Lib_RouterOS();
    $mikrotik->setDebug(false);
    try {
    $mikrotik->connect($router);
    $mikrotik->login($username, $password);
    $mikrotik->send($comando, $args);
    $response = $mikrotik->read();
    
    } catch (Exception $ex) {
    // echo "Debug: " . $ex->getMessage() . "\n";
    }
    // FIM API 
    
    
    header("Location: index.php?app=ControleBanda&reg=1");				
    }
    
    if(isset ($_POST['editar'])){
    
    $burstupload = $_POST['burstupload'];
    $burstdownload = $_POST['burstdownload'];
    $burst1 = $_POST['burst1'];
    $burst2 = $_POST['burst2'];
    $upload = $_POST['upload'];
    $download = $_POST['download'];
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];
    $seg = $_POST['seg'];
    $ter = $_POST['ter'];
    $qua = $_POST['qua'];
    $qui = $_POST['qui'];
    $sex = $_POST['sex'];
    $sab = $_POST['sab'];
    $dom = $_POST['dom'];
    
    $bandaid = $_POST['bandaid'];
    
    $idvc = $_POST['cliente'];
    $asrevb = $mysqli->query("SELECT * FROM assinaturas WHERE id = '$idvc'");
    $assinaturaqueue = mysqli_fetch_array($asrevb);
    
    $ip = $assinaturaqueue['ip'];
    $plano = $assinaturaqueue['plano'];
    $cliente = $assinaturaqueue['cliente'];
    $pedido = $assinaturaqueue['pedido'];
    
    
    $crud = new crud('controlebanda'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("cliente='$cliente',plano='$plano',ip='$ip',download='$download',upload='$upload',burstdownload='$burstdownload',burstupload='$burstupload',inicio='$inicio',fim='$fim',seg='$seg',ter='$ter',qua='$qua',qui='$qui',sex='$sex',sab='$sab',dom='$dom',burst1='$burst1',burst2='$burst2'", "id='$bandaid'"); 
    
    $cliens = $assinaturaqueue['cliente'];
    $cvb = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliens'");
    $ccliente = mysqli_fetch_array($cvb);
    $descricao = "Controle de Banda Cliente: ".$ccliente['nome'];
    
    $plano = $assinaturaqueue['plano'];
    $pploano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $planos = mysqli_fetch_array($pploano);
    
    $servb = $planos['servidor'];
    $serbb = $mysqli->query("SELECT * FROM servidores WHERE id = '$servb'");
    $mk = mysqli_fetch_array($serbb);
    $interface = $mk['interface'];
    
    $router = $mk["ip"];
    $username = $mk["login"];
    $password = $mk["senha"];
    
    // NOVA API
    $comando = '/queue/simple/set';
    $args    = array('.id' => "$pedido", 'max-limit' => ''.$upload.'k/'.$download.'k', 'time' => ''.$inicio.'-'.$fim.','.$dom.','.$seg.','.$ter.','.$qua.','.$qui.','.$sex.','.$sab.'', 'comment' => "$descricao", 'burst-limit' => ''.$burstupload.'k/'.$burstdownload.'k','burst-time' => ''.$burst1.'m/'.$burst2.'m', 'target-addresses' => "$ip");
    
    $mikrotik = new Lib_RouterOS();
    $mikrotik->setDebug(false);
    try {
    $mikrotik->connect($router);
    $mikrotik->login($username, $password);
    $mikrotik->send($comando, $args);
    $response = $mikrotik->read();
    
    } catch (Exception $ex) {
    // echo "Debug: " . $ex->getMessage() . "\n";
    }
    // FIM API 
    
    header("Location: index.php?app=ControleBanda&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    
    $ccsb = $mysqli->query("SELECT * FROM controlebanda WHERE id = '$id'");
    $ccbanda = mysqli_fetch_array($ccsb);
    
    $plano = $ccbanda['plano'];
    $pploano = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $planos = mysqli_fetch_array($pploano);
    
    $servb = $planos['servidor'];
    $serbb = $mysqli->query("SELECT * FROM servidores WHERE id = '$servb'");
    $mk = mysqli_fetch_array($serbb);
    $pedido = $ccbanda['pedido'];
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk["ip"].'', ''.$mk["login"].'', ''.$mk["senha"].''))
    {
    
    $API->write('/queue/simple/remove',false);
    $API->write('=.id='.$pedido.'' );
    $ARRAY = $API->read();
    
    $API->disconnect();
    } 
    
    $crud = new crud('controlebanda'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    
    
    
    header("Location: index.php?app=ControleBanda&reg=3");


    }
										
?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=ControleBanda">Mikrotik</a></li>
            <li class="active">Controle de Banda</li>
          </ul>
        </div>
        
        <div class="page-header">
          <h1>Cadastro<small> Nova Regra</small></h1>
        </div>
        
        <div class="powerwidget red" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Controle de Banda</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                      <section class="col col-6">
                      <label class="label">Assinatura</label>
                      <label class="select">
                      <select id="cliente" name="cliente" class="form-control" required>

		      <option value="">Selecione</option>
		      <?php
 		      $bservidor = $mysqli->query("SELECT * FROM assinaturas order by id DESC");
 		      while($srv = mysqli_fetch_array($bservidor)){
 		      $idvc = $srv['cliente'];
	       	      $nncliente = $mysqli->query("SELECT * FROM clientes WHERE id = '$idvc'");
 		      $cliente = mysqli_fetch_array($nncliente);
		      ?>
		      <option value="<?php echo $srv['id']; ?>" <?php if ($campo['cliente'] == $srv['cliente']) { echo "selected"; } ?>><?php echo $cliente['nome']; ?> | <?php echo $srv['ip']; ?> | <?php echo $srv['tipo']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                  
                  
                  
                  <section class="col col-3">
                      <label class="label">Download (300 = 300kbps)</label>
                      <label class="input">
                        <input type="text" name="download" onKeyUp="kbps(this);" value="<?php echo @$campo['download']; ?>" required>
                      </label>
                    </section>
                    
                  <section class="col col-3">
                      <label class="label">Upload (300 = 300kbps)</label>
                      <label class="input">
                        <input type="text" name="upload" onKeyUp="kbps(this);" value="<?php echo @$campo['upload']; ?>" required>
                      </label>
                    </section>
                    
                      
                       <section class="col col-3">
                      <label class="label">Inicio</label>
                      <label class="select">
                      <select name="inicio" class="form-control">
			<option value="0" <?php if ($campo['inicio'] == "0") { echo "selected"; } ?>>00:00:00 Horas</option>
			<option value="7200" <?php if ($campo['inicio'] == "7200") { echo "selected"; } ?>>02:00:00 Horas</option>	
			<option value="14400" <?php if ($campo['inicio'] == "14400") { echo "selected"; } ?>>04:00:00 Horas</option>
			<option value="21600" <?php if ($campo['inicio'] == "21600") { echo "selected"; } ?>>06:00:00 Horas</option>
			<option value="28800" <?php if ($campo['inicio'] == "28800") { echo "selected"; } ?>>08:00:00 Horas</option>
			<option value="43200" <?php if ($campo['inicio'] == "43200") { echo "selected"; } ?>>12:00:00 Horas</option>
			<option value="64800" <?php if ($campo['inicio'] == "64800") { echo "selected"; } ?>>18:00:00 Horas</option>
			<option value="86390" <?php if ($campo['inicio'] == "86390") { echo "selected"; } ?>>23:59:00 Horas</option>
			</select>
			</label>
                    </section>
                    
                    
                      <section class="col col-3">
                      <label class="label">Fim</label>
                      <label class="select">
			<select name="fim" class="form-control">
			<option value="0" <?php if ($campo['fim'] == "0") { echo "selected"; } ?>>00:00:00 Horas</option>
			<option value="7200" <?php if ($campo['fim'] == "7200") { echo "selected"; } ?>>02:00:00 Horas</option>	
			<option value="14400" <?php if ($campo['fim'] == "14400") { echo "selected"; } ?>>04:00:00 Horas</option>
			<option value="21600" <?php if ($campo['fim'] == "21600") { echo "selected"; } ?>>06:00:00 Horas</option>
			<option value="28800" <?php if ($campo['fim'] == "28800") { echo "selected"; } ?>>08:00:00 Horas</option>
			<option value="43200" <?php if ($campo['fim'] == "43200") { echo "selected"; } ?>>12:00:00 Horas</option>
			<option value="64800" <?php if ($campo['fim'] == "64800") { echo "selected"; } ?>>18:00:00 Horas</option>
			<option value="86390" <?php if ($campo['fim'] == "86390") { echo "selected"; } ?>>23:59:00 Horas</option>
                    </select>
                    </label>
                    </section>
    		    
    		    
    		    <section class="col col-3">
                      <label class="label">Burst Download</label>
                      <label class="input">
                        <input type="text" name="burstdownload" onKeyUp="kbps(this);" value="<?php echo @$campo['burstdownload']; ?>">
                      </label>
                    </section>
                    
                  <section class="col col-3">
                      <label class="label">Burst Upload</label>
                      <label class="input">
                        <input type="text" name="burstupload" onKeyUp="kbps(this);" value="<?php echo @$campo['burstupload']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Burst Time</label>
                      <label class="select">
                      <select name="burst1" class="form-control">
		      <option value="1" <?php if ($campo['burst1'] == "1") { echo "selected"; } ?>>1 Minuto</option>
                      <option value="5" <?php if ($campo['burst1'] == "5") { echo "selected"; } ?>>5 Minutos</option>
		      <option value="15" <?php if ($campo['burst1'] == "15") { echo "selected"; } ?>>15 Minutos</option>
		      <option value="30" <?php if ($campo['burst1'] == "30") { echo "selected"; } ?>>30 Minutos</option>
		      <option value="60" <?php if ($campo['burst1'] == "60") { echo "selected"; } ?>>1 Hora</option>
		      <option value="90" <?php if ($campo['burst1'] == "90") { echo "selected"; } ?>>1:30 Hora</option>
		      <option value="120" <?php if ($campo['burst1'] == "120") { echo "selected"; } ?>>2 Horas</option> 
                      <option value="360" <?php if ($campo['burst1'] == "360") { echo "selected"; } ?>>6 Horas</option>
		      <option value="720" <?php if ($campo['burst1'] == "720") { echo "selected"; } ?>>12 Horas</option> 
        </select>
                      </label>
                    </section>
                    <section class="col col-3">
                      <label class="label">Burst Time</label>
                      <label class="select">
                      <select name="burst2" class="form-control">
		      <option value="1" <?php if ($campo['burst2'] == "1") { echo "selected"; } ?>>1 Minuto</option>
                      <option value="5" <?php if ($campo['burst2'] == "5") { echo "selected"; } ?>>5 Minutos</option>
		      <option value="15" <?php if ($campo['burst2'] == "15") { echo "selected"; } ?>>15 Minutos</option>
		      <option value="30" <?php if ($campo['burst2'] == "30") { echo "selected"; } ?>>30 Minutos</option>
		      <option value="60" <?php if ($campo['burst2'] == "60") { echo "selected"; } ?>>1 Hora</option>
		      <option value="90" <?php if ($campo['burst2'] == "90") { echo "selected"; } ?>>1:30 Hora</option>
		      <option value="120" <?php if ($campo['burst2'] == "120") { echo "selected"; } ?>>2 Horas</option> 
                      <option value="360" <?php if ($campo['burst2'] == "360") { echo "selected"; } ?>>6 Horas</option>
		      <option value="720" <?php if ($campo['burst2'] == "720") { echo "selected"; } ?>>12 Horas</option>
        </select>
                      </label>
                    </section>
                 
    		    
                    
                    <section class="col col-11">
                      <label class="label">Período Semanal</label>
                      <div class="inline-group">
                      
                        <label class="checkbox">
                          <input type="checkbox" name="dom" value="sun," <?php if ($campo['dom'] == 'sun,') { echo "checked"; } ?>>
                          <i></i>Domingo</label>
                        
                        <label class="checkbox">
                          <input type="checkbox" name="seg" value="mon," <?php if ($campo['seg'] == 'mon,') { echo "checked"; } ?>>
                          <i></i>Segunda</label>
                          
                          <label class="checkbox">
                          <input type="checkbox" name="ter" value="tue," <?php if ($campo['ter'] == 'tue,') { echo "checked"; } ?>>
                          <i></i>Terça</label>
                          
                          <label class="checkbox">
                          <input type="checkbox" name="qua" value="wed," <?php if ($campo['qua'] == 'wed,') { echo "checked"; } ?>>
                          <i></i>Quarta</label>
                          
                          <label class="checkbox">
                          <input type="checkbox" name="qui" value="thu," <?php if ($campo['qui'] == 'thu,') { echo "checked"; } ?>>
                          <i></i>Quinta</label>
                          
                          <label class="checkbox">
                          <input type="checkbox" name="sex" value="fri," <?php if ($campo['sex'] == 'fri,') { echo "checked"; } ?>>
                          <i></i>Sexta</label>
                          
                          <label class="checkbox">
                          <input type="checkbox" name="sab" value="sat," <?php if ($campo['sab'] == 'sat,') { echo "checked"; } ?>>
                          <i></i>Sábado</label>
                        
                      </div>
                    </section>
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="bandaid" value="<?php echo @$campo['id']; ?>"> 
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
              </div>
            </div>
            