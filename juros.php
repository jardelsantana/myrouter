<?php

function Moeda($value){
return number_format($value, 2, ",", ".");
};
 
function convdata($dataform, $tipo){
if ($tipo == 0) {
$datatrans = explode ("/", $dataform);
$data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
} elseif ($tipo == 1) {
$datatrans = explode ("-", $dataform);
$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
}elseif ($tipo == 2) {
$datatrans = explode ("-", $dataform);
$data = "$datatrans[1]/$datatrans[2]/$datatrans[0]";
} elseif ($tipo == 3) {
$datatrans = explode ("/", $dataform);
$data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
}
 
return $data;
};
 
function diasEntreData($date_ini, $date_end){
$data_ini = strtotime( convdata(convdata($date_ini,3),2) ); //data inicial '29 de julho de 2003'
$hoje = convdata($date_end,3);//date("m/d/Y"); // data atual
$foo = strtotime($hoje); // transforma data atual em segundos (eu acho)
$dias = ($foo - $data_ini)/86400; //calcula intervalo
return $dias;
};
 
$dat_venc = "25/01/2015";
$dat_novo_venc = date('d/m/Y', strtotime("+1 days"));
$valor_doc = 103.97;
 
echo "Vencimento: ".$dat_venc."<br>";
echo "Novo Vencimento: ".$dat_novo_venc."<br>";
echo "<br>";
echo "Valor juros ao dia: R$ 0,25<br>";
echo "Valor Multa: 2%<br><br>";
 
$juros = ((0.25 * (diasEntreData($dat_venc,$dat_novo_venc ))));
 
if(diasEntreData($dat_venc,$dat_novo_venc)==0)
{$multa = 0;}
else
{$multa = ((2 * $valor_doc) / 100);}//Moeda(($valor_doc * 2) / 100);
 
$valorDocComJuros = $valor_doc + ($juros + $multa);
$informativoJuros = "Dias de atraso: ". diasEntreData($dat_venc,$dat_novo_venc) ."<br>Valor do Documento: R$ ".Moeda($valor_doc) . " <br>Juros: R$ ".Moeda($juros)." (juros) <br>Multa: R$ ".Moeda($multa)." (multa) <br>Valor Final: ".Moeda($valorDocComJuros);
 
$valor_doc = $valor_doc + ($juros + $multa);
$juros = Moeda($juros);
$multa = Moeda($multa);
 
echo $informativoJuros;

?>