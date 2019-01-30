
    <?php
     
	include ("../config/conexao.php");
    require_once '../config/conexao.class.php';
    require_once '../config/crud.class.php';
    require_once '../config/mikrotik.class.php';
    require_once '../config/librouteros/RouterOS.php';

    if(isset($_POST['xml'])){
     /**
     * Transformando o XML em Objeto
     */
     $objXml = simplexml_load_string($_POST['xml']);
     
     $nome = $objXml->cliente->cliente;
     
     $chave = $objXml->cobranca->chave;
     
     $retorno = $objXml->cobranca->retorno;
     
     $numeroPedido = $objXml->cobranca->documento;
     
     $valorPago = $objXml->cobranca->valorPago;
     
     $pag = $objXml->cobranca->pag;
     
     /**
     * Capturar dados dos itens
     */
	 
     $produtos = array($objXml);
     foreach($objXml->cobranca as $item){
	      $retorno = $item->retorno;		 
     	  $chave = $item->chave;
	      $status = strtoupper($item->status);
		  
		  if($status == "I"){
				$status = "N";  
		  }
		  
		  $total = $item->total;
	      $data = date('Y-m-d'); 
		  
		  $sql = $mysqli->query("UPDATE financeiro SET pagamento_fn='$data', situacao='$status', recebido='$total' WHERE chave='$chave'");


         /////////////////////////////////////////


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
		 
		 	$n1 = substr($total,0,-2);
			$n2 = substr($total,-2);
         $vpago = $n1.'.'.$n2;
		 

         $lcm = $mysqli->query("SELECT * FROM financeiro WHERE chave='$chave'");
         $row = mysqli_num_rows($lcm);

         $row1 = mysqli_fetch_array($lcm);
         $pedboleto = $row1['id'];
         $pedidofin = $row1['pedido'];

         if ($row > 0) {
             $crud = new crud('lc_movimento');  // tabela como parametro
             $crud->inserir("tipo,dia,mes,ano,cat,descricao,valor,pedido", "'1','$fndia','$fnmes','$fnano','1','Recebimento de Mensalidade Via GerenciaNet- Fatura:# $pedboleto','$vpago','$pedidofin'");
         }
         
         $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$pedidofin'");
         $cliente = mysqli_fetch_array($ccss);

         $idassn = $cliente['id'];
         $crud = new crud('assinaturas');
         $crud->atualizar("status='S'", "id='$idassn'");

         $plano = $cliente['plano'];
         $ppss = $mysqli->query("SELECT * FROM planos WHERE id = '$plano'");
         $plano = mysqli_fetch_array($ppss);

      //   $servidor = $plano['servidor'];
         $servidor = $cliente['servidor'];
         $ssrv = $mysqli->query("SELECT * FROM servidores WHERE id = '$servidor'");
         $servidor = mysqli_fetch_array($ssrv);


         if ($cliente['tipo'] == 'HOTSPOT') {
             $API = new routeros_api();
             $API->debug = false;
             if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {

                 $username = $cliente['login'];

                 $API->write('/ip/hotspot/active/print', false);
                 $API->write('?=user='.$username.'');
                 $res = $API->read($res);

                 echo $user_login = $res['1'];

                 if (empty($user_login)) {
                 }
                 else {
                     $API->write('/ip/hotspot/active/remove', false);
                     $API->write($user_login);
                     $res = $API->read($res);
                 }

                 $API->disconnect();
             }
             // FIM

         }

         if ($cliente['tipo'] == 'PPPoE') {
             $API = new routeros_api();
             $API->debug = false;
             if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {

                 $username = $cliente['login'];
                 $API->write('/ppp/active/print', false);
                 $API->write('?=name='.$username.'');
                 $res = $API->read($res);

                 echo $user_login = $res['1'];

                 if (empty($user_login)) {
                 }
                 else {
                     $API->write('/ppp/active/remove', false);
                     $API->write($user_login);
                     $res = $API->read($res);
                 }

                 $API->disconnect();
             }
             // FIM

         }

         if ($cliente['tipo'] == 'IPARP') {
             $API = new routeros_api();
             $API->debug = false;
             if ($API->connect(''.$servidor['ip'].'',''.$servidor['login'].'',''.$servidor['senha'].'')) {
                 $API->write('/ip/arp/enable', false);
                 $API->write('=.id='.$cliente['ip'].'');
                 $ARRAY = $API->read();
                 $API->disconnect();
             }
             // FIM

         }

         //////////////////////////////////////////////////

     }
/* 	 echo "<pre>";
	 print_r($chave);
	 echo "</pre>"; */
	 
    }



?>