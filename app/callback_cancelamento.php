
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

         //////////////////////////////////////////////////

     }
/* 	 echo "<pre>";
	 print_r($chave);
	 echo "</pre>"; */
	 
    }



?>