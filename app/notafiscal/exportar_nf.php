<?php
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1");

require_once '../../config/conexao.php';
require_once '../../config/conexao.class.php';
require_once '../../config/crud.class.php';

$conlote = base64_decode($_GET['id']);
$nlote =  $_GET['nlote'];

$empresaNotaFiscal = $mysqli->query("SELECT * FROM empresa");
$campoEmpNota = mysqli_fetch_array($empresaNotaFiscal);

$output = "";

$sql  = mysql_query ("select concat(
lpad(replace(replace(clientecpf,'.',''),'-','')    ,14 ,'0'),
rpad(clienterg     ,14 ,' '),
rpad(clientenome   ,35 ,' '),
rpad(clienteuf     , 2 ,' '),
rpad(tipoassinante , 1 ,'0'),
rpad(tipoutilizacao, 1 ,'0'),
rpad(grupotensao   , 2 ,'0'),
rpad(cliente       ,12 ,' '),
lpad((replace(emissao,'-',''))       , 8 ,' '),
lpad((select modelonota from empresa) , 2 ,'0'),
lpad(tipo          , 3 ,'0'),
lpad(nnota         , 9 ,'0'),
lpad(assinaturadigital,32,' '),
lpad(replace(replace(valorservicos,',',''),'.','') ,12 ,'0'),
lpad('0'           ,12 ,'0'),
lpad('0'           ,12 ,'0'),
lpad(replace(replace(valorservicos,',',''),'.','') ,12 ,'0'),
lpad('0'           ,12 ,'0'),
lpad(situacao      , 1 ,' '),
lpad(date_format(emissao,'%y%m' ), 4,' '),
lpad(nnota         , 9 ,'0'),
lpad(''            ,12 ,' '),
lpad(''            , 5 ,' '),
lpad(cod_digital_registro,32,' ')) AS registro
from myrouter.notafiscal WHERE nlote ='$conlote'");

//$query = mysql_query($sql);
//$notafiscal = mysql_fetch_array($query);
$columns_total = mysqli_num_fields($sql);

//echo '<pre>';
//print_r($notafiscal);

while ($row = mysqli_fetch_array($sql)) {
    for ($i = 0; $i < $columns_total; $i++) {
        $output .=$row["$i"];
    }
    $output .="\n";
}

$filename = $campoEmpNota['estado']."00".$campoEmpNota['tipo'].date('y').date('m')."N"."M"."."."001";
header('Content-type: application/text');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>
