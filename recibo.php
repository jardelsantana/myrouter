<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);

    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
    
    $codigo = base64_decode($_GET['id']); 
    $tipo = $_GET['tipo'];
    
    if($tipo == '1') { 
    $imp = $mysqli->query("SELECT * FROM financeiro WHERE id = '$codigo'");
    $fatura = mysqli_fetch_array($imp);
    }
    if($tipo == '2') {
    $imp = $mysqli->query("SELECT * FROM boletos WHERE id = '$codigo'");
    $fatura = mysqli_fetch_array($imp);
    }
    $cliente = $fatura['cliente'];
    $ccl = $mysqli->query("SELECT * FROM clientes WHERE id = '$cliente'");
    $cliente = mysqli_fetch_array($ccl);
?>
<html>
<title>Recibo #<?php echo $fatura['boleto']; ?></title>

<table width="1020"><tr><td valign="top">


<table border=1 style="border-collapse: collapse;border-color:#F0F8FF;padding:15px;font-family:verdana;" width="360"> 
  <tr>
    <td style="padding:15px;">
    <b>RECIBO DE PAGAMENTO</b><br>
    	
    </td>
  </tr>
</table>
<table border=1 style="border-collapse: collapse;border-color:#F0F8FF;background:#F8F8FF;padding:15px;font-family:verdana;font-size:10px;" width="360"> 
  <tr>
    <td style="padding:15px;">
    
    <table width="100%">
    <tr style="background:#ececec;padding:20px;"><td>
    RECIBO Nº <?php echo $fatura['boleto']; ?> <br>
    
    R$ <?php echo number_format($fatura['valor'],2,',','.'); ?>
    </td></tr>
    </table>	
    
    <br><br><br><br>
    <table>
    <tr style="padding:10px;font-size:13px;">
    <td>
    Cliente: <?php echo $cliente['nome']; ?> <br>
    <?php if($tipo == 1) { ?>Vencimento <?php 
    $prd = explode("-",$fatura['vencimento']);
    $dia = $prd[2];
    $mes = $prd[1];
    $ano = $prd[0];
    echo $dia."/".$mes."/".$ano;
    ?><?php } ?>
    <?php if($tipo == 2) { ?>
    Vencimento <?php echo $fatura['vencimento']; ?><?php } ?><br><br>
    Data: <?php echo date('d/m/Y'); ?><br>
    Autenticação: <?php echo base64_encode($fatura['boleto']); ?>  <br>
    <br><br><br>
    Assinatura Cliente:________________________
    <br><br><br><br>
    </td>
    
      </tr>
    </table>
    </td>
  </tr>
</table>


</td><td>


<table border=1 style="border-collapse: collapse;border-color:#F0F8FF;padding:15px;font-family:verdana;" width="600"> 
  <tr>
    <td style="padding:15px;">
    <b>RECIBO DE PAGAMENTO</b><br>
    	


    </td>
  </tr>
</table>

<table border=1 style="border-collapse: collapse;border-color:#F0F8FF;background:#F8F8FF;padding:15px;font-family:verdana;font-size:10px;" width="600"> 
  <tr>
    <td style="padding:15px;">
    
    <table width="100%">
    <tr style="background:#ececec;padding:20px;"><td> RECIBO Nº <?php echo $fatura['boleto']; ?></td> <td> R$ <?php echo number_format($fatura['valor'],2,',','.'); ?></td></tr>
    </table>	<br>
    <table width="100%">
    
    <tr style="padding:10px;font-size:13px;"><td> Recebemos de, <?php echo $cliente['nome']; ?>.</td></tr>
    <tr style="padding:10px;font-size:13px;"><td> A importancia de, <?php echo extenso($fatura['valor']); ?>.</td></tr>
    <tr><td><br></td></tr>
    <tr style="padding:10px;font-size:13px;"><td>Referente: 
    
    <?php if($tipo == 1) { ?> Mensalidade da Assinatura de Internet Fatura: <?php echo $fatura['nfatura']; ?>/12 <br>
    Vencimento <?php 
    $prd = explode("-",$fatura['vencimento']);
    $dia = $prd[2];
    $mes = $prd[1];
    $ano = $prd[0];
    echo $dia."/".$mes."/".$ano;
    ?><?php } ?>
    <?php if($tipo == 2) { ?> <?php echo $fatura['servico']; ?> <br>
    Vencimento <?php echo $fatura['vencimento']; ?><?php } ?>
    
    </td></tr>
    <tr><td><br><br><br></td></tr>
    
    </table>
    <table>
    <tr style="padding:10px;font-size:13px;">
    <td>Data: <?php echo date('d/m/Y'); ?><br>
    Autenticação:  <?php echo base64_encode($fatura['boleto']); ?> <br>
    <br><br><br>
    Assinatura:______________________________________________
    
    </td>
    
      </tr>
    </table>
    </td>
  </tr>
</table>

</td></tr></table>