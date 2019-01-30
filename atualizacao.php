<?php
session_start();
ob_start();
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1");

require_once 'config/conexao.php';
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';


if ( !isset($_SESSION['login']) ){ // Verifica Login do Usuário

echo "
<script>
   	window.location = 'login.php';
    </script>
";
} else {
    $empresaUpdate = $mysqli->query("SELECT versao FROM empresa");
    $empUpdate = mysqli_fetch_array($empresaUpdate);
    $versaoSistema = preg_replace('/[^a-z0-9\s]/i', '', $empUpdate['versao']);
    $versaoSistemaAtual = $versaoSistema;

    $arquivoUpdate = file('http://myrouter.myrouter.com.br/atualizacao/update.txt');
    $novaVersao  =  $arquivoUpdate[0];


if($versaoSistemaAtual < $novaVersao ) {

    echo "Atualizando Versão do Sistema";

   ////////////// FAZENDO BACKUP ANTES DE ATUALIZAR //////////////////////


exec('sudo rm -f backup.zip 2');
$directory = '/var/www/myrouter';

$zipfile = 'backup.zip';

$filenames = array();
function browse($dir) {
    global $filenames;
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && is_file($dir.'/'.$file)) {
                $filenames[] = $dir.'/'.$file;
            }
            else if ($file != "." && $file != ".." && is_dir($dir.'/'.$file)) {
                browse($dir.'/'.$file);
            }
        }
        closedir($handle);
    }
    return $filenames;
}
browse($directory);
$zip = new ZipArchive();

if ($zip->open($zipfile, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$zipfile>\n");
}

foreach ($filenames as $filename) {
    echo "Adding " . $filename . "<br/>";
    $zip->addFile($filename,$filename);
}

echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();

    exec('sudo mv backup.zip /home/myrouter');

    ////////////// FINALIZANDO BACKUP ANTES DE ATUALIZAR //////////////////////

    ////////////// COMERÇANDO A ATUALIZAÇÃO //////////////////////

        shell_exec("sudo rm -f myrouter.zip 2>&1 1> /dev/null");
        shell_exec('sudo wget http://myrouter.myrouter.com.br/instalar/myrouter.zip 2>&1 1> /dev/null');
        shell_exec("sudo mv myrouter.zip /home/myrouter");
        shell_exec("sudo unzip -d /home/myrouter/ /home/myrouter/myrouter.zip 2>&1 1> /dev/null");
        shell_exec("sudo rm -f /home/myrouter/myrouter.zip 2>&1 1> /dev/null");
        shell_exec("sudo cp -Rvf *  /home/myrouter/myrouter/  /var/www/ 2>&1 1> /dev/null");

}else{

    echo "Já está instalado a última verão, em seu vervidor";
}

}

?>