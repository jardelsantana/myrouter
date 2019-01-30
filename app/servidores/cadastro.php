<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Servidores.
    Ultima Atualização: 18/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM servidores WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $servidor = $_POST['servidor'];
    $ip = $_POST['ip'];
    $porta = $_POST['porta'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $secret = $_POST['secret'];
    $tipo = $_POST['tipo'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $interface = $_POST['interface'];
    $tiporouter = "MIKROTIK";
    $portaftp = $_POST['portaftp'];

    $crud = new crud('servidores');  // tabela como parametro
    $crud->inserir("empresa,servidor,ip,porta,login,senha,secret,tipo,lat,lng,interface,tiporouter,portaftp", "'$empresa','$servidor','$ip','$porta','$login','$senha','$secret','$tipo','$lat','$lng','$interface','$tiporouter','$portaftp'");
    
    // Ultimo ID Funcional
    $query = $mysqli->query("SELECT MAX(ID) as id FROM servidores");
    $dados = mysqli_fetch_assoc($query);
    $idservidorerpmk = $dados['id'];
    
    // Radius
    $crud = new crud('nas');  // tabela como parametro
    $crud->inserir("nasname,shortname,type,secret,community,description,idservidorerpmk", "'$ip','localhost','other','$secret','public','$servidor','$idservidorerpmk'");
        
    // Fim Radius
    
    header("Location: index.php?app=Servidores&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $servidor = $_POST['servidor'];
    $ip = $_POST['ip'];
    $porta = $_POST['porta'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $secret = $_POST['secret'];
    $tipo = $_POST['tipo'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $interface = $_POST['interface'];
    $servidorid = $_POST['servidorid'];
    $portaftp = $_POST['portaftp'];
    
    $crud = new crud('servidores'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("servidor='$servidor',ip='$ip',porta='$porta',login='$login',senha='$senha',secret='$secret',tipo='$tipo',lat='$lat',lng='$lng',interface='$interface',portaftp='$portaftp'", "id='$servidorid'");
    
    // Radius
    $crud = new crud('nas'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("nasname='$ip',shortname='localhost',type='other',secret='$secret',description='$servidor'", "idservidorerpmk='$servidorid'");
        
    // Fim Radius
    
    
    header("Location: index.php?app=Servidores&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('servidores'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    // Radius
    $crud = new crud('nas'); // tabela como parametro
    $crud->excluir("idservidorerpmk = $id"); // exclui o registro com o id que foi passado
    // Fim Radius
    header("Location: index.php?app=Servidores&reg=3");
    }
										
?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="?app=Servidores">Servidores</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['mk1'] == S) { ?>

        
        <div class="page-header">
          <h1>Cadastro<small> Novo Servidor</small></h1>
        </div>
        
        <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Cadastro<small>Mikrotik</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section>
                      <label class="label">Nome do Servidor</label>
                      <label class="input">
                        <input type="text" name="servidor" value="<?php echo @$campo['servidor']; ?>">
                      </label>
                    </section>
                    
                    <section style="width:180px;">
                      <label class="label">IP do Servidor</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="ip" value="<?php echo @$campo['ip']; ?>" placeholder="____.____.____.____">
                        <b class="tooltip tooltip-top-right">IP Dedicado ou Fixo da RB MK</b> </label>
                    </section>
                    
                    <section style="width:180px;">
                      <label class="label">Porta de Comunicação</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                          <input type="text" name="porta" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['porta']; ?><?php } else { ?><?php echo "8728"; ?><?php } ?>"  placeholder="8728" required>
                        <b class="tooltip tooltip-top-right">Porta de Acesso</b> </label>
                    </section>
                    
                    <section style="width:180px;">
                      <label class="label">Login</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="login" value="<?php echo @$campo['login']; ?>" placeholder="">
                        <b class="tooltip tooltip-top-right">Login de Acesso</b> </label>
                    </section>
                    
                    <section style="width:180px;">
                      <label class="label">Senha</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="password" name="senha" value="<?php echo @$campo['senha']; ?>" placeholder="********">
                        <b class="tooltip tooltip-top-right">Senha de Acesso</b> </label>
                    </section>

                      <section style="width:210px;">
                          <label class="label">Secret(Radius)</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="secret" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['secret']; ?><?php } else { ?><?php echo "myrouter"; ?><?php } ?>"  placeholder="Senha Secret do Radius" required>
                              <b class="tooltip tooltip-top-right">Senha Secret do Radius, configurado no Mikrotik</b> </label>
                      </section>

                      <section style="width:180px;">
                          <label class="label">Porta FTP (MIKROTIK)</label>
                          <label class="input"> <i class="icon-append fa fa-question"></i>
                              <input type="text" name="portaftp" value="<?php echo @$campo['portaftp']; ?>" placeholder="">
                              <b class="tooltip tooltip-top-right">Porta FTP para Backup</b> </label>
                      </section>

                     <section>
                      <label class="label">Tipo de Equipamento</label>
                      <div class="row">
                        <div class="col col-2">
                          <label class="radio">
                            <input type="radio" name="tipo" value="1" <?php if(@$campo[tipo] == "1"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/rb.png"></label>
                          
			  <label class="radio">
                            <input type="radio" name="tipo" value="2" <?php if(@$campo[tipo] == "2"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/2.png"></label>
                            
                         <label class="radio">
                            <input type="radio" name="tipo" value="3" <?php if(@$campo[tipo] == "3"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/3.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="4" <?php if(@$campo[tipo] == "4"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/4.png"></label>
                            
                        </div>
                        <div class="col col-2">
                          <label class="radio">
                            <input type="radio" name="tipo" value="5" <?php if(@$campo[tipo] == "5"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/5.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="6" <?php if(@$campo[tipo] == "6"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/6.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="7" <?php if(@$campo[tipo] == "7"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/7.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="8" <?php if(@$campo[tipo] == "8"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/8.png"></label>
                        </div>
                        <div class="col col-2">
                         <label class="radio">
                            <input type="radio" name="tipo" value="9" <?php if(@$campo[tipo] == "9"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/9.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="10" <?php if(@$campo[tipo] == "10"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/10.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="11" <?php if(@$campo[tipo] == "11"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/11.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="12" <?php if(@$campo[tipo] == "12"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/12.png"></label>
                        </div>
                        
                        <div class="col col-2">
                         <label class="radio">
                            <input type="radio" name="tipo" value="13" <?php if(@$campo[tipo] == "13"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/13.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="14" <?php if(@$campo[tipo] == "14"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/14.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="15" <?php if(@$campo[tipo] == "15"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/15.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="16" <?php if(@$campo[tipo] == "16"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/16.png"></label>
                        </div>
                        
                        <div class="col col-2">
                         <label class="radio">
                            <input type="radio" name="tipo" value="17" <?php if(@$campo[tipo] == "17"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/17.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="18" <?php if(@$campo[tipo] == "18"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/18.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="19" <?php if(@$campo[tipo] == "19"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/19.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="20" <?php if(@$campo[tipo] == "20"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/20.png"></label>
                        </div>
                        
                        <div class="col col-2">
                         <label class="radio">
                            <input type="radio" name="tipo" value="21" <?php if(@$campo[tipo] == "21"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/21.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="22" <?php if(@$campo[tipo] == "22"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/22.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="23" <?php if(@$campo[tipo] == "23"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/23.png"></label>
                            
                            <label class="radio">
                            <input type="radio" name="tipo" value="24" <?php if(@$campo[tipo] == "24"){ echo  "checked";}?>>
                            <i></i><img style="height:60px;" src="assets/images/antenas/24.png"></label>
                        </div>
                        
                      </div>
                    </section>
                    
                    <section style="width:220px;">
                      <label class="label">Latitude</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="lat" value="<?php echo @$campo['lat']; ?>" placeholder="">
                        <b class="tooltip tooltip-top-right">Latitude do endereço de localização do equipamento</b> </label>
                    </section>
                    
                    <section style="width:220px;">
                      <label class="label">Longitude</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                        <input type="text" name="lng" value="<?php echo @$campo['lng']; ?>" placeholder="">
                        <b class="tooltip tooltip-top-right">Longitude do endereço de localização do equipamento</b> </label>
                    </section>
                    
                     <section style="width:180px;">
                      <label class="label">Interface</label>
                      <label class="input"> <i class="icon-append fa fa-question"></i>
                          <input type="text" name="interface" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['interface']; ?><?php } else { ?><?php echo "ether1"; ?><?php } ?>"  placeholder="ether1" required>
                          <b class="tooltip tooltip-top-right">Interface de Comunicação do IP</b> </label>
                    </section>
                    
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="servidorid" value="<?php echo @$campo['id']; ?>"> 
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