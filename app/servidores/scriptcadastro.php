<?php 
    /*
    Função CRUD
    Cadastro, Edição, Exclusão de Scripts.
    Ultima Atualização: 18/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM scripts WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    $nome = $_POST['nome'];
    $obs = $_POST['obs'];
    $script = $_POST['script'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $p3 = $_POST['p3'];
    $p4 = $_POST['p4'];
    $p5 = $_POST['p5'];
    $p6 = $_POST['p6'];
    $p7 = $_POST['p7'];
    $p8 = $_POST['p8'];
    $p9 = $_POST['p9'];
    $p10 = $_POST['p10'];
    $p11 = $_POST['p11'];
    $p12 = $_POST['p12'];
    $ows = $_POST['ows'];
    
    $crud = new crud('scripts');  // tabela como parametro
    $crud->inserir("empresa,nome,obs,script,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,ows", "'$empresa','$nome','$obs','$script','$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9','$p10','$p11','$p12','$ows'");
    
    $consultas = $mysqli->query("SELECT * FROM servidores order by id DESC");
    while($campo = mysqli_fetch_array($consultas)){
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$campo["ip"].'', ''.$campo["login"].'', ''.$campo["senha"].''))
    {

    $API->write('/system/script/add',false);
    $API->write('=name='.$_POST['nome'].'',false );
    $API->write('=policy='.$_POST['p1'].''.$_POST['p2'].''.$_POST['p3'].''.$_POST['p4'].''.$_POST['p5'].''.$_POST['p6'].''.$_POST['p7'].''.$_POST['p8'].''.$_POST['p9'].''.$_POST['p10'].''.$_POST['p11'].''.$_POST['p12'].'',false );
    $API->write('=source='.$_POST['script'].'' );
    $ARRAY = $API->read();
    
    }
    } 
    
    
    
    header("Location: index.php?app=Scripts&reg=1");					
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Run")) {
    $script = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $consultas = $mysqli->query("SELECT * FROM servidores order by id DESC");
    while($campo = mysqli_fetch_array($consultas)){
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$campo["ip"].'', ''.$campo["login"].'', ''.$campo["senha"].''))
    {

    $API->write('/system/script/run',false);
    $API->write('=.id='.$script.'' );
    $ARRAY = $API->read();
    
    }
    } 

    header("Location: index.php?app=Scripts&reg=2");
    }
    
    
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $script = $_GET['script'];
    $consultas = $mysqli->query("SELECT * FROM servidores order by id DESC");
    while($campo = mysqli_fetch_array($consultas)){
    
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect(''.$campo["ip"].'', ''.$campo["login"].'', ''.$campo["senha"].''))
    {

    $API->write('/system/script/remove',false);
    $API->write('=.id='.$script.'' );
    $ARRAY = $API->read();
    
    }
    } 
    
    $crud = new crud('scripts'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=Scripts&reg=3");
    }
										
?>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=Servidores">Mikrotik</a></li>
            <li><a href="index.php?app=Scripts">Scripts</a></li>
            <li class="active">Cadastro</li>
          </ul>
        </div>
        
        <?php if($permissao['mk2'] == S) { ?>
        
        <div class="page-header">
          <h1>Cadastro<small> Novo Script</small></h1>
        </div>
        
        <div class="powerwidget blue" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Pront de Comando<small>Script</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section>
                      <label class="label">Nome do Script</label>
                      <label class="input">
                        <input type="text" name="nome" value="<?php echo @$campo['nome']; ?>">
                      </label>
                    </section>
                    
                    <section>
                      <label class="label">Descrição</label>
                      <label class="input">
                        <input type="text" name="obs" value="<?php echo @$campo['obs']; ?>">
                      </label>
                    </section>
                   
                    <section class="col col-2">
                      <label class="label">Política</label>
                      
		      <label class="toggle">
                          <input type="checkbox" name="p1" value="ftp," <?php if(@$campo[p1] == "ftp,"){ echo  "checked";}?>>
                          <i></i>FTP</label>
                      <label class="toggle">
                          <input type="checkbox" name="p2" value="reboot," <?php if(@$campo[p2] == "reboot,"){ echo  "checked";}?>>
                          <i></i>Reboot</label>
                      <label class="toggle">
                          <input type="checkbox" name="p3" value="read," <?php if(@$campo[p3] == "read,"){ echo  "checked";}?>>
                          <i></i>Read</label>
                      <label class="toggle">
                          <input type="checkbox" name="p4" value="write," <?php if(@$campo[p4] == "write,"){ echo  "checked";}?>>
                          <i></i>Write</label>
                      <label class="toggle">
                          <input type="checkbox" name="p5" value="policy," <?php if(@$campo[p5] == "policy,"){ echo  "checked";}?>>
                          <i></i>Policy</label>
                      <label class="toggle">
                          <input type="checkbox" name="p6" value="test," <?php if(@$campo[p6] == "test,"){ echo  "checked";}?>>
                          <i></i>Test</label>
                      <label class="toggle">
                          <input type="checkbox" name="p7" value="winbox," <?php if(@$campo[p7] == "winbox,"){ echo  "checked";}?>>
                          <i></i>Winbox</label>
                      <label class="toggle">
                          <input type="checkbox" name="p8" value="password," <?php if(@$campo[p8] == "password,"){ echo  "checked";}?>>
                          <i></i>Password</label>
                      <label class="toggle">
                          <input type="checkbox" name="p9" value="sniff," <?php if(@$campo[p9] == "sniff,"){ echo  "checked";}?>>
                          <i></i>Sniff</label>
                        <label class="toggle">
                            <input type="checkbox" name="p10" value="sensitive," <?php if(@$campo[p10] == "sensitive,"){ echo  "checked";}?>>
                            <i></i>Sensitive</label>
                        <label class="toggle">
                            <input type="checkbox" name="p11" value="romon," <?php if(@$campo[p11] == "romon,"){ echo  "checked";}?>>
                            <i></i>Romon</label>
                        <label class="toggle">
                            <input type="checkbox" name="p12" value="dude," <?php if(@$campo[p12] == "dude,"){ echo  "checked";}?>>
                            <i></i>Dude</label>
                     
                   </label>
                    </section>
                   
		   <section class="col col-10">
                      <label class="label">Pront do Script</label>
                      <label class="textarea"> 
                   <textarea name="script" rows="20" id="script"><?php echo @$campo['script']; ?></textarea>
                   </label>
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
            
<style>
.pront
{background: #000000; 
font: 14px Verdana, sans-serif;
color: #009900;
border: 0px solid #000000;
padding-left:10px;}
</style>