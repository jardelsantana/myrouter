<?php 
    
    $idempresa = $_SESSION['empresa'];
    $idpuser = $logado['nome']; // pegar nome do login da sessão

function byteconvert($input)
    {
    preg_match('/(\d+)(\w+)/', $input, $matches);
    $type = strtolower($matches[2]);
    switch ($type) {
        case "b":
            $output = $matches[1];
            break;
        case "kb":
            $output = $matches[1]*1024;
            break;
        case "mb":
            $output = $matches[1]*1024*1024;
            break;
        case "gb":
            $output = $matches[1]*1024*1024*1024;
            break;
        case "tb":
            $output = $matches[1]*1024*1024*1024;
            break;
     }
    return $output;
    }

    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM planos WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $download = $_POST['download'];
    $upload = $_POST['upload'];
    $pool = $_POST['pool'];
	$addresslist = $_POST['addresslist'];
	$simultaneous = $_POST['simultaneous'];
	$urladvertise = $_POST['urladvertise'];
	$advertiseintervalo = $_POST['advertiseintervalo'];
    $maxsession = $_POST['maxsession'];
    $policein = $_POST['policein'];
    $policeout = $_POST['policeout'];
    $aviso = $_POST['aviso'];
    $tela = $_POST['tela'];
    $pppoe = $_POST['pppoe'];
    $hotspot = $_POST['hotspot'];
    $servidor = $_POST['servidor'];
    $tiposervidor = $_POST['tiposervidor'];

    
    $crud = new crud('planos');  // tabela como parametro
    $crud->inserir("empresa,nome,preco,download,upload,pool,addresslist,simultaneous,urladvertise,advertiseintervalo,maxsession,policein,policeout,aviso,tela,pppoe,hotspot,servidor,tiposervidor,status", "'$empresa','$nome','$preco','$download','$upload','$pool','$addresslist','$simultaneous','$urladvertise','$advertiseintervalo','$maxsession','$policein','$policeout','$aviso','$tela','$pppoe','$hotspot','$servidor','$tiposervidor','S'");

    // FUNCAO DE LOG INICIO
    $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
    $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
    $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','INSERT','CRIOU O PLANO ".$nome."', NULL)");
    // FUNCAO DE LOG FIM

    // Ultimo ID Funcional
    $query = $mysqli->query("SELECT MAX(ID) as id FROM planos");
    $dados = mysqli_fetch_assoc($query);
    $idplanoerpmk = $dados['id'];
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($servidor);
    $ipnas = $mk['ip'];
    
    // RADIUS
     $queues_mk = byteconvert($upload)."/".byteconvert($download);

   // $rdupdown = $upload."k/".$download."k";
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Rate-Limit',':=','$queues_mk','$idplanoerpmk'");

    if($ipnas <> '') {
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','NAS-IP-Address',':=','$ipnas','$idplanoerpmk'");
    }
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Simultaneous-Use',':=','$simultaneous','$idplanoerpmk'");

    if($pool <> '') {
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Framed-Pool',':=','$pool','$idplanoerpmk'");
    }
   // $crud = new crud('radgroupcheck');  // tabela como parametro
  //  $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Simultaneous-Use',':=','$simultaneous','$idplanoerpmk'");
	
	if($urladvertise <> '') { 
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Advertise-URL',':=','$urladvertise','$idplanoerpmk'");
    }
	
	if($advertiseintervalo <> '') { 
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Advertise-Interval',':=','$advertiseintervalo','$idplanoerpmk'");
    }
	
	if($addresslist <> '') { 
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Address-List',':=','$addresslist','$idplanoerpmk'");
    }
    
    //FIM RADIUS


    $download_ubnt = byteconvert($download);
    $upload_ubnt = byteconvert($upload);

    //INI UBNT
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','WISPr-Bandwidth-Max-Up',':=','$upload_ubnt','$idplanoerpmk'");
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','WISPr-Bandwidth-Max-Down',':=','$download_ubnt','$idplanoerpmk'");

    //INI UBNT


    // POLICE JUNIPER
        if($policein && $policeout <> '') {
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$policeout','ERX-Egress-Policy-Name',':=','$policeout','$idplanoerpmk'");
            $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$policein','ERX-Ingress-Policy-Name',':=','$policein','$idplanoerpmk'");

        }
    // POLICE JUNIPER

   /*
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].'')) {
    //HOTSPOT
    if ($hotspot == 'S') { 
    $API->write('/ip/hotspot/user/profile/add',false);
    $API->write('=name='.$nome.'',false );
    $API->write('=shared-users=1',false );
    $API->write('=open-status-page=always',false ); 
    if ($pool <> '') {
    $API->write('=address-pool='.$pool.'',false );
    }
    $API->write('=transparent-proxy=yes',false );
    $API->write('=status-autorefresh=2m',false );
    $API->write('=advertise=no',false );
    $API->write('=advertise-url='.$tela.'',false );
    $API->write('=advertise-interval=000000',false );
    if (''.$_POST['aviso'].'' == 'yes') {
    $API->write('=advertise-timeout='.$block.'',false );
    }
    $API->write('=rate-limit='.$upload.'k/'.$download.'k' );
    $ARRAY = $API->read();
    }

    // PPPOE
    if ($pppoe == 'S') { 
    $API->write('/ppp/profile/add',false);
    $API->write('=name='.$nome.'',false );
    if ($pool <> '') {
    $API->write('=local-address='.$pool.'',false );
    }
    $API->write('=rate-limit='.$upload.'k/'.$download.'k' );
    $ARRAY = $API->read();
    }

    $API->disconnect();
    }
   */
    
    header("Location: index.php?app=Planos&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $download = $_POST['download'];
    $upload = $_POST['upload'];
    $pool = $_POST['pool'];
	$addresslist = $_POST['addresslist'];
	$simultaneous = $_POST['simultaneous'];
	$urladvertise = $_POST['urladvertise'];
	$advertiseintervalo = $_POST['advertiseintervalo'];
    $maxsession = $_POST['maxsession'];
    $policein = $_POST['policein'];
    $policeout = $_POST['policeout'];
    $aviso = $_POST['aviso'];
    $tela = $_POST['tela'];
    $pppoe = $_POST['pppoe'];
    $hotspot = $_POST['hotspot'];
    $servidor = $_POST['servidor'];
    $tiposervidor = $_POST['tiposervidor'];
    $planoid = $_POST['planoid'];

        $queues_mk = byteconvert($upload)."/".byteconvert($download);

        //CONSULTANDO NO BANCO DE DADOS
        $planoid = $_POST['planoid'];
        $planos = $mysqli->query("SELECT * FROM planos WHERE id = '$planoid'");
        $plann = mysqli_fetch_array($planos);
        $ppp = $plann['planoid'];
        $campoAddresslist = $plann['addresslist'];
        $campoSimultaneous = $plann['simultaneous'];
        $campoUrladvertise = $plann['urladvertise'];
        $campoAdvertiseintervalo = $plann['advertiseintervalo'];
        $campoAdvertiseintervalo = $plann['advertiseintervalo'];
        $campoPool = $plann['pool'];
        $campoServidor = $plann['servidor'];

        if($campoAddresslist ==''){
         $crud = new crud('radgroupreply');  // tabela como parametro
         $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Address-List',':=','$addresslist','$planoid'");
     }else{
         $crud = new crud('radgroupreply');  // tabela como parametro
         $crud->atualizar("groupname='$nome',value='$addresslist'", "idplanoerpmk='$planoid' AND Attribute = 'Mikrotik-Address-List'");
        }
     if($addresslist ==''){
            $crud = new crud('radgroupreply'); // tabela como parametro
            $crud->excluir("idplanoerpmk = $planoid AND Attribute = 'Mikrotik-Address-List'"); // exclui o registro com o id que foi passado
        }

        if($campoUrladvertise ==''){
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Advertise-URL',':=','$urladvertise','$planoid'");
        }else{
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->atualizar("groupname='$nome',value='$urladvertise'", "idplanoerpmk='$planoid' AND Attribute = 'Mikrotik-Advertise-URL'");
        }
        if($urladvertise ==''){
            $crud = new crud('radgroupreply'); // tabela como parametro
            $crud->excluir("idplanoerpmk = $planoid AND Attribute = 'Mikrotik-Advertise-URL'"); // exclui o registro com o id que foi passado
        }

           if($campoAdvertiseintervalo ==''){
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Mikrotik-Advertise-Interval',':=','$advertiseintervalo','$planoid'");
        }else{
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->atualizar("groupname='$nome',value='$advertiseintervalo'", "idplanoerpmk='$planoid' AND Attribute = 'Mikrotik-Advertise-Interval'");
        }
        if($advertiseintervalo ==''){
            $crud = new crud('radgroupreply'); // tabela como parametro
            $crud->excluir("idplanoerpmk = $planoid AND Attribute = 'Mikrotik-Advertise-Interval'"); // exclui o registro com o id que foi passado
        }

        if($campoPool ==''){
            $crud = new crud('radgroupreply');  // tabela como parametro
            $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','Framed-Pool',':=','$pool','$planoid'");
        }else{
            $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
            $crud->atualizar("groupname='$nome',value='$pool'", "idplanoerpmk='$planoid' AND Attribute = 'Framed-Pool'");
        }
        if($pool ==''){
            $crud = new crud('radgroupreply'); // tabela como parametro
            $crud->excluir("idplanoerpmk = $planoid AND Attribute = 'Framed-Pool'"); // exclui o registro com o id que foi passado
        }



    $crud = new crud('planos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',preco='$preco',download='$download',upload='$upload',pool='$pool',addresslist='$addresslist',simultaneous='$simultaneous',urladvertise='$urladvertise',advertiseintervalo='$advertiseintervalo',maxsession='$maxsession',policein='$policein',policeout='$policeout',aviso='$aviso',tela='$tela',pppoe='$pppoe',hotspot='$hotspot',servidor='$servidor',tiposervidor='$tiposervidor'", "id='$planoid'");
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($servidor);
    $ipnas = $mk['ip'];

    // RADIUS


    $queues_ubnt_up = byteconvert($upload);
    $queues_ubnt_down = byteconvert($download);

    //$rdupdown = $upload."k/".$download."k";
    $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("groupname='$nome',value='$queues_mk'", "idplanoerpmk='$planoid' AND Attribute = 'Mikrotik-Rate-Limit'");
    $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("groupname='$nome',value='$simultaneous'", "idplanoerpmk='$planoid' AND Attribute = 'Simultaneous-Use'");
   // $crud = new crud('radgroupcheck');  // tabela como parametro
   // $crud->atualizar("groupname='$nome',value='$simultaneous'", "idplanoerpmk='$planoid' AND Attribute = 'Simultaneous-Use'");

    if($campoServidor ==''){
    $crud = new crud('radgroupreply');  // tabela como parametro
    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$nome','NAS-IP-Address',':=','$ipnas','$planoid'");
    }else{
    $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("groupname='$nome',value='$ipnas'", "idplanoerpmk='$planoid' AND Attribute = 'NAS-IP-Address'");
    }
    if($ipnas ==''){
    $crud = new crud('radgroupreply'); // tabela como parametro
    $crud->excluir("groupname='$nome' AND Attribute = 'NAS-IP-Address'"); // exclui o registro com o id que foi passado
    }

    //FIM RADIUS

    $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("groupname='$nome',value='$queues_ubnt_up'", "idplanoerpmk='$planoid' AND Attribute = 'WISPr-Bandwidth-Max-Up'");
    $crud->atualizar("groupname='$nome',value='$queues_ubnt_down'", "idplanoerpmk='$planoid' AND Attribute = 'WISPr-Bandwidth-Max-Down'");

    if($policein && $policeout ==''){
        //    $crud = new crud('radgroupreply');  // tabela como parametro
        //    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$policeout','ERX-Egress-Policy-Name',':=','$policeout','$idplanoerpmk'");
        //    $crud->inserir("groupname,attribute,op,value,idplanoerpmk", "'$policein','ERX-Ingress-Policy-Name',':=','$policein','$idplanoerpmk'");
    }else{
            $crud = new crud('radgroupreply'); // instancia classe com as operações crud, passando o nome da tabela como parametro
            $crud->atualizar("groupname='$policeout',value='$policeout'", "idplanoerpmk='$planoid' AND Attribute = 'ERX-Egress-Policy-Name'");
            $crud->atualizar("groupname='$policein',value='$policein'", "idplanoerpmk='$planoid' AND Attribute = 'ERX-Ingress-Policy-Name'");
    }

    /*
    $idprl = $_POST['idprl'];
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].'')) {
    //HOTSPOT
    if ($hotspot == 'S') { 
    $API->write('/ip/hotspot/user/profile/set',false);
    $API->write('=.id='.$idprl.'',false );
    $API->write('=name='.$nome.'',false );
    if ($pool <> '') {
    $API->write('=address-pool='.$pool.'',false );
    }
    $API->write('=shared-users=1',false );
    $API->write('=open-status-page=always',false ); 
    $API->write('=transparent-proxy=yes',false );
    $API->write('=status-autorefresh=2m',false );
    $API->write('=advertise=no',false );
    $API->write('=advertise-url='.$tela.'',false );
    $API->write('=advertise-interval=000000',false );
    if (''.$_POST['aviso'].'' == 'yes') {
    $API->write('=advertise-timeout='.$block.'',false );
    }
    $API->write('=rate-limit='.$upload.'k/'.$download.'k' );
    $ARRAY = $API->read();
    }
    
    
    if ($hotspot == 'S') {
    $API->write('/ppp/profile/set',false);
    $API->write('=.id='.$idprl.'',false );
    $API->write('=name='.$nome.'',false );
    if ($pool <> '') {
    $API->write('=local-address='.$pool.'',false );
    }
    $API->write('=rate-limit='.$upload.'k/'.$download.'k' );
    $ARRAY = $API->read();
    }
    }
    */
    
    $planoid = $_POST['planoid'];
    $assatz = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$planoid'");
    while($assinatura = mysqli_fetch_array($assatz)){
    
    $desconto = $assinatura['desconto'];
    $acrescimo = $assinatura['acrescimo'];
    
    if ($desconto <> '') {
    $precoplano = ($preco - $desconto);
    } elseif ($acrescimo <> '') {
    $precoplano = ($preco + $acrescimo);
    } else {
    $precoplano = $preco;  
    }    
    
    $pedido = $assinatura['pedido'];
    $financeiroatz = $mysqli->query("SELECT * FROM financeiro WHERE pedido = '$pedido'");
    while($financeiro = mysqli_fetch_array($financeiroatz)){
    
    $crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("valor='$precoplano'", "pedido='$pedido' AND avulso='0'");
    
    }

    }
    
    header("Location: index.php?app=Planos&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    
    $assvalida = $mysqli->query("SELECT * FROM assinaturas WHERE plano = '$id'");
    $assvld = mysqli_fetch_array($assvalida);
    $row = mysqli_num_rows($assvalida);
    
    if($row > 0) {
    header("Location: index.php?app=Planos&reg=4");
    } else {
    
    $crud = new crud('planos'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    // Radius
    $crud = new crud('radgroupreply'); // tabela como parametro
    $crud->excluir("idplanoerpmk = $id"); // exclui o registro com o id que foi passado
    $crud = new crud('radgroupcheck'); // tabela como parametro
    $crud->excluir("idplanoerpmk = $id"); // exclui o registro com o id que foi passado
    
    // Fim Radius
    $idsdel = $_GET['srv'];
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$idsdel'");
    $mk = mysqli_fetch_array($servidor);

    /*
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].''))
    {
    $API->write('/ip/hotspot/user/profile/remove',false);
    $API->write('=.id='.$_GET['nome'].'' );
    $ARRAY = $API->read();

    $API->write('/ppp/profile/remove',false);
    $API->write('=.id='.$_GET['nome'].'' );
    $ARRAY = $API->read();

    $API->disconnect();
    }
    */


    header("Location: index.php?app=Planos&reg=3");
    }
    }
										
?>
    <script type="text/javaScript">
        function Trim(str){
            return str.replace(/^\s+|\s+$/g,"");
        }
    </script>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Planos">Planos</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
         <?php if($permissao['p2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Plano</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Plano de Acesso</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>

     <?php if (@$campo['id'] <> '') { ?>

                    <section class="col col-3">
                      <label class="label">Nome do Plano</label>
                      <label class="input">
                        <input type="text" name="nome"  onkeyup="this.value = Trim( this.value )" value="<?php echo @$campo['nome']; ?>" readonly="yes">
                      </label>
                    </section>
    <?php } else { ?>

                    <section class="col col-3">
                      <label class="label">Nome do Plano</label>
                      <label class="input">
                      <input type="text" name="nome" onkeyup="this.value = Trim( this.value )" value="<?php echo @$campo['nome']; ?>" required>
                      </label>
                      </section>
     <?php } ?>

                   <section class="col col-2">
                      <label class="label">Preço do Plano</label>
                      <label class="input">
                        <input type="text" name="preco" onKeyUp="moeda(this);" value="<?php echo @$campo['preco']; ?>" required>
                      </label>
                    </section>

                    <section class="col col-2">
                      <label class="label">Download</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="download"   value="<?php echo @$campo['download']; ?>" required>
                          <b class="tooltip tooltip-top-right">Cadastre o valor do plano como no exemplo: 10b = 10bits / 512kb = 512Kbps / 1mb = 1Mbits / 1gb = 1Gbits / 1tb = 1Tbits  </b> </label>
                        </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Upload</label>
                        <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="upload"  value="<?php echo @$campo['upload']; ?>" required>
                            <b class="tooltip tooltip-top-right">Cadastre o valor do plano como no exemplo: 10b = 10bits / 512kb = 512Kbps / 1mb = 1Mbits / 1gb = 1Gbits / 1tb = 1Tbits  </b> </label>

                        </label>
                    </section>


               <!--       <section class="col col-2">
                          <label class="label">Upload</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="upload" onKeyUp="kbps(this);" value="<?php /*echo @$campo['upload']; */?>" required>
                              <b class="tooltip tooltip-top-right">Cadastre o valor do plano como no exemplo (300 = 300kbps) </b> </label>

                          </label>
                      </section>-->
                    
                     <section class="col col-2">
                      <label class="label">Simultaneous-Use</label>
                      <label class="input">
                        <input type="text" name="simultaneous" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['simultaneous']; ?><?php } else { ?><?php echo "1"; ?><?php } ?>" required>

                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Servidor</label>
                      <label class="select">
                      <select id="servidor" name="servidor" class="form-control">

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

                      <section class="col col-2">
                          <label class="label">Tipo Concentrador</label>
                          <label class="select">
                              <select name="tiposervidor" required>
                                  <option value="">Selecione</option>
                                  <option <?php if(@$campo['tiposervidor'] == "MIKROTIK" ){echo 'selected';}  ?> value="MIKROTIK">MIKROTIK</option>
                                  <option <?php if(@$campo['tiposervidor'] == "UBIQUITI" ){echo 'selected';}  ?> value="UBIQUITI">UBIQUITI</option>
                                  <option <?php if(@$campo['tiposervidor'] == "JUNIPER" ){echo 'selected';}  ?> value="JUNIPER">JUNIPER</option>
                              </select>
                          </label>
                      </section>
                    
                    <section class="col col-3">
                      <label class="label">IP-Pool</label>
                      <label class="select">
                      <select id="pool" name="pool" class="form-control">

		      <option value="">Selecione</option>
		      <?php
 		      $sdrev = $mysqli->query("SELECT * FROM ippool order by nome ASC");
 		      while($pool = mysqli_fetch_array($sdrev)){
		      ?>
		      <option value="<?php echo $pool['nome']; ?>" <?php if ($campo['pool'] == $pool['nome']) { echo "selected"; } ?>><?php echo $pool['nome']; ?> | <?php echo $pool['ranges']; ?></option>
		      <?php } ?> 
 		      </select>
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Address List (opcional)</label>
                      <label class="input">
                        <input type="text" name="addresslist" value="<?php echo @$campo['addresslist']; ?>">
                      </label>
                    </section>
                    
                  <section class="col col-9">
                      <label class="label">URL/Página de Advertise - Somemente para HOTSPOT</label>
                      <label class="input">
                        <input type="text" name="urladvertise" value="<?php echo @$campo['urladvertise']; ?>"  placeholder="http://myrouter.com.br/aviso.php" >
                      </label>
                    </section>
                    
                         <section class="col col-2">
                      <label class="label">Intervalo (seg)</label>
                      <label class="input">
                        <input type="text" name="advertiseintervalo" value="<?php echo @$campo['advertiseintervalo']; ?>" placeholder="60" >
                      </label>
                    </section>

                      <section class="col col-3">
                          <label class="label">Tempo Máximo da Sessão (Opcional)</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="maxsession" value="<?php echo @$campo['maxsession']; ?>" placeholder="3600" >
                              <b class="tooltip tooltip-top-right">Campo somente usado caso você queira limitar todo o acesso do login em um tempo máximo determinado. usado como cupom hotspot,  CAMPO PREENCHIDO EM SEGUNDOS</b> </label>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Police In (BRAS JUNIPER)</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="policein" value="<?php echo @$campo['policein']; ?>" placeholder="BANDA-10M-IN" >
                              <b class="tooltip tooltip-top-right">Campo somente usado quandos seus BRAS (Consetrador PPPoE) for Juniper</b> </label>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Police Out (BRAS JUNIPER)</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="policeout" value="<?php echo @$campo['policeout']; ?>" placeholder="BANDA-10M-OUT" >
                              <b class="tooltip tooltip-top-right">Campo somente usado quandos seus BRAS (Consetrador PPPoE) for Juniper</b> </label>
                          </label>
                      </section>

                    <section class="col col-5">
                      <label class="label">Adicionar Plano no Mikrotik</label>
                      <div class="inline-group">
                        <label class="checkbox">
                          <input type="checkbox" name="pppoe" value="S" checked>
                          <i></i>Adicionar ao PPPoE</label>
                        <label class="checkbox">
                          <input type="checkbox" name="hotspot" value="S" checked>
                          <i></i>Adicionar ao HotSpot</label>
                        
                      </div>
                    </section>
                    
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="planoid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="idprl" value="<?php echo @$campo['nome']; ?>">
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