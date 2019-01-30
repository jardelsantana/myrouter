<?php

    if(isset ($_POST['cadastrar'])){
    $chain = $_POST['chain'];
    $dstaddress = $_POST['dstaddress'];
    $srcaddress = $_POST['srcaddress'];
    $naosrcaddresslist = $_POST['naosrcaddresslist'];
    $srcaddresslist = $_POST['srcaddresslist'];
    $naodstaddresslist = $_POST['naodstaddresslist'];
    $dstaddresslist = $_POST['dstaddresslist'];
    $protocolo = $_POST['protocolo'];
    $naointerfacein = $_POST['naointerfacein'];
    $interfacein = $_POST['interfacein'];
    $naointerfaceout = $_POST['naointerfaceout'];
    $interfaceout = $_POST['interfaceout'];
    $dstport = $_POST['dstport'];
    $toaddresses = $_POST['toaddresses'];
    $toports = $_POST['toports'];
    $conteudo = $_POST['conteudo'];
    $comentario = $_POST['comentario'];
    $servidor = $_POST['servidor'];
    $cliente = $_POST['cliente'];
    $action = $_POST['action'];
    $srcaddresslistFull = $naosrcaddresslist.$srcaddresslist;
    $dstaddresslistFull = $naodstaddresslist.$dstaddresslist;
    $interfaceinFull = $naointerfacein.$interfacein;
    $interfaceoutFull = $naointerfaceout.$interfaceout;


    $crud = new crud('firewall');  // tabela como parametro
    $crud->inserir("chain,dstaddress,srcaddress,naosrcaddresslist,srcaddresslist,naodstaddresslist,dstaddresslist,protocolo,naointerfacein,interfacein,naointerfaceout,interfaceout,dstport,toaddresses,toports,cliente,conteudo,comentario,servidor,action", "'$chain','$dstaddress','$srcaddress','$naosrcaddresslist','$srcaddresslist','$naodstaddresslist','$dstaddresslist','$protocolo','$naointerfacein','$interfacein','$naointerfaceout','$interfaceout','$dstport','$toaddresses','$toports','$cliente','$conteudo','$comentario','$servidor','$action'");
    
    
    $servidor = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $mk = mysqli_fetch_array($servidor);
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$mk[ip].'', ''.$mk[login].'', ''.$mk[senha].''))
    {

    $API->write('/ip/firewall/nat/add',false);
    $API->write('=chain='.$chain.'',false);
    $API->write('=action='.$action.'',false );
    if($comentario !='') {
    $API->write('=comment='.$comentario.'', false);
    }
    if($conteudo !='') {
    $API->write('=content='.$conteudo.'',false);
    }
    if($srcaddress !='') {
    $API->write('=src-address='.$srcaddress.'',false);
    }
    if($dstaddress !=''){
    $API->write('=dst-address='.$dstaddress.'',false );
    }

    if($srcaddresslist !='') {
        $API->write('=src-address-list='.$srcaddresslistFull.'', false);
    }
    if($dstaddresslist !=''){
    $API->write('=dst-address-list='.$dstaddresslistFull.'',false );
    }

    if($interfacein !='') {
    $API->write('=in-interface='.$interfaceinFull.'', false);
    }

    if($interfaceout !='') {
    $API->write('=out-interface='.$interfaceoutFull.'', false);
    }

    if($toaddresses !='') {
    $API->write('=to-addresses='.$toaddresses.'',false);
    }
    if($toports !='') {
    $API->write('=to-ports='.$toports.'',false);
    }
    $API->write('=protocol='.$protocolo.'',false );
    $API->write('=dst-port='.$dstport.'',false );
    $API->write('=disabled=no' );
    $ARRAY = $API->read();
  
    }
    
    header("Location: index.php?app=NatMKPRINT&reg=1");
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
    
    $API->write('/ip/firewall/nat/remove',false);
    $API->write('=.id='.$rmv.'' );
    $ARRAY = $API->read();
  
    }
    
    
    header("Location: index.php?app=NatMKPRINT&reg=3");
    }
										
