<?php
require_once("config/conexao.class.php");

$sql = $mysqli->query("SELECT * FROM hotspots WHERE status = 'S'");
?>
<html><title>HotSpot</title>
<head><body>
<center>
<table width="100%"><tr><td>

<table border="0" style="font-family:verdana; font-size:12; page-break-before: always;" >
<font face="verdana" size="2"><b> Configure sua página de impressão para o formato paisagem.</b></font><br>
	<font face="verdana" size="1">
							Se você utiliza o Microsoft Internet Explorer, configure-o 
							para usar fontes tamanho médio. Para isso, clique em 
							'Exibir' -&gt; 'Tamanho do Texto' -&gt; 'Média';
						</font><br>
		<font face="verdana" size="1">
							Caso use o Firefox, configure-o para utilizar as fontes em 
							tamanho 12. Para isso, clique em 'Ferramentas' -&gt; 'Opções' 
							-&gt; 'Conteúdo' -&gt; 'Fontes e Cores' -&gt; 'Tamanho' -&gt; 12;
						</font><br><br>
<?php
$total = mysqli_num_rows($sql);
?>
<?php
$colunas = "3";
?>
<?php
if ($total>0) {
    for ($i = 0; $i < $total; $i++) {
        if (($i%$colunas)==0) {
        echo "</tr>";
        echo "<tr>";
    }
    $dados = mysqli_fetch_array($sql);
    $nome = $dados["comentario"];
    $login = $dados["login"];
    $tempo = $dados["uptime"];
    $valor = $dados["valor"];
    $senha = $dados["senha"];
?>
<td style="border:0px solid;padding:5px;" width="317" height="147" background="assets/images/hotspot.png" valign="top" bgcolor="#eeeeee">
<br><font size="1">  
<br><br></font>
<b>HOTSPOT</b> 
<br>
<b>LOGIN:</b> <?php echo $login; ?> <br>
<b>DURAÇÃO:</b> 
<?
$segundos = $tempo;
echo gmdate("H:i:s", $segundos);
?><br>
<b>VALOR: R$</b> <?php echo number_format($valor,2,',','.'); ?> 
<br><b>SENHA:<font color=red> <?php echo $senha; ?></font></b><br>
[ <?php echo $nome; ?> ]
</td>

<?php
    } ?>
    
    </table>

</td></tr></table>
    
    <?php
} else {
    echo "Nenhum Cupom Gerado";
}
?>  
</body></head></html>

