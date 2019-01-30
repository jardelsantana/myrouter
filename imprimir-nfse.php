<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);

    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
    $idcliente = base64_decode($_GET['id']);
    $imp = $mysqli->query("SELECT * FROM notafiscal WHERE nnota = '$idcliente'");
    $csos = mysqli_fetch_array($imp);
    
    $idcliente = $csos['cliente'];
    $cli = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
    $cliente = mysqli_fetch_array($cli);
    
    $emp = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
    $empresa = mysqli_fetch_array($emp);
    $empresa['foto'];

    $data_emissao = date('d/m/Y',strtotime($csos['emissao']));
    
?>
<html>
<title>Nota Fiscal <?php echo $csos['nnota']; ?> - <?php echo $csos['clientenome']; ?></title>

<style type="text/css">
<!--
.borderTable {
padding: 2px 1px 2px 4px;
border: 1px solid #666666;

}
h3 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 15pt;
	color: navy;
	padding-top: 10px;

}
h5 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12pt;
	color: navy;
	padding-top: 10px;

}
.nome {
font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 8pt;


}
.nome1 {
font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 7pt;


}
.saida {
font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12pt;


}
.ttt {
font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 9pt;


}
table.bordasimples {border-collapse: collapse;}
table.bordasimples tr td {border:1px solid #666666; padding: 2px 1px 2px 4px;}

table.bordasimples1 {border-collapse: collapse;}
table.bordasimples1 tr {border:1px solid #666666; padding: 2px 1px 2px 4px;}

-->
</style>
<style>
@font-face {
    font-family: "codigo";
    src: url("assets/BarcodeFont.ttf") format("truetype");
}
</style>
<!--[if IE]>
<style>
@font-face {
    font-family: "codigo";
    src: url("assets/BarcodeFont.eot");
}
</style>
<![endif]-->
<style type="text/css">
<!--
.table1 { border: dotted; border-width: 0px 1px 1px 0px; border-color: black black #000000 #000000}
.table2 { border: dotted; border-width: 0px 1px 0px 0px; border-color: #000000 #000000 black black}
.table_out { border: #000000; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 

1px; border-left-width: 1px}
.table3 { border: dotted; border-width: 0px 0px 1px; border-color: #000000 #000000 black black }
.table4 { border-style: none}
-->
</style>

<center>
<table width="800"><tr><td>

<table style="border:1px solid #666666; padding: 2px 1px 2px 4px;" width="100%">
<tr><td><span class="ttt">
RECEBEMOS DE <?php echo $csos['clientenome']; ?> OS SERVIÇOS CONSTANTES DA NOTA FISCAL INDICADA ABAIXO. EMISSÃO:
<?php echo $csos['emissao']; ?> VALOR TOTAL: R$ <?php echo number_format($csos['valorservicos'], 2, ',', '.'); ?> DESTINATÁRIO: <?php echo $csos['clienteendereco']; ?> <?php echo $csos['clientenumero']; ?> <?php echo $csos['clientecomplemento']; ?> <?php echo $csos['clientebairro']; ?> <?php echo $csos['clientecidade']; ?> <?php echo $csos['clienteuf']; ?> <?php echo $csos['clientecep']; ?>
</td>
</tr>
<tr><td>
<table width="100%" ><tr>
<td valign="top" class="table1">
<span class="nome1">
DATA DO RECEBIMENTO<br><br>
_______/_______/_______

</td>
<td valign="top" class="table1">
<span class="nome1">
IDENTIFICAÇÃO E ASSINATURA DO RECEBEDOR<br><br>
____________________________________________

</td>
<td valign="top" align="center" class="table1">
<span class="nome">
<b>NFS-e<b><br>
Nº <?php echo $csos['nnota']; ?><br>
Série: <?php //echo $csos['serie']; ?> <?php echo "00".$csos['tipo']; ?><br>
Via Única
</td>
<td class="table1">
<font size="29" style="font-family: codigo;"><?php echo $csos['numero']; ?><?php echo $csos['id']; ?><?php echo $csos['serie']; ?><?php echo $csos['tipo']; ?></font>
</td>

</tr></table>
</td>
</tr></table>
<br>


<table class="borderTable" width="100%">
<tr><td width="340"><font face="verdana">
<img src="assets/images/<?echo $empresa['foto'];?>" border="0">

</td><td>&nbsp;</td><td>
<table><tr>
<td>
<span class="nome"><b>Número da Nota:</span><br><b>
<?php echo $csos['nnota']; ?>
</td></tr>

<tr><td><span  class="nome"><font size="4" <b>MODELO </span><b><?php echo $empresa['modelonota']; ?></td></tr>

<tr><td>
<span class="nome"><b>Data e Hora de Emissão:</span><br><b>
<?php echo $data_emissao ?>
</td></tr>

    <td> <br> <font size="2" face="verdana"><b>Natureza da Operação: COMUNICAÇÃO <br>Prestação de Serviços de COMUNICAÇÕES</b></font> </td>

</table>

    </td>
</tr></table>

<table class="borderTable"  width="100%"><tr>
<td><font size="2" face="verdana"><b><center>PRESTADOR DE SERVIÇOS</center></b></font>
<br><font size="2" face="verdana"</font>
<span class="nome">Razão Social:</span><b><span class="ttt"> <?php echo $empresa['empresa']; ?> </span></b> <br>
<span class="nome">CNPJ: </span><b><span class="ttt"><?php echo $empresa['cnpj']; ?></b> </span>   -  <span class="nome">INSCRIÇÃO ESTADUAL: </span><b><span class="ttt"><?php echo $empresa['ie']; ?></b> </span>  -  <span class="nome">INSCRIÇÃO MUNICIPAL: </span><b><span class="ttt"><?php echo $empresa['im']; ?></b> </span> <br>
<span class="nome">Endereço:</span><b><span class="ttt"><?php echo $empresa['endereco']; ?></b> </span>  -  <span class="nome">Telefone:</span><b><span class="ttt"><?php echo $empresa['tel1']; ?></b> </span><br>
<span class="nome">Municipio:</span><b><span class="ttt"><?php echo $empresa['cidade']; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nome">UF:</span>  <b> <span class="ttt"><?php echo $empresa['estado']; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nome">CEP:</span>  <b> <span class="ttt"><?php echo $empresa['cep']; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nome">E-mail:</span> <b><span class="ttt"><?php echo $empresa['email']; ?></span></b>       <br>
</td></tr><table>
<table class="borderTable"  width="100%"><tr><td>
<font size="2" face="verdana"><b><center>TOMADOR DE SERVIÇOS</center></b></font><BR>
<font size="2" face="verdana">
<span class="nome">CPF/CNPJ: </span><b><span class="ttt"><?php echo $cliente['cpf']; ?></span></b> <br>
<span class="nome">Nome/Razão Social: </span><b><span class="ttt"><?php echo $cliente['nome']; ?></span></b><br>
<span class="nome">Endereço: </span><b><span class="ttt"><?php echo $cliente['endereco']; ?> <?php echo $cliente['numero']; ?> <?php echo $cliente['complemento']; ?> <?php echo $cliente['bairro']; ?></span></b>  <br>
<span class="nome">Municipio: </span><b><span class="ttt"><?php echo $cliente['cidade']; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span class="nome">UF: </span><b><span class="ttt"><?php echo $cliente['estado']; ?></span></b> <span class="nome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail: </span><b><span class="ttt"><?php echo $cliente['email']; ?></span></b>     <br>
</td></tr><table>


<table class="borderTable"  width="100%"><tr><td>
<font size="2" face="verdana"><b><center>DISCRIMINAÇÃO DOS SERVIÇOS</center></b></font><BR>
<b><span class="ttt">Serviço de Conexão Internet - <?php echo $csos['descricao']; ?></b>
<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
</td></tr><table>


<table class="borderTable"  width="100%"><tr><td>
<center><b>VALOR TOTAL DA NOTA = R$ <?php echo number_format($csos['valorservicos'],2,',','.'); ?></b></center>
</td></tr><table>


<table class="borderTable" width="100%">
<tr><td>
<span class="nome1">- Esta NOTA FISCAL foi gerada pelo software de gestão da empresa.<br>
- Esta NOTA FISCAL não gera crédito para o Tomador de Serviço.<br>
- NOTA FISCAL LOTE de Nº <?php echo $csos['numero']; ?> Série <?php echo $csos['serie']; ?>, emitido em <?php echo $data_emissao; ?><br>
- EMPRESA OPTANTE DO SIMPLES NACIONAL CONFORME LEI COMPLEMENTAR 123/2006 NÃO GERA DIREITO A CRÉDITO DE ICMS.
</span><br><br><br>


    <tr><td><span class="nome"> <font size="4" <b><center>Código de Verificação:</span><br><b><?php echo $csos['assinaturadigital']; ?></center></td></tr>

    </td></tr></table>

<table class="bordasimples" width="100%">
<tr>
<td bgcolor="#eeeeee"><span class="nome1">Valor Total das Deduções (R$) </span><br>
 <?php echo number_format($csos['valordeducoes'],2,',','.'); ?>
</td>
<td bgcolor="#eeeeee"><span class="nome1">Base de Cálulo (R$) </span><br>
<?php echo number_format($csos['valorservicos'],2,',','.'); ?>
</td>
<td  bgcolor="#eeeeee"><span class="nome1">Aliquota (%) </span><br> 
 <?php echo $csos['aliquota']; ?>
</td>
<td bgcolor="#eeeeee"><span class="nome1">Valor do ISS (R$) </span><br>
 <?php echo number_format($csos['valoriss'],2,',','.'); ?>

</td>
<td  bgcolor="#eeeeee"><span class="nome1">Crédito (R$) </span><br>
0,00
</td>
</tr></table>


<table class="borderTable"  width="100%"><tr><td>
<font size="1">
Código da Atividade
<font size="2" face="verdana"><b><br>
<b><span class="saida">CFOP:<?php echo $csos['cfop']; ?></b>

        <td bgcolor="#eeeeee"><span class="nome1">SITUAÇÃO DA NOTA </span><br>
            <?php if($csos['situacao'] == "N") { ?>NORMAL<?php } else { ?>CANCELADA<?php } ?>

        </td>

</font></font>
</td></tr>
</table>
</html>