?>

    <script type="text/javaScript">
        function Trim(str){
            return str.replace(/^\s+|\s+$/g,"");
        }
    </script>


        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=NatMK">Ferramentas</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['fr3'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Filtro do Firewall Nat</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Filtro do Firewall Nat</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                  <section class="col col-4">
                      <label class="label">Servidor Mikrotik</label>
                      <label class="select">
                      <select id="servidor" name="servidor" class="selectpicker form-control" data-live-search="true" required>

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
                      <select id="cliente" name="cliente" class="selectpicker form-control" data-live-search="true" required>
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


                      <section class="col col-2">
                          <label class="label">Chain</label>
                          <label class="select" required>
                              <select name="chain">
                                  <option <?php if(@$campo['chain'] == 'dstnat' ){echo 'selected';}  ?> value="dstnat">dstnat</option>
                                  <option <?php if(@$campo['chain'] == 'srcnat' ){echo 'selected';}  ?> value="srcnat">srcnat</option>
                              </select>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Protocolo</label>
                          <label class="select" required>
                              <select name="protocolo">
                                  <option <?php if(@$campo['protocolo'] == 'tcp' ){echo 'selected';}  ?> value="tcp">tcp</option>
                                  <option <?php if(@$campo['protocolo'] == 'udp' ){echo 'selected';}  ?> value="udp">udp</option>
                              </select>
                          </label>
                      </section>
                  
                    <section class="col col-4">
                      <label class="label">SRC ADDRESS</label>
                      <label class="input">
                        <input type="text" name="srcaddress" placeholder="IP de Origem" >
                      </label>
                    </section>

                      <section class="col col-4">
                          <label class="label">DST ADDRESS</label>
                          <label class="input">
                              <input type="text" name="dstaddress" placeholder="IP de Destino" >
                          </label>
                      </section>




                      <section class="col col-2">
                          <label class="label">DST Ports</label>
                          <label class="input">
                              <input type="text" name="dstport"  onkeyup="this.value = Trim( this.value )" placeholder="Porta de Destino" >
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">Action</label>
                          <label class="select" required>
                              <select name="action">
                                  <option <?php if(@$campo['action'] == 'dst-nat' ){echo 'selected';}  ?> value="dst-nat">dst-nat</option>
                                  <option <?php if(@$campo['action'] == 'src-nat' ){echo 'selected';}  ?> value="src-nat">src-nat</option>
                                  <option <?php if(@$campo['action'] == 'masquerade' ){echo 'selected';}  ?> value="masquerade">masquerade</option>
                              </select>
                          </label>
                      </section>

                      <section class="col col-2">
                          <label class="label">To Addresses</label>
                          <label class="input">
                              <input type="text" name="toaddresses" placeholder="Para qual Endereço" >
                          </label>
                      </section>


                      <section class="col col-2">
                          <label class="label">To Ports</label>
                          <label class="input">
                              <input type="text" name="toports"  onkeyup="this.value = Trim( this.value )" placeholder="Para qual Porta" >
                          </label>
                      </section>


                    <section class="col col-2">
                      <label class="label">Conteúdo</label>
                      <label class="input">
                        <input type="text" name="conteudo" placeholder="IP ou URL Para Bloqueio" >
                      </label>
                    </section>
                    
                     <section class="col col-6">
                      <label class="label">Comentário</label>
                      <label class="input">
                        <input type="text" name="comentario" required>
                      </label>
                    </section>

                      <section class="col col-4">

                          <label class="checkbox">
                              <input type="checkbox" name="naosrcaddresslist" value="!">
                              <i></i></label>

                          <label class="label">SRC Address List</label>
                          <label class="input">
                              <input type="text" name="srcaddresslist" placeholder="Nome da SRC Address List" >
                          </label>
                      </section>

                      <section class="col col-4">

                          <label class="checkbox">
                              <input type="checkbox" name="naodstaddresslist" value="!">
                              <i></i></label>

                          <label class="label">DST Address List</label>
                          <label class="input">
                              <input type="text" name="dstaddresslist" placeholder="Nome do DST Address List" >
                          </label>
                      </section>

                      <section class="col col-2">

                          <label class="checkbox">
                              <input type="checkbox" name="naointerfacein" value="!">
                              <i></i></label>

                          <label class="label">Interface IN</label>
                          <label class="input">
                              <input type="text" name="interfacein" placeholder="Nome da Interface" >
                          </label>
                      </section>

                      <section class="col col-2">

                          <label class="checkbox">
                              <input type="checkbox" name="naointerfaceout" value="!">
                              <i></i></label>

                          <label class="label">Interface OUT</label>
                          <label class="input">
                              <input type="text" name="interfaceout" placeholder="Nome da Interface" >
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