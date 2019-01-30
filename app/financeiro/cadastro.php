<?php
    /*
                ?>
               <script>alert('<?= $res['1']; ?>')</script>
               <?php

    */

    $idpuser = $logado['nome']; // pegar nome do login da sessão
    
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM financeiro WHERE id = + $getId");
        $campo = mysqli_fetch_array($alterar);
    }
					
    
    if(isset ($_POST['editar'])){
    $valor = $_POST['valor'];
    $vencimento = $_POST['vencimento'];
    $motivo = $_POST['motivo'];
    $descricao = $_POST['descricao'];
    $prd = explode("/",$vencimento);
    $dia = $prd[0];
    $mes = $prd[1];
    $ano = $prd[2];
    
    $vencatual = $prd[2]."-".$prd[1]."-".$prd[0];
    $faturaid = $_POST['faturaid'];
    $situacao = $_POST['situacao'];
    
    $crud = new crud('financeiro'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("situacao='$situacao',valor='$valor',motivo='$motivo',descricao='$descricao',vencimento='$vencatual',dia='$dia',mes='$mes',ano='$ano',admin='$idpuser'", "id='$faturaid'");

        // FUNCAO DE LOG INICIO

        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
        $sql = $mysqli->query("INSERT INTO log (admin,ip,data,acao,detalhes,query) VALUES ('$idpuser', '".$ip."', '".$hora."','UPDATE','ATUALIZOU A FATURA PARA ".$situacao." - ".$motivo." - FATURA ".$faturaid."', NULL)");
        // FUNCAO DE LOG FIM

    if($situacao == 'P') { 
    
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
    $diannc = date('d');
    $mesnnc = date('m');
    $fndia = fndata($diannc);
    $fnmes = fndata($mesnnc);
    $fnano = date('Y');
    $pedboleto = $_POST['boletoid'];
    
    $crud = new crud('lc_movimento');  // tabela como parametro
    $crud->inserir("tipo,dia,mes,ano,cat,descricao,valor,pedido,admin", "'1','$fndia','$fnmes','$fnano','1','Recebimento de Mensalidade - Fatura:# $pedboleto','$valor','$faturaid','$idpuser'");
    
    $sxd = $mysqli->query("SELECT * FROM financeiro WHERE id = '$faturaid'");
    $daa = mysqli_fetch_array($sxd);
   
    $codass = $daa['pedido'];
    $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
    $cliente = mysqli_fetch_array($ccss);
    
    $idassn = $cliente['id'];
    $crud = new crud('assinaturas'); 
    $crud->atualizar("status='S'", "id='$idassn'");
    
    }
    
    if($situacao == 'B' || $situacao == 'C') { 
    
    $sxd = $mysqli->query("SELECT * FROM financeiro WHERE id = '$faturaid'");
    $daa = mysqli_fetch_array($sxd);
   
    $codass = $daa['pedido'];
    $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
    $cliente = mysqli_fetch_array($ccss);
    
    $idassn = $cliente['id'];
    $crud = new crud('assinaturas'); 
    $crud->atualizar("status='N'", "id='$idassn'"); 

    $plano = $cliente['plano'];
    $ppss = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $plano = mysqli_fetch_array($ppss);

    $servidor = $plano['servidor'];
    $ssrv = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $servidor = mysqli_fetch_array($ssrv);


   /* --------------------------------------------------------------------------------------------------- */

        if($cliente['autobloqueio'] == 'S') {

        if($cliente['tipo'] == 'HOTSPOT') {
        $API = new routeros_api();
        $API->debug = false;
        if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
        {


        $username = $cliente['login'];
        $API->write('/ip/hotspot/active/print', false);
        $API->write('?=user='.$username.'');
        $res = $API->read($res);

         //   echo '<pre>';
        //    print_r($res);


            echo $user_login = $res['1'];

            if(empty($user_login)){

            }else{

                $API->write('/ip/hotspot/active/remove', false);
                $API->write($user_login);
                $res = $API->read($res);
            }
        $API->disconnect();
        } // FIM
        }

        if($cliente['tipo'] == 'PPPoE') {
        $API = new routeros_api();
        $API->debug = false;
        if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
        {

            $username = $cliente['login'];
            $API->write('/ppp/active/print',false);
            $API->write('?=name='.$username.'');
            $res = $API->read($res);

            //   echo '<pre>';
            //    print_r($res);


            echo $user_login = $res['1'];

            if(empty($user_login)){

            }else{
                $API->write('/ppp/active/remove', false);
                $API->write($user_login);
                $res = $API->read($res);
            }
        $API->disconnect();
        } // FIM
        }

        if($cliente['tipo'] == 'IPARP') {
        $API = new routeros_api();
        $API->debug = false;
        if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
        {
        $API->write('/ip/arp/disable',false);
        $API->write('=.id='.$cliente['ip'].'' );
        $ARRAY = $API->read();
        $API->disconnect();
        } // FIM
        }

        }

    // FIM BLOQUEIO
   /* --------------------------------------------------------------------------------------------------- */

   }
    														     
    if($situacao == 'P' || $situacao == 'N') { 
    
    $sxd = $mysqli->query("SELECT * FROM financeiro WHERE id = '$faturaid'");
    $daa = mysqli_fetch_array($sxd);
   
    $codass = $daa['pedido'];
    $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
    $cliente = mysqli_fetch_array($ccss);

    $plano = $cliente['plano'];
    $ppss = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
    $plano = mysqli_fetch_array($ppss);

    $servidor = $plano['servidor'];
    $ssrv = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
    $servidor = mysqli_fetch_array($ssrv);

   /* --------------------------------------------------------------------------------------------------- */

       if($cliente['tipo'] == 'HOTSPOT') {
       $API = new routeros_api();
       $API->debug = false;
       if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
       {

           $username = $cliente['login'];

           $API->write('/ip/hotspot/active/print', false);
           $API->write('?=user='.$username.'');
           $res = $API->read($res);


           echo $user_login = $res['1'];

           if(empty($user_login)){

           }else{
               $API->write('/ip/hotspot/active/remove', false);
               $API->write($user_login);
               $res = $API->read($res);
           }
       $API->disconnect();
       } // FIM
       }

       if($cliente['tipo'] == 'PPPoE') {
       $API = new routeros_api();
       $API->debug = false;
       if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
       {

           $username = $cliente['login'];
           $API->write('/ppp/active/print',false);
           $API->write('?=name='.$username.'');
           $res = $API->read($res);


           echo $user_login = $res['1'];

           if(empty($user_login)){

           }else{
               $API->write('/ppp/active/remove',false);
               $API->write($user_login);
               $res = $API->read($res);
           }
       $API->disconnect();
       } // FIM
       }

       if($cliente['tipo'] == 'IPARP') {
       $API = new routeros_api();
       $API->debug = false;
       if ($API->connect(''.$servidor['ip'].'', ''.$servidor['login'].'', ''.$servidor['senha'].''))
       {
       $API->write('/ip/arp/enable',false);
       $API->write('=.id='.$cliente['ip'].'' );
       $ARRAY = $API->read();
       $API->disconnect();
       } // FIM
       }

       /* --------------------------------------------------------------------------------------------------- */

   } 
    
    
   header("Location: index.php?app=Financeiro&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('financeiro'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    header("Location: index.php?app=Financeiro&reg=3");
    }
										
?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=Financeiro">Financeiro</a></li>
            <li class="active">Alterar Fatura</li>
          </ul>
        </div>
        
        <?php if($permissao['f1'] == S) { ?>
        
        <div class="page-header">
          <h1>Fatura<small> Alterar</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Financeiro<small>Fatura</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                    <section class="col col-2">
                      <label class="label">Vencimento</label>
                      <label class="input">
                        <input type="text" name="vencimento" value="<?php echo @$campo['dia']; ?>/<?php echo @$campo['mes']; ?>/<?php echo @$campo['ano']; ?>" required>
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Valor</label>
                      <label class="input">
                      <?php
 		      $data_inicial = $campo['cadastro'];
 		      $data_final = $campo['vencimento'];
 		      $diferenca = strtotime($data_final) - strtotime($data_inicial);
 		      $dias = floor($diferenca / (60 * 60 * 24));
		       
                      if($dias >= 30) {
		      $valorboleto = number_format($campo['valor'],2,'.',''); 
		       } else { 
		      $valorboleto = number_format($campo['valor'],2,'.','');
		       }
		       ?> 
		      
                  <input type="text" name="valor" onKeyUp="moeda(this);" value="<?php echo @$valorboleto; ?>" required>
                      </label>
                    </section>

                      <section class="col col-8">
                          <label class="label">Descrição</label>
                          <label class="input">
                              <input type="text" name="descricao"  value="<?php echo @$campo['descricao']; ?>">
                          </label>
                      </section>

                      <section class="col col-8">
                          <label class="label">Motivo Cancelamento/Bloqueio</label>
                          <label class="input">
                              <input type="text" name="motivo"  value="<?php echo @$campo['motivo']; ?>">
                          </label>
                      </section>


                    <section class="col col-8">
                      <label class="label">Situação</label>
                      <div class="inline-group">
                      
                        <label class="radio">
                          <input type="radio" name="situacao" value="A" <?php if ($campo['situacao'] == 'A') { echo "checked"; } ?> required>
                          <i></i>ABERTO</label>
                        
                        <label class="radio">
                          <input type="radio" name="situacao" value="C" <?php if ($campo['situacao'] == 'C') { echo "checked"; } ?>>
                          <i></i>CANCELADO</label>
                          <label class="radio">
                          <input type="radio" name="situacao" value="P" <?php if ($campo['situacao'] == 'P') { echo "checked"; } ?>>
                          <i></i>PAGO</label>
                          <label class="radio">
                          <input type="radio" name="situacao" value="B" <?php if ($campo['situacao'] == 'B') { echo "checked"; } ?>>
                          <i></i>BLOQUEADO</label>
                          <label class="radio">
                          <input type="radio" name="situacao" value="N" <?php if ($campo['situacao'] == 'N') { echo "checked"; } ?>>
                          <i></i>A PAGAR</label>
                      </div>
                    </section>
                    
                    
                  </fieldset>
                  <footer>
                  
		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="faturaid" value="<?php echo @$campo['id']; ?>"> 
		  <input type="hidden" name="boletoid" value="<?php echo @$campo['boleto']; ?>"> 
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
            