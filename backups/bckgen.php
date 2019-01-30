#!/usr/bin/php -q
<?php

require_once '../config/conexao.php';

$dumpfile = $banco . "_" . date("Y-m-d_H-i-s") . ".sql";

$data = date("d-m-Y-H.m.s");
$data2 = date("d/m/Y");
$chave = md5($data);

$dir_backup ="/var/www/myrouter/backups";

passthru("/usr/bin/mysqldump --opt --host=$host --user=$usuario --password=$senha $banco > $dumpfile");

// report - disable with // if not needed
// must look like "-- Dump completed on ..."

echo "$dumpfile "; passthru("tail -1 $dumpfile");

/*Comando compactar arquivo no linux*/
$tar = "tar -cvzf $dir_backup/$dumpfile.tar.gz $dumpfile";
/*Executando comando*/
execute($tar);

$rm = "rm -fv --preserve-root {$dir_backup}/*.sql";
execute($rm);


function execute($command)
{
    if(!shell_exec($command))//error, parar script
        exit;
    else//success, exibir comando
        echo "{$command}\n";
}

$db = new mysqli($host,$usuario,$senha,$banco);
$sql = "INSERT INTO backups (id, servidor, arquivo, `data`, idmk, regkey) VALUES (NULL ,'MyRouterERP','$dumpfile.tar.gz','$data2','00','$chave')";
$db->query($sql);

echo '<meta http-equiv="refresh" content="0;URL=../index.php?app=Backupsql&reg=4" />';


?>
