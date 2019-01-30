<?php

/* Preparação do conteúdo
 * (costumo ter uma função a realizar esta tarefa)
 */
include("config/conexao.class.php");
$ano = date('Y');
                  
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
$ers = date('m');
$mesbuscas = fndata($ers);
 


                  

$qr = $mysqli->query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 && mes='$mesbuscas' && ano='$ano'");
$row = mysqli_fetch_array($qr);
$entradas = $row['total'];

$qr = $mysqli->query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 && mes='$mesbuscas' && ano='$ano'");
$row = mysqli_fetch_array($qr);
$saidas = $row['total'];

$resultado_mes = $entradas-$saidas;

$html = '
<p>O meu HTML como quero ver no navegador!</p>
<p>Já formatado e com CSS.</p>';


/* Preparação do documento final
 */
$documentTemplate = '
<table class="table">
                  <thead>
                    <tr>
                      <th>Movimento</th>
                      <th>Valor</th>
                      <th>Dia</th>
                      <th>Pedido</th>
                      <th>Tipo</th>
                      <th>Categoria</th>
                    </tr>
                  </thead>
                  <tbody>
            	  '.$html.'
       	    	     <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>Total Receitas <br>R$ '.number_format($entradas,2,',','.').'</th>
                      <th>Total Despesas <br>R$ '.number_format($saidas,2,',','.').'</th>
                      <th>Saldo Caixa <br>R$ '.number_format($entradas - $saidas,2,',','.').'</th>
                    </tr>
                  </tfoot>
                  
                  
                </table>';


// inclusão da biblioteca
require_once("dompdf/dompdf_config.inc.php");


// alguns ajustes devido a variações de servidor para servidor
if ( get_magic_quotes_gpc() )
    $documentTemplate = stripslashes($documentTemplate);


// abertura de novo documento
$dompdf = new DOMPDF();

// carregar o HTML
$dompdf->load_html($documentTemplate);

// dados do documento destino
$dompdf->set_paper("A4", "portrail");

// gerar documento destino
$dompdf->render();

// enviar documento destino para download
$dompdf->stream("dompdf_out.pdf");

exit(0);
?>