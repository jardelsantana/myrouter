<?php
session_start();
ob_start();
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1"); 

    require_once '../config/conexao.class.php';
    require_once '../config/crud.class.php';
    require_once '../config/mikrotik.class.php';

    @$getIP = base64_decode($_GET['ip']);

    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco

$servidor = mysql_query("SELECT * FROM servidores");
$mk = mysql_fetch_array($servidor);
$ipnas = $mk['ip'];
$secret = $mk['secret'];

$query = "SELECT * FROM  financeiro WHERE situacao = 'B'";
$result = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($result)){
     $row['pedido'];
     $row['login'];

    radDesloga($row['login']);

   // shell_exec(" echo  User-Name=".$row['login']." | radclient -x $ipnas:3799 disconnect $secret");

}

function radDesloga($username) {
    $consulta_rsDesl = "SELECT framedipaddress, nasipaddress FROM radacct WHERE username = '" . $username . "' ORDER BY radacctid DESC";
    $rsDesl = mysql_query($consulta_rsDesl);
    $row_rsDesl = mysql_fetch_assoc($rsDesl);
    $totalRows_rsDesl = mysql_num_rows($rsDesl);
    $ipcli = $row_rsDesl['framedipaddress'];
    $nascli = $row_rsDesl['nasipaddress'];
    if ($totalRows_rsDesl) {
        $consulta_rsRamais = "SELECT secret FROM nas WHERE nasname = '" . $nascli . "'";
        $rsRamais = mysql_query($consulta_rsRamais);
        $row_rsRamais = mysql_fetch_assoc($rsRamais);
        $secret = $row_rsRamais['secret'];
        shell_exec(" echo User-Name=".$username.", Framed-IP-Address=".$ipcli." | radclient -t 0 " .$nascli.":3799 disconnect ".$secret."");
    }
}


echo '<meta http-equiv="refresh" content="0;URL=../index.php?app=Servidores&reg=5" />';
//echo "User-Name=edielson", "Framed-IP-Address=10.10.10.1" | radclient -x 201.87.242.33:3799 disconnect myrouter;

?>